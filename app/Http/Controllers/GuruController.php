<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Guru;
use App\User;
use Response;

class GuruController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->role != 'admin') {
            return redirect('/')->with('error','Anda bukan admin!');
        } else {
            $data['guru'] = Guru::all();
            return view('dashboard.guru',$data);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id_guru = $request->id_guru;
        $username = $request->nip;
        $id_users = $request->id_users;
        
        if (empty($id_users)) {
            $akun = User::updateorCreate([
                'username' => $username, 
                'password'  => bcrypt('Guru123'),
                'role' => 'guru']);
            
            $id_users=$akun->id;
        }
            // dd($akun);
        $guru = Guru::updateorCreate(['id' => $id_guru],
            [
                'nip' => $request->nip,
                'name' => $request->name,
                'id_users' =>$id_users,
            ]);

            return response()->json($guru);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $where = array('id' => $id);
        $guru = Guru::where($where)->first();

        return response()->json($guru);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         // hapus akunya dulu
         $akun = Guru::where('id', $id)->first();
         $id_akun = $akun->id_users;
         $guru_akun = User::where('id', $id_akun)->delete();
         // hapus siswa
         $guru = Guru::where('id', $id)->delete();
         return response()->json($guru);
    }
    public function gantiPass(Request $request)
    {
        $id_users = $request->id_user;
        $newPass = $request->password;

        $akun = User::find($id_users);
        $akun->password = bcrypt($newPass);
        $akun->save();
        // $akun = User::update([
        //     'password'  => bcrypt($newPass)])
        //     ->where('id',$id_akun);

        return response()->json($akun);
    }

}
