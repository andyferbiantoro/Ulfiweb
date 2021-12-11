@extends('layouts.lkps-master')

@section('title')
Laporan EWMP Dosen Tetap Perguruan Tinggi
@endsection


@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4>Data Laporan EWMP Dosen Tetap Perguruan Tinggi</h4>
            </div>
            <div class="card-body">
                <a href="{{route('profil_dosen_ewmp_dosen_tetap_perguruan_tinggi')}}">
                    <button type="button" class="btn btn-success ">
                        Kembali
                    </button></a><br><br>
                <div class="table-responsive">
                    <table id="dataTable" class="table table-hover">
                        <thead>
                            <tr>
                                <th rowspan="3" style="text-align: center; vertical-align: middle;">No</th>
                                <th rowspan="3" style="text-align: center; vertical-align: middle;">Nama Dosen (DT)</th>
                                <th rowspan="3" style="text-align: center; vertical-align: middle;">DTPS</th>
                                <th colspan="6" style="text-align: center; vertical-align: middle;">Ekuivalen Waktu Mengajar Penuh (EWMP) pada saat TS dalam satuan kredit semester (sks)</th>
                                <th rowspan="3" style="text-align: center; vertical-align: middle;">Jumlah (sks)</th>
                                <th rowspan="3" style="text-align: center; vertical-align: middle;">Rata-rata per Semester (sks)</th>
                                <th rowspan="3" style="text-align: center; vertical-align: middle;">File Bukti Dokumen</th>
                                <th rowspan="3" style="text-align: center; vertical-align: middle;">Link Bukti Dokumen</th>
                                <th rowspan="3" style="text-align: center; vertical-align: middle;">Tahun</th>
                            </tr>
                            <tr>
                                <th colspan="3" style="text-align: center; vertical-align: middle;">Pendidikan : Pembelajaran dan Pembimbingan</th>
                                <th rowspan="2" style="text-align: center; vertical-align: middle;">Penelitian</th>
                                <th rowspan="2" style="text-align: center; vertical-align: middle;">Pengabdian Kepada Masyarakat</th>
                                <th rowspan="2" style="text-align: center; vertical-align: middle;">Tugas Tambahan dan Penunjang</th>
                               
                            </tr>
                            <tr>
                                <th style="text-align: center; vertical-align: middle;">Program Studi yang Diakreditasi</th>
                                <th style="text-align: center; vertical-align: middle;">Program Studi Lain di Dalam Perguruan Tinggi</th>
                                <th style="text-align: center; vertical-align: middle;">Program Studi Lain di Luar Perguruan Tingi</th>
                            </tr>
                        </thead>
                        <tbody>
                           @php $no=1 @endphp
                               @foreach($data_ewmp_dosen as $data)
                               <tr>
                                <td>{{$no++ }}</td>
                                <td>{{$data->nama_dosen }}</td>
                                <td>{{$data->dtps }}</td>
                                <td>{{$data->ewmp_pendidikanProdi_diakreditasi }}</td>
                                <td>{{$data->ewmp_pendidikanProdiLain_didalamPerguruanTinggi }}</td>
                                <td>{{$data->ewmp_pendidikanProdiLain_diluarPerguruanTinggi }}</td>
                                <td>{{$data->ewmp_penelitian }}</td>
                                <td>{{$data->ewmp_pkm }}</td>
                                <td>{{$data->ewmp_tugas_tambahan }}</td>
                                <td>{{$data->jumlah_sks }}</td>
                                <td>{{$data->rata2_per_semester }}</td>
                                <td><a href="{{route('prodi-file_download_bukti_dokumen_ewmp',$data->id)}}"><button class="btn btn-info ">Download</button></a></td>
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