<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prodi extends Model
{
     protected $table = "prodi";
    protected $fillable = [
       'id_user','nama_prodi'
    ];
}
