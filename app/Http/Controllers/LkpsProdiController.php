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
use App\User;
use Auth;
use App\HasilPenilaianLkps;
use File;
use DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class LkpsProdiController extends Controller
{

     public function data_lkps(Request $request)
     {
          $prodi = Prodi::all();
          //$data_lkps = DataLkps::where('id_user', Auth::user()->id)->get();
          $filter = $request->filter;

          if ($filter == Null) {
               $data_lkps = DB::table('data_lkps')
                    ->join('prodi', 'data_lkps.id_prodi', '=', 'prodi.id')
                    ->select('data_lkps.*', 'prodi.nama_prodi')
                    ->orderBy('id', 'DESC')
                    ->where('data_lkps.id_user', Auth::user()->id)
                    ->get();
          } else {
               $data_lkps = DB::table('data_lkps')
                    ->join('prodi', 'data_lkps.id_prodi', '=', 'prodi.id')
                    ->select('data_lkps.*', 'prodi.nama_prodi')
                    ->orderBy('id', 'DESC')
                    ->where('id_user', Auth::user()->id)
                    ->where('data_lkps.tahun_akademik', $filter)
                    ->get();
          }



          return view('lkps-prodi.data-lkps.index', compact('data_lkps', 'prodi'));
     }

     public function file_download_lkps($id)
     {

          $download = DataLkps::find($id);

          return  Storage::download($download->path, $download->file_laporan_evaluasi);
     }

     public function data_lkps_add(Request $request)
     {

          $data_lkps_add = new DataLkps();

          $data_lkps_add->jenis_program = $request->input('jenis_program');
          $data_lkps_add->peringkat_akreditasi = $request->input('peringkat_akreditasi');
          $data_lkps_add->nomor_sk_banpt = $request->input('nomor_sk_banpt');
          $data_lkps_add->tanggal_kadaluarsa = $request->input('tanggal_kadaluarsa');
          $data_lkps_add->nama_unit_pengelola = $request->input('nama_unit_pengelola');
          $data_lkps_add->nama_perguruan_tinggi = $request->input('nama_perguruan_tinggi');
          $data_lkps_add->alamat = $request->input('alamat');
          $data_lkps_add->kabupaten = $request->input('kabupaten');
          $data_lkps_add->kode_pos = $request->input('kode_pos');
          $data_lkps_add->nomor_tlp = $request->input('nomor_tlp');
          $data_lkps_add->email = $request->input('email');
          $data_lkps_add->website = $request->input('website');
          $data_lkps_add->tahun_akademik = $request->input('tahun_akademik');
          $data_lkps_add->link_laporan_evaluasi = $request->input('link_laporan_evaluasi');
          $data_lkps_add->nama_pengusul = $request->input('nama_pengusul');
          $data_lkps_add->tanggal = $request->input('tanggal');
          $data_lkps_add->id_user = $request->input('id_user');
          $data_lkps_add->id_prodi = $request->input('id_prodi');
          $data_lkps_add->status = '0';

          if ($request->hasFile('file_laporan_evaluasi')) {
               $file = $request->file('file_laporan_evaluasi');
               $extension = $file->getClientOriginalExtension();
               $filename = $file->getClientOriginalName();
               $path = $file->store('public/uploads/data_lkps_prodi');
               $file->move('uploads/data_lkps_prodi/', $filename);
               $data_lkps_add->file_laporan_evaluasi = $filename;
               $data_lkps_add->path = $path;
          } else {
               echo "Gagal upload gambar";
          }


          $data_lkps_add->save();

          return redirect('/prodi_data_lkps')->with('success', 'Data LKPS Baru Berhasil Ditambahkan');
     }


     public function data_lkps_update(Request $request, $id)
     {

          $data_lkps_update = DataLkps::where('id', $id)->first();


          $input = [
               'jenis_program' => $request->jenis_program,
               'peringkat_akreditasi' => $request->peringkat_akreditasi,
               'nomor_sk_banpt' => $request->nomor_sk_banpt,
               'tanggal_kadaluarsa' => $request->tanggal_kadaluarsa,
               'nama_unit_pengelola' => $request->nama_unit_pengelola,
               'alamat' => $request->alamat,
               'kabupaten' => $request->kabupaten,
               'kode_pos' => $request->kode_pos,
               'nomor_tlp' => $request->nomor_tlp,
               'email' => $request->email,
               'website' => $request->website,
               'tahun_akademik' => $request->tahun_akademik,
               'link_laporan_evaluasi' => $request->link_laporan_evaluasi,
               'nama_pengusul' => $request->nama_pengusul,
               'tanggal' => $request->tanggal,
               'id_user' => $request->id_user,
               'id_prodi' => $request->id_prodi,
          ];

          if ($file = $request->file('file_laporan_evaluasi')) {
               if ($data_lkps_update->file_laporan_evaluasi) {
                    File::delete('uploads/data_lkps_prodi/' . $data_lkps_update->file_laporan_evaluasi);
               }
               $nama_file = $file->getClientOriginalName();
               $path = $file->store('public/uploads/data_lkps_prodi');
               $file->move(public_path() . '/uploads/data_lkps_prodi/', $nama_file);
               $input['file_laporan_evaluasi'] = $nama_file;
               $input['path'] = $path;
          }


          $data_lkps_update->update($input);

          return redirect('/prodi_data_lkps')->with('success', 'Data LKPS Berhasil Diupdate');
     }

     public function data_lkps_delete($id)
     {
          $delete = DataLkps::findOrFail($id);
          $delete->delete();

          return redirect('/prodi_data_lkps')->with('success', 'Data LKPS Berhasil Dihapus');
     }


     public function daftar_program_studi_upps(Request $request)
     {

          $prodi = Prodi::all();
          //$daftar_prodi_upps = DaftarProdiDiupps::where('id_user', Auth::user()->id)->get();

          $filter = $request->filter;

          if ($filter == Null) {
               $daftar_prodi_upps = DB::table('daftar_prodi_diupps')
                    ->join('prodi', 'daftar_prodi_diupps.id_prodi', '=', 'prodi.id')
                    ->select('daftar_prodi_diupps.*', 'prodi.nama_prodi')
                    ->orderBy('id', 'DESC')
                    ->where('id_user', Auth::user()->id)
                    ->get();
          } else {
               $daftar_prodi_upps = DB::table('daftar_prodi_diupps')
                    ->join('prodi', 'daftar_prodi_diupps.id_prodi', '=', 'prodi.id')
                    ->select('daftar_prodi_diupps.*', 'prodi.nama_prodi')
                    ->orderBy('id', 'DESC')
                    ->where('id_user', Auth::user()->id)
                    ->where('tahun', $filter)
                    ->get();
          }
          return view('lkps-prodi.daftar-program-studi-di-upps.index', compact('daftar_prodi_upps', 'prodi'));
     }


     public function file_download_upps($id)
     {

          $download = DaftarProdiDiupps::find($id);

          return  Storage::download($download->path, $download->file_surat_keputusan);
     }


     public function daftar_program_studi_upps_add(Request $request)
     {

          $daftar_program_studi_upps_add = new DaftarProdiDiupps();

          $daftar_program_studi_upps_add->jenis_program = $request->input('jenis_program');
          $daftar_program_studi_upps_add->peringkat_akreditasi = $request->input('peringkat_akreditasi');
          $daftar_program_studi_upps_add->nomor_tanggal_sk = $request->input('nomor_tanggal_sk');
          $daftar_program_studi_upps_add->tanggal_kadaluarsa = $request->input('tanggal_kadaluarsa');
          $daftar_program_studi_upps_add->jumlah_mahasiswa = $request->input('jumlah_mahasiswa');
          $daftar_program_studi_upps_add->link_surat_keputusan = $request->input('link_surat_keputusan');
          $daftar_program_studi_upps_add->tahun = $request->input('tahun');
          $daftar_program_studi_upps_add->id_user = $request->input('id_user');
          $daftar_program_studi_upps_add->id_prodi = $request->input('id_prodi');
          $daftar_program_studi_upps_add->status = '0';

          if ($request->hasFile('file_surat_keputusan')) {
               $file = $request->file('file_surat_keputusan');
               $extension = $file->getClientOriginalExtension();
               $filename = $file->getClientOriginalName();
               $path = $file->store('public/uploads/daftar_prodi_diupps');
               $file->move('uploads/daftar_prodi_diupps/', $filename);
               $daftar_program_studi_upps_add->file_surat_keputusan = $filename;
               $daftar_program_studi_upps_add->path = $path;
          } else {
               echo "Gagal upload gambar";
          }


          $daftar_program_studi_upps_add->save();

          return redirect('/prodi_daftar_program_studi_upps')->with('success', 'Daftar Program Studi Upps Baru Berhasil Ditambahkan');
     }


     public function daftar_program_studi_upps_update(Request $request, $id)
     {

          $data_upps_update = DaftarProdiDiupps::where('id', $id)->first();


          $input = [
               'jenis_program' => $request->jenis_program,
               'peringkat_akreditasi' => $request->peringkat_akreditasi,
               'nomor_tanggal_sk' => $request->nomor_tanggal_sk,
               'tanggal_kadaluarsa' => $request->tanggal_kadaluarsa,
               'jumlah_mahasiswa' => $request->jumlah_mahasiswa,
               'link_surat_keputusan' => $request->link_surat_keputusan,
               'tahun' => $request->tahun,
               'id_user' => $request->id_user,
               'id_prodi' => $request->id_prodi,
          ];

          if ($file = $request->file('file_surat_keputusan')) {
               if ($data_upps_update->file_surat_keputusan) {
                    File::delete('uploads/daftar_prodi_diupps/' . $data_upps_update->file_surat_keputusan);
               }
               $nama_file = $file->getClientOriginalName();
               $path = $file->store('public/uploads/daftar_prodi_diupps');
               $file->move(public_path() . '/uploads/daftar_prodi_diupps/', $nama_file);
               $input['file_surat_keputusan'] = $nama_file;
               $input['path'] = $path;
          }


          $data_upps_update->update($input);

          return redirect('/prodi_daftar_program_studi_upps')->with('success', 'Data Prodi diupps Berhasil Diupdate');
     }


     public function daftar_program_studi_upps_delete($id)
     {
          $delete = DaftarProdiDiupps::findOrFail($id);
          $delete->delete();

          return redirect('/prodi_daftar_program_studi_upps')->with('success', 'Data Prodi diupps Berhasil Dihapus');
     }



     // ==============================Kerja Sama================================


     public function kerja_sama_tridharma_pendidikan(Request $request)
     {
          $filter = $request->filter;
          if ($filter == Null) {
               $tridharma_pendidikan = KerjasamaTridharmaPendidikan::where('id_user', Auth::user()->id)->get();
               // code...
          } else {
               $tridharma_pendidikan = KerjasamaTridharmaPendidikan::where('id_user', Auth::user()->id)
                    ->where('tahun_berakhir', $filter)
                    ->get();
          }

          return view('lkps-prodi.kerjasama-tridharma.pendidikan.index', compact('tridharma_pendidikan'));
     }


     public function file_download_pendidikan($id)
     {

          $download = KerjasamaTridharmaPendidikan::find($id);

          return  Storage::download($download->path, $download->file_bukti_kerjasama);
     }


     public function kerja_sama_tridharma_pendidikan_add(Request $request)
     {

          $tridharma_pendidikan_add = new KerjasamaTridharmaPendidikan();

          $tridharma_pendidikan_add->lembaga_mitra = $request->input('lembaga_mitra');
          $tridharma_pendidikan_add->tingkat = $request->input('tingkat');
          $tridharma_pendidikan_add->judul_kegiatan = $request->input('judul_kegiatan');
          $tridharma_pendidikan_add->manfaat = $request->input('manfaat');
          $tridharma_pendidikan_add->waktu_durasi = $request->input('waktu_durasi');
          $tridharma_pendidikan_add->link_bukti_kerjasama = $request->input('link_bukti_kerjasama');
          $tridharma_pendidikan_add->tahun_berakhir = $request->input('tahun_berakhir');
          $tridharma_pendidikan_add->id_user = $request->input('id_user');
          $tridharma_pendidikan_add->id_prodi = Auth::user()->id_prodi;
          $tridharma_pendidikan_add->status = '0';


          if ($request->hasFile('file_bukti_kerjasama')) {
               $file = $request->file('file_bukti_kerjasama');
               $extension = $file->getClientOriginalExtension();
               $filename = $file->getClientOriginalName();
               $path = $file->store('public/uploads/kerjasama_tridharma');
               $file->move('uploads/kerjasama_tridharma/', $filename);
               $tridharma_pendidikan_add->file_bukti_kerjasama = $filename;
               $tridharma_pendidikan_add->path = $path;
          } else {
               echo "Gagal upload gambar";
          }


          $tridharma_pendidikan_add->save();

          return redirect('/prodi_kerja_sama_tridharma_pendidikan')->with('success', 'Kerjasama Tridharma Pendidikan Baru Berhasil Ditambahkan');
     }


     public function kerja_sama_tridharma_pendidikan_update(Request $request, $id)
     {

          $pendidikan_update = KerjasamaTridharmaPendidikan::where('id', $id)->first();


          $input = [
               'lembaga_mitra' => $request->lembaga_mitra,
               'tingkat' => $request->tingkat,
               'judul_kegiatan' => $request->judul_kegiatan,
               'manfaat' => $request->manfaat,
               'waktu_durasi' => $request->waktu_durasi,
               'link_bukti_kerjasama' => $request->link_bukti_kerjasama,
               'tahun_berakhir' => $request->tahun_berakhir,
               'id_user' => $request->id_user,

          ];

          if ($file = $request->file('file_bukti_kerjasama')) {
               if ($pendidikan_update->file_bukti_kerjasama) {
                    File::delete('uploads/kerjasama_tridharma/' . $pendidikan_update->file_bukti_kerjasama);
               }
               $nama_file = $file->getClientOriginalName();
               $path = $file->store('public/uploads/kerjasama_tridharma');
               $file->move(public_path() . '/uploads/kerjasama_tridharma/', $nama_file);
               $input['file_bukti_kerjasama'] = $nama_file;
               $input['path'] = $path;
          }


          $pendidikan_update->update($input);

          return redirect('/prodi_kerja_sama_tridharma_pendidikan')->with('success', 'Data Tridharma pendidikan Berhasil Diupdate');
     }


     public function kerja_sama_tridharma_pendidikan_delete($id)
     {
          $delete = KerjasamaTridharmaPendidikan::findOrFail($id);
          $delete->delete();

          return redirect('/prodi_kerja_sama_tridharma_pendidikan')->with('success', 'Data Tridharma Pendidikan Berhasil Dihapus');
     }




     public function kerja_sama_tridharma_penelitian(Request $request)
     {

          $filter = $request->filter;
          if ($filter == Null) {
               $tridharma_penelitian = KerjasamaTridharmaPenelitian::where('id_user', Auth::user()->id)->get();
               // code...
          } else {
               $tridharma_penelitian = KerjasamaTridharmaPenelitian::where('id_user', Auth::user()->id)
                    ->where('tahun_berakhir', $filter)
                    ->get();
          }

          return view('lkps-prodi.kerjasama-tridharma.penelitian.index', compact('tridharma_penelitian'));
     }



     public function file_download_penelitian($id)
     {

          $download = KerjasamaTridharmaPenelitian::find($id);

          return  Storage::download($download->path, $download->file_bukti_kerjasama);
     }



     public function kerja_sama_tridharma_penelitian_add(Request $request)
     {

          $tridharma_penelitian_add = new KerjasamaTridharmaPenelitian();

          $tridharma_penelitian_add->lembaga_mitra = $request->input('lembaga_mitra');
          $tridharma_penelitian_add->tingkat = $request->input('tingkat');
          $tridharma_penelitian_add->judul_kegiatan = $request->input('judul_kegiatan');
          $tridharma_penelitian_add->manfaat = $request->input('manfaat');
          $tridharma_penelitian_add->waktu_durasi = $request->input('waktu_durasi');
          $tridharma_penelitian_add->link_bukti_kerjasama = $request->input('link_bukti_kerjasama');
          $tridharma_penelitian_add->tahun_berakhir = $request->input('tahun_berakhir');
          $tridharma_penelitian_add->id_user = $request->input('id_user');
          $tridharma_penelitian_add->id_prodi = Auth::user()->id_prodi;
          $tridharma_penelitian_add->status = '0';


          if ($request->hasFile('file_bukti_kerjasama')) {
               $file = $request->file('file_bukti_kerjasama');
               $extension = $file->getClientOriginalExtension();
               $filename = $file->getClientOriginalName();
               $path = $file->store('public/uploads/kerjasama_tridharma');
               $file->move('uploads/kerjasama_tridharma/', $filename);
               $tridharma_penelitian_add->file_bukti_kerjasama = $filename;
               $tridharma_penelitian_add->path = $path;
          } else {
               echo "Gagal upload gambar";
          }


          $tridharma_penelitian_add->save();

          return redirect('/prodi_kerja_sama_tridharma_penelitian')->with('success', 'Kerjasama Tridharma Penelitian Baru Berhasil Ditambahkan');
     }


     public function kerja_sama_tridharma_penelitian_update(Request $request, $id)
     {

          $penelitian_update = KerjasamaTridharmaPenelitian::where('id', $id)->first();


          $input = [
               'lembaga_mitra' => $request->lembaga_mitra,
               'tingkat' => $request->tingkat,
               'judul_kegiatan' => $request->judul_kegiatan,
               'manfaat' => $request->manfaat,
               'waktu_durasi' => $request->waktu_durasi,
               'link_bukti_kerjasama' => $request->link_bukti_kerjasama,
               'tahun_berakhir' => $request->tahun_berakhir,
               'id_user' => $request->id_user,

          ];

          if ($file = $request->file('file_bukti_kerjasama')) {
               if ($penelitian_update->file_bukti_kerjasama) {
                    File::delete('uploads/kerjasama_tridharma/' . $penelitian_update->file_bukti_kerjasama);
               }
               $nama_file = $file->getClientOriginalName();
               $path = $file->store('public/uploads/kerjasama_tridharma');
               $file->move(public_path() . '/uploads/kerjasama_tridharma/', $nama_file);
               $input['file_bukti_kerjasama'] = $nama_file;
               $input['path'] = $path;
          }


          $penelitian_update->update($input);

          return redirect('/prodi_kerja_sama_tridharma_penelitian')->with('success', 'Data Tridharma penelitian Berhasil Diupdate');
     }


     public function kerja_sama_tridharma_penelitian_delete($id)
     {
          $delete = KerjasamaTridharmaPenelitian::findOrFail($id);
          $delete->delete();

          return redirect('/prodi_kerja_sama_tridharma_penelitian')->with('success', 'Data Tridharma penelitian Berhasil Dihapus');
     }


     public function kerja_sama_tridharma_pengabdian_kepada_masyarakat(Request $request)
     {

          $filter = $request->filter;
          if ($filter == Null) {
               $tridharma_pkm = KerjasamaTridharmaPkm::where('id_user', Auth::user()->id)->get();
               // code...
          } else {
               $tridharma_pkm = KerjasamaTridharmaPkm::where('id_user', Auth::user()->id)
                    ->where('tahun_berakhir', $filter)
                    ->get();
          }


          return view('lkps-prodi.kerjasama-tridharma.pengabdian-kepada-masyarakat.index', compact('tridharma_pkm'));
     }


     public function file_download_pkm($id)
     {

          $download = KerjasamaTridharmaPkm::find($id);

          return  Storage::download($download->path, $download->file_bukti_kerjasama);
     }


     public function kerja_sama_tridharma_pkm_add(Request $request)
     {

          $tridharma_pkm_add = new KerjasamaTridharmaPkm();

          $tridharma_pkm_add->lembaga_mitra = $request->input('lembaga_mitra');
          $tridharma_pkm_add->tingkat = $request->input('tingkat');
          $tridharma_pkm_add->judul_kegiatan = $request->input('judul_kegiatan');
          $tridharma_pkm_add->manfaat = $request->input('manfaat');
          $tridharma_pkm_add->waktu_durasi = $request->input('waktu_durasi');
          $tridharma_pkm_add->link_bukti_kerjasama = $request->input('link_bukti_kerjasama');
          $tridharma_pkm_add->tahun_berakhir = $request->input('tahun_berakhir');
          $tridharma_pkm_add->id_user = $request->input('id_user');
          $tridharma_pkm_add->id_prodi = Auth::user()->id_prodi;
          $tridharma_pkm_add->status = '0';

          if ($request->hasFile('file_bukti_kerjasama')) {
               $file = $request->file('file_bukti_kerjasama');
               $extension = $file->getClientOriginalExtension();
               $filename = $file->getClientOriginalName();
               $path = $file->store('public/uploads/kerjasama_tridharma');
               $file->move('uploads/kerjasama_tridharma/', $filename);
               $tridharma_pkm_add->file_bukti_kerjasama = $filename;
               $tridharma_pkm_add->path = $path;
          } else {
               echo "Gagal upload gambar";
          }


          $tridharma_pkm_add->save();

          return redirect('/prodi_kerja_sama_tridharma_pengabdian_kepada_masyarakat')->with('success', 'Kerjasama Tridharma PKM Baru Berhasil Ditambahkan');
     }


     public function kerja_sama_tridharma_pkm_update(Request $request, $id)
     {

          $pkm_update = KerjasamaTridharmaPkm::where('id', $id)->first();


          $input = [
               'lembaga_mitra' => $request->lembaga_mitra,
               'tingkat' => $request->tingkat,
               'judul_kegiatan' => $request->judul_kegiatan,
               'manfaat' => $request->manfaat,
               'waktu_durasi' => $request->waktu_durasi,
               'link_bukti_kerjasama' => $request->link_bukti_kerjasama,
               'tahun_berakhir' => $request->tahun_berakhir,
               'id_user' => $request->id_user,

          ];

          if ($file = $request->file('file_bukti_kerjasama')) {
               if ($pkm_update->file_bukti_kerjasama) {
                    File::delete('uploads/kerjasama_tridharma/' . $pkm_update->file_bukti_kerjasama);
               }
               $nama_file = $file->getClientOriginalName();
               $path = $file->store('public/uploads/kerjasama_tridharma');
               $file->move(public_path() . '/uploads/kerjasama_tridharma/', $nama_file);
               $input['file_bukti_kerjasama'] = $nama_file;
               $input['path'] = $path;
          }


          $pkm_update->update($input);

          return redirect('/prodi_kerja_sama_tridharma_pengabdian_kepada_masyarakat')->with('success', 'Data Tridharma Pkm Berhasil Diupdate');
     }


     public function kerja_sama_tridharma_pkm_delete($id)
     {
          $delete = KerjasamaTridharmaPkm::findOrFail($id);
          $delete->delete();

          return redirect('/prodi_kerja_sama_tridharma_pengabdian_kepada_masyarakat')->with('success', 'Data Tridharma Pkm Berhasil Dihapus');
     }


     // ============================Mahasiswa=============================

     public function mahasiswa_seleksi_mahasiswa_baru(Request $request)
     {

          $filter = $request->filter;

          if ($filter == Null) {
               $seleksi_mhs_baru = SeleksiMahasiswaBaru::orderBy('id', 'DESC')->where('id_user', Auth::user()->id)->get();
          } else {
               $seleksi_mhs_baru = SeleksiMahasiswaBaru::orderBy('id', 'DESC')->where('id_user', Auth::user()->id)
                    ->where('tahun_akademik', $filter)
                    ->get();
          }


          $calon_mhs_pendaftar = SeleksiMahasiswaBaru::sum('jumlah_calonMahasiswa_pendaftar');
          $calon_mhs_lulus = SeleksiMahasiswaBaru::sum('jumlah_calonMahasiswa_lulus');
          $mhs_baru_reguler = SeleksiMahasiswaBaru::sum('jumlah_mahasiswaBaru_reguler');
          $mhs_baru_transfer = SeleksiMahasiswaBaru::sum('jumlah_mahasiswaBaru_transfer');
          $mhs_aktif_reguler = SeleksiMahasiswaBaru::sum('jumlah_mahasiswaAktif_reguler');
          $mhs_aktif_transfer = SeleksiMahasiswaBaru::sum('jumlah_mahasiswaAktif_transfer');

          return view('lkps-prodi.mahasiswa.seleksi-mahasiswa-baru.index', compact('seleksi_mhs_baru', 'calon_mhs_pendaftar', 'calon_mhs_lulus', 'mhs_baru_reguler', 'mhs_baru_transfer', 'mhs_aktif_reguler', 'mhs_aktif_transfer'));
     }

     public function file_download_mhs_baru($id)
     {

          $download = SeleksiMahasiswaBaru::find($id);

          return  Storage::download($download->path, $download->file_bukti_dokumen);
     }


     public function mahasiswa_seleksi_mahasiswa_baru_add(Request $request)
     {

          $seleksi_mhs_baru_add = new SeleksiMahasiswaBaru();

          $seleksi_mhs_baru_add->tahun_akademik = $request->input('tahun_akademik');
          $seleksi_mhs_baru_add->daya_tampung = $request->input('daya_tampung');
          $seleksi_mhs_baru_add->jumlah_calonMahasiswa_pendaftar = $request->input('jumlah_calonMahasiswa_pendaftar');
          $seleksi_mhs_baru_add->jumlah_calonMahasiswa_lulus = $request->input('jumlah_calonMahasiswa_lulus');
          $seleksi_mhs_baru_add->jumlah_mahasiswaBaru_reguler = $request->input('jumlah_mahasiswaBaru_reguler');
          $seleksi_mhs_baru_add->jumlah_mahasiswaBaru_transfer = $request->input('jumlah_mahasiswaBaru_transfer');
          $seleksi_mhs_baru_add->jumlah_mahasiswaAktif_reguler = $request->input('jumlah_mahasiswaAktif_reguler');
          $seleksi_mhs_baru_add->jumlah_mahasiswaAktif_transfer = $request->input('jumlah_mahasiswaAktif_transfer');
          $seleksi_mhs_baru_add->link_bukti_dokumen = $request->input('link_bukti_dokumen');
          $seleksi_mhs_baru_add->id_user = $request->input('id_user');
          $seleksi_mhs_baru_add->id_prodi = Auth::user()->id_prodi;
          $seleksi_mhs_baru_add->status = '0';

          if ($request->hasFile('file_bukti_dokumen')) {
               $file = $request->file('file_bukti_dokumen');
               $extension = $file->getClientOriginalExtension();
               $filename = $file->getClientOriginalName();
               $path = $file->store('public/uploads/seleksi_mahasiswa_baru');
               $file->move('uploads/seleksi_mahasiswa_baru/', $filename);
               $seleksi_mhs_baru_add->file_bukti_dokumen = $filename;
               $seleksi_mhs_baru_add->path = $path;
          } else {
               echo "Gagal upload gambar";
          }


          $seleksi_mhs_baru_add->save();

          return redirect('/prodi_mahasiswa_seleksi_mahasiswa_baru')->with('success', 'Data Seleksi Mahasiswa Baru Berhasil Ditambahkan');
     }



     public function mahasiswa_seleksi_mahasiswa_baru_update(Request $request, $id)
     {

          $mhs_baru_update = SeleksiMahasiswaBaru::where('id', $id)->first();


          $input = [
               'tahun_akademik' => $request->tahun_akademik,
               'daya_tampung' => $request->daya_tampung,
               'jumlah_calonMahasiswa_pendaftar' => $request->jumlah_calonMahasiswa_pendaftar,
               'jumlah_calonMahasiswa_lulus' => $request->jumlah_calonMahasiswa_lulus,
               'jumlah_mahasiswaBaru_reguler' => $request->jumlah_mahasiswaBaru_reguler,
               'jumlah_mahasiswaBaru_transfer' => $request->jumlah_mahasiswaBaru_transfer,
               'jumlah_mahasiswaAktif_reguler' => $request->jumlah_mahasiswaAktif_reguler,
               'jumlah_mahasiswaAktif_transfer' => $request->jumlah_mahasiswaAktif_transfer,
               'link_bukti_dokumen' => $request->link_bukti_dokumen,
               'id_user' => $request->id_user,


          ];

          if ($file = $request->file('file_bukti_dokumen')) {
               if ($mhs_baru_update->file_bukti_dokumen) {
                    File::delete('uploads/seleksi_mahasiswa_baru/' . $mhs_baru_update->file_bukti_dokumen);
               }
               $nama_file = $file->getClientOriginalName();
               $path = $file->store('public/uploads/seleksi_mahasiswa_baru');
               $file->move(public_path() . '/uploads/seleksi_mahasiswa_baru/', $nama_file);
               $input['file_bukti_dokumen'] = $nama_file;
               $input['path'] = $path;
          }


          $mhs_baru_update->update($input);

          return redirect('/prodi_mahasiswa_seleksi_mahasiswa_baru')->with('success', 'Data Seleksi Mahasiswa Baru Berhasil Diupdate');
     }


     public function mahasiswa_seleksi_mahasiswa_baru_delete($id)
     {
          $delete = SeleksiMahasiswaBaru::findOrFail($id);
          $delete->delete();

          return redirect('/prodi_mahasiswa_seleksi_mahasiswa_baru')->with('success', 'Data Seleksi Mahasiswa Baru Berhasil Dihapus');
     }



     public function lihat_mahasiswa_seleksi_mahasiswa_baru()
     {
          $seleksi_mhs_baru = SeleksiMahasiswaBaru::orderBy('id', 'DESC')->where('id_user', Auth::user()->id)->get();

          return view('lkps-prodi.mahasiswa.seleksi-mahasiswa-baru.lihat_laporan', compact('seleksi_mhs_baru'));
     }



     public function mahasiswa_mahasiswa_asing(Request $request)
     {
          $filter = $request->filter;

          if ($filter == Null) {

               $mhs_asing = DB::table('mahasiswa_asing')
                    ->join('prodi', 'mahasiswa_asing.id_prodi', '=', 'prodi.id')
                    ->select('mahasiswa_asing.*', 'prodi.nama_prodi')
                    ->orderBy('id', 'DESC')
                    ->where('id_user', Auth::user()->id)
                    ->get();
          } else {
               $mhs_asing = DB::table('mahasiswa_asing')
                    ->join('prodi', 'mahasiswa_asing.id_prodi', '=', 'prodi.id')
                    ->select('mahasiswa_asing.*', 'prodi.nama_prodi')
                    ->orderBy('id', 'DESC')
                    ->where('id_user', Auth::user()->id)
                    ->where('tahun_akademik', $filter)
                    ->get();
          }


          return view('lkps-prodi.mahasiswa.mahasiswa-asing.index', compact('mhs_asing'));
     }


     public function file_download_mhs_asing($id)
     {

          $download = MahasiswaAsing::find($id);

          return  Storage::download($download->path, $download->file_bukti_dokumen);
     }

     public function mahasiswa_mahasiswa_asing_add(Request $request)
     {

          $mhs_asing_add = new MahasiswaAsing();

          $mhs_asing_add->jumlah_mahasiswaAktif_ts2 = $request->input('jumlah_mahasiswaAktif_ts2');
          $mhs_asing_add->jumlah_mahasiswaAktif_ts1 = $request->input('jumlah_mahasiswaAktif_ts1');
          $mhs_asing_add->jumlah_mahasiswaAktif_ts = $request->input('jumlah_mahasiswaAktif_ts');
          $mhs_asing_add->jumlah_mahasiswaFullTime_ts2 = $request->input('jumlah_mahasiswaFullTime_ts2');
          $mhs_asing_add->jumlah_mahasiswaFullTime_ts1 = $request->input('jumlah_mahasiswaFullTime_ts1');
          $mhs_asing_add->jumlah_mahasiswaFullTime_ts = $request->input('jumlah_mahasiswaFullTime_ts');
          $mhs_asing_add->jumlah_mahasiswaPartTime_ts2 = $request->input('jumlah_mahasiswaPartTime_ts2');
          $mhs_asing_add->jumlah_mahasiswaPartTime_ts1 = $request->input('jumlah_mahasiswaPartTime_ts1');
          $mhs_asing_add->jumlah_mahasiswaPartTime_ts = $request->input('jumlah_mahasiswaPartTime_ts');
          $mhs_asing_add->tahun_akademik = $request->input('tahun_akademik');
          $mhs_asing_add->link_bukti_dokumen = $request->input('link_bukti_dokumen');
          $mhs_asing_add->id_user  = $request->input('id_user');
          $mhs_asing_add->id_prodi  = $request->input('id_prodi');
          $mhs_asing_add->status = '0';


          if ($request->hasFile('file_bukti_dokumen')) {
               $file = $request->file('file_bukti_dokumen');
               $extension = $file->getClientOriginalExtension();
               $filename = $file->getClientOriginalName();
               $path = $file->store('public/uploads/mahasiswa_asing');
               $file->move('uploads/mahasiswa_asing/', $filename);
               $mhs_asing_add->file_bukti_dokumen = $filename;
               $mhs_asing_add->path = $path;
          } else {
               echo "Gagal upload gambar";
          }


          $mhs_asing_add->save();

          return redirect('/prodi_mahasiswa_mahasiswa_asing')->with('success', 'Data Mahasiswa Asing Berhasil Ditambahkan');
     }


     public function mahasiswa_mahasiswa_asing_update(Request $request, $id)
     {

          $mhs_asing_update = MahasiswaAsing::where('id', $id)->first();


          $input = [
               'tahun_akademik' => $request->tahun_akademik,
               'jumlah_mahasiswaAktif_ts2' => $request->jumlah_mahasiswaAktif_ts2,
               'jumlah_mahasiswaAktif_ts1' => $request->jumlah_mahasiswaAktif_ts1,
               'jumlah_mahasiswaAktif_ts' => $request->jumlah_mahasiswaAktif_ts,
               'jumlah_mahasiswaFullTime_ts2' => $request->jumlah_mahasiswaFullTime_ts2,
               'jumlah_mahasiswaFullTime_ts1' => $request->jumlah_mahasiswaFullTime_ts1,
               'jumlah_mahasiswaFullTime_ts' => $request->jumlah_mahasiswaFullTime_ts,
               'jumlah_mahasiswaPartTime_ts2' => $request->jumlah_mahasiswaPartTime_ts2,
               'jumlah_mahasiswaPartTime_ts1' => $request->jumlah_mahasiswaPartTime_ts1,
               'jumlah_mahasiswaPartTime_ts' => $request->jumlah_mahasiswaPartTime_ts,
               'link_bukti_dokumen' => $request->link_bukti_dokumen,
               'id_user' => $request->id_user,
               'id_prodi' => $request->id_prodi,


          ];

          if ($file = $request->file('file_bukti_dokumen')) {
               if ($mhs_asing_update->file_bukti_dokumen) {
                    File::delete('uploads/mahasiswa_asing/' . $mhs_asing_update->file_bukti_dokumen);
               }
               $nama_file = $file->getClientOriginalName();
               $path = $file->store('public/uploads/mahasiswa_asing');
               $file->move(public_path() . '/uploads/mahasiswa_asing/', $nama_file);
               $input['file_bukti_dokumen'] = $nama_file;
               $input['path'] = $path;
          }


          $mhs_asing_update->update($input);

          return redirect('/prodi_mahasiswa_mahasiswa_asing')->with('success', 'Data Seleksi Mahasiswa Asing Berhasil Diupdate');
     }


     public function mahasiswa_mahasiswa_asing_delete($id)
     {
          $delete = MahasiswaAsing::findOrFail($id);
          $delete->delete();

          return redirect('/prodi_mahasiswa_mahasiswa_asing')->with('success', 'Data Seleksi Mahasiswa Asing Berhasil Dihapus');
     }


     public function lihat_mahasiswa_mahasiswa_asing()
     {
          $mhs_asing = DB::table('mahasiswa_asing')
               ->join('prodi', 'mahasiswa_asing.id_prodi', '=', 'prodi.id')
               ->select('mahasiswa_asing.*', 'prodi.nama_prodi')
               ->orderBy('id', 'DESC')
               ->where('id_user', Auth::user()->id)
               ->get();

          return view('lkps-prodi.mahasiswa.mahasiswa-asing.lihat_laporan', compact('mhs_asing'));
     }
     
}
