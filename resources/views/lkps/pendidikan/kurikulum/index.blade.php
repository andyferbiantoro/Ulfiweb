@extends('layouts.lkps-master')

@section('title')
Data Kurikulum, Capain Pembelajaran,dan Rencana Pembelajaran
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
                <h4 style="margin-right: 25%;">Data Kurikulum, Capain Pembelajaran,dan Rencana Pembelajaran</h4>
                <div class=" text-right">

                    <a href="{{route('lihat_pendidikan_kurikulum')}}">
                        <button type="button" class="btn btn-primary fa fa-book">
                            Lihat Laporan
                        </button></a>
                </div>
            </div>
            <div class="card-body">
                <form class="form-inline">
                    <div class="form-group mx-sm-1 mb-2">
                        <!-- <label for="inputPassword2" class="sr-only">Password</label> -->
                        <input type="text" class="form-control" id="filter" name="filter" placeholder="Tahun" value="{{ old('filter') }}">
                    </div>
                    <button type="submit" class="btn btn-primary mb-2 fa fa-filter">Filter</button>
                </form><br>
                <div class="table-responsive">
                    <table id="dataTable" class="table table-hover">
                        <thead>
                            <tr>
                                <th rowspan="2" style="text-align: center; vertical-align: middle;">No</th>
                                <th rowspan="2" style="text-align: center; vertical-align: middle;">Semester</th>
                                <th rowspan="2" style="text-align: center; vertical-align: middle;">Kode Mata Kuliah</th>
                                <th rowspan="2" style="text-align: center; vertical-align: middle;">Nama Mata Kuliah</th>
                                <th rowspan="2" style="text-align: center; vertical-align: middle;">Mata Kuliah Kompetensi</th>
                                <th colspan="3" style="text-align: center; vertical-align: middle;">Bobot Kredit (sks)</th>
                                <th rowspan="2" style="text-align: center; vertical-align: middle;">Konversi kredit ke jam</th>
                                <th colspan="4" style="text-align: center; vertical-align: middle;">Capaian Pembelajaran</th>
                                <th rowspan="2" style="text-align: center; vertical-align: middle;">File Dokumen Rencana Pembelajaran</th>
                                <th rowspan="2" style="text-align: center; vertical-align: middle;">Link Dokumen Rencana Pembelajaran</th>
                                <th rowspan="2" style="text-align: center; vertical-align: middle;">Unit Penyelenggara</th>
                                <th rowspan="2" style="text-align: center; vertical-align: middle;">Tahun</th>
                            </tr>
                            <tr>
                                <th style="text-align: center; vertical-align: middle;">Kuliah/ Responsi/ Tutorial</th>
                                <th style="text-align: center; vertical-align: middle;">Seminar</th>
                                <th style="text-align: center; vertical-align: middle;">Praktikum/ Praktik/ Praktik Lapangan</th>
                                <th style="text-align: center; vertical-align: middle;">Sikap</th>
                                <th style="text-align: center; vertical-align: middle;">Pengetahuan</th>
                                <th style="text-align: center; vertical-align: middle;">Keterampilan Umum</th>
                                <th style="text-align: center; vertical-align: middle;">Keterampilan Khusus</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                               
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



@endsection