<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PenunjukanAuditor extends Model
{
    protected $table = "penunjukan_auditor";
    protected $fillable = [
       'id_user_auditor1','id_user_auditor2','id_prodi','tahun'
    ];
}
