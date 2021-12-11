@extends('layouts.prodi-master')

@section('title')
    Hasil Penilaian LKPS
@endsection


@section('content')
   
<div class="row">
 <div class="col-lg-12">
              <div class="card">
                <div class="card-header">
                  <h4>Lihat Data Hasil Penilaian Laporan Kinerja Program Study</h4>
                </div>
                <div class="card-body">
                 <div class="table-responsive">
                    <table id="dataTable" class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Keterangan</th>
                                    <th scope="col">Lampiran File</th>
                                    <th scope="col">Lampiran Link</th>
                                </tr>
                            </thead>
                            <tbody>
                               @php $no=1 @endphp
                                @foreach($hasil_penilaian_lkps as $hasil)
                                <tr>
                                     <td scope="row">{{ $no++ }}</td>
                                     <td>{{$hasil->tanggal}}</td>
                                     <td>{{$hasil->keterangan}}</td>
                                     <td><a href="{{route('prodi-file_penilaian_download',$hasil->id)}}"><button class="btn btn-info">Download</button></a></td>
                                     <td><a href="{{$hasil->lampiran_link}}">{{$hasil->lampiran_link}}</a></td>
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
