<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DaftarProdiDiupps extends Model
{
   protected $table = "daftar_prodi_diupps";
    protected $fillable = [
       'jenis_program','peringkat_akreditasi','nomor_tanggal_sk','tanggal_kadaluarsa','jumlah_mahasiswa','file_surat_keputusan','link_surat_keputusan','tahun','id_user','id_prodi','path','status','id_user_auditor1','id_user_auditor2','id_penunjukan'
    ];
}
