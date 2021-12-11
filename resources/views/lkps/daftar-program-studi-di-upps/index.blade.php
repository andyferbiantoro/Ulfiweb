@extends('layouts.lkps-master')

@section('title')
Daftar Program Studi di UPPS
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
        <h4>Data Daftar Program Studi di UPPS</h4>
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
                <th style="text-align: center; vertical-align: middle;">Jenis Program</th>
                <th style="text-align: center; vertical-align: middle;">Nama Program Studi</th>
                <th style="text-align: center; vertical-align: middle;">Status/Peringkat</th>
                <th style="text-align: center; vertical-align: middle;">Nomor & Tanggal SK</th>
                <th style="text-align: center; vertical-align: middle;">Tanggal Kadaluarsa</th>
                <th style="text-align: center; vertical-align: middle;">Jumlah Mahasiswa Saat TS</th>
                <th style="text-align: center; vertical-align: middle;">File Bukti Salinan Surat Keputusan</th>
                <th style="text-align: center; vertical-align: middle;">Link Bukti Salinan Surat Keputusan</th>
                <th style="text-align: center; vertical-align: middle;">Tahun</th>
              </tr>
            </thead>
            <tbody>
              @php $no=1 @endphp
            @foreach($daftar_prodi_upps as $data)
            <tr>
              <td>{{$no++ }}</td>
              <td>{{$data->jenis_program }}</td>
              <td>{{$data->nama_prodi }}</td>
              <td>{{$data->peringkat_akreditasi }}</td>
              <td>{{$data->nomor_tanggal_sk }}</td>
              <td>{{$data->tanggal_kadaluarsa }}</td>
              <td>{{$data->jumlah_mahasiswa }}</td>
              <td><a href="{{route('prodi-file_download_upps',$data->id)}}"><button class="btn btn-info ">Download</button></a></td>
              <td><a href="{{$data->link_surat_keputusan}}">{{$data->link_surat_keputusan}}</a></td>
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
        <b>Keterangan : </b><br>
        <p style="font-size: 10px;">
          1. Jumlah Mahasiswa saat TS merupakan Jumlah Mahasiswa Aktif di masing-masing Program Studi Saat TS (Tahun Akademik
          Penuh Terakhir saat Pengajuan usulan Akreditasi).
          <br>
          2. Unggah File dengan Format (rar/zip) dan Link Drive Salinan Surat Keputusan seperti : <br>
          a. Salinan Surat Keputusan Pendirian Perguruan Tinggi. <br>
          b. Salinan Surat Keputusan Pembukaan Program Studi. <br>
          c. Salinan Surat Keputusan Akreditasi Program Studi Terbaru.
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