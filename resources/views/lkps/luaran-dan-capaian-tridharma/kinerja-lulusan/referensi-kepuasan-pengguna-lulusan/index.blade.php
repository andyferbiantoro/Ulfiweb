@extends('layouts.lkps-master')

@section('title')
Data Referensi Kepuasan Pengguna Lulusan
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
                <h4 style="margin-right: 45%;">Data Referensi Kepuasan Pengguna Lulusan</h4><br>

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
                                <th style="text-align: center; vertical-align: middle;">No</th>
                                <th style="text-align: center; vertical-align: middle;">Tahun Lulus</th>
                                <th style="text-align: center; vertical-align: middle;">Jumlah Lulus</th>
                                <th style="text-align: center; vertical-align: middle;">Jumlah Tanggapan Kepuasan Pengguna yang Terlacak</th>
                                <th style="text-align: center; vertical-align: middle;">File Bukti Dokumen</th>
                                <th style="text-align: center; vertical-align: middle;">Link Bukti Dokumen</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no=1 @endphp
                            @foreach($referensi_kepuasan_pengguna_lulusan as $data)
                            <tr>
                                <td style="text-align: center; vertical-align: middle;">{{$no++ }}</td>
                                <td style="text-align: center; vertical-align: middle;">{{$data->tahun_lulus }}</td>
                                <td style="text-align: center; vertical-align: middle;">{{$data->jumlah_lulusan }}</td>
                                <td style="text-align: center; vertical-align: middle;">{{$data->jumlah_tanggapan }}</td>
                                <td style="text-align: center; vertical-align: middle;"><a href="{{route('prodi-file_download_dokumen_referensi_kepuasan',$data->id)}}"><button class="btn btn-info ">Download</button></a></td>
                                <td style="text-align: center; vertical-align: middle;"><a href="{{$data->link_bukti_dokumen}}">{{$data->link_bukti_dokumen}}</a></td>
                                <!-- <td style="text-align: center; vertical-align: middle;">{{$data->link_bukti_dokumen }}</td> -->
                            </tr>
                            @endforeach
                        </tbody>
                        <thead>
                            @php $no=1 @endphp
                            @foreach($referensi_kepuasan_pengguna_lulusan as $data)
                            <tr>
                                <th colspan="2" style="text-align: center; vertical-align: middle;">Jumlah</th>
                                <th style="text-align: center; vertical-align: middle;">{{$data->tahun_lulus}}</th>
                                <th style="text-align: center; vertical-align: middle;">{{$data->jumlah_tang}}</th>
                                <th colspan="3" style="text-align: center; vertical-align: middle;"></th>
                            </tr>
                            @endforeach
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