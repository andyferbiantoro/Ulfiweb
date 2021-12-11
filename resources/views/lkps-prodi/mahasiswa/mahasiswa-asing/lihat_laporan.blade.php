@extends('layouts.lkps-prodi-master')

@section('title')
Data Laporan Mahasiswa Asing
@endsection


@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4>Data Laporan Mahasiswa Asing</h4>
            </div>
            <div class="card-body">
                <a href="{{route('prodi_mahasiswa_mahasiswa_asing')}}">
                    <button type="button" class="btn btn-success ">
                        Kembali
                    </button></a><br><br>
                    <button class="btn btn-success mb-2" onclick="print('printPDF', 'Title')">Cetak PDF</button>
                <div class="table-responsive">
                    <table id="dataTable" class="table table-hover">
                        <thead>
                            <tr>
                                <th rowspan="2" style="text-align: center; vertical-align: middle;">No</th>
                                <th rowspan="2" style="text-align: center; vertical-align: middle;">Tahun Akademik</th>
                                <th rowspan="2" style="text-align: center; vertical-align: middle;">Program Studi</th>
                                <th colspan="3" style="text-align: center; vertical-align: middle;">Jumlah Mahasiswa Aktif</th>
                                <th colspan="3" style="text-align: center; vertical-align: middle;">Jumlah Mahasiswa Asing Penuh Waktu(Full-time)</th>
                                <th colspan="3" style="text-align: center; vertical-align: middle;">Jumlah Mahasiswa Asing Paruh Waktu(Part-time)</th>
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
                                <th style="text-align: center; vertical-align: middle;">TS-2</th>
                                <th style="text-align: center; vertical-align: middle;">TS-1</th>
                                <th style="text-align: center; vertical-align: middle;">TS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no=1 @endphp
                            @foreach($mhs_asing as $data)
                            <tr>
                                <td>{{$no++ }}</td>
                                <td>{{$data->tahun_akademik }}</td>
                                <td>{{$data->nama_prodi }}</td>
                                <td>{{$data->jumlah_mahasiswaAktif_ts2 }}</td>
                                <td>{{$data->jumlah_mahasiswaAktif_ts1 }}</td>
                                <td>{{$data->jumlah_mahasiswaAktif_ts }}</td>
                                <td>{{$data->jumlah_mahasiswaFullTime_ts2 }}</td>
                                <td>{{$data->jumlah_mahasiswaFullTime_ts1 }}</td>
                                <td>{{$data->jumlah_mahasiswaFullTime_ts }}</td>
                                <td>{{$data->jumlah_mahasiswaPartTime_ts2 }}</td>
                                <td>{{$data->jumlah_mahasiswaPartTime_ts1 }}</td>
                                <td>{{$data->jumlah_mahasiswaPartTime_ts }}</td>
                                <td><a href="{{route('prodi-file_download_mhs_baru',$data->id)}}"><button class="btn btn-info ">Download</button></a></td>
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