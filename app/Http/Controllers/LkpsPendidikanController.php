<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\KurikulumPembelajaran;
use App\IntegrasiKegiatanPembelajaran;
use App\KepuasanMahasiswa;
use App\Dosen;
use App\Prodi;
use Auth;
use DB;
use File;
use Illuminate\Support\Facades\Storage;

class LkpsPendidikanController extends Controller
{
    public function pendidikan_kurikulum()
    {
        $data_kurikulum = KurikulumPembelajaran::orderBy('id','DESC')->get();

        return view('lkps.pendidikan.kurikulum.index',compact('data_kurikulum'));
    }

    public function lihat_pendidikan_kurikulum()
    {
        $data_kurikulum = KurikulumPembelajaran::orderBy('id','DESC')->get();

        return view('lkps.pendidikan.kurikulum.lihat_laporan',compact('data_kurikulum'));
    }


    public function pendidikan_integrasi_kegiatan_penelitian(Request $request)
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

     $data_integrasi = DB::table('integrasi_kegiatan_pembelajaran')
     ->join('dosen', 'integrasi_kegiatan_pembelajaran.id_dosen', '=', 'dosen.id')
     ->select('integrasi_kegiatan_pembelajaran.*', 'dosen.nama_dosen')
     ->orderBy('id', 'DESC')
     ->where('integrasi_kegiatan_pembelajaran.id_prodi','like','%'. $request->filter_prodi .'%')
     ->where('integrasi_kegiatan_pembelajaran.tahun', 'like','%'. $request->filter. '%')
     ->where('id_penunjukan',$penunjukan->id)
     ->where('status', 2)
     ->get();
 }

 if (Auth::user()->role == 'kappm') {
   $data_integrasi = DB::table('integrasi_kegiatan_pembelajaran')
   ->join('dosen', 'integrasi_kegiatan_pembelajaran.id_dosen', '=', 'dosen.id')
   ->select('integrasi_kegiatan_pembelajaran.*', 'dosen.nama_dosen')
   ->orderBy('id', 'DESC')
   ->where('integrasi_kegiatan_pembelajaran.id_prodi','like','%'. $request->filter_prodi .'%')
   ->where('integrasi_kegiatan_pembelajaran.tahun', 'like','%'. $request->filter. '%')
   ->where('id_penunjukan',$penunjukan->id)
   ->where('status', 1)
   ->get();

}    

     return view('lkps.pendidikan.integrasi-kegiatan-penelitian.index',compact('data_integrasi','prodi','prod','th'));
 }

 public function pendidikan_kepuasan_mahasiswa(Request $request)
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

       $data_kepuasan_mahasiswa = KepuasanMahasiswa::orderBy('id','DESC')
       ->where('id_prodi','like','%'. $request->filter_prodi .'%')
       ->where('tahun', 'like','%'. $request->filter. '%')
       ->where('id_penunjukan',$penunjukan->id)
       ->where('status', 2)
       ->get();
   }

   if (Auth::user()->role == 'kappm') {

       $data_kepuasan_mahasiswa = KepuasanMahasiswa::orderBy('id','DESC')
       ->where('id_prodi','like','%'. $request->filter_prodi .'%')
       ->where('tahun', 'like','%'. $request->filter. '%')
       ->where('status', 1)
       ->get();
   }


    return view('lkps.pendidikan.kepuasan-mahasiswa.index', compact('data_kepuasan_mahasiswa','prodi','prod','th'));
}

public function lihat_pendidikan_kepuasan_mahasiswa(Request $request)
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

     $data_kepuasan_mahasiswa = KepuasanMahasiswa::orderBy('id','DESC')
     ->where('peid_prodi','like','%'. $request->filter_prodi .'%')
     ->where('tahun', 'like','%'. $request->filter. '%')
     ->where('id_penunjukan',$penunjukan->id)
     ->where('status', 2)
     ->get();
 }

 if (Auth::user()->role == 'auditor') {
    $data_kepuasan_mahasiswa = KepuasanMahasiswa::orderBy('id','DESC')
    ->where('id_prodi','like','%'. $request->filter_prodi .'%')
    ->where('tahun', 'like','%'. $request->filter. '%')
    ->where('status', 1)
    ->get();
}

    return view('lkps.pendidikan.kepuasan-mahasiswa.lihat_laporan',compact('data_kepuasan_mahasiswa','prodi','prod','th'));
}
}
