<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PkmDtpsMahasiswa;
use App\Dosen;
use App\Prodi;
use Auth;
use DB;
use File;
use Illuminate\Support\Facades\Storage;

class LkpsPengabdianKepadaMasyarakatController extends Controller
{
    public function pkm_dtps_yang_melibatkan_mahasiswa(Request $request)
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

        $pkm_dtps_mahasiswa = DB::table('pkm_dtps_mahasiswa')
        ->join('dosen', 'pkm_dtps_mahasiswa.id_dosen', '=', 'dosen.id')
        ->select('pkm_dtps_mahasiswa.*', 'dosen.nama_dosen')
        ->orderBy('id', 'DESC')
        ->where('pkm_dtps_mahasiswa.id_prodi','like','%'. $request->filter_prodi .'%')
        ->where('pkm_dtps_mahasiswa.tahun', 'like','%'. $request->filter. '%')
        ->where('id_penunjukan',$penunjukan->id)
        ->where('status', 2)
        ->get();

    }


    if (Auth::user()->role == 'kappm') {

        $pkm_dtps_mahasiswa = DB::table('pkm_dtps_mahasiswa')
        ->join('dosen', 'pkm_dtps_mahasiswa.id_dosen', '=', 'dosen.id')
        ->select('pkm_dtps_mahasiswa.*', 'dosen.nama_dosen')
        ->orderBy('id', 'DESC')
        ->where('pkm_dtps_mahasiswa.id_prodi','like','%'. $request->filter_prodi .'%')
        ->where('pkm_dtps_mahasiswa.tahun', 'like','%'. $request->filter. '%')
        ->where('status', 1)
        ->get();
    }

        return view('lkps.pengabdian-kepada-masyarakat-dtps-yang-melibatkan-mhs.index',compact('pkm_dtps_mahasiswa','prodi','prod','th'));
    }
}
