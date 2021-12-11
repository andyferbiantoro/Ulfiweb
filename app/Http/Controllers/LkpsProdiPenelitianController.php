<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PenelitianDtpsMahasiswa;
use App\Dosen;
use Auth;
use DB;
use File;
use Illuminate\Support\Facades\Storage;

class LkpsProdiPenelitianController extends Controller
{
    public function penelitian_dtps_yang_melibatkan_mahasiswa()
    {
         $dosen = Dosen::where('id_prodi', Auth::user()->id_prodi)->get();
          $penelitian_dtps_mahasiswa = DB::table('penelitian_dtps_mahasiswa')
           ->join('dosen', 'penelitian_dtps_mahasiswa.id_dosen', '=', 'dosen.id')
           ->select('penelitian_dtps_mahasiswa.*', 'dosen.nama_dosen')
           ->orderBy('id', 'DESC')
           ->where('penelitian_dtps_mahasiswa.id_user', Auth::user()->id)
           ->get();

        return view('lkps-prodi.penelitian-dtps-yang-melibatkan-mahasiswa.index',compact('dosen','penelitian_dtps_mahasiswa'));
    }

    public function penelitian_dtps_yang_melibatkan_mahasiswa_add(Request $request)
    {

       $data_add = new PenelitianDtpsMahasiswa();

       $data_add->tema_penelitian = $request->input('tema_penelitian');
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
           $path = $file->store('public/uploads/penelitian_dtps_mahasiswa');
           $file->move('uploads/penelitian_dtps_mahasiswa/', $filename);
           $data_add->file_bukti_dokumen = $filename;
           $data_add->path = $path;
       } else {
           echo "Gagal upload gambar";
       }


       $data_add->save();

       return redirect('/prodi_penelitian_dtps_yang_melibatkan_mahasiswa')->with('success', 'Data penelitian Dtps yang Melibatkan Mahasiswa Baru Berhasil Ditambahkan');
   }

   public function penelitian_dtps_yang_melibatkan_mahasiswa_update(Request $request, $id)
   {

      $data_update = PenelitianDtpsMahasiswa::where('id', $id)->first();


      $input = [
       'tema_penelitian' => $request->tema_penelitian,
       'nama_mahasiswa' => $request->nama_mahasiswa,
       'judul_kegiatan' => $request->judul_kegiatan,
       'tahun' => $request->tahun,
       'file_bukti_dokumen' => $request->file_bukti_dokumen,
       'link_bukti_dokumen' => $request->link_bukti_dokumen,
   ];

   if ($file = $request->file('file_bukti_dokumen')) {
       if ($data_update->file_bukti_dokumen) {
        File::delete('uploads/penelitian_dtps_mahasiswa/' . $data_update->file_bukti_dokumen);
    }
    $nama_file = $file->getClientOriginalName();
    $path = $file->store('public/uploads/penelitian_dtps_mahasiswa');
    $file->move(public_path() . '/uploads/penelitian_dtps_mahasiswa/', $nama_file);
    $input['file_bukti_dokumen'] = $nama_file;
    $input['path'] = $path;
}


$data_update->update($input);

 return redirect('/prodi_penelitian_dtps_yang_melibatkan_mahasiswa')->with('success', 'Data penelitian Dtps yang Melibatkan Mahasiswa Berhasil Diupdate');
}


public function file_download_dokumen_penelitian_mhs($id)
{

  $download = PenelitianDtpsMahasiswa::find($id);

  return  Storage::download($download->path, $download->file_bukti_dokumen);
}

public function penelitian_dtps_yang_melibatkan_mahasiswa_delete($id)
{
  $delete = PenelitianDtpsMahasiswa::findOrFail($id);
  $delete->delete();

 return redirect('/prodi_penelitian_dtps_yang_melibatkan_mahasiswa')->with('success', 'Data penelitian Dtps yang Melibatkan Mahasiswa Berhasil Dihapus');
}
}
