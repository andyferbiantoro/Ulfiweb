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

class LkpsProdiProfilDosenController extends Controller
{

    public function profil_dosen_dosen_tetap_perguruan_tinggi(Request $request)
    {

        $dosen = Dosen::where('id_prodi', Auth::user()->id_prodi)->get();
        $filter = $request->filter;

        if ($filter == Null) {
           $data_dosen_perguruantinggi = DB::table('dosen_tetap_perguruantinggi')
           ->join('dosen', 'dosen_tetap_perguruantinggi.id_dosen', '=', 'dosen.id')
           ->select('dosen_tetap_perguruantinggi.*', 'dosen.nama_dosen')
           ->orderBy('id', 'DESC')
           ->where('dosen_tetap_perguruantinggi.id_user', Auth::user()->id)
           ->get();
       } else {
          $data_dosen_perguruantinggi = DB::table('dosen_tetap_perguruantinggi')
          ->join('dosen', 'dosen_tetap_perguruantinggi.id_dosen', '=', 'dosen.id')
          ->select('dosen_tetap_perguruantinggi.*', 'dosen.nama_dosen')
          ->orderBy('id', 'DESC')
          ->where('dosen_tetap_perguruantinggi.id_user', Auth::user()->id)
          ->where('tahun',$filter)
          ->get();
      }
      return view('lkps-prodi.profil-dosen.dosen-tetap-perguruan-tinggi.index',compact('dosen','data_dosen_perguruantinggi'));
  }

  public function profil_dosen_dosen_tetap_perguruan_tinggi_add(Request $request)
  {

   $data_profil_dosen = new DosenTetapPerguruanTinggi();

   $data_profil_dosen->nidn = $request->input('nidn');
   $data_profil_dosen->pendidikan_pasca_sarjana = $request->input('pendidikan_pasca_sarjana');
   $data_profil_dosen->bidang_keahlian = $request->input('bidang_keahlian');
   $data_profil_dosen->kesesuaian_kompotensi_prodi = $request->input('kesesuaian_kompotensi_prodi');
   $data_profil_dosen->jabatan_akademik = $request->input('jabatan_akademik');
   $data_profil_dosen->link_sertifikat_pendidik = $request->input('link_sertifikat_pendidik');
   $data_profil_dosen->link_sertifikat_kompetensi = $request->input('link_sertifikat_kompetensi');
   $data_profil_dosen->matakuliah_prodi_diakreditasi = $request->input('matakuliah_prodi_diakreditasi');
   $data_profil_dosen->kesesuaian_bidang_keahlian = $request->input('kesesuaian_bidang_keahlian');
   $data_profil_dosen->matakuliah_prodi_lain = $request->input('matakuliah_prodi_lain');
   $data_profil_dosen->link_bukti_dokumen = $request->input('link_bukti_dokumen');
   $data_profil_dosen->tahun = $request->input('tahun');
   $data_profil_dosen->id_user  = $request->input('id_user');
   $data_profil_dosen->id_dosen  = $request->input('id_dosen');
   $data_add->id_prodi = Auth::user()->id_prodi;
   $data_add->status = '0';

   if ($request->hasFile('file_sertifikat_kompetensi')) {
       $file = $request->file('file_sertifikat_kompetensi');
       $extension = $file->getClientOriginalExtension();
       $filename = $file->getClientOriginalName();
       $path = $file->store('public/uploads/profil_dosen_perguruantinggi/file_sertifikat_kompetensi');
       $file->move('uploads/profil_dosen_perguruantinggi/file_sertifikat_kompetensi/', $filename);
       $data_profil_dosen->file_sertifikat_kompetensi = $filename;
       $data_profil_dosen->path_kompetensi = $path;
   } else {
       echo "Gagal upload gambar";
   }

   if ($request->hasFile('file_sertifikat_pendidik')) {
       $file = $request->file('file_sertifikat_pendidik');
       $extension = $file->getClientOriginalExtension();
       $filename = $file->getClientOriginalName();
       $path = $file->store('public/uploads/profil_dosen_perguruantinggi/file_sertifikat_pendidik');
       $file->move('uploads/profil_dosen_perguruantinggi/file_sertifikat_pendidik/', $filename);
       $data_profil_dosen->file_sertifikat_pendidik = $filename;
       $data_profil_dosen->path_pendidik = $path;
   } else {
       echo "Gagal upload gambar";
   }

   if ($request->hasFile('file_bukti_dokumen')) {
       $file = $request->file('file_bukti_dokumen');
       $extension = $file->getClientOriginalExtension();
       $filename = $file->getClientOriginalName();
       $path = $file->store('public/uploads/profil_dosen_perguruantinggi/file_bukti_dokumen');
       $file->move('uploads/profil_dosen_perguruantinggi/file_bukti_dokumen/', $filename);
       $data_profil_dosen->file_bukti_dokumen = $filename;
       $data_profil_dosen->path_bukti = $path;
   } else {
       echo "Gagal upload gambar";
   }




   $data_profil_dosen->save();

   return redirect('/prodi_profil_dosen_dosen_tetap_perguruan_tinggi')->with('success', 'Data profil Dosen Tetap Perguruan Tinggi Baru Berhasil Ditambahkan');
}

public function file_download_ser_pendidik($id)
{

  $download = DosenTetapPerguruanTinggi::find($id);

  return  Storage::download($download->path_pendidik, $download->file_sertifikat_pendidik);
}

public function file_download_ser_kompetensi($id)
{

  $download = DosenTetapPerguruanTinggi::find($id);

  return  Storage::download($download->path_kompetensi, $download->file_sertifikat_kompetensi);
}

public function file_download_bukti_dokumen($id)
{

  $download = DosenTetapPerguruanTinggi::find($id);

  return  Storage::download($download->path_bukti, $download->file_bukti_dokumen);
}

public function profil_dosen_dosen_tetap_perguruan_tinggi_update(Request $request, $id)
{

  $data_dosen_update = DosenTetapPerguruanTinggi::where('id', $id)->first();


  $input = [
   'nidn' => $request->nidn,
   'pendidikan_pasca_sarjana' => $request->pendidikan_pasca_sarjana,
   'bidang_keahlian' => $request->bidang_keahlian,
   'kesesuaian_kompotensi_prodi' => $request->kesesuaian_kompotensi_prodi,
   'jabatan_akademik' => $request->jabatan_akademik,
   'link_sertifikat_pendidik' => $request->link_sertifikat_pendidik,
   'link_sertifikat_kompetensi' => $request->link_sertifikat_kompetensi,
   'matakuliah_prodi_diakreditasi' => $request->matakuliah_prodi_diakreditasi,
   'kesesuaian_bidang_keahlian' => $request->kesesuaian_bidang_keahlian,
   'matakuliah_prodi_lain' => $request->matakuliah_prodi_lain,
   'link_bukti_dokumen' => $request->link_bukti_dokumen,
   'tahun' => $request->tahun,
   'id_user' => $request->id_user,

];

if ($file = $request->file('file_sertifikat_kompetensi')) {
   if ($data_lkps_update->file_sertifikat_kompetensi) {
    File::delete('uploads/profil_dosen_perguruantinggi/file_sertifikat_kompetensi/' . $data_lkps_update->file_sertifikat_kompetensi);
}
$nama_file = $file->getClientOriginalName();
$path = $file->store('public/uploads/profil_dosen_perguruantinggi/file_sertifikat_kompetensi');
$file->move(public_path() . '/uploads/profil_dosen_perguruantinggi/file_sertifikat_kompetensi/', $nama_file);
$input['file_sertifikat_kompetensi'] = $nama_file;
$input['path_kompetensi'] = $path;
}


if ($file = $request->file('file_sertifikat_pendidik')) {
   if ($data_lkps_update->file_sertifikat_pendidik) {
    File::delete('uploads/profil_dosen_perguruantinggi/file_sertifikat_pendidik/' . $data_lkps_update->file_sertifikat_pendidik);
}
$nama_file = $file->getClientOriginalName();
$path = $file->store('public/uploads/profil_dosen_perguruantinggi/file_sertifikat_pendidik');
$file->move(public_path() . '/uploads/profil_dosen_perguruantinggi/file_sertifikat_pendidik/', $nama_file);
$input['file_sertifikat_pendidik'] = $nama_file;
$input['path_pendidik'] = $path;
}


if ($file = $request->file('file_bukti_dokumen')) {
   if ($data_lkps_update->file_bukti_dokumen) {
    File::delete('uploads/profil_dosen_perguruantinggi/file_bukti_dokumen/' . $data_lkps_update->file_bukti_dokumen);
}
$nama_file = $file->getClientOriginalName();
$path = $file->store('public/uploads/profil_dosen_perguruantinggi/file_bukti_dokumen');
$file->move(public_path() . '/uploads/profil_dosen_perguruantinggi/file_bukti_dokumen/', $nama_file);
$input['file_bukti_dokumen'] = $nama_file;
$input['path_bukti'] = $path;
}


$data_dosen_update->update($input);

return redirect('/prodi_profil_dosen_dosen_tetap_perguruan_tinggi')->with('success', 'Data profil Dosen Tetap Perguruan Tinggi Berhasil Diupdate');
}


public function profil_dosen_dosen_tetap_perguruan_tinggi_delete($id)
{
  $delete = DosenTetapPerguruanTinggi::findOrFail($id);
  $delete->delete();

 return redirect('/prodi_profil_dosen_dosen_tetap_perguruan_tinggi')->with('success', 'Data profil Dosen Tetap Perguruan Tinggi Berhasil Dihapus');
}
//======================================================================================================================================

public function profil_dosen_dosen_pembimbing_utama_tugas_akhir(Request $request)
{

    $dosen = Dosen::where('id_prodi', Auth::user()->id_prodi)->get();
    $filter = $request->filter;

    if ($filter == Null) {
       $data_dospem_utama_tugasakhir = DB::table('dospem_utama_tugasakhir')
       ->join('dosen', 'dospem_utama_tugasakhir.id_dosen', '=', 'dosen.id')
       ->select('dospem_utama_tugasakhir.*', 'dosen.nama_dosen')
       ->orderBy('id', 'DESC')
       ->where('dospem_utama_tugasakhir.id_user', Auth::user()->id)
       ->get();


       foreach ($data_dospem_utama_tugasakhir as $key => $value) {

           $rata2_1 = ($value->jumlahMahasiswa_prodiDiakreditasi_ts2 + $value->jumlahMahasiswa_prodiDiakreditasi_ts1 + $value->jumlahMahasiswa_prodiDiakreditasi_ts)/3;
           $rata2_2 = ($value->jumlahMahasiswa_prodiLain_perguruanTinggi_ts2 + $value->jumlahMahasiswa_prodiLain_perguruanTinggi_ts1 + $value->jumlahMahasiswa_prodiLain_perguruanTinggi_ts)/3;
           $rata2_bimbingan = ($rata2_1 +  $rata2_2)/2;

           $value->rata2_1 = round($rata2_1, 2);
           $value->rata2_2 = round($rata2_2, 2);
           $value->rata2_bimbingan = round($rata2_bimbingan, 2);

       }

   } else {
      $data_dospem_utama_tugasakhir = DB::table('dospem_utama_tugasakhir')
      ->join('dosen', 'dospem_utama_tugasakhir.id_dosen', '=', 'dosen.id')
      ->select('dospem_utama_tugasakhir.*', 'dosen.nama_dosen')
      ->orderBy('id', 'DESC')
      ->where('dospem_utama_tugasakhir.id_user', Auth::user()->id)
      ->where('tahun_akademik',$filter)
      ->get();

      foreach ($data_dospem_utama_tugasakhir as $key => $value) {

       $rata2_1 = ($value->jumlahMahasiswa_prodiDiakreditasi_ts2 + $value->jumlahMahasiswa_prodiDiakreditasi_ts1 + $value->jumlahMahasiswa_prodiDiakreditasi_ts)/3;
       $rata2_2 = ($value->jumlahMahasiswa_prodiLain_perguruanTinggi_ts2 + $value->jumlahMahasiswa_prodiLain_perguruanTinggi_ts1 + $value->jumlahMahasiswa_prodiLain_perguruanTinggi_ts)/3;

       $value->rata2_1 = round($rata2_1, 2);
       $value->rata2_2 = round($rata2_2, 2);
       $value->rata2_bimbingan = round($rata2_bimbingan, 2);

   }
}

return view('lkps-prodi.profil-dosen.dosen-pembimbing-utama-tugas-akhir.index',compact('data_dospem_utama_tugasakhir','dosen'));
}

public function lihat_profil_dosen_dosen_pembimbing_utama_tugas_akhir(Request $request)
{      

   $filter = $request->filter;

   if ($filter == Null) {
       $data_dospem_utama_tugasakhir = DB::table('dospem_utama_tugasakhir')
       ->join('dosen', 'dospem_utama_tugasakhir.id_dosen', '=', 'dosen.id')
       ->select('dospem_utama_tugasakhir.*', 'dosen.nama_dosen')
       ->orderBy('id', 'DESC')
       ->where('dospem_utama_tugasakhir.id_user', Auth::user()->id)
       ->get();


       foreach ($data_dospem_utama_tugasakhir as $key => $value) {

           $rata2_1 = ($value->jumlahMahasiswa_prodiDiakreditasi_ts2 + $value->jumlahMahasiswa_prodiDiakreditasi_ts1 + $value->jumlahMahasiswa_prodiDiakreditasi_ts)/3;
           $rata2_2 = ($value->jumlahMahasiswa_prodiLain_perguruanTinggi_ts2 + $value->jumlahMahasiswa_prodiLain_perguruanTinggi_ts1 + $value->jumlahMahasiswa_prodiLain_perguruanTinggi_ts)/3;
           $rata2_bimbingan = ($rata2_1 +  $rata2_2)/2;

           $value->rata2_1 = round($rata2_1, 2);
           $value->rata2_2 = round($rata2_2, 2);
           $value->rata2_bimbingan = round($rata2_bimbingan, 2);

       }

   } else {
      $data_dospem_utama_tugasakhir = DB::table('dospem_utama_tugasakhir')
      ->join('dosen', 'dospem_utama_tugasakhir.id_dosen', '=', 'dosen.id')
      ->select('dospem_utama_tugasakhir.*', 'dosen.nama_dosen')
      ->orderBy('id', 'DESC')
      ->where('dospem_utama_tugasakhir.id_user', Auth::user()->id)
      ->where('tahun_akademik',$filter)
      ->get();

      foreach ($data_dospem_utama_tugasakhir as $key => $value) {

       $rata2_1 = ($value->jumlahMahasiswa_prodiDiakreditasi_ts2 + $value->jumlahMahasiswa_prodiDiakreditasi_ts1 + $value->jumlahMahasiswa_prodiDiakreditasi_ts)/3;
       $rata2_2 = ($value->jumlahMahasiswa_prodiLain_perguruanTinggi_ts2 + $value->jumlahMahasiswa_prodiLain_perguruanTinggi_ts1 + $value->jumlahMahasiswa_prodiLain_perguruanTinggi_ts)/3;

       $value->rata2_1 = round($rata2_1, 2);
       $value->rata2_2 = round($rata2_2, 2);
       $value->rata2_bimbingan = round($rata2_bimbingan, 2);

   }
}
return view('lkps-prodi.profil-dosen.dosen-pembimbing-utama-tugas-akhir.lihat_laporan',compact('data_dospem_utama_tugasakhir'));
}


public function profil_dosen_dosen_pembimbing_utama_tugas_akhir_add(Request $request)
{

   $data_profil_dosen = new DosenUtamaTugasAkhir();

   $data_profil_dosen->jumlahMahasiswa_prodiDiakreditasi_ts2 = $request->input('jumlahMahasiswa_prodiDiakreditasi_ts2');
   $data_profil_dosen->jumlahMahasiswa_prodiDiakreditasi_ts1 = $request->input('jumlahMahasiswa_prodiDiakreditasi_ts1');
   $data_profil_dosen->jumlahMahasiswa_prodiDiakreditasi_ts = $request->input('jumlahMahasiswa_prodiDiakreditasi_ts');
   $data_profil_dosen->jumlahMahasiswa_prodiLain_perguruanTinggi_ts2 = $request->input('jumlahMahasiswa_prodiLain_perguruanTinggi_ts2');
   $data_profil_dosen->jumlahMahasiswa_prodiLain_perguruanTinggi_ts1 = $request->input('jumlahMahasiswa_prodiLain_perguruanTinggi_ts1');
   $data_profil_dosen->jumlahMahasiswa_prodiLain_perguruanTinggi_ts = $request->input('jumlahMahasiswa_prodiLain_perguruanTinggi_ts');
   $data_profil_dosen->tahun_akademik = $request->input('tahun_akademik');
   $data_profil_dosen->link_bukti_dokumen = $request->input('link_bukti_dokumen');
   $data_profil_dosen->id_user  = $request->input('id_user');
   $data_profil_dosen->id_dosen  = $request->input('id_dosen');
   $data_add->id_prodi = Auth::user()->id_prodi;
   $data_add->status = '0';


   if ($request->hasFile('file_bukti_dokumen')) {
       $file = $request->file('file_bukti_dokumen');
       $extension = $file->getClientOriginalExtension();
       $filename = $file->getClientOriginalName();
       $path = $file->store('public/uploads/profil_dospem_utama_tugasakhir');
       $file->move('uploads/profil_dospem_utama_tugasakhir/', $filename);
       $data_profil_dosen->file_bukti_dokumen = $filename;
       $data_profil_dosen->path = $path;
   } else {
       echo "Gagal upload gambar";
   }


   $data_profil_dosen->save();

   return redirect('/prodi_profil_dosen_dosen_pembimbing_utama_tugas_akhir')->with('success', 'Data profil Dospem Utama Tugas Akhir Baru Berhasil Ditambahkan');
}

public function file_download_bukti_dokumen_dospem($id)
{

  $download = DosenUtamaTugasAkhir::find($id);

  return  Storage::download($download->path, $download->file_bukti_dokumen);
}


public function profil_dosen_dosen_pembimbing_utama_tugas_akhir_update(Request $request, $id)
{

  $data_dosen_update = DosenUtamaTugasAkhir::where('id', $id)->first();


  $input = [
   'jumlahMahasiswa_prodiDiakreditasi_ts2' => $request->jumlahMahasiswa_prodiDiakreditasi_ts2,
   'jumlahMahasiswa_prodiDiakreditasi_ts1' => $request->jumlahMahasiswa_prodiDiakreditasi_ts1,
   'jumlahMahasiswa_prodiDiakreditasi_ts' => $request->jumlahMahasiswa_prodiDiakreditasi_ts,
   'jumlahMahasiswa_prodiLain_perguruanTinggi_ts2' => $request->jumlahMahasiswa_prodiLain_perguruanTinggi_ts2,
   'jumlahMahasiswa_prodiLain_perguruanTinggi_ts1' => $request->jumlahMahasiswa_prodiLain_perguruanTinggi_ts1,
   'jumlahMahasiswa_prodiLain_perguruanTinggi_ts' => $request->jumlahMahasiswa_prodiLain_perguruanTinggi_ts,
   'tahun_akademik' => $request->tahun_akademik,
   'link_bukti_dokumen' => $request->link_bukti_dokumen,
];

if ($file = $request->file('file_bukti_dokumen')) {
   if ($data_dosen_update->file_bukti_dokumen) {
    File::delete('uploads/profil_dospem_utama_tugasakhir/' . $data_dosen_update->file_bukti_dokumen);
}
$nama_file = $file->getClientOriginalName();
$path = $file->store('public/uploads/profil_dospem_utama_tugasakhir');
$file->move(public_path() . '/uploads/profil_dospem_utama_tugasakhir/', $nama_file);
$input['file_bukti_dokumen'] = $nama_file;
$input['path'] = $path;
}


$data_dosen_update->update($input);

return redirect('/prodi_profil_dosen_dosen_pembimbing_utama_tugas_akhir')->with('success', 'Data profil Dospem Utama Tugas Akhir Berhasil Diupdate');
}


public function profil_dosen_dosen_pembimbing_utama_tugas_akhir_delete($id)
{
  $delete = DosenUtamaTugasAkhir::findOrFail($id);
  $delete->delete();

  return redirect('/prodi_profil_dosen_dosen_pembimbing_utama_tugas_akhir')->with('success', 'Data profil Dospem Utama Tugas Akhir Berhasil Dihapus');
}

//=========================================================================================================================================

public function profil_dosen_ewmp_dosen_tetap_perguruan_tinggi(Request $request)
{

    $dosen = Dosen::where('id_prodi', Auth::user()->id_prodi)->get();
    $filter = $request->filter;

    if ($filter == Null) {
       $data_ewmp_dosen = DB::table('ewmp_dosentetap_perguruantinggi')
       ->join('dosen', 'ewmp_dosentetap_perguruantinggi.id_dosen', '=', 'dosen.id')
       ->select('ewmp_dosentetap_perguruantinggi.*', 'dosen.nama_dosen')
       ->orderBy('id', 'DESC')
       ->where('ewmp_dosentetap_perguruantinggi.id_user', Auth::user()->id)
       ->get();


       foreach ($data_ewmp_dosen as $key => $value) {

           $jumlah_sks = $value->ewmp_pendidikanProdi_diakreditasi + $value->ewmp_pendidikanProdiLain_didalamPerguruanTinggi + $value->ewmp_pendidikanProdiLain_diluarPerguruanTinggi + $value->ewmp_penelitian + $value->ewmp_pkm + $value->ewmp_tugas_tambahan;
           $rata2_per_semester = $jumlah_sks/2;

           $value->jumlah_sks = round($jumlah_sks, 2);
           $value->rata2_per_semester = round($rata2_per_semester, 2);

       }

     // return $data_ewmp_dosen;

   } else {
      $data_ewmp_dosen = DB::table('ewmp_dosentetap_perguruantinggi')
      ->join('dosen', 'ewmp_dosentetap_perguruantinggi.id_dosen', '=', 'dosen.id')
      ->select('ewmp_dosentetap_perguruantinggi.*', 'dosen.nama_dosen')
      ->orderBy('id', 'DESC')
      ->where('ewmp_dosentetap_perguruantinggi.id_user', Auth::user()->id)
      ->where('tahun',$filter)
      ->get();

      foreach ($data_ewmp_dosen as $key => $value) {

        $jumlah_sks = $value->ewmp_pendidikanProdi_diakreditasi + $value->ewmp_pendidikanProdiLain_didalamPerguruanTinggi + $value->ewmp_pendidikanProdiLain_diluarPerguruanTinggi + $value->ewmp_penelitian + $value->ewmp_pkm + $value->ewmp_tugas_tambahan;
        $rata2_per_semester = $jumlah_sks/2;

        $value->jumlah_sks = round($jumlah_sks, 2);
        $value->rata2_per_semester = round($rata2_per_semester, 2);

    }
}
return view('lkps-prodi.profil-dosen.ewmp-dosen-tetap-perguruan-tinggi.index',compact('data_ewmp_dosen','dosen'));
}


public function profil_dosen_ewmp_dosen_tetap_perguruan_tinggi_add(Request $request)
{

   $data_profil_dosen = new EwmpDosenTetapPerguruanTinggi();

   $data_profil_dosen->dtps = $request->input('dtps');
   $data_profil_dosen->ewmp_pendidikanProdi_diakreditasi = $request->input('ewmp_pendidikanProdi_diakreditasi');
   $data_profil_dosen->ewmp_pendidikanProdiLain_didalamPerguruanTinggi = $request->input('ewmp_pendidikanProdiLain_didalamPerguruanTinggi');
   $data_profil_dosen->ewmp_pendidikanProdiLain_diluarPerguruanTinggi = $request->input('ewmp_pendidikanProdiLain_diluarPerguruanTinggi');
   $data_profil_dosen->ewmp_penelitian = $request->input('ewmp_penelitian');
   $data_profil_dosen->ewmp_pkm = $request->input('ewmp_pkm');
   $data_profil_dosen->ewmp_tugas_tambahan = $request->input('ewmp_tugas_tambahan');
   $data_profil_dosen->link_bukti_dokumen = $request->input('link_bukti_dokumen');
   $data_profil_dosen->tahun = $request->input('tahun');
   $data_profil_dosen->id_user  = $request->input('id_user');
   $data_profil_dosen->id_dosen  = $request->input('id_dosen');
   $data_add->id_prodi = Auth::user()->id_prodi;
   $data_add->status = '0';


   if ($request->hasFile('file_bukti_dokumen')) {
       $file = $request->file('file_bukti_dokumen');
       $extension = $file->getClientOriginalExtension();
       $filename = $file->getClientOriginalName();
       $path = $file->store('public/uploads/ewmp_dosentetap_perguruantinggi');
       $file->move('uploads/ewmp_dosentetap_perguruantinggi/', $filename);
       $data_profil_dosen->file_bukti_dokumen = $filename;
       $data_profil_dosen->path = $path;
   } else {
       echo "Gagal upload gambar";
   }


   $data_profil_dosen->save();

   return redirect('/prodi_profil_dosen_ewmp_dosen_tetap_perguruan_tinggi')->with('success', 'Data Ewmp Dosen Tetap Perguruan Tinggi Baru Berhasil Ditambahkan');
}

public function file_download_bukti_dokumen_ewmp($id)
{

  $download = EwmpDosenTetapPerguruanTinggi::find($id);

  return  Storage::download($download->path, $download->ewmp_dosentetap_perguruantinggi);
}


public function profil_dosen_ewmp_dosen_tetap_perguruan_tinggi_update(Request $request, $id)
{

  $data_dosen_update = EwmpDosenTetapPerguruanTinggi::where('id', $id)->first();


  $input = [
    'dtps' => $request->dtps,
    'ewmp_pendidikanProdi_diakreditasi' => $request->ewmp_pendidikanProdi_diakreditasi,
    'ewmp_pendidikanProdiLain_didalamPerguruanTinggi' => $request->ewmp_pendidikanProdiLain_didalamPerguruanTinggi,
    'ewmp_pendidikanProdiLain_diluarPerguruanTinggi' => $request->ewmp_pendidikanProdiLain_diluarPerguruanTinggi,
    'ewmp_penelitian' => $request->ewmp_penelitian,
    'ewmp_pkm' => $request->ewmp_pkm,
    'ewmp_tugas_tambahan' => $request->ewmp_tugas_tambahan,
    'link_bukti_dokumen' => $request->link_bukti_dokumen,
    'tahun' => $request->tahun,
];

if ($file = $request->file('file_bukti_dokumen')) {
   if ($data_dosen_update->file_bukti_dokumen) {
    File::delete('uploads/ewmp_dosentetap_perguruantinggi/' . $data_dosen_update->file_bukti_dokumen);
}
$nama_file = $file->getClientOriginalName();
$path = $file->store('public/uploads/ewmp_dosentetap_perguruantinggi');
$file->move(public_path() . '/uploads/ewmp_dosentetap_perguruantinggi/', $nama_file);
$input['file_bukti_dokumen'] = $nama_file;
$input['path'] = $path;
}


$data_dosen_update->update($input);

return redirect('/prodi_profil_dosen_ewmp_dosen_tetap_perguruan_tinggi')->with('success', 'Data Ewmp Dosen Tetap Perguruan Tinggi Baru Berhasil Diupdate');
}

public function lihat_profil_dosen_ewmp_dosen_tetap_perguruan_tinggi(Request $request)
{

   $filter = $request->filter;

   if ($filter == Null) {
       $data_ewmp_dosen = DB::table('ewmp_dosentetap_perguruantinggi')
       ->join('dosen', 'ewmp_dosentetap_perguruantinggi.id_dosen', '=', 'dosen.id')
       ->select('ewmp_dosentetap_perguruantinggi.*', 'dosen.nama_dosen')
       ->orderBy('id', 'DESC')
       ->where('ewmp_dosentetap_perguruantinggi.id_user', Auth::user()->id)
       ->get();


       foreach ($data_ewmp_dosen as $key => $value) {

           $jumlah_sks = $value->ewmp_pendidikanProdi_diakreditasi + $value->ewmp_pendidikanProdiLain_didalamPerguruanTinggi + $value->ewmp_pendidikanProdiLain_diluarPerguruanTinggi + $value->ewmp_penelitian + $value->ewmp_pkm + $value->ewmp_tugas_tambahan;
           $rata2_per_semester = $jumlah_sks/2;

           $value->jumlah_sks = round($jumlah_sks, 2);
           $value->rata2_per_semester = round($rata2_per_semester, 2);

       }

     // return $data_ewmp_dosen;

   } else {
      $data_ewmp_dosen = DB::table('ewmp_dosentetap_perguruantinggi')
      ->join('dosen', 'ewmp_dosentetap_perguruantinggi.id_dosen', '=', 'dosen.id')
      ->select('ewmp_dosentetap_perguruantinggi.*', 'dosen.nama_dosen')
      ->orderBy('id', 'DESC')
      ->where('ewmp_dosentetap_perguruantinggi.id_user', Auth::user()->id)
      ->where('tahun',$filter)
      ->get();

      foreach ($data_ewmp_dosen as $key => $value) {

        $jumlah_sks = $value->ewmp_pendidikanProdi_diakreditasi + $value->ewmp_pendidikanProdiLain_didalamPerguruanTinggi + $value->ewmp_pendidikanProdiLain_diluarPerguruanTinggi + $value->ewmp_penelitian + $value->ewmp_pkm + $value->ewmp_tugas_tambahan;
        $rata2_per_semester = $jumlah_sks/2;

        $value->jumlah_sks = round($jumlah_sks, 2);
        $value->rata2_per_semester = round($rata2_per_semester, 2);

    }
}
return view('lkps-prodi.profil-dosen.ewmp-dosen-tetap-perguruan-tinggi.lihat_laporan',compact('data_ewmp_dosen'));
}

public function profil_dosen_ewmp_dosen_tetap_perguruan_tinggi_delete($id)
{
  $delete = EwmpDosenTetapPerguruanTinggi::findOrFail($id);
  $delete->delete();

  return redirect('/prodi_profil_dosen_ewmp_dosen_tetap_perguruan_tinggi')->with('success', 'Data Ewmp Dosen Tetap Perguruan Tinggi Baru Berhasil Dihapus');
}

//===================================================================================================================================

public function profil_dosen_dosen_tidak_tetap(Request $request)
{

    $dosen = Dosen::where('id_prodi', Auth::user()->id_prodi)->get();
    $filter = $request->filter;

    if ($filter == Null) {
       $dosen_tidak_tetap = DB::table('dosen_tidak_tetap')
       ->join('dosen', 'dosen_tidak_tetap.id_dosen', '=', 'dosen.id')
       ->select('dosen_tidak_tetap.*', 'dosen.nama_dosen')
       ->orderBy('id', 'DESC')
       ->where('dosen_tidak_tetap.id_user', Auth::user()->id)
       ->get();
   } else {
      $dosen_tidak_tetap = DB::table('dosen_tidak_tetap')
      ->join('dosen', 'dosen_tidak_tetap.id_dosen', '=', 'dosen.id')
      ->select('dosen_tidak_tetap.*', 'dosen.nama_dosen')
      ->orderBy('id', 'DESC')
      ->where('dosen_tidak_tetap.id_user', Auth::user()->id)
      ->where('tahun',$filter)
      ->get();
  }
  return view('lkps-prodi.profil-dosen.dosen-tidak-tetap.index',compact('dosen','dosen_tidak_tetap'));
}


public function profil_dosen_dosen_tidak_tetap_add(Request $request)
{

   $data_profil_dosen = new DosenTidakTetap();

   $data_profil_dosen->nidn = $request->input('nidn');
   $data_profil_dosen->pendidikan_pasca_sarjana = $request->input('pendidikan_pasca_sarjana');
   $data_profil_dosen->bidang_keahlian = $request->input('bidang_keahlian');
   $data_profil_dosen->jabatan_akademik = $request->input('jabatan_akademik');
   $data_profil_dosen->link_sertifikat_pendidik = $request->input('link_sertifikat_pendidik');
   $data_profil_dosen->link_sertifikat_kompetensi = $request->input('link_sertifikat_kompetensi');
   $data_profil_dosen->matakuliah_prodi_diakreditasi = $request->input('matakuliah_prodi_diakreditasi');
   $data_profil_dosen->kesesuaian_bidang_keahlian = $request->input('kesesuaian_bidang_keahlian');
   $data_profil_dosen->link_bukti_dokumen = $request->input('link_bukti_dokumen');
   $data_profil_dosen->tahun = $request->input('tahun');
   $data_profil_dosen->id_user  = $request->input('id_user');
   $data_profil_dosen->id_dosen  = $request->input('id_dosen');
   $data_add->id_prodi = Auth::user()->id_prodi;
   $data_add->status = '0';

   if ($request->hasFile('file_sertifikat_kompetensi')) {
       $file = $request->file('file_sertifikat_kompetensi');
       $extension = $file->getClientOriginalExtension();
       $filename = $file->getClientOriginalName();
       $path = $file->store('public/uploads/profil_dosen_tidaktetap/file_sertifikat_kompetensi');
       $file->move('uploads/profil_dosen_tidaktetap/file_sertifikat_kompetensi/', $filename);
       $data_profil_dosen->file_sertifikat_kompetensi = $filename;
       $data_profil_dosen->path_kompetensi = $path;
   } else {
       echo "Gagal upload gambar";
   }

   if ($request->hasFile('file_sertifikat_pendidik')) {
       $file = $request->file('file_sertifikat_pendidik');
       $extension = $file->getClientOriginalExtension();
       $filename = $file->getClientOriginalName();
       $path = $file->store('public/uploads/profil_dosen_tidaktetap/file_sertifikat_pendidik');
       $file->move('uploads/profil_dosen_tidaktetap/file_sertifikat_pendidik/', $filename);
       $data_profil_dosen->file_sertifikat_pendidik = $filename;
       $data_profil_dosen->path_pendidik = $path;
   } else {
       echo "Gagal upload gambar";
   }

   if ($request->hasFile('file_bukti_dokumen')) {
       $file = $request->file('file_bukti_dokumen');
       $extension = $file->getClientOriginalExtension();
       $filename = $file->getClientOriginalName();
       $path = $file->store('public/uploads/profil_dosen_tidaktetap/file_bukti_dokumen');
       $file->move('uploads/profil_dosen_tidaktetap/file_bukti_dokumen/', $filename);
       $data_profil_dosen->file_bukti_dokumen = $filename;
       $data_profil_dosen->path_bukti = $path;
   } else {
       echo "Gagal upload gambar";
   }




   $data_profil_dosen->save();

   return redirect('/prodi_profil_dosen_dosen_tidak_tetap')->with('success', 'Data profil Dosen Tidak Tetap Baru Berhasil Ditambahkan');
}

public function file_download_ser_pendidik_tidak_tetap($id)
{

  $download = DosenTidakTetap::find($id);

  return  Storage::download($download->path_pendidik, $download->file_sertifikat_pendidik);
}

public function file_download_ser_kompetensi_tidak_tetap($id)
{

  $download = DosenTidakTetap::find($id);

  return  Storage::download($download->path_kompetensi, $download->file_sertifikat_kompetensi);
}

public function file_download_bukti_dokumen_tidak_tetap($id)
{

  $download = DosenTidakTetap::find($id);

  return  Storage::download($download->path_bukti, $download->file_bukti_dokumen);
}


public function profil_dosen_dosen_tidak_tetap_update(Request $request, $id)
{

  $data_dosen_update = DosenTidakTetap::where('id', $id)->first();


  $input = [
   'nidn' => $request->nidn,
   'pendidikan_pasca_sarjana' => $request->pendidikan_pasca_sarjana,
   'bidang_keahlian' => $request->bidang_keahlian,
   'jabatan_akademik' => $request->jabatan_akademik,
   'link_sertifikat_pendidik' => $request->link_sertifikat_pendidik,
   'link_sertifikat_kompetensi' => $request->link_sertifikat_kompetensi,
   'matakuliah_prodi_diakreditasi' => $request->matakuliah_prodi_diakreditasi,
   'kesesuaian_bidang_keahlian' => $request->kesesuaian_bidang_keahlian,
   'link_bukti_dokumen' => $request->link_bukti_dokumen,
   'tahun' => $request->tahun,
   'id_user' => $request->id_user,

];

if ($file = $request->file('file_sertifikat_kompetensi')) {
   if ($data_dosen_update->file_sertifikat_kompetensi) {
    File::delete('uploads/profil_dosen_tidaktetap/file_sertifikat_kompetensi/' . $data_dosen_update->file_sertifikat_kompetensi);
}
$nama_file = $file->getClientOriginalName();
$path = $file->store('public/uploads/profil_dosen_tidaktetap/file_sertifikat_kompetensi');
$file->move(public_path() . '/uploads/profil_dosen_tidaktetap/file_sertifikat_kompetensi/', $nama_file);
$input['file_sertifikat_kompetensi'] = $nama_file;
$input['path_kompetensi'] = $path;
}


if ($file = $request->file('file_sertifikat_pendidik')) {
   if ($data_dosen_update->file_sertifikat_pendidik) {
    File::delete('uploads/profil_dosen_tidaktetap/file_sertifikat_pendidik/' . $data_dosen_update->file_sertifikat_pendidik);
}
$nama_file = $file->getClientOriginalName();
$path = $file->store('public/uploads/profil_dosen_tidaktetap/file_sertifikat_pendidik');
$file->move(public_path() . '/uploads/profil_dosen_tidaktetap/file_sertifikat_pendidik/', $nama_file);
$input['file_sertifikat_pendidik'] = $nama_file;
$input['path_pendidik'] = $path;
}


if ($file = $request->file('file_bukti_dokumen')) {
   if ($data_dosen_update->file_bukti_dokumen) {
    File::delete('uploads/profil_dosen_tidaktetap/file_bukti_dokumen/' . $data_dosen_update->file_bukti_dokumen);
}
$nama_file = $file->getClientOriginalName();
$path = $file->store('public/uploads/profil_dosen_tidaktetap/file_bukti_dokumen');
$file->move(public_path() . '/uploads/profil_dosen_tidaktetap/file_bukti_dokumen/', $nama_file);
$input['file_bukti_dokumen'] = $nama_file;
$input['path_bukti'] = $path;
}


$data_dosen_update->update($input);

return redirect('/prodi_profil_dosen_dosen_tidak_tetap')->with('success', 'Data profil Dosen Tidak Tetap Berhasil Diupdate');
}


public function profil_dosen_dosen_tidak_tetap_delete($id)
{
  $delete = DosenTidakTetap::findOrFail($id);
  $delete->delete();

 return redirect('/prodi_profil_dosen_dosen_tidak_tetap')->with('success', 'Data profil Dosen Tidak Tetap Berhasil Dihapus');
}
//==========================================================================================================================================

public function profil_dosen_dosen_industri_praktisi(Request $request)
{

    $dosen = Dosen::where('id_prodi', Auth::user()->id_prodi)->get();
    $filter = $request->filter;

    if ($filter == Null) {
       $dosen_industri = DB::table('dosen_industri')
       ->join('dosen', 'dosen_industri.id_dosen', '=', 'dosen.id')
       ->select('dosen_industri.*', 'dosen.nama_dosen')
       ->orderBy('id', 'DESC')
       ->where('dosen_industri.id_user', Auth::user()->id)
       ->get();
   } else {
      $dosen_industri = DB::table('dosen_industri')
      ->join('dosen', 'dosen_industri.id_dosen', '=', 'dosen.id')
      ->select('dosen_industri.*', 'dosen.nama_dosen')
      ->orderBy('id', 'DESC')
      ->where('dosen_industri.id_user', Auth::user()->id)
      ->where('tahun',$filter)
      ->get();
  }
  return view('lkps-prodi.profil-dosen.dosen-industri-praktisi.index',compact('dosen_industri','dosen'));
}

public function profil_dosen_dosen_industri_praktisi_add(Request $request)
{

   $data_profil_dosen = new DosenIndustri();

   $data_profil_dosen->nidk = $request->input('nidk');
   $data_profil_dosen->perusahaan = $request->input('perusahaan');
   $data_profil_dosen->pendidikan_tertinggi = $request->input('pendidikan_tertinggi');
   $data_profil_dosen->bidang_keahlian = $request->input('bidang_keahlian');
   $data_profil_dosen->link_sertifikat_kompetensi = $request->input('link_sertifikat_kompetensi');
   $data_profil_dosen->matakuliah_diampu = $request->input('matakuliah_diampu');
   $data_profil_dosen->bobot_kredit = $request->input('bobot_kredit');
   $data_profil_dosen->tahun = $request->input('tahun');
   $data_profil_dosen->link_bukti_dokumen = $request->input('link_bukti_dokumen');
   $data_profil_dosen->id_user  = $request->input('id_user');
   $data_profil_dosen->id_dosen  = $request->input('id_dosen');
   $data_add->id_prodi = Auth::user()->id_prodi;
   $data_add->status = '0';


   if ($request->hasFile('file_bukti_dokumen')) {
       $file = $request->file('file_bukti_dokumen');
       $extension = $file->getClientOriginalExtension();
       $filename = $file->getClientOriginalName();
       $path = $file->store('public/uploads/profil_dosen_industri/file_bukti_dokumen');
       $file->move('uploads/profil_dosen_industri/file_bukti_dokumen/', $filename);
       $data_profil_dosen->file_bukti_dokumen = $filename;
       $data_profil_dosen->path_bukti = $path;
   } else {
       echo "Gagal upload gambar";
   }

   if ($request->hasFile('file_sertifikat_kompetensi')) {
       $file = $request->file('file_sertifikat_kompetensi');
       $extension = $file->getClientOriginalExtension();
       $filename = $file->getClientOriginalName();
       $path = $file->store('public/uploads/profil_dosen_industri/file_sertifikat_kompetensi');
       $file->move('uploads/profil_dosen_industri/file_sertifikat_kompetensi/', $filename);
       $data_profil_dosen->file_sertifikat_kompetensi = $filename;
       $data_profil_dosen->path_sertifikat = $path;
   } else {
       echo "Gagal upload gambar";
   }


   $data_profil_dosen->save();

   return redirect('/prodi_profil_dosen_dosen_industri_praktisi')->with('success', 'Data Dosen Industri Praktisi Baru Berhasil Ditambahkan');
}

public function file_download_ser_kompetensi_industri($id)
{

  $download = DosenIndustri::find($id);

  return  Storage::download($download->path_sertifikat, $download->file_sertifikat_kompetensi);
}

public function file_download_bukti_dokumen_industri($id)
{

  $download = DosenIndustri::find($id);

  return  Storage::download($download->path_bukti, $download->file_bukti_dokumen);
}


public function profil_dosen_dosen_industri_praktisi_update(Request $request, $id)
{

  $data_dosen_update = DosenIndustri::where('id', $id)->first();


          $input = [
           'nidk' => $request->nidk,
           'perusahaan' => $request->perusahaan,
           'pendidikan_tertinggi' => $request->pendidikan_tertinggi,
           'bidang_keahlian' => $request->bidang_keahlian,
           'link_sertifikat_kompetensi' => $request->link_sertifikat_kompetensi,
           'matakuliah_diampu' => $request->matakuliah_diampu,
           'bobot_kredit' => $request->bobot_kredit,
           'tahun' => $request->tahun,
           'link_bukti_dokumen' => $request->link_bukti_dokumen,
           

        ];

        if ($file = $request->file('file_sertifikat_kompetensi')) {
           if ($data_dosen_update->file_sertifikat_kompetensi) {
            File::delete('uploads/profil_dosen_industri/file_sertifikat_kompetensi/' . $data_dosen_update->file_sertifikat_kompetensi);
        }
        $nama_file = $file->getClientOriginalName();
        $path = $file->store('public/uploads/profil_dosen_industri/file_sertifikat_kompetensi');
        $file->move(public_path() . '/uploads/profil_dosen_industri/file_sertifikat_kompetensi/', $nama_file);
        $input['file_sertifikat_kompetensi'] = $nama_file;
        $input['path_sertifikat'] = $path;
        }


        if ($file = $request->file('file_bukti_dokumen')) {
           if ($data_dosen_update->file_bukti_dokumen) {
            File::delete('uploads/profil_dosen_industri/file_bukti_dokumen/' . $data_dosen_update->file_bukti_dokumen);
        }
        $nama_file = $file->getClientOriginalName();
        $path = $file->store('public/uploads/profil_dosen_industri/file_bukti_dokumen');
        $file->move(public_path() . '/uploads/profil_dosen_industri/file_bukti_dokumen/', $nama_file);
        $input['file_bukti_dokumen'] = $nama_file;
        $input['path_bukti'] = $path;
        }


        $data_dosen_update->update($input);

return redirect('/prodi_profil_dosen_dosen_industri_praktisi')->with('success', 'Data Dosen Industri Praktisi Baru Berhasil Diupdate');
}


public function profil_dosen_dosen_industri_praktisi_delete($id)
{
  $delete = DosenIndustri::findOrFail($id);
  $delete->delete();

 return redirect('/prodi_profil_dosen_dosen_industri_praktisi')->with('success', 'Data Dosen Industri Praktisi Baru Berhasil Dihapus');
}


}
