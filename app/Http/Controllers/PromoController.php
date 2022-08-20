<?php

namespace App\Http\Controllers;

use App\Models\Merchandise;
use App\Models\Promo_D;
use App\Models\Promo_U;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class PromoController extends Controller
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

            $date = date("Y-m-d");
            $promo = DB::table("tbl_promo")
                ->select(DB::raw("count(tbl_detail_promo.id_barang) as total_menu,tbl_promo.*,tbl_detail_promo.nominal,tbl_detail_promo.persen"))
                ->join("tbl_detail_promo", "tbl_promo.id_promo", "=", "tbl_detail_promo.id_promo")
                ->groupBy("tbl_detail_promo.id_promo")
                ->get();

            $count_active = DB::table("tbl_promo")
                ->where([
                    ['periode_awal', '<=', $date],
                    ['periode_akhir', '>=', $date],
                ])
                ->count();

            $count_pending = DB::table("tbl_promo")
                ->where('periode_awal', '>', $date)
                ->count();

            return view('promo.v_promo_diskon', compact('promo', 'count_active', 'count_pending'));
        }
    }
    public function add(Request $request)
    {

        if (!Session::get('login')) {

            return redirect("/");
        } else {

            return view('promo.v_tambah_diskon');
        }
    }
    public function diskon_menu(Request $request)
    {

        if (!Session::get('login')) {

            return redirect("/");
        } else {

            $merchandise = Merchandise::all();
            return view('promo.v_diskon_menu', compact("merchandise"));
        }

    }
    
    public function diskon_nominal(Request $request)
    {

        if (!Session::get('login')) {

            return redirect("/");
        } else {

            $merchandise = Merchandise::all();
            return view('promo.v_diskon_nominal', compact("merchandise"));
        }

    }
    public function diskon_persen(Request $request)
    {

        if (!Session::get('login')) {

            return redirect("/");
        } else {

            $merchandise = Merchandise::all();
            return view('promo.v_diskon_persen', compact("merchandise"));
        }

    }

    public function detail_promo()
    {
        $date = date("Y-m-d");
        $detail_promo = DB::table("tbl_promo")
                        ->join("tbl_detail_promo", "tbl_promo.id_promo", "=", "tbl_detail_promo.id_promo")
                        ->select(DB::raw("tbl_promo.*,tbl_detail_promo.*"))
                        ->where([
                            ['tbl_promo.periode_awal', '<=', $date],
                            ['tbl_promo.periode_akhir', '>=', $date],
                        ])
                        ->get();
        return response([
            'success' => true,
            'message' => 'List Detail Promo',
            'data' => $detail_promo
        ], 200);
    }

    public function save_diskon_menu(Request $request)
    {

        $list_menu = json_encode($request->list_menu, true);
        $data = json_decode($list_menu);
        $id_promo    = "PRM" . date("dmYHis");
        $judul_promo = $request->judul_promo;
        $dari        = date("Y-m-d", strtotime($request->date1));
        $hingga      = date("Y-m-d", strtotime($request->date2));
        $date        = date("Y-m-d");
        if ($date < $dari) {
            $status = 'P';
        } else if ($date >= $dari && $date <= $hingga) {
            $status = 'A';
        } else {
            $status = 'N';
        }

        Promo_U::create([
            'id_promo'      => $id_promo,
            'nama_promo'    => $judul_promo,
            'tipe_promo'    => "Diskon Menu",
            'periode_awal'  => $dari,
            'periode_akhir' => $hingga,
            'status'        => $status,
            'id_user'       => Auth::user()->id
        ]);

        $count = count($data) - 1;
        for ($i = 0; $i <= ($count); $i++) {
            // echo $data[$i]->pprice;
            Promo_D::create([
                'id_promo'      => $id_promo,
                'id_barang'     => $data[$i]->id_menu,
                'persen'      => $data[$i]->potongan
            ]);
        }
    }

    public function save_diskon_nominal(Request $request)
    {

        $list_menu = json_encode($request->list_menu, true);
        $data = json_decode($list_menu);
        $id_promo    = "PRM" . date("dmYHis");
        $judul_promo = $request->judul_promo;
        $potongan    = $request->potongan;
        $dari        = date("Y-m-d", strtotime($request->date1));
        $hingga      = date("Y-m-d", strtotime($request->date2));
        $date        = date("Y-m-d");
        if ($date < $dari) {
            $status = 'P';
        } else if ($date >= $dari && $date <= $hingga) {
            $status = 'A';
        } else {
            $status = 'N';
        }
        Promo_U::create([
            'id_promo'      => $id_promo,
            'nama_promo'    => $judul_promo,
            'tipe_promo'    => "Diskon Nominal",
            'periode_awal'  => $dari,
            'periode_akhir' => $hingga,
            'status'        => $status,
            'id_user'       => Auth::user()->id
        ]);

        $count = count($data) - 1;
        for ($i = 0; $i <= ($count); $i++) {
            // echo $data[$i]->pprice;
            Promo_D::create([
                'id_promo'      => $id_promo,
                'id_barang'     => $data[$i]->id_menu,
                'nominal'        => $potongan
            ]);
        }
    }
    public function save_diskon_persen(Request $request)
    {

        $list_menu = json_encode($request->list_menu, true);
        $data = json_decode($list_menu);
        $id_promo    = "PRM" . date("dmYHis");
        $judul_promo = $request->judul_promo;
        $potongan    = $request->potongan;
        $dari        = date("Y-m-d", strtotime($request->date1));
        $hingga      = date("Y-m-d", strtotime($request->date2));
        $date        = date("Y-m-d");
        if ($date < $dari) {
            $status = 'P';
        } else if ($date >= $dari && $date <= $hingga) {
            $status = 'A';
        } else {
            $status = 'N';
        }
        Promo_U::create([
            'id_promo'      => $id_promo,
            'nama_promo'    => $judul_promo,
            'tipe_promo'    => "Diskon Persen",
            'periode_awal'  => $dari,
            'periode_akhir' => $hingga,
            'status'        => $status,
            'id_user'       => Auth::user()->id
        ]);

        $count = count($data) - 1;
        for ($i = 0; $i <= ($count); $i++) {
            // echo $data[$i]->pprice;
            Promo_D::create([
                'id_promo'      => $id_promo,
                'id_barang'     => $data[$i]->id_menu,
                'persen'        => $potongan
            ]);
        }
    }
}
