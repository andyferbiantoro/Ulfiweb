<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MasaStudiLulusanD3 extends Model
{
     protected $table = "masastudi_lulusan_d3";
    protected $fillable = [
       'tahun_masuk','jumlah_mahasiswa_diterima','jumlah_mahasiswaLulus_akhirTs4','jumlah_mahasiswaLulus_akhirTs3','jumlah_mahasiswaLulus_akhirTs2','jumlah_mahasiswaLulus_akhirTs1','jumlah_mahasiswaLulus_akhirTs','rataRata_masa_studi','file_bukti_dokumen','link_bukti_dokumen','path','id_user','id_prodi','status','id_user_auditor1','id_user_auditor2','id_penunjukan'
       ];
}
