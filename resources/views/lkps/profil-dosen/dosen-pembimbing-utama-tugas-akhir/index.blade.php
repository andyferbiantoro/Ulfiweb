@extends('layouts.lkps-master')

@section('title')
Dosen Pembimbing Utama Tugas Akhir
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
                <h4 style="margin-right: 45%;">Data Dosen Pembimbing Utama Tugas Akhir</h4>
                <div class="text-right">
                    <a href="{{route('lihat_profil_dosen_dosen_pembimbing_utama_tugas_akhir')}}">
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
            </div>
            <br>
            <div class="table-responsive">
                <table id="dataTable" class="table table-hover">
                    <thead>
                        <tr>
                            <th rowspan="3" style="text-align: center; vertical-align: middle;">No</th>
                            <th rowspan="3" style="text-align: center; vertical-align: middle;">Tahun Akademik</th>
                            <th rowspan="3" style="text-align: center; vertical-align: middle;">Nama Dosen</th>
                            <th colspan="8" style="text-align: center; vertical-align: middle;">Jumlah Mahasiswa yang Dibimbing</th>
                            <th rowspan="3" style="text-align: center; vertical-align: middle;">Rata-rata Jumlah Bimbingan di Semua Program/Semester</th>
                            <th rowspan="3" style="text-align: center; vertical-align: middle;">File Bukti Dokumen</th>
                            <th rowspan="3" style="text-align: center; vertical-align: middle;">Link Bukti Dokumen</th>
                        </tr>
                        <tr>
                            <th colspan="4" style="text-align: center; vertical-align: middle;">Pada Program Studi yang Diakreditasi</th>
                            <th colspan="4" style="text-align: center; vertical-align: middle;">Pada Program Studi Lain di Perguruan Tinggi</th>

                        </tr>
                        <tr>
                            <th style="text-align: center; vertical-align: middle;">TS-2</th>
                            <th style="text-align: center; vertical-align: middle;">TS-1</th>
                            <th style="text-align: center; vertical-align: middle;">TS</th>
                            <th style="text-align: center; vertical-align: middle;">Rata-rata</th>
                            <th style="text-align: center; vertical-align: middle;">TS-2</th>
                            <th style="text-align: center; vertical-align: middle;">TS-1</th>
                            <th style="text-align: center; vertical-align: middle;">TS</th>
                            <th style="text-align: center; vertical-align: middle;">Rata-rata</th>

                        </tr>
                    </thead>
                    <tbody>
                        @php $no=1 @endphp
                        @foreach($data_dospem_utama_tugasakhir as $data)
                        <tr>
                            <td>{{$no++}}</td>
                            <td>{{$data->tahun_akademik }}</td>
                            <td>{{$data->nama_dosen }}</td>
                            <td>{{$data->jumlahMahasiswa_prodiDiakreditasi_ts2 }}</td>
                            <td>{{$data->jumlahMahasiswa_prodiDiakreditasi_ts1 }}</td>
                            <td>{{$data->jumlahMahasiswa_prodiDiakreditasi_ts }}</td>
                            <td>{{$data->rata2_1}}</td>
                            <td>{{$data->jumlahMahasiswa_prodiLain_perguruanTinggi_ts2 }}</td>
                            <td>{{$data->jumlahMahasiswa_prodiLain_perguruanTinggi_ts1 }}</td>
                            <td>{{$data->jumlahMahasiswa_prodiLain_perguruanTinggi_ts}}</td>
                            <td>{{$data->rata2_2}}</td>
                            <td>{{$data->rata2_bimbingan}}</td>
                            <td><a href="{{route('prodi-file_download_bukti_dokumen_dospem',$data->id)}}"><button class="btn btn-info ">Download</button></a></td>
                            <td><a href="{{$data->link_bukti_dokumen}}">{{$data->link_bukti_dokumen}}</a></td>
                            
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
                        1. Tahun Akademik merupakan tahun akademik penuh terakhir saat pengajuan usulan akreditasi (TS)<br>
                        2. Data Dosen Pembimbing Utama kegiatan Tugas Akhir mahasiswa pada Program Studi yang Diakreditasi dan pada Program Studi Lain
                        di Perguruan Tinggi dalam 3 tahun terakhir <br>
                        3. Unggah file dengan format (word/pdf/excel/rar/zip) dan link drive bukti Dokumen dalam 3 tahun terakhir seperti : <br>
                        a. Surat Penugasan yang diterbitkan oleh Unit Pengelola Program Studi (UPPS) <br>
                        b Surat Keputusan tentang Pembimbing Tugas Akhir mahasiswa <br>
                        c. Daftar Dosen Pembimbing Utama Tugas Akhir
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