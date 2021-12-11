<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PenggunaanDana;
use App\Prodi;
use Auth;
use DB;
use File;
use Illuminate\Support\Facades\Storage;

class LkpsPenggunaanDanaController extends Controller
{
    public function penggunaan_dana(Request $request)
        {

           $prodi = Prodi::all();

           if ($request->filter == Null) {
             $request->filter = "";
         }

         if ($request->filter_prodi == Null) {
           $request->filter_prodi= "";
       }

       $prod = $request->filter_prodi;
       $th = $request->filter;


       if (Auth::user()->role == 'auditor') {

           $penunjukan = DB::table('penunjukan_auditor')
           ->select('penunjukan_auditor.id')
           ->where('penunjukan_auditor.id_user_auditor1','like','%'. Auth::user()->id .'%')
           ->orwhere('penunjukan_auditor.id_user_auditor2','like','%'. Auth::user()->id .'%')
           ->first();

           $data_penggunaan_dana = PenggunaanDana::orderBy('id','DESC')
           ->where('id_prodi','like','%'. $request->filter_prodi .'%')
           ->where('tahun_akademik', 'like','%'. $request->filter. '%')
           ->where('id_penunjukan',$penunjukan->id)
           ->where('status', 2)
           ->get();

           foreach ($data_penggunaan_dana as $key => $value) {
            $rata2_upps = ($value->upps_ts2 + $value->upps_ts1 + $value->upps_ts)/3;
            $rata2_prodi = ($value->prodi_ts2 + $value->prodi_ts1 + $value->prodi_ts)/3;


            $value->rata2_upps = round($rata2_upps, 2);
            $value->rata2_prodi = round($rata2_prodi, 2);
        }

    }

    if (Auth::user()->role == 'kappm') {

       $data_penggunaan_dana = PenggunaanDana::orderBy('id','DESC')
       ->where('id_prodi','like','%'. $request->filter_prodi .'%')
       ->where('tahun_akademik', 'like','%'. $request->filter. '%')
       ->where('status', 1)
       ->get();

       foreach ($data_penggunaan_dana as $key => $value) {
        $rata2_upps = ($value->upps_ts2 + $value->upps_ts1 + $value->upps_ts)/3;
        $rata2_prodi = ($value->prodi_ts2 + $value->prodi_ts1 + $value->prodi_ts)/3;


        $value->rata2_upps = round($rata2_upps, 2);
        $value->rata2_prodi = round($rata2_prodi, 2);
    }
}

        return view('lkps.penggunaan-dana.index',compact('data_penggunaan_dana','prodi','prod','th'));
    }

    public function lihat_penggunaan_dana(Request $request)
    {

     $prodi = Prodi::all();

     if ($request->filter == Null) {
       $request->filter = "";
   }

   if ($request->filter_prodi == Null) {
     $request->filter_prodi= "";
 }

 $prod = $request->filter_prodi;
 $th = $request->filter;


 if (Auth::user()->role == 'auditor') {

     $penunjukan = DB::table('penunjukan_auditor')
     ->select('penunjukan_auditor.id')
     ->where('penunjukan_auditor.id_user_auditor1','like','%'. Auth::user()->id .'%')
     ->orwhere('penunjukan_auditor.id_user_auditor2','like','%'. Auth::user()->id .'%')
     ->first();

     $data_penggunaan_dana = PenggunaanDana::orderBy('id','DESC')
     ->where('id_prodi','like','%'. $request->filter_prodi .'%')
     ->where('tahun_akademik', 'like','%'. $request->filter. '%')
     ->where('id_penunjukan',$penunjukan->id)
     ->where('status', 2)
     ->get();

     foreach ($data_penggunaan_dana as $key => $value) {
        $rata2_upps = ($value->upps_ts2 + $value->upps_ts1 + $value->upps_ts)/3;
        $rata2_prodi = ($value->prodi_ts2 + $value->prodi_ts1 + $value->prodi_ts)/3;


        $value->rata2_upps = round($rata2_upps, 2);
        $value->rata2_prodi = round($rata2_prodi, 2);
    }

}

if (Auth::user()->role == 'kappm') {

 $data_penggunaan_dana = PenggunaanDana::orderBy('id','DESC')
 ->where('id_prodi','like','%'. $request->filter_prodi .'%')
 ->where('tahun_akademik', 'like','%'. $request->filter. '%')
 ->where('status', 1)
 ->get();

 foreach ($data_penggunaan_dana as $key => $value) {
    $rata2_upps = ($value->upps_ts2 + $value->upps_ts1 + $value->upps_ts)/3;
    $rata2_prodi = ($value->prodi_ts2 + $value->prodi_ts1 + $value->prodi_ts)/3;


    $value->rata2_upps = round($rata2_upps, 2);
    $value->rata2_prodi = round($rata2_prodi, 2);
}
}
return view('lkps.penggunaan-dana.lihat_laporan',compact('data_penggunaan_dana','prodi','prod','th'));
}
}
