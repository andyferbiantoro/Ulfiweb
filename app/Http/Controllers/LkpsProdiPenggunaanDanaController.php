<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PenggunaanDana;
use Auth;
use DB;
use File;
use Illuminate\Support\Facades\Storage;

class LkpsProdiPenggunaanDanaController extends Controller
{

    public function penggunaan_dana()
    {

        $data_penggunaan_dana = PenggunaanDana::where('id_user', Auth::user()->id)->get();

        foreach ($data_penggunaan_dana as $key => $value) {
            $rata2_upps = ($value->upps_ts2 + $value->upps_ts1 + $value->upps_ts)/3;
            $rata2_prodi = ($value->prodi_ts2 + $value->prodi_ts1 + $value->prodi_ts)/3;


            $value->rata2_upps = round($rata2_upps, 2);
            $value->rata2_prodi = round($rata2_prodi, 2);
        }

        return view('lkps-prodi.penggunaan-dana.index',compact('data_penggunaan_dana'));
    }


    public function penggunaan_dana_add(Request $request)
    {

       $data_add = new PenggunaanDana();

       $data_add->jenis_penggunaan = $request->input('jenis_penggunaan');
       $data_add->upps_ts2 = $request->input('upps_ts2');
       $data_add->upps_ts1 = $request->input('upps_ts1');
       $data_add->upps_ts = $request->input('upps_ts');
       $data_add->prodi_ts2 = $request->input('prodi_ts2');
       $data_add->prodi_ts1 = $request->input('prodi_ts1');
       $data_add->prodi_ts = $request->input('prodi_ts');
       $data_add->tahun_akademik = $request->input('tahun_akademik');
       $data_add->link_bukti_dokumen = $request->input('link_bukti_dokumen');
       $data_add->id_user = $request->input('id_user');
       $data_add->id_prodi = Auth::user()->id_prodi;
       $data_add->status = '0';



       if ($request->hasFile('file_bukti_dokumen')) {
           $file = $request->file('file_bukti_dokumen');
           $extension = $file->getClientOriginalExtension();
           $filename = $file->getClientOriginalName();
           $path = $file->store('public/uploads/penggunaan_dana');
           $file->move('uploads/penggunaan_dana/', $filename);
           $data_add->file_bukti_dokumen = $filename;
           $data_add->path = $path;
       } else {
           echo "Gagal upload gambar";
       }


       $data_add->save();

       return redirect('/prodi_penggunaan_dana')->with('success', 'Data Penggunaan Data Baru Berhasil Ditambahkan');
   }



   public function penggunaan_dana_update(Request $request, $id)
   {

      $data_update = PenggunaanDana::where('id', $id)->first();


      $input = [
       'jenis_penggunaan' => $request->jenis_penggunaan,
       'upps_ts2' => $request->upps_ts2,
       'upps_ts1' => $request->upps_ts1,
       'upps_ts' => $request->upps_ts,
       'prodi_ts2' => $request->prodi_ts2,
       'prodi_ts1' => $request->prodi_ts1,
       'prodi_ts' => $request->prodi_ts,
       'tahun_akademik' => $request->tahun_akademik,
       'link_bukti_dokumen' => $request->link_bukti_dokumen,
   ];

   if ($file = $request->file('file_bukti_dokumen')) {
       if ($data_update->file_bukti_dokumen) {
        File::delete('uploads/penggunaan_dana/' . $data_update->file_bukti_dokumen);
    }
    $nama_file = $file->getClientOriginalName();
    $path = $file->store('public/uploads/penggunaan_dana');
    $file->move(public_path() . '/uploads/penggunaan_dana/', $nama_file);
    $input['file_bukti_dokumen'] = $nama_file;
    $input['path'] = $path;
}


$data_update->update($input);

return redirect('/prodi_penggunaan_dana')->with('success', 'Data Penggunaan Data Berhasil Diupdate');
}


public function file_download_dokumen_penggunaan_dana($id)
{

  $download = PenggunaanDana::find($id);

  return  Storage::download($download->path, $download->file_bukti_dokumen);
}


public function lihat_penggunaan_dana()
{

    $data_penggunaan_dana = PenggunaanDana::where('id_user', Auth::user()->id)->get();

    foreach ($data_penggunaan_dana as $key => $value) {
        $rata2_upps = ($value->upps_ts2 + $value->upps_ts1 + $value->upps_ts)/3;
        $rata2_prodi = ($value->prodi_ts2 + $value->prodi_ts1 + $value->prodi_ts)/3;


        $value->rata2_upps = round($rata2_upps, 2);
        $value->rata2_prodi = round($rata2_prodi, 2);
    }
    return view('lkps-prodi.penggunaan-dana.lihat_laporan', compact('data_penggunaan_dana'));
}

public function penggunaan_dana_delete($id)
{
  $delete = PenggunaanDana::findOrFail($id);
  $delete->delete();

return redirect('/prodi_penggunaan_dana')->with('success', 'Data Penggunaan Data Berhasil Dihapus');
}
}
