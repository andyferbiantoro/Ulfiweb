<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KepuasanMahasiswa extends Model
{
    protected $table = "kepuasan_mahasiswa";
    protected $fillable = [
       'aspek_diukir','tingkat_kepuasanMahasiswa_sangatBaik','tingkat_kepuasanMahasiswa_baik','tingkat_kepuasanMahasiswa_cukup','tingkat_kepuasanMahasiswa_kurang','path','id_user','rencana_tindak_lanjut','file_bukti_dokumen','link_bukti_dokumen','tahun','id_prodi','status','id_user_auditor1','id_user_auditor2','id_penunjukan'
       ];
}
