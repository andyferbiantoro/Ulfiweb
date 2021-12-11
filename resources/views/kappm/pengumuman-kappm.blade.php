@extends('layouts.kappm-master')

@section('title')
    Pengumuman Kappm
@endsection


@section('content')
   
<div class="row">
 <div class="col-lg-12">
              <div class="card">
                <!-- <div class="card-header">
                  <h4>ini pengumuman Kappm</h4>
                </div> -->
                <div class="card-body">
                                   <!-- Button trigger modal -->
                  <button type="button" class="btn btn-success " data-toggle="modal" data-target="#ModalTambahPengumuman">
                    Tambah Pengumuman
                  </button><br><br>
                    @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
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
                                      <td><!-- {{$data->gambar}} -->
                                          <img src="{{asset('uploads/pengumuman/'.$data->gambar)}}" width="100px" height="50px" style="border-radius: 0%;">
                                       
                                     </td>
                                     <td>{{$data->keterangan}}</td>
                                      <td> 

                                            <a href="{{route('kappm-lihat_pengumuman', ['id' => $data->id])}}">
                                                <button class="edit btn btn-warning btn-sm fa fa-eye" title="Lihat"></button>
                                            </a>
                                            @if($data->role == Auth::user()->role)
                                            <a href="{{route('kappm-get_edit_pengumuman', ['id' => $data->id])}}">
                                                <button class="edit btn btn-success btn-sm fa fa-edit" title="Edit"></button>
                                            </a>
                                            <a href="javascript:;" data-toggle="modal" onclick="deleteData({{$data->id}})" data-target="#DeleteModal">
                                                <button class="btn btn-danger btn-sm fa fa-trash" title="Hapus"></button>
                                            </a>
                                           @endif
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
<div class="modal fade" id="ModalTambahPengumuman" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
       <form method="post" action="{{url('kappm-tambah_pengumuman')}}" enctype="multipart/form-data">  
                                   
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



<!-- Modal konfirmasi Hapus -->
 <div id="DeleteModal" class="modal fade" role="dialog">
        <div class="modal-dialog ">
            <!-- Modal content-->
            <form action="" id="deleteForm" method="post">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Hapus Pengumuman</h5>
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
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        {{ csrf_field() }}
                        {{ method_field('POST') }}
                        <p>Apakah anda yakin ingin menghapus pengumuman ini ?</p>
                        <button type="button" class="btn btn-secondary float-right" data-dismiss="modal">Batal</button>
                        <button type="submit" name="" class="btn btn-danger float-right mr-2" data-dismiss="modal" onclick="formSubmit()">Hapus</button>
                    </div>
                </div>
            </form>
        </div>
    </div> 

</div>


    <script type="text/javascript">
        function deleteData(id) {
            var id = id;
            var url = '{{route("kappm-hapus_pengumuman", ":id") }}';
            url = url.replace(':id', id);
            $("#deleteForm").attr('action', url);
        }

        function formSubmit() {
            $("#deleteForm").submit();
        }
    </script>
@endsection
