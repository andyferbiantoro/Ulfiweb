@extends('layouts.lkps-master')

@section('title')
Laporan Dosen Pembimbing Utama Tugas Akhir
@endsection


@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4>Data Laporan Dosen Pembimbing Utama Tugas Akhir</h4>
            </div>
            <div class="card-body">
                <a href="{{route('profil_dosen_dosen_pembimbing_utama_tugas_akhir')}}">
                    <button type="button" class="btn btn-success ">
                        Kembali
                    </button></a><br><br>
                <div class="table-responsive">
                    <table id="dataTable" class="table table-hover">
                        <thead>
                            <tr>
                                <th rowspan="3" style="text-align: center; vertical-align: middle;">No</th>
                                <th rowspan="3" style="text-align: center; vertical-align: middle;">Tahun Akademik</th>
                                <th rowspan="3" style="text-align: center; vertical-align: middle;">Nama Dosen</th>
                                <th colspan="8" style="text-align: center; vertical-align: middle;">Jumlah Mahasiswa yang Dibimbing</th>
                                <th rowspan="3" style="text-align: center; vertical-align: middle;">Rata-rata Jumlah Bimbingan di Semua Program/Semester</th>
                                <th rowspan="3" style="text-align: center; vertical-align: middle;">File Bukti Dokumen</th>
                                <th rowspan="3" style="text-align: center; vertical-align: middle;">Link Bukti Dokumen</th>
                                <th rowspan="3" style="text-align: center; vertical-align: middle;">Aksi</th>
                            </tr>
                            <tr>
                                <th colspan="4" style="text-align: center; vertical-align: middle;">Pada Program Studi yang Diakreditasi</th>
                                <th colspan="4" style="text-align: center; vertical-align: middle;">Pada Program Studi Lain di Perguruan Tinggi</th>

                            </tr>
                            <tr>
                                <th style="text-align: center; vertical-align: middle;">TS-2</th>
                                <th style="text-align: center; vertical-align: middle;">TS-1</th>
                                <th style="text-align: center; vertical-align: middle;">TS</th>
                                <th style="text-align: center; vertical-align: middle;">Rata-rata</th>
                                <th style="text-align: center; vertical-align: middle;">TS-2</th>
                                <th style="text-align: center; vertical-align: middle;">TS-1</th>
                                <th style="text-align: center; vertical-align: middle;">TS</th>
                                <th style="text-align: center; vertical-align: middle;">Rata-rata</th>

                            </tr>
                        </thead>
                        <tbody>
                           @php $no=1 @endphp
                                @foreach($data_dospem_utama_tugasakhir as $data)
                                <tr>
                                    <td>{{$no++}}</td>
                                    <td>{{$data->tahun_akademik }}</td>
                                    <td>{{$data->nama_dosen }}</td>
                                    <td>{{$data->jumlahMahasiswa_prodiDiakreditasi_ts2 }}</td>
                                    <td>{{$data->jumlahMahasiswa_prodiDiakreditasi_ts1 }}</td>
                                    <td>{{$data->jumlahMahasiswa_prodiDiakreditasi_ts }}</td>
                                    <td>{{$data->rata2_1}}</td>
                                    <td>{{$data->jumlahMahasiswa_prodiLain_perguruanTinggi_ts2 }}</td>
                                    <td>{{$data->jumlahMahasiswa_prodiLain_perguruanTinggi_ts1 }}</td>
                                    <td>{{$data->jumlahMahasiswa_prodiLain_perguruanTinggi_ts}}</td>
                                    <td>{{$data->rata2_2}}</td>
                                    <td>{{$data->rata2_bimbingan}}</td>
                                    <td><a href="{{route('prodi-file_download_bukti_dokumen_dospem',$data->id)}}"><button class="btn btn-info ">Download</button></a></td>
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