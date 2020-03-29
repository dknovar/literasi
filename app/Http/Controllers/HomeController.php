<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Guru;
use App\Siswa;
use App\Literasi;
use App\Kelas;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Auth::user()->role != 'admin') {
            return redirect('/')->with('error','Anda bukan admin!');
        } else {
            $guru = Guru::all();
            $jml_guru =count($guru);
            $siswa = Siswa::all();
            $jml_siswa =count($siswa);
            $kelas = Kelas::all();
            $jml_kelas =count($kelas);
            $literasi = Literasi::all();
            $jml_literasi =count($literasi);
            // $literasiToday = Literasi::whereDate('created_at', date('Y-m-d'))->get();
            // $jml_literasiToday =count($literasiToday);
            $data = DB::table('literasi')
                            ->select('id')
                            ->whereDate('created_at', date('Y-m-d'))
                            ->orderBy('tanggal','desc')->get();
            $jml_literasiToday =count($data);
            // dd($data);
            // dd($jml_guru,$jml_siswa,$jml_kelas,$jml_literasi);
            return view('dashboard.homepage',compact('jml_guru', 'jml_siswa','jml_kelas','jml_literasi','jml_literasiToday'));
        }
        
    }
    public function guru()
    {
        if (Auth::user()->role != 'guru') {
            return redirect('/')->with('error','Anda bukan guru!');
        } else {
            $id_users= session('IDguru');
            $dataguru=Guru::all();
            $datasiswa=Siswa::all();

            $data = DB::table('literasi')
                            ->select('literasi.id','literasi.tanggal','literasi.judul', 'literasi.halaman', 'literasi.review','literasi.ket','siswa.name as siswa','kelas.kelas','guru.name as guru')
                            ->leftJoin('siswa','siswa.id','=','literasi.id_siswa')
                            ->leftJoin('kelas','kelas.id','=','siswa.id_kelas')
                            ->leftJoin('guru','guru.id','=','literasi.id_guru')
                            ->where('id_guru',$id_users)
                            ->whereDate('literasi.created_at', date('Y-m-d'))
                            ->orderBy('tanggal','desc')->get();
            // dd($data);
            return view('guru.letrasi_guru.today', compact('data', 'dataguru','datasiswa'));
        }
        
    }
    public function siswa()
    {
        if (Auth::user()->role != 'siswa') {
            return redirect('/')->with('error','Anda bukan siswa!');
        } else {
            $id_users= session('IDsiswa');
            $dataguru=Guru::all();
            $datasiswa=Siswa::all();

            $data = DB::table('literasi')
                            ->select('literasi.id','literasi.tanggal','literasi.judul', 'literasi.halaman', 'literasi.review','literasi.ket','siswa.name as siswa','kelas.kelas','guru.name as guru')
                            ->leftJoin('siswa','siswa.id','=','literasi.id_siswa')
                            ->leftJoin('kelas','kelas.id','=','siswa.id_kelas')
                            ->leftJoin('guru','guru.id','=','literasi.id_guru')
                            ->where('id_siswa',$id_users)
                            ->whereDate('literasi.created_at', date('Y-m-d'))
                            ->orderBy('tanggal','desc')->get();
            // dd($data);
            return view('siswa.letrasi_siswa.today', compact('data','dataguru','datasiswa'));
        }
        
    }
}
