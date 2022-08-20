<?php

namespace App\Http\Controllers;

use App\Models\Edc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class EdcController extends Controller
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

            $edc = Edc::all();

            return view('master.v_edc',compact('edc'));

        }

    }

    public function save(Request $request)
    {
        
        $nama     = $request->nama_edc;

        Edc::create([
            'nama_edc'      => $nama,
            'id_user'            => Auth::user()->id
        ]);

        return redirect('/master/edc');

    }

    public function edit($id)
    {
        
        if (!Session::get('login')) {

            return redirect("/");
        } else {

            $edc   = Edc::where("id_edc", $id)->first();
            return view("master.e_edc", compact('edc'));
        }
        
    }

    public function update(Request $request)
    {
        
        $id     = $request->id_edc;
        $name   = $request->nama_edc;
        Edc::where("id_edc",$id)->update([
            'nama_edc' => $name
        ]);
        return redirect('/master/edc');
        
    }

    public function delete($id)
    {
        
        Edc::where("id_edc",$id)->delete();
        return redirect("/master/edc");
        
    }

}
