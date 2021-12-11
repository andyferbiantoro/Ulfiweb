<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PagelaranIlmiahDtps extends Model
{
    protected $table = "pagelaran_ilmiah_dtps";
    protected $fillable = [
       'jenis_publikasi','jumlah_judul_ts2','jumlah_judul_ts1','jumlah_judul_ts','tahun_akademik','file_bukti_dokumen','link_bukti_dokumen','path','id_user','id_prodi','status','id_user_auditor1','id_user_auditor2','id_penunjukan'
    ];
}
