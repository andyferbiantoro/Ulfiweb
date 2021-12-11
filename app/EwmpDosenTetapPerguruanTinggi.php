<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EwmpDosenTetapPerguruanTinggi extends Model
{
    protected $table = "ewmp_dosentetap_perguruantinggi";
    protected $fillable = [
       'dtps','ewmp_pendidikanProdi_diakreditasi','ewmp_pendidikanProdiLain_didalamPerguruanTinggi','ewmp_pendidikanProdiLain_diluarPerguruanTinggi','ewmp_penelitian','ewmp_pkm','ewmp_tugas_tambahan','file_bukti_dokumen','link_bukti_dokumen','tahun','id_user','id_dosen','id_prodi','status','id_user_auditor1','id_user_auditor2','id_penunjukan'
    ];
}
