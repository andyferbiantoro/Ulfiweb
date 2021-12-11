@extends('layouts.lkps-master')

@section('title')
Data Masa Studi Lulusan pada Program Sarjana Terapan
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
                <h4 style="margin-right: 33%;">Data Masa Studi Lulusan pada Program Sarjana Terapan</h4><br>
                <div class=" text-right">
                    <a href="{{route('lihat_masa_studi_lulusan_program_sarjana_terapan')}}">
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
                        <input type="text" class="form-control" id="filter" name="filter" placeholder="Tahun Masuk"  value="{{ old('filter') }}">
                    </div>
                    <button type="submit" class="btn btn-primary mb-2 fa fa-filter">Filter</button>

                </form><br>
            </div><br>

                <div class="table-responsive">
                    <table id="dataTable" class="table table-hover">
                        <thead>
                            <tr>
                                <th rowspan="2" style="text-align: center; vertical-align: middle;">No</th>
                                <th rowspan="2" style="text-align: center; vertical-align: middle;">Tahun Masuk</th>
                                <th rowspan="2" style="text-align: center; vertical-align: middle;">Jumlah Mahasiswa Diterima</th>
                                <th colspan="7" style="text-align: center; vertical-align: middle;">Jumlah Mahasiswa yang Lulus pada</th>
                                <th rowspan="2" style="text-align: center; vertical-align: middle;">Jumlah Luusan sampai dengan Akhir TS</th>
                                <th rowspan="2" style="text-align: center; vertical-align: middle;">Rata-rata Masa Studi</th>
                                <th rowspan="2" style="text-align: center; vertical-align: middle;">File Bukti Dokumen</th>
                                <th rowspan="2" style="text-align: center; vertical-align: middle;">Link Bukti Dokumen</th>
                            </tr>
                            <tr>
                                <th style="text-align: center; vertical-align: middle;">Akhir TS-6</th>
                                <th style="text-align: center; vertical-align: middle;">Akhir TS-5</th>
                                <th style="text-align: center; vertical-align: middle;">Akhir TS-4</th>
                                <th style="text-align: center; vertical-align: middle;">Akhir TS-3</th>
                                <th style="text-align: center; vertical-align: middle;">Akhir TS-2</th>
                                <th style="text-align: center; vertical-align: middle;">Akhir TS-1</th>
                                <th style="text-align: center; vertical-align: middle;">Akhir TS</th>

                            </tr>
                        </thead>
                        <tbody>
                             @php $no=1 @endphp
                            @foreach($masastudi_lulusan_sarajana_terapan as $data)
                            <tr>
                                <td>{{$no++ }}</td>
                                <td>{{$data->tahun_masuk }}</td>
                                <td>{{$data->jumlah_mahasiswa_diterima }}</td>
                                <td>{{$data->jumlah_mahasiswaLulus_akhirTs6 }}</td>
                                <td>{{$data->jumlah_mahasiswaLulus_akhirTs5 }}</td>
                                <td>{{$data->jumlah_mahasiswaLulus_akhirTs4 }}</td>
                                <td>{{$data->jumlah_mahasiswaLulus_akhirTs3 }}</td>
                                <td>{{$data->jumlah_mahasiswaLulus_akhirTs4 }}</td>
                                <td>{{$data->jumlah_mahasiswaLulus_akhirTs1 }}</td>
                                <td>{{$data->jumlah_mahasiswaLulus_akhirTs }}</td>
                                <td>{{$data->jumlah_mhs }}</td>
                                <td>{{$data->rataRata_masa_studi }}</td>
                                <td><a href="{{route('prodi-file_download_dokumen_masastudi_sarajana_terapan',$data->id)}}"><button class="btn btn-info ">Download</button></a></td>
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