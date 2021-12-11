@extends('layouts.kappm-master')

@section('title')
    Edit Pengumuman Kappm
@endsection


@section('content')
   
<div class="row">
 <div class="col-lg-8">
              <div class="card">
                <div class="card-header">
                  <h4>ini Edit pengumuman Kappm</h4>
                </div>
                <div class="card-body">
                   @foreach($data_pengumuman as $data)
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
                   <form method="post" action="{{url('/kappm-edit_gambar',$data->id)}}" enctype="multipart/form-data">
                           
                       
                        {{csrf_field()}}
                         {{method_field('PUT')}}
                          <img src="{{asset('uploads/pengumuman/'.$data->gambar)}}" width="200px" height="100px" style="border-radius: 0%;">

                           <div class="form-group">
                                <label for="gambar">gambar</label>
                                <input type="file" class="form-control" id="gambar" name="gambar"/>
                            </div>

                            <div class="form-group">
                              <input type="hidden" class="form-control" id="id_user" name="id_user" value="{{ Auth::user()->id }}" />
                            </div>

                             <button class="btn btn-primary" type="Submit">Ganti Gambar</button>

                          
                        </form><br><br>

                 <form method="post" action="{{url('/kappm-edit_pengumuman',$data->id)}}" enctype="multipart/form-data">
                           
                       
                        {{csrf_field()}}
                            <div class="form-group">
                                <label for="judul">Judul</label>
                                <input type="text" class="form-control" id="judul" name="judul" required="" value="{{$data->judul}}" />
                            </div>

                            <div class="form-group">
                                <label for="keterangan">Keterangan</label>
                                <textarea class="form-control" id="keterangan" name="keterangan"><?php echo $data['keterangan'] ?></textarea>
                            </div>

                            <div class="form-group">
                              <input type="hidden" class="form-control" id="id_user" name="id_user" value="{{ Auth::user()->id }}" />
                            </div>

                             <button class="btn btn-primary" type="Submit">Edit Pengumuman</button>

                          
                        </form>
                      @endforeach  
                </div>
              </div>
            </div>
</div>
@endsection
