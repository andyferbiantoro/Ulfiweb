<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LuaranPenelitianDtpsBagian3 extends Model
{
    protected $table = "luaranpenelitian_dtps_bagian3";
    protected $fillable = [
       'luaran_penelitian_pkm','tahun','keterangan','file_bukti_dokumen','link_bukti_dokumen','path','id_user','id_prodi','status','id_user_auditor1','id_user_auditor2','id_penunjukan'
       ];
}
