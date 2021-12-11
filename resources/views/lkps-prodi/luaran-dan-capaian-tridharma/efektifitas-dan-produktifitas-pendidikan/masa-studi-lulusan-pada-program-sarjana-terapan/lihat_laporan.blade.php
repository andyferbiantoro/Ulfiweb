@extends('layouts.lkps-prodi-master')

@section('title')
Laporan Masa Studi Lulusan pada Program Sarjana Terapan
@endsection


@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4>Data Laporan Masa Studi Lulusan pada Program Sarjana Terapan</h4>
            </div>
            <div class="card-body">
                <a href="{{route('prodi_masa_studi_lulusan_program_sarajana_terapan')}}">
                    <button type="button" class="btn btn-success ">
                        Kembali
                    </button></a><br><br>
                    <button class="btn btn-success mb-2" onclick="print('printPDF', 'Title')">Cetak PDF</button>
                <div class="table-responsive">
                    <table id="dataTable" class="table table-hover">
                        <thead>
                            <tr>
                                <th rowspan="2" style="text-align: center; vertical-align: middle;">No</th>
                                <th rowspan="2" style="text-align: center; vertical-align: middle;">Tahun Masuk</th>
                                <th rowspan="2" style="text-align: center; vertical-align: middle;">Jumlah Mahasiswa Diterima</th>
                                <th colspan="7" style="text-align: center; vertical-align: middle;">Jumlah Mahasiswa yang Lulus pada</th>
                                <th rowspan="2" style="text-align: center; vertical-align: middle;">Jumlah Luusan sampai dengan Akhir TS</th>
                                <th rowspan="2" style="text-align: center; vertical-align: middle;">Rata-rata Masa Studi</th>
                                <th rowspan="2" style="text-align: center; vertical-align: middle;">File Bukti Dokumen</th>
                                <th rowspan="2" style="text-align: center; vertical-align: middle;">Link Bukti Dokumen</th>
                            </tr>
                            <tr>
                                <th style="text-align: center; vertical-align: middle;">Akhir TS-6</th>
                                <th style="text-align: center; vertical-align: middle;">Akhir TS-5</th>
                                <th style="text-align: center; vertical-align: middle;">Akhir TS-4</th>
                                <th style="text-align: center; vertical-align: middle;">Akhir TS-3</th>
                                <th style="text-align: center; vertical-align: middle;">Akhir TS-2</th>
                                <th style="text-align: center; vertical-align: middle;">Akhir TS-1</th>
                                <th style="text-align: center; vertical-align: middle;">Akhir TS</th>

                            </tr>
                        </thead>
                        <tbody>
                             @php $no=1 @endphp
                            @foreach($masastudi_lulusan_sarajana_terapan as $data)
                            <tr>
                                <td>{{$no++ }}</td>
                                <td>{{$data->tahun_masuk }}</td>
                                <td>{{$data->jumlah_mahasiswa_diterima }}</td>
                                <td>{{$data->jumlah_mahasiswaLulus_akhirTs6 }}</td>
                                <td>{{$data->jumlah_mahasiswaLulus_akhirTs5 }}</td>
                                <td>{{$data->jumlah_mahasiswaLulus_akhirTs4 }}</td>
                                <td>{{$data->jumlah_mahasiswaLulus_akhirTs3 }}</td>
                                <td>{{$data->jumlah_mahasiswaLulus_akhirTs4 }}</td>
                                <td>{{$data->jumlah_mahasiswaLulus_akhirTs1 }}</td>
                                <td>{{$data->jumlah_mahasiswaLulus_akhirTs }}</td>
                                <td>{{$data->jumlah_mhs }}</td>
                                <td>{{$data->rataRata_masa_studi }}</td>
                                <td><a href="{{route('prodi-file_download_dokumen_masastudi_sarajana_terapan',$data->id)}}"><button class="btn btn-info ">Download</button></a></td>
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