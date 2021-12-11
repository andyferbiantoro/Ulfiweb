<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BalasanKomentar extends Model
{
    protected $table = "balasan_komentar";
    protected $fillable = [
       'isi_balasan','id_komentar','id_user_balas' 
       ];
}
