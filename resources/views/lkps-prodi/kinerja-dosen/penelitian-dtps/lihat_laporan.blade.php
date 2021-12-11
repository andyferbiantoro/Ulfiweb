@extends('layouts.lkps-prodi-master')

@section('title')
Laporan Penelitian DTPS
@endsection


@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4>Data Laporan Penelitian DTPS</h4>
            </div>
            <div class="card-body">
                <a href="{{route('prodi_kinerja_dosen_penelitian_dtps')}}">
                    <button type="button" class="btn btn-success ">
                        Kembali
                    </button></a><br><br>
                    <button class="btn btn-success mb-2" onclick="print('printPDF', 'Title')">Cetak PDF</button>
                <div class="table-responsive">
                    <table id="dataTable" class="table table-hover">
                        <thead>
                            <tr>
                                <th rowspan="2" style="text-align: center; vertical-align: middle;">No</th>
                                <th rowspan="2" style="text-align: center; vertical-align: middle;">Sumber Pembiayaan</th>
                                <th colspan="3" style="text-align: center; vertical-align: middle;">Jumlah Judul Penelitian</th>
                                <th rowspan="2" style="text-align: center; vertical-align: middle;">Jumlah</th>
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
                           @foreach($data_penelitian_dtps as $data)
                           <tr>
                            <td>{{$no++ }}</td>
                            <td>{{$data->sumber_pembiayaan }}</td>
                            <td>{{$data->jumlah_judulPenelitian_ts2 }}</td>
                            <td>{{$data->jumlah_judulPenelitian_ts1 }}</td>
                            <td>{{$data->jumlah_judulPenelitian_ts }}</td>
                            <td>{{$data->tahun_akademik }}</td>
                            <td><a href="{{route('prodi-file_download_bukti_pendukung',$data->id)}}"><button class="btn btn-info ">Download</button></a></td>
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