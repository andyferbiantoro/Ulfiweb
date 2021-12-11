@extends('layouts.lkps-master')

@section('title')
Produk/Jasa DTPS yang Diadopsi oleh Industri/Masyarakat
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
                <h4>Data Produk/Jasa DTPS yang Diadopsi oleh Industri/Masyarakat</h4>
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
                    <th style="text-align: center; vertical-align: middle;">Nama Produk/Jasa</th>
                    <th style="text-align: center; vertical-align: middle;">Deskripsi Produk/Jasa</th>
                    <th style="text-align: center; vertical-align: middle;">File Bukti</th>
                    <th style="text-align: center; vertical-align: middle;">Link Bukti</th>
                    <th style="text-align: center; vertical-align: middle;">Tahun</th>
                </tr>

            </thead>
            <tbody>
                @php $no=1 @endphp
                @foreach($produk_dtps as $data)
                <tr>
                    <td>{{$no++ }}</td>
                    <td>{{$data->nama_dosen }}</td>
                    <td>{{$data->nama_produk }}</td>
                    <td>{{$data->deskripsi_produk }}</td>
                    <td><a href="{{route('prodi-file_download_file_bukti_produk_dtps',$data->id)}}"><button class="btn btn-info ">Download</button></a></td>
                    <td><a href="{{$data->link_bukti}}">{{$data->link_bukti}}</a></td>
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
                    1. Nama Produk/Jasa karya DTPS yang diadopsi oleh industri/masyarakat dalam 3 tahun terakhir <br>
                    2. Jenis Produk/Jasa harus relevan dengan bidang Program Studi <br>
                3. Unggah file dengan format (jpg/png/word/pdf/rar/zip) dan link drive bukti Hak Paten </p>
            </div>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <b> Komentar : </b><br><br>
                <textarea type="text" placeholder="Tulis Komentar...." class="form-control" id="komentar" name="komentar"></textarea> <br>
                <button type="submit" class="btn btn-success">
                    Kirim
                </button>
            </div>
        </div>
    </div>
</div>




@endsection