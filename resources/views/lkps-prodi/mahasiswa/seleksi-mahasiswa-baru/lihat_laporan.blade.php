@extends('layouts.lkps-prodi-master')

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
                <a href="{{route('prodi_mahasiswa_seleksi_mahasiswa_baru')}}">
                    <button type="button" class="btn btn-success ">
                        Kembali
                    </button></a><br><br>
                                <button class="btn btn-success mb-2" onclick="print('printPDF')">Cetak PDF</button>
                <div id="printPDF">
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
</div>





@endsection
@section('scripts')

<script type="text/javascript">
    function print(elem) {
        var mywindow = window.open('', 'PRINT', 'height=1000,width=1200');

        mywindow.document.write('<html><head><link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">');
        mywindow.document.write('</head><body >');
        mywindow.document.write('<h1 class="text-center">' + 'Laporan Data LKPS' + '</h1>');
        mywindow.document.write('<br><br>');
        mywindow.document.write(document.getElementById(elem).innerHTML);
        mywindow.document.write('</body></html>');
    mywindow.document.close(); // necessary for IE >= 10
    mywindow.focus(); // necessary for IE >= 10*/

    mywindow.print();
    // mywindow.close();

    return true;

}
</script>  
@endsection
