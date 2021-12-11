<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Komentar;
use Auth;
use File;
use DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class KomentarController extends Controller

{
        
    public function komentar_add(Request $request)
{

   $data_add = new Komentar();

   $data_add->isi_komentar = $request->input('isi_komentar');
   $data_add->id_user = Auth::user()->id;


   $data_add->save();

   return redirect()->back()->with('success', 'Komentar Berhasil Ditambahkan');
}

}
