<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Siswa;
use App\User;
use App\Kelas;
use Response;

class SiswaController extends Controller
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
            $datakelas['kelas']=Kelas::orderBy('id','asc')->get();
            // $data['siswa'] = Siswa::orderBy('id','desc')->paginate(10);

            $data['siswa'] = DB::table('siswa')
                            ->select('siswa.id','siswa.gambar', 'siswa.name', 'siswa.nis','kelas.kelas','siswa.id_users')
                            ->leftJoin('kelas','siswa.id_kelas','=','kelas.id')->orderBy('id','desc')->get();

            // dd($data);
            return view('dashboard.siswa',$data, $datakelas);
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
       $id_siswa = $request->id_siswa;
       $username = $request->nis;
       $id_users = $request->id_users;
        
        if (empty($id_users)) {
            $akun = User::updateorCreate([
                'username' => $username, 
                'password'  => bcrypt('Siswa123'),
                'role' => 'siswa']);
            
            $id_users=$akun->id;
        }
        // dd($akun);
       $siswa = Siswa::updateorCreate(['id' => $id_siswa],
        [
            'nis' => $request->nis,
            'name' => $request->name,
            'id_kelas' => $request->id_kelas,
            'id_users' =>$id_users,
        ]);

        return response()->json($siswa);
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
        $siswa = Siswa::where($where)->first();

        return response()->json($siswa);
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
        $akun = Siswa::where('id', $id)->first();
        $id_akun = $akun->id_users;
        $siswa = User::where('id', $id_akun)->delete();
        // hapus siswa
        $siswa = Siswa::where('id', $id)->delete();
       return response()->json($siswa);
    }
    public function gantiPass(Request $request)
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


    public function __construct()
    {
        $this->middleware('auth');
    }

}
