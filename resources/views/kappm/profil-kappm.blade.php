@extends('layouts.kappm-master')

@section('title')
    Profil Kappm
@endsection


@section('content')
   
<div class="row">
 <div class="col-lg-12">
              <div class="card">
                <div class="card-header">
                  <h4>Data Kelola Akun</h4>
                </div>
                <div class="card-body">
                   <button type="button" class="btn btn-success " data-toggle="modal" data-target="#ModalTambahAkun">
                    Tambah Akun
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
                                    <th scope="col">Role</th>
                                    <th scope="col">Username</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $no=1 @endphp
                                @foreach ($data_user as $data)
                                    <tr>
                                      <td scope="row">{{ $no++ }}</td>
                                      <td>{{$data->role}}</td>
                                      <td>{{$data->username}}</td>
                                     
                                      <td> 
                                            <a href="{{route('kappm-edit_akun', ['id' => $data->id])}}">
                                                <button class="edit btn btn-success btn-sm fa fa-edit" title="Edit"></button>
                                            </a>
                                            <a href="javascript:;" data-toggle="modal" onclick="deleteData({{$data->id}})" data-target="#DeleteModal">
                                                <button class="btn btn-danger btn-sm fa fa-trash" title="Hapus"></button>
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
</div>



 <!-- Modal -->
<div class="modal fade" id="ModalTambahAkun" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Akun</h5>
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
       <form method="post" action="{{url('kappm-tambah_akun')}}" enctype="multipart/form-data">  
                                   
                        {{csrf_field()}}
                           <div class="form-group">
                              <label> Pilih Role</label>
                                  <select name="role" class="form-control" required="">
                                          <option selected disabled> -- Pilih Role -- </option>
                                          <option>kappm</option>
                                          <option>prodi</option>
                                          <option>auditor</option>
                                  </select>
                           </div>

                            <div class="form-group">
                                <label for="username">username</label>
                                <input type="text" class="form-control" id="username" name="username" required=""/>
                            </div>

                            <div class="form-group">
                                <label for="password">password</label>
                                <input type="password" class="form-control" id="password" name="password" required=""/>
                            </div>

                             <button class="btn btn-primary" type="Submit">Tambah Akun</button>
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
                        <h5 class="modal-title">Hapus Akun</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        {{ csrf_field() }}
                        {{ method_field('POST') }}
                        <p>Apakah anda yakin ingin menghapus Akun ini ?</p>
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
            var url = '{{route("kappm-hapus_user", ":id") }}';
            url = url.replace(':id', id);
            $("#deleteForm").attr('action', url);
        }

        function formSubmit() {
            $("#deleteForm").submit();
        }
    </script>
@endsection
