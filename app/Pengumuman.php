<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
    protected $table = "pengumuman";
   	protected $fillable = [
       'id_user','judul','gambar','keterangan'
    ];
}
