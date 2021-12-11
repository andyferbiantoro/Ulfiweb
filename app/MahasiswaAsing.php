<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MahasiswaAsing extends Model
{
    protected $table = "mahasiswa_asing";
    protected $fillable = [
       'jumlah_mahasiswaAktif_ts2','jumlah_mahasiswaAktif_ts1','jumlah_mahasiswaAktif_ts','jumlah_mahasiswaFullTime_ts2','jumlah_mahasiswaFullTime_ts1','jumlah_mahasiswaFullTime_ts','jumlah_mahasiswaPartTime_ts2','jumlah_mahasiswaPartTime_ts1','jumlah_mahasiswaPartTime_ts','tahun_akademik','file_bukti_dokumen','link_bukti_dokumen','id_user','id_prodi','status','id_user_auditor1','id_user_auditor2','id_penunjukan'
    ];
}
