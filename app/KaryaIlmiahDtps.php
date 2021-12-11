<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KaryaIlmiahDtps extends Model
{
    protected $table = "karya_ilmiah_dtps";
    protected $fillable = [
       'judul_artikel','jumlah_sitasi','file_bukti_sitasi','link_bukti_sitasi','tahun','path','id_user','id_dosen','id_prodi','status','id_user_auditor1','id_user_auditor2','id_penunjukan'
       ];
}
