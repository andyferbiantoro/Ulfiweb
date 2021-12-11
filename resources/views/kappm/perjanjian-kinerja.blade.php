@extends('layouts.kappm-master')

@section('title')
    Perjanjian Kinerja
@endsection


@section('content')
   
<div class="row">
 <div class="col-lg-12">
              <div class="card">
                <div class="card-header">
                  <h4>Lihat Laporan data Perjanjian Kinerja</h4>
                </div>
                <div class="card-body">
                 <div class="table-responsive">
                    <table id="dataTable" class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Sasaran Kegiatan</th>
                                    <th scope="col">Indikator Kinerja Kegiatan</th>
                                    <th scope="col">Satuan</th>
                                    <th scope="col">Target</th>
                                    <th scope="col">Realisasi Triwulan 1</th>
                                    <th scope="col">Realisasi Triwulan 2</th>
                                    <th scope="col">Realisasi Triwulan 3</th>
                                    <th scope="col">Akhir Tahun</th>
                                    <th scope="col">% Realisasi</th>
                                    <th scope="col">File Bukti Lampiran</th>
                                    <th scope="col">Link Bukti Lampiran</th>
                                </tr>
                            </thead>
                            <tbody>
                               @php $no=1 @endphp
                                @foreach($perjanjian_kinerja as $per)
                               <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{$per->sasaran_kegiatan}}</td>
                                    <td>{{$per->indikator_kinerja_kegiatan}}</td>
                                    <td>{{$per->satuan}}</td>
                                    <td>{{$per->target}}</td>
                                    <td>{{$per->realisasi_triwulan1}}</td>
                                    <td>{{$per->realisasi_triwulan2}}</td>
                                    <td>{{$per->realisasi_triwulan3}}</td>
                                    <td>{{$per->akhir_tahun}}</td>
                                    <td>{{($per->realisasi_triwulan1+$per->realisasi_triwulan2+$per->realisasi_triwulan3)/$per->target}}</td>
                                    <td><a href="{{route('kappm-file_perjanjian_download',$per->id)}}"><button class="btn btn-info">Download</button></a></td>
                                    <td><a href="{{$per->link_bukti_lampiran}}">{{$per->link_bukti_lampiran}}</a></td>
                               </tr>
                               @endforeach
                            </tbody>
                    </table>
                  </div>
                </div>
                  
                </div>
              </div>
            </div>

            <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <b> Keterangan : </b><br>
                        <p style="font-size: 10px;">
                        Unggah link drive bukti lampiran seperti : <br>
                            a. Dokumen Daftar Mahasiswa untuk Mahasiswa yang berhasil mendapat pekerjaan, melanjutkan studi, menjadi 
                            wiraswasta, menghabiskan paling sedikit 20 (dua puluh) sks di luar kampus dan yang meraih prestasi paling rendah tingkat nasional. <br>
                            b. Dokumen Daftar Dosen bersertifikat dan scan sertifikat untuk Dosen bersertifikat. 
                        </p>
                    </div>
                </div>
            </div>
        </div>


        <!-- Untuk Mengatur Komentar -->
<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-body">
        <b> Komentar : </b><br><br>
        <form method="post" action="{{route('kappm_komentar_add')}}" enctype="multipart/form-data">
          {{csrf_field()}}
          <textarea type="text" placeholder="Tulis Komentar...." class="form-control" id="isi_komentar" name="isi_komentar"></textarea> <br>
          <button class="btn btn-primary" type="Submit">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- end komentar -->

</div>
@endsection
