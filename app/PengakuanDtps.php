<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PengakuanDtps extends Model
{
   protected $table = "pengakuan_dtps";
    protected $fillable = [
       'bidang_keahlian','file_rekognisi_buktiPendukung','link_rekognisi_buktiPendukung','tingkat','tahun','path','id_user','id_dosen','id_prodi','status','id_user_auditor1','id_user_auditor2','id_penunjukan'
    ];
}
