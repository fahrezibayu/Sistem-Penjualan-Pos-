<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Edc;
use App\Models\Merchandise;
use App\Models\Pos_D;
use App\Models\Pos_U;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class PosController extends Controller
{

    public function __construct()
    {

        date_default_timezone_set("Asia/Jakarta");
    }


    public function index(Request $request)
    {

        if (!Session::get('login')) {

            return redirect("/");
        } else {

            $category    = Category::get();
            $max         = Pos_U::max("id_penjualan");

            $urutan = (int) substr($max, 8, 3);
            $urutan++;
            $date = date("dmY");
            $huruf = $date;
            $code = $huruf . sprintf("%03s", $urutan);

            $merchandise = Merchandise::all();
            $edc         = Edc::all();
            $profile     = DB::table("tbl_profile_app")->first();

            return view('pos.v_pos', compact('code', 'category', 'merchandise', 'edc','profile'));
        }
    }

    public function data_menu(Request $request)
    {

        if ($request->id == 'all') {
            $merchandise = Merchandise::all();
            $edc         = Edc::all();
            return view('pos.data_menu', compact('merchandise', 'edc'));
        } else {
            $merchandise = Merchandise::where('id_kategori', $request->id)->get();
            $edc         = Edc::all();
            return view('pos.data_menu', compact('merchandise', 'edc'));
        }
        // return $request->id;
    }

    public function save(Request $request)
    {
        $area = json_encode($request->detail_penjualan, true);
        $data = json_decode($area);
        $count = count($data) - 1;

        $id_penjualan       = $request->id_penjualan;
        $id_edc             = $request->id_edc;
        $jenis_pembayaran   = $request->jenis_pembayaran;
        $subtotal           = $request->subtotal;
        $ppn                = $request->ppn;
        $total              = $request->total;
        $bayar              = $request->bayar;
        $kembalian          = $request->kembalian;

        $total              = $subtotal + ($subtotal * 10 / 100);
        $ppn                = $subtotal * 10 / 100;

        Pos_U::create([
            'id_penjualan'          => $id_penjualan,
            'tgl_transaksi'         => date("Y-m-d"),
            'jenis_pembayaran'      => $jenis_pembayaran,
            'id_edc'                => $id_edc,
            'subtotal'              => $subtotal,
            'ppn'                   => $ppn,
            'total'                 => $total,
            'bayar'                 => $bayar,
            'kembalian'             => $kembalian,
            'id_user'               => Auth::user()->id
        ]);

        for ($i = 0; $i <= ($count); $i++) {
            Pos_D::create([
                'id_penjualan'      => $id_penjualan,
                'id_barang'         => $data[$i]->productid,
                'qty'               => $data[$i]->productqty,
                'harga_barang'      => $data[$i]->harga_asli,
                'total'             => $data[$i]->productqty * $data[$i]->harga_asli,
                'id_promo'          => $data[$i]->id_promo
            ]);
        }
    }

    public function receipt($id)
    {
        $date = date("Y-m-d");
        $id_penjualan = $id;
        $penjualan = Pos_U::with('edc')->where("id_penjualan", $id)->first();
        $detail_penjualan =
            DB::table('tbl_penjualan_trn')
            ->join('tbl_barang', 'tbl_barang.id_barang', '=', 'tbl_penjualan_trn.id_barang')
            ->select(DB::raw('tbl_penjualan_trn.*,tbl_barang.nama_barang,tbl_barang.id_barang'))
            ->where('tbl_penjualan_trn.id_penjualan', $id_penjualan)
            ->groupBy('tbl_barang.id_barang')
            ->get();
        $struck = DB::table("tbl_struck")->first();
        $profile = DB::table("tbl_profile_app")->first();

        return view("pos.v_struck", compact("id_penjualan", "penjualan", "detail_penjualan", "struck", "profile"));
    }

    public function report(Request $request)
    {

        $year = date("Y");
        $month = date("m");

        if (!Session::get('login')) {

            return redirect("/");
        } else {
            $pos        = Pos_U::with("tb_user")->whereYear('tgl_transaksi', '=', $year)->whereMonth('tgl_transaksi', '=', $month)->get();
            $tunai      = Pos_U::select(DB::raw("SUM(total) as pendapatan"))->whereYear('tgl_transaksi', '=', $year)->whereMonth('tgl_transaksi', '=', $month)->where('jenis_pembayaran', '=', 'Tunai')->first();
            $nontunai   = Pos_U::select(DB::raw("SUM(total) as pendapatan"))->whereYear('tgl_transaksi', '=', $year)->whereMonth('tgl_transaksi', '=', $month)->where('jenis_pembayaran', '=', 'Non Tunai')->first();
            $all        = Pos_U::select(DB::raw("SUM(total) as pendapatan"))->whereYear('tgl_transaksi', '=', $year)->whereMonth('tgl_transaksi', '=', $month)->first();
            return view('report.v_report_pos_2', compact("pos", "tunai", "nontunai", "all"));
        }
    }

    public function detail_report($id)
    {

        $id_penjualan = $id;
        $penjualan = Pos_U::with('edc')->where("id_penjualan", $id)->first();
        $detail_penjualan =
            DB::table('tbl_penjualan_trn')
            ->join('tbl_barang', 'tbl_barang.id_barang', '=', 'tbl_penjualan_trn.id_barang')
            ->select(DB::raw('tbl_penjualan_trn.*,tbl_barang.nama_barang,tbl_barang.id_barang'))
            ->where('tbl_penjualan_trn.id_penjualan', $id_penjualan)
            ->groupBy('tbl_barang.id_barang')
            ->get();
        $struck = DB::table("tbl_struck")->first();
        $profile = DB::table("tbl_profile_app")->first();

        return view("report.v_detail_report_pos", compact("id_penjualan", "penjualan", "detail_penjualan", "struck", "profile"));
    }

}
