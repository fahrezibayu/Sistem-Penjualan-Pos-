<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
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

            $category = Category::all();

            return view('master.v_category',compact('category'));

        }

    }

    public function save(Request $request)
    {
        
        $nama     = $request->nama_kategori;

        Category::create([
            'nama_kategori'      => $nama,
            'id_user'            => Auth::user()->id
        ]);

        return redirect('/master/category');

    }

    public function edit($id)
    {
        
        if (!Session::get('login')) {

            return redirect("/");
        } else {

            $category   = Category::where("id_kategori", $id)->first();
            return view("master.e_category", compact('category'));
        }
        
    }

    public function update(Request $request)
    {
        
        $id     = $request->id_kategori;
        $name   = $request->nama_kategori;
        Category::where("id_kategori",$id)->update([
            'nama_kategori' => $name
        ]);
        return redirect('/master/category');
        
    }

    public function delete($id)
    {
        
        Category::where("id_kategori",$id)->delete();
        return redirect("/master/category");
        
    }

}
