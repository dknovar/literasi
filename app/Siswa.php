<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Eloquent;

class Siswa extends Eloquent
{
    protected $table ='siswa';

    // protected $fillable =[
    //     'gambar','name','nis','id_kelas','id_users'
    // ];

    protected $guarded=[];

    public function kelas()
    {
        return $this->hasMany(Kelas::class);
    }

    public function siswa()
    {
        return $this->hasMany(LetrasiAdmin::class);
    }
}
