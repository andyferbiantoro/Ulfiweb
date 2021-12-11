<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PenelitianDtpsMahasiswa;
use App\Dosen;
use App\Prodi;
use Auth;
use DB;
use File;
use Illuminate\Support\Facades\Storage;

class LkpsPenelitianController extends Controller
{
    public function penelitian_dtps_yang_melibatkan_mahasiswa(Request $request)
    {

        $dosen = Dosen::where('id_prodi', Auth::user()->id_prodi)->get();

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

        $penelitian_dtps_mahasiswa = DB::table('penelitian_dtps_mahasiswa')
        ->join('dosen', 'penelitian_dtps_mahasiswa.id_dosen', '=', 'dosen.id')
        ->select('penelitian_dtps_mahasiswa.*', 'dosen.nama_dosen')
        ->orderBy('id', 'DESC')
        ->where('penelitian_dtps_mahasiswa.id_prodi','like','%'. $request->filter_prodi .'%')
        ->where('penelitian_dtps_mahasiswa.tahun', 'like','%'. $request->filter. '%')
        ->where('id_penunjukan',$penunjukan->id)
        ->where('status', 2)
        ->get();
     }

     if (Auth::user()->role == 'kappm') {
        $penelitian_dtps_mahasiswa = DB::table('penelitian_dtps_mahasiswa')
        ->join('dosen', 'penelitian_dtps_mahasiswa.id_dosen', '=', 'dosen.id')
        ->select('penelitian_dtps_mahasiswa.*', 'dosen.nama_dosen')
        ->orderBy('id', 'DESC')
        ->where('penelitian_dtps_mahasiswa.id_prodi','like','%'. $request->filter_prodi .'%')
        ->where('penelitian_dtps_mahasiswa.tahun', 'like','%'. $request->filter. '%')
        ->where('status', 2)
        ->get();

     }

       return view('lkps.penelitian-dtps-yang-melibatkan-mahasiswa.index',compact('penelitian_dtps_mahasiswa','prodi','prod','th'));
   }
}
