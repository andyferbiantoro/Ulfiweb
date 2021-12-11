<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PkmDtpsMahasiswa;
use App\Dosen;
use Auth;
use DB;
use File;
use Illuminate\Support\Facades\Storage;

class LkpsProdiPengabdianKepadaMasyarakatController extends Controller
{
    public function pkm_dtps_yang_melibatkan_mahasiswa()
    {   
         $dosen = Dosen::where('id_prodi', Auth::user()->id_prodi)->get();
          $pkm_dtps_mahasiswa = DB::table('pkm_dtps_mahasiswa')
           ->join('dosen', 'pkm_dtps_mahasiswa.id_dosen', '=', 'dosen.id')
           ->select('pkm_dtps_mahasiswa.*', 'dosen.nama_dosen')
           ->orderBy('id', 'DESC')
           ->where('pkm_dtps_mahasiswa.id_user', Auth::user()->id)
           ->get();

        return view('lkps-prodi.pengabdian-kepada-masyarakat-dtps-yang-melibatkan-mhs.index',compact('pkm_dtps_mahasiswa','dosen'));
    }


    public function pkm_dtps_yang_melibatkan_mahasiswa_add(Request $request)
    {

       $data_add = new PkmDtpsMahasiswa();

       $data_add->tema_pkm = $request->input('tema_pkm');
       $data_add->nama_mahasiswa = $request->input('nama_mahasiswa');
       $data_add->judul_kegiatan = $request->input('judul_kegiatan');
       $data_add->tahun = $request->input('tahun');
       $data_add->file_bukti_dokumen = $request->input('file_bukti_dokumen');
       $data_add->link_bukti_dokumen = $request->input('link_bukti_dokumen');
       $data_add->id_dosen = $request->input('id_dosen');
       $data_add->id_user = $request->input('id_user');
       $data_add->id_prodi = Auth::user()->id_prodi;
       $data_add->status = '0';



       if ($request->hasFile('file_bukti_dokumen')) {
           $file = $request->file('file_bukti_dokumen');
           $extension = $file->getClientOriginalExtension();
           $filename = $file->getClientOriginalName();
           $path = $file->store('public/uploads/pkm_dtps_mahasiswa');
           $file->move('uploads/pkm_dtps_mahasiswa/', $filename);
           $data_add->file_bukti_dokumen = $filename;
           $data_add->path = $path;
       } else {
           echo "Gagal upload gambar";
       }


       $data_add->save();

       return redirect('/prodi_pkm_dtps_yang_melibatkan_mahasiswa')->with('success', 'Data pkm Dtps yang Melibatkan Mahasiswa Baru Berhasil Ditambahkan');
   }

   public function pkm_dtps_yang_melibatkan_mahasiswa_update(Request $request, $id)
   {

      $data_update = PkmDtpsMahasiswa::where('id', $id)->first();


      $input = [
       'tema_pkm' => $request->tema_pkm,
       'nama_mahasiswa' => $request->nama_mahasiswa,
       'judul_kegiatan' => $request->judul_kegiatan,
       'tahun' => $request->tahun,
       'file_bukti_dokumen' => $request->file_bukti_dokumen,
       'link_bukti_dokumen' => $request->link_bukti_dokumen,
   ];

   if ($file = $request->file('file_bukti_dokumen')) {
       if ($data_update->file_bukti_dokumen) {
        File::delete('uploads/pkm_dtps_mahasiswa/' . $data_update->file_bukti_dokumen);
    }
    $nama_file = $file->getClientOriginalName();
    $path = $file->store('public/uploads/pkm_dtps_mahasiswa');
    $file->move(public_path() . '/uploads/pkm_dtps_mahasiswa/', $nama_file);
    $input['file_bukti_dokumen'] = $nama_file;
    $input['path'] = $path;
}


$data_update->update($input);

 return redirect('/prodi_pkm_dtps_yang_melibatkan_mahasiswa')->with('success', 'Data pkm Dtps yang Melibatkan Mahasiswa Berhasil Diupdate');
}


public function file_download_dokumen_pkm_mhs($id)
{

  $download = PkmDtpsMahasiswa::find($id);

  return  Storage::download($download->path, $download->file_bukti_dokumen);
}

public function pkm_dtps_yang_melibatkan_mahasiswa_delete($id)
{
  $delete = pkmDtpsMahasiswa::findOrFail($id);
  $delete->delete();

 return redirect('/prodi_pkm_dtps_yang_melibatkan_mahasiswa')->with('success', 'Data pkm Dtps yang Melibatkan Mahasiswa Berhasil Dihapus');
}
}
