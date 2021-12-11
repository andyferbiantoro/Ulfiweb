<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DosenTidakTetap extends Model
{
    protected $table = "dosen_tidak_tetap";
    protected $fillable = [
       'nidn','pendidikan_pasca_sarjana','bidang_keahlian','jabatan_akademik','file_sertifikat_pendidik','link_sertifikat_pendidik','file_sertifikat_kompetensi','link_sertifikat_kompetensi','matakuliah_prodi_diakreditasi','kesesuaian_bidang_keahlian','file_bukti_dokumen','link_bukti_dokumen','tahun','id_user','id_dosen','path','id_prodi','status','id_user_auditor1','id_user_auditor2','id_penunjukan'
       ];
}
