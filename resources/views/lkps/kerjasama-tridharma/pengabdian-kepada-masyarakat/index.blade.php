@extends('layouts.lkps-master')

@section('title')
Pengabdian Kepada Masyarakat
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
        <h4>Data Pengabdian Kepada Masyarakat</h4>
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
                <th style="text-align: center; vertical-align: middle;">Lembaga Mitra</th>
                <th style="text-align: center; vertical-align: middle;">Tingkat</th>
                <th style="text-align: center; vertical-align: middle;">Judul Kegiatan Kerjasama</th>
                <th style="text-align: center; vertical-align: middle;">Manfaat Bagi Program Studi yang Diakreditasi</th>
                <th style="text-align: center; vertical-align: middle;">Waktu dan Durasi</th>
                <th style="text-align: center; vertical-align: middle;">File Bukti Kerjasama</th>
                <th style="text-align: center; vertical-align: middle;">Link Bukti Kerjasama</th>
                <th style="text-align: center; vertical-align: middle;">Tahun Berakhirnya Kerjsama</th>
              </tr>

            </thead>
            <tbody>
              @php $no=1 @endphp
              @foreach($tridharma_pkm as $data)
              <tr>
                <td>{{$no++}}</td>
                <td>{{$data->lembaga_mitra }}</td>
                <td>{{$data->tingkat }}</td>
                <td>{{$data->judul_kegiatan }}</td>
                <td>{{$data->manfaat }}</td>
                <td>{{$data->waktu_durasi }}</td>
                <td><a href="{{route('prodi-file_download_pkm',$data->id)}}"><button class="btn btn-info ">Download</button></a></td>
                <td><a href="{{$data->link_bukti_kerjasama}}">{{$data->link_bukti_kerjasama}}</a></td>
                <td>{{$data->tahun_berakhir }}</td>
               
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
          1. Kerjasama Tridharma di Unit Pengelola Program Studi (UPPS) dalam 3 tahun terakhir <br>
          2. Unggah File dengan Format (rar/zip) dan Link Drive Bukti Kerjasama dapat berupa : <br>
          a. Surat Penugasan <br>
          b. Surat Perjanjian Kerjasama (SPK) <br>
          c. Pedoman Kerjasama <br>
          d. Monev Kerjasama <br>
          e. Dokumen Pendukung seperti Foto Kegiatan, Foto Hasil Kerjasama, Rapat, Notulensi Rapat, Daftar Hadir Rapat <br>
          f. Bukti-bukti pelaksanaan (laporan, hasil kerjasama, luaran kerjasama), atau bukti lain yang relevan <br>
          g. Dokumen Memorandum of Understanding (MoU), Memorandum of Agreement (MoA), atau dokumen sejenis yang
          memayungi pelaksanaan kerjasama, tidak dapat dijadikan bukti realisasi kerjasama.
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