<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;

class SettingController extends Controller
{
    public function __construct()
    {

        date_default_timezone_set("Asia/Jakarta");

    }


    public function apps(Request $request)
    {

        if (!Session::get('login')) {

            return redirect("/");

        } else {

            $profile = DB::table("tbl_profile_app")->first();
            return view('setting.v_apps',compact("profile"));

        }

    }
    
    public function struck(Request $request)
    {

        if (!Session::get('login')) {

            return redirect("/");

        } else {

            $struck = DB::table("tbl_struck")->first();
            $profile = DB::table("tbl_profile_app")->first();
            return view('setting.v_setting_struck',compact("struck","profile"));

        }

    }

    public function update_apps(Request $request)
    {
        
        $nama           = $request->nama;
        $nama_aplikasi  = $request->nama_aplikasi;


        if ($request->file("file") == null) {
            $file_photo = $request->input("file_l");
        } else {
            File::delete('assets/images/logo/'.$request->photo_l);
            $photo =   $request->file("file");
            $extension = $photo->getClientOriginalExtension();
            // dd($photo);
            $file_photo = ucwords($request->nama_aplikasi).'.'.$extension;
            $photo->move(public_path("assets/images/logo"), $file_photo);
        }

        DB::table('tbl_profile_app')->update([

            'nama'          => $nama,
            'nama_aplikasi' => $nama_aplikasi,
            'photo'         => $file_photo

        ]);

        return redirect('/setting/apps');

    }
    public function update_struck(Request $request)
    {
        
        $nama_outlet          = $request->nama_outlet;
        $alamat               = $request->alamat;
        $kota                 = $request->kota;
        $kodepos              = $request->kodepos;
        $telp                 = $request->telp;
        $nohp                 = $request->nohp;
        $catatan              = $request->catatan;
        $footer               = $request->footer;


        if ($request->file("file") == null) {
            $file_photo = $request->input("file_l");
        } else {
            File::delete('assets/images/logo/struck/'.$request->photo_l);
            $photo =   $request->file("file");
            $extension = $photo->getClientOriginalExtension();
            // dd($photo);
            $file_photo = ucwords($request->nama_outlet).'.'.$extension;
            $photo->move(public_path("assets/images/logo/struck"), $file_photo);
        }

        DB::table('tbl_struck')->update([

            'nama_outlet'          => $nama_outlet,
            'alamat'               => $alamat,
            'kota'                 => $kota,
            'kodepos'              => $kodepos,
            'telp'                 => $telp,
            'nohp'                 => $nohp,
            'catatan'              => $catatan,
            'footer'               => $footer,
            'logo'                 => $file_photo

        ]);

        return redirect('/setting/struck');

    }

    public function profile()
    {

        if (!Session::get('login')) {

            return redirect("/");

        } else {

            return view('setting.v_profile');

        }

    }

    public function update_profile(Request $request)
    {
        
        $id         = $request->id;
        $nama       = $request->nama;
        $username   = $request->username;
        $user       = User::where("id",$id)->first();

        if ($request->file("foto") == null) {
            $file_photo = $request->input("foto_l");
        } else {
            // File::delete('assets/images/profile/'.$request->foto_l);
            $photo =   $request->file("foto");
            $extension = $photo->getClientOriginalExtension();
            // dd($photo);
            $file_photo = ucwords($request->username).'.'.$extension;
            $photo->move(public_path("assets/images/profile"), $file_photo);
        }

        if ($user->username != $username) {

            User::where("id",$id)->update([
                'name'          => $nama,
                'username'      => $username,
                'foto'          => $file_photo
            ]);

            return redirect("/sign_out");

        } else {

            User::where("id",$id)->update([
                'name'          => $nama,
                'username'      => $username,
                'foto'          => $file_photo
            ]);

            return redirect("/setting/profile");

        }

    }

    public function update_password(Request $request)
    {
        
        $password2      = $request->password2;
        $id             = $request->id;

        $hashPassword2 = bcrypt($password2);

        User::where('id', $id)->update([
            'password' => $hashPassword2
        ]);
        

    }

    public function delete_photo($id)
    {
        
        $user = User::where('id',$id)->first();
        $foto = $user->foto;
        File::delete('assets/images/profile/'.$foto);
        User::where('id',$id)->update([
            'foto'      => ''
        ]);
        return Redirect::back();

    }

}
