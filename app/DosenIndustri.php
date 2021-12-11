<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DosenIndustri extends Model
{
    protected $table = "dosen_industri";
    protected $fillable = [
       'nidk','perusahaan','pendidikan_tertinggi','bidang_keahlian','file_sertifikat_kompetensi','link_sertifikat_kompetensi','matakuliah_diampu','bobot_kredit','tahun','file_bukti_dokumen','link_bukti_dokumen','path_sertifikat','path_bukti','id_user','id_dosen','id_prodi','status','id_user_auditor1','id_user_auditor2','id_penunjukan'
    ];
}
