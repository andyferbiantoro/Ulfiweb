@extends('layouts.lkps-master')

@section('title')
Pagelaran/Pameran/Presentasi/Publikasi Ilmiah DTPS
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
                <h4 style="margin-right: 32%;">Data Pagelaran/Pameran/Presentasi/Publikasi Ilmiah DTPS</h4>
                <div class=" text-right">
                    <a href="{{route('lihat_kinerja_dosen_pagelaran_pameran_prestasi_publikasi_ilmiah_dtps')}}">
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
                            <input type="text" class="form-control" id="filter" name="filter" placeholder="Tahun" value="{{ old('filter') }}">
                        </div>
                        <button type="submit" class="btn btn-primary mb-2 fa fa-filter">Filter</button>

                    </form><br>
                </div>
                <form class="form-inline">
                    <div class="form-group mx-sm-1 mb-2">
                        <!-- <label for="inputPassword2" class="sr-only">Password</label> -->
                        <input type="text" class="form-control" name="th_ak" id="th_ak" placeholder="Tahun">
                    </div>
                    <button type="submit" class="btn btn-primary mb-2 fa fa-filter">Filter</button>
                </form><br>
                <div class="table-responsive">
                    <table id="" class="table table-hover">
                        <thead>
                            <tr>
                                <th rowspan="2" style="text-align: center; vertical-align: middle;">No</th>
                                <th rowspan="2" style="text-align: center; vertical-align: middle;">Jenis Publikasi</th>
                                <th colspan="3" style="text-align: center; vertical-align: middle;">Jumlah Judul</th>
                                <th rowspan="2" style="text-align: center; vertical-align: middle;">Jumlah</th>
                                <th rowspan="2" style="text-align: center; vertical-align: middle;">Tahun Akademik</th>
                                <th rowspan="2" style="text-align: center; vertical-align: middle;">File Bukti Dokumen</th>
                                <th rowspan="2" style="text-align: center; vertical-align: middle;">Link Bukti Dokumen</th>
                            </tr>
                            <tr>
                                <th style="text-align: center; vertical-align: middle;">TS-2</th>
                                <th style="text-align: center; vertical-align: middle;">TS-1</th>
                                <th style="text-align: center; vertical-align: middle;">TS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no=1 @endphp
                            @foreach($data_ilmiah_dtps as $data)
                            <tr>
                                <td style="text-align: center; vertical-align: middle;">{{$no++ }}</td>
                                <td style="text-align: center; vertical-align: middle;">{{$data->jenis_publikasi }}</td>
                                <td style="text-align: center; vertical-align: middle;">{{$data->jumlah_judul_ts2 }}</td>
                                <td style="text-align: center; vertical-align: middle;">{{$data->jumlah_judul_ts1 }}</td>
                                <td style="text-align: center; vertical-align: middle;">{{$data->jumlah_judul_ts }}</td>
                                <td style="text-align: center; vertical-align: middle;">{{$data->jumlah }}</td>
                                <td style="text-align: center; vertical-align: middle;">{{$data->tahun_akademik }}</td>
                                <td style="text-align: center; vertical-align: middle;"><a href="{{route('prodi-file_download_file_bukti_dokumen_ilmiah_pkm',$data->id)}}"><button class="btn btn-info ">Download</button></a></td>
                                <td><a href="{{$data->link_bukti_dokumen}}">{{$data->link_bukti_dokumen}}</a></td>
                            </tr>
                            @endforeach
                            </tr>
                        </tbody>
                        <thead>
                            <tr>
                                <th colspan="2" style="text-align: center; vertical-align: middle;">Jumlah</th>
                                <th style="text-align: center; vertical-align: middle;">{{$jumlahts2}}</th>
                                <th style="text-align: center; vertical-align: middle;">{{$jumlahts1}}</th>
                                <th style="text-align: center; vertical-align: middle;">{{$jumlahts}}</th>
                                <th style="text-align: center; vertical-align: middle;">{{$jumlah_all}}</th>
                                <th colspan="4" style="text-align: center; vertical-align: middle;"></th>
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
                    1. Tahun Akademik merupakan Tahun Akademik Penuh Terakhir saat Pengajuan usulan Akreditasi (TS).<br>
                    2. Jumlah pagelaran/pameran/presentasi/publikasi ilmiah dengan tema yang relevan dengan bidang
                    Program Studi, yang dihasilkan oleh DTPS dalam 3 tahun terakhir <br>
                    3. Unggah file dengan format (jpg/png/word/pdf/excel/rar/zip) dan link (Link Jurnal atau Link Drive) bukti dokumen dalam 3 tahun terakhir seperti : <br>
                    a. Jurnal/ Artikel/ Bukti Sitasi <br>
                    b. Database Karya Ilmiah Dosen <br>
                    c. Litapdimas (Penelitian, Publikasi Ilmiah, dan Pengabdian kepada Masyarakat) <br>
                    d. Sertifikat Publikasi
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