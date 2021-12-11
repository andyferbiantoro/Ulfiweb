@extends('layouts.auditor-master')

@section('title')
    Dashboard Auditor
@endsection


@section('content')
   
<div class="row">
 <div class="col-lg-12">
              <div class="card">
                <!-- <div class="card-header">
                  <h4>Halaman Dashboard Auditor</h4>
                </div> -->
                <div class="card-body">
                   <div class="text-center" >
                <div id="carouselExampleIndicators3" class="carousel slide" data-ride="carousel">
                      <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators3" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators3" data-slide-to="1"></li>
                        <li data-target="#carouselExampleIndicators3" data-slide-to="2"></li>
                      </ol>
                      <div class="carousel-inner">
                        <div class="carousel-item active">
                          <img class="d-block w-100"  src="../assets/img/news/poliwangi1.jpg" alt="First slide">
                        </div>
                        <div class="carousel-item">
                          <img class="d-block w-100" src="../assets/img/news/poliwangi2.jpg" alt="Second slide">
                        </div>
                        <div class="carousel-item">
                          <img class="d-block w-100" src="../assets/img/news/poliwangi3.jpg" alt="Third slide">
                        </div>
                      </div>
                      <a class="carousel-control-prev" href="#carouselExampleIndicators3" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                      </a>
                      <a class="carousel-control-next" href="#carouselExampleIndicators3" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                      </a>
                    </div>
                    <!-- <span class="avatar">
                        <img src="../img/brilliant1.jpg" >
                    </span><br> -->
                </div>
                 
                 <!--  <button class="btn btn-success fas fa-plus fa-2a"></button> -->
                </div>
              </div>
            </div>
</div>


<div class="row">
 <div class="col-lg-2"></div>
  <div class="col-lg-8">
  <div class="card">
    <div class="card-header">
      <h4>Pengumuman</h4>
    </div>
    @foreach($data_pengumuman as $data)
    <div class="card-body">
      <div class="text-center">
         <img alt="image" src="{{asset('uploads/pengumuman/'.$data->gambar)}}" class="img-fluid"><br><br>
         <h4>{{$data->judul}}</h4><br>

         <p style="text-align: justify">{{$data->keterangan}}</p>

      </div>
    </div>
    @endforeach
  </div>   
  </div>
  <div class="col-lg-2"></div>
</div>
@endsection


