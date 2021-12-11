@extends('layouts.lkps-master')

@section('title')
Dosen Tidak Tetap
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
                <h4>Data Dosen Tidak Tetap</h4>
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
            
                <div class="table-responsive">
                    <table id="dataTable" class="table table-hover">
                        <thead>
                            <tr>
                                <th style="text-align: center; vertical-align: middle;">No</th>
                                <th style="text-align: center; vertical-align: middle;">Nama Dosen</th>
                                <th style="text-align: center; vertical-align: middle;">NIDN/NIDK</th>
                                <th style="text-align: center; vertical-align: middle;">Pendidikan Pasca Sarjana</th>
                                <th style="text-align: center; vertical-align: middle;">Bidang Keahlian</th>
                                <th style="text-align: center; vertical-align: middle;">Jabatan Akademik</th>
                                <th style="text-align: center; vertical-align: middle;">File Sertifikat Pendidik Profesional</th>
                                <th style="text-align: center; vertical-align: middle;">Link Sertifikat Pendidik Profesional</th>
                                <th style="text-align: center; vertical-align: middle;">File Sertifikat Kompetensi/ Profesi/ Industri</th>
                                <th style="text-align: center; vertical-align: middle;">Link Sertifikat Kompetensi/ Profesi/ Industri</th>
                                <th style="text-align: center; vertical-align: middle;">Mata Kuliah yang Diampu Pada Program Studi yang Diakreditasi</th>
                                <th style="text-align: center; vertical-align: middle;">Kesesuaian Bidang Keahlian dengan Mata Kuliah yang Diampu</th>
                                <th style="text-align: center; vertical-align: middle;">File Bukti Dokumen</th>
                                <th style="text-align: center; vertical-align: middle;">Link Bukti Dokumen</th>
                                <th style="text-align: center; vertical-align: middle;">Tahun</th>
                            </tr>

                        </thead>
                        <tbody>
                            @php $no=1 @endphp
                            @foreach($dosen_tidak_tetap as $data)
                            <tr>
                                <td>{{$no++ }}</td>
                                <td>{{$data->nama_dosen }}</td>
                                <td>{{$data->nidn }}</td>
                                <td>{{$data->pendidikan_pasca_sarjana }}</td>
                                <td>{{$data->bidang_keahlian }}</td>
                                <td>{{$data->jabatan_akademik }}</td>
                                <td><a href="{{route('prodi-file_download_ser_pendidik_tidak_tetap',$data->id)}}"><button class="btn btn-info ">Download</button></a></td>
                                <td>{{$data->link_sertifikat_pendidik }}</td>
                                <td><a href="{{route('prodi-file_download_ser_kompetensi_tidak_tetap',$data->id)}}"><button class="btn btn-info ">Download</button></a></td>
                                <td>{{$data->link_sertifikat_kompetensi }}</td>
                                <td>{{$data->matakuliah_prodi_diakreditasi }}</td>
                                <td>{{$data->kesesuaian_bidang_keahlian }}</td>
                                <td><a href="{{route('prodi-file_download_bukti_dokumen_tidak_tetap',$data->id)}}"><button class="btn btn-info ">Download</button></a></td>
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
                    1. Data Dosen Tidak Tetap yang ditugaskan sebagai pengampu mata kuliah di Program Studi yang diakreditasi (DTT) pada saat
                    TS (Tahun Akademik penuh terakhir saat pengajuan usulan akreditasi) <br>
                    2. Unggah file dengan format (jpg/png/word/pdf/rar/zip) dan link drive bukti Sertifikat Pendidik Profesional <br>
                    3. Unggah file dengan format (jpg/png/word/pdf/rar/zip) dan link drive bukti Sertifikat Kompetensi/Profesi/Industri <br>
                    4. Unggah file dengan format (word/pdf/rar/zip) dan link drive bukti dokumen seperti : <br>
                    a. Dokumen Ijazah Dosen <br>
                    b. Surat Keputusan tentang Pengampu Mata Kuliah dan Beban Mengajar (Jumlah sks)
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




@endsection