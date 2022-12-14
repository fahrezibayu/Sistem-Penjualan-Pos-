<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Merchandise;
use App\Models\Pos_U;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{

    public function __construct()
    {

        date_default_timezone_set("Asia/Jakarta");
    }

    public function index()
    {

        if (!Session::get('login')) {

            return redirect("/");
        } else {
            $year = date("Y");
            $month = date("m");
            $category = Category::count();
            $merchandise = Merchandise::count();
            $users       = User::count();
            $pos         = Pos_U::select(DB::raw("SUM(total) as pendapatan"))->whereYear('tgl_transaksi', '=', $year)->whereMonth('tgl_transaksi', '=', $month)->first();
            $leadership = DB::table('tbl_barang')
            ->join('tbl_penjualan_trn', 'tbl_penjualan_trn.id_barang', '=', 'tbl_barang.id_barang')
            ->join('tbl_penjualan', 'tbl_penjualan_trn.id_penjualan', '=', 'tbl_penjualan.id_penjualan')
            ->whereMonth('tbl_penjualan.tgl_transaksi', '=', date('m'))
            ->whereYear('tbl_penjualan.tgl_transaksi', '=', date('Y'))
            ->select(DB::raw('COUNT(tbl_penjualan_trn.id_barang) as total_penjualan,tbl_barang.nama_barang,tbl_barang.foto,row_number() OVER (ORDER BY total_penjualan DESC) number'))
            ->groupBy('tbl_penjualan_trn.id_barang')
            ->orderBy('number', 'ASC')
            ->take(3)
            ->get();
            return view('v_dashboard', compact("category", "merchandise", "users", "pos","leadership"));
        }
    }

    public function search(Request $request)
    {

        if (!Session::get('login')) {

            return redirect("/");
        } else {
            $month = date("m", strtotime($request->month));
            $year = date("Y", strtotime($request->month));
            $category = Category::count();
            $merchandise = Merchandise::count();
            $users       = User::count();
            $pos         = Pos_U::select(DB::raw("SUM(total) as pendapatan"))->whereYear('tgl_transaksi', '=', $year)->whereMonth('tgl_transaksi', '=', $month)->first();
            $leadership = DB::table('tbl_barang')
            ->join('tbl_penjualan_trn', 'tbl_penjualan_trn.id_barang', '=', 'tbl_barang.id_barang')
            ->join('tbl_penjualan', 'tbl_penjualan_trn.id_penjualan', '=', 'tbl_penjualan.id_penjualan')
            ->whereMonth('tbl_penjualan.tgl_transaksi', '=', $month)
            ->whereYear('tbl_penjualan.tgl_transaksi', '=', $year)
            ->select(DB::raw('COUNT(tbl_penjualan_trn.id_barang) as total_penjualan,tbl_barang.nama_barang,tbl_barang.foto,row_number() OVER (ORDER BY total_penjualan DESC) number'))
            ->groupBy('tbl_penjualan_trn.id_barang')
            ->orderBy('number', 'ASC')
            ->take(3)
            ->get();
            return view('v_dashboard', compact("category", "merchandise", "users", "pos","leadership"));
        }
    }

    public function chart()
    {
        $year = date("Y");
        $pos         = Pos_U::select(DB::raw("SUM(total) as pendapatan,month(tgl_transaksi) as bulan"))->whereYear('tgl_transaksi', '=', $year)->groupBy(DB::raw('month(tgl_transaksi)'))->get();

        // $result = DB::table('tbl_penjualan')
        //     ->select(DB::raw('month(tgl_penjualan) as bulan, sum(bayar+kembalian) as total_data'))
        //     ->where(DB::raw('DATE_FORMAT(tgl_penjualan, "%Y")'), date('Y'))
        //     ->groupBy(DB::raw('month(tgl_penjualan)'))
        //     ->get();

        return response()->json($pos);
    }
}
