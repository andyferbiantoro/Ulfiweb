@extends('layouts.lkps-master')

@section('title')
Data Tempat Kerja Lulusan
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
                <h4 style="margin-right: 57%;">Data Tempat Kerja Lulusann</h4><br>
                <div class=" text-right">
                    <a href="{{route('lihat_tempat_kerja_lulusan')}}">
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
                            <input type="text" class="form-control" id="filter" name="filter" placeholder="Tahun Lulus" value="{{ old('filter') }}">
                        </div>
                        <button type="submit" class="btn btn-primary mb-2 fa fa-filter">Filter</button>

                    </form><br>
                </div><br>

                <div class="table-responsive">
                    <table id="" class="table table-hover">
                        <thead>
                            <tr>
                                <th rowspan="2" style="text-align: center; vertical-align: middle;">No</th>
                                <th rowspan="2" style="text-align: center; vertical-align: middle;">Tahun Lulus</th>
                                <th rowspan="2" style="text-align: center; vertical-align: middle;">Jumlah Lulusan</th>
                                <th rowspan="2" style="text-align: center; vertical-align: middle;">Jumlah Lulusan yang Terlacak</th>
                                <th colspan="3" style="text-align: center; vertical-align: middle;">Jumlah Lulusan Terlacak yang Bekerja Berdasarkan Tingkat/ Ukuran Tempat Kerja/ Berwirausaha</th>
                                <th rowspan="2" style="text-align: center; vertical-align: middle;">File Bukti Dokumen</th>
                                <th rowspan="2" style="text-align: center; vertical-align: middle;">Link Bukti Dokumen</th>
                            </tr>
                            <tr>
                                <th style="text-align: center; vertical-align: middle;">Lokal/ Wilayah/ Berwirausaha tidak Berbadan Hukum</th>
                                <th style="text-align: center; vertical-align: middle;">Nasional/ Berwirausaha Berbadan Hukum</th>
                                <th style="text-align: center; vertical-align: middle;">Multinasional/ Internasinal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no=1 @endphp
                            @foreach($tempat_kerja_lulusan as $data)
                            <tr>
                                <td style="text-align: center; vertical-align: middle;">{{$no++ }}</td>
                                <td style="text-align: center; vertical-align: middle;">{{$data->tahun_lulus }}</td>
                                <td style="text-align: center; vertical-align: middle;">{{$data->jumlah_lulusan }}</td>
                                <td style="text-align: center; vertical-align: middle;">{{$data->jumlah_lulusan_terlacak }}</td>
                                <td style="text-align: center; vertical-align: middle;">{{$data->jumlah_lulusan_lokal }}</td>
                                <td style="text-align: center; vertical-align: middle;">{{$data->jumlah_lulusan_nasional }}</td>
                                <td style="text-align: center; vertical-align: middle;">{{$data->jumlah_lulusan_multinasional }}</td>
                                <td style="text-align: center; vertical-align: middle;"><a href="{{route('prodi-file_download_dokumen_tempat_kerja_lulusan',$data->id)}}"><button class="btn btn-info ">Download</button></a></td>
                                <td style="text-align: center; vertical-align: middle;"><a href="{{$data->link_bukti_dokumen}}">{{$data->link_bukti_dokumen}}</a></td>
                                <!-- <td style="text-align: center; vertical-align: middle;">{{$data->link_bukti_dokumen }}</td> -->
                            </tr>
                            @endforeach
                        </tbody>
                        <thead>
                            <tr>
                                <th colspan="2" style="text-align: center; vertical-align: middle;">Jumlah</th>
                                <th style="text-align: center; vertical-align: middle;">{{$jumlah_lulusan}}</th>
                                <th style="text-align: center; vertical-align: middle;">{{$jumlah_lulusan_terlacak }}</th>
                                <th style="text-align: center; vertical-align: middle;">{{$jumlah_lulusan_lokal }}</th>
                                <th style="text-align: center; vertical-align: middle;">{{$jumlah_lulusan_nasional }}</th>
                                <th style="text-align: center; vertical-align: middle;">{{$jumlah_lulusan_multinasional }}</th>
                                <th colspan="3" style="text-align: center; vertical-align: middle;"></th>
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