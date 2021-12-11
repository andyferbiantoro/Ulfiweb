@extends('layouts.lkps-master')

@section('title')
Data Integrasi Penelitian/Pengabdian kepada Masyarakat (PkM) dalam Pembelajaran
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
                <h4 style="margin-right: 10%;">Data Integrasi Penelitian/Pengabdian kepada Masyarakat (PkM) dalam Pembelajaran</h4><br>

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
                <input type="text" class="form-control" id="filter" name="filter" placeholder="Tahun Akademik"  value="{{ old('filter') }}">
            </div>
            <button type="submit" class="btn btn-primary mb-2 fa fa-filter">Filter</button>

        </form><br>
    </div>


    <div class="table-responsive">
        <table id="dataTable" class="table table-hover">
            <thead>
                <tr>
                    <th style="text-align: center; vertical-align: middle;">No</th>
                    <th style="text-align: center; vertical-align: middle;">Judul Penelitian/Pengabdian kepada Masyarakat</th>
                    <th style="text-align: center; vertical-align: middle;">Nama Dosen</th>
                    <th style="text-align: center; vertical-align: middle;">Mata Kuliah</th>
                    <th style="text-align: center; vertical-align: middle;">Bentuk Integrasi</th>
                    <th style="text-align: center; vertical-align: middle;">Tahun</th>
                    <th style="text-align: center; vertical-align: middle;">File Bukti Dokumen</th>
                    <th style="text-align: center; vertical-align: middle;">Link Bukti Dokumen</th>
                </tr>
            </thead>
            <tbody>
                @php $no=1 @endphp
                @foreach($data_integrasi as $data)
                <tr>
                    <td>{{$no++}}</td>
                    <td>{{$data->judul_penelitian_pkm }}</td>
                    <td>{{$data->nama_dosen }}</td>
                    <td>{{$data->matakuliah }}</td>
                    <td>{{$data->bentuk_integrasi }}</td>
                    <td>{{$data->tahun }}</td>
                    <td><a href="{{route('prodi-file_download_dokumen_integrasi',$data->id)}}"><button class="btn btn-info ">Download</button></a></td>
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
                    1. Judul Penelitian/Pengabdian kepada Masyarakat (PkM) DTPS yan terintegrasi ke dalam pembelajaran/pengembangan matakuliah dalam 3 tahun terakhir.<br>
                    2. Judul Penelitian/Pengabdian kepada Masyarakat merupakan judul penelitian dan Pengabdian kepada Masyarakat (PkM) tercatat di Unit/Lembaga yang mengeloala <br>
                    kegiatan penelitian/Pengabdian kepada Masyarakat (PkM) di tingkat Perguruan Tinggi/Unit Pengelola Program Studi (UPPS) <br>
                    3. Bentuk integrasi dapat berupa tambahan materi perkuliahan, studi kasus, bab/subbab dalam buku ajar, atau bentuk lain yang relevan
                    4. Unggah file dengan format (word/pdf/rar/zip) dan Link Drive bukti dokumen seperti : <br>
                    a. Rencana Induk Penelitian atau Pengabdian kepada Masyarakat (RIP) Program Studi <br>
                    b. Laporan penelitian atau Pengabdian kepada Masyarakat (PkM) berdasarkan pada RIP Program Studi <br>
                    c Rencana Pembelajaran Semester (RPS) berdasarkan pada asil penelitian dosen <br>
                    d. Modul pembelajaran berdasarkan pada penelitian <br>
                    e. Surat Keputusan
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