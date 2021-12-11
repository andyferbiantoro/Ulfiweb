<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PenelitianDtps;
use App\PengakuanDtps;
use App\Dosen;
use App\PkmDtps;
use App\PagelaranIlmiahDtps;
use App\KaryaIlmiahDtps;
USE App\ProdukDtps;
use App\LuaranPenelitianDtpsBagian1;
use App\LuaranPenelitianDtpsBagian2;
use App\LuaranPenelitianDtpsBagian3;
use App\LuaranPenelitianDtpsBagian4;
use App\Prodi;
use Auth;
use DB;
use File;
use Illuminate\Support\Facades\Storage;


class LkpsKinerjaDosenController extends Controller
{
    public function kinerja_dosen_pengakuan_rekognisi_dtps(Request $request)
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

         $pengakuan_dtps = DB::table('pengakuan_dtps')
         ->join('dosen', 'pengakuan_dtps.id_dosen', '=', 'dosen.id')
         ->select('pengakuan_dtps.*', 'dosen.nama_dosen')
         ->orderBy('id', 'DESC')
         ->where('pengakuan_dtps.id_prodi','like','%'. $request->filter_prodi .'%')
         ->where('tahun', 'like','%'. $request->filter. '%')
         ->where('pengakuan_dtps.id_penunjukan',$penunjukan->id)
         ->where('status', 2)
         ->get();
     }

     if (Auth::user()->role == 'kappm') {

       $pengakuan_dtps = DB::table('pengakuan_dtps')
       ->join('dosen', 'pengakuan_dtps.id_dosen', '=', 'dosen.id')
       ->select('pengakuan_dtps.*', 'dosen.nama_dosen')
       ->orderBy('id', 'DESC')
       ->where('pengakuan_dtps.id_prodi','like','%'. $request->filter_prodi .'%')
       ->where('tahun', 'like','%'. $request->filter. '%')
       ->where('status', 1)
       ->get();
   }


   return view('lkps.kinerja-dosen.pengakuan-rekognisi-dtps.index',compact('pengakuan_dtps','prodi','prod','th'));
}


public function kinerja_dosen_penelitian_dtps(Request $request)
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

       $data_penelitian_dtps = PenelitianDtps::orderBy('id', 'DESC')
       ->where('id_prodi','like','%'. $request->filter_prodi .'%')
       ->where('tahun_akademik', 'like','%'. $request->filter. '%')
       ->where('id_penunjukan',$penunjukan->id)
       ->where('status', 2)
       ->get();

        $jumlah_all = 0;
       foreach ($data_penelitian_dtps as $key => $value) {

        $jumlah = $value->jumlah_judulPenelitian_ts2 + $value->jumlah_judulPenelitian_ts1 + $value->jumlah_judulPenelitian_ts;

        $value->jumlah = $jumlah;
        $jumlah_all +=$value->jumlah;

    }
        $jumlahts2=PenelitianDtps::where('status', 2)->sum('jumlah_judulPenelitian_ts2');
        $jumlahts1=PenelitianDtps::where('status', 2)->sum('jumlah_judulPenelitian_ts1');
        $jumlahts=PenelitianDtps::where('status', 2)->sum('jumlah_judulPenelitian_ts');
        $jumlah_all = $jumlah_all;
}


if (Auth::user()->role == 'kappm') {

   $data_penelitian_dtps = PenelitianDtps::orderBy('id', 'DESC')
   ->where('id_prodi','like','%'. $request->filter_prodi .'%')
   ->where('tahun_akademik', 'like','%'. $request->filter. '%')
   ->where('status', 1)
   ->get();

    $jumlah_all = 0;
   foreach ($data_penelitian_dtps as $key => $value) {

    $jumlah = $value->jumlah_judulPenelitian_ts2 + $value->jumlah_judulPenelitian_ts1 + $value->jumlah_judulPenelitian_ts;

    $value->jumlah = $jumlah;
    $jumlah_all +=$value->jumlah;

}
        $jumlahts2=PenelitianDtps::where('status', 1)->sum('jumlah_judulPenelitian_ts2');
        $jumlahts1=PenelitianDtps::where('status', 1)->sum('jumlah_judulPenelitian_ts1');
        $jumlahts=PenelitianDtps::where('status', 1)->sum('jumlah_judulPenelitian_ts');
        $jumlah_all = $jumlah_all;
}

return view('lkps.kinerja-dosen.penelitian-dtps.index',compact('data_penelitian_dtps','prodi','prod','th','jumlahts2','jumlahts1','jumlahts','jumlah_all'));
}



public function lihat_kinerja_dosen_penelitian_dtps(Request $request)
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


     $data_penelitian_dtps = PenelitianDtps::orderBy('id', 'DESC')
     ->where('id_prodi','like','%'. $request->filter_prodi .'%')
     ->where('tahun_akademik', 'like','%'. $request->filter. '%')
     ->where('id_penunjukan',$penunjukan->id)
     ->where('status', 2)
     ->get();

     foreach ($data_penelitian_dtps as $key => $value) {

        $jumlah = $value->jumlah_judulPenelitian_ts2 + $value->jumlah_judulPenelitian_ts1 + $value->jumlah_judulPenelitian_ts;

        $value->jumlah = $jumlah;
    }
}


if (Auth::user()->role == 'kappm') {
   $data_penelitian_dtps = PenelitianDtps::orderBy('id', 'DESC')
   ->where('id_prodi','like','%'. $request->filter_prodi .'%')
   ->where('tahun_akademik', 'like','%'. $request->filter. '%')
   ->where('status', 1)
   ->get();

   foreach ($data_penelitian_dtps as $key => $value) {

    $jumlah = $value->jumlah_judulPenelitian_ts2 + $value->jumlah_judulPenelitian_ts1 + $value->jumlah_judulPenelitian_ts;

    $value->jumlah = $jumlah;
}
}


return view('lkps.kinerja-dosen.penelitian-dtps.lihat_laporan',compact('data_penelitian_dtps','prodi','prod','th'));
}



public function kinerja_dosen_pengabdian_kepada_masyarakat_dtps(Request $request)
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

     $data_pkm_dtps = PkmDtps::orderBy('id', 'DESC')
     ->where('id_prodi','like','%'. $request->filter_prodi .'%')
     ->where('tahun_akademik', 'like','%'. $request->filter. '%')
     ->where('id_penunjukan',$penunjukan->id)
     ->where('status', 2)
     ->get();

     $jumlah_all = 0;
     foreach ($data_pkm_dtps as $key => $value) {

        $jumlah = $value->jumlah_judulPkm_ts2 + $value->jumlah_judulPkm_ts1 + $value->jumlah_judulPkm_ts;

        $value->jumlah = $jumlah;
        $jumlah_all +=$value->jumlah;

    }
    $jumlahts2=PkmDtps::where('status', 2)->sum('jumlah_judulPkm_ts2');
    $jumlahts1=PkmDtps::where('status', 2)->sum('jumlah_judulPkm_ts1');
    $jumlahts=PkmDtps::where('status', 2)->sum('jumlah_judulPkm_ts');
    $jumlah_all = $jumlah_all;
}   

if (Auth::user()->role == 'kappm') {
   $data_pkm_dtps = PkmDtps::orderBy('id', 'DESC')
   ->where('id_prodi','like','%'. $request->filter_prodi .'%')
   ->where('tahun_akademik', 'like','%'. $request->filter. '%')
   ->where('status', 1)
   ->get();

   $jumlah_all = 0;
   foreach ($data_pkm_dtps as $key => $value) {

    $jumlah = $value->jumlah_judulPkm_ts2 + $value->jumlah_judulPkm_ts1 + $value->jumlah_judulPkm_ts;

    $value->jumlah = $jumlah;
    $jumlah_all +=$value->jumlah;

}
$jumlahts2=PkmDtps::where('status', 1)->sum('jumlah_judulPkm_ts2');
$jumlahts1=PkmDtps::where('status', 1)->sum('jumlah_judulPkm_ts1');
$jumlahts=PkmDtps::where('status', 1)->sum('jumlah_judulPkm_ts');
$jumlah_all = $jumlah_all;
}


return view('lkps.kinerja-dosen.pengabdian-kepada-masyarakat-dtps.index',compact('data_pkm_dtps','prodi','prod','th','jumlahts2','jumlahts1','jumlahts','jumlah_all'));
}


public function lihat_kinerja_dosen_pengabdian_kepada_masyarakat_dtps(Request $request)
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


       $data_pkm_dtps = PkmDtps::orderBy('id', 'DESC')
       ->where('id_prodi','like','%'. $request->filter_prodi .'%')
       ->where('tahun_akademik', 'like','%'. $request->filter. '%')
       ->where('id_penunjukan',$penunjukan->id)
       ->where('status', 2)
       ->get();

       foreach ($data_pkm_dtps as $key => $value) {

        $jumlah = $value->jumlah_judulPkm_ts2 + $value->jumlah_judulPkm_ts1 + $value->jumlah_judulPkm_ts;

        $value->jumlah = $jumlah;

    }
 }

if (Auth::user()->role == 'kappm') {
    $data_pkm_dtps = PkmDtps::orderBy('id', 'DESC')
    ->where('id_prodi','like','%'. $request->filter_prodi .'%')
    ->where('tahun_akademik', 'like','%'. $request->filter. '%')
    ->where('status', 1)
    ->get();

    foreach ($data_pkm_dtps as $key => $value) {

        $jumlah = $value->jumlah_judulPkm_ts2 + $value->jumlah_judulPkm_ts1 + $value->jumlah_judulPkm_ts;

        $value->jumlah = $jumlah;

    }
}

return view('lkps.kinerja-dosen.pengabdian-kepada-masyarakat-dtps.lihat_laporan',compact('data_pkm_dtps','prodi','prod','th'));
}


public function kinerja_dosen_pagelaran_pameran_prestasi_publikasi_ilmiah_dtps(Request $request)
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

   $data_ilmiah_dtps = PagelaranIlmiahDtps::orderBy('id', 'DESC')
   ->where('id_prodi','like','%'. $request->filter_prodi .'%')
   ->where('tahun_akademik', 'like','%'. $request->filter. '%')
   ->where('id_penunjukan',$penunjukan->id)
   ->where('status', 2)
   ->get();

   $jumlah_all = 0;
   foreach ($data_ilmiah_dtps as $key => $value) {

    $jumlah = $value->jumlah_judul_ts2 + $value->jumlah_judul_ts1 + $value->jumlah_judul_ts;

    $value->jumlah = $jumlah;
    $jumlah_all +=$value->jumlah;

}
       $jumlahts2=PagelaranIlmiahDtps::where('status', 2)->sum('jumlah_judul_ts2');
        $jumlahts1=PagelaranIlmiahDtps::where('status', 2)->sum('jumlah_judul_ts1');
        $jumlahts=PagelaranIlmiahDtps::where('status', 2)->sum('jumlah_judul_ts');
        $total_jumlah = $value->jumlah;
        $jumlah_all = $jumlah_all;

}

if (Auth::user()->role == 'kappm') {

   $data_ilmiah_dtps = PagelaranIlmiahDtps::orderBy('id', 'DESC')
   ->where('id_prodi','like','%'. $request->filter_prodi .'%')
   ->where('tahun_akademik', 'like','%'. $request->filter. '%')
   ->where('status', 1)
   ->get();

   $jumlah_all = 0;
   foreach ($data_ilmiah_dtps as $key => $value) {

    $jumlah = $value->jumlah_judul_ts2 + $value->jumlah_judul_ts1 + $value->jumlah_judul_ts;

    $value->jumlah = $jumlah;
    $jumlah_all +=$value->jumlah;

}
$jumlahts2=PagelaranIlmiahDtps::where('status', 1)->sum('jumlah_judul_ts2');
$jumlahts1=PagelaranIlmiahDtps::where('status', 1)->sum('jumlah_judul_ts1');
$jumlahts=PagelaranIlmiahDtps::where('status', 1)->sum('jumlah_judul_ts');
$total_jumlah = $value->jumlah;
$jumlah_all = $jumlah_all;
}



return view('lkps.kinerja-dosen.pagelaran-pameran-prestasi-publikasi-ilmiah-dtps.index',compact('data_ilmiah_dtps','prodi','prod','th','jumlahts2','jumlahts1','jumlahts','total_jumlah','jumlah_all'));
}


public function lihat_kinerja_dosen_pagelaran_pameran_prestasi_publikasi_ilmiah_dtps(Request $request)
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

     $data_ilmiah_dtps = PagelaranIlmiahDtps::orderBy('id', 'DESC')
     ->where('id_prodi','like','%'. $request->filter_prodi .'%')
     ->where('tahun_akademik', 'like','%'. $request->filter. '%')
     ->where('id_penunjukan',$penunjukan->id)
     ->where('status', 2)
     ->get();

     foreach ($data_ilmiah_dtps as $key => $value) {

        $jumlah = $value->jumlah_judul_ts2 + $value->jumlah_judul_ts1 + $value->jumlah_judul_ts;

        $value->jumlah = $jumlah;

    }
}


if (Auth::user()->role == 'kappm') {

   $data_ilmiah_dtps = PagelaranIlmiahDtps::orderBy('id', 'DESC')
   ->where('id_prodi','like','%'. $request->filter_prodi .'%')
   ->where('tahun_akademik', 'like','%'. $request->filter. '%')
   ->where('status', 1)
   ->get();

   foreach ($data_ilmiah_dtps as $key => $value) {

    $jumlah = $value->jumlah_judul_ts2 + $value->jumlah_judul_ts1 + $value->jumlah_judul_ts;

    $value->jumlah = $jumlah;

}
}


return view('lkps.kinerja-dosen.pagelaran-pameran-prestasi-publikasi-ilmiah-dtps.lihat_laporan',compact('data_ilmiah_dtps','prodi','prod','th'));
}

public function kinerja_dosen_karya_ilmiah_dtps_yang_disitasi(Request $request)
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

   $karya_ilmiah_dtps = DB::table('karya_ilmiah_dtps')
   ->join('dosen', 'karya_ilmiah_dtps.id_dosen', '=', 'dosen.id')
   ->select('karya_ilmiah_dtps.*', 'dosen.nama_dosen')
   ->orderBy('id', 'DESC')
   ->where('karya_ilmiah_dtps.id_prodi','like','%'. $request->filter_prodi .'%')
   ->where('tahun', 'like','%'. $request->filter. '%')
   ->where('id_penunjukan',$penunjukan->id)
   ->where('status', 2)
   ->get();

}

if (Auth::user()->role == 'kappm') {

    $karya_ilmiah_dtps = DB::table('karya_ilmiah_dtps')
    ->join('dosen', 'karya_ilmiah_dtps.id_dosen', '=', 'dosen.id')
    ->select('karya_ilmiah_dtps.*', 'dosen.nama_dosen')
    ->orderBy('id', 'DESC')
    ->where('karya_ilmiah_dtps.id_prodi','like','%'. $request->filter_prodi .'%')
    ->where('tahun', 'like','%'. $request->filter. '%')
    ->where('status', 1)
    ->get();
}



return view('lkps.kinerja-dosen.karya-ilmiah-dtps-yang-disitasi.index',compact('karya_ilmiah_dtps','prodi','prod','th'));
}

public function kinerja_dosen_produk_jasa_dtps_diadopsi_oleh_industri_masyarakat(Request $request)
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

   $produk_dtps = DB::table('produk_dtps')
   ->join('dosen', 'produk_dtps.id_dosen', '=', 'dosen.id')
   ->select('produk_dtps.*', 'dosen.nama_dosen')
   ->orderBy('id', 'DESC')
   ->where('produk_dtps.id_prodi','like','%'. $request->filter_prodi .'%')
   ->where('tahun', 'like','%'. $request->filter. '%')
   ->where('id_penunjukan',$penunjukan->id)
   ->where('status', 2)
   ->get();
}


if (Auth::user()->role == 'kappm') {

    $produk_dtps = DB::table('produk_dtps')
    ->join('dosen', 'produk_dtps.id_dosen', '=', 'dosen.id')
    ->select('produk_dtps.*', 'dosen.nama_dosen')
    ->orderBy('id', 'DESC')
    ->where('produk_dtps.id_prodi','like','%'. $request->filter_prodi .'%')
    ->where('tahun', 'like','%'. $request->filter. '%')
    ->where('status', 1)
    ->get();
}



return view('lkps.kinerja-dosen.produk-jasa-dtps-diadopsi-oleh-industri-masyarakat.index', compact('produk_dtps','prodi','prod','th'));
}


    // public function kinerja_dosen_luaran_penelitian_pkm_lainnya_oleh_dtps()
    // {
    //      return view('lkps.kinerja-dosen.luaran-penelitian-pkm-lainnya-oleh-dtps.index');
    // }

public function kinerja_dosen_hki_paten(Request $request)
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

     $data_hki = LuaranPenelitianDtpsBagian1::orderBy('id','DESC')
     ->where('id_prodi','like','%'. $request->filter_prodi .'%')
     ->where('tahun', 'like','%'. $request->filter. '%')
     ->where('id_penunjukan',$penunjukan->id)
     ->where('status', 2)
     ->get();
 }


 if (Auth::user()->role == 'kappm') {

     $data_hki = LuaranPenelitianDtpsBagian1::orderBy('id','DESC')
     ->where('id_prodi','like','%'. $request->filter_prodi .'%')
     ->where('tahun', 'like','%'. $request->filter. '%')
     ->where('status', 1)
     ->get();
 }

 return view('lkps.kinerja-dosen.luaran-penelitian-pkm-lainnya-oleh-dtps.hki-paten.index',compact('data_hki','prodi','prod','th'));
}

public function kinerja_dosen_hki_hak_cipta(Request $request)
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

   $data_hki_hak_cipta = LuaranPenelitianDtpsBagian2::orderBy('id','DESC')
   ->where('id_prodi','like','%'. $request->filter_prodi .'%')
   ->where('tahun', 'like','%'. $request->filter. '%')
   ->where('id_penunjukan',$penunjukan->id)
   ->where('status', 2)
   ->get();
}


if (Auth::user()->role == 'kappm') {

   $data_hki_hak_cipta = LuaranPenelitianDtpsBagian2::orderBy('id','DESC')
   ->where('id_prodi','like','%'. $request->filter_prodi .'%')
   ->where('tahun', 'like','%'. $request->filter. '%')
   ->where('status', 1)
   ->get();
}


 return view('lkps.kinerja-dosen.luaran-penelitian-pkm-lainnya-oleh-dtps.hki-hak-cipta.index',compact('data_hki_hak_cipta','prodi','prod','th'));
}

public function kinerja_dosen_teknologi_tepat_guna(Request $request)
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

             $data_teknologi_tepat_guna = LuaranPenelitianDtpsBagian3::orderBy('id','DESC')
             ->where('id_prodi','like','%'. $request->filter_prodi .'%')
             ->where('tahun', 'like','%'. $request->filter. '%')
             ->where('id_penunjukan',$penunjukan->id)
             ->where('status', 2)
             ->get();

         }

         if (Auth::user()->role == 'kappm') {

           $data_teknologi_tepat_guna = LuaranPenelitianDtpsBagian3::orderBy('id','DESC')
           ->where('id_prodi','like','%'. $request->filter_prodi .'%')
           ->where('tahun', 'like','%'. $request->filter. '%')
           ->where('status', 1)
           ->get();

       }

   return view('lkps.kinerja-dosen.luaran-penelitian-pkm-lainnya-oleh-dtps.teknologi-tepat-guna.index',compact('data_teknologi_tepat_guna','prodi','prod','th'));
}

public function kinerja_dosen_buku_berisbn(Request $request)
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

     $data_buku_berisbn = LuaranPenelitianDtpsBagian4::orderBy('id','DESC')
     ->where('id_prodi','like','%'. $request->filter_prodi .'%')
     ->where('tahun', 'like','%'. $request->filter. '%')
     ->where('id_penunjukan',$penunjukan->id)
     ->where('status', 2)
     ->get();
 }

 if (Auth::user()->role == 'kappm') {

     $data_buku_berisbn = LuaranPenelitianDtpsBagian4::orderBy('id','DESC')
     ->where('id_prodi','like','%'. $request->filter_prodi .'%')
     ->where('tahun', 'like','%'. $request->filter. '%')
     ->where('status', 1)
     ->get();
 }

   return view('lkps.kinerja-dosen.luaran-penelitian-pkm-lainnya-oleh-dtps.buku-berisbn.index',compact('data_buku_berisbn','prodi','prod','th'));
}
}
