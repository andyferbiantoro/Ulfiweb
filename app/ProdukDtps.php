<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProdukDtps extends Model
{
    protected $table = "produk_dtps";
    protected $fillable = [
       'nama_produk','deskripsi_produk','file_bukti','link_bukti','tahun','path','id_user','id_dosen','id_prodi','status','id_user_auditor1','id_user_auditor2','id_penunjukan'
    ];
}
