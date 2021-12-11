@extends('layouts.lkps-master')

@section('title')
Laporan Penelitian DTPS
@endsection


@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4>Data Laporan Penelitian DTPS</h4>
            </div>
            <div class="card-body">
               <div class="text-right">
                <form class="form-inline">
                  <div class="form-group mx-sm-1 mb-2">
                    <!-- <label for="inputPassword2" class="sr-only">Password</label> -->

                    <!-- Filter Prodi -->
                    <div class="form-group">
                      <select type="text" class="form-control" id="filter_prodi" name="filter_prodi" required="">
                        <option selected disabled value=""> -- Pilih Program Studi -- </option>
                        @foreach($prodi as $prodi)
                        <option value="{{$prodi->id}}" @if($prodi->id == $prod) {{'selected="selected"'}} @endif>{{$prodi->nama_prodi}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-primary mb-2 fa fa-filter">Filter Prodi</button>

            <!-- filter tahun -->
            <div class="form-group mx-sm-1 mb-2">
                <!-- <label for="inputPassword2" class="sr-only">Password</label> -->
                <input type="text" class="form-control" id="filter" name="filter" placeholder="Tahun"  value="{{ old('filter') }}">
            </div>
            <button type="submit" class="btn btn-primary mb-2 fa fa-filter">Filter</button>

        </form><br>
    </div>
    
    <a href="{{route('kinerja_dosen_penelitian_dtps')}}">
        <button type="button" class="btn btn-success ">
            Kembali
        </button></a><br><br>
        <div class="table-responsive">
            <table id="dataTable" class="table table-hover">
                <thead>
                    <tr>
                        <th rowspan="2" style="text-align: center; vertical-align: middle;">No</th>
                        <th rowspan="2" style="text-align: center; vertical-align: middle;">Sumber Pembiayaan</th>
                        <th colspan="3" style="text-align: center; vertical-align: middle;">Jumlah Judul Penelitian</th>
                        <th rowspan="2" style="text-align: center; vertical-align: middle;">Jumlah</th>
                        <th rowspan="2" style="text-align: center; vertical-align: middle;">Tahun Akademik</th>
                        <th rowspan="2" style="text-align: center; vertical-align: middle;">File Bukti Dokumen</th>
                        <th rowspan="2" style="text-align: center; vertical-align: middle;">Link Bukti Dokumen</th>
                    </tr>
                    <tr>
                        <th style="text-align: center; vertical-align: middle;">TS-2</th>
                        <th style="text-align: center; vertical-align: middle;">TS-1</th>
                        <th style="text-align: center; vertical-align: middle;">TS</th>
                    </tr>
                </thead>
                <tbody>
                   @php $no=1 @endphp
                   @foreach($data_penelitian_dtps as $data)
                   <tr>
                    <td>{{$no++ }}</td>
                    <td>{{$data->sumber_pembiayaan }}</td>
                    <td>{{$data->jumlah_judulPenelitian_ts2 }}</td>
                    <td>{{$data->jumlah_judulPenelitian_ts1 }}</td>
                    <td>{{$data->jumlah_judulPenelitian_ts }}</td>
                    <td>{{$data->jumlah }}</td>
                    <td>{{$data->tahun_akademik }}</td>
                    <td><a href="{{route('prodi-file_download_file_bukti_dokumen',$data->id)}}"><button class="btn btn-info ">Download</button></a></td>
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