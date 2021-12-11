@extends('layouts.prodi-master')

@section('title')
    Profil Prodi
@endsection


@section('content')
   
<div class="row">
 <div class="col-lg-8">
              <div class="card">
                <div class="card-header">
                  <h4>Kelola Akun Anda</h4>
                </div>
                <div class="card-body">
                 @foreach($data_profil as $data)
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
                 <form method="post" action="{{url('/prodi-proses_edit_profil',$data->id)}}" enctype="multipart/form-data">
                           
                       
                        {{csrf_field()}}
                            <div class="form-group">
                                <label for="username">username</label>
                                <input type="text" class="form-control" id="username" name="username" required="" value="{{$data->username}}" />
                            </div>


                             <button class="btn btn-primary" type="Submit">Ubah Username</button>
                             <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#ModalUbahPassword">
                             Ubah Password
                            </button>
                        </form>
                      @endforeach  
                  
                </div>
              </div>
            </div>
</div>



<div class="modal fade" id="ModalUbahPassword" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Perbarui Password</h5>
       
      </div>
      <div class="modal-body">
        @foreach($data_profil as $data)
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
                        <form method="post" action="{{url('/prodi-proses_edit_profil',$data->id)}}" enctype="multipart/form-data">      
                        {{csrf_field()}}

                            <div class="form-group">
                              <input type="hidden" class="form-control" id="username" name="username" value="{{ Auth::user()->username }}" />
                            </div>

                             <div class="form-group">
                                <label for="password">password</label>
                                <input type="password" class="form-control" id="password" name="password"  required="" />
                               
                            </div>

                             <div class="form-group">
                              <label for="repassword" class="d-block">Konfirmasi Password</label>
                              <input id="repassword" type="password" class="form-control" name="repassword" required="">
                            </div>


                             <button class="btn btn-primary" type="Submit">Ubah Password</button>
                        </form>
                         @endforeach 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
        
      </div>
    </div>
  </div>
</div>
@endsection
