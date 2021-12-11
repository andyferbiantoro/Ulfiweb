<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\IpkLulusan;
use App\PrestasiAkademikMahasiswa;
use App\PrestasiNonAkademikMahasiswa;
use App\MasaStudiLulusanD3;
use App\MasaStudiLulusanSarjanaTerapan;
use App\WaktuTungguLulusanD3;
use App\WaktuTungguLulusanSarjanaTerapan;
use App\KesesuaianBidangkerjaLulusan;
use App\TempatKerjaLulusan;
use App\ReferensiKepuasanPengguna;
use App\KepuasanPenggunaLulusan;
use App\PagelaranIlmiahMahasiswa;
use App\ProdukMahasiswa;
use App\LuaranPenelitianMahasiswaBagian1;
use App\LuaranPenelitianMahasiswaBagian2;
use App\LuaranPenelitianMahasiswaBagian3;
use App\LuaranPenelitianMahasiswaBagian4;
use App\Prodi;
use Auth;
use DB;
use File;
use Illuminate\Support\Facades\Storage;

class LkpsLuaranDanCapaianTridharmaController extends Controller
{
    // ==================================IPK=========================

    public function ipk_lulusan(Request $request)
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

           $ipk_lulusan = IpkLulusan::orderBy('id', 'DESC')
           ->where('id_prodi','like','%'. $request->filter_prodi .'%')
           ->where('tahun_lulus', 'like','%'. $request->filter. '%')
           ->where('id_penunjukan',$penunjukan->id)
           ->where('status', 2)
           ->get();

       }

       if (Auth::user()->role == 'kappm') {

           $ipk_lulusan = IpkLulusan::orderBy('id', 'DESC')
           ->where('id_prodi','like','%'. $request->filter_prodi .'%')
           ->where('tahun_lulus', 'like','%'. $request->filter. '%')
           ->where('status', 1)
           ->get();

       }

        return view('lkps.luaran-dan-capaian-tridharma.ipk-lulusan.index',compact('ipk_lulusan','prodi','prod','th'));
    }


    public function lihat_ipk_lulusan(Request $request)
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

       $ipk_lulusan = IpkLulusan::orderBy('id', 'DESC')
           ->where('id_prodi','like','%'. $request->filter_prodi .'%')
           ->where('tahun_lulus', 'like','%'. $request->filter. '%')
           ->where('id_penunjukan',$penunjukan->id)
           ->where('status', 2)
           ->get();

       }

       if (Auth::user()->role == 'kappm') {

         $ipk_lulusan = IpkLulusan::orderBy('id', 'DESC')
           ->where('id_prodi','like','%'. $request->filter_prodi .'%')
           ->where('tahun_lulus', 'like','%'. $request->filter. '%')
           ->where('status', 1)
           ->get();
       }


        $ipk_lulusan = IpkLulusan::orderBy('id', 'DESC')->get();

        return view('lkps.luaran-dan-capaian-tridharma.ipk-lulusan.lihat_laporan',compact('ipk_lulusan','prodi','prod','th'));
    }

    // ==================================Prestasi Mahasiswa=========================

    public function prestasi_akademik_mahasiswa(Request $request)
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

               $prestasi_akademik_mahasiswa = PrestasiAkademikMahasiswa::orderBy('id', 'DESC')
               ->where('id_prodi','like','%'. $request->filter_prodi .'%')
               ->where('tahun_perolehan', 'like','%'. $request->filter. '%')
               ->where('id_penunjukan',$penunjukan->id)
               ->where('status', 2)
               ->get();
           }

           if (Auth::user()->role == 'kappm') {
            $prestasi_akademik_mahasiswa = PrestasiAkademikMahasiswa::orderBy('id', 'DESC')
            ->where('id_prodi','like','%'. $request->filter_prodi .'%')
            ->where('tahun_perolehan', 'like','%'. $request->filter. '%')
            ->where('status', 1)
            ->get();

        }


        return view('lkps.luaran-dan-capaian-tridharma.prestasi-mahasiswa.prestasi-akademik-mahasiswa.index',compact('prestasi_akademik_mahasiswa','prodi','prod','th'));
    }

    public function prestasi_non_akademik_mahasiswa(Request $request)
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

             $prestasi_non_akademik_mahasiswa = PrestasiNonAkademikMahasiswa::orderBy('id', 'DESC')
             ->where('id_prodi','like','%'. $request->filter_prodi .'%')
             ->where('tahun_perolehan', 'like','%'. $request->filter. '%')
             ->where('id_penunjukan',$penunjukan->id)
             ->where('status', 2)
             ->get();
         }

         if (Auth::user()->role == 'kappm') {
             $prestasi_non_akademik_mahasiswa = PrestasiNonAkademikMahasiswa::orderBy('id', 'DESC')
             ->where('id_prodi','like','%'. $request->filter_prodi .'%')
             ->where('tahun_perolehan', 'like','%'. $request->filter. '%')
             ->where('status', 1)
             ->get();
         } 


        return view('lkps.luaran-dan-capaian-tridharma.prestasi-mahasiswa.prestasi-non-akademik-mahasiswa.index', compact('prestasi_non_akademik_mahasiswa','prodi','prod','th'));
    }


    // ==================================Efektifitas Dan Produktifitas Pendidikan=========================

    public function masa_studi_lulusan_program_d3(Request $request)
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


             $masastudi_lulusan_d3 = MasaStudiLulusanD3::orderBy('id', 'DESC')
             ->where('id_prodi','like','%'. $request->filter_prodi .'%')
             ->where('tahun_masuk', 'like','%'. $request->filter. '%')
             ->where('id_penunjukan',$penunjukan->id)
             ->where('status', 2)
             ->get();

             foreach ($masastudi_lulusan_d3 as $key => $value) {
               $jumlah_mhs = $value->jumlah_mahasiswaLulus_akhirTs4 + $value->jumlah_mahasiswaLulus_akhirTs3 + $value->jumlah_mahasiswaLulus_akhirTs2 + $value->jumlah_mahasiswaLulus_akhirTs1 + $value->jumlah_mahasiswaLulus_akhirTs;

               $value->jumlah_mhs = $jumlah_mhs;
           }
        }
        

        if (Auth::user()->role == 'kappm') {

           $masastudi_lulusan_d3 = MasaStudiLulusanD3::orderBy('id', 'DESC')
           ->where('id_prodi','like','%'. $request->filter_prodi .'%')
           ->where('tahun_masuk', 'like','%'. $request->filter. '%')
           ->where('status', 1)
           ->get();

           foreach ($masastudi_lulusan_d3 as $key => $value) {
               $jumlah_mhs = $value->jumlah_mahasiswaLulus_akhirTs4 + $value->jumlah_mahasiswaLulus_akhirTs3 + $value->jumlah_mahasiswaLulus_akhirTs2 + $value->jumlah_mahasiswaLulus_akhirTs1 + $value->jumlah_mahasiswaLulus_akhirTs;

               $value->jumlah_mhs = $jumlah_mhs;
           }
       }         

     return view('lkps.luaran-dan-capaian-tridharma.efektifitas-dan-produktifitas-pendidikan.masa-studi-lulusan-pada-program-d3.index',compact('masastudi_lulusan_d3','prodi','prod','th'));
 }

 public function lihat_masa_studi_lulusan_program_d3(Request $request)
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
             
             $masastudi_lulusan_d3 = MasaStudiLulusanD3::orderBy('id', 'DESC')
             ->where('id_prodi','like','%'. $request->filter_prodi .'%')
             ->where('tahun_masuk', 'like','%'. $request->filter. '%')
             ->where('id_penunjukan',$penunjukan->id)
             ->where('status', 2)
             ->get();

             foreach ($masastudi_lulusan_d3 as $key => $value) {

               $jumlah_mhs = $value->jumlah_mahasiswaLulus_akhirTs4 + $value->jumlah_mahasiswaLulus_akhirTs3 + $value->jumlah_mahasiswaLulus_akhirTs2 + $value->jumlah_mahasiswaLulus_akhirTs1 + $value->jumlah_mahasiswaLulus_akhirTs;

               $value->jumlah_mhs = $jumlah_mhs;
           }

    }       

    if (Auth::user()->role == 'kappm') {
        $masastudi_lulusan_d3 = MasaStudiLulusanD3::orderBy('id', 'DESC')
        ->where('id_prodi','like','%'. $request->filter_prodi .'%')
        ->where('tahun_masuk', 'like','%'. $request->filter. '%')
        ->where('status', 1)
        ->get();

             foreach ($masastudi_lulusan_d3 as $key => $value) {

               $jumlah_mhs = $value->jumlah_mahasiswaLulus_akhirTs4 + $value->jumlah_mahasiswaLulus_akhirTs3 + $value->jumlah_mahasiswaLulus_akhirTs2 + $value->jumlah_mahasiswaLulus_akhirTs1 + $value->jumlah_mahasiswaLulus_akhirTs;

               $value->jumlah_mhs = $jumlah_mhs;
           }
    }


 return view('lkps.luaran-dan-capaian-tridharma.efektifitas-dan-produktifitas-pendidikan.masa-studi-lulusan-pada-program-d3.lihat_laporan',compact('masastudi_lulusan_d3','prodi','prod','th'));
}


public function masa_studi_lulusan_program_sarajana_terapan(Request $request)
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

             $masastudi_lulusan_sarajana_terapan = MasaStudiLulusanSarjanaTerapan::orderBy('id', 'DESC')
             ->where('id_prodi','like','%'. $request->filter_prodi .'%')
             ->where('tahun_masuk', 'like','%'. $request->filter. '%')
             ->where('id_penunjukan',$penunjukan->id)
             ->where('status', 2)
             ->get();


             foreach ($masastudi_lulusan_sarajana_terapan as $key => $value) {

                 $jumlah_mhs = $value->jumlah_mahasiswaLulus_akhirTs6 + $value->jumlah_mahasiswaLulus_akhirTs5 + $value->jumlah_mahasiswaLulus_akhirTs4 + $value->jumlah_mahasiswaLulus_akhirTs3 + $value->jumlah_mahasiswaLulus_akhirTs2 + $value->jumlah_mahasiswaLulus_akhirTs1 + $value->jumlah_mahasiswaLulus_akhirTs;

                 $value->jumlah_mhs = $jumlah_mhs;
             }
         }         


         if (Auth::user()->role == 'kappm') {
            $masastudi_lulusan_sarajana_terapan = MasaStudiLulusanSarjanaTerapan::orderBy('id', 'DESC')
            ->where('id_prodi','like','%'. $request->filter_prodi .'%')
            ->where('tahun_masuk', 'like','%'. $request->filter. '%')
            ->where('status', 1)
            ->get();


            foreach ($masastudi_lulusan_sarajana_terapan as $key => $value) {

               $jumlah_mhs = $value->jumlah_mahasiswaLulus_akhirTs6 + $value->jumlah_mahasiswaLulus_akhirTs5 + $value->jumlah_mahasiswaLulus_akhirTs4 + $value->jumlah_mahasiswaLulus_akhirTs3 + $value->jumlah_mahasiswaLulus_akhirTs2 + $value->jumlah_mahasiswaLulus_akhirTs1 + $value->jumlah_mahasiswaLulus_akhirTs;

               $value->jumlah_mhs = $jumlah_mhs;
           }
 }

   return view('lkps.luaran-dan-capaian-tridharma.efektifitas-dan-produktifitas-pendidikan.masa-studi-lulusan-pada-program-sarjana-terapan.index',compact('masastudi_lulusan_sarajana_terapan','prodi','prod','th'));
}


public function lihat_masa_studi_lulusan_program_sarajana_terapan(Request $request)
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

             $masastudi_lulusan_sarajana_terapan = MasaStudiLulusanSarjanaTerapan::orderBy('id', 'DESC')
             ->where('id_prodi','like','%'. $request->filter_prodi .'%')
             ->where('tahun_masuk', 'like','%'. $request->filter. '%')
             ->where('id_penunjukan',$penunjukan->id)
             ->where('status', 2)
             ->get();

             foreach ($masastudi_lulusan_sarajana_terapan as $key => $value) {

               $jumlah_mhs = $value->jumlah_mahasiswaLulus_akhirTs6 + $value->jumlah_mahasiswaLulus_akhirTs5 + $value->jumlah_mahasiswaLulus_akhirTs4 + $value->jumlah_mahasiswaLulus_akhirTs3 + $value->jumlah_mahasiswaLulus_akhirTs2 + $value->jumlah_mahasiswaLulus_akhirTs1 + $value->jumlah_mahasiswaLulus_akhirTs;

               $value->jumlah_mhs = $jumlah_mhs;
           }
        }
        

        if (Auth::user()->role == 'kappm') {
            $masastudi_lulusan_sarajana_terapan = MasaStudiLulusanSarjanaTerapan::orderBy('id', 'DESC')
             ->where('id_prodi','like','%'. $request->filter_prodi .'%')
             ->where('tahun_masuk', 'like','%'. $request->filter. '%')
             ->where('status', 1)
             ->get();

             foreach ($masastudi_lulusan_sarajana_terapan as $key => $value) {
               $jumlah_mhs = $value->jumlah_mahasiswaLulus_akhirTs6 + $value->jumlah_mahasiswaLulus_akhirTs5 + $value->jumlah_mahasiswaLulus_akhirTs4 + $value->jumlah_mahasiswaLulus_akhirTs3 + $value->jumlah_mahasiswaLulus_akhirTs2 + $value->jumlah_mahasiswaLulus_akhirTs1 + $value->jumlah_mahasiswaLulus_akhirTs;

               $value->jumlah_mhs = $jumlah_mhs;
           }
        }     

 return view('lkps.luaran-dan-capaian-tridharma.efektifitas-dan-produktifitas-pendidikan.masa-studi-lulusan-pada-program-sarjana-terapan.lihat_laporan',compact('masastudi_lulusan_sarajana_terapan','prodi','prod','th'));
}

    // ==================================Daya Saing Lulusan=========================

public function waktu_tunggu_lulusan_program_d3(Request $request)
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

             $waktu_tunggu_d3 = WaktuTungguLulusanD3::orderBy('id', 'DESC')
             ->where('id_prodi','like','%'. $request->filter_prodi .'%')
             ->where('tahun_lulus', 'like','%'. $request->filter. '%')
             ->where('id_penunjukan',$penunjukan->id)
             ->where('status', 2)
             ->get();

             $jumlah_lulusan=WaktuTungguLulusanD3::orderBy('id', 'DESC')->sum('jumlah_lulusan');
             $jumlah_lulusan_terlacak=WaktuTungguLulusanD3::orderBy('id', 'DESC')->where('status', 2)->sum('jumlah_lulusan_terlacak');
             $jumlah_lulusan_dipesan=WaktuTungguLulusanD3::orderBy('id', 'DESC')->where('status', 2)->sum('jumlah_lulusan_dipesan');
             $jumlah_lulusan_wt_3bulan=WaktuTungguLulusanD3::orderBy('id', 'DESC')->where('status', 2)->sum('jumlah_lulusan_wt_3bulan');
             $jumlah_lulusan_wt_3_6bulan=WaktuTungguLulusanD3::orderBy('id', 'DESC')->where('status', 2)->sum('jumlah_lulusan_wt_3_6bulan');
             $jumlah_lulusan_wt_6bulan=WaktuTungguLulusanD3::orderBy('id', 'DESC')->where('status', 2)->sum('jumlah_lulusan_wt_6bulan');


           }

        if (Auth::user()->role == 'kappm') {

            $waktu_tunggu_d3 = WaktuTungguLulusanD3::orderBy('id', 'DESC')
            ->where('id_prodi','like','%'. $request->filter_prodi .'%')
            ->where('tahun_lulus', 'like','%'. $request->filter. '%')
            ->where('status', 1)
            ->get();

            $jumlah_lulusan=WaktuTungguLulusanD3::orderBy('id', 'DESC')->where('status', 1)->sum('jumlah_lulusan');
            $jumlah_lulusan_terlacak=WaktuTungguLulusanD3::orderBy('id', 'DESC')->where('status', 1)->sum('jumlah_lulusan_terlacak');
            $jumlah_lulusan_dipesan=WaktuTungguLulusanD3::orderBy('id', 'DESC')->where('status', 1)->sum('jumlah_lulusan_dipesan');
            $jumlah_lulusan_wt_3bulan=WaktuTungguLulusanD3::orderBy('id', 'DESC')->where('status', 1)->sum('jumlah_lulusan_wt_3bulan');
            $jumlah_lulusan_wt_3_6bulan=WaktuTungguLulusanD3::orderBy('id', 'DESC')->where('status', 1)->sum('jumlah_lulusan_wt_3_6bulan');
            $jumlah_lulusan_wt_6bulan=WaktuTungguLulusanD3::orderBy('id', 'DESC')->where('status', 1)->sum('jumlah_lulusan_wt_6bulan');
        }




 return view('lkps.luaran-dan-capaian-tridharma.daya-saing-lulusan.waktu-tunggu-lulusan-pada-program-d3.index',compact('waktu_tunggu_d3','jumlah_lulusan','jumlah_lulusan_terlacak','jumlah_lulusan_dipesan','jumlah_lulusan_wt_3bulan','jumlah_lulusan_wt_3_6bulan','jumlah_lulusan_wt_6bulan','prodi','prod','th'));
}



public function lihat_waktu_tunggu_lulusan_program_d3(Request $request)
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

             $waktu_tunggu_d3 = WaktuTungguLulusanD3::orderBy('id', 'DESC')
             ->where('id_prodi','like','%'. $request->filter_prodi .'%')
             ->where('tahun_lulus', 'like','%'. $request->filter. '%')
             ->where('id_penunjukan',$penunjukan->id)
             ->where('status', 2)
             ->get();

             $jumlah_lulusan=WaktuTungguLulusanD3::orderBy('id', 'DESC')->sum('jumlah_lulusan');
             $jumlah_lulusan_terlacak=WaktuTungguLulusanD3::orderBy('id', 'DESC')->where('status', 2)->sum('jumlah_lulusan_terlacak');
             $jumlah_lulusan_dipesan=WaktuTungguLulusanD3::orderBy('id', 'DESC')->where('status', 2)->sum('jumlah_lulusan_dipesan');
             $jumlah_lulusan_wt_3bulan=WaktuTungguLulusanD3::orderBy('id', 'DESC')->where('status', 2)->sum('jumlah_lulusan_wt_3bulan');
             $jumlah_lulusan_wt_3_6bulan=WaktuTungguLulusanD3::orderBy('id', 'DESC')->where('status', 2)->sum('jumlah_lulusan_wt_3_6bulan');
             $jumlah_lulusan_wt_6bulan=WaktuTungguLulusanD3::orderBy('id', 'DESC')->where('status', 2)->sum('jumlah_lulusan_wt_6bulan');

         }


         if (Auth::user()->role == 'kappm') {
             $waktu_tunggu_d3 = WaktuTungguLulusanD3::orderBy('id', 'DESC')
             ->where('id_prodi','like','%'. $request->filter_prodi .'%')
             ->where('tahun_lulus', 'like','%'. $request->filter. '%')
             ->where('status', 1)
             ->get();


             $jumlah_lulusan=WaktuTungguLulusanD3::orderBy('id', 'DESC')->sum('jumlah_lulusan');
             $jumlah_lulusan_terlacak=WaktuTungguLulusanD3::orderBy('id', 'DESC')->where('status', 1)->sum('jumlah_lulusan_terlacak');
             $jumlah_lulusan_dipesan=WaktuTungguLulusanD3::orderBy('id', 'DESC')->where('status', 1)->sum('jumlah_lulusan_dipesan');
             $jumlah_lulusan_wt_3bulan=WaktuTungguLulusanD3::orderBy('id', 'DESC')->where('status', 1)->sum('jumlah_lulusan_wt_3bulan');
             $jumlah_lulusan_wt_3_6bulan=WaktuTungguLulusanD3::orderBy('id', 'DESC')->where('status', 1)->sum('jumlah_lulusan_wt_3_6bulan');
             $jumlah_lulusan_wt_6bulan=WaktuTungguLulusanD3::orderBy('id', 'DESC')->where('status', 1)->sum('jumlah_lulusan_wt_6bulan');
         }



    return view('lkps.luaran-dan-capaian-tridharma.daya-saing-lulusan.waktu-tunggu-lulusan-pada-program-d3.lihat_laporan',compact('waktu_tunggu_d3','jumlah_lulusan','jumlah_lulusan_terlacak','jumlah_lulusan_dipesan','jumlah_lulusan_wt_3bulan','jumlah_lulusan_wt_3_6bulan','jumlah_lulusan_wt_6bulan','prodi','prod','th'));
}

public function waktu_tunggu_lulusan_program_sarajana_terapan(Request $request)
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

               $waktu_tunggu_sarjana_terapan = WaktuTungguLulusanSarjanaTerapan::orderBy('id', 'DESC')
               ->where('id_prodi','like','%'. $request->filter_prodi .'%')
               ->where('tahun_lulus', 'like','%'. $request->filter. '%')
               ->where('id_penunjukan',$penunjukan->id)
               ->where('status', 2)
               ->get();

               $jumlah_lulusan=WaktuTungguLulusanSarjanaTerapan::orderBy('id', 'DESC')->sum('jumlah_lulusan');
               $jumlah_lulusan_terlacak=WaktuTungguLulusanSarjanaTerapan::orderBy('id', 'DESC')->where('status', 2)->sum('jumlah_lulusan_terlacak');
               $jumlah_lulusan_wt_3bulan=WaktuTungguLulusanSarjanaTerapan::orderBy('id', 'DESC')->where('status', 2)->sum('jumlah_lulusan_wt_3bulan');
               $jumlah_lulusan_wt_3_6bulan=WaktuTungguLulusanSarjanaTerapan::orderBy('id', 'DESC')->where('status', 2)->sum('jumlah_lulusan_wt_3_6bulan');
               $jumlah_lulusan_wt_6bulan=WaktuTungguLulusanSarjanaTerapan::orderBy('id', 'DESC')->where('status', 2)->sum('jumlah_lulusan_wt_6bulan');
         }


         if (Auth::user()->role == 'kappm') {
            $waktu_tunggu_sarjana_terapan = WaktuTungguLulusanSarjanaTerapan::orderBy('id', 'DESC')
               ->where('id_prodi','like','%'. $request->filter_prodi .'%')
               ->where('tahun_lulus', 'like','%'. $request->filter. '%')
               ->where('status', 1)
               ->get();

               $jumlah_lulusan=WaktuTungguLulusanSarjanaTerapan::orderBy('id', 'DESC')->sum('jumlah_lulusan');
               $jumlah_lulusan_terlacak=WaktuTungguLulusanSarjanaTerapan::orderBy('id', 'DESC')->where('status', 1)->sum('jumlah_lulusan_terlacak');
               $jumlah_lulusan_wt_3bulan=WaktuTungguLulusanSarjanaTerapan::orderBy('id', 'DESC')->where('status', 1)->sum('jumlah_lulusan_wt_3bulan');
               $jumlah_lulusan_wt_3_6bulan=WaktuTungguLulusanSarjanaTerapan::orderBy('id', 'DESC')->where('status',1)->sum('jumlah_lulusan_wt_3_6bulan');
               $jumlah_lulusan_wt_6bulan=WaktuTungguLulusanSarjanaTerapan::orderBy('id', 'DESC')->where('status', 1)->sum('jumlah_lulusan_wt_6bulan');
         }

    return view('lkps.luaran-dan-capaian-tridharma.daya-saing-lulusan.waktu-tunggu-lulusan-pada-program-sarjana-terapan.index',compact('waktu_tunggu_sarjana_terapan','jumlah_lulusan','jumlah_lulusan_terlacak','jumlah_lulusan_wt_3bulan','jumlah_lulusan_wt_3_6bulan','jumlah_lulusan_wt_6bulan','prodi','prod','th'));
}



public function lihat_waktu_tunggu_lulusan_program_sarajana_terapan(Request $request)
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


             $waktu_tunggu_sarjana_terapan = WaktuTungguLulusanSarjanaTerapan::orderBy('id', 'DESC')
             ->where('id_prodi','like','%'. $request->filter_prodi .'%')
             ->where('tahun_lulus', 'like','%'. $request->filter. '%')
             ->where('id_penunjukan',$penunjukan->id)
             ->where('status', 2)
             ->get();

             $jumlah_lulusan=WaktuTungguLulusanSarjanaTerapan::orderBy('id', 'DESC')->sum('jumlah_lulusan');
             $jumlah_lulusan_terlacak=WaktuTungguLulusanSarjanaTerapan::orderBy('id', 'DESC')->where('status', 2)->sum('jumlah_lulusan_terlacak');
             $jumlah_lulusan_wt_3bulan=WaktuTungguLulusanSarjanaTerapan::orderBy('id', 'DESC')->where('status', 2)->sum('jumlah_lulusan_wt_3bulan');
             $jumlah_lulusan_wt_3_6bulan=WaktuTungguLulusanSarjanaTerapan::orderBy('id', 'DESC')->where('status', 2)->sum('jumlah_lulusan_wt_3_6bulan');
             $jumlah_lulusan_wt_6bulan=WaktuTungguLulusanSarjanaTerapan::orderBy('id', 'DESC')->where('status', 2)->sum('jumlah_lulusan_wt_6bulan');
         }


         if (Auth::user()->role == 'kappm') {
            $waktu_tunggu_sarjana_terapan = WaktuTungguLulusanSarjanaTerapan::orderBy('id', 'DESC')
             ->where('id_prodi','like','%'. $request->filter_prodi .'%')
             ->where('tahun_lulus', 'like','%'. $request->filter. '%')
             ->where('status', 1)
             ->get();

             $jumlah_lulusan=WaktuTungguLulusanSarjanaTerapan::orderBy('id', 'DESC')->sum('jumlah_lulusan');
             $jumlah_lulusan_terlacak=WaktuTungguLulusanSarjanaTerapan::orderBy('id', 'DESC')->where('status', 1)->sum('jumlah_lulusan_terlacak');
             $jumlah_lulusan_wt_3bulan=WaktuTungguLulusanSarjanaTerapan::orderBy('id', 'DESC')->where('status', 1)->sum('jumlah_lulusan_wt_3bulan');
             $jumlah_lulusan_wt_3_6bulan=WaktuTungguLulusanSarjanaTerapan::orderBy('id', 'DESC')->where('status', 1)->sum('jumlah_lulusan_wt_3_6bulan');
             $jumlah_lulusan_wt_6bulan=WaktuTungguLulusanSarjanaTerapan::orderBy('id', 'DESC')->where('status', 1)->sum('jumlah_lulusan_wt_6bulan');
         }


    return view('lkps.luaran-dan-capaian-tridharma.daya-saing-lulusan.waktu-tunggu-lulusan-pada-program-sarjana-terapan.lihat_laporan',compact('waktu_tunggu_sarjana_terapan','jumlah_lulusan','jumlah_lulusan_terlacak','jumlah_lulusan_wt_3bulan','jumlah_lulusan_wt_3_6bulan','jumlah_lulusan_wt_6bulan','prodi','prod','th'));
}

public function kesesuaian_bidang_kerja_lulusan(Request $request)
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
             
            $kesesuaian_bidang_kerja_lulusan = KesesuaianBidangkerjaLulusan::orderBy('id', 'DESC')
            ->where('id_prodi','like','%'. $request->filter_prodi .'%')
            ->where('tahun_lulus', 'like','%'. $request->filter. '%')
            ->where('id_penunjukan',$penunjukan->id)
            ->where('status', 2)
            ->get();

            $jumlah_lulusan=KesesuaianBidangkerjaLulusan::orderBy('id', 'DESC')->sum('jumlah_lulusan');
            $jumlah_lulusan_terlacak=KesesuaianBidangkerjaLulusan::orderBy('id', 'DESC')->where('status', 2)->sum('jumlah_lulusan_terlacak');
            $jumlah_lulusan_rendah=KesesuaianBidangkerjaLulusan::orderBy('id', 'DESC')->where('status', 2)->sum('jumlah_lulusan_rendah');
            $jumlah_lulusan_sedang=KesesuaianBidangkerjaLulusan::orderBy('id', 'DESC')->where('status', 2)->sum('jumlah_lulusan_sedang');
            $jumlah_lulusan_tinggi=KesesuaianBidangkerjaLulusan::orderBy('id', 'DESC')->where('status', 2)->sum('jumlah_lulusan_tinggi');
            
            }
            
            if (Auth::user()->role == 'kappm') {

                $kesesuaian_bidang_kerja_lulusan = KesesuaianBidangkerjaLulusan::orderBy('id', 'DESC')
                ->where('id_prodi','like','%'. $request->filter_prodi .'%')
                ->where('tahun_lulus', 'like','%'. $request->filter. '%')
                ->where('status', 1)
                ->get();

                $jumlah_lulusan=KesesuaianBidangkerjaLulusan::orderBy('id', 'DESC')->sum('jumlah_lulusan');
                $jumlah_lulusan_terlacak=KesesuaianBidangkerjaLulusan::orderBy('id', 'DESC')->where('status', 1)->sum('jumlah_lulusan_terlacak');
                $jumlah_lulusan_rendah=KesesuaianBidangkerjaLulusan::orderBy('id', 'DESC')->where('status', 1)->sum('jumlah_lulusan_rendah');
                $jumlah_lulusan_sedang=KesesuaianBidangkerjaLulusan::orderBy('id', 'DESC')->where('status', 1)->sum('jumlah_lulusan_sedang');
                $jumlah_lulusan_tinggi=KesesuaianBidangkerjaLulusan::orderBy('id', 'DESC')->where('status', 1)->sum('jumlah_lulusan_tinggi');
            }




    return view('lkps.luaran-dan-capaian-tridharma.daya-saing-lulusan.kesesuaian-bidang-kerja-lulusan.index',compact('kesesuaian_bidang_kerja_lulusan','jumlah_lulusan','jumlah_lulusan_terlacak','jumlah_lulusan_rendah','jumlah_lulusan_sedang','jumlah_lulusan_tinggi','prodi','prod','th'));
}
public function lihat_kesesuaian_bidang_kerja_lulusan(Request $request)
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

             $kesesuaian_bidang_kerja_lulusan = KesesuaianBidangkerjaLulusan::orderBy('id', 'DESC')
             ->where('id_prodi','like','%'. $request->filter_prodi .'%')
             ->where('tahun_lulus', 'like','%'. $request->filter. '%')
             ->where('id_penunjukan',$penunjukan->id)
             ->where('status', 2)
             ->get();

             $jumlah_lulusan=KesesuaianBidangkerjaLulusan::orderBy('id', 'DESC')->sum('jumlah_lulusan');
             $jumlah_lulusan_terlacak=KesesuaianBidangkerjaLulusan::orderBy('id', 'DESC') ->where('status', 2)->sum('jumlah_lulusan_terlacak');
             $jumlah_lulusan_rendah=KesesuaianBidangkerjaLulusan::orderBy('id', 'DESC') ->where('status', 2)->sum('jumlah_lulusan_rendah');
             $jumlah_lulusan_sedang=KesesuaianBidangkerjaLulusan::orderBy('id', 'DESC') ->where('status', 2)->sum('jumlah_lulusan_sedang');
             $jumlah_lulusan_tinggi=KesesuaianBidangkerjaLulusan::orderBy('id', 'DESC') ->where('status', 2)->sum('jumlah_lulusan_tinggi');

                 }

             if (Auth::user()->role == 'kappm') {
                $kesesuaian_bidang_kerja_lulusan = KesesuaianBidangkerjaLulusan::orderBy('id', 'DESC')
                ->where('id_prodi','like','%'. $request->filter_prodi .'%')
                ->where('tahun_lulus', 'like','%'. $request->filter. '%')
                ->where('status', 1)
                ->get();

                $jumlah_lulusan=KesesuaianBidangkerjaLulusan::orderBy('id', 'DESC') ->where('status', 1)->sum('jumlah_lulusan');
                $jumlah_lulusan_terlacak=KesesuaianBidangkerjaLulusan::orderBy('id', 'DESC') ->where('status', 1)->sum('jumlah_lulusan_terlacak');
                $jumlah_lulusan_rendah=KesesuaianBidangkerjaLulusan::orderBy('id', 'DESC') ->where('status', 1)->sum('jumlah_lulusan_rendah');
                $jumlah_lulusan_sedang=KesesuaianBidangkerjaLulusan::orderBy('id', 'DESC') ->where('status', 1)->sum('jumlah_lulusan_sedang');
                $jumlah_lulusan_tinggi=KesesuaianBidangkerjaLulusan::orderBy('id', 'DESC') ->where('status', 1)->sum('jumlah_lulusan_tinggi');
            }


    return view('lkps.luaran-dan-capaian-tridharma.daya-saing-lulusan.kesesuaian-bidang-kerja-lulusan.lihat_laporan',compact('kesesuaian_bidang_kerja_lulusan','jumlah_lulusan','jumlah_lulusan_terlacak','jumlah_lulusan_rendah','jumlah_lulusan_sedang','jumlah_lulusan_tinggi','prodi','prod','th'));
}

    // ==================================Kinerja Lulusan=========================

public function tempat_kerja_lulusan(Request $request)
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

               $tempat_kerja_lulusan = TempatKerjaLulusan::orderBy('id', 'DESC')
               ->where('id_prodi','like','%'. $request->filter_prodi .'%')
               ->where('tahun_lulus', 'like','%'. $request->filter. '%')
               ->where('id_penunjukan',$penunjukan->id)
               ->where('status', 2)
               ->get();

               $jumlah_lulusan=TempatKerjaLulusan::orderBy('id', 'DESC') ->where('status', 2)->sum('jumlah_lulusan');
               $jumlah_lulusan_terlacak=TempatKerjaLulusan::orderBy('id', 'DESC') ->where('status', 2)->sum('jumlah_lulusan_terlacak');
               $jumlah_lulusan_lokal=TempatKerjaLulusan::orderBy('id', 'DESC') ->where('status', 2)->sum('jumlah_lulusan_lokal');
               $jumlah_lulusan_nasional=TempatKerjaLulusan::orderBy('id', 'DESC') ->where('status', 2)->sum('jumlah_lulusan_nasional');
               $jumlah_lulusan_multinasional=TempatKerjaLulusan::orderBy('id', 'DESC') ->where('status', 2)->sum('jumlah_lulusan_multinasional');

           }


           if (Auth::user()->role == 'kappm') {

               $tempat_kerja_lulusan = TempatKerjaLulusan::orderBy('id', 'DESC')
               ->where('id_prodi','like','%'. $request->filter_prodi .'%')
               ->where('tahun_lulus', 'like','%'. $request->filter. '%')
               ->where('status', 1)
               ->get();

               $jumlah_lulusan=TempatKerjaLulusan::orderBy('id', 'DESC') ->where('status', 1)->sum('jumlah_lulusan');
               $jumlah_lulusan_terlacak=TempatKerjaLulusan::orderBy('id', 'DESC') ->where('status', 1)->sum('jumlah_lulusan_terlacak');
               $jumlah_lulusan_lokal=TempatKerjaLulusan::orderBy('id', 'DESC') ->where('status', 1)->sum('jumlah_lulusan_lokal');
               $jumlah_lulusan_nasional=TempatKerjaLulusan::orderBy('id', 'DESC') ->where('status', 1)->sum('jumlah_lulusan_nasional');
               $jumlah_lulusan_multinasional=TempatKerjaLulusan::orderBy('id', 'DESC') ->where('status', 1)->sum('jumlah_lulusan_multinasional');

           }


    return view('lkps.luaran-dan-capaian-tridharma.kinerja-lulusan.tempat-kerja-lulusan.index',compact('tempat_kerja_lulusan','jumlah_lulusan','jumlah_lulusan_terlacak','jumlah_lulusan_lokal','jumlah_lulusan_nasional','jumlah_lulusan_multinasional','prodi','prod','th'));
}


public function lihat_tempat_kerja_lulusan(Request $request)
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

             $tempat_kerja_lulusan = TempatKerjaLulusan::orderBy('id', 'DESC')
             ->where('id_prodi','like','%'. $request->filter_prodi .'%')
             ->where('tahun_lulus', 'like','%'. $request->filter. '%')
             ->where('id_penunjukan',$penunjukan->id)
             ->where('status', 2)
             ->get();

             $jumlah_lulusan=TempatKerjaLulusan::orderBy('id', 'DESC')->where('status', 2)->sum('jumlah_lulusan');
             $jumlah_lulusan_terlacak=TempatKerjaLulusan::orderBy('id', 'DESC')->where('status', 2)->sum('jumlah_lulusan_terlacak');
             $jumlah_lulusan_lokal=TempatKerjaLulusan::orderBy('id', 'DESC')->where('status', 2)->sum('jumlah_lulusan_lokal');
             $jumlah_lulusan_nasional=TempatKerjaLulusan::orderBy('id', 'DESC')->where('status', 2)->sum('jumlah_lulusan_nasional');
             $jumlah_lulusan_multinasional=TempatKerjaLulusan::orderBy('id', 'DESC')->where('status', 2)->sum('jumlah_lulusan_multinasional');

           }


           if (Auth::user()->role == 'kappm') {
            $tempat_kerja_lulusan = TempatKerjaLulusan::orderBy('id', 'DESC')
             ->where('id_prodi','like','%'. $request->filter_prodi .'%')
             ->where('tahun_lulus', 'like','%'. $request->filter. '%')
             ->where('status', 1)
             ->get();

             $jumlah_lulusan=TempatKerjaLulusan::orderBy('id', 'DESC')->where('status', 1)->sum('jumlah_lulusan');
             $jumlah_lulusan_terlacak=TempatKerjaLulusan::orderBy('id', 'DESC')->where('status', 1)->sum('jumlah_lulusan_terlacak');
             $jumlah_lulusan_lokal=TempatKerjaLulusan::orderBy('id', 'DESC')->where('status', 1)->sum('jumlah_lulusan_lokal');
             $jumlah_lulusan_nasional=TempatKerjaLulusan::orderBy('id', 'DESC')->where('status', 1)->sum('jumlah_lulusan_nasional');
             $jumlah_lulusan_multinasional=TempatKerjaLulusan::orderBy('id', 'DESC')->where('status', 1)->sum('jumlah_lulusan_multinasional');
           }


    return view('lkps.luaran-dan-capaian-tridharma.kinerja-lulusan.tempat-kerja-lulusan.lihat_laporan',compact('tempat_kerja_lulusan','jumlah_lulusan','jumlah_lulusan_terlacak','jumlah_lulusan_lokal','jumlah_lulusan_nasional','jumlah_lulusan_multinasional','prodi','prod','th'));
}


public function referensi_kepuasan_pengguna_lulusan(Request $request)
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

               $referensi_kepuasan_pengguna_lulusan = ReferensiKepuasanPengguna::orderBy('id', 'DESC')
               ->where('id_prodi','like','%'. $request->filter_prodi .'%')
               ->where('tahun_lulus', 'like','%'. $request->filter. '%')
               ->where('id_penunjukan',$penunjukan->id)
               ->where('status', 2)
               ->get();

               foreach ($referensi_kepuasan_pengguna_lulusan as $key => $value) {
                 $jumlah_tanggapan = ReferensiKepuasanPengguna::orderBy('id', 'DESC')->where('status', 2)->sum('jumlah_tanggapan');

                 $value->jumlah_tang = $jumlah_tanggapan;
             }

         }

         if (Auth::user()->role == 'kappm') {
            $referensi_kepuasan_pengguna_lulusan = ReferensiKepuasanPengguna::orderBy('id', 'DESC')
            ->where('id_prodi','like','%'. $request->filter_prodi .'%')
            ->where('tahun_lulus', 'like','%'. $request->filter. '%')
            ->where('status', 1)
            ->get();

            foreach ($referensi_kepuasan_pengguna_lulusan as $key => $value) {
               $jumlah_tanggapan = ReferensiKepuasanPengguna::orderBy('id', 'DESC')->where('status', 1)->sum('jumlah_tanggapan');

               $value->jumlah_tang = $jumlah_tanggapan;
           }
       } 

 return view('lkps.luaran-dan-capaian-tridharma.kinerja-lulusan.referensi-kepuasan-pengguna-lulusan.index',compact('referensi_kepuasan_pengguna_lulusan','prodi','prod','th'));
}


public function kepuasan_pengguna_lulusan(Request $request)
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


             $kepuasan_pengguna_lulusan = KepuasanPenggunaLulusan::orderBy('id', 'DESC')
             ->where('id_prodi','like','%'. $request->filter_prodi .'%')
             ->where('tahun', 'like','%'. $request->filter. '%')
             ->where('id_penunjukan',$penunjukan->id)
             ->where('status', 2)
             ->get();

             $jumlah_sangat_baik=KepuasanPenggunaLulusan::orderBy('id', 'DESC')->where('status', 2)->sum('tingkat_kepuasanPengguna_sangatBaik');
             $jumlah_baik=KepuasanPenggunaLulusan::orderBy('id', 'DESC')->where('status', 2)->sum('tingkat_kepuasanPengguna_baik');
             $jumlah_cukup=KepuasanPenggunaLulusan::orderBy('id', 'DESC')->where('status', 2)->sum('tingkat_kepuasanPengguna_cukup');
             $jumlah_kurang=KepuasanPenggunaLulusan::orderBy('id', 'DESC')->where('status', 2)->sum('tingkat_kepuasanPengguna_kurang');
         }


           if (Auth::user()->role == 'kappm') {
            $kepuasan_pengguna_lulusan = KepuasanPenggunaLulusan::orderBy('id', 'DESC')
             ->where('id_prodi','like','%'. $request->filter_prodi .'%')
             ->where('tahun', 'like','%'. $request->filter. '%')
             ->where('status', 1)
             ->get();

             $jumlah_sangat_baik=KepuasanPenggunaLulusan::orderBy('id', 'DESC')->where('status', 1)->sum('tingkat_kepuasanPengguna_sangatBaik');
             $jumlah_baik=KepuasanPenggunaLulusan::orderBy('id', 'DESC')->where('status', 1)->sum('tingkat_kepuasanPengguna_baik');
             $jumlah_cukup=KepuasanPenggunaLulusan::orderBy('id', 'DESC')->where('status', 1)->sum('tingkat_kepuasanPengguna_cukup');
             $jumlah_kurang=KepuasanPenggunaLulusan::orderBy('id', 'DESC')->where('status', 1)->sum('tingkat_kepuasanPengguna_kurang');
           }




    return view('lkps.luaran-dan-capaian-tridharma.kinerja-lulusan.kepuasan-pengguna-lulusan.index',compact('kepuasan_pengguna_lulusan','jumlah_sangat_baik','jumlah_baik','jumlah_cukup','jumlah_kurang','prodi','prod','th'));
}

public function lihat_kepuasan_pengguna_lulusan(Request $request)
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


             $kepuasan_pengguna_lulusan = KepuasanPenggunaLulusan::orderBy('id', 'DESC')
             ->where('id_prodi','like','%'. $request->filter_prodi .'%')
             ->where('tahun', 'like','%'. $request->filter. '%')
             ->where('id_penunjukan',$penunjukan->id)
             ->where('status', 2)
             ->get();
  
         }


         if (Auth::user()->role == 'kappm') {
            $kepuasan_pengguna_lulusan = KepuasanPenggunaLulusan::orderBy('id', 'DESC')
            ->where('id_prodi','like','%'. $request->filter_prodi .'%')
            ->where('tahun', 'like','%'. $request->filter. '%')
            ->where('status', 1)
            ->get();

        }


    return view('lkps.luaran-dan-capaian-tridharma.kinerja-lulusan.kepuasan-pengguna-lulusan.lihat_laporan',compact('kepuasan_pengguna_lulusan','prodi','prod','th'));
}

    // ==================================Luaran Penelitian dan Penelitian Mahasiswa=========================


public function pagelaran_pameran_prestasi_publikasi_ilmiah_mahasiswa(Request $request)
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

             $publikasi_ilmiah_mahasiswa = PagelaranIlmiahMahasiswa::orderBy('id', 'DESC')
             ->where('id_prodi','like','%'. $request->filter_prodi .'%')
             ->where('tahun_akademik', 'like','%'. $request->filter. '%')
             ->where('id_penunjukan',$penunjukan->id)
             ->where('status', 2)
             ->get();

             foreach ($publikasi_ilmiah_mahasiswa as $key => $value) {
                 $jumlah = $value->jumlah_judul_ts2 + $value->jumlah_judul_ts1 + $value->jumlah_judul_ts ;

                 $value->jumlah = $jumlah;
             }
         }


         if (Auth::user()->role == 'kappm') {
             $publikasi_ilmiah_mahasiswa = PagelaranIlmiahMahasiswa::orderBy('id', 'DESC')
             ->where('id_prodi','like','%'. $request->filter_prodi .'%')
             ->where('tahun_akademik', 'like','%'. $request->filter. '%')
             ->where('status', 1)
             ->get();

             foreach ($publikasi_ilmiah_mahasiswa as $key => $value) {
               $jumlah = $value->jumlah_judul_ts2 + $value->jumlah_judul_ts1 + $value->jumlah_judul_ts ;

               $value->jumlah = $jumlah;
           }
       }



 return view('lkps.luaran-dan-capaian-tridharma.luaran-penelitian-dan-pkm-mahasiswa.pagelaran-pameran-presentasi-publikasi-ilmiah-mahasiswa.index',compact('publikasi_ilmiah_mahasiswa','prodi','prod','th'));
}
public function lihat_pagelaran_pameran_prestasi_publikasi_ilmiah_mahasiswa(Request $request)
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

             $publikasi_ilmiah_mahasiswa = PagelaranIlmiahMahasiswa::orderBy('id', 'DESC')
             ->where('id_prodi','like','%'. $request->filter_prodi .'%')
             ->where('tahun_akademik', 'like','%'. $request->filter. '%')
             ->where('id_penunjukan',$penunjukan->id)
             ->where('status', 2)
             ->get();

             foreach ($publikasi_ilmiah_mahasiswa as $key => $value) {
                 $jumlah = $value->jumlah_judul_ts2 + $value->jumlah_judul_ts1 + $value->jumlah_judul_ts ;

                 $value->jumlah = $jumlah;
             }
         }


         if (Auth::user()->role == 'kappm') {
             $publikasi_ilmiah_mahasiswa = PagelaranIlmiahMahasiswa::orderBy('id', 'DESC')
             ->where('id_prodi','like','%'. $request->filter_prodi .'%')
             ->where('tahun_akademik', 'like','%'. $request->filter. '%')
             ->where('status', 1)
             ->get();

             foreach ($publikasi_ilmiah_mahasiswa as $key => $value) {
               $jumlah = $value->jumlah_judul_ts2 + $value->jumlah_judul_ts1 + $value->jumlah_judul_ts ;

               $value->jumlah = $jumlah;
           }
       }

 return view('lkps.luaran-dan-capaian-tridharma.luaran-penelitian-dan-pkm-mahasiswa.pagelaran-pameran-presentasi-publikasi-ilmiah-mahasiswa.lihat_laporan',compact('publikasi_ilmiah_mahasiswa','prodi','prod','th'));
}


public function produk_jasa_mahasiswa_diadopsi_oleh_industri_masyarakat(Request $request)
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

               $produk_jasa_mahasiswa = ProdukMahasiswa::orderBy('id', 'DESC')
               ->where('id_prodi','like','%'. $request->filter_prodi .'%')
               ->where('tahun', 'like','%'. $request->filter. '%')
               ->where('id_penunjukan',$penunjukan->id)
               ->where('status', 2)
               ->get();
           }


           if (Auth::user()->role == 'kappm') {
            $produk_jasa_mahasiswa = ProdukMahasiswa::orderBy('id', 'DESC')
            ->where('id_prodi','like','%'. $request->filter_prodi .'%')
            ->where('tahun', 'like','%'. $request->filter. '%')
            ->where('status', 1)
            ->get();
        }


 return view('lkps.luaran-dan-capaian-tridharma.luaran-penelitian-dan-pkm-mahasiswa.produk-jasa-mahasiswa-yang-diadopsi-oleh-industri-masyarakat.index',compact('produk_jasa_mahasiswa','prodi','prod','th'));
}


public function mahasiswa_hki_paten(Request $request)
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

             $data_hki_mhs = LuaranPenelitianMahasiswaBagian1::orderBy('id', 'DESC')
             ->where('id_prodi','like','%'. $request->filter_prodi .'%')
             ->where('tahun', 'like','%'. $request->filter. '%')
             ->where('id_penunjukan',$penunjukan->id)
             ->where('status', 2)
             ->get();
         }


         if (Auth::user()->role == 'kappm') {
            $data_hki_mhs = LuaranPenelitianMahasiswaBagian1::orderBy('id', 'DESC')
            ->where('id_prodi','like','%'. $request->filter_prodi .'%')
            ->where('tahun', 'like','%'. $request->filter. '%')
            ->where('status', 1)
            ->get();

        }

 return view('lkps.luaran-dan-capaian-tridharma.luaran-penelitian-dan-pkm-mahasiswa.luaran-penelitian-yang-dihasilkan-mahasiswa.hki-paten.index',compact('data_hki_mhs','prodi','prod','th'));
}

public function mahasiswa_hki_hak_cipta(Request $request)
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

               $data_hki_hak_cipta_mhs = LuaranPenelitianMahasiswaBagian2::orderBy('id', 'DESC')
               ->where('id_prodi','like','%'. $request->filter_prodi .'%')
               ->where('tahun', 'like','%'. $request->filter. '%')
               ->where('id_penunjukan',$penunjukan->id)
               ->where('status', 2)
               ->get();
           }

           if (Auth::user()->role == 'kappm') {
            $data_hki_hak_cipta_mhs = LuaranPenelitianMahasiswaBagian2::orderBy('id', 'DESC')
            ->where('id_prodi','like','%'. $request->filter_prodi .'%')
            ->where('tahun', 'like','%'. $request->filter. '%')
            ->where('status', 1)
            ->get();
        }


    return view('lkps.luaran-dan-capaian-tridharma.luaran-penelitian-dan-pkm-mahasiswa.luaran-penelitian-yang-dihasilkan-mahasiswa.hki-hak-cipta-desain-produk-industri.index',compact('data_hki_hak_cipta_mhs','prodi','prod','th'));
}


public function mahasiswa_teknologi_tepat_guna(Request $request)
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

             $data_teknologi_tepat_guna_mhs = LuaranPenelitianMahasiswaBagian3::orderBy('id', 'DESC')
             ->where('id_prodi','like','%'. $request->filter_prodi .'%')
             ->where('tahun', 'like','%'. $request->filter. '%')
             ->where('id_penunjukan',$penunjukan->id)
             ->where('status', 2)
             ->get();
         }

         if (Auth::user()->role == 'kappm') {
            $data_teknologi_tepat_guna_mhs = LuaranPenelitianMahasiswaBagian3::orderBy('id', 'DESC')
            ->where('id_prodi','like','%'. $request->filter_prodi .'%')
            ->where('tahun', 'like','%'. $request->filter. '%')
            ->where('status', 1)
            ->get();
        }


    return view('lkps.luaran-dan-capaian-tridharma.luaran-penelitian-dan-pkm-mahasiswa.luaran-penelitian-yang-dihasilkan-mahasiswa.teknologi-tepat-guna.index',compact('data_teknologi_tepat_guna_mhs','prodi','prod','th'));
}

public function mahasiswa_buku_berisbn(Request $request)
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

               $data_buku_berisbn_mhs = LuaranPenelitianMahasiswaBagian4::orderBy('id', 'DESC')
               ->where('id_prodi','like','%'. $request->filter_prodi .'%')
               ->where('tahun', 'like','%'. $request->filter. '%')
               ->where('id_penunjukan',$penunjukan->id)
               ->where('status', 2)
               ->get();
           }

           if (Auth::user()->role == 'kappm') {
            $data_buku_berisbn_mhs = LuaranPenelitianMahasiswaBagian4::orderBy('id', 'DESC')
            ->where('id_prodi','like','%'. $request->filter_prodi .'%')
            ->where('tahun', 'like','%'. $request->filter. '%')
            ->where('status', 1)
            ->get();
        }

    return view('lkps.luaran-dan-capaian-tridharma.luaran-penelitian-dan-pkm-mahasiswa.luaran-penelitian-yang-dihasilkan-mahasiswa.buku-berisbn.index',compact('data_buku_berisbn_mhs','prodi','prod','th'));
}
}
