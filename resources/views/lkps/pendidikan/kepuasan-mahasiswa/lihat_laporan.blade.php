@extends('layouts.lkps-master')

@section('title')
Laporan Kepuasan Mahasiswa
@endsection


@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4>Data Laporan Kepuasan Mahasiswa</h4>
            </div>
            <div class="card-body">
                <a href="{{route('pendidikan_kepuasan_mahasiswa')}}">
                    <button type="button" class="btn btn-success ">
                        Kembali
                    </button></a><br><br>
                <div class="table-responsive">
                    <table id="dataTable" class="table table-hover">
                        <thead>
                            <tr>
                                <th rowspan="2" style="text-align: center; vertical-align: middle;">No</th>
                                <th rowspan="2" style="text-align: center; vertical-align: middle;">Aspek yang Diukur</th>
                                <th colspan="4" style="text-align: center; vertical-align: middle;">Tingkat Kepuasan Mahasiswa</th>
                                <th rowspan="2" style="text-align: center; vertical-align: middle;">Rencana Tindak Lanjut oleh UPPS/PS</th>
                                <th rowspan="2" style="text-align: center; vertical-align: middle;">File Bukti Dokumen</th>
                                <th rowspan="2" style="text-align: center; vertical-align: middle;">Link Bukti Dokumen</th>
                                <th rowspan="2" style="text-align: center; vertical-align: middle;">Tahun</th>
                            </tr>
                            <tr>
                                <th style="text-align: center; vertical-align: middle;">Sangat Baik</th>
                                <th style="text-align: center; vertical-align: middle;">Baik</th>
                                <th style="text-align: center; vertical-align: middle;">Cukup</th>
                                <th style="text-align: center; vertical-align: middle;">Kurang</th>

                            </tr>
                        </thead>
                        <tbody>
                             @php $no=1 @endphp
                            @foreach($data_kepuasan_mahasiswa as $data)
                            <tr>
                                <td>{{$no++ }}</td>
                                <td>{{$data->aspek_diukir }}</td>
                                <td>{{$data->tingkat_kepuasanMahasiswa_sangatBaik }}</td>
                                <td>{{$data->tingkat_kepuasanMahasiswa_baik }}</td>
                                <td>{{$data->tingkat_kepuasanMahasiswa_cukup }}</td>
                                <td>{{$data->tingkat_kepuasanMahasiswa_kurang }}</td>
                                <td>{{$data->rencana_tindak_lanjut }}</td>
                                <td><a href="{{route('prodi-file_download_dokumen_kepuasan_mhs',$data->id)}}"><button class="btn btn-info ">Download</button></a></td>
                                <td>{{$data->link_bukti_dokumen }}</td>
                                <td>{{$data->tahun }}</td>
                               
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