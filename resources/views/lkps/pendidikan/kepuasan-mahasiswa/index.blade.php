@extends('layouts.lkps-master')

@section('title')
Data Kepuasan Mahasiswa
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
                <h4 style="margin-right: 60%;">Data Kepuasan Mahasiswa</h4>
                <div class=" text-right">
                    <a href="{{route('lihat_pendidikan_kepuasan_mahasiswa')}}">
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
                            <input type="text" class="form-control" id="filter" name="filter" placeholder="Tahun Akademik" value="{{ old('filter') }}">
                        </div>
                        <button type="submit" class="btn btn-primary mb-2 fa fa-filter">Filter</button>

                    </form><br>
                </div>

                <div class="table-responsive">
                    <table id="" class="table table-hover">
                        <thead>
                            <tr>
                                <th rowspan="2" style="text-align: center; vertical-align: middle;">No</th>
                                <th rowspan="2" style="text-align: center; vertical-align: middle;">Aspek yang Diukur</th>
                                <th colspan="4" style="text-align: center; vertical-align: middle;">Tingkat Kepuasan Mahasiswa</th>
                                <th rowspan="2" style="text-align: center; vertical-align: middle;">Rencana Tindak Lanjut oleh UPPS/PS</th>
                                <th rowspan="2" style="text-align: center; vertical-align: middle;">File Bukti Dokumen</th>
                                <th rowspan="2" style="text-align: center; vertical-align: middle;">Link Bukti Dokumen</th>
                                <th rowspan="2" style="text-align: center; vertical-align: middle;">Tahun</th>
                                <th rowspan="2" style="text-align: center; vertical-align: middle;">Aksi</th>
                            </tr>
                            <tr>
                                <th style="text-align: center; vertical-align: middle;">Sangat Baik</th>
                                <th style="text-align: center; vertical-align: middle;">Baik</th>
                                <th style="text-align: center; vertical-align: middle;">Cukup</th>
                                <th style="text-align: center; vertical-align: middle;">Kurang</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no=1 @endphp
                            @foreach($data_kepuasan_mahasiswa as $data)
                            <tr>
                                <td style="text-align: center; vertical-align: middle;">{{$no++ }}</td>
                                <td style="text-align: center; vertical-align: middle;">{{$data->aspek_diukir }}</td>
                                <td style="text-align: center; vertical-align: middle;">{{$data->tingkat_kepuasanMahasiswa_sangatBaik }}</td>
                                <td style="text-align: center; vertical-align: middle;">{{$data->tingkat_kepuasanMahasiswa_baik }}</td>
                                <td style="text-align: center; vertical-align: middle;">{{$data->tingkat_kepuasanMahasiswa_cukup }}</td>
                                <td style="text-align: center; vertical-align: middle;">{{$data->tingkat_kepuasanMahasiswa_kurang }}</td>
                                <td style="text-align: center; vertical-align: middle;">{{$data->rencana_tindak_lanjut }}</td>
                                <td style="text-align: center; vertical-align: middle;"><a href="{{route('prodi-file_download_dokumen_kepuasan_mhs',$data->id)}}"><button class="btn btn-info ">Download</button></a></td>
                                <td style="text-align: center; vertical-align: middle;"><a href="{{$data->link_bukti_dokumen}}">{{$data->link_bukti_dokumen}}</a></td>
                                <td style="text-align: center; vertical-align: middle;">{{$data->tahun }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <thead>
                            <tr>
                                <th colspan="2" style="text-align: center; vertical-align: middle;">Jumlah</th>
                                <th style="text-align: center; vertical-align: middle;">1</th>
                                <th style="text-align: center; vertical-align: middle;">1</th>
                                <th style="text-align: center; vertical-align: middle;">1</th>
                                <th style="text-align: center; vertical-align: middle;">1</th>
                                <th colspan="5" style="text-align: center; vertical-align: middle;"></th>
                            </tr>
                        </thead>
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
                    1. Hasil pengukuran kepuasan Mahasiswa terhadap proses pendidikan <br>
                    2. Data diambil dari hasil studi penelusuran yang dilakukan pada saat TS (Tahun Akademik Penuh terakhir saat pengajuan usulan akreditasi) <br>
                    3. Unggah file dengan format (word/pdf/excel/rar/zip) dan Link Drive Bukti dokumen seperti : <br>
                    a. Buku pedoman survei kepuasan mahasiswa <br>
                    b. Laporan survei kepuasan mahasiswa <br>
                    c. Respon kepuasan mahasiswa <br>
                    d. Rekapitulasi data kepuasan mahasiswa <br>
                    e. Kuisioner kepuasan mahasiswa
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