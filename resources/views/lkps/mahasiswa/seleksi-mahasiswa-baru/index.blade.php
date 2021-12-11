@extends('layouts.lkps-master')

@section('title')
Seleksi Mahasiswa Baru
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
                <h4 style="margin-right: 58%;">Data Seleksi Mahasiswa Baru</h4>
                <div class="text-right">
                    <a href="{{route('lihat_mahasiswa_seleksi_mahasiswa_baru')}}">
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
                            <input type="text" class="form-control" id="filter" name="filter" placeholder="Tahun Akademik" value="{{ old('filter') }}">
                        </div>
                        <button type="submit" class="btn btn-primary mb-2 fa fa-filter">Filter</button>

                    </form><br>
                </div>

                <div class="table-responsive">
                <table id="" class="table table-hover">
                        <thead>
                            <tr>
                                <th rowspan="2" style="text-align: center; vertical-align: middle;">No</th>
                                <th rowspan="2" style="text-align: center; vertical-align: middle;">Tahun Akakdemik</th>
                                <th rowspan="2" style="text-align: center; vertical-align: middle;">Daya Tampung</th>
                                <th colspan="2" style="text-align: center; vertical-align: middle;">Jumlah Calon Mahasiswa</th>
                                <th colspan="2" style="text-align: center; vertical-align: middle;">Jumlah Mahasiswa Baru</th>
                                <th colspan="2" style="text-align: center; vertical-align: middle;">Jumlah Mahasiswa Aktif</th>
                                <th rowspan="2" style="text-align: center; vertical-align: middle;">File Bukti Dokumen</th>
                                <th rowspan="2" style="text-align: center; vertical-align: middle;">Link Bukti Dokumen</th>
                            </tr>
                            <tr>
                                <th style="text-align: center; vertical-align: middle;">Pendaftar</th>
                                <th style="text-align: center; vertical-align: middle;">Lulus Seleksi</th>
                                <th style="text-align: center; vertical-align: middle;">Reguler</th>
                                <th style="text-align: center; vertical-align: middle;">Transfer</th>
                                <th style="text-align: center; vertical-align: middle;">Reguler</th>
                                <th style="text-align: center; vertical-align: middle;">Transfer</th>

                            </tr>
                        </thead>
                        <tbody>
                            @php $no=1 @endphp
                            @foreach($seleksi_mhs_baru as $data)
                            <tr>
                                <td style="text-align: center; vertical-align: middle;">{{$no++}}</td>
                                <td style="text-align: center; vertical-align: middle;">{{$data->tahun_akademik }}</td>
                                <td style="text-align: center; vertical-align: middle;">{{$data->daya_tampung }}</td>
                                <td style="text-align: center; vertical-align: middle;">{{$data->jumlah_calonMahasiswa_pendaftar }}</td>
                                <td style="text-align: center; vertical-align: middle;">{{$data->jumlah_calonMahasiswa_lulus }}</td>
                                <td style="text-align: center; vertical-align: middle;">{{$data->jumlah_mahasiswaBaru_reguler }}</td>
                                <td style="text-align: center; vertical-align: middle;">{{$data->jumlah_mahasiswaBaru_transfer }}</td>
                                <td style="text-align: center; vertical-align: middle;">{{$data->jumlah_mahasiswaAktif_reguler }}</td>
                                <td style="text-align: center; vertical-align: middle;">{{$data->jumlah_mahasiswaAktif_transfer }}</td>
                                <td style="text-align: center; vertical-align: middle;"><a href="{{route('prodi-file_download_mhs_asing',$data->id)}}"><button class="btn btn-info ">Download</button></a></td>
                                <td style="text-align: center; vertical-align: middle;"><a href="{{$data->link_bukti_dokumen}}">{{$data->link_bukti_dokumen}}</a></td>
                                
                                <td style="display: none;">{{$data->id}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <thead>
                            <tr>
                                <th colspan="3" style="text-align: center; vertical-align: middle;">Jumlah</th>
                                <!-- <th rowspan="2" style="text-align: center; vertical-align: middle;">No</th> -->
                                <th style="text-align: center; vertical-align: middle;">{{$calon_mhs_pendaftar}}</th>
                                <th style="text-align: center; vertical-align: middle;">{{$calon_mhs_lulus}}</th>
                                <th style="text-align: center; vertical-align: middle;">{{$mhs_baru_reguler}}</th>
                                <th style="text-align: center; vertical-align: middle;">{{$mhs_baru_transfer}}</th>
                                <th style="text-align: center; vertical-align: middle;">{{$mhs_aktif_reguler}}</th>
                                <th style="text-align: center; vertical-align: middle;">{{$mhs_aktif_transfer}}</th>
                                <th colspan="3" style="text-align: center; vertical-align: middle;"></th>
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
                    1. Tahun Akademik merupakan tahun akademik penuh terakhir saat pengajuan usulan akreditasi (TS)<br>
                    2. Data Daya Tampung, jumlah calon mahasiswa (pendaftar dan peserta yang lulus seleksi), jumlah mahasiswa baru (reguler dan transfer)
                    dan jumlah mahasiswa aktif (reguler dan transfer) dalam 5 tahun terakhir. <br>
                    3. Unggah file dengan format (rar/zip) dan link Drive Bukti Dokumen dalam 5 Tahun terakhir seperti : <br>
                    a. Surat Keputusan tentang Penetapan Daya Tampung <br>
                    b. Dokumen Data Penerimaan Mahasiswa Baru <br>
                    c. Surat Keputusan Penetapan Kelulusan Mahasiswa Baru <br>
                    d. Dokumen Data Registrasi Mahasiswa Baru <br>
                    e. Data Mahasiswa Aktif di PDDIKTI <br>
                    f. Dokumen Pendukung seperti Notulasi Rapat, Surat Undangan dan Daftar Hadir
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

<!-- Modal Lihat -->
<div class="modal fade" id="ModalLihat" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Data Mahasiswa Baru Tahun Akademik ......</h5>
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
                <div class="table-responsive">
                    <table id="" class="table table-hover">
                        <thead>
                            <tr>
                                <th rowspan="2" style="text-align: center; vertical-align: middle;">Daya Tampung</th>
                                <th colspan="2" style="text-align: center; vertical-align: middle;">Jumlah Calon Mahasiswa</th>
                                <th colspan="2" style="text-align: center; vertical-align: middle;">Jumlah Mahasiswa Baru</th>
                                <th colspan="2" style="text-align: center; vertical-align: middle;">Jumlah Mahasiswa Aktif</th>
                                <th rowspan="2" style="text-align: center; vertical-align: middle;">File Bukti Dokumen</th>
                                <th rowspan="2" style="text-align: center; vertical-align: middle;">Link Bukti Dokumen</th>
                            </tr>
                            <tr>
                                <th style="text-align: center; vertical-align: middle;">Pendaftar</th>
                                <th style="text-align: center; vertical-align: middle;">Lulus Seleksi</th>
                                <th style="text-align: center; vertical-align: middle;">Reguler</th>
                                <th style="text-align: center; vertical-align: middle;">Transfer</th>
                                <th style="text-align: center; vertical-align: middle;">Reguler</th>
                                <th style="text-align: center; vertical-align: middle;">Transfer</th>

                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>1</td>
                                <td>1</td>
                                <td>1</td>
                                <td>1</td>
                                <td>1</td>
                                <td>1</td>
                                <td>11</td>
                                <td>1</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>

            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah -->





@endsection