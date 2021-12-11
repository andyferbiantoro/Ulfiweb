<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DataLkps extends Model
{
    //
    protected $table = "data_lkps";
    protected $fillable = [
       'jenis_program','peringkat_akreditasi','nomor_sk_banpt','tanggal_kadaluarsa','nama_unit_pengelola','nama_perguruan_tinggi','alamat','kabupaten','kode_pos','nomor_tlp','email','website','tahun_akademik','file_laporan_evaluasi','link_laporan_evaluasi','nama_pengusul','tanggal','id_user','id_prodi','path','status','id_user_auditor1','id_user_auditor2','id_penunjukan'
    ];
}
