@extends('layouts.lkps-master')

@section('title')
Data Produk/Jasa Mahasiswa yang Diadopsi oleh Industri/Masyarakat
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
                <h4 style="margin-right: 25%;">Data Produk/Jasa Mahasiswa yang Diadopsi oleh Industri/Masyarakat</h4><br>
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
            </div><br>

                <div class="table-responsive">
                    <table id="dataTable" class="table table-hover">
                        <thead>
                            <tr>
                                <th style="text-align: center; vertical-align: middle;">No</th>
                                <th style="text-align: center; vertical-align: middle;">Nama Mahasiswa</th>
                                <th style="text-align: center; vertical-align: middle;">Nama Produk/Jasa</th>
                                <th style="text-align: center; vertical-align: middle;">Deskripsi Produk/Jasa</th>
                                <th style="text-align: center; vertical-align: middle;">File Bukti</th>
                                <th style="text-align: center; vertical-align: middle;">Link Bukti</th>
                                <th style="text-align: center; vertical-align: middle;">Tahun</th>
                            </tr>

                        </thead>
                        <tbody>
                         @php $no=1 @endphp
                         @foreach($produk_jasa_mahasiswa as $data)
                         <tr>
                            <td>{{$no++}}</td>
                            <td>{{$data->nama_mahasiswa}}</td>
                            <td>{{$data->nama_produk}}</td>
                            <td>{{$data->deskripsi_produk}}</td>
                            <td><a href="{{route('prodi-file_download_dokumen_produk_jasa_mahasiswa',$data->id)}}"><button class="btn btn-info ">Download</button></a></td>
                            <td>{{$data->link_bukti}}</td>
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