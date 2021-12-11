@extends('layouts.prodi-master')

@section('title')
    Edit Perjanjian Kinerja
@endsection


@section('content')
   
<div class="row">
 <div class="col-lg-8">
              <div class="card">
                <div class="card-header">
                  <h4>Edit Perjanjian Prodi</h4>
                </div>
                <div class="card-body">
                   @foreach($data_perjanjian as $data)
                    <form method="post" action="{{url('/prodi-edit_file_perjanjian',$data->id)}}" enctype="multipart/form-data">
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
                       
                        {{csrf_field()}}
                         {{method_field('PUT')}}
                        

                          
                           <div class="form-group">
                                <label for="file_bukti_lampiran">File</label>
                                 <input type="text" name="file_bukti_lampiran" class="form-control" disabled="" value="{{$data->file_bukti_lampiran}}">
                                <input type="file" class="form-control" id="file_bukti_lampiran" name="file_bukti_lampiran"/>
                            </div>

                            <div class="form-group">
                              <input type="hidden" class="form-control" id="id_user" name="id_user" value="{{ Auth::user()->id }}" />
                            </div>

                             <button class="btn btn-primary" type="Submit">Ganti File</button>

                          
                        </form><br><br>


                 <form method="post" action="{{url('/prodi-proses_edit_perjanjian_kinerja',$data->id)}}" enctype="multipart/form-data">
                           
                        {{csrf_field()}}
                            <div class="form-group">
                                <label for="sasaran_kegiatan">Sasaran Kegiatan</label>
                                <input type="text" class="form-control" id="sasaran_kegiatan" name="sasaran_kegiatan" required="" value="{{$data->sasaran_kegiatan}}" />
                            </div>

                            <div class="form-group">
                                <label for="indikator_kinerja_kegiatan">Indikator Kinerja Kegiatan</label>
                                <input type="text" class="form-control" id="indikator_kinerja_kegiatan" name="indikator_kinerja_kegiatan" required="" value="{{$data->indikator_kinerja_kegiatan}}" />
                            </div>

                            <div class="form-group">
                                <label for="satuan">Satuan</label>
                                <input type="text" class="form-control" id="satuan" name="satuan" required="" value="{{$data->satuan}}" />
                            </div>

                            <div class="form-group">
                                <label for="target">Target</label>
                                <input type="text" class="form-control" id="target" name="target" required="" value="{{$data->target}}" />
                            </div>

                            <div class="form-group">
                                <label for="realisasi_triwulan1">Realisasi Triwulan 1</label>
                                <input type="text" class="form-control" id="realisasi_triwulan1" name="realisasi_triwulan1" required="" value="{{$data->realisasi_triwulan1}}" />
                            </div>

                            <div class="form-group">
                                <label for="realisasi_triwulan2">Realisasi Triwulan 2</label>
                                <input type="text" class="form-control" id="realisasi_triwulan2" name="realisasi_triwulan2" required="" value="{{$data->realisasi_triwulan2}}" />
                            </div>

                            <div class="form-group">
                                <label for="realisasi_triwulan3">Realisasi Triwulan 3</label>
                                <input type="text" class="form-control" id="realisasi_triwulan3" name="realisasi_triwulan3" required="" value="{{$data->realisasi_triwulan3}}" />
                            </div>

                            <div class="form-group">
                                <label for="akhir_tahun">Akhir Tahun</label>
                                <input type="text" class="form-control" id="akhir_tahun" name="akhir_tahun" required="" value="{{$data->akhir_tahun}}" />
                            </div>

                          
                            <div class="form-group">
                                <label for="link_bukti_lampiran">Link Bukti Lampiran</label>
                                <input type="text" class="form-control" id="link_bukti_lampiran" name="link_bukti_lampiran" required="" value="{{$data->link_bukti_lampiran}}" />
                            </div>

                            <div class="form-group">
                              <input type="hidden" class="form-control" id="id_user" name="id_user" value="{{ Auth::user()->id }}" />
                            </div>

                             <button class="btn btn-primary" type="Submit">Edit Perjanjian Kinerja</button>

                          
                        </form>
                      @endforeach  
                </div>
              </div>
            </div>
</div>
@endsection
