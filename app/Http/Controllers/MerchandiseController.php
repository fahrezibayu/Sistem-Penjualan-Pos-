<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Merchandise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;

class MerchandiseController extends Controller
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

            $category    = Category::all();
            $max         = Merchandise::max("id_barang");

            $urutan = (int) substr($max, 3, 3);
            $urutan++;
            $huruf = "BRG";
            $code = $huruf . sprintf("%03s", $urutan);

            return view('master.v_merchandise',compact('code','category'));

        }

    }

    public function data(Request $request)
    {

        if (!Session::get('login')) {

            return redirect("/");

        } else {

            $merchandise = Merchandise::with('category')->get();

            return view('master.data_merchandise',compact('merchandise'));

        }

    }

    public function save(Request $request)
    {
        
        $id          = $request->id_barang;
        $nama        = $request->nama_barang;
        $harga       = $request->harga_barang;
        $qty         = $request->qty;
        $id_kategori = $request->id_kategori; 
        if ($request->file("foto") == null) {
            $file_photo = $request->input("foto");
        } else {
            $photo =   $request->file("foto");
            $extension = $photo->getClientOriginalExtension();
            // dd($photo);
            $file_photo = ucwords($request->id_barang).'.'.$extension;
            $photo->move(public_path("assets/images/product/"), $file_photo);
        }

        Merchandise::create([
            'id_barang'     => $id,
            'nama_barang'   => $nama,
            'harga_barang'  => $harga,
            'qty'           => $qty,
            'id_kategori'   => $id_kategori,
            'id_user'       => Auth::user()->id,
            'foto'          => $file_photo
        ]);

        return redirect('/master/merchandise');

    }

    public function edit($id)
    {
        
        if (!Session::get('login')) {

            return redirect("/");

        } else {

            $merchandise        = Merchandise::where("id_barang", $id)->with('category')->first();
            $category           = Category::all();
            return view("master.e_merchandise", compact('merchandise','category'));
        }
        
    }

    public function update(Request $request)
    {
        
        $id          = $request->id_barang;
        $name        = $request->nama_barang;
        $harga       = $request->harga_barang;
        $id_kategori = $request->id_kategori; 

        if ($request->file("foto") == null) {
            $file_photo = $request->input("foto_l");
        } else {
            File::delete('assets/images/product/'.$request->foto_l);
            $photo =   $request->file("foto");
            $extension = $photo->getClientOriginalExtension();
            $file_photo = ucwords($request->id_barang).'.'.$extension;
            $photo->move(public_path("assets/images/product"), $file_photo);
        }

        Merchandise::where("id_barang",$id)->update([
            'nama_barang'    => $name,
            'harga_barang'   => $harga,
            'id_kategori'    => $id_kategori,
            'foto'           => $file_photo
        ]);
        return redirect('/master/merchandise');
        
    }

    public function delete($id)
    {
        
        Merchandise::where("id_barang",$id)->delete();
        return redirect("/master/merchandise");
        
    }

    public function update_stock(Request $request)
    {

        $id           = $request->id;
        $qty          = $request->qty;
        $merchandise  = Merchandise::where("id_barang", $id)->first();

        $update = Merchandise::where('id_barang',$id)->update([
            'qty'   => $merchandise->qty + $qty
        ]);
        if ($update) {
            echo 'ok';
        } else {
            echo 'no';
        }
        

    }

}
