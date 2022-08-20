<?php

namespace App\Http\Controllers;

use App\Models\Merchandise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class PromopaketController extends Controller
{
    public function index(Request $request)
    {

        if (!Session::get('login')) {

            return redirect("/");
        } else {

            $date = date("Y-m-d");
            $promo = DB::table("tbl_promo_paket")
                ->select(DB::raw("*"))
                ->get();

            $count_active = DB::table("tbl_promo_paket")
                ->where([
                    ['periode_awal', '<=', $date],
                    ['periode_akhir', '>=', $date],
                ])
                ->count();

            $count_pending = DB::table("tbl_promo_paket")
                ->where('periode_awal', '>', $date)
                ->count();

            return view('promo.v_promo_paket', compact('promo', 'count_active', 'count_pending'));
        }
    }
    public function add(Request $request)
    {

        if (!Session::get('login')) {

            return redirect("/");
        } else {

            return view('promo.v_tambah_promo_paket');
        }
    }
    public function discY(Request $request)
    {

        if (!Session::get('login')) {

            return redirect("/");
        } else {

            $merchandise = Merchandise::all();
            return view('promo.v_promo_paket_discY', compact("merchandise"));
        }

    }

    public function detail_promo()
    {
        $date = date("Y-m-d");
        $detail_promo = DB::table("tbl_promo_paket")
                        ->join("tbl_required", "tbl_required.id_promo", "=", "tbl_promo_paket.id_promo")
                        ->join("tbl_gift", "tbl_gift.id_promo", "=", "tbl_promo_paket.id_promo")
                        ->select(DB::raw("tbl_promo_paket.*,tbl_required.*,tbl_gift.*"))
                        ->where([
                            ['tbl_promo_paket.periode_awal', '<=', $date],
                            ['tbl_promo_paket.periode_akhir', '>=', $date],
                        ])
                        ->get();
        return response([
            'success' => true,
            'message' => 'List Detail Promo Paket',
            'data' => $detail_promo
        ], 200);
    }

}
