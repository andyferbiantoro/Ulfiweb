<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LuaranPenelitianMahasiswaBagian1 extends Model
{
   protected $table = "luaranpenelitian_mahasiswa_bagian1";
   protected $fillable = [
     'luaran_penelitian_pkm','tahun','keterangan','file_bukti_dokumen','link_bukti_dokumen','path','id_user','id_prodi','status','id_user_auditor1','id_user_auditor2','id_penunjukan'
 ];
 
}
