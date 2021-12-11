<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HasilPenilaianLkps extends Model
{
    protected $table = "hasil_penilaian_lkps";
   	protected $fillable = [
       'tanggal','keterangan','lampiran_file','lampiran_link','id_user','path','id_prodi','status','id_user_auditor1','id_user_auditor2','id_penunjukan'
    ];
}
