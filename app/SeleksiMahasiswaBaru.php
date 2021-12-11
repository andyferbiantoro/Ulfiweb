<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SeleksiMahasiswaBaru extends Model
{
    //
    protected $table = "seleksi_mahasiswa_baru";
    protected $fillable = [
       'tahun_akademik','daya_tampung','jumlah_calonMahasiswa_pendaftar','jumlah_calonMahasiswa_lulus','jumlah_mahasiswaBaru_reguler','jumlah_mahasiswaBaru_transfer','jumlah_mahasiswaAktif_reguler','jumlah_mahasiswaAktif_transfer','file_bukti_dokumen','link_bukti_dokumen','id_user','path','id_prodi','status','id_user_auditor1','id_user_auditor2','id_penunjukan'
    ];
}
