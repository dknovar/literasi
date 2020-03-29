<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Literasi;
use App\Siswa;
use App\Guru;
class LiterasiAdminController extends Controller
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
            // $data=Literasi::all();
            $dataguru=Guru::all();
            $datasiswa=Siswa::all();

            $data = DB::table('literasi')
                            ->select('literasi.id','literasi.tanggal','literasi.judul', 'literasi.halaman', 'literasi.review','literasi.ket','siswa.name as siswa','kelas.kelas','guru.name as guru')
                            ->leftJoin('siswa','siswa.id','=','literasi.id_siswa')
                            ->leftJoin('kelas','kelas.id','=','siswa.id_kelas')
                            ->leftJoin('guru','guru.id','=','literasi.id_guru')
                            ->orderBy('tanggal','desc')->get();
            // dd($data);
            return view('dashboard.letrasi_admin.admin', compact('data', 'dataguru','datasiswa'));
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
        //
        $id_siswa = $request->id_siswa;
        $id_guru = $request->id_guru;
        $judulbuku = $request->judulbuku;
        $halaman = $request->halaman;
        $review = $request->review;
        $ket = $request->ket;
        $id_letrasi = $request->id_letrasi;

            // dd($akun);
        $Literasi = Literasi::updateorCreate(['id' => $id_letrasi],
            [
                'tanggal' => now(),
                'judul' => $judulbuku,
                'halaman' =>$halaman,
                'review' =>$review,
                'ket' =>$ket,
                'id_siswa' =>$id_siswa,
                'id_guru' =>$id_guru,
            ]);

            return response()->json($Literasi);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dataLiterasi = DB::table('literasi')
                        ->select('literasi.id','literasi.tanggal','literasi.judul', 'literasi.halaman', 'literasi.review','literasi.ket','siswa.name as siswa','kelas.kelas','guru.name as guru')
                        ->leftJoin('siswa','siswa.id','=','literasi.id_siswa')
                        ->leftJoin('kelas','kelas.id','=','siswa.id_kelas')
                        ->leftJoin('guru','guru.id','=','literasi.id_guru')
                        ->where('literasi.id',$id)->first();

        return response()->json($dataLiterasi);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $where = array('id' => $id);
        $literasi = Literasi::where($where)->first();

        return response()->json($literasi);
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
         $literasi = Literasi::where('id', $id)->delete();
         return response()->json($literasi);
    }
    public function today(){
        if (Auth::user()->role != 'admin') {
            return redirect('/')->with('error','Anda bukan admin!');
        } else {
            // $data=Literasi::all();
            $dataguru=Guru::all();
            $datasiswa=Siswa::all();

            $data = DB::table('literasi')
                            ->select('literasi.id','literasi.tanggal','literasi.judul', 'literasi.halaman', 'literasi.review','literasi.ket','siswa.name as siswa','kelas.kelas','guru.name as guru')
                            ->leftJoin('siswa','siswa.id','=','literasi.id_siswa')
                            ->leftJoin('kelas','kelas.id','=','siswa.id_kelas')
                            ->leftJoin('guru','guru.id','=','literasi.id_guru')
                            ->whereDate('literasi.created_at', date('Y-m-d'))
                            ->orderBy('tanggal','desc')->get();
            // dd($data);
            return view('dashboard.letrasi_admin.today', compact('data', 'dataguru','datasiswa'));
        }
    }
}
