<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Pos_U;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{

    public function index()
    {

        if (!Session::get('login')) {

            return redirect("/");
        } else {

            return view('report.v_report');
        }
    }

    public function lap_pos(Request $request)
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
            return view('report.v_report_pos', compact("pos", "tunai", "nontunai", "all"));
        }
    }

    public function search_pos(Request $request)
    {

        $date1      = date('Y-m-d', strtotime($request->date1));
        $date2      = date('Y-m-d', strtotime($request->date2));
        if (!Session::get('login')) {

            return redirect("/");
        } else {
            $pos        = Pos_U::with("tb_user")->whereBetween('tgl_transaksi', [$date1, $date2])->get();
            $tunai      = Pos_U::select(DB::raw("SUM(total) as pendapatan"))->whereBetween('tgl_transaksi', [$date1, $date2])->where('jenis_pembayaran', '=', 'Tunai')->first();
            $nontunai   = Pos_U::select(DB::raw("SUM(total) as pendapatan"))->whereBetween('tgl_transaksi', [$date1, $date2])->where('jenis_pembayaran', '=', 'Non Tunai')->first();
            $all        = Pos_U::select(DB::raw("SUM(total) as pendapatan"))->whereBetween('tgl_transaksi', [$date1, $date2])->first();
            return view('report.v_report_pos', compact("pos", "tunai", "nontunai", "all"));
        }
    }

    public function detail_pos($id)
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

    public function edc(Request $request)
    {

        $year = date("Y");
        $month = date("m");

        if (!Session::get('login')) {

            return redirect("/");
        } else {
            $edc        = Pos_U::with("edc")->whereYear('tgl_transaksi', '=', $year)->whereMonth('tgl_transaksi', '=', $month)->where("id_edc", "!=", NULL)->select(DB::raw("SUM(total) as total_pendapatan,id_edc"))->groupBy('id_edc')->get();
            return view('report.v_report_edc', compact("edc"));
        }
    }
    public function search_edc(Request $request)
    {

        $date1      = date('Y-m-d', strtotime($request->date1));
        $date2      = date('Y-m-d', strtotime($request->date2));
        if (!Session::get('login')) {

            return redirect("/");
        } else {
            $edc        = Pos_U::with("edc")->whereBetween('tgl_transaksi', [$date1, $date2])->where("id_edc", "!=", NULL)->select(DB::raw("SUM(total) as total_pendapatan,id_edc"))->groupBy('id_edc')->get();
            return view('report.v_report_edc', compact("edc"));
        }
    }
    public function fast_slow(Request $request)
    {

        $year = date("Y");
        $month = date("m");

        if (!Session::get('login')) {

            return redirect("/");
        } else {
            $leadership = DB::table('tbl_barang')
                ->join('tbl_penjualan_trn', 'tbl_penjualan_trn.id_barang', '=', 'tbl_barang.id_barang')
                ->join('tbl_penjualan', 'tbl_penjualan_trn.id_penjualan', '=', 'tbl_penjualan.id_penjualan')
                ->whereMonth('tbl_penjualan.tgl_transaksi', '=', $month)
                ->whereYear('tbl_penjualan.tgl_transaksi', '=', $year)
                ->select(DB::raw('COUNT(tbl_penjualan_trn.id_barang) as total_terjual,tbl_barang.nama_barang,tbl_barang.foto,row_number() OVER (ORDER BY total_terjual DESC) number'))
                ->groupBy('tbl_penjualan_trn.id_barang')
                ->orderBy('number', 'ASC')
                ->get();
            return view('report.v_report_fastslow', compact("leadership"));
        }
    }
    public function search_fast_slow(Request $request)
    {

        $date1      = date('Y-m-d', strtotime($request->date1));
        $date2      = date('Y-m-d', strtotime($request->date2));
        if (!Session::get('login')) {

            return redirect("/");
        } else {
            $leadership = DB::table('tbl_barang')
                ->join('tbl_penjualan_trn', 'tbl_penjualan_trn.id_barang', '=', 'tbl_barang.id_barang')
                ->join('tbl_penjualan', 'tbl_penjualan_trn.id_penjualan', '=', 'tbl_penjualan.id_penjualan')
                ->whereBetween('tbl_penjualan.tgl_transaksi', [$date1, $date2])
                ->select(DB::raw('COUNT(tbl_penjualan_trn.id_barang) as total_terjual,tbl_barang.nama_barang,tbl_barang.foto,row_number() OVER (ORDER BY total_terjual DESC) number'))
                ->groupBy('tbl_penjualan_trn.id_barang')
                ->orderBy('number', 'ASC')
                ->get();
            return view('report.v_report_fastslow', compact("leadership"));
        }
    }
}
