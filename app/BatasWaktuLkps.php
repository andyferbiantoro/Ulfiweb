<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BatasWaktuLkps extends Model
{
    protected $table = "batas_waktu_lkps";
    protected $fillable = [
       'id_prodi','tanggal_awal','tanggal_akhir','tahun','status'
    ];
}
