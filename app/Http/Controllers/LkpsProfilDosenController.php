<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use File;
use DB;
use Illuminate\Support\Facades\Storage;
use App\DosenTetapPerguruanTinggi;
use App\DosenUtamaTugasAkhir;
use App\EwmpDosenTetapPerguruanTinggi;
use App\DosenTidakTetap;
use App\DosenIndustri;
use App\Dosen;
use App\Prodi;

class LkpsProfilDosenController extends Controller
{
    public function profil_dosen_dosen_tetap_perguruan_tinggi(Request $request)
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

     if (Auth::user()->role == 'auditor') {
       $penunjukan = DB::table('penunjukan_auditor')
       ->select('penunjukan_auditor.id')
       ->where('penunjukan_auditor.id_user_auditor1','like','%'. Auth::user()->id .'%')
       ->orwhere('penunjukan_auditor.id_user_auditor2','like','%'. Auth::user()->id .'%')
       ->first();

       $data_dosen_perguruantinggi = DB::table('dosen_tetap_perguruantinggi')
       ->join('dosen', 'dosen_tetap_perguruantinggi.id_dosen', '=', 'dosen.id')
       ->select('dosen_tetap_perguruantinggi.*', 'dosen.nama_dosen')
       ->orderBy('id', 'DESC')
       ->where('dosen_tetap_perguruantinggi.id_prodi','like','%'. $request->filter_prodi .'%')
       ->where('id_penunjukan',$penunjukan->id)
       ->where('status', 2)
       ->get();
   }  

   if (Auth::user()->role == 'kappm') {

       $data_dosen_perguruantinggi = DB::table('dosen_tetap_perguruantinggi')
       ->join('dosen', 'dosen_tetap_perguruantinggi.id_dosen', '=', 'dosen.id')
       ->select('dosen_tetap_perguruantinggi.*', 'dosen.nama_dosen')
       ->orderBy('id', 'DESC')
       ->where('dosen_tetap_perguruantinggi.id_prodi','like','%'. $request->filter_prodi .'%')
       ->where('status', 1)
       ->get();

   }




   return view('lkps.profil-dosen.dosen-tetap-perguruan-tinggi.index',compact('data_dosen_perguruantinggi','prodi','prod'));
}



public function profil_dosen_dosen_pembimbing_utama_tugas_akhir(Request $request)
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


   $data_dospem_utama_tugasakhir = DB::table('dospem_utama_tugasakhir')
   ->join('dosen', 'dospem_utama_tugasakhir.id_dosen', '=', 'dosen.id')
   ->select('dospem_utama_tugasakhir.*', 'dosen.nama_dosen')
   ->orderBy('id', 'DESC')
   ->where('dospem_utama_tugasakhir.id_prodi','like','%'. $request->filter_prodi .'%')
   ->where('tahun_akademik', 'like','%'. $request->filter. '%')
   ->where('id_penunjukan',$penunjukan->id)
   ->where('status', 2)
   ->get();

   foreach ($data_dospem_utama_tugasakhir as $key => $value) {

       $rata2_1 = ($value->jumlahMahasiswa_prodiDiakreditasi_ts2 + $value->jumlahMahasiswa_prodiDiakreditasi_ts1 + $value->jumlahMahasiswa_prodiDiakreditasi_ts)/3;
       $rata2_2 = ($value->jumlahMahasiswa_prodiLain_perguruanTinggi_ts2 + $value->jumlahMahasiswa_prodiLain_perguruanTinggi_ts1 + $value->jumlahMahasiswa_prodiLain_perguruanTinggi_ts)/3;
       $rata2_bimbingan = ($rata2_1 +  $rata2_2)/2;

       $value->rata2_1 = round($rata2_1, 2);
       $value->rata2_2 = round($rata2_2, 2);
       $value->rata2_bimbingan = round($rata2_bimbingan, 2);

   }

}  

if (Auth::user()->role == 'kappm') {

    $data_dospem_utama_tugasakhir = DB::table('dospem_utama_tugasakhir')
    ->join('dosen', 'dospem_utama_tugasakhir.id_dosen', '=', 'dosen.id')
    ->select('dospem_utama_tugasakhir.*', 'dosen.nama_dosen')
    ->orderBy('id', 'DESC')
    ->where('dospem_utama_tugasakhir.id_prodi','like','%'. $request->filter_prodi .'%')
    ->where('tahun_akademik', 'like','%'. $request->filter. '%')
    ->where('status', 1)
    ->get();

    foreach ($data_dospem_utama_tugasakhir as $key => $value) {

     $rata2_1 = ($value->jumlahMahasiswa_prodiDiakreditasi_ts2 + $value->jumlahMahasiswa_prodiDiakreditasi_ts1 + $value->jumlahMahasiswa_prodiDiakreditasi_ts)/3;
     $rata2_2 = ($value->jumlahMahasiswa_prodiLain_perguruanTinggi_ts2 + $value->jumlahMahasiswa_prodiLain_perguruanTinggi_ts1 + $value->jumlahMahasiswa_prodiLain_perguruanTinggi_ts)/3;
     $rata2_bimbingan = ($rata2_1 +  $rata2_2)/2;

     $value->rata2_1 = round($rata2_1, 2);
     $value->rata2_2 = round($rata2_2, 2);
     $value->rata2_bimbingan = round($rata2_bimbingan, 2);

 }

}         


return view('lkps.profil-dosen.dosen-pembimbing-utama-tugas-akhir.index',compact('data_dospem_utama_tugasakhir','prodi','prod','th'));
}



public function lihat_profil_dosen_dosen_pembimbing_utama_tugas_akhir()
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


   $data_dospem_utama_tugasakhir = DB::table('dospem_utama_tugasakhir')
   ->join('dosen', 'dospem_utama_tugasakhir.id_dosen', '=', 'dosen.id')
   ->select('dospem_utama_tugasakhir.*', 'dosen.nama_dosen')
   ->orderBy('id', 'DESC')
   ->where('dospem_utama_tugasakhir.id_prodi','like','%'. $request->filter_prodi .'%')
   ->where('tahun_akademik', 'like','%'. $request->filter. '%')
   ->where('id_penunjukan',$penunjukan->id)
   ->where('status', 2)
   ->get();

   foreach ($data_dospem_utama_tugasakhir as $key => $value) {

     $rata2_1 = ($value->jumlahMahasiswa_prodiDiakreditasi_ts2 + $value->jumlahMahasiswa_prodiDiakreditasi_ts1 + $value->jumlahMahasiswa_prodiDiakreditasi_ts)/3;
     $rata2_2 = ($value->jumlahMahasiswa_prodiLain_perguruanTinggi_ts2 + $value->jumlahMahasiswa_prodiLain_perguruanTinggi_ts1 + $value->jumlahMahasiswa_prodiLain_perguruanTinggi_ts)/3;
     $rata2_bimbingan = ($rata2_1 +  $rata2_2)/2;

     $value->rata2_1 = round($rata2_1, 2);
     $value->rata2_2 = round($rata2_2, 2);
     $value->rata2_bimbingan = round($rata2_bimbingan, 2);

 }

}

if (Auth::user()->role == 'kappm') {

    $data_dospem_utama_tugasakhir = DB::table('dospem_utama_tugasakhir')
    ->join('dosen', 'dospem_utama_tugasakhir.id_dosen', '=', 'dosen.id')
    ->select('dospem_utama_tugasakhir.*', 'dosen.nama_dosen')
    ->orderBy('id', 'DESC')
    ->where('dospem_utama_tugasakhir.id_prodi','like','%'. $request->filter_prodi .'%')
    ->where('tahun_akademik', 'like','%'. $request->filter. '%')
    ->where('status', 1)
    ->get();

    foreach ($data_dospem_utama_tugasakhir as $key => $value) {

     $rata2_1 = ($value->jumlahMahasiswa_prodiDiakreditasi_ts2 + $value->jumlahMahasiswa_prodiDiakreditasi_ts1 + $value->jumlahMahasiswa_prodiDiakreditasi_ts)/3;
     $rata2_2 = ($value->jumlahMahasiswa_prodiLain_perguruanTinggi_ts2 + $value->jumlahMahasiswa_prodiLain_perguruanTinggi_ts1 + $value->jumlahMahasiswa_prodiLain_perguruanTinggi_ts)/3;
     $rata2_bimbingan = ($rata2_1 +  $rata2_2)/2;

     $value->rata2_1 = round($rata2_1, 2);
     $value->rata2_2 = round($rata2_2, 2);
     $value->rata2_bimbingan = round($rata2_bimbingan, 2);

 }

}


return view('lkps.profil-dosen.dosen-pembimbing-utama-tugas-akhir.lihat_laporan',compact('data_dospem_utama_tugasakhir','prodi','prod','th'));
}

public function profil_dosen_ewmp_dosen_tetap_perguruan_tinggi(Request $request)
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

   $data_ewmp_dosen = DB::table('ewmp_dosentetap_perguruantinggi')
   ->join('dosen', 'ewmp_dosentetap_perguruantinggi.id_dosen', '=', 'dosen.id')
   ->select('ewmp_dosentetap_perguruantinggi.*', 'dosen.nama_dosen')
   ->orderBy('id', 'DESC')
   ->where('ewmp_dosentetap_perguruantinggi.id_prodi','like','%'. $request->filter_prodi .'%')
   ->where('tahun', 'like','%'. $request->filter. '%')
   ->where('id_penunjukan',$penunjukan->id)
   ->where('status', 2)
   ->get();

   foreach ($data_ewmp_dosen as $key => $value) {

    $jumlah_sks = $value->ewmp_pendidikanProdi_diakreditasi + $value->ewmp_pendidikanProdiLain_didalamPerguruanTinggi + $value->ewmp_pendidikanProdiLain_diluarPerguruanTinggi + $value->ewmp_penelitian + $value->ewmp_pkm + $value->ewmp_tugas_tambahan;
    $rata2_per_semester = $jumlah_sks/2;

    $value->jumlah_sks = round($jumlah_sks, 2);
    $value->rata2_per_semester = round($rata2_per_semester, 2);

}
}

if (Auth::user()->role == 'kappm') {
 $data_ewmp_dosen = DB::table('ewmp_dosentetap_perguruantinggi')
 ->join('dosen', 'ewmp_dosentetap_perguruantinggi.id_dosen', '=', 'dosen.id')
 ->select('ewmp_dosentetap_perguruantinggi.*', 'dosen.nama_dosen')
 ->orderBy('id', 'DESC')
 ->where('ewmp_dosentetap_perguruantinggi.id_prodi','like','%'. $request->filter_prodi .'%')
 ->where('tahun', 'like','%'. $request->filter. '%')
 ->where('status', 1)
 ->get();

 foreach ($data_ewmp_dosen as $key => $value) {

    $jumlah_sks = $value->ewmp_pendidikanProdi_diakreditasi + $value->ewmp_pendidikanProdiLain_didalamPerguruanTinggi + $value->ewmp_pendidikanProdiLain_diluarPerguruanTinggi + $value->ewmp_penelitian + $value->ewmp_pkm + $value->ewmp_tugas_tambahan;
    $rata2_per_semester = $jumlah_sks/2;

    $value->jumlah_sks = round($jumlah_sks, 2);
    $value->rata2_per_semester = round($rata2_per_semester, 2);

}
}

return view('lkps.profil-dosen.ewmp-dosen-tetap-perguruan-tinggi.index',compact('data_ewmp_dosen','prodi','prod','th'));
}



public function lihat_profil_dosen_ewmp_dosen_tetap_perguruan_tinggi(Request $request)
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

       $data_ewmp_dosen = DB::table('ewmp_dosentetap_perguruantinggi')
       ->join('dosen', 'ewmp_dosentetap_perguruantinggi.id_dosen', '=', 'dosen.id')
       ->select('ewmp_dosentetap_perguruantinggi.*', 'dosen.nama_dosen')
       ->orderBy('id', 'DESC')
       ->where('ewmp_dosentetap_perguruantinggi.id_prodi','like','%'. $request->filter_prodi .'%')
       ->where('tahun', 'like','%'. $request->filter. '%')
       ->where('id_penunjukan',$penunjukan->id)
       ->where('status', 2)
       ->get();


       foreach ($data_ewmp_dosen as $key => $value) {

        $jumlah_sks = $value->ewmp_pendidikanProdi_diakreditasi + $value->ewmp_pendidikanProdiLain_didalamPerguruanTinggi + $value->ewmp_pendidikanProdiLain_diluarPerguruanTinggi + $value->ewmp_penelitian + $value->ewmp_pkm + $value->ewmp_tugas_tambahan;
        $rata2_per_semester = $jumlah_sks/2;

        $value->jumlah_sks = round($jumlah_sks, 2);
        $value->rata2_per_semester = round($rata2_per_semester, 2);
    }
}

if (Auth::user()->role == 'kappm') {
    $data_ewmp_dosen = DB::table('ewmp_dosentetap_perguruantinggi')
    ->join('dosen', 'ewmp_dosentetap_perguruantinggi.id_dosen', '=', 'dosen.id')
    ->select('ewmp_dosentetap_perguruantinggi.*', 'dosen.nama_dosen')
    ->orderBy('id', 'DESC')
    ->where('ewmp_dosentetap_perguruantinggi.id_prodi','like','%'. $request->filter_prodi .'%')
    ->where('tahun', 'like','%'. $request->filter. '%')
    ->where('status', 1)
    ->get();


    foreach ($data_ewmp_dosen as $key => $value) {

        $jumlah_sks = $value->ewmp_pendidikanProdi_diakreditasi + $value->ewmp_pendidikanProdiLain_didalamPerguruanTinggi + $value->ewmp_pendidikanProdiLain_diluarPerguruanTinggi + $value->ewmp_penelitian + $value->ewmp_pkm + $value->ewmp_tugas_tambahan;
        $rata2_per_semester = $jumlah_sks/2;

        $value->jumlah_sks = round($jumlah_sks, 2);
        $value->rata2_per_semester = round($rata2_per_semester, 2);
    }

}

return view('lkps.profil-dosen.ewmp-dosen-tetap-perguruan-tinggi.lihat_laporan',compact('data_ewmp_dosen','prodi','prod','th'));
}

public function profil_dosen_dosen_tidak_tetap(Request $request)
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

     $dosen_tidak_tetap = DB::table('dosen_tidak_tetap')
     ->join('dosen', 'dosen_tidak_tetap.id_dosen', '=', 'dosen.id')
     ->select('dosen_tidak_tetap.*', 'dosen.nama_dosen')
     ->orderBy('id', 'DESC')
     ->where('dosen_tidak_tetap.id_prodi','like','%'. $request->filter_prodi .'%')
     ->where('tahun', 'like','%'. $request->filter. '%')
     ->where('id_penunjukan',$penunjukan->id)
     ->where('status', 2)
     ->get();
 }

 if (Auth::user()->role == 'kappm') {
     $dosen_tidak_tetap = DB::table('dosen_tidak_tetap')
     ->join('dosen', 'dosen_tidak_tetap.id_dosen', '=', 'dosen.id')
     ->select('dosen_tidak_tetap.*', 'dosen.nama_dosen')
     ->orderBy('id', 'DESC')
     ->where('dosen_tidak_tetap.id_prodi','like','%'. $request->filter_prodi .'%')
     ->where('tahun', 'like','%'. $request->filter. '%')
     ->where('status', 1)
     ->get();
 }

 return view('lkps.profil-dosen.dosen-tidak-tetap.index',compact('dosen_tidak_tetap','prodi','prod','th'));
}


public function profil_dosen_dosen_industri_praktisi(Request $request)
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

   $dosen_industri = DB::table('dosen_industri')
   ->join('dosen', 'dosen_industri.id_dosen', '=', 'dosen.id')
   ->select('dosen_industri.*', 'dosen.nama_dosen')
   ->orderBy('id', 'DESC')
   ->where('dosen_industri.id_prodi','like','%'. $request->filter_prodi .'%')
   ->where('tahun', 'like','%'. $request->filter. '%')
   ->where('id_penunjukan',$penunjukan->id)
   ->where('status', 2)
   ->get();

}

if (Auth::user()->role == 'kappm') {
 $dosen_industri = DB::table('dosen_industri')
   ->join('dosen', 'dosen_industri.id_dosen', '=', 'dosen.id')
   ->select('dosen_industri.*', 'dosen.nama_dosen')
   ->orderBy('id', 'DESC')
   ->where('dosen_industri.id_prodi','like','%'. $request->filter_prodi .'%')
   ->where('tahun', 'like','%'. $request->filter. '%')
   ->where('status', 1)
   ->get();

}

return view('lkps.profil-dosen.dosen-industri-praktisi.index',compact('dosen_industri','prodi','prod','th'));
}
}
