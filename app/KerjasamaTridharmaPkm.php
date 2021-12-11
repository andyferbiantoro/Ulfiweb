<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KerjasamaTridharmaPkm extends Model
{
     protected $table = "kerjasama_tridharma_pkm";
    protected $fillable = [
       'lembaga_mitra','tingkat','judul_kegiatan','manfaat','waktu_durasi','file_bukti_kerjasama','link_bukti_kerjasama','tahun_berakhir','id_user','path','id_prodi','status','id_user_auditor1','id_user_auditor2','id_penunjukan'
    ];
}
