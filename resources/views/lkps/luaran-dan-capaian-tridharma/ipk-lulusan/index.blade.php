@extends('layouts.lkps-master')

@section('title')
Data Index Prestasi Kumulatif (IPK) Mahasiswa
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
                <h4 style="margin-right: 40%;">Data Index Prestasi Kumulatif (IPK) Mahasiswa</h4><br>
                <div class=" text-right">
                    <a href="{{route('lihat_ipk_lulusan')}}">
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
                    <input type="text" class="form-control" id="filter" name="filter" placeholder="Tahun Akademik"  value="{{ old('filter') }}">
                </div>
                <button type="submit" class="btn btn-primary mb-2 fa fa-filter">Filter</button>

            </form><br>
        </div>

        <div class="table-responsive">
            <table id="dataTable" class="table table-hover">
                <thead>
                    <tr>
                        <th rowspan="2" style="text-align: center; vertical-align: middle;">No</th>
                        <th rowspan="2" style="text-align: center; vertical-align: middle;">Tahun Lulus</th>
                        <th rowspan="2" style="text-align: center; vertical-align: middle;">Jumlah Lulusan</th>
                        <th colspan="3" style="text-align: center; vertical-align: middle;">Indeks Prestasi Kumulatif</th>
                        <th rowspan="2" style="text-align: center; vertical-align: middle;">File Bukti Dokumen</th>
                        <th rowspan="2" style="text-align: center; vertical-align: middle;">Link Bukti Dokumen</th>
                    </tr>
                    <tr>
                        <th style="text-align: center; vertical-align: middle;">Minimal</th>
                        <th style="text-align: center; vertical-align: middle;">Rata-rata</th>
                        <th style="text-align: center; vertical-align: middle;">Maksimal</th>

                    </tr>
                </thead>
                <tbody>
                 @php $no=1 @endphp
                 @foreach($ipk_lulusan as $data)
                 <tr>
                    <td>{{$no++ }}</td>
                    <td>{{$data->tahun_lulus }}</td>
                    <td>{{$data->jumlah_lulusan }}</td>
                    <td>{{$data->minimal_ipk }}</td>
                    <td>{{$data->rataRata_ipk }}</td>
                    <td>{{$data->maksimal_ipk }}</td>
                    <td><a href="{{route('prodi-file_download_dokumen_ipk_lulusan',$data->id)}}"><button class="btn btn-info ">Download</button></a></td>
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
                    1. Tahun lulus merupakan tahun akademik n tahun sebelum TS (TS-n) sampai dengan tahun akademik penuh terakhir saat pengajuan usulan akreditasi (TS) <br>
                    2. Data Indeks Prestasi Kumulatif (IPK) lulusan dalam 3 tahun terakhir <br>
                    3. Data dilengkapi dengan jumlah lulusan pada setiap tahun kelulusan <br>
                    4. Unggah File dengan Format (word/pdf/excel/rar/zip) dan Link Drive Bukti Dokumen dalam 3 tahun terakhir seperti : <br>
                    a. Kebijakan mutu <br>
                    b. Manual mutu <br>
                    c. Standar mutu <br>
                    d. Buku kebijakan tentang pedoman pendidikan <br>
                    e. Surat Keputusan tentang kelulusan <br>
                    f. Dokumen pendukung seperti Buku wisuda dan PD DIKTI (pangkalan data) <br>
                    g. Rekapitulasi IPK Mahasiswa <br>
                    h. Daftar Mahasiswa Lulusan <br>
                    i. Daftar Prestasi Akademik
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