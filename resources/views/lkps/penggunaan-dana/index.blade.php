@extends('layouts.lkps-master')

@section('title')
Data Penggunaan Dana
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
                <h4 style="margin-right: 62%;">Data Penggunaan Dana</h4>
                <div class=" text-right">
                    <!-- <button type="button" class="btn btn-success fa fa-plus" data-toggle="modal" data-target="#ModalTambah">
                        Tambah Data
                    </button> -->
                    <a href="{{route('lihat_penggunaan_dana')}}">
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
                <table id="" class="table table-hover">
                        <thead>
                            <tr>
                                <th rowspan="2" style="text-align: center; vertical-align: middle;">No</th>
                                <th rowspan="2" style="text-align: center; vertical-align: middle;">Jenis Penggunaan</th>
                                <th colspan="3" style="text-align: center; vertical-align: middle;">Unit Pengelola Program Studi</th>
                                <th rowspan="2" style="text-align: center; vertical-align: middle;">Rata-rata pada Unit Pengelola Program Studi</th>
                                <th colspan="3" style="text-align: center; vertical-align: middle;">Program Studi</th>
                                <th rowspan="2" style="text-align: center; vertical-align: middle;">Rata-rata pada Program Studi</th>
                                <th rowspan="2" style="text-align: center; vertical-align: middle;">Tahun Akademik</th>
                                <th rowspan="2" style="text-align: center; vertical-align: middle;">File Bukti Dokumen</th>
                                <th rowspan="2" style="text-align: center; vertical-align: middle;">Link Bukti Dokumen</th>
                            </tr>
                            <tr>
                                <th style="text-align: center; vertical-align: middle;">TS-2</th>
                                <th style="text-align: center; vertical-align: middle;">TS-1</th>
                                <th style="text-align: center; vertical-align: middle;">TS</th>
                                <th style="text-align: center; vertical-align: middle;">TS-2</th>
                                <th style="text-align: center; vertical-align: middle;">TS-1</th>
                                <th style="text-align: center; vertical-align: middle;">TS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no=1 @endphp
                            @foreach($data_penggunaan_dana as $data)
                            <tr>
                                <td style="text-align: center; vertical-align: middle;">{{$no++ }}</td>
                                <td style="text-align: center; vertical-align: middle;">{{$data->jenis_penggunaan }}</td>
                                <td style="text-align: center; vertical-align: middle;">{{$data->upps_ts2 }}</td>
                                <td style="text-align: center; vertical-align: middle;">{{$data->upps_ts1 }}</td>
                                <td style="text-align: center; vertical-align: middle;">{{$data->upps_ts }}</td>
                                <td style="text-align: center; vertical-align: middle;">{{$data->rata2_upps }}</td>
                                <td style="text-align: center; vertical-align: middle;">{{$data->prodi_ts2 }}</td>
                                <td style="text-align: center; vertical-align: middle;">{{$data->prodi_ts1 }}</td>
                                <td style="text-align: center; vertical-align: middle;">{{$data->prodi_ts }}</td>
                                <td style="text-align: center; vertical-align: middle;">{{$data->rata2_prodi }}</td>
                                <td style="text-align: center; vertical-align: middle;">{{$data->tahun_akademik }}</td>
                                <td style="text-align: center; vertical-align: middle;"><a href="{{route('prodi-file_download_dokumen_penggunaan_dana',$data->id)}}"><button class="btn btn-info ">Download</button></a></td>
                                <td style="text-align: center; vertical-align: middle;"><a href="{{$data->link_bukti_dokumen}}">{{$data->link_bukti_dokumen}}</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                        <thead>
                            <tr>
                                <th colspan="2" style="text-align: center; vertical-align: middle;">Jumlah</th>
                                <th style="text-align: center; vertical-align: middle;">1</th>
                                <th style="text-align: center; vertical-align: middle;">1</th>
                                <th style="text-align: center; vertical-align: middle;">1</th>
                                <th style="text-align: center; vertical-align: middle;">1</th>
                                <th style="text-align: center; vertical-align: middle;">1</th>
                                <th style="text-align: center; vertical-align: middle;">1</th>
                                <th style="text-align: center; vertical-align: middle;">1</th>
                                <th style="text-align: center; vertical-align: middle;">1</th>
                                <th colspan="5" style="text-align: center; vertical-align: middle;"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="text-align: center; vertical-align: middle;">{{$no++ }}</td>
                                <td style="text-align: center; vertical-align: middle;">{{$data->jenis_penggunaan }}</td>
                                <td style="text-align: center; vertical-align: middle;">{{$data->upps_ts2 }}</td>
                                <td style="text-align: center; vertical-align: middle;">{{$data->upps_ts1 }}</td>
                                <td style="text-align: center; vertical-align: middle;">{{$data->upps_ts }}</td>
                                <td style="text-align: center; vertical-align: middle;">{{$data->rata2_upps }}</td>
                                <td style="text-align: center; vertical-align: middle;">{{$data->prodi_ts2 }}</td>
                                <td style="text-align: center; vertical-align: middle;">{{$data->prodi_ts1 }}</td>
                                <td style="text-align: center; vertical-align: middle;">{{$data->prodi_ts }}</td>
                                <td style="text-align: center; vertical-align: middle;">{{$data->rata2_prodi }}</td>
                                <td style="text-align: center; vertical-align: middle;">{{$data->tahun_akademik }}</td>
                                <td style="text-align: center; vertical-align: middle;"><a href="{{route('prodi-file_download_dokumen_penggunaan_dana',$data->id)}}"><button class="btn btn-info ">Download</button></a></td>
                                <td style="text-align: center; vertical-align: middle;"><a href="{{$data->link_bukti_dokumen}}">{{$data->link_bukti_dokumen}}</a></td>
                            </tr>
                        </tbody>
                        <thead>
                            <tr>
                                <th colspan="2" style="text-align: center; vertical-align: middle;">Jumlah</th>
                                <th style="text-align: center; vertical-align: middle;">1</th>
                                <th style="text-align: center; vertical-align: middle;">1</th>
                                <th style="text-align: center; vertical-align: middle;">1</th>
                                <th style="text-align: center; vertical-align: middle;">1</th>
                                <th style="text-align: center; vertical-align: middle;">1</th>
                                <th style="text-align: center; vertical-align: middle;">1</th>
                                <th style="text-align: center; vertical-align: middle;">1</th>
                                <th style="text-align: center; vertical-align: middle;">1</th>
                                <th colspan="5" style="text-align: center; vertical-align: middle;"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="text-align: center; vertical-align: middle;">{{$no++ }}</td>
                                <td style="text-align: center; vertical-align: middle;">{{$data->jenis_penggunaan }}</td>
                                <td style="text-align: center; vertical-align: middle;">{{$data->upps_ts2 }}</td>
                                <td style="text-align: center; vertical-align: middle;">{{$data->upps_ts1 }}</td>
                                <td style="text-align: center; vertical-align: middle;">{{$data->upps_ts }}</td>
                                <td style="text-align: center; vertical-align: middle;">{{$data->rata2_upps }}</td>
                                <td style="text-align: center; vertical-align: middle;">{{$data->prodi_ts2 }}</td>
                                <td style="text-align: center; vertical-align: middle;">{{$data->prodi_ts1 }}</td>
                                <td style="text-align: center; vertical-align: middle;">{{$data->prodi_ts }}</td>
                                <td style="text-align: center; vertical-align: middle;">{{$data->rata2_prodi }}</td>
                                <td style="text-align: center; vertical-align: middle;">{{$data->tahun_akademik }}</td>
                                <td style="text-align: center; vertical-align: middle;"><a href="{{route('prodi-file_download_dokumen_penggunaan_dana',$data->id)}}"><button class="btn btn-info ">Download</button></a></td>
                                <td style="text-align: center; vertical-align: middle;">{{$data->link_bukti_dokumen }}</td>
                                
                            </tr>
                        </tbody>
                        <thead>
                            <tr>
                                <th colspan="2" style="text-align: center; vertical-align: middle;">Jumlah</th>
                                <th style="text-align: center; vertical-align: middle;">1</th>
                                <th style="text-align: center; vertical-align: middle;">1</th>
                                <th style="text-align: center; vertical-align: middle;">1</th>
                                <th style="text-align: center; vertical-align: middle;">1</th>
                                <th style="text-align: center; vertical-align: middle;">1</th>
                                <th style="text-align: center; vertical-align: middle;">1</th>
                                <th style="text-align: center; vertical-align: middle;">1</th>
                                <th style="text-align: center; vertical-align: middle;">1</th>
                                <th colspan="5" style="text-align: center; vertical-align: middle;"></th>
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
                    1. Data penggunaan dana yang dikelola oleh Unit Pengelola Program Studi (UPPS) dan data penggunaan dana yang dialokasikan ke Program Studi yang diakreditasi dalam 3 tahun terakhir.<br>
                    2. Tahun Akademik merupakan Tahun Akademik n tahun sebelum TS (TS-n) atau tahun akademik penuh terakhir saat Pengajuan usulan Akreditasi (TS).<br>
                    3. Unggah file dengan format (rar/zip) dan Link Drive bukti dokumen dalam 3 tahun terakhir yang terkait mengenai penggunaan dana
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
<div class="modal fade" id="ModalTambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Penggunaan Dana</h5>
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
            </div>
            <div class="modal-body">
                <form method="post" action="" enctype="multipart/form-data">

                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="judul">Jenis Penggunaan</label>
                        <select type="text" class="form-control" id="penggunaan" name="penggunaan">
                            <option value="">Biaya Operasional</option>
                            <option value="">DLL (Dibuat Otomatis)</option>

                        </select>
                    </div>

                    <div class="form-group">
                        <label for="judul">Unit Pengelola Program Studi</label>
                        <input type="text" class="form-control" id="upps_2" name="upps_2" required="" placeholder="TS-2" /><br>
                        <input type="text" class="form-control" id="upps_1" name="upps_1" required="" placeholder="TS-1" /><br>
                        <input type="text" class="form-control" id="upps" name="upps" required="" placeholder="TS" />

                    </div>

                    <div class="form-group">
                        <label for="judul">Program Studi</label>
                        <input type="text" class="form-control" id="prodi_2" name="prodi_2" required="" placeholder="TS-2" /><br>
                        <input type="text" class="form-control" id="prodi_1" name="prodi_1" required="" placeholder="TS-1" /><br>
                        <input type="text" class="form-control" id="prodi" name="prodi" required="" placeholder="TS" />

                    </div>

                    <div class="form-group">
                        <label for="judul">Tahun Akademik</label>
                        <input type="text" class="form-control" id="th_akademik" name="th_akademik" required="" placeholder="2020/2021" />
                    </div>

                    <div class="form-group">
                        <label for="judul">Unggah File Bukti Dokumen (opsional)</label>
                        <input type="file" class="form-control" id="file_bukti" name="file_bukti" />
                    </div>

                    <div class="form-group">
                        <label for="judul">Link Bukti Dokumen (opsional)</label>
                        <input type="text" class="form-control" id="link_bukti" name="link_bukti" />
                    </div>

                    <div class="form-group">
                        <input type="hidden" class="form-control" id="id_user" name="id_user" value="{{ Auth::user()->id }}" />
                    </div>

                    <button class="btn btn-primary" type="Submit">Simpan</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>

            </div>
        </div>
    </div>
</div>

@endsection