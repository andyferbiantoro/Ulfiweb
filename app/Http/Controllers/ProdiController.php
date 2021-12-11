<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pengumuman;
use App\PerjanjianKinerja;
use App\User;
use Auth;
use App\HasilPenilaianLkps;
use File;
use DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;




class ProdiController extends Controller
{
    //
    public function index(){
     	$data_pengumuman = Pengumuman::orderBy('id','DESC')->take(1)->get();

    	 return view('prodi.index',compact('data_pengumuman'));
    }


     public function prodi_profil(){
        $data_profil = User::where('id',Auth::user()->id)->get();

    	 return view('prodi.profil-prodi',compact('data_profil'));
    }

     public function file_penilaian_download($id){
            $download = HasilPenilaianLkps::find($id);
          
         return  Storage::download($download->path, $download->lampiran_file);
    }


    public function get_edit_pengumuman($id){
     	$data_pengumuman = Pengumuman::where('id',$id)->get();

    	return view('prodi.edit-pengumuman-prodi',compact('data_pengumuman'));

   	}


    public function lihat_pengumuman($id){
        $data_pengumuman = Pengumuman::where('id',$id)->get();

        return view('prodi.lihat-pengumuman-prodi',compact('data_pengumuman'));

    }

     public function pengumuman(){

     		
            $data_pengumuman = DB::table('pengumuman')
                ->join('users', 'pengumuman.id_user', '=', 'users.id')
                ->select('pengumuman.*','users.role')
                ->orderBy('pengumuman.id','DESC')
                ->get();

    	 return view('prodi.pengumuman-prodi',compact('data_pengumuman'));
    }


    //digunakan untuk menambahkan pengumuman
     public function tambah_pengumuman(Request $request){
    	$Tambah_pengumuman = new Pengumuman();

        $Tambah_pengumuman->id_user = $request->input('id_user');
        $Tambah_pengumuman->judul = $request->input('judul');
        $Tambah_pengumuman->keterangan = $request->input('keterangan');

          if($request->hasFile('gambar')){
                $file = $request->file('gambar');
                $extension = $file->getClientOriginalExtension();
                $filename = 'pengumuman_'.time().'.'.$extension;
                $file->move('uploads/pengumuman/', $filename);
                $Tambah_pengumuman->gambar = $filename;
              
            }else{
                echo "Gagal upload gambar";
            }

           
	   	$Tambah_pengumuman->save();
       
        return redirect('/prodi-pengumuman')->with('success', 'Pengumuman Berhasil Ditambahkan');

    }



    public function proses_edit_pengumuman(Request $request,$id){

     	 $pengumuman = Pengumuman::where('id', $id);

            $input =([
            'judul' => $request->judul,
            'keterangan' => $request->keterangan,
            
           
        ]);
            
        $pengumuman->update($input);
       
          return redirect('/prodi-pengumuman')->with('success', 'Pengumuman Berhasil Diperbarui');

    }


     public function edit_gambar(Request $request ,$id){

        $gambar = Pengumuman::find($id);
            //menghapus foto yang sebelumnya sesuai dengan yang ada dalam databas untuk di ganti dengan foto baru.

            File::delete('uploads/pengumuman/'.$gambar->gambar);
            $gambar->delete();  
        
       //fungsi untuk menguopload foto batu
        if($request->hasFile('gambar')){
                $file = $request->file('gambar');
                $extension = $file->getClientOriginalExtension();
                $filename = 'pengumuman_'.time().'.'.$extension;
                $file->move('uploads/pengumuman/', $filename);
                $gambar->gambar = $filename;
              
            }else{
                echo "Gagal edit gambar";
            }

            $gambar->save();

         //alert()->success('Berhasil','Update Fotoprofil');
         return redirect()->back()->with('success', 'Pengumuman Berhasil Diperbarui');
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


     public function hapus_pengumuman($id){
       
         $Pengumuman = Pengumuman::findOrFail($id);
         File::delete('uploads/pengumuman/'.$Pengumuman->gambar);
         $Pengumuman->delete();
        
         return redirect()->back()->with('success', 'Pengumuman Berhasil Dihapus');

    }

    public function hapus_perjanjian($id){
       
         $Perjanjian = PerjanjianKinerja::findOrFail($id);
         File::delete('uploads/perjanjian_kinerja/'.$Perjanjian->file_bukti_lampiran);
         $Perjanjian->delete();
        
         return redirect()->back()->with('success', 'Perjanjian Berhasil Dihapus');

    }


    public function hasil_penilaian_lkps(){
            $hasil_penilaian_lkps = HasilPenilaianLkps::orderBy('id','DESC')->get();

         return view('prodi.hasil_penilaian_lkps',compact('hasil_penilaian_lkps'));
    }



    public function perjanjian_kinerja(){
        
        $perjanjian_kinerja = PerjanjianKinerja::orderBy('id','DESC')->get();

         return view('prodi.perjanjian-kinerja',compact('perjanjian_kinerja'));
    }


    public function file_perjanjian_download($id){
            $download = PerjanjianKinerja::find($id);
          
         return  Storage::download($download->path, $download->lampiran_file);
    }

    //digunakan untuk menambahkan perjanjian
     public function tambah_perjanjian(Request $request){
        
        $tambah_perjanjian = new PerjanjianKinerja();

        $tambah_perjanjian->sasaran_kegiatan = $request->input('sasaran_kegiatan');
        $tambah_perjanjian->indikator_kinerja_kegiatan = $request->input('indikator_kinerja_kegiatan');
        $tambah_perjanjian->satuan = $request->input('satuan');
        $tambah_perjanjian->target = $request->input('target');
        $tambah_perjanjian->realisasi_triwulan1 = $request->input('realisasi_triwulan1');
        $tambah_perjanjian->realisasi_triwulan2 = $request->input('realisasi_triwulan2');
        $tambah_perjanjian->realisasi_triwulan3 = $request->input('realisasi_triwulan3');
        $tambah_perjanjian->akhir_tahun = $request->input('akhir_tahun');
        $tambah_perjanjian->link_bukti_lampiran = $request->input('link_bukti_lampiran');
        $tambah_perjanjian->id_user = $request->input('id_user');

        

          if($request->hasFile('file_bukti_lampiran')){
                $file = $request->file('file_bukti_lampiran');
                $extension = $file->getClientOriginalExtension();
                $filename = $file->getClientOriginalName();
                $path = $file->store('public/uploads/perjanjian_kinerja');
                $file->move('uploads/perjanjian_kinerja/', $filename);
                $tambah_perjanjian->file_bukti_lampiran = $filename;
                $tambah_perjanjian->path = $path;
                
            }else{
                echo "Gagal upload perjanjian";
            }

           
        $tambah_perjanjian->save();
       
        return redirect('/prodi-perjanjian_kinerja')->with('success', 'Perjanjian Baru Berhasil Ditambahkan');
    }


    public function edit_perjanjian_kinerja($id){

            $data_perjanjian = PerjanjianKinerja::where('id',$id)->get();


         return view('prodi.edit-perjanjian-kinerja',compact('data_perjanjian'));
    } 

    public function edit_file_perjanjian(Request $request ,$id){

        $file_bukti_lampiran = PerjanjianKinerja::find($id);
            //menghapus foto yang sebelumnya sesuai dengan yang ada dalam databas untuk di ganti dengan foto baru.

            File::delete('uploads/perjanjian_kinerja/'.$file_bukti_lampiran->file_bukti_lampiran);
            $file_bukti_lampiran->delete();  
        
       //fungsi untuk menguopload foto batu
        if($request->hasFile('file_bukti_lampiran')){
                $file = $request->file('file_bukti_lampiran');
                $extension = $file->getClientOriginalExtension();
                $filename = $file->getClientOriginalName();
                $file->move('uploads/perjanjian_kinerja/', $filename);
                $file_bukti_lampiran->file_bukti_lampiran = $filename;
              
            }else{
                echo "Gagal edit file_bukti_lampiran";
            }

            $file_bukti_lampiran->save();

         //alert()->success('Berhasil','Update Fotoprofil');
         return redirect()->back()->with('success', 'File Perjanjian Kinerja Berhasil Diperbarui');
    }



    public function proses_edit_perjanjian_kinerja(Request $request,$id){

         $perjanjian_kinerja = PerjanjianKinerja::where('id', $id);

            $input =([
            'sasaran_kegiatan' => $request->sasaran_kegiatan,
            'indikator_kinerja_kegiatan' => $request->indikator_kinerja_kegiatan,
            'satuan' => $request->satuan,
            'target' => $request->target,
            'realisasi_triwulan1' => $request->realisasi_triwulan1,
            'realisasi_triwulan2' => $request->realisasi_triwulan2,
            'realisasi_triwulan3' => $request->realisasi_triwulan3,
            'akhir_tahun' => $request->akhir_tahun,
            'link_bukti_lampiran' => $request->link_bukti_lampiran,
            'id_user' => $request->id_user,
            
           
        ]);
            
        $perjanjian_kinerja->update($input);
       
          return redirect('/prodi-perjanjian_kinerja')->with('success', 'Perjanjian Berhasil Diperbarui');

    }

   

}
