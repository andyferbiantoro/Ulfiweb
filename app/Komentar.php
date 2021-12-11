<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Komentar extends Model
{
    protected $table = "komentar";
    protected $fillable = [
       'isi_komentar','isi_balasan','id_user','id_user_balas' 
       ];
}
