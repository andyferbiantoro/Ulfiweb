<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

use Carbon\Carbon;
use App\User;
use Auth;
use File;
use DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class SubmitLkpsProdiController extends Controller
{
    //

public function submit_lkps()
{
    $batas_waktu = BatasWaktuLkps::where('id_prodi',Auth::user()->id_prodi)
    ->where('status','1')
    ->first();


    $now = Carbon::now();
    $waktu_submit =  date_format($now, 'y-m-d H:i:s');

    $deadline = BatasWaktuLkps::where('id_prodi',Auth::user()->id_prodi)
    ->where('tanggal_awal', '<' , $waktu_submit)
    ->where('tanggal_akhir', '>' , $waktu_submit)
    ->first();



   // $waktu_submit = Carbon::parse($now)->format('y-m-d H:i:s');
    //return $deadline;

  return view('lkps-prodi.submit.index',compact('batas_waktu','deadline'));
}


public function submit_lkps_proses(Request $request)
  {


$input = [
    'status' =>'1',     
];

$data_update1 = DataLkps::where('id_user', Auth::user()->id)->first();
if ($data_update1 != Null) {
$data_update1->update($input); 
}

$data_update2 = DaftarProdiDiupps::where('id_user', Auth::user()->id)->first();
if ($data_update2 != Null) {
$data_update2->update($input); 
}
$data_update3 = KerjasamaTridharmaPendidikan::where('id_user', Auth::user()->id)->first();
if ($data_update3 != Null) {
$data_update3->update($input); 
}   

$data_update4 = KerjasamaTridharmaPenelitian::where('id_user', Auth::user()->id)->first();
if ($data_update4 != Null) {
$data_update4->update($input); 
}

$data_update5 = KerjasamaTridharmaPkm::where('id_user', Auth::user()->id)->first();
if ($data_update5 != Null) {
$data_update5->update($input); 
}

$data_update6 = SeleksiMahasiswaBaru::where('id_user', Auth::user()->id)->first();
if ($data_update6 != Null) {
$data_update6->update($input); 
}

$data_update7 = MahasiswaAsing::where('id_user', Auth::user()->id)->first();
if ($data_update7 != Null) {
$data_update7->update($input); 
}

$data_update8 = DosenTetapPerguruanTinggi::where('id_user', Auth::user()->id)->first();
if ($data_update8 != Null) {
$data_update8->update($input); 
}

$data_update9 = DosenUtamaTugasAkhir::where('id_user', Auth::user()->id)->first();
if ($data_update9 != Null) {
$data_update9->update($input); 
}

$data_update10 = EwmpDosenTetapPerguruanTinggi::where('id_user', Auth::user()->id)->first();
if ($data_update10 != Null) {
$data_update10->update($input); 
}

$data_update11 = DosenTidakTetap::where('id_user', Auth::user()->id)->first();
if ($data_update11 != Null) {
$data_update11->update($input); 
}

$data_update12 = DosenIndustri::where('id_user', Auth::user()->id)->first();
if ($data_update12 != Null) {
$data_update12->update($input); 
}

$data_update13 = PengakuanDtps::where('id_user', Auth::user()->id)->first();
if ($data_update13 != Null) {
$data_update13->update($input); 
}

$data_update14 = PenelitianDtps::where('id_user', Auth::user()->id)->first();
if ($data_update14 != Null) {
$data_update14->update($input); 
}

$data_update15 = PkmDtps::where('id_user', Auth::user()->id)->first();
if ($data_update15 != Null) {
$data_update15->update($input); 
}

$data_update16 = PagelaranIlmiahDtps::where('id_user', Auth::user()->id)->first();
if ($data_update16 != Null) {
$data_update16->update($input); 
}

$data_update17 = KaryaIlmiahDtps::where('id_user', Auth::user()->id)->first();
if ($data_update17 != Null) {
$data_update17->update($input); 
}

$data_update18 = ProdukDtps::where('id_user', Auth::user()->id)->first();
if ($data_update18 != Null) {
$data_update18->update($input); 
}

$data_update19 = LuaranPenelitianDtpsBagian1::where('id_user', Auth::user()->id)->first();
if ($data_update19 != Null) {
$data_update19->update($input); 
}

$data_update20 = LuaranPenelitianDtpsBagian2::where('id_user', Auth::user()->id)->first();
if ($data_update20 != Null) {
$data_update20->update($input); 
}

$data_update21 = LuaranPenelitianDtpsBagian3::where('id_user', Auth::user()->id)->first();
if ($data_update21 != Null) {
$data_update21->update($input); 
}

$data_update22 = LuaranPenelitianDtpsBagian4::where('id_user', Auth::user()->id)->first();
if ($data_update22 != Null) {
$data_update22->update($input); 
}

$data_update23 = PenggunaanDana::where('id_user', Auth::user()->id)->first();
if ($data_update23 != Null) {
$data_update23->update($input); 
}

$data_update23 = KurikulumPembelajaran::where('id_user', Auth::user()->id)->first();
if ($data_update23 != Null) {
$data_update23->update($input); 
}

$data_update24 = IntegrasiKegiatanPembelajaran::where('id_user', Auth::user()->id)->first();
if ($data_update24 != Null) {
$data_update24->update($input); 
}

$data_update25 = KepuasanMahasiswa::where('id_user', Auth::user()->id)->first();
if ($data_update25 != Null) {
$data_update25->update($input); 
}

$data_update26 = PenelitianDtpsMahasiswa::where('id_user', Auth::user()->id)->first();
if ($data_update26 != Null) {
$data_update26->update($input); 
}

$data_update27 = PkmDtpsMahasiswa::where('id_user', Auth::user()->id)->first();
if ($data_update27 != Null) {
$data_update27->update($input); 
}

$data_update28 = IpkLulusan::where('id_user', Auth::user()->id)->first();
if ($data_update28 != Null) {
$data_update28->update($input); 
}

$data_update29 = PrestasiAkademikMahasiswa::where('id_user', Auth::user()->id)->first();
if ($data_update29 != Null) {
$data_update29->update($input); 
}

$data_update30 = PrestasiNonAkademikMahasiswa::where('id_user', Auth::user()->id)->first();
if ($data_update30 != Null) {
$data_update30->update($input); 
}

$data_update31 = MasaStudiLulusanD3::where('id_user', Auth::user()->id)->first();
if ($data_update31 != Null) {
$data_update31->update($input); 
}

$data_update32 = MasaStudiLulusanSarjanaTerapan::where('id_user', Auth::user()->id)->first();
if ($data_update32 != Null) {
$data_update32->update($input); 
}

$data_update33 = WaktuTungguLulusanD3::where('id_user', Auth::user()->id)->first();
if ($data_update33 != Null) {
$data_update33->update($input); 
}

$data_update34 = WaktuTungguLulusanSarjanaTerapan::where('id_user', Auth::user()->id)->first();
if ($data_update34 != Null) {
$data_update34->update($input); 
}

$data_update35 = KesesuaianBidangkerjaLulusan::where('id_user', Auth::user()->id)->first();
if ($data_update35 != Null) {
$data_update35->update($input); 
}

$data_update36 = TempatKerjaLulusan::where('id_user', Auth::user()->id)->first();
if ($data_update36 != Null) {
$data_update36->update($input); 
}

$data_update37 = ReferensiKepuasanPengguna::where('id_user', Auth::user()->id)->first();
if ($data_update37 != Null) {
$data_update37->update($input); 
}

$data_update38 = KepuasanPenggunaLulusan::where('id_user', Auth::user()->id)->first();
if ($data_update38 != Null) {
$data_update38->update($input); 
}

$data_update39 = PagelaranIlmiahMahasiswa::where('id_user', Auth::user()->id)->first();
if ($data_update39 != Null) {
$data_update39->update($input); 
}

$data_update40 = ProdukMahasiswa::where('id_user', Auth::user()->id)->first();
if ($data_update11 != Null) {
$data_update11->update($input); 
}

$data_update41 = LuaranPenelitianMahasiswaBagian1::where('id_user', Auth::user()->id)->first();
if ($data_update41 != Null) {
$data_update41->update($input); 
}

$data_update42 = LuaranPenelitianMahasiswaBagian2::where('id_user', Auth::user()->id)->first();
if ($data_update42 != Null) {
$data_update42->update($input); 
}

$data_update43 = LuaranPenelitianMahasiswaBagian3::where('id_user', Auth::user()->id)->first();
if ($data_update43 != Null) {
$data_update43->update($input); 
}

$data_update44 = LuaranPenelitianMahasiswaBagian4::where('id_user', Auth::user()->id)->first();
if ($data_update44 != Null) {
$data_update44->update($input); 
}

 return redirect('/submit_lkps_prodi')->with('success', 'Data LKPS Berhasil Disubmit');
}
}
