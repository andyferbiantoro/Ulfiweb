@extends('layouts.lkps-master')

@section('title')
EWMP Dosen Tetap Perguruan Tinggi
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
                <h4 style="margin-right: 45%;">Data EWMP Dosen Tetap Perguruan Tinggi</h4>
                <div class="text-right">
                    <a href="{{route('lihat_profil_dosen_ewmp_dosen_tetap_perguruan_tinggi')}}">
                        <button type="button" class="btn btn-primary fa fa-book">
                            Lihat Laporan
                        </button></a>
                </div>
            </div>
            <div class="card-body">
                <div class="text-right">
                        <form class="form-inline">
                          <div class="form-group mx-sm-1 mb-2">
                            <!-- <label for="inputPassword2" class="sr-only">Password</label> -->

                            <!-- Filter Prodi -->
                            <div class="form-group">
                              <select type="text" class="form-control" id="filter_prodi" name="filter_prodi" required="">
                                <option selected disabled value=""> -- Pilih Program Studi -- </option>
                                @foreach($prodi as $prodi)
                                <option value="{{$prodi->id}}" @if($prodi->id == $prod) {{'selected="selected"'}} @endif>{{$prodi->nama_prodi}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mb-2 fa fa-filter">Filter Prodi</button>

                    <!-- filter tahun -->
                    <div class="form-group mx-sm-1 mb-2">
                        <!-- <label for="inputPassword2" class="sr-only">Password</label> -->
                        <input type="text" class="form-control" id="filter" name="filter" placeholder="Tahun"  value="{{ old('filter') }}">
                    </div>
                    <button type="submit" class="btn btn-primary mb-2 fa fa-filter">Filter</button>

                </form><br>
            </div><br>
                <div class="table-responsive">
                    <table id="dataTable" class="table table-hover">
                        <thead>
                            <tr>
                                <th rowspan="3" style="text-align: center; vertical-align: middle;">No</th>
                                <th rowspan="3" style="text-align: center; vertical-align: middle;">Nama Dosen (DT)</th>
                                <th rowspan="3" style="text-align: center; vertical-align: middle;">DTPS</th>
                                <th colspan="6" style="text-align: center; vertical-align: middle;">Ekuivalen Waktu Mengajar Penuh (EWMP) pada saat TS dalam satuan kredit semester (sks)</th>
                                <th rowspan="3" style="text-align: center; vertical-align: middle;">Jumlah (sks)</th>
                                <th rowspan="3" style="text-align: center; vertical-align: middle;">Rata-rata per Semester (sks)</th>
                                <th rowspan="3" style="text-align: center; vertical-align: middle;">File Bukti Dokumen</th>
                                <th rowspan="3" style="text-align: center; vertical-align: middle;">Link Bukti Dokumen</th>
                                <th rowspan="3" style="text-align: center; vertical-align: middle;">Tahun</th>
                            </tr>
                            <tr>
                                <th colspan="3" style="text-align: center; vertical-align: middle;">Pendidikan : Pembelajaran dan Pembimbingan</th>
                                <th rowspan="2" style="text-align: center; vertical-align: middle;">Penelitian</th>
                                <th rowspan="2" style="text-align: center; vertical-align: middle;">Pengabdian kepada Masyarakat</th>
                                <th rowspan="2" style="text-align: center; vertical-align: middle;">Tugas Tambahan dan Penunjang</th>

                            </tr>
                            <tr>
                                <th style="text-align: center; vertical-align: middle;">Program Studi yang Diakreditasi</th>
                                <th style="text-align: center; vertical-align: middle;">Program Studi Lain di Dalam Perguruan Tinggi</th>
                                <th style="text-align: center; vertical-align: middle;">Program Studi Lain di Luar Perguruan Tingi</th>
                            </tr>
                        </thead>
                        <tbody>
                           @php $no=1 @endphp
                               @foreach($data_ewmp_dosen as $data)
                               <tr>
                                <td>{{$no++ }}</td>
                                <td>{{$data->nama_dosen }}</td>
                                <td>{{$data->dtps }}</td>
                                <td>{{$data->ewmp_pendidikanProdi_diakreditasi }}</td>
                                <td>{{$data->ewmp_pendidikanProdiLain_didalamPerguruanTinggi }}</td>
                                <td>{{$data->ewmp_pendidikanProdiLain_diluarPerguruanTinggi }}</td>
                                <td>{{$data->ewmp_penelitian }}</td>
                                <td>{{$data->ewmp_pkm }}</td>
                                <td>{{$data->ewmp_tugas_tambahan }}</td>
                                <td>{{$data->jumlah_sks }}</td>
                                <td>{{$data->rata2_per_semester }}</td>
                                <td><a href="{{route('prodi-file_download_bukti_dokumen_ewmp',$data->id)}}"><button class="btn btn-info ">Download</button></a></td>
                                <td><a href="{{$data->link_bukti_dokumen}}">{{$data->link_bukti_dokumen}}</a></td>
                                <td>{{$data->tahun }}</td>
                               
                            </tr>
                            @endforeach
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
                    1. DTPS merupakan Dosen Tetap Perguruan Tinggi yang ditugaskan sebagai pengampu mata kuliah dengan bidang keahlian yanag sesuai dengan kompetensi inti Program Studi yang diakreditasi<br>
                    2. Data Ekuivalen Waktu Mengajar Penuh (EWMP) dari Dosen Tetap Perguruan Tinggi yang ditugaskan di Program Studi yang Diakreditasi (DT)
                    pada saat TS (Tahun akademik penuh terakhir saat pengajuan usulan akreditasi) <br>
                    3. Unggah file dengan format (word/pdf/rar/zip) dan link drive bukti dokumen seperti : <br>
                    a. Rencana Beban Kerja Dosen (BKD) <br>
                    b. Laporan Kinerja Dosen <br>
                    c. Surat Keputusan tentang Pengampu Mata Kuliah dan Beban Mengajar (Jumlah sks)
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


@endsection