<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KurikulumPembelajaran extends Model
{
    protected $table = "kurikulum_pembelajaran";
    protected $fillable = [
       'semester','kode_matakuliah','nama_matakuliah','matakuliah_kompetensi','bobot_kredit_kuliah','bobot_kredit_seminar','bobot_kredit_praktikum','konversi_kredit','sikap','pengetahuan','keterampilan_umum','keterampilan_khusus','file_dokumen_rencanaPembelajaran','link_dokumen_rencanaPembelajaran','unit_penyelenggara','tahun','path','id_user','id_prodi','status','id_user_auditor1','id_user_auditor2','id_penunjukan'
       ];
}
