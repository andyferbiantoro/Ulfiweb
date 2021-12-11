@extends('layouts.lkps-prodi-master')

@section('title')
Laporan Kurikulum, Capain Pembelajaran,dan Rencana Pembelajaran
@endsection


@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4>Data Laporan Kurikulum, Capain Pembelajaran,dan Rencana Pembelajaran</h4>
            </div>
            <div class="card-body">
                <a href="{{route('pendidikan_kurikulum')}}">
                    <button type="button" class="btn btn-success ">
                        Kembali
                    </button></a><br><br>
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





@endsection