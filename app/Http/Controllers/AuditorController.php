<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pengumuman;
use App\User;
use App\HasilPenilaianLkps;
use Auth;
use File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuditorController extends Controller
{
    //

    public function index(){
     	$data_pengumuman = Pengumuman::orderBy('id','DESC')->take(1)->get();

    	 return view('auditor.index',compact('data_pengumuman'));
    }


     public function auditor_profil(){
        $data_profil = User::where('id',Auth::user()->id)->get();

    	 return view('auditor.profil-auditor',compact('data_profil'));
    }



    public function proses_edit_profil(Request $request){

         $messages = [
        'required' => ':attribute wajib diisi',
        'min' => ':attribute harus diisi minimal :min karakter ',
        'max' => ':attribute harus diisi maksimal :max karakter',
        'same' => ':attribute harus sama dengan re password',
        ];
 
            //validasi
        $this->validate($request, [
            //pasword validasinya repassword
            'password' => 'min:8|required_with:repassword|same:repassword',
            'repassword' => 'min:8'
        ], $messages);


         $profil = User::where('id', Auth::user()->id);

            $input =([
            'username' => $request->username,
            'password' => Hash::make($request['password']),
            
        ]);
            
        $profil->update($input);
        
           if ($profil) {
               return redirect()->back()->with('success', 'Profil Berhasil Diupdate');
           }else{
              return redirect()->back()->with('failes', 'Profil Gagal Diupdate');
           }

    }




     public function pengumuman(){

     		$data_pengumuman = Pengumuman::orderBy('id','DESC')->get();


    	 return view('auditor.pengumuman-auditor',compact('data_pengumuman'));
    }


    public function lihat_pengumuman($id){
        $data_pengumuman = Pengumuman::where('id',$id)->get();

        return view('auditor.lihat-pengumuman-auditor',compact('data_pengumuman'));

    }


    public function hasil_penilaian_lkps(){
            $hasil_penilaian_lkps = HasilPenilaianLkps::orderBy('id','DESC')->get();

         return view('auditor.hasil_penilaian_lkps',compact('hasil_penilaian_lkps'));
    }


    public function file_download($id){
            $download = HasilPenilaianLkps::find($id);
          
         return  Storage::download($download->path, $download->lampiran_file);
    }



    public function tambah_hasil_penilaian_lkps(Request $request){
        
        $tambah_hasil_lkps = new HasilPenilaianLkps();

        $tambah_hasil_lkps->id_user = $request->input('id_user');
        $tambah_hasil_lkps->tanggal = $request->input('tanggal');
        $tambah_hasil_lkps->keterangan = $request->input('keterangan');
        $tambah_hasil_lkps->lampiran_link = $request->input('lampiran_link');
        $tambah_hasil_lkps->keterangan = $request->input('keterangan');

          if($request->hasFile('lampiran_file')){
                $file = $request->file('lampiran_file');
                $extension = $file->getClientOriginalExtension();
                $filename = $file->getClientOriginalName();
                $path = $file->store('public/uploads/hasil_penilaian_lkps');
                $file->move('uploads/hasil_penilaian_lkps/', $filename);
                $tambah_hasil_lkps->lampiran_file = $filename;
                $tambah_hasil_lkps->path = $path;
                
            }else{
                echo "Gagal upload gambar";
            }

           
        $tambah_hasil_lkps->save();
       
        return redirect('/auditor-hasil_penilaian_lkps')->with('success', 'Hasil Penilaian LKPS Baru Berhasil Ditambahkan');
    }


    public function edit_penilaian_lkps($id){
        $data_penilaian = HasilPenilaianLkps::where('id',$id)->get();

        return view('auditor.edit-hasil-penilaian-lkps',compact('data_penilaian'));

    }


    public function proses_edit_file_penilaian(Request $request ,$id){

        $lampiran_file = HasilPenilaianLkps::find($id);
            //menghapus foto yang sebelumnya sesuai dengan yang ada dalam databas untuk di ganti dengan foto baru.

            File::delete('uploads/hasil_penilaian_lkps/'.$lampiran_file->lampiran_file);
            $lampiran_file->delete();  
        
       //fungsi untuk menguopload foto batu
        if($request->hasFile('lampiran_file')){
                $file = $request->file('lampiran_file');
                $extension = $file->getClientOriginalExtension();
                $name = $file->getClientOriginalName();
                $filename = $file->getClientOriginalName();
                $path = $file->store('public/uploads/hasil_penilaian_lkps');
                $file->move('uploads/hasil_penilaian_lkps/', $filename);
                $lampiran_file->lampiran_file = $filename;
                $lampiran_file->path = $path;
            }else{
                echo "Gagal edit lampiran_file";
            }

            $lampiran_file->save();

         //alert()->success('Berhasil','Update Fotoprofil');
         return redirect()->back()->with('success', 'Anda Berhasil Edit Hasil Penilaian LKPS');
    }



    public function proses_edit_penilaian_lkps(Request $request,$id){

         $hasil_penilaian_lkps = HasilPenilaianLkps::where('id', $id);

            $input =([
            'tanggal' => $request->tanggal,
            'keterangan' => $request->keterangan,
            'lampiran_link' => $request->lampiran_link,
            
        ]);
            
        $hasil_penilaian_lkps->update($input);
       
          return redirect('/auditor-hasil_penilaian_lkps')->with('success', 'Anda Berhasil Edit Hasil Penilaian LKPS');

    }


     public function hapus_penilaian($id){
       
         $hasil_penilaian_lkps = HasilPenilaianLkps::findOrFail($id);
         File::delete('uploads/hasil_penilaian_lkps/'.$hasil_penilaian_lkps->lampiran_file);
         $hasil_penilaian_lkps->delete();
        
         return redirect()->back();

    }
}
