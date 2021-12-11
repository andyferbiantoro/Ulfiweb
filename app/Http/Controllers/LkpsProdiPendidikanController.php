<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\KurikulumPembelajaran;
use App\IntegrasiKegiatanPembelajaran;
use App\KepuasanMahasiswa;
use App\Dosen;
use Auth;
use DB;
use File;
use Illuminate\Support\Facades\Storage;


class LkpsProdiPendidikanController extends Controller
{
    public function pendidikan_kurikulum()
    {
        $data_kurikulum = KurikulumPembelajaran::where('id_user', Auth::user()->id)->get();

        return view('lkps-prodi.pendidikan.kurikulum.index',compact('data_kurikulum'));
    }

    public function pendidikan_kurikulum_add(Request $request)
    {

     $data_add = new KurikulumPembelajaran();

     $data_add->semester = $request->input('semester');
     $data_add->kode_matakuliah = $request->input('kode_matakuliah');
     $data_add->nama_matakuliah = $request->input('nama_matakuliah');
     $data_add->matakuliah_kompetensi = $request->input('matakuliah_kompetensi');
     $data_add->bobot_kredit_kuliah = $request->input('bobot_kredit_kuliah');
     $data_add->bobot_kredit_seminar = $request->input('bobot_kredit_seminar');
     $data_add->bobot_kredit_praktikum = $request->input('bobot_kredit_praktikum');
     $data_add->konversi_kredit = $request->input('konversi_kredit');
     $data_add->sikap = $request->input('sikap');
     $data_add->pengetahuan = $request->input('pengetahuan');
     $data_add->keterampilan_umum = $request->input('keterampilan_umum');
     $data_add->keterampilan_khusus = $request->input('keterampilan_khusus');
     $data_add->link_dokumen_rencanaPembelajaran = $request->input('link_dokumen_rencanaPembelajaran');
     $data_add->unit_penyelenggara = $request->input('unit_penyelenggara');
     $data_add->tahun = $request->input('tahun');
     $data_add->id_user = $request->input('id_user');
     $data_add->status = '0';


     if ($request->hasFile('file_dokumen_rencanaPembelajaran')) {
         $file = $request->file('file_dokumen_rencanaPembelajaran');
         $extension = $file->getClientOriginalExtension();
         $filename = $file->getClientOriginalName();
         $path = $file->store('public/uploads/Pedidikan/kurikulum_pembelajaran');
         $file->move('uploads/Pedidikan/kurikulum_pembelajaran/', $filename);
         $data_add->file_dokumen_rencanaPembelajaran = $filename;
         $data_add->path = $path;
     } else {
         echo "Gagal upload gambar";
     }


     $data_add->save();

     return redirect('/prodi_pendidikan_kurikulum')->with('success', 'Data Kurikulum Pembelajaran Baru Berhasil Ditambahkan');
 }


 public function lihat_pendidikan_kurikulum()
 {
    return view('lkps-prodi.pendidikan.kurikulum.lihat_laporan');
}

//====================================================================================================================

public function pendidikan_integrasi_kegiatan_penelitian()
{
    $dosen = Dosen::where('id_prodi', Auth::user()->id_prodi)->get();
    $data_integrasi = DB::table('integrasi_kegiatan_pembelajaran')
    ->join('dosen', 'integrasi_kegiatan_pembelajaran.id_dosen', '=', 'dosen.id')
    ->select('integrasi_kegiatan_pembelajaran.*', 'dosen.nama_dosen')
    ->orderBy('id', 'DESC')
    ->where('integrasi_kegiatan_pembelajaran.id_user', Auth::user()->id)
    ->get();

    return view('lkps-prodi.pendidikan.integrasi-kegiatan-penelitian.index',compact('dosen','data_integrasi'));
}


public function pendidikan_integrasi_kegiatan_penelitian_add(Request $request)
{

 $data_add = new IntegrasiKegiatanPembelajaran();

 $data_add->judul_penelitian_pkm = $request->input('judul_penelitian_pkm');
 $data_add->matakuliah = $request->input('matakuliah');
 $data_add->bentuk_integrasi = $request->input('bentuk_integrasi');
 $data_add->tahun = $request->input('tahun');
 $data_add->link_bukti_dokumen = $request->input('link_bukti_dokumen');
 $data_add->id_user = $request->input('id_user');
 $data_add->id_dosen = $request->input('id_dosen');
 $data_add->status = '0';


 if ($request->hasFile('file_bukti_dokumen')) {
     $file = $request->file('file_bukti_dokumen');
     $extension = $file->getClientOriginalExtension();
     $filename = $file->getClientOriginalName();
     $path = $file->store('public/uploads/Pedidikan/integrasi_kegiatan_pembelajaran');
     $file->move('uploads/Pedidikan/integrasi_kegiatan_pembelajaran/', $filename);
     $data_add->file_bukti_dokumen = $filename;
     $data_add->path = $path;
 } else {
     echo "Gagal upload gambar";
 }


 $data_add->save();

 return redirect('/prodi_pendidikan_integrasi_kegiatan_penelitian')->with('success', 'Data pendidikan integrasi kegiatan penelitian Baru Berhasil Ditambahkan');
}


public function pendidikan_integrasi_kegiatan_penelitian_update(Request $request, $id)
   {

      $data_update = IntegrasiKegiatanPembelajaran::where('id', $id)->first();


      $input = [
       'judul_penelitian_pkm' => $request->judul_penelitian_pkm,
       'matakuliah' => $request->matakuliah,
       'bentuk_integrasi' => $request->bentuk_integrasi,
       'tahun' => $request->tahun,
       'link_bukti_dokumen' => $request->link_bukti_dokumen,
      
   ];

   if ($file = $request->file('file_bukti_dokumen')) {
       if ($data_update->file_bukti_dokumen) {
        File::delete('uploads/Pedidikan/integrasi_kegiatan_pembelajaran/' . $data_update->file_bukti_dokumen);
    }
    $nama_file = $file->getClientOriginalName();
    $path = $file->store('public/uploads/Pedidikan/integrasi_kegiatan_pembelajaran');
    $file->move(public_path() . '/uploads/Pedidikan/integrasi_kegiatan_pembelajaran/', $nama_file);
    $input['file_bukti_dokumen'] = $nama_file;
    $input['path'] = $path;
}


$data_update->update($input);

return redirect('/prodi_pendidikan_integrasi_kegiatan_penelitian')->with('success', 'Data pendidikan integrasi kegiatan penelitian Berhasil Diupdate');
}


public function pendidikan_integrasi_kegiatan_penelitian_delete($id)
{
  $delete = IntegrasiKegiatanPembelajaran::findOrFail($id);
  $delete->delete();

 return redirect('/prodi_pendidikan_integrasi_kegiatan_penelitian')->with('success', 'Data pendidikan integrasi kegiatan penelitian Berhasil Dihapus');

}


public function file_download_dokumen_integrasi($id)
{

  $download = IntegrasiKegiatanPembelajaran::find($id);

  return  Storage::download($download->path, $download->file_bukti_dokumen);
}
//==========================================================================================================================


public function pendidikan_kepuasan_mahasiswa()
{
    $data_kepuasan_mahasiswa = KepuasanMahasiswa::where('id_user', Auth::user()->id)->get();
    return view('lkps-prodi.pendidikan.kepuasan-mahasiswa.index',compact('data_kepuasan_mahasiswa'));
}


public function pendidikan_kepuasan_mahasiswa_add(Request $request)
{

 $data_add = new KepuasanMahasiswa();

 $data_add->aspek_diukir = $request->input('aspek_diukir');
 $data_add->tingkat_kepuasanMahasiswa_sangatBaik = $request->input('tingkat_kepuasanMahasiswa_sangatBaik');
 $data_add->tingkat_kepuasanMahasiswa_baik = $request->input('tingkat_kepuasanMahasiswa_baik');
 $data_add->tingkat_kepuasanMahasiswa_cukup = $request->input('tingkat_kepuasanMahasiswa_cukup');
 $data_add->tingkat_kepuasanMahasiswa_kurang = $request->input('tingkat_kepuasanMahasiswa_kurang');
 $data_add->rencana_tindak_lanjut = $request->input('rencana_tindak_lanjut');
 $data_add->link_bukti_dokumen = $request->input('link_bukti_dokumen');
 $data_add->tahun = $request->input('tahun');
 $data_add->id_user = $request->input('id_user');
 $data_add->status = '0';


 if ($request->hasFile('file_bukti_dokumen')) {
     $file = $request->file('file_bukti_dokumen');
     $extension = $file->getClientOriginalExtension();
     $filename = $file->getClientOriginalName();
     $path = $file->store('public/uploads/Pedidikan/kepuasan_mahasiswa');
     $file->move('uploads/Pedidikan/kepuasan_mahasiswa/', $filename);
     $data_add->file_bukti_dokumen = $filename;
     $data_add->path = $path;
 } else {
     echo "Gagal upload gambar";
 }


 $data_add->save();

 return redirect('/prodi_pendidikan_kepuasan_mahasiswa')->with('success', 'Data Kepuasan Mahasiswa Baru Berhasil Ditambahkan');
}

public function pendidikan_kepuasan_mahasiswa_update(Request $request, $id)
   {

      $data_update = KepuasanMahasiswa::where('id', $id)->first();


      $input = [
       'aspek_diukir' => $request->aspek_diukir,
       'tingkat_kepuasanMahasiswa_sangatBaik' => $request->tingkat_kepuasanMahasiswa_sangatBaik,
       'tingkat_kepuasanMahasiswa_baik' => $request->tingkat_kepuasanMahasiswa_baik,
       'tingkat_kepuasanMahasiswa_cukup' => $request->tingkat_kepuasanMahasiswa_cukup,
       'tingkat_kepuasanMahasiswa_kurang' => $request->tingkat_kepuasanMahasiswa_kurang,
       'rencana_tindak_lanjut' => $request->rencana_tindak_lanjut,
       'link_bukti_dokumen' => $request->link_bukti_dokumen,
       'tahun' => $request->tahun,
       
      
   ];

   if ($file = $request->file('file_bukti_dokumen')) {
       if ($data_update->file_bukti_dokumen) {
        File::delete('uploads/Pedidikan/kepuasan_mahasiswa/' . $data_update->file_bukti_dokumen);
    }
    $nama_file = $file->getClientOriginalName();
    $path = $file->store('public/uploads/Pedidikan/kepuasan_mahasiswa');
    $file->move(public_path() . '/uploads/Pedidikan/kepuasan_mahasiswa/', $nama_file);
    $input['file_bukti_dokumen'] = $nama_file;
    $input['path'] = $path;
}


$data_update->update($input);

 return redirect('/prodi_pendidikan_kepuasan_mahasiswa')->with('success', 'Data Kepuasan Mahasiswa Berhasil Diupdate');
}


public function pendidikan_kepuasan_mahasiswa_delete($id)
{
  $delete = KepuasanMahasiswa::findOrFail($id);
  $delete->delete();

  return redirect('/prodi_pendidikan_kepuasan_mahasiswa')->with('success', 'Data Kepuasan Mahasiswa Berhasil Dihapus');
}


public function file_download_dokumen_kepuasan_mhs($id)
{

  $download = KepuasanMahasiswa::find($id);

  return  Storage::download($download->path, $download->file_bukti_dokumen);
}


public function lihat_pendidikan_kepuasan_mahasiswa()
{
    return view('lkps-prodi.pendidikan.kepuasan-mahasiswa.lihat_laporan');
}
}
