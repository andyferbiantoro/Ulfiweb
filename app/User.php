<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = "users";
    protected $fillable = [
        'username', 'email', 'password','role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function isAdmin(){

        //jika role=admin maka benar
        if($this->role == 'admin'){

            return true;
        }
            return false;
    }

     public function isAuditor(){

        //jika role=admin maka benar
        if($this->role == 'auditor'){

            return true;
        }
            return false;
    }

     public function isProdi(){

        //jika role=admin maka benar
        if($this->role == 'prodi'){

            return true;
        }
            return false;
    }

     public function isKappm(){

        //jika role=admin maka benar
        if($this->role == 'kappm'){

            return true;
        }
            return false;
    }


}
