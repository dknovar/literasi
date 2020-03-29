<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Eloquent;

class Guru extends Model
{
    protected $guarded=[];

    protected $table='guru';

    public function guru()
    {
        return $this->hasMany(LiterasiAdmin::class);
    }
}
