@extends('layouts.auditor-master')

@section('title')
    Hasil Penilaian LKPS
@endsection


@section('content')
   
<div class="row">
 <div class="col-lg-12">
              <div class="card">
                <div class="card-header">
                  <h4>Data Hasil Penilaian Laporan Kinerja Program Study</h4>
                </div>
                     @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                <div class="card-body">
                    <button type="button" class="btn btn-success right"  data-toggle="modal" data-target="#ModalTamahPenilaian" >
                    Tambah Penilaian
                  </button><br><br>
                 <div class="table-responsive">
                    <table id="dataTable" class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Keterangan</th>
                                    <th scope="col">Lampiran File</th>
                                    <th scope="col">Lampiran Link</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $no=1 @endphp
                                @foreach($hasil_penilaian_lkps as $hasil)
                               <tr>
                                 <td scope="row">{{ $no++ }}</td>
                                 <td>{{$hasil->tanggal}}</td>
                                 <td>{{$hasil->keterangan}}</td>
                                 <td><a href="{{route('auditor-file_download',$hasil->id)}}"><button class="btn btn-info ">Download</button></a></td>
                                 <td><a href="{{$hasil->lampiran_link}}">{{$hasil->lampiran_link}}</a></td>
                                 
                                 <td>
                                    <!--  <a href="#">
                                        <button class="edit btn btn-warning btn-sm fa fa-eye" title="Lihat"></button>
                                    </a> -->
                                    <a href="{{route('auditor-edit_penilaian_lkps', ['id' => $hasil->id])}}">
                                        <button class="edit btn btn-success btn-sm fa fa-edit" title="Edit"></button>
                                    </a>
                                   
                                    <a href="javascript:;" data-toggle="modal" onclick="deleteData({{$hasil->id}})" data-target="#DeleteModal">
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
</div>


<!-- Modal -->
<div class="modal fade" id="ModalTamahPenilaian" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Penilaian</h5>
       
      </div>
      <div class="modal-body">
       <form method="post" action="{{route('auditor-tambah_hasil_penilaian_lkps')}}" enctype="multipart/form-data">
                           
                                   
                        {{csrf_field()}}
                            <div class="form-group">
                                <label for="tanggal">Tanggal</label>
                                <input type="date" class="form-control" id="tanggal" name="tanggal" required=""/>
                            </div>

                            <div class="form-group">
                                <label for="keterangan">Keterangan</label>
                                <textarea class="form-control" id="keterangan" name="keterangan" required=""></textarea>
                            </div>

                           <div class="form-group">
                                <label for="lampiran_file">Lampiran Hasil Penilaian Laporan Kinerja Program Study</label>
                                <input type="file" class="form-control" id="lampiran_file" name="lampiran_file" required=""/>
                                <label style="color: blue">Unggah file/link(rar/zip/link drive)</label>
                            </div>

                            <div class="form-group">
                                <label for="lampiran_link">Lampiran link</label>
                                <textarea class="form-control" id="lampiran_link" name="lampiran_link"></textarea>
                            </div>

                            <div class="form-group">
                              <input type="hidden" class="form-control" id="id_user" name="id_user" value="{{ Auth::user()->id }}" />
                            </div>

                             <button class="btn btn-primary" type="Submit">Simpan</button>
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
                        <h5 class="modal-title">Hapus Hasil Penilaian</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        {{ csrf_field() }}
                        {{ method_field('POST') }}
                        <p>Apakah anda yakin ingin menghapus penilaian ini ?</p>
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
            var url = '{{route("auditor-hapus_penilaian", ":id") }}';
            url = url.replace(':id', id);
            $("#deleteForm").attr('action', url);
        }

        function formSubmit() {
            $("#deleteForm").submit();
        }
    </script>
@endsection
