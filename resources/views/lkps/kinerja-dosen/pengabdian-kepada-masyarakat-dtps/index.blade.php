@extends('layouts.lkps-master')

@section('title')
Pengabdian Kepada Masyarakat DTPS
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
                <h4 style="margin-right: 40%;">Data Pengabdian kepada Masyarakat (PkM) DTPS</h4>
                <div class=" text-right">
                    <a href="{{route('lihat_kinerja_dosen_pengabdian_kepada_masyarakat_dtps')}}">
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
                        <input type="text" class="form-control" id="filter" name="filter" placeholder="Tahun"  value="{{ old('filter') }}">
                    </div>
                    <button type="submit" class="btn btn-primary mb-2 fa fa-filter">Filter</button>

                </form><br>
            </div>
                <form class="form-inline">
                    <div class="form-group mx-sm-1 mb-2">
                        <!-- <label for="inputPassword2" class="sr-only">Password</label> -->
                       <input type="text" class="form-control" id="filter" name="filter" placeholder="Tahun" value="{{ old('filter') }}">
                    </div>
                    <button type="submit" class="btn btn-primary mb-2 fa fa-filter">Filter</button>
                </form><br>
                <div class="table-responsive">
                <table id="" class="table table-hover">
                        <thead>
                            <tr>
                                <th rowspan="2" style="text-align: center; vertical-align: middle;">No</th>
                                <th rowspan="2" style="text-align: center; vertical-align: middle;">Sumber Pembiayaan</th>
                                <th colspan="3" style="text-align: center; vertical-align: middle;">Jumlah Judul Penelitian</th>
                                <th rowspan="2" style="text-align: center; vertical-align: middle;">Jumlah</th>
                                <th rowspan="2" style="text-align: center; vertical-align: middle;">Tahun Akademik</th>
                                <th rowspan="2" style="text-align: center; vertical-align: middle;">File Bukti Dokumen</th>
                                <th rowspan="2" style="text-align: center; vertical-align: middle;">Link Bukti Dokumen</th>
                            </tr>
                            <tr>
                                <th style="text-align: center; vertical-align: middle;">TS-2</th>
                                <th style="text-align: center; vertical-align: middle;">TS-1</th>
                                <th style="text-align: center; vertical-align: middle;">TS</th>
                            </tr>
                        </thead>
                        <tbody>
                         @php $no=1 @endphp
                         @foreach($data_pkm_dtps as $data)
                         <tr>
                            <td style="text-align: center; vertical-align: middle;">{{$no++ }}</td>
                            <td style="text-align: center; vertical-align: middle;">{{$data->sumber_pembiayaan }}</td>
                            <td style="text-align: center; vertical-align: middle;">{{$data->jumlah_judulPkm_ts2 }}</td>
                            <td style="text-align: center; vertical-align: middle;">{{$data->jumlah_judulPkm_ts1 }}</td>
                            <td style="text-align: center; vertical-align: middle;">{{$data->jumlah_judulPkm_ts }}</td>
                            <td style="text-align: center; vertical-align: middle;">{{$data->jumlah }}</td>
                            <td style="text-align: center; vertical-align: middle;">{{$data->tahun_akademik }}</td>
                            <td style="text-align: center; vertical-align: middle;"><a href="{{route('prodi-file_download_file_bukti_dokumen_pkm',$data->id)}}"><button class="btn btn-info ">Download</button></a></td>
                            <td style="text-align: center; vertical-align: middle;"><a href="{{$data->link_bukti_dokumen}}">{{$data->link_bukti_dokumen}}</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                        <thead>
                            <tr>
                                <th colspan="2" style="text-align: center; vertical-align: middle;">Jumlah</th>
                                <th style="text-align: center; vertical-align: middle;">{{$jumlahts2}}</th>
                                <th style="text-align: center; vertical-align: middle;">{{$jumlahts1}}</th>
                                <th style="text-align: center; vertical-align: middle;">{{$jumlahts}}</th>
                                <th style="text-align: center; vertical-align: middle;">{{$jumlah_all}}</th>
                                <th colspan="4" style="text-align: center; vertical-align: middle;"></th>
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
                    1. Tahun Akademik merupakan Tahun Akademik Penuh Terakhir saat Pengajuan usulan Akreditasi (TS).<br>
                    2. Jumlah judul Pengabdian kepada Masyarakat (PkM) berdasarkan sumber pembiayaan yang dilaksanakan oleh DTPS, yang relevan dengan bidang
                    Program Studi pada TS-2 sampai denga TS <br>
                    3. Unggah file dengan format (rar/zip) dan link drive bukti dokumen pada TS-2 sampai dengan TS seperti : <br>
                    a. Surat Keputusan Tentang Pengabdian Kepada Masyarakat <br>
                    b. Surat Tugas <br>
                    c. Laporan Hasil Pengabdian kepada Masyarakat
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