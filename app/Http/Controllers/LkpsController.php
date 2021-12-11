<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pengumuman;
use App\PerjanjianKinerja;
use App\DataLkps;
use App\KerjasamaTridharmaPendidikan;
use App\KerjasamaTridharmaPenelitian;
use App\KerjasamaTridharmaPkm;
use App\SeleksiMahasiswaBaru;
use App\MahasiswaAsing;
use App\DaftarProdiDiupps;
use App\Prodi;
use App\HasilPenilaianLkps;
use App\User;
use Auth;
use File;
use DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LkpsController extends Controller
{


     public function data_lkps(Request $request)

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


               $data_lkps = DB::table('data_lkps')
               ->join('prodi', 'data_lkps.id_prodi', '=', 'prodi.id')
               ->select('data_lkps.*', 'prodi.nama_prodi')
               ->orderBy('id', 'DESC')
               ->where('data_lkps.id_prodi','like','%'. $request->filter_prodi .'%')
               ->where('data_lkps.tahun_akademik', 'like','%'. $request->filter. '%')
               ->where('data_lkps.id_penunjukan',$penunjukan->id)
               ->where('status', 2)
               ->get();   
          }

          if (Auth::user()->role == 'kappm') {

               $data_lkps = DB::table('data_lkps')
               ->join('prodi', 'data_lkps.id_prodi', '=', 'prodi.id')
               ->select('data_lkps.*', 'prodi.nama_prodi')
               ->orderBy('id', 'DESC')
               ->where('data_lkps.id_prodi','like','%'. $request->filter_prodi .'%')
               ->where('data_lkps.tahun_akademik', 'like','%'. $request->filter. '%')
               ->where('status', 1)
               ->get();   

          }

          return view('lkps.data-lkps.index', compact('data_lkps','prodi','prod','th'));
     }


     public function daftar_program_studi_upps(Request $request)
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


          $daftar_prodi_upps = DB::table('daftar_prodi_diupps')
          ->join('prodi', 'daftar_prodi_diupps.id_prodi', '=', 'prodi.id')
          ->select('daftar_prodi_diupps.*', 'prodi.nama_prodi')
          ->orderBy('id', 'DESC')
          ->where('daftar_prodi_diupps.id_prodi','like','%'. $request->filter_prodi .'%')
          ->where('daftar_prodi_diupps.tahun', 'like','%'. $request->filter. '%')
          ->where('daftar_prodi_diupps.id_penunjukan',$penunjukan->id)
          ->where('status', 2)
          ->get();

     }

     if (Auth::user()->role == 'kappm') {

          $daftar_prodi_upps = DB::table('daftar_prodi_diupps')
          ->join('prodi', 'daftar_prodi_diupps.id_prodi', '=', 'prodi.id')
          ->select('daftar_prodi_diupps.*', 'prodi.nama_prodi')
          ->orderBy('id', 'DESC')
          ->where('daftar_prodi_diupps.id_prodi','like','%'. $request->filter_prodi .'%')
          ->where('daftar_prodi_diupps.tahun', 'like','%'. $request->filter. '%')
          ->where('status', 1)
          ->get();

     }

     

     return view('lkps.daftar-program-studi-di-upps.index', compact('daftar_prodi_upps','prodi','prod','th'));
}



public function kerja_sama_tridharma_pendidikan(Request $request)
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


          $tridharma_pendidikan = KerjasamaTridharmaPendidikan::where('id_prodi','like','%'. $request->filter_prodi .'%')
          ->where('tahun_berakhir', 'like','%'. $request->filter. '%')
          ->where('id_penunjukan',$penunjukan->id)
          ->where('status', 2)
          ->get();
     }

     if (Auth::user()->role == 'auditor') {

          $tridharma_pendidikan = KerjasamaTridharmaPendidikan::where('id_prodi','like','%'. $request->filter_prodi .'%')
          ->where('tahun_berakhir', 'like','%'. $request->filter. '%')
          ->where('status', 1)
          ->get();

     }



     return view('lkps.kerjasama-tridharma.pendidikan.index', compact('tridharma_pendidikan','prodi','prod','th'));
}


public function kerja_sama_tridharma_penelitian(Request $request)
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

     $tridharma_penelitian = KerjasamaTridharmaPenelitian::where('id_prodi','like','%'. $request->filter_prodi .'%')
     ->where('tahun_berakhir', 'like','%'. $request->filter. '%')
     ->where('id_penunjukan',$penunjukan->id)
     ->where('status', 2)
     ->get();

}

if (Auth::user()->role == 'kappm') {

     $tridharma_penelitian = KerjasamaTridharmaPenelitian::where('id_prodi','like','%'. $request->filter_prodi .'%')
     ->where('tahun_berakhir', 'like','%'. $request->filter. '%')
     ->where('status', 1)
     ->get();


}




return view('lkps.kerjasama-tridharma.penelitian.index', compact('tridharma_penelitian','prodi','prod','th'));
}

public function kerja_sama_tridharma_pengabdian_kepada_masyarakat(Request $request)
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

          $tridharma_pkm = KerjasamaTridharmaPkm::where('id_prodi','like','%'. $request->filter_prodi .'%')
          ->where('tahun_berakhir', 'like','%'. $request->filter. '%')
          ->where('id_penunjukan',$penunjukan->id)
          ->where('status', 2)
          ->get();
     }


     if (Auth::user()->role == 'kappm') {
          $tridharma_pkm = KerjasamaTridharmaPkm::where('id_prodi','like','%'. $request->filter_prodi .'%')
          ->where('tahun_berakhir', 'like','%'. $request->filter. '%')
          ->where('status', 1)
          ->get();

     }

     
     return view('lkps.kerjasama-tridharma.pengabdian-kepada-masyarakat.index', compact('tridharma_pkm','prodi','prod','th'));
}


public function mahasiswa_seleksi_mahasiswa_baru(Request $request)
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


          $seleksi_mhs_baru = SeleksiMahasiswaBaru::orderBy('id', 'DESC')
          ->where('id_prodi','like','%'. $request->filter_prodi .'%')
          ->where('tahun_akademik', 'like','%'. $request->filter. '%')
          ->where('id_penunjukan',$penunjukan->id)
          ->where('status', 2)
          ->get();



          $calon_mhs_pendaftar = SeleksiMahasiswaBaru::where('status','1')->sum('jumlah_calonMahasiswa_pendaftar');
          $calon_mhs_lulus = SeleksiMahasiswaBaru::where('status','1')->sum('jumlah_calonMahasiswa_lulus');
          $mhs_baru_reguler = SeleksiMahasiswaBaru::where('status','1')->sum('jumlah_mahasiswaBaru_reguler');
          $mhs_baru_transfer = SeleksiMahasiswaBaru::where('status','1')->sum('jumlah_mahasiswaBaru_transfer');
          $mhs_aktif_reguler = SeleksiMahasiswaBaru::where('status','1')->sum('jumlah_mahasiswaAktif_reguler');
          $mhs_aktif_transfer = SeleksiMahasiswaBaru::where('status','1')->sum('jumlah_mahasiswaAktif_transfer');

     }


     if (Auth::user()->role == 'kappm') {

          $seleksi_mhs_baru = SeleksiMahasiswaBaru::orderBy('id', 'DESC')
          ->where('id_prodi','like','%'. $request->filter_prodi .'%')
          ->where('tahun_akademik', 'like','%'. $request->filter. '%')
          ->where('status', 1)
          ->get();



          $calon_mhs_pendaftar = SeleksiMahasiswaBaru::where('status','1')->sum('jumlah_calonMahasiswa_pendaftar');
          $calon_mhs_lulus = SeleksiMahasiswaBaru::where('status','1')->sum('jumlah_calonMahasiswa_lulus');
          $mhs_baru_reguler = SeleksiMahasiswaBaru::where('status','1')->sum('jumlah_mahasiswaBaru_reguler');
          $mhs_baru_transfer = SeleksiMahasiswaBaru::where('status','1')->sum('jumlah_mahasiswaBaru_transfer');
          $mhs_aktif_reguler = SeleksiMahasiswaBaru::where('status','1')->sum('jumlah_mahasiswaAktif_reguler');
          $mhs_aktif_transfer = SeleksiMahasiswaBaru::where('status','1')->sum('jumlah_mahasiswaAktif_transfer');

     }


     return view('lkps.mahasiswa.seleksi-mahasiswa-baru.index', compact('seleksi_mhs_baru', 'calon_mhs_pendaftar', 'calon_mhs_lulus', 'mhs_baru_reguler', 'mhs_baru_transfer', 'mhs_aktif_reguler', 'mhs_aktif_transfer','prodi','prod','th'));
}



public function lihat_mahasiswa_seleksi_mahasiswa_baru(Request $request)
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


     $seleksi_mhs_baru = SeleksiMahasiswaBaru::orderBy('id', 'DESC')
     ->where('id_prodi','like','%'. $request->filter_prodi .'%')
     ->where('tahun_akademik', 'like','%'. $request->filter. '%')
     ->where('id_penunjukan',$penunjukan->id)
     ->where('status', 2)
     ->get();



     $calon_mhs_pendaftar = SeleksiMahasiswaBaru::sum('jumlah_calonMahasiswa_pendaftar');
     $calon_mhs_lulus = SeleksiMahasiswaBaru::sum('jumlah_calonMahasiswa_lulus');
     $mhs_baru_reguler = SeleksiMahasiswaBaru::sum('jumlah_mahasiswaBaru_reguler');
     $mhs_baru_transfer = SeleksiMahasiswaBaru::sum('jumlah_mahasiswaBaru_transfer');
     $mhs_aktif_reguler = SeleksiMahasiswaBaru::sum('jumlah_mahasiswaAktif_reguler');
     $mhs_aktif_transfer = SeleksiMahasiswaBaru::sum('jumlah_mahasiswaAktif_transfer');

}


if (Auth::user()->role == 'kappm') {

     $seleksi_mhs_baru = SeleksiMahasiswaBaru::orderBy('id', 'DESC')
     ->where('id_prodi','like','%'. $request->filter_prodi .'%')
     ->where('tahun_akademik', 'like','%'. $request->filter. '%')
     ->where('status', 1)
     ->get();



     $calon_mhs_pendaftar = SeleksiMahasiswaBaru::sum('jumlah_calonMahasiswa_pendaftar');
     $calon_mhs_lulus = SeleksiMahasiswaBaru::sum('jumlah_calonMahasiswa_lulus');
     $mhs_baru_reguler = SeleksiMahasiswaBaru::sum('jumlah_mahasiswaBaru_reguler');
     $mhs_baru_transfer = SeleksiMahasiswaBaru::sum('jumlah_mahasiswaBaru_transfer');
     $mhs_aktif_reguler = SeleksiMahasiswaBaru::sum('jumlah_mahasiswaAktif_reguler');
     $mhs_aktif_transfer = SeleksiMahasiswaBaru::sum('jumlah_mahasiswaAktif_transfer');

}

return view('lkps.mahasiswa.seleksi-mahasiswa-baru.lihat_laporan', compact('seleksi_mhs_baru','calon_mhs_pendaftar', 'calon_mhs_lulus', 'mhs_baru_reguler', 'mhs_baru_transfer', 'mhs_aktif_reguler', 'mhs_aktif_transfer','prodi','prod','th'));
}

public function mahasiswa_mahasiswa_asing(Request $request)
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

          $mhs_asing = DB::table('mahasiswa_asing')
          ->join('prodi', 'mahasiswa_asing.id_prodi', '=', 'prodi.id')
          ->select('mahasiswa_asing.*', 'prodi.nama_prodi')
          ->orderBy('id', 'DESC')
          ->where('id_prodi','like','%'. $request->filter_prodi .'%')
          ->where('tahun_akademik', 'like','%'. $request->filter. '%')
          ->where('id_penunjukan',$penunjukan->id)
          ->where('status', 2)
          ->get();
     }


     if (Auth::user()->role == 'kappm') {

          $mhs_asing = DB::table('mahasiswa_asing')
          ->join('prodi', 'mahasiswa_asing.id_prodi', '=', 'prodi.id')
          ->select('mahasiswa_asing.*', 'prodi.nama_prodi')
          ->orderBy('id', 'DESC')
          ->where('id_prodi','like','%'. $request->filter_prodi .'%')
          ->where('tahun_akademik', 'like','%'. $request->filter. '%')
          ->where('status', 1)
          ->get();

     }




     return view('lkps.mahasiswa.mahasiswa-asing.index', compact('mhs_asing','prodi','prod','th'));
}

public function lihat_mahasiswa_mahasiswa_asing()
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

          $mhs_asing = DB::table('mahasiswa_asing')
          ->join('prodi', 'mahasiswa_asing.id_prodi', '=', 'prodi.id')
          ->select('mahasiswa_asing.*', 'prodi.nama_prodi')
          ->orderBy('id', 'DESC')
          ->where('id_prodi','like','%'. $request->filter_prodi .'%')
          ->where('tahun_akademik', 'like','%'. $request->filter. '%')
          ->where('id_penunjukan',$penunjukan->id)
          ->where('status', 2)
          ->get();
     }


     if (Auth::user()->role == 'kappm') {

          $mhs_asing = DB::table('mahasiswa_asing')
          ->join('prodi', 'mahasiswa_asing.id_prodi', '=', 'prodi.id')
          ->select('mahasiswa_asing.*', 'prodi.nama_prodi')
          ->orderBy('id', 'DESC')
          ->where('id_prodi','like','%'. $request->filter_prodi .'%')
          ->where('tahun_akademik', 'like','%'. $request->filter. '%')
          ->where('status', 1)
          ->get();

     }
     return view('lkps.mahasiswa.mahasiswa-asing.lihat_laporan', compact('mhs_asing','prodi','prod','th'));
}
}
