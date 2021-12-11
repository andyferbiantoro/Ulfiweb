@extends('layouts.lkps-prodi-master')

@section('title')
Data Kurikulum, Capain Pembelajaran,dan Rencana Pembelajaran
@endsection


@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="card">
             @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif
                @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
                @endif
            <div class="card-header">
                <h4 style="margin-right: 12%;">Data Kurikulum, Capain Pembelajaran,dan Rencana Pembelajaran</h4>
                <div class=" text-right">
                    <button type="button" class="btn btn-success fa fa-plus" data-toggle="modal" data-target="#ModalTambah">
                        Tambah Data
                    </button>
                    <a href="{{route('prodi_lihat_pendidikan_kurikulum')}}">
                        <button type="button" class="btn btn-primary fa fa-book">
                            Lihat Laporan
                        </button></a>
                </div>
            </div>
            <div class="card-body">
                <form class="form-inline">
                    <div class="form-group mx-sm-1 mb-2">
                        <!-- <label for="inputPassword2" class="sr-only">Password</label> -->
                        <input type="text" class="form-control" id="filter" name="filter" placeholder="Tahun" value="{{ old('filter') }}">
                    </div>
                    <button type="submit" class="btn btn-primary mb-2 fa fa-filter">Filter</button>
                </form><br>
                <div class="table-responsive">
                    <table id="dataTable" class="table table-hover">
                        <thead>
                            <tr>
                                <th rowspan="2" style="text-align: center; vertical-align: middle;">No</th>
                                <th rowspan="2" style="text-align: center; vertical-align: middle;">Semester</th>
                                <th rowspan="2" style="text-align: center; vertical-align: middle;">Kode Mata Kuliah</th>
                                <th rowspan="2" style="text-align: center; vertical-align: middle;">Nama Mata Kuliah</th>
                                <th rowspan="2" style="text-align: center; vertical-align: middle;">Mata Kuliah Kompetensi</th>
                                <th colspan="3" style="text-align: center; vertical-align: middle;">Bobot Kredit (sks)</th>
                                <th rowspan="2" style="text-align: center; vertical-align: middle;">Konversi kredit ke jam</th>
                                <th colspan="4" style="text-align: center; vertical-align: middle;">Capaian Pembelajaran</th>
                                <th rowspan="2" style="text-align: center; vertical-align: middle;">File Dokumen Rencana Pembelajaran</th>
                                <th rowspan="2" style="text-align: center; vertical-align: middle;">Link Dokumen Rencana Pembelajaran</th>
                                <th rowspan="2" style="text-align: center; vertical-align: middle;">Unit Penyelenggara</th>
                                <th rowspan="2" style="text-align: center; vertical-align: middle;">Tahun</th>
                                <th rowspan="2" style="text-align: center; vertical-align: middle;">Aksi</th>
                            </tr>
                            <tr>
                                <th style="text-align: center; vertical-align: middle;">Kuliah/ Responsi/ Tutorial</th>
                                <th style="text-align: center; vertical-align: middle;">Seminar</th>
                                <th style="text-align: center; vertical-align: middle;">Praktikum/ Praktik/ Praktik Lapangan</th>
                                <th style="text-align: center; vertical-align: middle;">Sikap</th>
                                <th style="text-align: center; vertical-align: middle;">Pengetahuan</th>
                                <th style="text-align: center; vertical-align: middle;">Keterampilan Umum</th>
                                <th style="text-align: center; vertical-align: middle;">Keterampilan Khusus</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>1</td>
                                <td>1</td>
                                <td>1</td>
                                <td>1</td>
                                <td>1</td>
                                <td>1</td>
                                <td>1</td>
                                <td>1</td>
                                <td>1</td>
                                <td>1</td>
                                <td>1</td>
                                <td>1</td>
                                <td>1</td>
                                <td>1</td>
                                <td>1</td>
                                <td>1</td>
                                <td>
                                    <a href="">
                                        <button class="btn-sm btn btn-warning fa fa-eye" title="Lihat"></button>
                                    </a>
                                    <a href="">
                                        <button class="btn-sm btn btn-success fa fa-edit" title="Edit"></button>
                                    </a>
                                    <a href="">
                                        <button class="btn-sm btn btn-danger fa fa-trash" title="Hapus"></button>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <b> Keterangan : </b><br>
                <p style="font-size: 10px;">
                    1. Data penggunaan dana yang dikelola oleh Unit Pengelola Program Studi (UPPS) dan data penggunaan dana yang dialokasikan ke Program Studi yang diakreditasi dalam 3 tahun terakhir.<br>
                    2. Tahun Akademik merupakan Tahun Akademik n tahun sebelum TS (TS-n) atau tahun akademik penuh terakhir saat Pengajuan usulan Akreditasi (TS).<br>
                    3. Unggah file dengan format (rar/zip) dan Link Drive bukti dokumen dalam 3 tahun terakhir yang terkait mengenai penggunaan dana
                </p>
            </div>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <b> Komentar : </b><br><br>
                <form method="post" action="{{route('kappm_komentar_add')}}" enctype="multipart/form-data">
                  {{csrf_field()}}
                  <textarea type="text" placeholder="Tulis Komentar...." class="form-control" id="isi_komentar" name="isi_komentar"></textarea> <br>
                  <button class="btn btn-primary" type="Submit">Submit</button>
              </form>
            </div>
        </div>
    </div>
</div>


<!-- modal -->
<div class="modal fade" id="ModalTambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Kurikulum, Capain Pembelajaran,dan Rencana Pembelajaran</h5>
               
            </div>
            <div class="modal-body">
                <form method="post" action="{{route('prodi_pendidikan_kurikulum_add')}}" enctype="multipart/form-data">

                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="judul">Semester</label>
                        <select type="text" class="form-control" id="semester" name="semester">
                            <option>Semester 1</option>
                            <option>Semester 2</option>
                            <option>Semester 3</option>
                            <option>Semester 4</option>
                            <option>Semester 5</option>
                            <option>Semester 6</option>
                            <option>Semester 7</option>
                            <option>Semester 8</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="judul">Kode Mata Kuliah</label>
                        <select type="text" class="form-control" id="kode_matakuliah" name="kode_matakuliah">
                            <option>1234</option>
                            <option>DLL (Bisa Mencari Kode)</option>

                        </select>
                    </div>

                    <div class="form-group">
                        <label for="judul">Nama Mata Kuliah</label>
                        <input type="text" readonly="" class="form-control" id="nama_matakuliah" name="nama_matakuliah" required="" placeholder="Muncul Otomatis Saat Kode matkul Dipilih" />
                    </div>

                    <div class="form-group">
                        <label for="judul">Mata Kuliah Kompetensi</label>
                        <br>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="matakuliah_kompetensimatakuliah_kompetensi" id="matakuliah_kompetensi" value="Ya">
                            <label class="form-check-label" for="inlineRadio1">Ya</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="matakuliah_kompetensi" id="matakuliah_kompetensi" value="Tidak">
                            <label class="form-check-label" for="inlineRadio2">Tidak</label>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="judul">Bobot Kredit (sks) pada Kuliah/Responsi/Tutorial</label>
                        <input type="text" class="form-control" id="bobot_kredit_kuliah" name="bobot_kredit_kuliah" required="" placeholder="Kuliah/Responsi/Tutorial" />
                    </div>

                    <div class="form-group">
                        <label for="judul">Bobot Kredit (sks) pada Seminar</label>
                        <input type="text" class="form-control" id="bobot_kredit_seminar" name="bobot_kredit_seminar" required="" placeholder="Seminar" />
                    </div>

                    <div class="form-group">
                        <label for="judul">Bobot Kredit (sks) pada Praktikum/Praktik/Praktik Lapangan</label>
                        <input type="text" class="form-control" id="bobot_kredit_praktikum" name="bobot_kredit_praktikum" required="" placeholder="Praktikum/Praktik/Praktik Lapangan" />
                    </div>

                    <div class="form-group">
                        <label for="judul">Konversi kredit ke jam</label>
                        <input type="text" class="form-control" id="konversi_kredit" name="konversi_kredit" required="" placeholder="" />
                    </div>

                    <div class="form-group">
                        <label for="judul">Capaian Pembelajaran (Centang Sesuai Rencana Pembelajaran)</label>
                        <br>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="sikap" id="sikap">
                            <label class="form-check-label" for="sikap">Sikap</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="pengetahuan" id="pengetahuan">
                            <label class="form-check-label" for="pengetahuan">Pengetahuan</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="keterampilan_umum" id="keterampilan_umum">
                            <label class="form-check-label" for="keterampilan_umum">Keterampilan Umum</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="keterampilan_khusus" id="keterampilan_khusus">
                            <label class="form-check-label" for="keterampilan_khusus">Keterampilan Khusus</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="judul">Unggah Dokumen Rencana Pembelajaran (opsional)</label>
                        <input type="file" class="form-control" id="file_dokumen_rencanaPembelajaran" name="file_dokumen_rencanaPembelajaran" />
                    </div>

                    <div class="form-group">
                        <label for="judul">Link Dokumen Rencana Pembelajaran (opsional)</label>
                        <input type="text" class="form-control" id="link_dokumen_rencanaPembelajaran" name="link_dokumen_rencanaPembelajaran" />
                    </div>

                    <div class="form-group">
                        <label for="judul">Unit Penyelenggara</label>
                        <input type="text" class="form-control" id="unit_penyelenggara" name="unit_penyelenggara" required="" placeholder="" />
                    </div>

                    <div class="form-group">
                        <label for="judul">Tahun</label>
                        <input type="text" class="form-control" id="tahun" name="tahun" required="" placeholder="" />
                    </div>

                    <div class="form-group">
                        <input type="hidden" class="form-control" id="id_user" name="id_user" value="{{ Auth::user()->id }}" />
                    </div>

                    <button class="btn btn-primary" type="Submit">Simpan</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>

            </div>
        </div>
    </div>
</div>

@endsection