@extends('layouts.lkps-master')

@section('title')
Laporan Seleksi Mahasiswa Baru
@endsection


@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4>Data Laporan Mahasiswa Baru</h4>
            </div>
            <div class="card-body">
                <a href="{{route('mahasiswa_seleksi_mahasiswa_baru')}}">
                    <button type="button" class="btn btn-success ">
                        Kembali
                    </button></a><br><br>
                <div class="table-responsive">
                    <table id="dataTable" class="table table-hover">
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
                                <td>{{$no++}}</td>
                                <td>{{$data->tahun_akademik }}</td>
                                <td>{{$data->daya_tampung }}</td>
                                <td>{{$data->jumlah_calonMahasiswa_pendaftar }}</td>
                                <td>{{$data->jumlah_calonMahasiswa_lulus }}</td>
                                <td>{{$data->jumlah_mahasiswaBaru_reguler }}</td>
                                <td>{{$data->jumlah_mahasiswaBaru_transfer }}</td>
                                <td>{{$data->jumlah_mahasiswaAktif_reguler }}</td>
                                <td>{{$data->jumlah_mahasiswaAktif_transfer }}</td>
                                 <td><a href="{{route('prodi-file_download_mhs_asing',$data->id)}}"><button class="btn btn-info ">Download</button></a></td>
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