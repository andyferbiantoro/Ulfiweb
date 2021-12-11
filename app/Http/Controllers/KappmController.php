<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Pengumuman;
use App\PerjanjianKinerja;
use App\DataLkps;
use App\DaftarProdiDiupps;
use App\KerjasamaTridharmaPendidikan;
use App\KerjasamaTridharmaPenelitian;
use App\KerjasamaTridharmaPkm;
use App\SeleksiMahasiswaBaru;
use App\MahasiswaAsing;
use App\Prodi;
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
use App\KurikulumPembelajaran;
use App\IntegrasiKegiatanPembelajaran;
use App\KepuasanMahasiswa;
use App\PenelitianDtpsMahasiswa;
use App\PkmDtpsMahasiswa;
use App\PenggunaanDana;
use App\DosenTetapPerguruanTinggi;
use App\DosenUtamaTugasAkhir;
use App\EwmpDosenTetapPerguruanTinggi;
use App\DosenTidakTetap;
use App\DosenIndustri;
use App\BatasWaktuLkps;
use App\HasilPenilaianLkps;
use App\PenunjukanAuditor;

use Auth;
use App\User;
use File;
use DB;
use Illuminate\Support\Facades\Storage;


class KappmController extends Controller
{
    //
    public function index()
    {
        $data_pengumuman = Pengumuman::orderBy('id', 'DESC')->take(1)->get();

        return view('kappm.index', compact('data_pengumuman'));
    }


    public function kappm_profil()
    {
        $data_user = User::where('role', 'prodi')->orWhere('role', 'auditor')->get();

        return view('kappm.profil-kappm', compact('data_user'));
    }

    public function file_penilaian_download($id)
    {
        $download = HasilPenilaianLkps::find($id);

        return  Storage::download($download->path, $download->lampiran_file);
    }



    public function get_edit_pengumuman($id)
    {
        $data_pengumuman = Pengumuman::where('id', $id)->get();

        return view('kappm.edit-pengumuman-kappm', compact('data_pengumuman'));
    }

    public function edit_akun($id)
    {
        $data_akun = User::where('id', $id)->get();

        return view('kappm.edit-akun-kappm', compact('data_akun'));
    }


    public function proses_edit_akun(Request $request, $id)
    {

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


        $akun = User::where('id', $id);

        $input = ([
            'username' => $request->username,
            'password' => Hash::make($request['password']),

        ]);

        $akun->update($input);

        if ($akun) {
            return redirect()->back()->with('success', 'Akun Berhasil Diupdate');
        } else {
            return redirect()->back()->with('failes', 'Akun Gagal Diupdate');
        }
    }



    public function lihat_pengumuman($id)
    {
        $data_pengumuman = Pengumuman::where('id', $id)->get();

        return view('kappm.lihat-pengumuman-kappm', compact('data_pengumuman'));
    }


    public function edit_gambar(Request $request, $id)
    {

        $gambar = Pengumuman::find($id);
        //menghapus foto yang sebelumnya sesuai dengan yang ada dalam databas untuk di ganti dengan foto baru.

        File::delete('uploads/pengumuman/' . $gambar->gambar);
        $gambar->delete();

        //fungsi untuk menguopload foto batu
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $extension = $file->getClientOriginalExtension();
            $filename = 'pengumuman_' . time() . '.' . $extension;
            $file->move('uploads/pengumuman/', $filename);
            $gambar->gambar = $filename;
        } else {
            echo "Gagal edit gambar";
        }

        $gambar->save();

        //alert()->success('Berhasil','Update Fotoprofil');
        return redirect()->back()->with('success', 'Pengumuman Berhasil Diperbarui');
    }


    public function pengumuman()
    {

        $data_pengumuman = DB::table('pengumuman')
        ->join('users', 'pengumuman.id_user', '=', 'users.id')
        ->select('pengumuman.*', 'users.role')
        ->orderBy('pengumuman.id', 'DESC')
        ->get();


        return view('kappm.pengumuman-kappm', compact('data_pengumuman'));
    }


    //digunakan untuk menambahkan pengumuman
    public function tambah_pengumuman(Request $request)
    {
        $Tambah_pengumuman = new Pengumuman();

        $Tambah_pengumuman->id_user = $request->input('id_user');
        $Tambah_pengumuman->judul = $request->input('judul');
        $Tambah_pengumuman->keterangan = $request->input('keterangan');

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $extension = $file->getClientOriginalExtension();
            $filename = 'pengumuman_' . time() . '.' . $extension;
            $file->move('uploads/pengumuman/', $filename);
            $Tambah_pengumuman->gambar = $filename;
        } else {
            echo "Gagal upload gambar";
        }


        $Tambah_pengumuman->save();

        return redirect('/kappm-pengumuman')->with('success', 'Pengumuman Berhasil Ditambahkan');
    }



    public function edit_pengumuman(Request $request, $id)
    {

        $pengumuman = Pengumuman::where('id', $id);

        $input = ([
            'judul' => $request->judul,
            'keterangan' => $request->keterangan,


        ]);

        $pengumuman->update($input);

        return redirect('/kappm-pengumuman')->with('success', 'Pengumuman Berhasil Diperbarui');
    }


    public function hapus_pengumuman($id)
    {

        $Pengumuman = Pengumuman::findOrFail($id);
        File::delete('uploads/pengumuman/' . $Pengumuman->gambar);
        $Pengumuman->delete();

        return redirect()->back()->with('success', 'Pengumuman Berhasil Dihapus');
    }


    public function tambah_akun(Request $request)
    {
        User::create([

            'username' => $request['username'],
            'role' => $request['role'],
            'password' => Hash::make($request['password']),

        ]);

        return redirect('/kappm-profil')->with('success', 'Akun Berhasil Ditambahkan');
    }



    public function hapus_user($id)
    {

        $User = User::findOrFail($id);

        $User->delete();

        return redirect()->back();
    }



    public function hasil_penilaian_lkps()
    {
        $hasil_penilaian_lkps = HasilPenilaianLkps::orderBy('id', 'DESC')->get();

        return view('kappm.hasil_penilaian_lkps', compact('hasil_penilaian_lkps'));
    }


    public function perjanjian_kinerja()
    {

        $perjanjian_kinerja = PerjanjianKinerja::orderBy('id', 'DESC')->get();

        return view('kappm.perjanjian-kinerja', compact('perjanjian_kinerja'));
    }

    public function file_perjanjian_download($id)
    {
        $download = PerjanjianKinerja::find($id);

        return  Storage::download($download->path, $download->lampiran_file);
    }




    // =======================================================LKPS================================================================

    public function data_lkps()
    {


        return view('lkps.data-lkps.index');
    }

    public function batas_waktu(Request $request)
    {
         $prodi = Prodi::all();

         if ($request->filter_prodi == Null) {
          $request->filter_prodi= "";
      }

      $prod = $request->filter_prodi;

         $data_batas_waktu = DB::table('batas_waktu_lkps')
        ->join('prodi', 'batas_waktu_lkps.id_prodi', '=', 'prodi.id')
        ->select('batas_waktu_lkps.*','prodi.nama_prodi')
        ->orderBy('batas_waktu_lkps.id', 'DESC')
        ->get();

        return view('kappm.penjadwalan.batas-waktu',compact('prodi','data_batas_waktu','prod'));
    }


    public function batas_waktu_add(Request $request)
    {
        $add_data = new BatasWaktuLkps();

        $add_data->id_prodi = $request->input('id_prodi');
        $add_data->tanggal_awal = $request->input('tanggal_awal');
        $add_data->tanggal_akhir = $request->input('tanggal_akhir');
        $add_data->tahun = $request->input('tahun');
        $add_data->status = 1;



        $add_data->save();

        return redirect('/kappm-batas_waktu_lkps')->with('success', 'Batas waktu Berhasil Ditambahkan');
    }



    public function batas_waktu_update(Request $request, $id)
    {

      $data_update = BatasWaktuLkps::where('id', $id)->first();


      $input = [
         'id_prodi' => $request->id_prodi,
         'tanggal_awal' => $request->tanggal_awal,
         'tanggal_akhir' => $request->tanggal_akhir,
         'tahun' => $request->tahun,
     ];

    $data_update->update($input);

    return redirect('/kappm-batas_waktu_lkps')->with('success', 'Batas waktu Berhasil Diupdate');
}


public function batas_waktu_delete($id)
{
  $delete = BatasWaktuLkps::findOrFail($id);
  $delete->delete();

 return redirect('/kappm-batas_waktu_lkps')->with('success', 'Batas waktu Berhasil Dihapus');
}




public function penunjukan_auditor()
{
    $auditor = User::where('role','auditor')->get();
    $auditor2 = User::where('role','auditor')->get();

    $prodi = Prodi::all();

    $data_penunjukan = DB::table('penunjukan_auditor')
    ->join('users', 'penunjukan_auditor.id_user_auditor1', '=', 'users.id')
         //->join('users', 'penunjukan_auditor.id_user_auditor2', '=', 'users.id')
    ->join('prodi', 'penunjukan_auditor.id_prodi', '=', 'prodi.id')
    ->select('penunjukan_auditor.*', 'users.username','prodi.nama_prodi')
    ->orderBy('penunjukan_auditor.id', 'DESC')
    ->get();

    return view('kappm.penjadwalan.penunjukan-auditor',compact('data_penunjukan','auditor','auditor2','prodi'));
}





    
public function proses_penunjukan_auditor(Request $request)
{   
   $data = ([
      'id_user_auditor1' => $request->id_user_auditor1,
      'id_user_auditor2' => $request->id_user_auditor2,
      'id_prodi'  =>$request->id_prodi,
      'tahun'  =>$request->tahun,
  ]);

   $lastid = PenunjukanAuditor::create($data)->id;

   $input = [
    'id_penunjukan' =>$lastid,    
    'status' => '2', 
];



$data_update1 = DataLkps::where('id_prodi', $request->id_prodi)->where('tahun_akademik', $request->tahun_akademik)->first();
if ($data_update1 != Null) {
    $data_update1->update($input); 
}

$data_update2 = DaftarProdiDiupps::where('id_prodi', $request->id_prodi)->where('tahun', $request->tahun)->first();
if ($data_update2 != Null) {
    $data_update2->update($input); 
}
$data_update3 = KerjasamaTridharmaPendidikan::where('id_prodi', $request->id_prodi)->where('tahun_berakhir', $request->tahun_berakhir)->first();
if ($data_update3 != Null) {
    $data_update3->update($input); 
}   

$data_update4 = KerjasamaTridharmaPenelitian::where('id_prodi', $request->id_prodi)->where('tahun_berakhir', $request->tahun_berakhir)->first();
if ($data_update4 != Null) {
    $data_update4->update($input); 
}

$data_update5 = KerjasamaTridharmaPkm::where('id_prodi', $request->id_prodi)->where('tahun_berakhir', $request->tahun_berakhir)->first();
if ($data_update5 != Null) {
    $data_update5->update($input); 
}

$data_update6 = SeleksiMahasiswaBaru::where('id_prodi', $request->id_prodi)->where('tahun_akademik', $request->tahun_akademik)->first();
if ($data_update6 != Null) {
    $data_update6->update($input); 
}

$data_update7 = MahasiswaAsing::where('id_prodi', $request->id_prodi)->where('tahun_akademik', $request->tahun_akademik)->first();
if ($data_update7 != Null) {
    $data_update7->update($input); 
}

$data_update8 = DosenTetapPerguruanTinggi::where('id_prodi', $request->id_prodi)->where('tahun', $request->tahun)->first();
if ($data_update8 != Null) {
    $data_update8->update($input); 
}

$data_update9 = DosenUtamaTugasAkhir::where('id_prodi', $request->id_prodi)->where('tahun_akademik', $request->tahun_akademik)->first();
if ($data_update9 != Null) {
    $data_update9->update($input); 
}

$data_update10 = EwmpDosenTetapPerguruanTinggi::where('id_prodi', $request->id_prodi)->where('tahun', $request->tahun)->first();
if ($data_update10 != Null) {
    $data_update10->update($input); 
}

$data_update11 = DosenTidakTetap::where('id_prodi', $request->id_prodi)->where('tahun', $request->tahun)->first();
if ($data_update11 != Null) {
    $data_update11->update($input); 
}

$data_update12 = DosenIndustri::where('id_prodi', $request->id_prodi)->where('tahun', $request->tahun)->first();
if ($data_update12 != Null) {
    $data_update12->update($input); 
}

$data_update13 = PengakuanDtps::where('id_prodi', $request->id_prodi)->where('tahun', $request->tahun)->first();
if ($data_update13 != Null) {
    $data_update13->update($input); 
}

$data_update14 = PenelitianDtps::where('id_prodi', $request->id_prodi)->where('tahun_akademik', $request->tahun_akademik)->first();
if ($data_update14 != Null) {
    $data_update14->update($input); 
}

$data_update15 = PkmDtps::where('id_prodi', $request->id_prodi)->where('tahun_akademik', $request->tahun_akademik)->first();
if ($data_update15 != Null) {
    $data_update15->update($input); 
}

$data_update16 = PagelaranIlmiahDtps::where('id_prodi', $request->id_prodi)->where('tahun_akademik', $request->tahun_akademik)->first();
if ($data_update16 != Null) {
    $data_update16->update($input); 
}

$data_update17 = KaryaIlmiahDtps::where('id_prodi', $request->id_prodi)->where('tahun', $request->tahun)->first();
if ($data_update17 != Null) {
    $data_update17->update($input); 
}

$data_update18 = ProdukDtps::where('id_prodi', $request->id_prodi)->where('tahun', $request->tahun)->first();
if ($data_update18 != Null) {
    $data_update18->update($input); 
}

$data_update19 = LuaranPenelitianDtpsBagian1::where('id_prodi', $request->id_prodi)->where('tahun', $request->tahun)->first();
if ($data_update19 != Null) {
    $data_update19->update($input); 
}

$data_update20 = LuaranPenelitianDtpsBagian2::where('id_prodi', $request->id_prodi)->where('tahun', $request->tahun)->first();
if ($data_update20 != Null) {
    $data_update20->update($input); 
}

$data_update21 = LuaranPenelitianDtpsBagian3::where('id_prodi', $request->id_prodi)->where('tahun', $request->tahun)->first();
if ($data_update21 != Null) {
    $data_update21->update($input); 
}

$data_update22 = LuaranPenelitianDtpsBagian4::where('id_prodi', $request->id_prodi)->where('tahun', $request->tahun)->first();
if ($data_update22 != Null) {
    $data_update22->update($input); 
}

$data_update23 = PenggunaanDana::where('id_prodi', $request->id_prodi)->where('tahun_akademik', $request->tahun_akademik)->first();
if ($data_update23 != Null) {
    $data_update23->update($input); 
}

$data_update23 = KurikulumPembelajaran::where('id_prodi', $request->id_prodi)->where('tahun', $request->tahun)->first();
if ($data_update23 != Null) {
    $data_update23->update($input); 
}

$data_update24 = IntegrasiKegiatanPembelajaran::where('id_prodi', $request->id_prodi)->where('tahun', $request->tahun)->first();
if ($data_update24 != Null) {
    $data_update24->update($input); 
}

$data_update25 = KepuasanMahasiswa::where('id_prodi', $request->id_prodi)->where('tahun', $request->tahun)->first();
if ($data_update25 != Null) {
    $data_update25->update($input); 
}

$data_update26 = PenelitianDtpsMahasiswa::where('id_prodi', $request->id_prodi)->where('tahun', $request->tahun)->first();
if ($data_update26 != Null) {
    $data_update26->update($input); 
}

$data_update27 = PkmDtpsMahasiswa::where('id_prodi', $request->id_prodi)->where('tahun', $request->tahun)->first();
if ($data_update27 != Null) {
    $data_update27->update($input); 
}

$data_update28 = IpkLulusan::where('id_prodi', $request->id_prodi)->where('tahun_lulus', $request->tahun_lulus)->first();
if ($data_update28 != Null) {
    $data_update28->update($input); 
}

$data_update29 = PrestasiAkademikMahasiswa::where('id_prodi', $request->id_prodi)->where('tahun_perolehan', $request->tahun_perolehan)->first();
if ($data_update29 != Null) {
    $data_update29->update($input); 
}

$data_update30 = PrestasiNonAkademikMahasiswa::where('id_prodi', $request->id_prodi)->where('tahun_perolehan', $request->tahun_perolehan)->first();
if ($data_update30 != Null) {
    $data_update30->update($input); 
}

$data_update31 = MasaStudiLulusanD3::where('id_prodi', $request->id_prodi)->where('tahun_masuk', $request->tahun_masuk)->first();
if ($data_update31 != Null) {
    $data_update31->update($input); 
}

$data_update32 = MasaStudiLulusanSarjanaTerapan::where('id_prodi', $request->id_prodi)->where('tahun_masuk', $request->tahun_masuk)->first();
if ($data_update32 != Null) {
    $data_update32->update($input); 
}

$data_update33 = WaktuTungguLulusanD3::where('id_prodi', $request->id_prodi)->where('tahun_lulus', $request->tahun_lulus)->first();
if ($data_update33 != Null) {
    $data_update33->update($input); 
}

$data_update34 = WaktuTungguLulusanSarjanaTerapan::where('id_prodi', $request->id_prodi)->where('tahun_lulus', $request->tahun_lulus)->first();
if ($data_update34 != Null) {
    $data_update34->update($input); 
}

$data_update35 = KesesuaianBidangkerjaLulusan::where('id_prodi', $request->id_prodi)->where('tahun_lulus', $request->tahun_lulus)->first();
if ($data_update35 != Null) {
    $data_update35->update($input); 
}

$data_update36 = TempatKerjaLulusan::where('id_prodi', $request->id_prodi)->where('tahun_lulus', $request->tahun_lulus)->first();
if ($data_update36 != Null) {
    $data_update36->update($input); 
}

$data_update37 = ReferensiKepuasanPengguna::where('id_prodi', $request->id_prodi)->where('tahun_lulus', $request->tahun_lulus)->first();
if ($data_update37 != Null) {
    $data_update37->update($input); 
}

$data_update38 = KepuasanPenggunaLulusan::where('id_prodi', $request->id_prodi)->where('tahun', $request->tahun)->first();
if ($data_update38 != Null) {
    $data_update38->update($input); 
}

$data_update39 = PagelaranIlmiahMahasiswa::where('id_prodi', $request->id_prodi)->where('tahun_akademik', $request->tahun_akademik)->first();
if ($data_update39 != Null) {
    $data_update39->update($input); 
}

$data_update40 = ProdukMahasiswa::where('id_prodi', $request->id_prodi)->where('tahun', $request->tahun)->first();
if ($data_update11 != Null) {
    $data_update11->update($input); 
}

$data_update41 = LuaranPenelitianMahasiswaBagian1::where('id_prodi', $request->id_prodi)->where('tahun', $request->tahun)->first();
if ($data_update41 != Null) {
    $data_update41->update($input); 
}

$data_update42 = LuaranPenelitianMahasiswaBagian2::where('id_prodi', $request->id_prodi)->where('tahun', $request->tahun)->first();
if ($data_update42 != Null) {
    $data_update42->update($input); 
}

$data_update43 = LuaranPenelitianMahasiswaBagian3::where('id_prodi', $request->id_prodi)->where('tahun', $request->tahun)->first();
if ($data_update43 != Null) {
    $data_update43->update($input); 
}

$data_update44 = LuaranPenelitianMahasiswaBagian4::where('id_prodi', $request->id_prodi)->where('tahun', $request->tahun)->first();
if ($data_update44 != Null) {
    $data_update44->update($input); 
}

return redirect('/kappm-penunjukan_auditor')->with('success', 'Penunjukan Auditor Berhasil Ditambahkan');
}




public function batas_waktu_buka_akses(Request $request, $id_prodi)
    

    {  
      $input = [
        'status' => '0', 
    ];



$data_update1 = DataLkps::where('id_prodi', $id_prodi)->first();
if ($data_update1 != Null) {
    $data_update1->update($input); 
}

$data_update2 = DaftarProdiDiupps::where('id_prodi', $id_prodi)->first();
if ($data_update2 != Null) {
    $data_update2->update($input); 
}
$data_update3 = KerjasamaTridharmaPendidikan::where('id_prodi', $id_prodi)->first();
if ($data_update3 != Null) {
    $data_update3->update($input); 
}   

$data_update4 = KerjasamaTridharmaPenelitian::where('id_prodi', $id_prodi)->first();
if ($data_update4 != Null) {
    $data_update4->update($input); 
}

$data_update5 = KerjasamaTridharmaPkm::where('id_prodi', $id_prodi)->first();
if ($data_update5 != Null) {
    $data_update5->update($input); 
}

$data_update6 = SeleksiMahasiswaBaru::where('id_prodi', $id_prodi)->first();
if ($data_update6 != Null) {
    $data_update6->update($input); 
}

$data_update7 = MahasiswaAsing::where('id_prodi', $id_prodi)->first();
if ($data_update7 != Null) {
    $data_update7->update($input); 
}

$data_update8 = DosenTetapPerguruanTinggi::where('id_prodi', $id_prodi)->first();
if ($data_update8 != Null) {
    $data_update8->update($input); 
}

$data_update9 = DosenUtamaTugasAkhir::where('id_prodi', $id_prodi)->first();
if ($data_update9 != Null) {
    $data_update9->update($input); 
}

$data_update10 = EwmpDosenTetapPerguruanTinggi::where('id_prodi', $id_prodi)->first();
if ($data_update10 != Null) {
    $data_update10->update($input); 
}

$data_update11 = DosenTidakTetap::where('id_prodi', $id_prodi)->first();
if ($data_update11 != Null) {
    $data_update11->update($input); 
}

$data_update12 = DosenIndustri::where('id_prodi', $id_prodi)->first();
if ($data_update12 != Null) {
    $data_update12->update($input); 
}

$data_update13 = PengakuanDtps::where('id_prodi', $id_prodi)->first();
if ($data_update13 != Null) {
    $data_update13->update($input); 
}

$data_update14 = PenelitianDtps::where('id_prodi', $id_prodi)->first();
if ($data_update14 != Null) {
    $data_update14->update($input); 
}

$data_update15 = PkmDtps::where('id_prodi', $id_prodi)->first();
if ($data_update15 != Null) {
    $data_update15->update($input); 
}

$data_update16 = PagelaranIlmiahDtps::where('id_prodi', $id_prodi)->first();
if ($data_update16 != Null) {
    $data_update16->update($input); 
}

$data_update17 = KaryaIlmiahDtps::where('id_prodi', $id_prodi)->first();
if ($data_update17 != Null) {
    $data_update17->update($input); 
}

$data_update18 = ProdukDtps::where('id_prodi', $id_prodi)->first();
if ($data_update18 != Null) {
    $data_update18->update($input); 
}

$data_update19 = LuaranPenelitianDtpsBagian1::where('id_prodi', $id_prodi)->first();
if ($data_update19 != Null) {
    $data_update19->update($input); 
}

$data_update20 = LuaranPenelitianDtpsBagian2::where('id_prodi', $id_prodi)->first();
if ($data_update20 != Null) {
    $data_update20->update($input); 
}

$data_update21 = LuaranPenelitianDtpsBagian3::where('id_prodi', $id_prodi)->first();
if ($data_update21 != Null) {
    $data_update21->update($input); 
}

$data_update22 = LuaranPenelitianDtpsBagian4::where('id_prodi', $id_prodi)->first();
if ($data_update22 != Null) {
    $data_update22->update($input); 
}

$data_update23 = PenggunaanDana::where('id_prodi', $id_prodi)->first();
if ($data_update23 != Null) {
    $data_update23->update($input); 
}

$data_update23 = KurikulumPembelajaran::where('id_prodi', $id_prodi)->first();
if ($data_update23 != Null) {
    $data_update23->update($input); 
}

$data_update24 = IntegrasiKegiatanPembelajaran::where('id_prodi', $id_prodi)->first();
if ($data_update24 != Null) {
    $data_update24->update($input); 
}

$data_update25 = KepuasanMahasiswa::where('id_prodi', $id_prodi)->first();
if ($data_update25 != Null) {
    $data_update25->update($input); 
}

$data_update26 = PenelitianDtpsMahasiswa::where('id_prodi', $id_prodi)->first();
if ($data_update26 != Null) {
    $data_update26->update($input); 
}

$data_update27 = PkmDtpsMahasiswa::where('id_prodi', $id_prodi)->first();
if ($data_update27 != Null) {
    $data_update27->update($input); 
}

$data_update28 = IpkLulusan::where('id_prodi', $id_prodi)->first();
if ($data_update28 != Null) {
    $data_update28->update($input); 
}

$data_update29 = PrestasiAkademikMahasiswa::where('id_prodi', $id_prodi)->first();
if ($data_update29 != Null) {
    $data_update29->update($input); 
}

$data_update30 = PrestasiNonAkademikMahasiswa::where('id_prodi', $id_prodi)->first();
if ($data_update30 != Null) {
    $data_update30->update($input); 
}

$data_update31 = MasaStudiLulusanD3::where('id_prodi', $id_prodi)->first();
if ($data_update31 != Null) {
    $data_update31->update($input); 
}

$data_update32 = MasaStudiLulusanSarjanaTerapan::where('id_prodi', $id_prodi)->first();
if ($data_update32 != Null) {
    $data_update32->update($input); 
}

$data_update33 = WaktuTungguLulusanD3::where('id_prodi', $id_prodi)->first();
if ($data_update33 != Null) {
    $data_update33->update($input); 
}

$data_update34 = WaktuTungguLulusanSarjanaTerapan::where('id_prodi', $id_prodi)->first();
if ($data_update34 != Null) {
    $data_update34->update($input); 
}

$data_update35 = KesesuaianBidangkerjaLulusan::where('id_prodi', $id_prodi)->first();
if ($data_update35 != Null) {
    $data_update35->update($input); 
}

$data_update36 = TempatKerjaLulusan::where('id_prodi', $id_prodi)->first();
if ($data_update36 != Null) {
    $data_update36->update($input); 
}

$data_update37 = ReferensiKepuasanPengguna::where('id_prodi', $id_prodi)->first();
if ($data_update37 != Null) {
    $data_update37->update($input); 
}

$data_update38 = KepuasanPenggunaLulusan::where('id_prodi', $id_prodi)->first();
if ($data_update38 != Null) {
    $data_update38->update($input); 
}

$data_update39 = PagelaranIlmiahMahasiswa::where('id_prodi', $id_prodi)->first();
if ($data_update39 != Null) {
    $data_update39->update($input); 
}

$data_update40 = ProdukMahasiswa::where('id_prodi', $id_prodi)->first();
if ($data_update11 != Null) {
    $data_update11->update($input); 
}

$data_update41 = LuaranPenelitianMahasiswaBagian1::where('id_prodi', $id_prodi)->first();
if ($data_update41 != Null) {
    $data_update41->update($input); 
}

$data_update42 = LuaranPenelitianMahasiswaBagian2::where('id_prodi', $id_prodi)->first();
if ($data_update42 != Null) {
    $data_update42->update($input); 
}

$data_update43 = LuaranPenelitianMahasiswaBagian3::where('id_prodi', $id_prodi)->first();
if ($data_update43 != Null) {
    $data_update43->update($input); 
}

$data_update44 = LuaranPenelitianMahasiswaBagian4::where('id_prodi', $id_prodi)->first();
if ($data_update44 != Null) {
    $data_update44->update($input); 
}

$batas_update = BatasWaktuLkps::where('id_prodi', $request->id_prodi)->first();
$batas_update->update($input); 


 return redirect('/kappm-batas_waktu_lkps')->with('success', 'Buka Akses Berhasil');
}
    }