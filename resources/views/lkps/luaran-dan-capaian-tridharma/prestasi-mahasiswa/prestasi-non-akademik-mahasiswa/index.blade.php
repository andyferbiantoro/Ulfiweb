@extends('layouts.lkps-master')

@section('title')
Data Prestasi non-Akademik Mahasiswa
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
                <h4 style="margin-right: 15%;">Data Prestasi non-Akademik Mahasiswa</h4><br>

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
                        <input type="text" class="form-control" id="filter" name="filter" placeholder="Tahun Perolehan"  value="{{ old('filter') }}">
                    </div>
                    <button type="submit" class="btn btn-primary mb-2 fa fa-filter">Filter</button>

                </form><br>
            </div><br>


                <div class="table-responsive">
                    <table id="dataTable" class="table table-hover">
                        <thead>
                            <tr>
                                <th style="text-align: center; vertical-align: middle;">No</th>
                                <th style="text-align: center; vertical-align: middle;">Nama Kegiatan</th>
                                <th style="text-align: center; vertical-align: middle;">Tahun Perolehan</th>
                                <th style="text-align: center; vertical-align: middle;">Tingkat</th>
                                <th style="text-align: center; vertical-align: middle;">Prestasi yang Dicapai</th>
                                <th style="text-align: center; vertical-align: middle;">File Bukti Dokumen</th>
                                <th style="text-align: center; vertical-align: middle;">Link Bukti Dokumen</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no=1 @endphp
                            @foreach($prestasi_non_akademik_mahasiswa as $data)
                            <tr>
                                <td>{{$no++ }}</td>
                                <td>{{$data->nama_kegiatan }}</td>
                                <td>{{$data->tahun_perolehan }}</td>
                                <td>{{$data->tingkat }}</td>
                                <td>{{$data->prestasi_dicapai }}</td>
                                <td><a href="{{route('prodi-file_download_dokumen_prestasi_non_akademik',$data->id)}}"><button class="btn btn-info ">Download</button></a></td>
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
                    1. Prestasi non-akademik yang dicapai mahasiswa Program Studi dalam 5 tahun terakhir <br>
                    2. Unggah File dengan Format (jpg/png/word/pdf/excel/rar/zip) dan Link Drive Bukti Dokumen seperti : <br>
                    a. Kebijakan mutu <br>
                    b. Manual mutu <br>
                    c. Standar mutu <br>
                    d. Buku pedoman pengembangan prestasi non-akademik mahasiswa <br>
                    e. Surat Keputusan tentang Pembina UKM <br>
                    f. Buku pedoman tentang PBAK (pengenalan budaya akademik kampus) <br>
                    g. Buku pedoman pembinaan organisasi kemahasiswa <br>
                    h. Dokumen pendukung seperti sertifikat/piagam penghargaan/piala/medali, foto kegiatan, laporan kegiatan dan daftar mahasiswa prestasi non-akademik
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