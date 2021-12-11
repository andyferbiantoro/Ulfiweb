@extends('layouts.lkps-master')

@section('title')
Data Penelitian DTPS yang Melibatkan Mahasiswa
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
                <h4 style="margin-right: 40%;">Data Penelitian DTPS yang Melibatkan Mahasiswa</h4><br>

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
                        <input type="text" class="form-control" id="filter" name="filter" placeholder="Tahun Akademik"  value="{{ old('filter') }}">
                    </div>
                    <button type="submit" class="btn btn-primary mb-2 fa fa-filter">Filter</button>

                </form><br>
            </div>

                <div class="table-responsive">
                    <table id="dataTable" class="table table-hover">
                        <thead>
                            <tr>
                                <th style="text-align: center; vertical-align: middle;">No</th>
                                <th style="text-align: center; vertical-align: middle;">Nama Dosen</th>
                                <th style="text-align: center; vertical-align: middle;">Tema Penelitian sesuai Roadmap</th>
                                <th style="text-align: center; vertical-align: middle;">Nama Mahasiswa</th>
                                <th style="text-align: center; vertical-align: middle;">Judul Kegiatan</th>
                                <th style="text-align: center; vertical-align: middle;">Tahun</th>
                                <th style="text-align: center; vertical-align: middle;">File Bukti Dokumen</th>
                                <th style="text-align: center; vertical-align: middle;">Link Bukti Dokumen</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no=1 @endphp
                            @foreach($penelitian_dtps_mahasiswa as $data)
                            <tr>
                                <td>{{$no++}}</td>
                                <td>{{$data->nama_dosen}}</td>
                                <td>{{$data->tema_penelitian}}</td>
                                <td>{{$data->nama_mahasiswa}}</td>
                                <td>{{$data->judul_kegiatan}}</td>
                                <td>{{$data->tahun}}</td>
                                <td><a href="{{route('prodi-file_download_dokumen_penelitian_mhs',$data->id)}}"><button class="btn btn-info ">Download</button></a></td>
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
                    1. Form Penelitian DTPS yang melibatkan mahasiswa diisi oleh pengusul dari Program Studi pada Program Sarjana Terapan <br>
                    2. Data penelitian DTPS yang dalam pelaksanaannya melibatkan mahasiswa Program Studi pada TS-2 (tahun akademik n tahun sebelum TS) sampai dengan TS (tahun akademik penuh terakhir saat pengajuan usulan akreditasi) <br>
                    3. Judul kegiatan yang melibatkan mahasiswa dalam penelitian dosen dapat berupa tugas akhir, perancangan, pengembangan produk/jasa, atau kegiatan lain yang relevan 4. Unggah File dengan Format (word/pdf/excel/rar/zip) dan Link Drive Bukti Dokumen seperti : <br>
                    a. Surat Keputusan Penelitian DTPS yang melibatkan mahasiswa tahun TS-2 sampai TS <br>
                    b. Daftarjudul Penelitian DTPS yang melibatkan mahasiswa tahun TS-2 sampai TS <br>
                    c. Surat Keputusan pembimbing tugas akhir, perancangan, atau kegiatan lain yang relevan. <br>
                    d. Daftarjudul tugas akhir seperti tugas akhir (skripsi, tesis, dan disertasi), perancangan, pengembangan produk/jasa, atau kegiatan lain yang relevan. <br>
                    e. Laporan Penelitian DTPS yang melibatkan mahasiswa. <br>
                    f. Laporan monitoring dan evaluasi penelitian <br>
                    g. Dokumen pendukung seperti Surat Keputusan Unit Pengelola Program Studi (UPPS) tentang Penelitian DTPS yang melibatkan mahasiswa tahun TS-2 sampai TS, surat tugas penelitian, daftar hadir dan daftar penerima pendanaan penelitian
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