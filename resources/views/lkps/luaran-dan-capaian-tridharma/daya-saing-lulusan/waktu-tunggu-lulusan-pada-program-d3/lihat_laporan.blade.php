@extends('layouts.lkps-master')

@section('title')
Laporan Waktu Tunggu Lulusan pada Program Diploma Tiga
@endsection


@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4>Data Laporan Waktu Tunggu Lulusan pada Program Diploma Tiga</h4>
            </div>
            <div class="card-body">
                <a href="{{route('waktu_tunggu_lulusan_program_d3')}}">
                    <button type="button" class="btn btn-success ">
                        Kembali
                    </button></a><br><br>
                <div class="table-responsive">
                    <table id="dataTable" class="table table-hover">
                        <thead>
                            <tr>
                                <th rowspan="2" style="text-align: center; vertical-align: middle;">No</th>
                                <th rowspan="2" style="text-align: center; vertical-align: middle;">Tahun Lulus</th>
                                <th rowspan="2" style="text-align: center; vertical-align: middle;">Jumlah Lulusan</th>
                                <th rowspan="2" style="text-align: center; vertical-align: middle;">Jumlah Lulusan yang Terlacak</th>
                                <th rowspan="2" style="text-align: center; vertical-align: middle;">Jumlah Lulusan yang Dipesan Sebelum Lulus</th>
                                <th colspan="3" style="text-align: center; vertical-align: middle;">Jumlah Lulusan Terlacak dengan Waktu Tunggu Mendapatkan Pekerjaan</th>
                                <th rowspan="2" style="text-align: center; vertical-align: middle;">File Bukti Dokumen</th>
                                <th rowspan="2" style="text-align: center; vertical-align: middle;">Link Bukti Dokumen</th>
                            </tr>
                            <tr>
                                <th style="text-align: center; vertical-align: middle;">WT 3 Bulan</th>
                                <th style="text-align: center; vertical-align: middle;">WT 3-6 Bulan</th>
                                <th style="text-align: center; vertical-align: middle;">WT Lebih 6 Bulan</th>

                            </tr>
                        </thead>
                        <tbody>
                            @php $no=1 @endphp
                               @foreach($waktu_tunggu_d3 as $data)
                               <tr>
                                <td>{{$no++ }}</td>
                                <td>{{$data->tahun_lulus }}</td>
                                <td>{{$data->jumlah_lulusan }}</td>
                                <td>{{$data->jumlah_lulusan_terlacak }}</td>
                                <td>{{$data->jumlah_lulusan_dipesan }}</td>
                                <td>{{$data->jumlah_lulusan_wt_3bulan }}</td>
                                <td>{{$data->jumlah_lulusan_wt_3_6bulan }}</td>
                                <td>{{$data->jumlah_lulusan_wt_6bulan }}</td>
                                <td><a href="{{route('prodi-file_download_dokumen_tunggu_d3',$data->id)}}"><button class="btn btn-info ">Download</button></a></td>
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