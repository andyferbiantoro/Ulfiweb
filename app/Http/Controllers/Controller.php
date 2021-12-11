<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Komentar;
use View;
use DB;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        //$data_komentar = Komentar::orderBy('id', 'DESC')->get();
        $data_komentar = DB::table('komentar')
        ->join('users', 'komentar.id_user', '=', 'users.id')
        ->select('komentar.*', 'users.username')
        ->orderBy('komentar.id', 'DESC')
        ->get();


        View::share('data_komentar',$data_komentar);
        
    }

}
