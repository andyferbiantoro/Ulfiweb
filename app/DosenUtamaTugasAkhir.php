<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DosenUtamaTugasAkhir extends Model
{
    protected $table = "dospem_utama_tugasakhir";
    protected $fillable = [
       'jumlahMahasiswa_prodiDiakreditasi_ts2','jumlahMahasiswa_prodiDiakreditasi_ts1','jumlahMahasiswa_prodiDiakreditasi_ts','jumlahMahasiswa_prodiLain_perguruanTinggi_ts2','jumlahMahasiswa_prodiLain_perguruanTinggi_ts1','jumlahMahasiswa_prodiLain_perguruanTinggi_ts','tahun_akademik','file_bukti_dokumen','link_bukti_dokumen','id_user','id_dosen','id_prodi','status','id_user_auditor1','id_user_auditor2','id_penunjukan'
    ];
}
