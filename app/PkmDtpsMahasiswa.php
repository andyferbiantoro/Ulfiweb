<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PkmDtpsMahasiswa extends Model
{
    protected $table = "pkm_dtps_mahasiswa";
    protected $fillable = [
       'tema_pkm','nama_mahasiswa','judul_kegiatan','tahun','file_bukti_dokumen','link_bukti_dokumen','path','id_user','id_dosen','id_prodi','status','id_user_auditor1','id_user_auditor2','id_penunjukan'
    ];
}
