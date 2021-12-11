@extends('layouts.auditor-master')

@section('title')
    Edit Hasil Penilaian LKPS
@endsection


@section('content')
   
<div class="row">
 <div class="col-lg-8">
              <div class="card">
                <div class="card-header">
                  <h4>Edit Hasil Penilaian LKPS</h4>
                </div>
                <div class="card-body">
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
                   @foreach($data_penilaian as $data)
                   <form method="post" action="{{url('/auditor-proses_edit_file_penilaian',$data->id)}}" enctype="multipart/form-data">
                           
                       
                        {{csrf_field()}}
                         {{method_field('PUT')}}
                        
                           <div class="form-group">
                                <label for="lampiran_file">Lampiran File</label>
                                <input type="text" name="lampiran_file" class="form-control" disabled="" value="{{$data->lampiran_file}}">
                                <input type="file" class="form-control" id="lampiran_file" name="lampiran_file"/>
                            </div>

                            <div class="form-group">
                              <input type="hidden" class="form-control" id="id_user" name="id_user" value="{{ Auth::user()->id }}" />
                            </div>

                             <button class="btn btn-primary" type="Submit">Ganti File</button>

                          
                        </form><br><br>

                 <form method="post" action="{{url('/auditor-proses_edit_penilaian_lkps',$data->id)}}" enctype="multipart/form-data">
                           
                       
                        {{csrf_field()}}

                            <div class="form-group">
                                <label for="tanggal">Tanggal</label>
                                <input type="date" class="form-control" id="tanggal" name="tanggal" required="" value="{{$data->tanggal}}" />
                            </div>

                            <div class="form-group">
                                <label for="keterangan">Keterangan</label>
                                <input type="text" class="form-control" id="keterangan" name="keterangan" required="" value="{{$data->keterangan}}" />
                            </div>

                           

                            <div class="form-group">
                                <label for="lampiran_link">Lampiran Link</label>
                                <input type="text" class="form-control" id="lampiran_link" name="lampiran_link" required="" value="{{$data->lampiran_link}}" />
                            </div>

                            <div class="form-group">
                              <input type="hidden" class="form-control" id="id_user" name="id_user" value="{{ Auth::user()->id }}" />
                            </div>

                             <button class="btn btn-primary" type="Submit">Edit Penilaian</button>

                          
                        </form>
                      @endforeach  
                </div>
              </div>
            </div>
</div>
@endsection
