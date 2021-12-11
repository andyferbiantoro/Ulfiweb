@extends('layouts.prodi-master')

@section('title')
Perjanjian Kinerja
@endsection


@section('content')

<div class="row">
   <div class="col-lg-12">
      <div class="card">
        <div class="card-header">
          <h4>Laporan data Perjanjian Kinerja</h4>
      </div>
      <div class="card-body">
        <button type="button" class="btn btn-success " data-toggle="modal" data-target="#ModalTambahPerjanjian">
            Tambah Perjanjian
        </button><br><br>
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
                        <th scope="col">Aksi</th>
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
                    <td>{{($per->realisasi_triwulan1+$per->realisasi_triwulan2+$per->realisasi_triwulan3+$per->akhir_tahun)/$per->target/100}} %</td>
                    <td><a href="{{route('prodi-file_perjanjian_download',$per->id)}}"><button class="btn btn-info">Download</button></a></td>
                    <td><a href="{{$per->link_bukti_lampiran}}">{{$per->link_bukti_lampiran}}</a></td>
                    <td>
                        <a href="{{route('prodi-edit_perjanjian_kinerja', ['id' => $per->id])}}">
                            <button class="edit btn btn-success btn-sm fa fa-edit" title="Edit"></button>
                        </a>
                        <a href="javascript:;" data-toggle="modal" onclick="deleteData({{$per->id}})" data-target="#DeleteModal">
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


<div class="modal fade" id="ModalTambahPerjanjian" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Perjanjian</h5>
    </div>
    <div class="modal-body">
     <form method="post" action="{{url('prodi-tambah_perjanjian')}}" enctype="multipart/form-data">                
        {{csrf_field()}}
        <div class="form-group">
            <label for="sasaran_kegiatan">Sasaran Kegiatan</label>
            <input type="text" class="form-control" id="sasaran_kegiatan" name="sasaran_kegiatan" required=""/>
        </div>

        <div class="form-group">
            <label for="indikator_kinerja_kegiatan">Indikator Kinerja Kegiatan</label>
            <input type="text" class="form-control" id="indikator_kinerja_kegiatan" name="indikator_kinerja_kegiatan" required=""/>
        </div>

        <div class="form-group">
            <label for="satuan">Satuan</label>
            <input type="text" class="form-control" id="satuan" name="satuan" required=""/>
        </div>

        <div class="form-group">
            <label for="target">Target</label>
            <input type="text" class="form-control" id="target" name="target" required=""/>
        </div>

        <div class="form-group"> 
            <label for="realisasi_triwulan1">Realisasi Triwulan 1</label>
            <input type="text" class="form-control" id="realisasi_triwulan1" name="realisasi_triwulan1" required=""/>
        </div>

        <div class="form-group">
            <label for="realisasi_triwulan2">Realisasi Triwulan 2</label>
            <input type="text" class="form-control" id="realisasi_triwulan2" name="realisasi_triwulan2" required=""/>
        </div>

        <div class="form-group">
            <label for="realisasi_triwulan3">Realisasi Triwulan 3</label>
            <input type="text" class="form-control" id="realisasi_triwulan3" name="realisasi_triwulan3" required=""/>
        </div>

        <div class="form-group">
            <label for="akhir_tahun">Akhir Tahun</label>
            <input type="number" class="form-control" id="akhir_tahun" name="akhir_tahun" required=""/>
        </div>

        <div class="form-group">
            <label for="link_bukti_lampiran">Link Bukti Lampiran</label>
            <input type="text" class="form-control" id="link_bukti_lampiran" name="link_bukti_lampiran" required=""/>
        </div>

        <div class="form-group">
            <label for="file_bukti_lampiran">File Bukti Lampiran</label>
            <input type="file" class="form-control" id="file_bukti_lampiran" name="file_bukti_lampiran" required=""/>
        </div>

        <div class="form-group">
          <input type="hidden" class="form-control" id="id_user" name="id_user" value="{{ Auth::user()->id }}" />
      </div>

      <button class="btn btn-primary" type="Submit">Tambah Perjanjian</button>
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
                    <h5 class="modal-title">Hapus Perjanjian</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{ csrf_field() }}
                    {{ method_field('POST') }}
                    <p>Apakah anda yakin ingin menghapus Perjanjian ini ?</p>
                    <button type="button" class="btn btn-secondary float-right" data-dismiss="modal">Batal</button>
                    <button type="submit" name="" class="btn btn-danger float-right mr-2" data-dismiss="modal" onclick="formSubmit()">Hapus</button>
                </div>
            </div>
        </form>
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


<script type="text/javascript">
    function deleteData(id) {
        var id = id;
        var url = '{{route("prodi-hapus_perjanjian", ":id") }}';
        url = url.replace(':id', id);
        $("#deleteForm").attr('action', url);
    }

    function formSubmit() {
        $("#deleteForm").submit();
    }
</script>
@endsection
