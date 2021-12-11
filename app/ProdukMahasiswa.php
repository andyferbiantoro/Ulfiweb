<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProdukMahasiswa extends Model
{
    protected $table = "produk_mahasiswa";
    protected $fillable = [
       'nama_mahasiswa','nama_produk','deskripsi_produk','file_bukti','link_bukti','tahun','path','id_user','id_prodi','status','id_user_auditor1','id_user_auditor2','id_penunjukan'
    ];
}
