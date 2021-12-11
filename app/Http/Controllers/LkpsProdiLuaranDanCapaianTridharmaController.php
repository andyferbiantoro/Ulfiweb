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
use Auth;
use DB;
use File;
use Illuminate\Support\Facades\Storage;

class LkpsProdiLuaranDanCapaianTridharmaController extends Controller
{
    // ==================================IPK=========================

    public function ipk_lulusan()
    {
        $ipk_lulusan = IpkLulusan::where('id_user', Auth::user()->id)->get();

        return view('lkps-prodi.luaran-dan-capaian-tridharma.ipk-lulusan.index',compact('ipk_lulusan'));
    }

    public function lihat_ipk_lulusan()
    {

        $ipk_lulusan = IpkLulusan::where('id_user', Auth::user()->id)->get();
        return view('lkps-prodi.luaran-dan-capaian-tridharma.ipk-lulusan.lihat_laporan',compact('ipk_lulusan'));
    }


    public function ipk_lulusan_add(Request $request)
    {

     $data_add = new IpkLulusan();

     $data_add->tahun_lulus = $request->input('tahun_lulus');
     $data_add->jumlah_lulusan = $request->input('jumlah_lulusan');
     $data_add->minimal_ipk = $request->input('minimal_ipk');
     $data_add->rataRata_ipk = $request->input('rataRata_ipk');
     $data_add->maksimal_ipk = $request->input('maksimal_ipk');
     $data_add->link_bukti_dokumen = $request->input('link_bukti_dokumen');
     $data_add->id_user = $request->input('id_user');
     $data_add->id_prodi = Auth::user()->id_prodi;
     $data_add->status = '0';



     if ($request->hasFile('file_bukti_dokumen')) {
         $file = $request->file('file_bukti_dokumen');
         $extension = $file->getClientOriginalExtension();
         $filename = $file->getClientOriginalName();
         $path = $file->store('public/uploads/luaran_capaian_tridharma/ipk_lulusan');
         $file->move('uploads/luaran_capaian_tridharma/ipk_lulusan/', $filename);
         $data_add->file_bukti_dokumen = $filename;
         $data_add->path = $path;
     } else {
         echo "Gagal upload gambar";
     }


     $data_add->save();

     return redirect('/prodi_ipk_lulusan')->with('success', 'Data Ipk Lulusan Baru Berhasil Ditambahkan');
 }


 public function ipk_lulusan_update(Request $request, $id)
 {

  $data_update = IpkLulusan::where('id', $id)->first();


  $input = [
     'tahun_lulus' => $request->tahun_lulus,
     'jumlah_lulusan' => $request->jumlah_lulusan,
     'minimal_ipk' => $request->minimal_ipk,
     'rataRata_ipk' => $request->rataRata_ipk,
     'maksimal_ipk' => $request->maksimal_ipk,
     'link_bukti_dokumen' => $request->link_bukti_dokumen,
 ];

 if ($file = $request->file('file_bukti_dokumen')) {
     if ($data_update->file_bukti_dokumen) {
        File::delete('uploads/luaran_capaian_tridharma/ipk_lulusan/' . $data_update->file_bukti_dokumen);
    }
    $nama_file = $file->getClientOriginalName();
    $path = $file->store('public/uploads/luaran_capaian_tridharma/ipk_lulusan');
    $file->move(public_path() . '/uploads/luaran_capaian_tridharma/ipk_lulusan/', $nama_file);
    $input['file_bukti_dokumen'] = $nama_file;
    $input['path'] = $path;
}


$data_update->update($input);

return redirect('/prodi_ipk_lulusan')->with('success', 'Data Ipk Lulusan Baru Berhasil Diupdate');
}


public function ipk_lulusan_delete($id)
{
  $delete = IpkLulusan::findOrFail($id);
  File::delete('uploads/luaran_capaian_tridharma/ipk_lulusan/' . $delete->file_bukti_dokumen);
  $delete->delete();

  return redirect('/prodi_ipk_lulusan')->with('success', 'Data Ipk Lulusan Baru Berhasil Dihapus');
}

public function file_download_dokumen_ipk_lulusan($id)
{

  $download = IpkLulusan::find($id);

  return  Storage::download($download->path, $download->file_bukti_dokumen);
}

    // ==================================Prestasi Mahasiswa=========================

public function prestasi_akademik_mahasiswa()
{
 $prestasi_akademik_mahasiswa = PrestasiAkademikMahasiswa::where('id_user', Auth::user()->id)->get();

 return view('lkps-prodi.luaran-dan-capaian-tridharma.prestasi-mahasiswa.prestasi-akademik-mahasiswa.index',compact('prestasi_akademik_mahasiswa'));
}

public function prestasi_akademik_mahasiswa_add(Request $request)
{

 $data_add = new PrestasiAkademikMahasiswa();

 $data_add->nama_kegiatan = $request->input('nama_kegiatan');
 $data_add->tahun_perolehan = $request->input('tahun_perolehan');
 $data_add->tingkat = $request->input('tingkat');
 $data_add->prestasi_dicapai = $request->input('prestasi_dicapai');
 $data_add->file_bukti_dokumen = $request->input('file_bukti_dokumen');
 $data_add->link_bukti_dokumen = $request->input('link_bukti_dokumen');
 $data_add->id_user = $request->input('id_user');
 $data_add->id_prodi = Auth::user()->id_prodi;
 $data_add->status = '0';



 if ($request->hasFile('file_bukti_dokumen')) {
     $file = $request->file('file_bukti_dokumen');
     $extension = $file->getClientOriginalExtension();
     $filename = $file->getClientOriginalName();
     $path = $file->store('public/uploads/luaran_capaian_tridharma/prestasi_akademik_mahasiswa');
     $file->move('uploads/luaran_capaian_tridharma/prestasi_akademik_mahasiswa/', $filename);
     $data_add->file_bukti_dokumen = $filename;
     $data_add->path = $path;
 } else {
     echo "Gagal upload gambar";
 }


 $data_add->save();

 return redirect('/prodi_prestasi_akademik_mahasiswa')->with('success', 'Data prestasi akademik mahasiswa Baru Berhasil Ditambahkan');
}


public function prestasi_akademik_mahasiswa_update(Request $request, $id)
{

  $data_update = PrestasiAkademikMahasiswa::where('id', $id)->first();


  $input = [
     'nama_kegiatan' => $request->nama_kegiatan,
     'tahun_perolehan' => $request->tahun_perolehan,
     'tingkat' => $request->tingkat,
     'prestasi_dicapai' => $request->prestasi_dicapai,
     'maksimal_ipk' => $request->maksimal_ipk,
     'link_bukti_dokumen' => $request->link_bukti_dokumen,
 ];

 if ($file = $request->file('file_bukti_dokumen')) {
     if ($data_update->file_bukti_dokumen) {
        File::delete('uploads/luaran_capaian_tridharma/prestasi_akademik_mahasiswa/' . $data_update->file_bukti_dokumen);
    }
    $nama_file = $file->getClientOriginalName();
    $path = $file->store('public/uploads/luaran_capaian_tridharma/prestasi_akademik_mahasiswa');
    $file->move(public_path() . '/uploads/luaran_capaian_tridharma/prestasi_akademik_mahasiswa/', $nama_file);
    $input['file_bukti_dokumen'] = $nama_file;
    $input['path'] = $path;
}


$data_update->update($input);

return redirect('/prodi_prestasi_akademik_mahasiswa')->with('success', 'Data prestasi akademik mahasiswa Berhasil Diupddate');
}


public function prestasi_akademik_mahasiswa_delete($id)
{
  $delete = PrestasiAkademikMahasiswa::findOrFail($id);
  File::delete('uploads/luaran_capaian_tridharma/prestasi_akademik_mahasiswa/' . $delete->file_bukti_dokumen);
  $delete->delete();

  return redirect('/prodi_prestasi_akademik_mahasiswa')->with('success', 'Data prestasi akademik mahasiswa Berhasil Dihapus');
}

public function file_download_dokumen_prestasi_akademik($id)
{

  $download = PrestasiAkademikMahasiswa::find($id);

  return  Storage::download($download->path, $download->file_bukti_dokumen);
}


//======================================================

public function prestasi_non_akademik_mahasiswa()
{
    $prestasi_non_akademik_mahasiswa = PrestasiNonAkademikMahasiswa::where('id_user', Auth::user()->id)->get();
    
    return view('lkps-prodi.luaran-dan-capaian-tridharma.prestasi-mahasiswa.prestasi-non-akademik-mahasiswa.index',compact('prestasi_non_akademik_mahasiswa'));
}


public function prestasi_non_akademik_mahasiswa_add(Request $request)
{

 $data_add = new PrestasiNonAkademikMahasiswa();

 $data_add->nama_kegiatan = $request->input('nama_kegiatan');
 $data_add->tahun_perolehan = $request->input('tahun_perolehan');
 $data_add->tingkat = $request->input('tingkat');
 $data_add->prestasi_dicapai = $request->input('prestasi_dicapai');
 $data_add->file_bukti_dokumen = $request->input('file_bukti_dokumen');
 $data_add->link_bukti_dokumen = $request->input('link_bukti_dokumen');
 $data_add->id_user = $request->input('id_user');
 $data_add->id_prodi = Auth::user()->id_prodi;
$data_add->status = '0';


 if ($request->hasFile('file_bukti_dokumen')) {
     $file = $request->file('file_bukti_dokumen');
     $extension = $file->getClientOriginalExtension();
     $filename = $file->getClientOriginalName();
     $path = $file->store('public/uploads/luaran_capaian_tridharma/prestasi_non_akademik_mahasiswa');
     $file->move('uploads/luaran_capaian_tridharma/prestasi_non_akademik_mahasiswa/', $filename);
     $data_add->file_bukti_dokumen = $filename;
     $data_add->path = $path;
 } else {
     echo "Gagal upload gambar";
 }


 $data_add->save();

 return redirect('/prodi_prestasi_non_akademik_mahasiswa')->with('success', 'Data prestasi akademik mahasiswa Baru Berhasil Ditambahkan');
}


public function prestasi_non_akademik_mahasiswa_update(Request $request, $id)
{

  $data_update = PrestasiNonAkademikMahasiswa::where('id', $id)->first();


  $input = [
     'nama_kegiatan' => $request->nama_kegiatan,
     'tahun_perolehan' => $request->tahun_perolehan,
     'tingkat' => $request->tingkat,
     'prestasi_dicapai' => $request->prestasi_dicapai,
     'maksimal_ipk' => $request->maksimal_ipk,
     'link_bukti_dokumen' => $request->link_bukti_dokumen,
 ];

 if ($file = $request->file('file_bukti_dokumen')) {
     if ($data_update->file_bukti_dokumen) {
        File::delete('uploads/luaran_capaian_tridharma/prestasi_non_akademik_mahasiswa/' . $data_update->file_bukti_dokumen);
    }
    $nama_file = $file->getClientOriginalName();
    $path = $file->store('public/uploads/luaran_capaian_tridharma/prestasi_non_akademik_mahasiswa');
    $file->move(public_path() . '/uploads/luaran_capaian_tridharma/prestasi_non_akademik_mahasiswa/', $nama_file);
    $input['file_bukti_dokumen'] = $nama_file;
    $input['path'] = $path;
}


$data_update->update($input);

return redirect('/prodi_prestasi_non_akademik_mahasiswa')->with('success', 'Data prestasi akademik mahasiswa Berhasil Diupddate');
}


public function prestasi_non_akademik_mahasiswa_delete($id)
{
  $delete = PrestasiNonAkademikMahasiswa::findOrFail($id);
  File::delete('uploads/luaran_capaian_tridharma/prestasi_non_akademik_mahasiswa/' . $delete->file_bukti_dokumen);
  $delete->delete();

  return redirect('/prodi_prestasi_non_akademik_mahasiswa')->with('success', 'Data prestasi akademik mahasiswa Berhasil Dihapus');
}

public function file_download_dokumen_prestasi_non_akademik($id)
{

  $download = PrestasiNonAkademikMahasiswa::find($id);

  return  Storage::download($download->path, $download->file_bukti_dokumen);
}



    // ==================================Efektifitas Dan Produktifitas Pendidikan=========================

public function masa_studi_lulusan_program_d3()
{

    $masastudi_lulusan_d3 = MasaStudiLulusanD3::where('id_user', Auth::user()->id)->get();

    foreach ($masastudi_lulusan_d3 as $key => $value) {

       $jumlah_mhs = $value->jumlah_mahasiswaLulus_akhirTs4 + $value->jumlah_mahasiswaLulus_akhirTs3 + $value->jumlah_mahasiswaLulus_akhirTs2 + $value->jumlah_mahasiswaLulus_akhirTs1 + $value->jumlah_mahasiswaLulus_akhirTs;

       $value->jumlah_mhs = $jumlah_mhs;
   }


   return view('lkps-prodi.luaran-dan-capaian-tridharma.efektifitas-dan-produktifitas-pendidikan.masa-studi-lulusan-pada-program-d3.index',compact('masastudi_lulusan_d3'));
}

public function lihat_masa_studi_lulusan_program_d3()
{

    $masastudi_lulusan_d3 = MasaStudiLulusanD3::where('id_user', Auth::user()->id)->get();

    foreach ($masastudi_lulusan_d3 as $key => $value) {

       $jumlah_mhs = $value->jumlah_mahasiswaLulus_akhirTs4 + $value->jumlah_mahasiswaLulus_akhirTs3 + $value->jumlah_mahasiswaLulus_akhirTs2 + $value->jumlah_mahasiswaLulus_akhirTs1 + $value->jumlah_mahasiswaLulus_akhirTs;

       $value->jumlah_mhs = $jumlah_mhs;
   }

   return view('lkps-prodi.luaran-dan-capaian-tridharma.efektifitas-dan-produktifitas-pendidikan.masa-studi-lulusan-pada-program-d3.lihat_laporan',compact('masastudi_lulusan_d3'));
}


public function masa_studi_lulusan_program_d3_add(Request $request)
{

 $data_add = new MasaStudiLulusanD3();

 $data_add->tahun_masuk = $request->input('tahun_masuk');
 $data_add->jumlah_mahasiswa_diterima = $request->input('jumlah_mahasiswa_diterima');
 $data_add->jumlah_mahasiswaLulus_akhirTs4 = $request->input('jumlah_mahasiswaLulus_akhirTs4');
 $data_add->jumlah_mahasiswaLulus_akhirTs3 = $request->input('jumlah_mahasiswaLulus_akhirTs3');
 $data_add->jumlah_mahasiswaLulus_akhirTs2 = $request->input('jumlah_mahasiswaLulus_akhirTs2');
 $data_add->jumlah_mahasiswaLulus_akhirTs1 = $request->input('jumlah_mahasiswaLulus_akhirTs1');
 $data_add->jumlah_mahasiswaLulus_akhirTs = $request->input('jumlah_mahasiswaLulus_akhirTs');
 $data_add->rataRata_masa_studi = $request->input('rataRata_masa_studi');
 $data_add->link_bukti_dokumen = $request->input('link_bukti_dokumen');
 $data_add->id_user = $request->input('id_user');
 $data_add->id_prodi = Auth::user()->id_prodi;
 $data_add->status = '0';



 if ($request->hasFile('file_bukti_dokumen')) {
     $file = $request->file('file_bukti_dokumen');
     $extension = $file->getClientOriginalExtension();
     $filename = $file->getClientOriginalName();
     $path = $file->store('public/uploads/luaran_capaian_tridharma/masastudi_lulusan_d3');
     $file->move('uploads/luaran_capaian_tridharma/masastudi_lulusan_d3/', $filename);
     $data_add->file_bukti_dokumen = $filename;
     $data_add->path = $path;
 } else {
     echo "Gagal upload gambar";
 }


 $data_add->save();

 return redirect('/prodi_masa_studi_lulusan_program_d3')->with('success', 'Data masa studi lulusan program D3 Baru Berhasil Ditambahkan');
}



public function masa_studi_lulusan_program_d3_update(Request $request, $id)
{

  $data_update = MasaStudiLulusanD3::where('id', $id)->first();


  $input = [
     'tahun_masuk' => $request->tahun_masuk,
     'jumlah_mahasiswa_diterima' => $request->jumlah_mahasiswa_diterima,
     'jumlah_mahasiswaLulus_akhirTs4' => $request->jumlah_mahasiswaLulus_akhirTs4,
     'jumlah_mahasiswaLulus_akhirTs3' => $request->jumlah_mahasiswaLulus_akhirTs3,
     'jumlah_mahasiswaLulus_akhirTs2' => $request->jumlah_mahasiswaLulus_akhirTs2,
     'jumlah_mahasiswaLulus_akhirTs1' => $request->jumlah_mahasiswaLulus_akhirTs1,
     'jumlah_mahasiswaLulus_akhirTs' => $request->jumlah_mahasiswaLulus_akhirTs,
     'rataRata_masa_studi' => $request->rataRata_masa_studi,
     'link_bukti_dokumen' => $request->link_bukti_dokumen,

 ];

 if ($file = $request->file('file_bukti_dokumen')) {
     if ($data_update->file_bukti_dokumen) {
        File::delete('uploads/luaran_capaian_tridharma/masastudi_lulusan_d3/' . $data_update->file_bukti_dokumen);
    }
    $nama_file = $file->getClientOriginalName();
    $path = $file->store('public/uploads/luaran_capaian_tridharma/masastudi_lulusan_d3');
    $file->move(public_path() . '/uploads/luaran_capaian_tridharma/masastudi_lulusan_d3/', $nama_file);
    $input['file_bukti_dokumen'] = $nama_file;
    $input['path'] = $path;
}


$data_update->update($input);

return redirect('/prodi_masa_studi_lulusan_program_d3')->with('success', 'Data masa studi lulusan program D3 Berhasil Diupdate');
}


public function masa_studi_lulusan_program_d3_delete($id)
{
  $delete = MasaStudiLulusanD3::findOrFail($id);
  File::delete('uploads/luaran_capaian_tridharma/masastudi_lulusan_d3/' . $delete->file_bukti_dokumen);
  $delete->delete();

  return redirect('/prodi_masa_studi_lulusan_program_d3')->with('success', 'Data masa studi lulusan program D3 Berhasil Dihapus');
}

public function file_download_dokumen_masastudi_d3($id)
{

  $download = MasaStudiLulusanD3::find($id);

  return  Storage::download($download->path, $download->file_bukti_dokumen);
}

//========================================================================================

public function masa_studi_lulusan_program_sarajana_terapan()
{

    $masastudi_lulusan_sarajana_terapan = MasaStudiLulusanSarjanaTerapan::where('id_user', Auth::user()->id)->get();

    foreach ($masastudi_lulusan_sarajana_terapan as $key => $value) {

       $jumlah_mhs = $value->jumlah_mahasiswaLulus_akhirTs6 + $value->jumlah_mahasiswaLulus_akhirTs5 + $value->jumlah_mahasiswaLulus_akhirTs4 + $value->jumlah_mahasiswaLulus_akhirTs3 + $value->jumlah_mahasiswaLulus_akhirTs2 + $value->jumlah_mahasiswaLulus_akhirTs1 + $value->jumlah_mahasiswaLulus_akhirTs;

       $value->jumlah_mhs = $jumlah_mhs;
   }

   return view('lkps-prodi.luaran-dan-capaian-tridharma.efektifitas-dan-produktifitas-pendidikan.masa-studi-lulusan-pada-program-sarjana-terapan.index',compact('masastudi_lulusan_sarajana_terapan'));
}
public function lihat_masa_studi_lulusan_program_sarajana_terapan()
{
    $masastudi_lulusan_sarajana_terapan = MasaStudiLulusanSarjanaTerapan::where('id_user', Auth::user()->id)->get();

    foreach ($masastudi_lulusan_sarajana_terapan as $key => $value) {

       $jumlah_mhs = $value->jumlah_mahasiswaLulus_akhirTs6 + $value->jumlah_mahasiswaLulus_akhirTs5 + $value->jumlah_mahasiswaLulus_akhirTs4 + $value->jumlah_mahasiswaLulus_akhirTs3 + $value->jumlah_mahasiswaLulus_akhirTs2 + $value->jumlah_mahasiswaLulus_akhirTs1 + $value->jumlah_mahasiswaLulus_akhirTs;

       $value->jumlah_mhs = $jumlah_mhs;
   }

   return view('lkps-prodi.luaran-dan-capaian-tridharma.efektifitas-dan-produktifitas-pendidikan.masa-studi-lulusan-pada-program-sarjana-terapan.lihat_laporan',compact('masastudi_lulusan_sarajana_terapan'));
}


public function masa_studi_lulusan_program_sarajana_terapan_add(Request $request)
{

 $data_add = new MasaStudiLulusanSarjanaTerapan();

 $data_add->tahun_masuk = $request->input('tahun_masuk');
 $data_add->jumlah_mahasiswa_diterima = $request->input('jumlah_mahasiswa_diterima');
 $data_add->jumlah_mahasiswaLulus_akhirTs6 = $request->input('jumlah_mahasiswaLulus_akhirTs6');
 $data_add->jumlah_mahasiswaLulus_akhirTs5 = $request->input('jumlah_mahasiswaLulus_akhirTs5');
 $data_add->jumlah_mahasiswaLulus_akhirTs4 = $request->input('jumlah_mahasiswaLulus_akhirTs4');
 $data_add->jumlah_mahasiswaLulus_akhirTs3 = $request->input('jumlah_mahasiswaLulus_akhirTs3');
 $data_add->jumlah_mahasiswaLulus_akhirTs2 = $request->input('jumlah_mahasiswaLulus_akhirTs2');
 $data_add->jumlah_mahasiswaLulus_akhirTs1 = $request->input('jumlah_mahasiswaLulus_akhirTs1');
 $data_add->jumlah_mahasiswaLulus_akhirTs = $request->input('jumlah_mahasiswaLulus_akhirTs');
 $data_add->rataRata_masa_studi = $request->input('rataRata_masa_studi');
 $data_add->link_bukti_dokumen = $request->input('link_bukti_dokumen');
 $data_add->id_user = $request->input('id_user');
 $data_add->id_prodi = Auth::user()->id_prodi;
 $data_add->status = '0';



 if ($request->hasFile('file_bukti_dokumen')) {
     $file = $request->file('file_bukti_dokumen');
     $extension = $file->getClientOriginalExtension();
     $filename = $file->getClientOriginalName();
     $path = $file->store('public/uploads/luaran_capaian_tridharma/masastudi_lulusan_sarajana_terapan');
     $file->move('uploads/luaran_capaian_tridharma/masastudi_lulusan_sarajana_terapan/', $filename);
     $data_add->file_bukti_dokumen = $filename;
     $data_add->path = $path;
 } else {
     echo "Gagal upload gambar";
 }


 $data_add->save();

 return redirect('/prodi_masa_studi_lulusan_program_sarajana_terapan')->with('success', 'Data masa studi lulusan program sarajana_terapan Baru Berhasil Ditambahkan');
}



public function masa_studi_lulusan_program_sarajana_terapan_update(Request $request, $id)
{

  $data_update = MasaStudiLulusanSarjanaTerapan::where('id', $id)->first();


  $input = [
     'tahun_masuk' => $request->tahun_masuk,
     'jumlah_mahasiswa_diterima' => $request->jumlah_mahasiswa_diterima,
     'jumlah_mahasiswaLulus_akhirTs6' => $request->jumlah_mahasiswaLulus_akhirTs6,
     'jumlah_mahasiswaLulus_akhirTs5' => $request->jumlah_mahasiswaLulus_akhirTs5,
     'jumlah_mahasiswaLulus_akhirTs4' => $request->jumlah_mahasiswaLulus_akhirTs4,
     'jumlah_mahasiswaLulus_akhirTs3' => $request->jumlah_mahasiswaLulus_akhirTs3,
     'jumlah_mahasiswaLulus_akhirTs2' => $request->jumlah_mahasiswaLulus_akhirTs2,
     'jumlah_mahasiswaLulus_akhirTs1' => $request->jumlah_mahasiswaLulus_akhirTs1,
     'jumlah_mahasiswaLulus_akhirTs' => $request->jumlah_mahasiswaLulus_akhirTs,
     'rataRata_masa_studi' => $request->rataRata_masa_studi,
     'link_bukti_dokumen' => $request->link_bukti_dokumen,

 ];

 if ($file = $request->file('file_bukti_dokumen')) {
     if ($data_update->file_bukti_dokumen) {
        File::delete('uploads/luaran_capaian_tridharma/masastudi_lulusan_sarajana_terapan/' . $data_update->file_bukti_dokumen);
    }
    $nama_file = $file->getClientOriginalName();
    $path = $file->store('public/uploads/luaran_capaian_tridharma/masastudi_lulusan_sarajana_terapan');
    $file->move(public_path() . '/uploads/luaran_capaian_tridharma/masastudi_lulusan_sarajana_terapan/', $nama_file);
    $input['file_bukti_dokumen'] = $nama_file;
    $input['path'] = $path;
}


$data_update->update($input);

return redirect('/prodi_masa_studi_lulusan_program_sarajana_terapan')->with('success', 'Data masa studi lulusan program sarajana_terapan Berhasil Diupdate');
}


public function masa_studi_lulusan_program_sarajana_terapan_delete($id)
{
  $delete = MasaStudiLulusanSarjanaTerapan::findOrFail($id);
  File::delete('uploads/luaran_capaian_tridharma/masastudi_lulusan_sarajana_terapan/' . $delete->file_bukti_dokumen);
  $delete->delete();

  return redirect('/prodi_masa_studi_lulusan_program_sarajana_terapan')->with('success', 'Data masa studi lulusan program sarajana_terapan Berhasil Dihapus');
}

public function file_download_dokumen_masastudi_sarajana_terapan($id)
{

  $download = MasaStudiLulusanSarjanaTerapan::find($id);

  return  Storage::download($download->path, $download->file_bukti_dokumen);
}


    // ==================================Daya Saing Lulusan=========================

public function waktu_tunggu_lulusan_program_d3()
{   
    $waktu_tunggu_d3 = WaktuTungguLulusanD3::where('id_user', Auth::user()->id)->get();

    $jumlah_lulusan=WaktuTungguLulusanD3::where('id_user', Auth::user()->id)->sum('jumlah_lulusan');
    $jumlah_lulusan_terlacak=WaktuTungguLulusanD3::where('id_user', Auth::user()->id)->sum('jumlah_lulusan_terlacak');
    $jumlah_lulusan_dipesan=WaktuTungguLulusanD3::where('id_user', Auth::user()->id)->sum('jumlah_lulusan_dipesan');
    $jumlah_lulusan_wt_3bulan=WaktuTungguLulusanD3::where('id_user', Auth::user()->id)->sum('jumlah_lulusan_wt_3bulan');
    $jumlah_lulusan_wt_3_6bulan=WaktuTungguLulusanD3::where('id_user', Auth::user()->id)->sum('jumlah_lulusan_wt_3_6bulan');
    $jumlah_lulusan_wt_6bulan=WaktuTungguLulusanD3::where('id_user', Auth::user()->id)->sum('jumlah_lulusan_wt_6bulan');

    return view('lkps-prodi.luaran-dan-capaian-tridharma.daya-saing-lulusan.waktu-tunggu-lulusan-pada-program-d3.index',compact('waktu_tunggu_d3','jumlah_lulusan','jumlah_lulusan_terlacak','jumlah_lulusan_dipesan','jumlah_lulusan_wt_3bulan','jumlah_lulusan_wt_3_6bulan','jumlah_lulusan_wt_6bulan'));
}
public function lihat_waktu_tunggu_lulusan_program_d3()
{

    $waktu_tunggu_d3 = WaktuTungguLulusanD3::where('id_user', Auth::user()->id)->get();
    return view('lkps-prodi.luaran-dan-capaian-tridharma.daya-saing-lulusan.waktu-tunggu-lulusan-pada-program-d3.lihat_laporan',compact('waktu_tunggu_d3'));
}

public function waktu_tunggu_lulusan_program_d3_add(Request $request)
{

 $data_add = new WaktuTungguLulusanD3();

 $data_add->tahun_lulus = $request->input('tahun_lulus');
 $data_add->jumlah_lulusan = $request->input('jumlah_lulusan');
 $data_add->jumlah_lulusan_terlacak = $request->input('jumlah_lulusan_terlacak');
 $data_add->jumlah_lulusan_dipesan = $request->input('jumlah_lulusan_dipesan');
 $data_add->jumlah_lulusan_wt_3bulan = $request->input('jumlah_lulusan_wt_3bulan');
 $data_add->jumlah_lulusan_wt_3_6bulan = $request->input('jumlah_lulusan_wt_3_6bulan');
 $data_add->jumlah_lulusan_wt_6bulan = $request->input('jumlah_lulusan_wt_6bulan');
 $data_add->link_bukti_dokumen = $request->input('link_bukti_dokumen');
 $data_add->id_user = $request->input('id_user');
 $data_add->id_prodi = Auth::user()->id_prodi;
 $data_add->status = '0';



 if ($request->hasFile('file_bukti_dokumen')) {
     $file = $request->file('file_bukti_dokumen');
     $extension = $file->getClientOriginalExtension();
     $filename = $file->getClientOriginalName();
     $path = $file->store('public/uploads/luaran_capaian_tridharma/waktutunggu_lulusan_d3');
     $file->move('uploads/luaran_capaian_tridharma/waktutunggu_lulusan_d3/', $filename);
     $data_add->file_bukti_dokumen = $filename;
     $data_add->path = $path;
 } else {
     echo "Gagal upload gambar";
 }


 $data_add->save();

 return redirect('/prodi_waktu_tunggu_lulusan_program_d3')->with('success', 'Data waktu tunggu lulusan program d3 Baru Berhasil Ditambahkan');
}


public function waktu_tunggu_lulusan_program_d3_update(Request $request, $id)
{

  $data_update = WaktuTungguLulusanD3::where('id', $id)->first();


  $input = [
     'tahun_lulus' => $request->tahun_lulus,
     'jumlah_lulusan' => $request->jumlah_lulusan,
     'jumlah_lulusan_terlacak' => $request->jumlah_lulusan_terlacak,
     'jumlah_lulusan_dipesan' => $request->jumlah_lulusan_dipesan,
     'jumlah_lulusan_wt_3bulan' => $request->jumlah_lulusan_wt_3bulan,
     'jumlah_lulusan_wt_3_6bulan' => $request->jumlah_lulusan_wt_3_6bulan,
     'jumlah_lulusan_wt_6bulan' => $request->jumlah_lulusan_wt_6bulan,
     'link_bukti_dokumen' => $request->link_bukti_dokumen,
 ];

 if ($file = $request->file('file_bukti_dokumen')) {
     if ($data_update->file_bukti_dokumen) {
        File::delete('uploads/luaran_capaian_tridharma/waktutunggu_lulusan_d3/' . $data_update->file_bukti_dokumen);
    }
    $nama_file = $file->getClientOriginalName();
    $path = $file->store('public/uploads/luaran_capaian_tridharma/waktutunggu_lulusan_d3');
    $file->move(public_path() . '/uploads/luaran_capaian_tridharma/waktutunggu_lulusan_d3/', $nama_file);
    $input['file_bukti_dokumen'] = $nama_file;
    $input['path'] = $path;
}


$data_update->update($input);

return redirect('/prodi_waktu_tunggu_lulusan_program_d3')->with('success', 'Data waktu tunggu lulusan program d3 Berhasil Diupdate');
}


public function waktu_tunggu_lulusan_program_d3_delete($id)
{
  $delete = WaktuTungguLulusanD3::findOrFail($id);
  File::delete('uploads/luaran_capaian_tridharma/waktutunggu_lulusan_d3/' . $delete->file_bukti_dokumen);
  $delete->delete();

  return redirect('/prodi_waktu_tunggu_lulusan_program_d3')->with('success', 'Data waktu tunggu lulusan program d3 Berhasil Dihapus');
}

public function file_download_dokumen_tunggu_d3($id)
{

  $download = WaktuTungguLulusanD3::find($id);

  return  Storage::download($download->path, $download->file_bukti_dokumen);
}


//=========================================================================================================



public function waktu_tunggu_lulusan_program_sarajana_terapan()
{

    $waktu_tunggu_sarjana_terapan = WaktuTungguLulusanSarjanaTerapan::where('id_user', Auth::user()->id)->get();


    $jumlah_lulusan=WaktuTungguLulusanSarjanaTerapan::where('id_user', Auth::user()->id)->sum('jumlah_lulusan');
    $jumlah_lulusan_terlacak=WaktuTungguLulusanSarjanaTerapan::where('id_user', Auth::user()->id)->sum('jumlah_lulusan_terlacak');
    $jumlah_lulusan_wt_3bulan=WaktuTungguLulusanSarjanaTerapan::where('id_user', Auth::user()->id)->sum('jumlah_lulusan_wt_3bulan');
    $jumlah_lulusan_wt_3_6bulan=WaktuTungguLulusanSarjanaTerapan::where('id_user', Auth::user()->id)->sum('jumlah_lulusan_wt_3_6bulan');
    $jumlah_lulusan_wt_6bulan=WaktuTungguLulusanSarjanaTerapan::where('id_user', Auth::user()->id)->sum('jumlah_lulusan_wt_6bulan');

    return view('lkps-prodi.luaran-dan-capaian-tridharma.daya-saing-lulusan.waktu-tunggu-lulusan-pada-program-sarjana-terapan.index',compact('waktu_tunggu_sarjana_terapan','jumlah_lulusan','jumlah_lulusan_terlacak','jumlah_lulusan_wt_3bulan','jumlah_lulusan_wt_3_6bulan','jumlah_lulusan_wt_6bulan'));
}

public function lihat_waktu_tunggu_lulusan_program_sarajana_terapan()
{

   $waktu_tunggu_sarjana_terapan = WaktuTungguLulusanSarjanaTerapan::where('id_user', Auth::user()->id)->get();
   return view('lkps-prodi.luaran-dan-capaian-tridharma.daya-saing-lulusan.waktu-tunggu-lulusan-pada-program-sarjana-terapan.lihat_laporan',compact('waktu_tunggu_sarjana_terapan'));
}

public function waktu_tunggu_lulusan_program_sarjana_terapan_add(Request $request)
{

 $data_add = new WaktuTungguLulusanSarjanaTerapan();

 $data_add->tahun_lulus = $request->input('tahun_lulus');
 $data_add->jumlah_lulusan = $request->input('jumlah_lulusan');
 $data_add->jumlah_lulusan_terlacak = $request->input('jumlah_lulusan_terlacak');
 $data_add->jumlah_lulusan_wt_3bulan = $request->input('jumlah_lulusan_wt_3bulan');
 $data_add->jumlah_lulusan_wt_3_6bulan = $request->input('jumlah_lulusan_wt_3_6bulan');
 $data_add->jumlah_lulusan_wt_6bulan = $request->input('jumlah_lulusan_wt_6bulan');
 $data_add->link_bukti_dokumen = $request->input('link_bukti_dokumen');
 $data_add->id_user = $request->input('id_user');
 $data_add->id_prodi = Auth::user()->id_prodi;
 $data_add->status = '0';



 if ($request->hasFile('file_bukti_dokumen')) {
     $file = $request->file('file_bukti_dokumen');
     $extension = $file->getClientOriginalExtension();
     $filename = $file->getClientOriginalName();
     $path = $file->store('public/uploads/luaran_capaian_tridharma/waktutunggu_lulusan_sarjana_terapan');
     $file->move('uploads/luaran_capaian_tridharma/waktutunggu_lulusan_sarjana_terapan/', $filename);
     $data_add->file_bukti_dokumen = $filename;
     $data_add->path = $path;
 } else {
     echo "Gagal upload gambar";
 }


 $data_add->save();

 return redirect('/prodi_waktu_tunggu_lulusan_program_sarajana_terapan')->with('success', 'Data waktu tunggu lulusan program sarjana_terapan Baru Berhasil Ditambahkan');
}


public function waktu_tunggu_lulusan_program_sarjana_terapan_update(Request $request, $id)
{

  $data_update = WaktuTungguLulusanSarjanaTerapan::where('id', $id)->first();


  $input = [
     'tahun_lulus' => $request->tahun_lulus,
     'jumlah_lulusan' => $request->jumlah_lulusan,
     'jumlah_lulusan_terlacak' => $request->jumlah_lulusan_terlacak,
     'jumlah_lulusan_wt_3bulan' => $request->jumlah_lulusan_wt_3bulan,
     'jumlah_lulusan_wt_3_6bulan' => $request->jumlah_lulusan_wt_3_6bulan,
     'jumlah_lulusan_wt_6bulan' => $request->jumlah_lulusan_wt_6bulan,
     'link_bukti_dokumen' => $request->link_bukti_dokumen,
 ];

 if ($file = $request->file('file_bukti_dokumen')) {
     if ($data_update->file_bukti_dokumen) {
        File::delete('uploads/luaran_capaian_tridharma/waktutunggu_lulusan_sarjana_terapan/' . $data_update->file_bukti_dokumen);
    }
    $nama_file = $file->getClientOriginalName();
    $path = $file->store('public/uploads/luaran_capaian_tridharma/waktutunggu_lulusan_sarjana_terapan');
    $file->move(public_path() . '/uploads/luaran_capaian_tridharma/waktutunggu_lulusan_sarjana_terapan/', $nama_file);
    $input['file_bukti_dokumen'] = $nama_file;
    $input['path'] = $path;
}


$data_update->update($input);

return redirect('/prodi_waktu_tunggu_lulusan_program_sarajana_terapan')->with('success', 'Data waktu tunggu lulusan program sarjana_terapan Berhasil Diupdate');
}


public function waktu_tunggu_lulusan_program_sarjana_terapan_delete($id)
{
  $delete = WaktuTungguLulusanSarjanaTerapan::findOrFail($id);
  File::delete('uploads/luaran_capaian_tridharma/waktutunggu_lulusan_sarjana_terapan/' . $delete->file_bukti_dokumen);
  $delete->delete();

  return redirect('/prodi_waktu_tunggu_lulusan_program_sarajana_terapan')->with('success', 'Data waktu tunggu lulusan program sarjana_terapan Berhasil Dihapus');
}

public function file_download_dokumen_tunggu_sarjana_terapan($id)
{

  $download = WaktuTungguLulusanSarjanaTerapan::find($id);

  return  Storage::download($download->path, $download->file_bukti_dokumen);
}



//===============================================================================================================


public function kesesuaian_bidang_kerja_lulusan()
{

    $kesesuaian_bidang_kerja_lulusan = KesesuaianBidangkerjaLulusan::where('id_user', Auth::user()->id)->get();

    $jumlah_lulusan=KesesuaianBidangkerjaLulusan::where('id_user', Auth::user()->id)->sum('jumlah_lulusan');
    $jumlah_lulusan_terlacak=KesesuaianBidangkerjaLulusan::where('id_user', Auth::user()->id)->sum('jumlah_lulusan_terlacak');
    $jumlah_lulusan_rendah=KesesuaianBidangkerjaLulusan::where('id_user', Auth::user()->id)->sum('jumlah_lulusan_rendah');
    $jumlah_lulusan_sedang=KesesuaianBidangkerjaLulusan::where('id_user', Auth::user()->id)->sum('jumlah_lulusan_sedang');
    $jumlah_lulusan_tinggi=KesesuaianBidangkerjaLulusan::where('id_user', Auth::user()->id)->sum('jumlah_lulusan_tinggi');

    return view('lkps-prodi.luaran-dan-capaian-tridharma.daya-saing-lulusan.kesesuaian-bidang-kerja-lulusan.index',compact('kesesuaian_bidang_kerja_lulusan','jumlah_lulusan','jumlah_lulusan_terlacak','jumlah_lulusan_rendah','jumlah_lulusan_sedang','jumlah_lulusan_tinggi'));
}
public function lihat_kesesuaian_bidang_kerja_lulusan()
{
    $kesesuaian_bidang_kerja_lulusan = KesesuaianBidangkerjaLulusan::where('id_user', Auth::user()->id)->get();

    return view('lkps-prodi.luaran-dan-capaian-tridharma.daya-saing-lulusan.kesesuaian-bidang-kerja-lulusan.lihat_laporan',compact('kesesuaian_bidang_kerja_lulusan'));
}


public function kesesuaian_bidang_kerja_lulusan_add(Request $request)
{

 $data_add = new KesesuaianBidangkerjaLulusan();

 $data_add->tahun_lulus = $request->input('tahun_lulus');
 $data_add->jumlah_lulusan = $request->input('jumlah_lulusan');
 $data_add->jumlah_lulusan_terlacak = $request->input('jumlah_lulusan_terlacak');
 $data_add->jumlah_lulusan_rendah = $request->input('jumlah_lulusan_rendah');
 $data_add->jumlah_lulusan_sedang = $request->input('jumlah_lulusan_sedang');
 $data_add->jumlah_lulusan_tinggi = $request->input('jumlah_lulusan_tinggi');
 $data_add->link_bukti_dokumen = $request->input('link_bukti_dokumen');
 $data_add->id_user = $request->input('id_user');
 $data_add->id_prodi = Auth::user()->id_prodi;
 $data_add->status = '0';



 if ($request->hasFile('file_bukti_dokumen')) {
     $file = $request->file('file_bukti_dokumen');
     $extension = $file->getClientOriginalExtension();
     $filename = $file->getClientOriginalName();
     $path = $file->store('public/uploads/luaran_capaian_tridharma/kesesuaian_bidangkerja_lulusan');
     $file->move('uploads/luaran_capaian_tridharma/kesesuaian_bidangkerja_lulusan/', $filename);
     $data_add->file_bukti_dokumen = $filename;
     $data_add->path = $path;
 } else {
     echo "Gagal upload gambar";
 }


 $data_add->save();

 return redirect('/prodi_kesesuaian_bidang_kerja_lulusan')->with('success', 'Data kesesuaian bidang kerja lulusan Baru Berhasil Ditambahkan');
}


public function kesesuaian_bidang_kerja_lulusan_update(Request $request, $id)
{

  $data_update = KesesuaianBidangkerjaLulusan::where('id', $id)->first();


  $input = [
     'tahun_lulus' => $request->tahun_lulus,
     'jumlah_lulusan' => $request->jumlah_lulusan,
     'jumlah_lulusan_terlacak' => $request->jumlah_lulusan_terlacak,
     'jumlah_lulusan_rendah' => $request->jumlah_lulusan_rendah,
     'jumlah_lulusan_sedang' => $request->jumlah_lulusan_sedang,
     'jumlah_lulusan_tinggi' => $request->jumlah_lulusan_tinggi,
     'link_bukti_dokumen' => $request->link_bukti_dokumen,
 ];

 if ($file = $request->file('file_bukti_dokumen')) {
     if ($data_update->file_bukti_dokumen) {
        File::delete('uploads/luaran_capaian_tridharma/kesesuaian_bidangkerja_lulusan/' . $data_update->file_bukti_dokumen);
    }
    $nama_file = $file->getClientOriginalName();
    $path = $file->store('public/uploads/luaran_capaian_tridharma/kesesuaian_bidangkerja_lulusan');
    $file->move(public_path() . '/uploads/luaran_capaian_tridharma/kesesuaian_bidangkerja_lulusan/', $nama_file);
    $input['file_bukti_dokumen'] = $nama_file;
    $input['path'] = $path;
}


$data_update->update($input);

return redirect('/prodi_kesesuaian_bidang_kerja_lulusan')->with('success', 'Data kesesuaian bidang kerja lulusan Berhasil Diupdate');
}


public function kesesuaian_bidang_kerja_lulusan_delete($id)
{
  $delete = KesesuaianBidangkerjaLulusan::findOrFail($id);
  File::delete('uploads/luaran_capaian_tridharma/kesesuaian_bidangkerja_lulusan/' . $delete->file_bukti_dokumen);
  $delete->delete();

  return redirect('/prodi_kesesuaian_bidang_kerja_lulusan')->with('success', 'Data kesesuaian bidang kerja lulusan Berhasil Dihapus');
}

public function file_download_dokumen_kesesuaian_bidang($id)
{

  $download = KesesuaianBidangkerjaLulusan::find($id);

  return  Storage::download($download->path, $download->file_bukti_dokumen);
}


    // ==================================Kinerja Lulusan=========================

public function tempat_kerja_lulusan()
{
    $tempat_kerja_lulusan = TempatKerjaLulusan::where('id_user', Auth::user()->id)->get();

    $jumlah_lulusan=TempatKerjaLulusan::where('id_user', Auth::user()->id)->sum('jumlah_lulusan');
    $jumlah_lulusan_terlacak=TempatKerjaLulusan::where('id_user', Auth::user()->id)->sum('jumlah_lulusan_terlacak');
    $jumlah_lulusan_lokal=TempatKerjaLulusan::where('id_user', Auth::user()->id)->sum('jumlah_lulusan_lokal');
    $jumlah_lulusan_nasional=TempatKerjaLulusan::where('id_user', Auth::user()->id)->sum('jumlah_lulusan_nasional');
    $jumlah_lulusan_multinasional=TempatKerjaLulusan::where('id_user', Auth::user()->id)->sum('jumlah_lulusan_multinasional');

    return view('lkps-prodi.luaran-dan-capaian-tridharma.kinerja-lulusan.tempat-kerja-lulusan.index',compact('tempat_kerja_lulusan','jumlah_lulusan','jumlah_lulusan_terlacak','jumlah_lulusan_lokal','jumlah_lulusan_nasional','jumlah_lulusan_multinasional'));
}
public function lihat_tempat_kerja_lulusan()
{
    $tempat_kerja_lulusan = TempatKerjaLulusan::where('id_user', Auth::user()->id)->get();

    return view('lkps-prodi.luaran-dan-capaian-tridharma.kinerja-lulusan.tempat-kerja-lulusan.lihat_laporan',compact('tempat_kerja_lulusan'));
}


public function tempat_kerja_lulusan_add(Request $request)
{

 $data_add = new TempatKerjaLulusan();

 $data_add->tahun_lulus = $request->input('tahun_lulus');
 $data_add->jumlah_lulusan = $request->input('jumlah_lulusan');
 $data_add->jumlah_lulusan_terlacak = $request->input('jumlah_lulusan_terlacak');
 $data_add->jumlah_lulusan_lokal = $request->input('jumlah_lulusan_lokal');
 $data_add->jumlah_lulusan_nasional = $request->input('jumlah_lulusan_nasional');
 $data_add->jumlah_lulusan_multinasional = $request->input('jumlah_lulusan_multinasional');
 $data_add->link_bukti_dokumen = $request->input('link_bukti_dokumen');
 $data_add->id_user = $request->input('id_user');
 $data_add->id_prodi = Auth::user()->id_prodi;
 $data_add->status = '0';



 if ($request->hasFile('file_bukti_dokumen')) {
     $file = $request->file('file_bukti_dokumen');
     $extension = $file->getClientOriginalExtension();
     $filename = $file->getClientOriginalName();
     $path = $file->store('public/uploads/luaran_capaian_tridharma/tempat_kerja_lulusan');
     $file->move('uploads/luaran_capaian_tridharma/tempat_kerja_lulusan/', $filename);
     $data_add->file_bukti_dokumen = $filename;
     $data_add->path = $path;
 } else {
     echo "Gagal upload gambar";
 }


 $data_add->save();

 return redirect('/prodi_tempat_kerja_lulusan')->with('success', 'Data tempat kerja lulusan Baru Berhasil Ditambahkan');
}

public function tempat_kerja_lulusan_update(Request $request, $id)
{

  $data_update = TempatKerjaLulusan::where('id', $id)->first();


  $input = [
     'tahun_lulus' => $request->tahun_lulus,
     'jumlah_lulusan' => $request->jumlah_lulusan,
     'jumlah_lulusan_terlacak' => $request->jumlah_lulusan_terlacak,
     'jumlah_lulusan_lokal' => $request->jumlah_lulusan_lokal,
     'jumlah_lulusan_nasional' => $request->jumlah_lulusan_nasional,
     'jumlah_lulusan_multinasional' => $request->jumlah_lulusan_multinasional,
     'link_bukti_dokumen' => $request->link_bukti_dokumen,
 ];

 if ($file = $request->file('file_bukti_dokumen')) {
     if ($data_update->file_bukti_dokumen) {
        File::delete('uploads/luaran_capaian_tridharma/tempat_kerja_lulusan/' . $data_update->file_bukti_dokumen);
    }
    $nama_file = $file->getClientOriginalName();
    $path = $file->store('public/uploads/luaran_capaian_tridharma/tempat_kerja_lulusan');
    $file->move(public_path() . '/uploads/luaran_capaian_tridharma/tempat_kerja_lulusan/', $nama_file);
    $input['file_bukti_dokumen'] = $nama_file;
    $input['path'] = $path;
}


$data_update->update($input);

return redirect('/prodi_tempat_kerja_lulusan')->with('success', 'Data tempat kerja lulusan Berhasil Diupdate');
}


public function tempat_kerja_lulusan_delete($id)
{
  $delete = TempatKerjaLulusan::findOrFail($id);
  File::delete('uploads/luaran_capaian_tridharma/tempat_kerja_lulusan/' . $delete->file_bukti_dokumen);
  $delete->delete();

  return redirect('/prodi_tempat_kerja_lulusan')->with('success', 'Data tempat kerja lulusan Berhasil Dihapus');
}

public function file_download_dokumen_tempat_kerja_lulusan($id)
{

  $download = TempatKerjaLulusan::find($id);

  return  Storage::download($download->path, $download->file_bukti_dokumen);
}



//===================================================================================================================
public function referensi_kepuasan_pengguna_lulusan()
{
   $referensi_kepuasan_pengguna_lulusan = ReferensiKepuasanPengguna::where('id_user', Auth::user()->id)->get();

   foreach ($referensi_kepuasan_pengguna_lulusan as $key => $value) {
     $jumlah_tanggapan = ReferensiKepuasanPengguna::where('id_user', Auth::user()->id)->sum('jumlah_tanggapan');

     $value->jumlah_tang = $jumlah_tanggapan;
 }

 return view('lkps-prodi.luaran-dan-capaian-tridharma.kinerja-lulusan.referensi-kepuasan-pengguna-lulusan.index',compact('referensi_kepuasan_pengguna_lulusan'));
}


public function referensi_kepuasan_pengguna_lulusan_add(Request $request)
{

 $data_add = new ReferensiKepuasanPengguna();


 $data_add->tahun_lulus = $request->input('tahun_lulus');
 $data_add->jumlah_lulusan = $request->input('jumlah_lulusan');
 $data_add->jumlah_tanggapan = $request->input('jumlah_tanggapan');
 $data_add->link_bukti_dokumen = $request->input('link_bukti_dokumen');
 $data_add->id_user = $request->input('id_user');
 $data_add->id_prodi = Auth::user()->id_prodi;
 $data_add->status = '0';



 if ($request->hasFile('file_bukti_dokumen')) {
     $file = $request->file('file_bukti_dokumen');
     $extension = $file->getClientOriginalExtension();
     $filename = $file->getClientOriginalName();
     $path = $file->store('public/uploads/luaran_capaian_tridharma/referensi_kepuasan_pengguna');
     $file->move('uploads/luaran_capaian_tridharma/referensi_kepuasan_pengguna/', $filename);
     $data_add->file_bukti_dokumen = $filename;
     $data_add->path = $path;
 } else {
     echo "Gagal upload gambar";
 }


 $data_add->save();

 return redirect('/prodi_referensi_kepuasan_pengguna_lulusan')->with('success', 'Data referensi kepuasan pengguna lulusan Baru Berhasil Ditambahkan');
}


public function referensi_kepuasan_pengguna_lulusan_update(Request $request, $id)
{

  $data_update = ReferensiKepuasanPengguna::where('id', $id)->first();


  $input = [
     'tahun_lulus' => $request->tahun_lulus,
     'jumlah_lulusan' => $request->jumlah_lulusan,
     'jumlah_tanggapan' => $request->jumlah_tanggapan,
     'link_bukti_dokumen' => $request->link_bukti_dokumen,

 ];

 if ($file = $request->file('file_bukti_dokumen')) {
     if ($data_update->file_bukti_dokumen) {
        File::delete('uploads/luaran_capaian_tridharma/referensi_kepuasan_pengguna/' . $data_update->file_bukti_dokumen);
    }
    $nama_file = $file->getClientOriginalName();
    $path = $file->store('public/uploads/luaran_capaian_tridharma/referensi_kepuasan_pengguna');
    $file->move(public_path() . '/uploads/luaran_capaian_tridharma/referensi_kepuasan_pengguna/', $nama_file);
    $input['file_bukti_dokumen'] = $nama_file;
    $input['path'] = $path;
}


$data_update->update($input);

return redirect('/prodi_referensi_kepuasan_pengguna_lulusan')->with('success', 'Data referensi kepuasan pengguna lulusan Berhasil Diupdate');
}


public function referensi_kepuasan_pengguna_lulusan_delete($id)
{
  $delete = ReferensiKepuasanPengguna::findOrFail($id);
  File::delete('uploads/luaran_capaian_tridharma/referensi_kepuasan_pengguna/' . $delete->file_bukti_dokumen);
  $delete->delete();

  return redirect('/prodi_referensi_kepuasan_pengguna_lulusan')->with('success', 'Data referensi kepuasan pengguna lulusan Berhasil Dihapus');
}

public function file_download_dokumen_referensi_kepuasan($id)
{

  $download = ReferensiKepuasanPengguna::find($id);

  return  Storage::download($download->path, $download->file_bukti_dokumen);
}


//=====================================================================================================
public function kepuasan_pengguna_lulusan()
{

   $kepuasan_pengguna_lulusan = KepuasanPenggunaLulusan::where('id_user', Auth::user()->id)->get();

   $jumlah_sangat_baik=KepuasanPenggunaLulusan::where('id_user', Auth::user()->id)->sum('tingkat_kepuasanPengguna_sangatBaik');
   $jumlah_baik=KepuasanPenggunaLulusan::where('id_user', Auth::user()->id)->sum('tingkat_kepuasanPengguna_baik');
   $jumlah_cukup=KepuasanPenggunaLulusan::where('id_user', Auth::user()->id)->sum('tingkat_kepuasanPengguna_cukup');
   $jumlah_kurang=KepuasanPenggunaLulusan::where('id_user', Auth::user()->id)->sum('tingkat_kepuasanPengguna_kurang');

   return view('lkps-prodi.luaran-dan-capaian-tridharma.kinerja-lulusan.kepuasan-pengguna-lulusan.index',compact('kepuasan_pengguna_lulusan','jumlah_sangat_baik','jumlah_baik','jumlah_cukup','jumlah_kurang'));
}
public function lihat_kepuasan_pengguna_lulusan()
{
   $kepuasan_pengguna_lulusan = KepuasanPenggunaLulusan::where('id_user', Auth::user()->id)->get();

   return view('lkps-prodi.luaran-dan-capaian-tridharma.kinerja-lulusan.kepuasan-pengguna-lulusan.lihat_laporan',compact('kepuasan_pengguna_lulusan'));
}

public function kepuasan_pengguna_lulusan_add(Request $request)
{

 $data_add = new KepuasanPenggunaLulusan();


 $data_add->jenis_kemampuan = $request->input('jenis_kemampuan');
 $data_add->tingkat_kepuasanPengguna_sangatBaik = $request->input('tingkat_kepuasanPengguna_sangatBaik');
 $data_add->tingkat_kepuasanPengguna_baik = $request->input('tingkat_kepuasanPengguna_baik');
 $data_add->tingkat_kepuasanPengguna_cukup = $request->input('tingkat_kepuasanPengguna_cukup');
 $data_add->tingkat_kepuasanPengguna_kurang = $request->input('tingkat_kepuasanPengguna_kurang');
 $data_add->rencana_tindak_lanjut = $request->input('rencana_tindak_lanjut');
 $data_add->link_bukti_dokumen = $request->input('link_bukti_dokumen');
 $data_add->tahun = $request->input('tahun');
 $data_add->id_user = $request->input('id_user');
 $data_add->id_prodi = Auth::user()->id_prodi;
 $data_add->status = '0';



 if ($request->hasFile('file_bukti_dokumen')) {
     $file = $request->file('file_bukti_dokumen');
     $extension = $file->getClientOriginalExtension();
     $filename = $file->getClientOriginalName();
     $path = $file->store('public/uploads/luaran_capaian_tridharma/kepuasan_pengguna_lulusan');
     $file->move('uploads/luaran_capaian_tridharma/kepuasan_pengguna_lulusan/', $filename);
     $data_add->file_bukti_dokumen = $filename;
     $data_add->path = $path;
 } else {
     echo "Gagal upload gambar";
 }


 $data_add->save();

 return redirect('/prodi_kepuasan_pengguna_lulusan')->with('success', 'Data kepuasan pengguna lulusan Baru Berhasil Ditambahkan');
}


public function kepuasan_pengguna_lulusan_update(Request $request, $id)
{

  $data_update = KepuasanPenggunaLulusan::where('id', $id)->first();


  $input = [
     'jenis_kemampuan' => $request->jenis_kemampuan,
     'tingkat_kepuasanPengguna_sangatBaik' => $request->tingkat_kepuasanPengguna_sangatBaik,
     'tingkat_kepuasanPengguna_baik' => $request->tingkat_kepuasanPengguna_baik,
     'tingkat_kepuasanPengguna_cukup' => $request->tingkat_kepuasanPengguna_cukup,
     'tingkat_kepuasanPengguna_kurang' => $request->tingkat_kepuasanPengguna_kurang,
     'rencana_tindak_lanjut' => $request->rencana_tindak_lanjut,
     'link_bukti_dokumen' => $request->link_bukti_dokumen,
     'tahun' => $request->tahun,


 ];

 if ($file = $request->file('file_bukti_dokumen')) {
     if ($data_update->file_bukti_dokumen) {
        File::delete('uploads/luaran_capaian_tridharma/kepuasan_pengguna_lulusan/' . $data_update->file_bukti_dokumen);
    }
    $nama_file = $file->getClientOriginalName();
    $path = $file->store('public/uploads/luaran_capaian_tridharma/kepuasan_pengguna_lulusan');
    $file->move(public_path() . '/uploads/luaran_capaian_tridharma/kepuasan_pengguna_lulusan/', $nama_file);
    $input['file_bukti_dokumen'] = $nama_file;
    $input['path'] = $path;
}


$data_update->update($input);

return redirect('/prodi_kepuasan_pengguna_lulusan')->with('success', 'Data kepuasan pengguna lulusan Berhasil Diupdate');

}


public function kepuasan_pengguna_lulusan_delete($id)
{
  $delete = KepuasanPenggunaLulusan::findOrFail($id);
  File::delete('uploads/luaran_capaian_tridharma/kepuasan_pengguna_lulusan/' . $delete->file_bukti_dokumen);
  $delete->delete();

  return redirect('/prodi_kepuasan_pengguna_lulusan')->with('success', 'Data kepuasan pengguna lulusan Berhasil Diupdate');

}

public function file_download_dokumen_kepuasan_pengguna_lulusan($id)
{

  $download = KepuasanPenggunaLulusan::find($id);

  return  Storage::download($download->path, $download->file_bukti_dokumen);
}

// ==================================Luaran Penelitian dan Penelitian Mahasiswa=========================


public function pagelaran_pameran_prestasi_publikasi_ilmiah_mahasiswa()
{

    $publikasi_ilmiah_mahasiswa = PagelaranIlmiahMahasiswa::where('id_user', Auth::user()->id)->get();

    foreach ($publikasi_ilmiah_mahasiswa as $key => $value) {
     $jumlah = $value->jumlah_judul_ts2 + $value->jumlah_judul_ts1 + $value->jumlah_judul_ts ;

     $value->jumlah = $jumlah;
 }

 return view('lkps-prodi.luaran-dan-capaian-tridharma.luaran-penelitian-dan-pkm-mahasiswa.pagelaran-pameran-presentasi-publikasi-ilmiah-mahasiswa.index',compact('publikasi_ilmiah_mahasiswa'));
}


public function lihat_pagelaran_pameran_prestasi_publikasi_ilmiah_mahasiswa()
{

    $publikasi_ilmiah_mahasiswa = PagelaranIlmiahMahasiswa::where('id_user', Auth::user()->id)->get();
    
    foreach ($publikasi_ilmiah_mahasiswa as $key => $value) {
     $jumlah = $value->jumlah_judul_ts2 + $value->jumlah_judul_ts1 + $value->jumlah_judul_ts ;

     $value->jumlah = $jumlah;
 }

 return view('lkps-prodi.luaran-dan-capaian-tridharma.luaran-penelitian-dan-pkm-mahasiswa.pagelaran-pameran-presentasi-publikasi-ilmiah-mahasiswa.lihat_laporan',compact('publikasi_ilmiah_mahasiswa'));
}


public function pagelaran_pameran_prestasi_publikasi_ilmiah_mahasiswa_add(Request $request)
{

 $data_add = new PagelaranIlmiahMahasiswa();


 $data_add->jenis_publikasi = $request->input('jenis_publikasi');
 $data_add->jumlah_judul_ts2 = $request->input('jumlah_judul_ts2');
 $data_add->jumlah_judul_ts1 = $request->input('jumlah_judul_ts1');
 $data_add->jumlah_judul_ts = $request->input('jumlah_judul_ts');
 $data_add->tahun_akademik = $request->input('tahun_akademik');
 $data_add->link_bukti_dokumen = $request->input('link_bukti_dokumen');
 $data_add->id_user = $request->input('id_user');
$data_add->id_prodi = Auth::user()->id_prodi;
$data_add->status = '0';


 if ($request->hasFile('file_bukti_dokumen')) {
     $file = $request->file('file_bukti_dokumen');
     $extension = $file->getClientOriginalExtension();
     $filename = $file->getClientOriginalName();
     $path = $file->store('public/uploads/luaran_capaian_tridharma/pagelaran_ilmiah_mahasiswa');
     $file->move('uploads/luaran_capaian_tridharma/pagelaran_ilmiah_mahasiswa/', $filename);
     $data_add->file_bukti_dokumen = $filename;
     $data_add->path = $path;
 } else {
     echo "Gagal upload gambar";
 }


 $data_add->save();

 return redirect('/prodi_pagelaran_pameran_prestasi_publikasi_ilmiah_mahasiswa')->with('success', 'Data pagelaran pameran prestasi publikasi ilmiah mahasiswa Baru Berhasil Ditambahkan');
}


public function pagelaran_pameran_prestasi_publikasi_ilmiah_mahasiswa_update(Request $request, $id)
{

  $data_update = PagelaranIlmiahMahasiswa::where('id', $id)->first();


  $input = [
     'jenis_publikasi' => $request->jenis_publikasi,
     'jumlah_judul_ts2' => $request->jumlah_judul_ts2,
     'jumlah_judul_ts1' => $request->jumlah_judul_ts1,
     'jumlah_judul_ts' => $request->jumlah_judul_ts,
     'tahun_akademik' => $request->tahun_akademik,
     'link_bukti_dokumen' => $request->link_bukti_dokumen,

 ];

 if ($file = $request->file('file_bukti_dokumen')) {
     if ($data_update->file_bukti_dokumen) {
        File::delete('uploads/luaran_capaian_tridharma/pagelaran_ilmiah_mahasiswa/' . $data_update->file_bukti_dokumen);
    }
    $nama_file = $file->getClientOriginalName();
    $path = $file->store('public/uploads/luaran_capaian_tridharma/pagelaran_ilmiah_mahasiswa');
    $file->move(public_path() . '/uploads/luaran_capaian_tridharma/pagelaran_ilmiah_mahasiswa/', $nama_file);
    $input['file_bukti_dokumen'] = $nama_file;
    $input['path'] = $path;
}


$data_update->update($input);

return redirect('/prodi_pagelaran_pameran_prestasi_publikasi_ilmiah_mahasiswa')->with('success', 'Data pagelaran pameran prestasi publikasi ilmiah mahasiswa Berhasil Diupdate');

}


public function pagelaran_pameran_prestasi_publikasi_ilmiah_mahasiswa_delete($id)
{
  $delete = PagelaranIlmiahMahasiswa::findOrFail($id);
  File::delete('uploads/luaran_capaian_tridharma/pagelaran_ilmiah_mahasiswa/' . $delete->file_bukti_dokumen);
  $delete->delete();

  return redirect('/prodi_pagelaran_pameran_prestasi_publikasi_ilmiah_mahasiswa')->with('success', 'Data pagelaran pameran prestasi publikasi ilmiah mahasiswa Berhasil Dihapus');
}

public function file_download_dokumen_ilmiah_mahasiswa($id)
{

  $download = PagelaranIlmiahMahasiswa::find($id);

  return  Storage::download($download->path, $download->file_bukti_dokumen);
}


//===================================================================================================================

public function produk_jasa_mahasiswa_diadopsi_oleh_industri_masyarakat()
{

   $produk_jasa_mahasiswa = ProdukMahasiswa::where('id_user', Auth::user()->id)->get();


   return view('lkps-prodi.luaran-dan-capaian-tridharma.luaran-penelitian-dan-pkm-mahasiswa.produk-jasa-mahasiswa-yang-diadopsi-oleh-industri-masyarakat.index',compact('produk_jasa_mahasiswa'));
}


public function produk_jasa_mahasiswa_diadopsi_oleh_industri_masyarakat_add(Request $request)
{

 $data_add = new ProdukMahasiswa();


 $data_add->nama_mahasiswa = $request->input('nama_mahasiswa');
 $data_add->nama_produk = $request->input('nama_produk');
 $data_add->deskripsi_produk = $request->input('deskripsi_produk');
 $data_add->link_bukti = $request->input('link_bukti');
 $data_add->tahun = $request->input('tahun');
 $data_add->id_user = $request->input('id_user');
 $data_add->id_prodi = Auth::user()->id_prodi;
 $data_add->status = '0';



 if ($request->hasFile('file_bukti')) {
     $file = $request->file('file_bukti');
     $extension = $file->getClientOriginalExtension();
     $filename = $file->getClientOriginalName();
     $path = $file->store('public/uploads/luaran_capaian_tridharma/produk_mahasiswa');
     $file->move('uploads/luaran_capaian_tridharma/produk_mahasiswa/', $filename);
     $data_add->file_bukti = $filename;
     $data_add->path = $path;
 } else {
     echo "Gagal upload gambar";
 }


 $data_add->save();

 return redirect('/prodi_produk_jasa_mahasiswa_diadopsi_oleh_industri_masyarakat')->with('success', 'Data produk jasa mahasiswa diadopsi oleh industri masyarakat Baru Berhasil Ditambahkan');
}


public function produk_jasa_mahasiswa_diadopsi_oleh_industri_masyarakat_update(Request $request, $id)
{

  $data_update = ProdukMahasiswa::where('id', $id)->first();


  $input = [
     'nama_mahasiswa' => $request->nama_mahasiswa,
     'nama_produk' => $request->nama_produk,
     'deskripsi_produk' => $request->deskripsi_produk,
     'link_bukti' => $request->link_bukti,
     'tahun' => $request->tahun,

 ];

 if ($file = $request->file('file_bukti')) {
     if ($data_update->file_bukti) {
        File::delete('uploads/luaran_capaian_tridharma/produk_mahasiswa/' . $data_update->file_bukti);
    }
    $nama_file = $file->getClientOriginalName();
    $path = $file->store('public/uploads/luaran_capaian_tridharma/produk_mahasiswa');
    $file->move(public_path() . '/uploads/luaran_capaian_tridharma/produk_mahasiswa/', $nama_file);
    $input['file_bukti'] = $nama_file;
    $input['path'] = $path;
}


$data_update->update($input);

return redirect('/prodi_produk_jasa_mahasiswa_diadopsi_oleh_industri_masyarakat')->with('success', 'Data produk jasa mahasiswa diadopsi oleh industri masyarakat Berhasil Diupdate');

}


public function produk_jasa_mahasiswa_diadopsi_oleh_industri_masyarakat_delete($id)
{
  $delete = ProdukMahasiswa::findOrFail($id);
  File::delete('uploads/luaran_capaian_tridharma/produk_mahasiswa/' . $delete->file_bukti_dokumen);
  $delete->delete();

  return redirect('/prodi_produk_jasa_mahasiswa_diadopsi_oleh_industri_masyarakat')->with('success', 'Data produk jasa mahasiswa diadopsi oleh industri masyarakat Berhasil Dihapus');
}

public function file_download_dokumen_produk_jasa_mahasiswa($id)
{

  $download = ProdukMahasiswa::find($id);

  return  Storage::download($download->path, $download->file_bukti_dokumen);
}



//=======================================================================================================================
public function mahasiswa_hki_paten()
{

    $data_hki_mhs = LuaranPenelitianMahasiswaBagian1::where('id_user',Auth::user()->id)->get();

    return view('lkps-prodi.luaran-dan-capaian-tridharma.luaran-penelitian-dan-pkm-mahasiswa.luaran-penelitian-yang-dihasilkan-mahasiswa.hki-paten.index',compact('data_hki_mhs'));
}


public function mahasiswa_hki_paten_add(Request $request)
{

 $data_add = new LuaranPenelitianMahasiswaBagian1();

 $data_add->luaran_penelitian_pkm = $request->input('luaran_penelitian_pkm');
 $data_add->tahun = $request->input('tahun');
 $data_add->keterangan = $request->input('keterangan');
 $data_add->link_bukti_dokumen = $request->input('link_bukti_dokumen');
 $data_add->id_user = $request->input('id_user');
$data_add->id_prodi = Auth::user()->id_prodi;
$data_add->status = '0';


 if ($request->hasFile('file_bukti_dokumen')) {
     $file = $request->file('file_bukti_dokumen');
     $extension = $file->getClientOriginalExtension();
     $filename = $file->getClientOriginalName();
     $path = $file->store('public/uploads/luaran_capaian_tridharma/luaranpenelitian_mahasiswa_bagian1');
     $file->move('uploads/luaran_capaian_tridharma/luaranpenelitian_mahasiswa_bagian1/', $filename);
     $data_add->file_bukti_dokumen = $filename;
     $data_add->path = $path;
 } else {
     echo "Gagal upload gambar";
 }


 $data_add->save();

 return redirect('/prodi_mahasiswa_hki_paten')->with('success', 'Data Mahasiswa HKI Baru Berhasil Ditambahkan');
}


public function mahasiswa_hki_paten_update(Request $request, $id)
{

  $data_update = LuaranPenelitianMahasiswaBagian1::where('id', $id)->first();


  $input = [
     'luaran_penelitian_pkm' => $request->luaran_penelitian_pkm,
     'tahun' => $request->tahun,
     'keterangan' => $request->keterangan,
     'link_bukti_dokumen' => $request->link_bukti_dokumen,
 ];

 if ($file = $request->file('file_bukti_dokumen')) {
     if ($data_update->file_bukti_dokumen) {
        File::delete('uploads/luaran_capaian_tridharma/luaranpenelitian_mahasiswa_bagian1/' . $data_update->file_bukti_dokumen);
    }
    $nama_file = $file->getClientOriginalName();
    $path = $file->store('public/uploads/luaran_capaian_tridharma/luaranpenelitian_mahasiswa_bagian1');
    $file->move(public_path() . '/uploads/luaran_capaian_tridharma/luaranpenelitian_mahasiswa_bagian1/', $nama_file);
    $input['file_bukti_dokumen'] = $nama_file;
    $input['path'] = $path;
}


$data_update->update($input);

return redirect('/prodi_mahasiswa_hki_paten')->with('success', 'Data Mahasiswa HKI Berhasil Diupdate');
}


public function mahasiswa_hki_paten_delete($id)
{
  $delete = LuaranPenelitianMahasiswaBagian1::findOrFail($id);
  File::delete('uploads/luaran_capaian_tridharma/luaranpenelitian_mahasiswa_bagian1/' . $delete->file_bukti_dokumen);
  $delete->delete();

  return redirect('/prodi_mahasiswa_hki_paten')->with('success', 'Data Mahasiswa HKI Berhasil Dihapus');
}


public function file_download_file_hki_mhs($id)
{

  $download = LuaranPenelitianMahasiswaBagian1::find($id);

  return  Storage::download($download->path, $download->file_bukti_dokumen);
} 

//=======================================================================================================================


public function mahasiswa_hki_hak_cipta()
{

    $data_hki_hak_cipta_mhs = LuaranPenelitianMahasiswaBagian2::where('id_user',Auth::user()->id)->get();


    return view('lkps-prodi.luaran-dan-capaian-tridharma.luaran-penelitian-dan-pkm-mahasiswa.luaran-penelitian-yang-dihasilkan-mahasiswa.hki-hak-cipta-desain-produk-industri.index',compact('data_hki_hak_cipta_mhs'));
}

public function mahasiswa_hki_hak_cipta_add(Request $request)
{

 $data_add = new LuaranPenelitianMahasiswaBagian2();

 $data_add->luaran_penelitian_pkm = $request->input('luaran_penelitian_pkm');
 $data_add->tahun = $request->input('tahun');
 $data_add->keterangan = $request->input('keterangan');
 $data_add->link_bukti_dokumen = $request->input('link_bukti_dokumen');
 $data_add->id_user = $request->input('id_user');
 $data_add->id_prodi = Auth::user()->id_prodi;
 $data_add->status = '0';



 if ($request->hasFile('file_bukti_dokumen')) {
     $file = $request->file('file_bukti_dokumen');
     $extension = $file->getClientOriginalExtension();
     $filename = $file->getClientOriginalName();
     $path = $file->store('public/uploads/luaran_capaian_tridharma/luaranpenelitian_mahasiswa_bagian2');
     $file->move('uploads/luaran_capaian_tridharma/luaranpenelitian_mahasiswa_bagian2/', $filename);
     $data_add->file_bukti_dokumen = $filename;
     $data_add->path = $path;
 } else {
     echo "Gagal upload gambar";
 }


 $data_add->save();

 return redirect('/prodi_mahasiswa_hki_hak_cipta')->with('success', 'Data Mahasiswa HKI Baru Berhasil Ditambahkan');
}


public function mahasiswa_hki_hak_cipta_update(Request $request, $id)
{

  $data_update = LuaranPenelitianMahasiswaBagian2::where('id', $id)->first();


  $input = [
     'luaran_penelitian_pkm' => $request->luaran_penelitian_pkm,
     'tahun' => $request->tahun,
     'keterangan' => $request->keterangan,
     'link_bukti_dokumen' => $request->link_bukti_dokumen,
 ];

 if ($file = $request->file('file_bukti_dokumen')) {
     if ($data_update->file_bukti_dokumen) {
        File::delete('uploads/luaran_capaian_tridharma/luaranpenelitian_mahasiswa_bagian2/' . $data_update->file_bukti_dokumen);
    }
    $nama_file = $file->getClientOriginalName();
    $path = $file->store('public/uploads/luaran_capaian_tridharma/luaranpenelitian_mahasiswa_bagian2');
    $file->move(public_path() . '/uploads/luaran_capaian_tridharma/luaranpenelitian_mahasiswa_bagian2/', $nama_file);
    $input['file_bukti_dokumen'] = $nama_file;
    $input['path'] = $path;
}


$data_update->update($input);

return redirect('/prodi_mahasiswa_hki_hak_cipta')->with('success', 'Data Mahasiswa hki hak cipta Berhasil Diupdate');
}


public function mahasiswa_hki_hak_cipta_delete($id)
{
  $delete = LuaranPenelitianMahasiswaBagian2::findOrFail($id);
  File::delete('uploads/luaran_capaian_tridharma/luaranpenelitian_mahasiswa_bagian2/' . $delete->file_bukti_dokumen);
  $delete->delete();

  return redirect('/prodi_mahasiswa_hki_hak_cipta')->with('success', 'Data Mahasiswa hki hak cipta Berhasil Dihapus');
}


public function file_download_file_hki_hak_cipta_mhs($id)
{

  $download = LuaranPenelitianMahasiswaBagian2::find($id);

  return  Storage::download($download->path, $download->file_bukti_dokumen);
} 

//=======================================================================================================================

public function mahasiswa_teknologi_tepat_guna()
{

    $data_teknologi_tepat_guna_mhs = LuaranPenelitianMahasiswaBagian3::where('id_user',Auth::user()->id)->get();


    return view('lkps-prodi.luaran-dan-capaian-tridharma.luaran-penelitian-dan-pkm-mahasiswa.luaran-penelitian-yang-dihasilkan-mahasiswa.teknologi-tepat-guna.index',compact('data_teknologi_tepat_guna_mhs'));
}


public function mahasiswa_teknologi_tepat_guna_add(Request $request)
{

 $data_add = new LuaranPenelitianMahasiswaBagian3();

 $data_add->luaran_penelitian_pkm = $request->input('luaran_penelitian_pkm');
 $data_add->tahun = $request->input('tahun');
 $data_add->keterangan = $request->input('keterangan');
 $data_add->link_bukti_dokumen = $request->input('link_bukti_dokumen');
 $data_add->id_user = $request->input('id_user');
$data_add->id_prodi = Auth::user()->id_prodi;
$data_add->status = '0';


 if ($request->hasFile('file_bukti_dokumen')) {
     $file = $request->file('file_bukti_dokumen');
     $extension = $file->getClientOriginalExtension();
     $filename = $file->getClientOriginalName();
     $path = $file->store('public/uploads/luaran_capaian_tridharma/luaranpenelitian_mahasiswa_bagian3');
     $file->move('uploads/luaran_capaian_tridharma/luaranpenelitian_mahasiswa_bagian3/', $filename);
     $data_add->file_bukti_dokumen = $filename;
     $data_add->path = $path;
 } else {
     echo "Gagal upload gambar";
 }


 $data_add->save();

 return redirect('/prodi_mahasiswa_teknologi_tepat_guna')->with('success', 'Data Mahasiswa teknologi tepat guna Baru Berhasil Ditambahkan');
}


public function mahasiswa_teknologi_tepat_guna_update(Request $request, $id)
{

  $data_update = LuaranPenelitianMahasiswaBagian3::where('id', $id)->first();


  $input = [
     'luaran_penelitian_pkm' => $request->luaran_penelitian_pkm,
     'tahun' => $request->tahun,
     'keterangan' => $request->keterangan,
     'link_bukti_dokumen' => $request->link_bukti_dokumen,
 ];

 if ($file = $request->file('file_bukti_dokumen')) {
     if ($data_update->file_bukti_dokumen) {
        File::delete('uploads/luaran_capaian_tridharma/luaranpenelitian_mahasiswa_bagian3/' . $data_update->file_bukti_dokumen);
    }
    $nama_file = $file->getClientOriginalName();
    $path = $file->store('public/uploads/luaran_capaian_tridharma/luaranpenelitian_mahasiswa_bagian3');
    $file->move(public_path() . '/uploads/luaran_capaian_tridharma/luaranpenelitian_mahasiswa_bagian3/', $nama_file);
    $input['file_bukti_dokumen'] = $nama_file;
    $input['path'] = $path;
}


$data_update->update($input);

return redirect('/prodi_mahasiswa_teknologi_tepat_guna')->with('success', 'Data Mahasiswa teknologi tepat guna Berhasil Diupdate');
}


public function mahasiswa_teknologi_tepat_guna_delete($id)
{
  $delete = LuaranPenelitianMahasiswaBagian3::findOrFail($id);
  File::delete('uploads/luaran_capaian_tridharma/luaranpenelitian_mahasiswa_bagian3/' . $delete->file_bukti_dokumen);
  $delete->delete();

  return redirect('/prodi_mahasiswa_teknologi_tepat_guna')->with('success', 'Data Mahasiswa teknologi tepat guna Berhasil Dihapus');
}


public function file_download_file_teknologi_tepat_guna_mhs($id)
{

  $download = LuaranPenelitianMahasiswaBagian3::find($id);

  return  Storage::download($download->path, $download->file_bukti_dokumen);
} 


//=======================================================================================================================
public function mahasiswa_buku_berisbn()
{

    $data_buku_berisbn_mhs = LuaranPenelitianMahasiswaBagian4::where('id_user',Auth::user()->id)->get();

    return view('lkps-prodi.luaran-dan-capaian-tridharma.luaran-penelitian-dan-pkm-mahasiswa.luaran-penelitian-yang-dihasilkan-mahasiswa.buku-berisbn.index',compact('data_buku_berisbn_mhs'));
}


public function mahasiswa_buku_berisbn_add(Request $request)
{

 $data_add = new LuaranPenelitianMahasiswaBagian4();

 $data_add->luaran_penelitian_pkm = $request->input('luaran_penelitian_pkm');
 $data_add->tahun = $request->input('tahun');
 $data_add->keterangan = $request->input('keterangan');
 $data_add->link_bukti_dokumen = $request->input('link_bukti_dokumen');
 $data_add->id_user = $request->input('id_user');
$data_add->id_prodi = Auth::user()->id_prodi;
$data_add->status = '0';


 if ($request->hasFile('file_bukti_dokumen')) {
     $file = $request->file('file_bukti_dokumen');
     $extension = $file->getClientOriginalExtension();
     $filename = $file->getClientOriginalName();
     $path = $file->store('public/uploads/luaran_capaian_tridharma/luaranpenelitian_mahasiswa_bagian4');
     $file->move('uploads/luaran_capaian_tridharma/luaranpenelitian_mahasiswa_bagian4/', $filename);
     $data_add->file_bukti_dokumen = $filename;
     $data_add->path = $path;
 } else {
     echo "Gagal upload gambar";
 }


 $data_add->save();

 return redirect('/prodi_mahasiswa_buku_berisbn')->with('success', 'Data Mahasiswa buku berisbn Berhasil Ditambahkan');
}


public function mahasiswa_buku_berisbn_update(Request $request, $id)
{

  $data_update = LuaranPenelitianMahasiswaBagian4::where('id', $id)->first();


  $input = [
     'luaran_penelitian_pkm' => $request->luaran_penelitian_pkm,
     'tahun' => $request->tahun,
     'keterangan' => $request->keterangan,
     'link_bukti_dokumen' => $request->link_bukti_dokumen,
 ];

 if ($file = $request->file('file_bukti_dokumen')) {
     if ($data_update->file_bukti_dokumen) {
        File::delete('uploads/luaran_capaian_tridharma/luaranpenelitian_mahasiswa_bagian4/' . $data_update->file_bukti_dokumen);
    }
    $nama_file = $file->getClientOriginalName();
    $path = $file->store('public/uploads/luaran_capaian_tridharma/luaranpenelitian_mahasiswa_bagian4');
    $file->move(public_path() . '/uploads/luaran_capaian_tridharma/luaranpenelitian_mahasiswa_bagian4/', $nama_file);
    $input['file_bukti_dokumen'] = $nama_file;
    $input['path'] = $path;
}


$data_update->update($input);

return redirect('/prodi_mahasiswa_buku_berisbn')->with('success', 'Data Mahasiswa buku berisbn Berhasil Diupdate');
}


public function mahasiswa_buku_berisbn_delete($id)
{
  $delete = LuaranPenelitianMahasiswaBagian4::findOrFail($id);
  File::delete('uploads/luaran_capaian_tridharma/luaranpenelitian_mahasiswa_bagian4/' . $delete->file_bukti_dokumen);
  $delete->delete();

  return redirect('/prodi_mahasiswa_buku_berisbn')->with('success', 'Data Mahasiswa buku berisbn Berhasil Dihapus');
}


public function file_download_file_buku_berisbn_mhs($id)
{

  $download = LuaranPenelitianMahasiswaBagian4::find($id);

  return  Storage::download($download->path, $download->file_bukti_dokumen);
} 
}
