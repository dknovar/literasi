<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input; //untuk input::get
use Illuminate\Support\Facades\Auth;

use Redirect; //untuk redirect


use App\Mahasiswa;
use Illuminate\Http\Request;
use App\User;
use DB;

class AuthController extends Controller
{
    public function login()
    {
    	return view('auth.login')->with('sukses','Anda Berhasil Login');
    }

    public function postlogin(Request $request)
    {
      // echo "$request->email.$request->password "; die;
    	if(Auth::attempt($request->only('username','password'))){
            $akun = DB::table('users')->where('username', $request->username)->first();
            //dd($akun);
            if($akun->role =='admin'){
                session(['akses' => 'admin']);
                Auth::guard('admin')->LoginUsingId($akun->id);
                return redirect('/home')->with('sukses','Anda Berhasil Login');
            } else if($akun->role =='guru'){
                $guru = DB::table('guru')->where('id_users',$akun->id)->first();
                session([
                    'akses' => 'guru',
                    'namaUsers'=>$guru->name,
                    'IDguru'=>$guru->id,
                    ]);
                Auth::guard('guru')->LoginUsingId($akun->id);
                return redirect('/home-guru')->with('sukses','Anda Berhasil Login');
            }elseif ($akun->role =='siswa') {
                
                $siswa = DB::table('siswa')->where('id_users',$akun->id)->first();
                session([
                    'akses' => 'siswa',
                    'namaUsers'=>$siswa->name,
                    'IDsiswa'=>$siswa->id,
                ]);
              Auth::guard('siswa')->LoginUsingId($akun->id);
              return redirect('/home-siswa')->with('sukses','Anda Berhasil Login');
            }
    	}
    	return redirect('/login')->with('error','Akun Belum Terdaftar');
    }

    public function logout()
    {
        if(Auth::guard('admin')->check()){
            Auth::guard('admin')->logout();
        } else if(Auth::guard('guru')->check()){
            Auth::guard('guru')->logout();
        } else if(Auth::guard('siswa')->check()){
            Auth::guard('siswa')->logout();
        }
        session()->flush(); 
    	return redirect('login')->with('sukses','Anda Telah Logout');
    }


}
