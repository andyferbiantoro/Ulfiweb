<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PerjanjianKinerja extends Model
{
    //
    protected $table = "perjanjian_kinerja";
   	protected $fillable = [
       'sasaran_kegiatan','indikator_kinerja_kegiatan','satuan','target','realisasi_triwulan1','realisasi_triwulan2','realisasi_triwulan3','akhir_tahun','file_bukti_lampiran','link_bukti_lampiran','id_user','id_prodi','status','id_user_auditor1','id_user_auditor2','id_penunjukan'
    ];
}
