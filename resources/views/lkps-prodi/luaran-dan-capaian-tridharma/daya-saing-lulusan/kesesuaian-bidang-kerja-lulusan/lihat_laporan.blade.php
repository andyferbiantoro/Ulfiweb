@extends('layouts.lkps-prodi-master')

@section('title')
Laporan Kesesuaian Bidang Kerja Lulusan
@endsection


@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4>Data Laporan Kesesuaian Bidang Kerja Lulusan</h4>
            </div>
            <div class="card-body">
                <a href="{{route('prodi_kesesuaian_bidang_kerja_lulusan')}}">
                    <button type="button" class="btn btn-success ">
                        Kembali
                    </button></a><br><br>
                    <button class="btn btn-success mb-2" onclick="print('printPDF', 'Title')">Cetak PDF</button>
                <div class="table-responsive">
                    <table id="dataTable" class="table table-hover">
                        <thead>
                            <tr>
                                <th rowspan="2" style="text-align: center; vertical-align: middle;">No</th>
                                <th rowspan="2" style="text-align: center; vertical-align: middle;">Tahun Lulus</th>
                                <th rowspan="2" style="text-align: center; vertical-align: middle;">Jumlah Lulusan</th>
                                <th rowspan="2" style="text-align: center; vertical-align: middle;">Jumlah Lulusan yang Terlacak</th>
                                <th colspan="3" style="text-align: center; vertical-align: middle;">Jumlah Lulusan Terlacak dengan Kesesuaian Bidang Kerja</th>
                                <th rowspan="2" style="text-align: center; vertical-align: middle;">File Bukti Dokumen</th>
                                <th rowspan="2" style="text-align: center; vertical-align: middle;">Link Bukti Dokumen</th>
                            </tr>
                            <tr>
                                <th style="text-align: center; vertical-align: middle;">Rendah</th>
                                <th style="text-align: center; vertical-align: middle;">Sedang</th>
                                <th style="text-align: center; vertical-align: middle;">Tinggi</th>

                            </tr>
                        </thead>
                        <tbody>
                            @php $no=1 @endphp
                           @foreach($kesesuaian_bidang_kerja_lulusan as $data)
                           <tr>
                            <td>{{$no++ }}</td>
                            <td>{{$data->tahun_lulus }}</td>
                            <td>{{$data->jumlah_lulusan }}</td>
                            <td>{{$data->jumlah_lulusan_terlacak }}</td>
                            <td>{{$data->jumlah_lulusan_rendah }}</td>
                            <td>{{$data->jumlah_lulusan_sedang }}</td>
                            <td>{{$data->jumlah_lulusan_tinggi }}</td>
                            <td><a href="{{route('prodi-file_download_dokumen_kesesuaian_bidang',$data->id)}}"><button class="btn btn-info ">Download</button></a></td>
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