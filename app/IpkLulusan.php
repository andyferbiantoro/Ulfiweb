<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IpkLulusan extends Model
{
    protected $table = "ipk_lulusan";
    protected $fillable = [
       'tahun_lulus','jumlah_lulusan','minimal_ipk','rataRata_ipk','maksimal_ipk','file_bukti_dokumen','link_bukti_dokumen','path','id_user','id_prodi','status','id_user_auditor1','id_user_auditor2','id_penunjukan'
    ];
}
