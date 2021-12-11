@extends('layouts.auditor-master')

@section('title')
    Pengumuman Auditor
@endsection


@section('content')
   
<div class="row">
 <div class="col-lg-12">
              <div class="card">
                <!-- <div class="card-header">
                  <h4>ini pengumuman auditor</h4>
                </div> -->
                <div class="card-body">
                                   <!-- Button trigger modal -->
                  
                    <div class="table-responsive">
                    <table id="dataTable" class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Judul</th>
                                    <th scope="col">Gambar</th>
                                    <th scope="col">Keterangan</th>
                                    <th scope="col">Aksi</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                @php $no=1 @endphp
                                @foreach ($data_pengumuman as $data)
                                    <tr>
                                      <td scope="row">{{ $no++ }}</td>
                                      <td>{{$data->judul}}</td>
                                      <td>
                                          <img src="{{asset('uploads/pengumuman/'.$data->gambar)}}" width="100px" height="50px" style="border-radius: 0%;">
                                       
                                     </td>
                                     <td >{{$data->keterangan}}</td>
                                     <td>
                                        <a href="{{route('auditor-lihat_pengumuman', ['id' => $data->id])}}">
                                                <button class="edit btn btn-warning btn-sm fa fa-eye" title="Lihat"></button>
                                        </a>
                                     </td>
                                      
                                    </tr>
                                @endforeach
                            </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>


            <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Pengumuman</h5>
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
      </div>
      <div class="modal-body">
       <form method="post" action="{{url('auditor-tambah_pengumuman')}}" enctype="multipart/form-data">
                           
                                   
                        {{csrf_field()}}
                            <div class="form-group">
                                <label for="judul">Judul</label>
                                <input type="text" class="form-control" id="judul" name="judul" required=""/>
                            </div>

                           <div class="form-group">
                                <label for="gambar">gambar</label>
                                <input type="file" class="form-control" id="gambar" name="gambar" required=""/>
                            </div>

                            <div class="form-group">
                                <label for="keterangan">Keterangan</label>
                                <textarea class="form-control" id="keterangan" name="keterangan"></textarea>
                               
                            </div>

                            <div class="form-group">
                              <input type="hidden" class="form-control" id="id_user" name="id_user" value="{{ Auth::user()->id }}" />
                            </div>

                             <button class="btn btn-primary" type="Submit">Tambah Pengumuman</button>
                        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
        
      </div>
    </div>
  </div>
</div>

</div>
@endsection
