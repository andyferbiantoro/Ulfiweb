<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IntegrasiKegiatanPembelajaran extends Model
{
    protected $table = "integrasi_kegiatan_pembelajaran";
    protected $fillable = [
       'judul_penelitian_pkm','matakuliah','bentuk_integrasi','tahun','file_bukti_dokumen','link_bukti_dokumen','path','id_user','id_dosen','id_prodi','status','id_user_auditor1','id_user_auditor2','id_penunjukan'
    ];
}
