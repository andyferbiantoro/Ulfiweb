<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PenggunaanDana extends Model
{
    protected $table = "penggunaan_dana";
    protected $fillable = [
       'jenis_penggunaan','upps_ts2','upps_ts1','upps_ts','prodi_ts2','prodi_ts1','prodi_ts','tahun_akademik','file_bukti_dokumen','link_bukti_dokumen','path','id_user','id_prodi','status','id_user_auditor1','id_user_auditor2','id_penunjukan'
       ];
}
