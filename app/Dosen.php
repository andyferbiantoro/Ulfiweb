<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    protected $table = "dosen";
    protected $fillable = [
       'nama_dosen','id_prodi'
    ];
}
