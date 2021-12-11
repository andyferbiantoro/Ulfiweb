<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WaktuTungguLulusanD3 extends Model
{
    protected $table = "waktutunggu_lulusan_d3";
    protected $fillable = [
       'tahun_lulus','jumlah_lulusan','jumlah_lulusan_terlacak','jumlah_lulusan_dipesan','jumlah_lulusan_wt_3bulan','jumlah_lulusan_wt_3_6bulan','jumlah_lulusan_wt_6bulan','file_bukti_dokumen','link_bukti_dokumen','path','id_user','id_prodi','status','id_user_auditor1','id_user_auditor2','id_penunjukan'
    ];
}
