@extends('layouts.lkps-master')

@section('title')
Pengakuan / Rekognisi DTPS
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
                <h4>Data Pengakuan / Rekognisi DTPS</h4>
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
                                <th style="text-align: center; vertical-align: middle;">Bidang Keahlian</th>
                                <th style="text-align: center; vertical-align: middle;">File Rekognisi dan Bukti Pendukung</th>
                                <th style="text-align: center; vertical-align: middle;">Link Rekognisi dan Bukti Pendukung</th>
                                <th style="text-align: center; vertical-align: middle;">Tingkat</th>
                                <th style="text-align: center; vertical-align: middle;">Tahun</th>
                            </tr>

                        </thead>
                        <tbody>
                            @php $no=1 @endphp
                            @foreach($pengakuan_dtps as $data)
                            <tr>
                                <td>{{$no++ }}</td>
                                <td>{{$data->nama_dosen }}</td>
                                <td>{{$data->bidang_keahlian }}</td>
                                <td><a href="{{route('prodi-file_download_bukti_pendukung',$data->id)}}"><button class="btn btn-info ">Download</button></a></td>
                                <td><a href="{{$data->link_rekognisi_buktiPendukung}}">{{$data->link_rekognisi_buktiPendukung}}</a></td>
                                <td>{{$data->tingkat }}</td>
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
                    1. Pengajuan/Rekognisi atas kepakaran/prestasi/kinerja DTPS yang diterima dalam 3 tahun terakhir <br>
                    2. Unggah file dengan format (jpg/png/word/pdf/rar/zip) dan link (Link Jurnal atau Link Drive) Rekognisi atau Bukti Pengakuan atas kepakaran/prestasi/kinerja dapat berupa : <br>
                    a. Menjadi visiting lecturer atau visiting scholar di Program Studi/ Perguruan Tinggi terakreditasi A atau Program Studi
                    /Perguruan Tinggi Internasional bereputasi. <br>
                    b. Menjadi keynote speaker/invited speaker pada pertemuan ilmiah tingkat Nasional/Internasional. <br>
                    c. Menjadi editor atau mitra bestari pada jurnal Nasional terakreditasi/jurnal Internasional bereputasi di bidang yang sesuai dengan bidang Program Studi. <br>
                    d. Menjadi tenaga ahli/konsultan di lembaga/industri tingkat Wilayah/Nasional/Internasional pada bidang yang sesuai dengan bidang Program Studi. <br>
                    e. Mendapat penghargaan atas prestasi dan kinerja di tingkat Wilayah/Nasional/Internasional
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




@endsection