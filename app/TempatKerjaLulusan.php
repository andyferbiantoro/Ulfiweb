<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TempatKerjaLulusan extends Model
{
    protected $table = "tempat_kerja_lulusan";
    protected $fillable = [
       'tahun_lulus','jumlah_lulusan','jumlah_lulusan_terlacak','jumlah_lulusan_lokal','jumlah_lulusan_nasional','jumlah_lulusan_multinasional','file_bukti_dokumen','link_bukti_dokumen','path','id_user','id_prodi','status','id_user_auditor1','id_user_auditor2','id_penunjukan'
    ];
}
