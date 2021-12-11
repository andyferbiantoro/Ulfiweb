@extends('layouts.lkps-prodi-master')

@section('title')
Laporan Penggunaan Dana
@endsection


@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4>Data Laporan Penggunaan Dana</h4>
            </div>
            <div class="card-body">
                <a href="{{route('prodi_penggunaan_dana')}}">
                    <button type="button" class="btn btn-success ">
                        Kembali
                    </button></a><br><br>
                    <button class="btn btn-success mb-2" onclick="print('printPDF', 'Title')">Cetak PDF</button>
                    <div class="table-responsive">
                        <table id="dataTable" class="table table-hover">
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
                                    <td>{{$no++ }}</td>
                                    <td>{{$data->jenis_penggunaan }}</td>
                                    <td>{{$data->upps_ts2 }}</td>
                                    <td>{{$data->upps_ts1 }}</td>
                                    <td>{{$data->upps_ts }}</td>
                                    <td>{{$data->rata2_upps }}</td>
                                    <td>{{$data->prodi_ts2 }}</td>
                                    <td>{{$data->prodi_ts1 }}</td>
                                    <td>{{$data->prodi_ts }}</td>
                                    <td>{{$data->rata2_prodi }}</td>
                                    <td>{{$data->tahun_akademik }}</td>
                                    <td><a href="{{route('prodi-file_download_dokumen_penggunaan_dana',$data->id)}}"><button class="btn btn-info ">Download</button></a></td>
                                    <td>{{$data->link_bukti_dokumen }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    @endsection