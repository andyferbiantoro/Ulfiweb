@extends('layouts.auditor-master')

@section('title')
    Lihat Pengumuman auditor
@endsection


@section('content')
   
<div class="row">
 <div class="col-lg-12">
              <div class="card">
                <div class="card-header">
                  <h4>Lihat pengumuman auditor</h4>
                </div>
                <div class="card-body">
                      @foreach($data_pengumuman as $data)
                       
                        <div class="text-center">
                           <img alt="image" src="{{asset('uploads/pengumuman/'.$data->gambar)}}" class="img-fluid"><br><br>
                           <h4>{{$data->judul}}</h4><br>

                           <p style="text-align: justify">{{$data->keterangan}}</p>

                        </div>
                      @endforeach  
                </div>
              </div>
            </div>
</div>
@endsection
