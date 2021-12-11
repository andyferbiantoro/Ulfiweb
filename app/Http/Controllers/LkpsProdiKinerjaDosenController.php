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
use Auth;
use DB;
use File;
use Illuminate\Support\Facades\Storage;

class LkpsProdiKinerjaDosenController extends Controller
{
    public function kinerja_dosen_pengakuan_rekognisi_dtps(Request $request)
    {
        $dosen = Dosen::where('id_prodi', Auth::user()->id_prodi)->get();
        $filter = $request->filter;

        if ($filter == Null) {

           $pengakuan_dtps = DB::table('pengakuan_dtps')
           ->join('dosen', 'pengakuan_dtps.id_dosen', '=', 'dosen.id')
           ->select('pengakuan_dtps.*', 'dosen.nama_dosen')
           ->orderBy('id', 'DESC')
           ->where('pengakuan_dtps.id_user', Auth::user()->id)
           ->get();
       } else {
          $pengakuan_dtps = DB::table('pengakuan_dtps')
          ->join('dosen', 'pengakuan_dtps.id_dosen', '=', 'dosen.id')
          ->select('pengakuan_dtps.*', 'dosen.nama_dosen')
          ->orderBy('id', 'DESC')
          ->where('pengakuan_dtps.id_user', Auth::user()->id)
          ->where('tahun',$filter)
          ->get();
      }

  return view('lkps-prodi.kinerja-dosen.pengakuan-rekognisi-dtps.index',compact('dosen','pengakuan_dtps'));
}

public function kinerja_dosen_pengakuan_rekognisi_dtps_add(Request $request)
{

   $data_add = new PengakuanDtps();

   $data_add->bidang_keahlian = $request->input('bidang_keahlian');
   $data_add->link_rekognisi_buktiPendukung = $request->input('link_rekognisi_buktiPendukung');
   $data_add->tingkat = $request->input('tingkat');
   $data_add->tahun = $request->input('tahun');
   $data_add->id_user = $request->input('id_user');
   $data_add->id_dosen = $request->input('id_dosen');
   $data_add->id_prodi = Auth::user()->id_prodi;
   $data_add->status = '0';



   if ($request->hasFile('file_rekognisi_buktiPendukung')) {
       $file = $request->file('file_rekognisi_buktiPendukung');
       $extension = $file->getClientOriginalExtension();
       $filename = $file->getClientOriginalName();
       $path = $file->store('public/uploads/kinerja_dosen/pengakuan_dtps');
       $file->move('uploads/kinerja_dosen/pengakuan_dtps/', $filename);
       $data_add->file_rekognisi_buktiPendukung = $filename;
       $data_add->path = $path;
   } else {
       echo "Gagal upload gambar";
   }


   $data_add->save();

   return redirect('/prodi_kinerja_dosen_pengakuan_rekognisi_dtps')->with('success', 'Data kinerja dosen pengakuan rekognisi dtps Baru Berhasil Ditambahkan');
}


public function file_download_bukti_pendukung($id)
{

  $download = PengakuanDtps::find($id);

  return  Storage::download($download->path, $download->file_rekognisi_buktiPendukung);
} 

public function kinerja_dosen_pengakuan_rekognisi_dtps_update(Request $request, $id)
{

  $data_update = PengakuanDtps::where('id', $id)->first();


  $input = [
     'bidang_keahlian' => $request->bidang_keahlian,
     'link_rekognisi_buktiPendukung' => $request->link_rekognisi_buktiPendukung,
     'tingkat' => $request->tingkat,
     'tahun' => $request->tahun,
 ];

 if ($file = $request->file('file_rekognisi_buktiPendukung')) {
     if ($data_update->file_rekognisi_buktiPendukung) {
        File::delete('uploads/kinerja_dosen/pengakuan_dtps/' . $data_update->file_rekognisi_buktiPendukung);
    }
    $nama_file = $file->getClientOriginalName();
    $path = $file->store('public/uploads/kinerja_dosen/pengakuan_dtps');
    $file->move(public_path() . '/uploads/kinerja_dosen/pengakuan_dtps/', $nama_file);
    $input['file_rekognisi_buktiPendukung'] = $nama_file;
    $input['path'] = $path;
}


$data_update->update($input);

return redirect('/prodi_kinerja_dosen_pengakuan_rekognisi_dtps')->with('success', 'Data kinerja dosen pengakuan rekognisi dtps Baru Berhasil Diupdate');
}


public function kinerja_dosen_pengakuan_rekognisi_dtps_delete($id)
{
  $delete = PengakuanDtps::findOrFail($id);
  $delete->delete();

  return redirect('/prodi_kinerja_dosen_pengakuan_rekognisi_dtps')->with('success', 'Data kinerja dosen pengakuan rekognisi dtps Baru Berhasil Dihapus');
}

//==============================================================================================================================================

public function kinerja_dosen_penelitian_dtps(Request $request)
{
         $filter = $request->filter;

         if ($filter == Null) {

          $data_penelitian_dtps = PenelitianDtps::where('id_user', Auth::user()->id)->orderBy('id', 'DESC')->get();

          $jumlah_all = 0;
          foreach ($data_penelitian_dtps as $key => $value) {

            $jumlah = $value->jumlah_judulPenelitian_ts2 + $value->jumlah_judulPenelitian_ts1 + $value->jumlah_judulPenelitian_ts;

            $value->jumlah = $jumlah;
            $jumlah_all +=$value->jumlah;
        }

        $jumlahts2=PenelitianDtps::where('id_user', Auth::user()->id)->sum('jumlah_judulPenelitian_ts2');
        $jumlahts1=PenelitianDtps::where('id_user', Auth::user()->id)->sum('jumlah_judulPenelitian_ts1');
        $jumlahts=PenelitianDtps::where('id_user', Auth::user()->id)->sum('jumlah_judulPenelitian_ts');
         $jumlah_all = $jumlah_all;

        } else {

           $data_penelitian_dtps = PenelitianDtps::where('id_user', Auth::user()->id)->orderBy('id', 'DESC')->where('tahun_akademik',$filter)->get();

           $jumlah_all = 0;
           foreach ($data_penelitian_dtps as $key => $value) {

            $jumlah = $value->jumlah_judulPenelitian_ts2 + $value->jumlah_judulPenelitian_ts1 + $value->jumlah_judulPenelitian_ts;

            $value->jumlah = $jumlah;
            $jumlah_all +=$value->jumlah;
        }

        $jumlahts2=PenelitianDtps::where('id_user', Auth::user()->id)->sum('jumlah_judulPenelitian_ts2');
        $jumlahts1=PenelitianDtps::where('id_user', Auth::user()->id)->sum('jumlah_judulPenelitian_ts1');
        $jumlahts=PenelitianDtps::where('id_user', Auth::user()->id)->sum('jumlah_judulPenelitian_ts');
         $jumlah_all = $jumlah_all;
        
        }


return view('lkps-prodi.kinerja-dosen.penelitian-dtps.index',compact('data_penelitian_dtps','jumlahts2','jumlahts1','jumlahts','jumlah_all'));
}

public function kinerja_dosen_penelitian_dtps_add(Request $request)
{

   $data_add = new PenelitianDtps();

   $data_add->sumber_pembiayaan = $request->input('sumber_pembiayaan');
   $data_add->jumlah_judulPenelitian_ts2 = $request->input('jumlah_judulPenelitian_ts2');
   $data_add->jumlah_judulPenelitian_ts1 = $request->input('jumlah_judulPenelitian_ts1');
   $data_add->jumlah_judulPenelitian_ts = $request->input('jumlah_judulPenelitian_ts');
   $data_add->tahun_akademik = $request->input('tahun_akademik');
   $data_add->link_bukti_dokumen = $request->input('link_bukti_dokumen');
   $data_add->id_user = $request->input('id_user');
   $data_add->id_prodi = Auth::user()->id_prodi;
   $data_add->status = '0';


   if ($request->hasFile('file_bukti_dokumen')) {
       $file = $request->file('file_bukti_dokumen');
       $extension = $file->getClientOriginalExtension();
       $filename = $file->getClientOriginalName();
       $path = $file->store('public/uploads/kinerja_dosen/penelitian_dtps');
       $file->move('uploads/kinerja_dosen/penelitian_dtps/', $filename);
       $data_add->file_bukti_dokumen = $filename;
       $data_add->path = $path;
   } else {
       echo "Gagal upload gambar";
   }


   $data_add->save();

   return redirect('/prodi_kinerja_dosen_penelitian_dtps')->with('success', 'Data Penelitian dtps Baru Berhasil Ditambahkan');
}


public function file_download_file_bukti_dokumen($id)
{

  $download = PenelitianDtps::find($id);

  return  Storage::download($download->path, $download->file_bukti_dokumen);
} 


public function lihat_kinerja_dosen_penelitian_dtps()
{

    $data_penelitian_dtps = PenelitianDtps::where('id_user', Auth::user()->id)->orderBy('id', 'DESC')->get();

    return view('lkps-prodi.kinerja-dosen.penelitian-dtps.lihat_laporan',compact('data_penelitian_dtps'));
}

public function kinerja_dosen_penelitian_dtps_update(Request $request, $id)
{

  $data_update = PenelitianDtps::where('id', $id)->first();


  $input = [
     'sumber_pembiayaan' => $request->sumber_pembiayaan,
     'jumlah_judulPenelitian_ts2' => $request->jumlah_judulPenelitian_ts2,
     'jumlah_judulPenelitian_ts1' => $request->jumlah_judulPenelitian_ts1,
     'jumlah_judulPenelitian_ts' => $request->jumlah_judulPenelitian_ts,
     'tahun_akademik' => $request->tahun_akademik,
     'link_bukti_dokumen' => $request->link_bukti_dokumen,
 ];

 if ($file = $request->file('file_bukti_dokumen')) {
     if ($data_update->file_bukti_dokumen) {
        File::delete('uploads/kinerja_dosen/penelitian_dtps/' . $data_update->file_bukti_dokumen);
    }
    $nama_file = $file->getClientOriginalName();
    $path = $file->store('public/uploads/kinerja_dosen/penelitian_dtps');
    $file->move(public_path() . '/uploads/kinerja_dosen/penelitian_dtps/', $nama_file);
    $input['file_bukti_dokumen'] = $nama_file;
    $input['path'] = $path;
}


$data_update->update($input);

return redirect('/prodi_kinerja_dosen_penelitian_dtps')->with('success', 'Data Penelitian dtps Baru Berhasil Diupdate');
}


public function kinerja_dosen_penelitian_dtps_delete($id)
{
  $delete = PenelitianDtps::findOrFail($id);
  $delete->delete();

  return redirect('/prodi_kinerja_dosen_penelitian_dtps')->with('success', 'Data Penelitian dtps Baru Berhasil Dihapus');

}


//================================================================================================================================

public function kinerja_dosen_pengabdian_kepada_masyarakat_dtps(Request $request)
{

 $filter = $request->filter;

 if ($filter == Null) {

  $data_pkm_dtps = PkmDtps::where('id_user', Auth::user()->id)->orderBy('id', 'DESC')->get();

  $jumlah_all = 0;
  foreach ($data_pkm_dtps as $key => $value) {

    $jumlah = $value->jumlah_judulPkm_ts2 + $value->jumlah_judulPkm_ts1 + $value->jumlah_judulPkm_ts;

    $value->jumlah = $jumlah;
    $jumlah_all +=$value->jumlah;

}

$jumlahts2=PkmDtps::where('id_user', Auth::user()->id)->sum('jumlah_judulPkm_ts2');
$jumlahts1=PkmDtps::where('id_user', Auth::user()->id)->sum('jumlah_judulPkm_ts1');
$jumlahts=PkmDtps::where('id_user', Auth::user()->id)->sum('jumlah_judulPkm_ts');
 $jumlah_all = $jumlah_all;
} else {

  $data_pkm_dtps = PkmDtps::where('id_user', Auth::user()->id)->orderBy('id', 'DESC')->where('tahun_akademik',$filter)->get();

$jumlah_all = 0;
  foreach ($data_pkm_dtps as $key => $value) {

    $jumlah = $value->jumlah_judulPkm_ts2 + $value->jumlah_judulPkm_ts1 + $value->jumlah_judulPkm_ts;

    $value->jumlah = $jumlah;
    $jumlah_all +=$value->jumlah;
}
$jumlahts2=PkmDtps::where('id_user', Auth::user()->id)->sum('jumlah_judulPkm_ts2');
$jumlahts1=PkmDtps::where('id_user', Auth::user()->id)->sum('jumlah_judulPkm_ts1');
$jumlahts=PkmDtps::where('id_user', Auth::user()->id)->sum('jumlah_judulPkm_ts');
 $jumlah_all = $jumlah_all;
}

return view('lkps-prodi.kinerja-dosen.pengabdian-kepada-masyarakat-dtps.index',compact('data_pkm_dtps','jumlahts2','jumlahts1','jumlahts','jumlah_all'));
}

public function lihat_kinerja_dosen_pengabdian_kepada_masyarakat_dtps()
{

    $data_pkm_dtps = PkmDtps::where('id_user', Auth::user()->id)->orderBy('id', 'DESC')->get();

    foreach ($data_pkm_dtps as $key => $value) {

        $jumlah = $value->jumlah_judulPkm_ts2 + $value->jumlah_judulPkm_ts1 + $value->jumlah_judulPkm_ts;
        
        $value->jumlah = $jumlah;
        $jumlah_all +=$value->jumlah;
    }
    return view('lkps-prodi.kinerja-dosen.pengabdian-kepada-masyarakat-dtps.lihat_laporan',compact('data_pkm_dtps'));
}


public function kinerja_dosen_pengabdian_kepada_masyarakat_dtps_add(Request $request)
{

   $data_add = new PkmDtps();

   $data_add->sumber_pembiayaan = $request->input('sumber_pembiayaan');
   $data_add->jumlah_judulPkm_ts2 = $request->input('jumlah_judulPkm_ts2');
   $data_add->jumlah_judulPkm_ts1 = $request->input('jumlah_judulPkm_ts1');
   $data_add->jumlah_judulPkm_ts = $request->input('jumlah_judulPkm_ts');
   $data_add->tahun_akademik = $request->input('tahun_akademik');
   $data_add->link_bukti_dokumen = $request->input('link_bukti_dokumen');
   $data_add->id_user = $request->input('id_user');
    $data_add->id_prodi = Auth::user()->id_prodi;
    $data_add->status = '0';


   if ($request->hasFile('file_bukti_dokumen')) {
       $file = $request->file('file_bukti_dokumen');
       $extension = $file->getClientOriginalExtension();
       $filename = $file->getClientOriginalName();
       $path = $file->store('public/uploads/kinerja_dosen/pkm_dtps');
       $file->move('uploads/kinerja_dosen/pkm_dtps/', $filename);
       $data_add->file_bukti_dokumen = $filename;
       $data_add->path = $path;
   } else {
       echo "Gagal upload gambar";
   }


   $data_add->save();

   return redirect('/prodi_kinerja_dosen_pengabdian_kepada_masyarakat_dtps')->with('success', 'Data PKM dtps Baru Berhasil Ditambahkan');
}


public function file_download_file_bukti_dokumen_pkm($id)
{

  $download = PkmDtps::find($id);

  return  Storage::download($download->path, $download->file_bukti_dokumen);
} 

public function kinerja_dosen_pengabdian_kepada_masyarakat_dtps_update(Request $request, $id)
{

  $data_update = PkmDtps::where('id', $id)->first();


  $input = [
     'sumber_pembiayaan' => $request->sumber_pembiayaan,
     'jumlah_judulPkm_ts2' => $request->jumlah_judulPkm_ts2,
     'jumlah_judulPkm_ts1' => $request->jumlah_judulPkm_ts1,
     'jumlah_judulPkm_ts' => $request->jumlah_judulPkm_ts,
     'tahun_akademik' => $request->tahun_akademik,
     'link_bukti_dokumen' => $request->link_bukti_dokumen,
 ];

 if ($file = $request->file('file_bukti_dokumen')) {
     if ($data_update->file_bukti_dokumen) {
        File::delete('uploads/kinerja_dosen/pkm_dtps/' . $data_update->file_bukti_dokumen);
    }
    $nama_file = $file->getClientOriginalName();
    $path = $file->store('public/uploads/kinerja_dosen/pkm_dtps');
    $file->move(public_path() . '/uploads/kinerja_dosen/pkm_dtps/', $nama_file);
    $input['file_bukti_dokumen'] = $nama_file;
    $input['path'] = $path;
}


$data_update->update($input);

return redirect('/prodi_kinerja_dosen_pengabdian_kepada_masyarakat_dtps')->with('success', 'Data PKM dtps Baru Berhasil Diupdate');
}

public function kinerja_dosen_pengabdian_kepada_masyarakat_dtps_delete($id)
{
  $delete = PkmDtps::findOrFail($id);
  $delete->delete();

  return redirect('/prodi_kinerja_dosen_pengabdian_kepada_masyarakat_dtps')->with('success', 'Data PKM dtps Baru Berhasil Dihapus');

}

//=====================================================================================================================

public function kinerja_dosen_pagelaran_pameran_prestasi_publikasi_ilmiah_dtps(Request $request)
{

   $filter = $request->filter;

   if ($filter == Null) {

     $data_ilmiah_dtps = PagelaranIlmiahDtps::where('id_user', Auth::user()->id)->orderBy('id', 'DESC')->get();

     $jumlah_all = 0;
     foreach ($data_ilmiah_dtps as $key => $value) {

        $jumlah = $value->jumlah_judul_ts2 + $value->jumlah_judul_ts1 + $value->jumlah_judul_ts;

        $value->jumlah = $jumlah;
        $jumlah_all +=$value->jumlah;

    }
        $jumlahts2=PagelaranIlmiahDtps::where('id_user', Auth::user()->id)->sum('jumlah_judul_ts2');
        $jumlahts1=PagelaranIlmiahDtps::where('id_user', Auth::user()->id)->sum('jumlah_judul_ts1');
        $jumlahts=PagelaranIlmiahDtps::where('id_user', Auth::user()->id)->sum('jumlah_judul_ts');
        $total_jumlah = $value->jumlah;
        $jumlah_all = $jumlah_all;

} else {

  $data_ilmiah_dtps = PagelaranIlmiahDtps::where('id_user', Auth::user()->id)->orderBy('id', 'DESC')->where('tahun_akademik', $filter)->get();

  $jumlah_all = 0;
  foreach ($data_ilmiah_dtps as $key => $value) {

    $jumlah = $value->jumlah_judul_ts2 + $value->jumlah_judul_ts1 + $value->jumlah_judul_ts;

    $value->jumlah = $jumlah;

}

$jumlahts2=PagelaranIlmiahDtps::where('id_user', Auth::user()->id)->sum('jumlah_judul_ts2');
$jumlahts1=PagelaranIlmiahDtps::where('id_user', Auth::user()->id)->sum('jumlah_judul_ts1');
$jumlahts=PagelaranIlmiahDtps::where('id_user', Auth::user()->id)->sum('jumlah_judul_ts');
$total_jumlah = $value->jumlah;
 $jumlah_all = $jumlah_all;

}

return view('lkps-prodi.kinerja-dosen.pagelaran-pameran-prestasi-publikasi-ilmiah-dtps.index',compact('data_ilmiah_dtps','jumlahts2','jumlahts1','jumlahts','total_jumlah','jumlah_all'));
}


public function lihat_kinerja_dosen_pagelaran_pameran_prestasi_publikasi_ilmiah_dtps()
{

   $data_ilmiah_dtps = PagelaranIlmiahDtps::where('id_user', Auth::user()->id)->orderBy('id', 'DESC')->get();

   foreach ($data_ilmiah_dtps as $key => $value) {

    $jumlah = $value->jumlah_judul_ts2 + $value->jumlah_judul_ts1 + $value->jumlah_judul_ts;

    $value->jumlah = $jumlah;

}
return view('lkps-prodi.kinerja-dosen.pagelaran-pameran-prestasi-publikasi-ilmiah-dtps.lihat_laporan',compact('data_ilmiah_dtps'));
}


public function file_download_file_bukti_dokumen_ilmiah_pkm($id)
{

  $download = PagelaranIlmiahDtps::find($id);

  return  Storage::download($download->path, $download->file_bukti_dokumen);
} 

public function kinerja_dosen_pagelaran_pameran_prestasi_publikasi_ilmiah_dtps_add(Request $request)
{

   $data_add = new PagelaranIlmiahDtps();

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
       $path = $file->store('public/uploads/kinerja_dosen/pagelaran_ilmiah_dtps');
       $file->move('uploads/kinerja_dosen/pagelaran_ilmiah_dtps/', $filename);
       $data_add->file_bukti_dokumen = $filename;
       $data_add->path = $path;
   } else {
       echo "Gagal upload gambar";
   }


   $data_add->save();

   return redirect('/prodi_kinerja_dosen_pagelaran_pameran_prestasi_publikasi_ilmiah_dtps')->with('success', 'Data pagelaran pameran prestasi publikasi dtps Baru Berhasil Ditambahkan');
}


public function kinerja_dosen_pagelaran_pameran_prestasi_publikasi_ilmiah_dtps_update(Request $request, $id)
{

  $data_update = PagelaranIlmiahDtps::where('id', $id)->first();


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
        File::delete('uploads/kinerja_dosen/pagelaran_ilmiah_dtps/' . $data_update->file_bukti_dokumen);
    }
    $nama_file = $file->getClientOriginalName();
    $path = $file->store('public/uploads/kinerja_dosen/pagelaran_ilmiah_dtps');
    $file->move(public_path() . '/uploads/kinerja_dosen/pagelaran_ilmiah_dtps/', $nama_file);
    $input['file_bukti_dokumen'] = $nama_file;
    $input['path'] = $path;
}


$data_update->update($input);

return redirect('/prodi_kinerja_dosen_pagelaran_pameran_prestasi_publikasi_ilmiah_dtps')->with('success', 'Data pagelaran pameran prestasi publikasi dtps Baru Berhasil Diupdate');
}

public function kinerja_dosen_pagelaran_pameran_prestasi_publikasi_ilmiah_dtps_delete($id)
{
  $delete = PagelaranIlmiahDtps::findOrFail($id);
  $delete->delete();

  return redirect('/prodi_kinerja_dosen_pagelaran_pameran_prestasi_publikasi_ilmiah_dtps')->with('success', 'Data pagelaran pameran prestasi publikasi dtps Baru Berhasil Dihapus');

}

//=====================================================================================================================

public function kinerja_dosen_karya_ilmiah_dtps_yang_disitasi(Request $request)
{
        $dosen = Dosen::where('id_prodi', Auth::user()->id_prodi)->get();
        $filter = $request->filter;

        if ($filter == Null) {

           $karya_ilmiah_dtps = DB::table('karya_ilmiah_dtps')
           ->join('dosen', 'karya_ilmiah_dtps.id_dosen', '=', 'dosen.id')
           ->select('karya_ilmiah_dtps.*', 'dosen.nama_dosen')
           ->orderBy('id', 'DESC')
           ->where('karya_ilmiah_dtps.id_user', Auth::user()->id)
           ->get();
       } else {
          $karya_ilmiah_dtps = DB::table('karya_ilmiah_dtps')
          ->join('dosen', 'karya_ilmiah_dtps.id_dosen', '=', 'dosen.id')
          ->select('karya_ilmiah_dtps.*', 'dosen.nama_dosen')
          ->orderBy('id', 'DESC')
          ->where('karya_ilmiah_dtps.id_user', Auth::user()->id)
          ->where('tahun',$filter)
          ->get();
      }

    return view('lkps-prodi.kinerja-dosen.karya-ilmiah-dtps-yang-disitasi.index',compact('karya_ilmiah_dtps','dosen'));
}


public function file_download_file_bukti_sitasi($id)
{

  $download = KaryaIlmiahDtps::find($id);

  return  Storage::download($download->path, $download->file_bukti_sitasi);
} 


public function kinerja_dosen_karya_ilmiah_dtps_yang_disitasi_add(Request $request)
{

   $data_add = new KaryaIlmiahDtps();

   $data_add->judul_artikel = $request->input('judul_artikel');
   $data_add->jumlah_sitasi = $request->input('jumlah_sitasi');
   $data_add->link_bukti_sitasi = $request->input('link_bukti_sitasi');
   $data_add->tahun = $request->input('tahun');
   $data_add->id_dosen = $request->input('id_dosen');
   $data_add->id_user = $request->input('id_user');
   $data_add->id_prodi = Auth::user()->id_prodi;
   $data_add->status = '0';


   if ($request->hasFile('file_bukti_sitasi')) {
       $file = $request->file('file_bukti_sitasi');
       $extension = $file->getClientOriginalExtension();
       $filename = $file->getClientOriginalName();
       $path = $file->store('public/uploads/kinerja_dosen/karya_ilmiah_dtps');
       $file->move('uploads/kinerja_dosen/karya_ilmiah_dtps/', $filename);
       $data_add->file_bukti_sitasi = $filename;
       $data_add->path = $path;
   } else {
       echo "Gagal upload gambar";
   }


   $data_add->save();

   return redirect('/prodi_kinerja_dosen_karya_ilmiah_dtps_yang_disitasi')->with('success', 'Data karya ilmiah dtps Baru Berhasil Ditambahkan');
}



public function kinerja_dosen_karya_ilmiah_dtps_yang_disitasi_update(Request $request, $id)
{

  $data_update = KaryaIlmiahDtps::where('id', $id)->first();


  $input = [
     'judul_artikel' => $request->judul_artikel,
     'jumlah_sitasi' => $request->jumlah_sitasi,
     'link_bukti_sitasi' => $request->link_bukti_sitasi,
     'tahun' => $request->tahun,
 ];

 if ($file = $request->file('file_bukti_sitasi')) {
     if ($data_update->file_bukti_sitasi) {
        File::delete('uploads/kinerja_dosen/karya_ilmiah_dtps/' . $data_update->file_bukti_sitasi);
    }
    $nama_file = $file->getClientOriginalName();
    $path = $file->store('public/uploads/kinerja_dosen/karya_ilmiah_dtps');
    $file->move(public_path() . '/uploads/kinerja_dosen/karya_ilmiah_dtps/', $nama_file);
    $input['file_bukti_sitasi'] = $nama_file;
    $input['path'] = $path;
}


$data_update->update($input);

 return redirect('/prodi_kinerja_dosen_karya_ilmiah_dtps_yang_disitasi')->with('success', 'Data karya ilmiah dtps Baru Berhasil Diupdate');
}

public function kinerja_dosen_karya_ilmiah_dtps_yang_disitasi_delete($id)
{
  $delete = KaryaIlmiahDtps::findOrFail($id);
  $delete->delete();

  return redirect('/prodi_kinerja_dosen_karya_ilmiah_dtps_yang_disitasi')->with('success', 'Data karya ilmiah dtps Baru Berhasil Dihapus');

}
//======================================================================================================================

public function kinerja_dosen_produk_jasa_dtps_diadopsi_oleh_industri_masyarakat(Request $request)
{

     $dosen = Dosen::where('id_prodi', Auth::user()->id_prodi)->get();
        $filter = $request->filter;

        if ($filter == Null) {

           $produk_dtps = DB::table('produk_dtps')
           ->join('dosen', 'produk_dtps.id_dosen', '=', 'dosen.id')
           ->select('produk_dtps.*', 'dosen.nama_dosen')
           ->orderBy('id', 'DESC')
           ->where('produk_dtps.id_user', Auth::user()->id)
           ->get();
       } else {
          $produk_dtps = DB::table('produk_dtps')
          ->join('dosen', 'produk_dtps.id_dosen', '=', 'dosen.id')
          ->select('produk_dtps.*', 'dosen.nama_dosen')
          ->orderBy('id', 'DESC')
          ->where('produk_dtps.id_user', Auth::user()->id)
          ->where('tahun',$filter)
          ->get();
      }

    return view('lkps-prodi.kinerja-dosen.produk-jasa-dtps-diadopsi-oleh-industri-masyarakat.index',compact('produk_dtps','dosen'));
}

public function file_download_file_bukti_produk_dtps($id)
{

  $download = ProdukDtps::find($id);

  return  Storage::download($download->path, $download->file_bukti);
} 


public function kinerja_dosen_produk_jasa_dtps_diadopsi_oleh_industri_masyarakat_add(Request $request)
{

   $data_add = new ProdukDtps();

   $data_add->nama_produk = $request->input('nama_produk');
   $data_add->deskripsi_produk = $request->input('deskripsi_produk');
   $data_add->link_bukti = $request->input('link_bukti');
   $data_add->tahun = $request->input('tahun');
   $data_add->id_dosen = $request->input('id_dosen');
   $data_add->id_user = $request->input('id_user');
   $data_add->id_prodi = Auth::user()->id_prodi;
   $data_add->status = '0';


   if ($request->hasFile('file_bukti')) {
       $file = $request->file('file_bukti');
       $extension = $file->getClientOriginalExtension();
       $filename = $file->getClientOriginalName();
       $path = $file->store('public/uploads/kinerja_dosen/produk_dtps');
       $file->move('uploads/kinerja_dosen/produk_dtps/', $filename);
       $data_add->file_bukti = $filename;
       $data_add->path = $path;
   } else {
       echo "Gagal upload gambar";
   }


   $data_add->save();

   return redirect('/prodi_kinerja_dosen_produk_jasa_dtps_diadopsi_oleh_industri_masyarakat')->with('success', 'Data Produk dtps Baru Berhasil Ditambahkan');
}


public function kinerja_dosen_produk_jasa_dtps_diadopsi_oleh_industri_masyarakat_update(Request $request, $id)
{

  $data_update = ProdukDtps::where('id', $id)->first();


  $input = [
     'nama_produk' => $request->nama_produk,
     'deskripsi_produk' => $request->deskripsi_produk,
     'link_bukti' => $request->link_bukti,
     'tahun' => $request->tahun,
 ];

 if ($file = $request->file('file_bukti')) {
     if ($data_update->file_bukti) {
        File::delete('uploads/kinerja_dosen/produk_dtps/' . $data_update->file_bukti);
    }
    $nama_file = $file->getClientOriginalName();
    $path = $file->store('public/uploads/kinerja_dosen/produk_dtps');
    $file->move(public_path() . '/uploads/kinerja_dosen/produk_dtps/', $nama_file);
    $input['file_bukti'] = $nama_file;
    $input['path'] = $path;
}


$data_update->update($input);

 return redirect('/prodi_kinerja_dosen_produk_jasa_dtps_diadopsi_oleh_industri_masyarakat')->with('success', 'Data Produk dtps Baru Berhasil Diupdate');
}

public function kinerja_dosen_produk_jasa_dtps_diadopsi_oleh_industri_masyarakat_delete($id)
{
  $delete = ProdukDtps::findOrFail($id);
  $delete->delete();

  return redirect('/prodi_kinerja_dosen_produk_jasa_dtps_diadopsi_oleh_industri_masyarakat')->with('success', 'Data Produk dtps Baru Berhasil Dihapus');

}
//========================================================================================================================

public function kinerja_dosen_hki_paten()
{   
    $data_hki = LuaranPenelitianDtpsBagian1::where('id_user',Auth::user()->id)->get();

    return view('lkps-prodi.kinerja-dosen.luaran-penelitian-pkm-lainnya-oleh-dtps.hki-paten.index',compact('data_hki'));
}


public function file_download_file_hki($id)
{

  $download = LuaranPenelitianDtpsBagian1::find($id);

  return  Storage::download($download->path, $download->file_bukti_dokumen);
} 


public function kinerja_dosen_hki_paten_add(Request $request)
{

   $data_add = new LuaranPenelitianDtpsBagian1();

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
       $path = $file->store('public/uploads/kinerja_dosen/luaranpenelitian_dtps_bagian1');
       $file->move('uploads/kinerja_dosen/luaranpenelitian_dtps_bagian1/', $filename);
       $data_add->file_bukti_dokumen = $filename;
       $data_add->path = $path;
   } else {
       echo "Gagal upload gambar";
   }


   $data_add->save();

   return redirect('/prodi_kinerja_dosen_hki_paten')->with('success', 'Data kinerja dosen HKI Baru Berhasil Ditambahkan');
}


public function kinerja_dosen_hki_paten_update(Request $request, $id)
{

  $data_update = LuaranPenelitianDtpsBagian1::where('id', $id)->first();


  $input = [
   'luaran_penelitian_pkm' => $request->luaran_penelitian_pkm,
   'tahun' => $request->tahun,
   'keterangan' => $request->keterangan,
   'link_bukti_dokumen' => $request->link_bukti_dokumen,
];

if ($file = $request->file('file_bukti_dokumen')) {
   if ($data_update->file_bukti_dokumen) {
    File::delete('uploads/kinerja_dosen/luaranpenelitian_dtps_bagian1/' . $data_update->file_bukti_dokumen);
    }
    $nama_file = $file->getClientOriginalName();
    $path = $file->store('public/uploads/kinerja_dosen/luaranpenelitian_dtps_bagian1');
    $file->move(public_path() . '/uploads/kinerja_dosen/luaranpenelitian_dtps_bagian1/', $nama_file);
    $input['file_bukti_dokumen'] = $nama_file;
    $input['path'] = $path;
    }


$data_update->update($input);

 return redirect('/prodi_kinerja_dosen_hki_paten')->with('success', 'Data kinerja dosen HKI Baru Berhasil Diupdate');
}


public function kinerja_dosen_hki_paten_delete($id)
{
  $delete = LuaranPenelitianDtpsBagian1::findOrFail($id);
  $delete->delete();

 return redirect('/prodi_kinerja_dosen_hki_paten')->with('success', 'Data kinerja dosen HKI Baru Berhasil Dihapus');

}

//========================================================================================================================

public function kinerja_dosen_hki_hak_cipta()
{
     $data_hki_hak_cipta = LuaranPenelitianDtpsBagian2::where('id_user',Auth::user()->id)->get();

    return view('lkps-prodi.kinerja-dosen.luaran-penelitian-pkm-lainnya-oleh-dtps.hki-hak-cipta.index',compact('data_hki_hak_cipta'));
}


public function file_download_file_hki_hak_cipta($id)
{

  $download = LuaranPenelitianDtpsBagian2::find($id);

  return  Storage::download($download->path, $download->file_bukti_dokumen);
} 


public function kinerja_dosen_hki_hak_cipta_add(Request $request)
{

   $data_add = new LuaranPenelitianDtpsBagian2();

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
       $path = $file->store('public/uploads/kinerja_dosen/luaranpenelitian_dtps_bagian1');
       $file->move('uploads/kinerja_dosen/luaranpenelitian_dtps_bagian1/', $filename);
       $data_add->file_bukti_dokumen = $filename;
       $data_add->path = $path;
   } else {
       echo "Gagal upload gambar";
   }


   $data_add->save();

   return redirect('/prodi_kinerja_dosen_hki_hak_cipta')->with('success', 'Data kinerja dosen HKI Hak Cipta Baru Berhasil Ditambahkan');
}


public function kinerja_dosen_hki_hak_cipta_update(Request $request, $id)
{

  $data_update = LuaranPenelitianDtpsBagian2::where('id', $id)->first();


  $input = [
   'luaran_penelitian_pkm' => $request->luaran_penelitian_pkm,
   'tahun' => $request->tahun,
   'keterangan' => $request->keterangan,
   'link_bukti_dokumen' => $request->link_bukti_dokumen,
];

if ($file = $request->file('file_bukti_dokumen')) {
   if ($data_update->file_bukti_dokumen) {
    File::delete('uploads/kinerja_dosen/luaranpenelitian_dtps_bagian1/' . $data_update->file_bukti_dokumen);
    }
    $nama_file = $file->getClientOriginalName();
    $path = $file->store('public/uploads/kinerja_dosen/luaranpenelitian_dtps_bagian1');
    $file->move(public_path() . '/uploads/kinerja_dosen/luaranpenelitian_dtps_bagian1/', $nama_file);
    $input['file_bukti_dokumen'] = $nama_file;
    $input['path'] = $path;
    }


$data_update->update($input);

 return redirect('/prodi_kinerja_dosen_hki_hak_cipta')->with('success', 'Data kinerja dosen HKI Hak Cipta Baru Berhasil Diupdate');
}


public function kinerja_dosen_hki_hak_cipta_delete($id)
{
  $delete = LuaranPenelitianDtpsBagian2::findOrFail($id);
  $delete->delete();

 return redirect('/prodi_kinerja_dosen_hki_hak_cipta')->with('success', 'Data kinerja dosen HKI Hak Cipta Baru Berhasil Dihapus');

}

//========================================================================================================================

public function kinerja_dosen_teknologi_tepat_guna()
{
    $data_teknologi_tepat_guna = LuaranPenelitianDtpsBagian3::where('id_user',Auth::user()->id)->get();

    return view('lkps-prodi.kinerja-dosen.luaran-penelitian-pkm-lainnya-oleh-dtps.teknologi-tepat-guna.index',compact('data_teknologi_tepat_guna'));
}


public function file_download_file_teknologi_tepat_guna($id)
{

  $download = LuaranPenelitianDtpsBagian3::find($id);

  return  Storage::download($download->path, $download->file_bukti_dokumen);
} 


public function kinerja_dosen_teknologi_tepat_guna_add(Request $request)
{

   $data_add = new LuaranPenelitianDtpsBagian3();

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
       $path = $file->store('public/uploads/kinerja_dosen/luaranpenelitian_dtps_bagian3');
       $file->move('uploads/kinerja_dosen/luaranpenelitian_dtps_bagian3/', $filename);
       $data_add->file_bukti_dokumen = $filename;
       $data_add->path = $path;
   } else {
       echo "Gagal upload gambar";
   }


   $data_add->save();

   return redirect('/prodi_kinerja_dosen_teknologi_tepat_guna')->with('success', 'Data kinerja dosen Teknologi Tepat Guna Baru Berhasil Ditambahkan');
}


public function kinerja_dosen_teknologi_tepat_guna_update(Request $request, $id)
{

  $data_update = LuaranPenelitianDtpsBagian3::where('id', $id)->first();


  $input = [
   'luaran_penelitian_pkm' => $request->luaran_penelitian_pkm,
   'tahun' => $request->tahun,
   'keterangan' => $request->keterangan,
   'link_bukti_dokumen' => $request->link_bukti_dokumen,
];

if ($file = $request->file('file_bukti_dokumen')) {
   if ($data_update->file_bukti_dokumen) {
    File::delete('uploads/kinerja_dosen/luaranpenelitian_dtps_bagian3/' . $data_update->file_bukti_dokumen);
    }
    $nama_file = $file->getClientOriginalName();
    $path = $file->store('public/uploads/kinerja_dosen/luaranpenelitian_dtps_bagian3');
    $file->move(public_path() . '/uploads/kinerja_dosen/luaranpenelitian_dtps_bagian3/', $nama_file);
    $input['file_bukti_dokumen'] = $nama_file;
    $input['path'] = $path;
    }


$data_update->update($input);

 return redirect('/prodi_kinerja_dosen_teknologi_tepat_guna')->with('success', 'Data kinerja dosen Teknologi Tepat Guna Berhasil Diupdate');
}


public function kinerja_dosen_teknologi_tepat_guna_delete($id)
{
  $delete = LuaranPenelitianDtpsBagian3::findOrFail($id);
  $delete->delete();

 return redirect('/prodi_kinerja_dosen_teknologi_tepat_guna')->with('success', 'Data kinerja dosen Teknologi Tepat Guna Berhasil Dihapus');

}


//=========================================================================================================================

public function kinerja_dosen_buku_berisbn()
{

     $data_buku_berisbn = LuaranPenelitianDtpsBagian4::where('id_user',Auth::user()->id)->get();

    return view('lkps-prodi.kinerja-dosen.luaran-penelitian-pkm-lainnya-oleh-dtps.buku-berisbn.index',compact('data_buku_berisbn'));
}


public function file_download_file_buku_berisbn($id)
{

  $download = LuaranPenelitianDtpsBagian4::find($id);

  return  Storage::download($download->path, $download->file_bukti_dokumen);
} 


public function kinerja_dosen_buku_berisbn_add(Request $request)
{

   $data_add = new LuaranPenelitianDtpsBagian4();

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
       $path = $file->store('public/uploads/kinerja_dosen/luaranpenelitian_dtps_bagian4');
       $file->move('uploads/kinerja_dosen/luaranpenelitian_dtps_bagian4/', $filename);
       $data_add->file_bukti_dokumen = $filename;
       $data_add->path = $path;
   } else {
       echo "Gagal upload gambar";
   }


   $data_add->save();

   return redirect('/prodi_kinerja_dosen_buku_berisbn')->with('success', 'Data Data Buku ber-ISBN, Book Chapter Baru Berhasil Ditambahkan');
}


public function kinerja_dosen_buku_berisbn_update(Request $request, $id)
{

  $data_update = LuaranPenelitianDtpsBagian4::where('id', $id)->first();


  $input = [
   'luaran_penelitian_pkm' => $request->luaran_penelitian_pkm,
   'tahun' => $request->tahun,
   'keterangan' => $request->keterangan,
   'link_bukti_dokumen' => $request->link_bukti_dokumen,
];

if ($file = $request->file('file_bukti_dokumen')) {
   if ($data_update->file_bukti_dokumen) {
    File::delete('uploads/kinerja_dosen/luaranpenelitian_dtps_bagian4/' . $data_update->file_bukti_dokumen);
    }
    $nama_file = $file->getClientOriginalName();
    $path = $file->store('public/uploads/kinerja_dosen/luaranpenelitian_dtps_bagian4');
    $file->move(public_path() . '/uploads/kinerja_dosen/luaranpenelitian_dtps_bagian4/', $nama_file);
    $input['file_bukti_dokumen'] = $nama_file;
    $input['path'] = $path;
    }


$data_update->update($input);

 return redirect('/prodi_kinerja_dosen_buku_berisbn')->with('success', 'Data Data Buku ber-ISBN, Book Chapter Berhasil Diupdate');
}


public function kinerja_dosen_buku_berisbn_delete($id)
{
  $delete = LuaranPenelitianDtpsBagian4::findOrFail($id);
  $delete->delete();

 return redirect('/prodi_kinerja_dosen_buku_berisbn')->with('success', 'Data Data Buku ber-ISBN, Book Chapter Berhasil Dihapus');

}

}
