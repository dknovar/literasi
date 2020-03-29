<?php

use Illuminate\Database\Seeder;
use App\Siswa;
use App\Kelas;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        DB::table('users')->insert([
            'username' => 'admin',
            'password'  => bcrypt('password123'),
            'role' => 'admin'
            ]);
    // DB::table('siswa')->insert([
    //     'name' => 'Kadek Satya',
    //     'kelas'  => '10 RPL',
    //     'nis' => '12345678',
        
       
    // ]);
        $dataKelas = array(
            array('kelas'=>'X MIPA 1'),
            array('kelas'=>'X MIPA 2'),
            array('kelas'=>'X MIPA 3'),
            array('kelas'=>'X MIPA 4'),
            array('kelas'=>'X MIPA 5'),
            array('kelas'=>'X MIPA 6'),
            array('kelas'=>'X IPS 1'),
            array('kelas'=>'X IPS 2'),
        );
        DB::table('kelas')->insert($dataKelas);

        
    }
}
