<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReferensiKepuasanPengguna extends Model
{
   protected $table = "referensi_kepuasan_pengguna";
    protected $fillable = [
       'tahun_lulus','jumlah_lulusan','jumlah_tanggapan','file_bukti_dokumen','link_bukti_dokumen','path','id_user','id_prodi','status','id_user_auditor1','id_user_auditor2','id_penunjukan'
    ];
}
