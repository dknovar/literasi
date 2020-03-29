<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\User;
use App\Guru;
use App\Siswa;
use App\Literasi;
use App\Kelas;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function guru($id)
    {
        $profile = Guru::where('id',$id)->first();
        $id_users = $profile->id_users;
        $akun = User::where('id',$id_users)->first();

        return view('guru.profile',compact('profile', 'akun'));
    }
    public function siswa($id)
    {
        $profile = DB::table('siswa')
                ->select('siswa.id','siswa.gambar', 'siswa.name', 'siswa.nis','kelas.kelas','siswa.id_users')
                ->leftJoin('kelas','siswa.id_kelas','=','kelas.id')->where('siswa.id',$id)->first();
        $id_users = $profile->id_users;
        $akun = User::where('id',$id_users)->first();
        return view('siswa.profile',compact('profile', 'akun'));
    }
    public function updateGuru(Request $request)
    {
        $id_guru = $request->id_guru;
        $Guru = Guru::where('id',$id_guru)->update(
            [
                'nip' => $request->nip,
                'name' => $request->name,
            ]);

            return response()->json($Guru);
    }
    public function updateSiswa(Request $request)
    {
        $id_siswa = $request->id_siswa;
        // $username = $request->nis;
        // $id_users = $request->id_users;
            
        //     if (empty($id_users)) {
        //         $akun = User::updateorCreate([
        //             'username' => $username, 
        //             'password'  => bcrypt('Siswa123'),
        //             'role' => 'siswa']);
                
        //         $id_users=$akun->id;
        //     }
        //     // dd($akun);
        $siswa = Siswa::where('id',$id_siswa)->update(
            [
                'nis' => $request->nis,
                'name' => $request->name,
            ]);

            return response()->json($siswa);
    }
    public function passGuru(Request $request)
    {
        $id_users = $request->id_user;
        $newPass = $request->password;
        // $siswa = DB::table('siswa')->where('id',$id_siswa)->first();
        // $id_akun = $siswa->id_users;
        $akun = User::find($id_users);
        $akun->password = bcrypt($newPass);
        $akun->save();
        // $akun = User::update([
        //     'password'  => bcrypt($newPass)])
        //     ->where('id',$id_akun);

        return response()->json($akun);
    }
    public function passSiswa(Request $request)
    {
        $id_users = $request->id_user;
        $newPass = $request->password;
        // $siswa = DB::table('siswa')->where('id',$id_siswa)->first();
        // $id_akun = $siswa->id_users;
        $akun = User::find($id_users);
        $akun->password = bcrypt($newPass);
        $akun->save();
        // $akun = User::update([
        //     'password'  => bcrypt($newPass)])
        //     ->where('id',$id_akun);

        return response()->json($akun);
    }
    public function fotoGuru(Request $request)
    {
        request()->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
 
        if ($files = $request->file('image')) {
            $gambar =$request->file('image');
            $ext    =$gambar->getClientOriginalExtension();
            $userName = session('namaUsers');
            $gambar_name = $userName.".".$ext;
            $destinationPath = public_path('/fotoPP/'); // upload path

            $id_guru =session('IDguru');
            $cek = Siswa::where('id',$id_guru)->select('gambar')->first();
            if (!empty($cek)) {
                $oldPic =$cek->gambar;
                File::delete('fotoPP/'.$oldPic);
            }
            $gambar->move($destinationPath, $gambar_name);
            // $image = $request->photo->storeAs('image', $gambar_name);
            
           
            $siswa = Guru::where('id',$id_guru)->update(['gambar' => $gambar_name,]);
    
            $profile_pic = Guru::where('id', $id_guru)->first();
            session([
                'userIMG' => $profile_pic->gambar,
              ]);
            return Response()->json([
                "success" => true,
                "image" => $gambar
            ]);
 
        }
 
        return Response()->json([
                "success" => false,
                "image" => ''
            ]);
    }
    public function fotoSiswa(Request $request)
    {
        
        request()->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
 
        if ($files = $request->file('image')) {
            $gambar =$request->file('image');
            $ext    =$gambar->getClientOriginalExtension();
            $userName = session('namaUsers');
            $gambar_name = $userName.".".$ext;
            $destinationPath = public_path('/fotoPP/'); // upload path

            $id_siswa =session('IDsiswa');
            $cek = Siswa::where('id',$id_siswa)->select('gambar')->first();
            if (!empty($cek)) {
                $oldPic =$cek->gambar;
                File::delete('fotoPP/'.$oldPic);
            }
            $gambar->move($destinationPath, $gambar_name);
            // $image = $request->photo->storeAs('image', $gambar_name);
            
           
            $siswa = Siswa::where('id',$id_siswa)->update(['gambar' => $gambar_name,]);
    
            $profile_pic = Siswa::where('id', $id_siswa)->first();
            session([
                'userIMG' => $profile_pic->gambar,
              ]);
            return Response()->json([
                "success" => true,
                "image" => $gambar
            ]);
 
        }
 
        return Response()->json([
                "success" => false,
                "image" => ''
            ]);
        
    }
}