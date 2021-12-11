<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PenelitianDtps extends Model
{
    protected $table = "penelitian_dtps";
    protected $fillable = [
       'sumber_pembiayaan','jumlah_judulPenelitian_ts2','jumlah_judulPenelitian_ts1','jumlah_judulPenelitian_ts','tahun_akademik','file_bukti_dokumen','link_bukti_dokumen','path','id_user','id_prodi','status','id_user_auditor1','id_user_auditor2','id_penunjukan'
    ];
}
