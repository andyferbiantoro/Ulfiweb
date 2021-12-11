<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PrestasiNonAkademikMahasiswa extends Model
{
    protected $table = "prestasi_non-akademik_mahasiswa";
    protected $fillable = [
       'nama_kegiatan','tahun_perolehan','tingkat','prestasi_dicapai','file_bukti_dokumen','link_bukti_dokumen','path','id_user','id_prodi','status','id_user_auditor1','id_user_auditor2','id_penunjukan'
    ];
}
