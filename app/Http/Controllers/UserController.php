<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;

class UserController extends Controller
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

            $users    = User::all();

            return view('master.v_users',compact('users'));

        }

    }

    public function save(Request $request)
    {
        
        $name           = $request->name;
        $username       = $request->username;
        $password       = bcrypt($request->password);
        $role           = $request->role;
        if ($request->file("foto") == null) {
            $file_photo = $request->input("foto");
        } else {
            $photo =   $request->file("foto");
            $extension = $photo->getClientOriginalExtension();
            // dd($photo);
            $file_photo = ucwords($request->username).'.'.$extension;
            $photo->move(public_path("assets/images/profile/"), $file_photo);
        }

        User::create([
            'name'      => $name,
            'username'  => $username,
            'password'  => $password,
            'role'      => $role,
            'foto'      => $file_photo
        ]);

        return redirect('/master/users');

    }

    public function edit($id)
    {
        
        if (!Session::get('login')) {

            return redirect("/");

        } else {

            $users        = User::where("id", $id)->first();
            return view('master.e_users', compact('users'));
        }
        
    }

    public function update(Request $request)
    {
        
        $id          = $request->id;
        $role        = $request->role;

        User::where("id",$id)->update([
            'role'    => $role
        ]);
        return redirect('/master/users');
        
    }

    public function delete($id)
    {
        
        $user = User::where('id',$id)->first();
        $foto = $user->foto;
        File::delete('assets/images/profile/'.$foto);
        User::where("id",$id)->delete();
        return redirect("/master/users");
        
    }

}
