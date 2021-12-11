<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KesesuaianBidangkerjaLulusan extends Model
{
    protected $table = "kesesuaian_bidangkerja_lulusan";
    protected $fillable = [
       'tahun_lulus','jumlah_lulusan','jumlah_lulusan_terlacak','jumlah_lulusan_rendah','jumlah_lulusan_sedang','jumlah_lulusan_tinggi','file_bukti_dokumen','link_bukti_dokumen','id_user','path','id_prodi','status','id_user_auditor1','id_user_auditor2','id_penunjukan'
    ];
}
