@extends('layouts.lkps-master')

@section('title')
Data Pengabdian kepada Masyarakat (PkM) DTPS yang Melibatkan Mahasiswa
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
                <h4 style="margin-right: 15%;">Data Pengabdian kepada Masyarakat (PkM) DTPS yang Melibatkan Mahasiswa</h4><br>

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
                        <input type="text" class="form-control" id="filter" name="filter" placeholder="Tahun "  value="{{ old('filter') }}">
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
                                <th style="text-align: center; vertical-align: middle;">Tema Pengabdian kepada Masyarakat sesuai Roadmap</th>
                                <th style="text-align: center; vertical-align: middle;">Nama Mahasiswa</th>
                                <th style="text-align: center; vertical-align: middle;">Judul Kegiatan</th>
                                <th style="text-align: center; vertical-align: middle;">Tahun</th>
                                <th style="text-align: center; vertical-align: middle;">File Bukti Dokumen</th>
                                <th style="text-align: center; vertical-align: middle;">Link Bukti Dokumen</th>
                            </tr>
                        </thead>
                        <tbody>
                             @php $no=1 @endphp
                            @foreach($pkm_dtps_mahasiswa as $data)
                            <tr>
                                <td>{{$no++}}</td>
                                <td>{{$data->nama_dosen}}</td>
                                <td>{{$data->tema_pkm}}</td>
                                <td>{{$data->nama_mahasiswa}}</td>
                                <td>{{$data->judul_kegiatan}}</td>
                                <td>{{$data->tahun}}</td>
                                <td><a href="{{route('prodi-file_download_dokumen_pkm_mhs',$data->id)}}"><button class="btn btn-info ">Download</button></a></td>
                                <td><a href="{{$data->link_bukti_dokumen}}">{{$data->link_bukti_dokumen}}</a></td>
                               
                            </tr>
                            @endforeach
                            </tr>
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
                    1. Data Pengabdian kepada Masyarakat (PkM) DTPS yang dalam pelaksanaannya melibatkan mahasiswa Program Studi pada TS-2 (tahun akademik n tahun sebelum TS) sampai dengan TS (tahun akademik penuh terakhir saat pengajuan usulan akreditasi) <br>
                    2. Judul kegiatan merupakan kegiatan Pengabdian kepada Masyarakat (PkM) dosen yang dalam pelaksanaannya melibatkan mahasiswa, tidak termasuk kegiatan KKN atau kegiatan lainnya yang merupakan bagian dari kegiatan kurikuler <br>
                    3. Unggah File dengan Format (word/pdf/excel/rar/zip) dan Link Drive Bukti Dokumen seperti : <br>
                    a. Dokumen kebijakan Pengabdian kepada Masyarakat <br>
                    b. Pedoman Pengabdian kepada Masyarakat <br>
                    c. SOP Pengabdian kepada Masyarakat <br>
                    d. Surat Keputusan tentang penerima bantuan penelitian, Pengabdian kepada Masyarakat dan publikasi ilmiah <br>
                    e. Daftar penerima pendanaan Pengabdian kepada Masyarakat <br>
                    f. Jumlah/data proposal Pengabdian kepada Masyarakat <br>
                    g. Data hasil Pengabdian kepada Masyarakat <br>
                    h. Laporan hasil Pengabdian kepada Masyarakat <br>
                    i. Review hasil Pengabdian kepada Masyarakat <br>
                    j. Money Pengabdian kepada Masyarakat <br>
                    k. Laporan money Pengabdian kepada Masyarakat <br>
                    l. Standar mutu Pengabdian kepada Masyarakat <br>
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