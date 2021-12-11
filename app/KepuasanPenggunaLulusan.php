<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KepuasanPenggunaLulusan extends Model
{
    protected $table = "kepuasan_pengguna_lulusan";
    protected $fillable = [
       'jenis_kemampuan','tingkat_kepuasanPengguna_sangatBaik','tingkat_kepuasanPengguna_baik','tingkat_kepuasanPengguna_cukup','tingkat_kepuasanPengguna_kurang','rencana_tindak_lanjut','file_bukti_dokumen','link_bukti_dokumen','tahun','path','id_user','id_prodi','status','id_user_auditor1','id_user_auditor2','id_penunjukan'
       ];
}
