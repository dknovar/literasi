<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input; //untuk input::get
use Illuminate\Support\Facades\Auth;

use Redirect; //untuk redirect


use App\Mahasiswa;
use Illuminate\Http\Request;
use App\User;
use DB;
use Response;

class ApiController extends Controller
{
    public function user()
    {
        return User::all();
    }
    public function login(Request $request)
    {
      // echo "$request->email.$request->password "; die;
    	if(Auth::attempt($request->only('username','password'))){
            $akun = DB::table('users')->where('username', $request->username)->first();
            //dd($akun);
            $isi=[];
            $id = $akun->id;
            $username =$akun->username;
            $role =$akun->role;

            $isi[]=[
                'id'=>$id,
                'username'=>$username,
                'role'=>$role,
            ];
            
            $res['message'] = "Success!";
            $res['values'] = $isi;
            return Response::json($res);
        }
        $res['message'] = "Anda tidak terdaftar!";
    	return Response::json($res);
    }
}