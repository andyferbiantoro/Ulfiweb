@extends('layouts.kappm-master')

@section('title')
Penunjukan Auditor
@endsection


@section('content')

<!-- Card View -->

<div class="row">
  <div class="col-lg-12">
    <div class="card">
      @if (session('success'))
           <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif
      <div class="card-header text-center">
        <h4 >Penunjukan Auditor</h4>
      </div>

      <!-- Button Untuk tambah Data dengan modal -->
        <div class="card-body">
            
                <form class="form-inline" method="post" action="{{route('kappm-proses_penunjukan_auditor')}}">
                    {{csrf_field()}}
                    <div class="form-group mx-sm-1 mb-2">
                      
                        <!-- <label for="inputPassword2" class="sr-only">Password</label> -->
                        <select type="text" class="form-control" id="nama_prodi" name="id_prodi" required="">
                          <option selected disabled value=""> -- Pilih Program Studi -- </option>
                          @foreach($prodi as $prodi)
                          <option value="{{$prodi->id}}">{{$prodi->nama_prodi}}</option>
                          @endforeach
                        </select>

                        <select type="text" style="margin-left: 10px;" class="form-control" id="id_user_auditor1" name="id_user_auditor1" >
                          @foreach($auditor as $auditor)
                          <option value="{{$auditor->id}}">{{$auditor->username}}</option>
                          @endforeach
                        </select>

                        <select type="text" style="margin-left: 10px;" class="form-control" id="id_user_auditor2" name="id_user_auditor2" >
                         @foreach($auditor2 as $auditor2)
                         <option value="{{$auditor2->id}}">{{$auditor2->username}}</option>
                          @endforeach
                        </select>

                        <input type="text" style="margin-left: 10px;" class="form-control" id="tahun" name="tahun" placeholder="Tahun" >

                    </div>
                  <button type="submit" class="btn btn-primary mb-2">Tambah</button>
                </form><br><br>

                <div class="table-responsive">
                    <table id="dataTable" class="table table-hover">
                        <thead>
                            <tr>
                                <th style="text-align: center; vertical-align: middle;">No</th>
                                <th style="text-align: center; vertical-align: middle;">Program Studi</th>
                                <th style="text-align: center; vertical-align: middle;">Auditor 1</th>
                                <th style="text-align: center; vertical-align: middle;">Auditor 2</th>
                                <th style="text-align: center; vertical-align: middle;">Tahun</th>
                                <th style="text-align: center; vertical-align: middle;">Aksi</th>
                                <!-- <th style="display: none;">id_hidden</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            @php $no=1 @endphp
                            @foreach($data_penunjukan as $data)
                            <tr>
                                <td style="text-align: center; vertical-align: middle;">{{$no++}}</td>
                                <td style="text-align: center; vertical-align: middle;">{{$data->nama_prodi}}</td>
                                <td style="text-align: center; vertical-align: middle;">{{$data->username}}</td>
                                <td style="text-align: center; vertical-align: middle;">{{$data->username}}</td>
                                <td style="text-align: center; vertical-align: middle;">{{$data->tahun}}</td>
                               
                                <td>
                                     <!-- <a href="">
                                        <button class="btn-sm btn btn-warning fa fa-eye" title="Lihat"></button>
                                    </a> -->
                                    <!-- <button class="btn btn-success btn-sm fa fa-edit edit" title="Edit"></button> -->

                                    <!-- <a href="#" data-toggle="modal" onclick="" data-target="#DeleteModal">
                                        <button class="btn btn-danger btn-sm fa fa-trash" title="Hapus"></button>
                                    </a> -->
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        
                    </table>
      </div>

    </div>
  </div>
</div>
    @endsection