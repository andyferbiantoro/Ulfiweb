@extends('layouts.lkps-prodi-master')

@section('title')
Data Integrasi Penelitian/Pengabdian kepada Masyarakat (PkM) dalam Pembelajaran
@endsection


@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="card">
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
        <div class="card-header">
            <h4 style="margin-right: 10%;">Data Integrasi Penelitian/Pengabdian kepada Masyarakat (PkM) dalam Pembelajaran</h4><br>
            <div class=" text-right">
                <button type="button" class="btn btn-success fa fa-plus" data-toggle="modal" data-target="#ModalTambah">
                    Tambah Data
                </button><br>

            </div>
        </div>
        <div class="card-body">
            <form class="form-inline">
                <div class="form-group mx-sm-1 mb-2">
                    <!-- <label for="inputPassword2" class="sr-only">Password</label> -->
                    <input type="text" class="form-control" id="filter" name="filter" placeholder="Tahun" value="{{ old('filter') }}">
                </div>
                <button type="submit" class="btn btn-primary mb-2 fa fa-filter">Filter</button>
            </form><br>
            <button class="btn btn-success mb-2" onclick="print('printPDF', 'Title')">Cetak PDF</button>
            <div class="table-responsive">
                <table id="dataTable" class="table table-hover">
                    <thead>
                        <tr>
                            <th style="text-align: center; vertical-align: middle;">No</th>
                            <th style="text-align: center; vertical-align: middle;">Judul Penelitian/Pengabdian kepada Masyarakat</th>
                            <th style="text-align: center; vertical-align: middle;">Nama Dosen</th>
                            <th style="text-align: center; vertical-align: middle;">Mata Kuliah</th>
                            <th style="text-align: center; vertical-align: middle;">Bentuk Integrasi</th>
                            <th style="text-align: center; vertical-align: middle;">Tahun</th>
                            <th style="text-align: center; vertical-align: middle;">File Bukti Dokumen</th>
                            <th style="text-align: center; vertical-align: middle;">Link Bukti Dokumen</th>
                            <th style="text-align: center; vertical-align: middle;">Aksi</th>
                            <th style="display: none;">id_hidden</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no=1 @endphp
                        @foreach($data_integrasi as $data)
                        <tr>
                            <td>{{$no++}}</td>
                            <td>{{$data->judul_penelitian_pkm }}</td>
                            <td>{{$data->nama_dosen }}</td>
                            <td>{{$data->matakuliah }}</td>
                            <td>{{$data->bentuk_integrasi }}</td>
                            <td>{{$data->tahun }}</td>
                            <td><a href="{{route('prodi-file_download_dokumen_integrasi',$data->id)}}"><button class="btn btn-info ">Download</button></a></td>
                            <td><a href="{{$data->link_bukti_dokumen}}">{{$data->link_bukti_dokumen}}</a></td>
                            <td>
                                    <!-- <a href="">
                                        <button class="btn-sm btn btn-warning fa fa-eye" title="Lihat"></button>
                                    </a> -->
                                    @if($data->status == 0)
                                    <button class="btn btn-success btn-sm fa fa-edit edit" title="Edit"></button>

                                    <a href="#" data-toggle="modal" onclick="deleteData({{$data->id}})" data-target="#DeleteModal">
                                        <button class="btn btn-danger btn-sm fa fa-trash" title="Hapus"></button>
                                    </a>
                                    @endif

                                    
                                    @if($data->status == 1 || $data->status == 2)
                                    <p style="color: green">Tersubmit</p>
                                    @endif

                                </td>
                                <td style="display: none;">{{$data->id}}</td>
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
                    1. Judul Penelitian/Pengabdian kepada Masyarakat (PkM) DTPS yan terintegrasi ke dalam pembelajaran/pengembangan matakuliah dalam 3 tahun terakhir.<br>
                    2. Judul Penelitian/Pengabdian kepada Masyarakat merupakan judul penelitian dan Pengabdian kepada Masyarakat (PkM) tercatat di Unit/Lembaga yang mengeloala <br>
                    kegiatan penelitian/Pengabdian kepada Masyarakat (PkM) di tingkat Perguruan Tinggi/Unit Pengelola Program Studi (UPPS) <br>
                    3. Bentuk integrasi dapat berupa tambahan materi perkuliahan, studi kasus, bab/subbab dalam buku ajar, atau bentuk lain yang relevan
                    4. Unggah file dengan format (word/pdf/rar/zip) dan Link Drive bukti dokumen seperti : <br>
                    a. Rencana Induk Penelitian atau Pengabdian kepada Masyarakat (RIP) Program Studi <br>
                    b. Laporan penelitian atau Pengabdian kepada Masyarakat (PkM) berdasarkan pada RIP Program Studi <br>
                    c Rencana Pembelajaran Semester (RPS) berdasarkan pada asil penelitian dosen <br>
                    d. Modul pembelajaran berdasarkan pada penelitian <br>
                    e. Surat Keputusan
                </p>
            </div>
        </div>
    </div>
</div>


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


<!-- modal -->
<div class="modal fade" id="ModalTambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Integrasi Penelitian/Pengabdian kepada Masyarakat (PkM) dalam Pembelajaran</h5>

            </div>
            <div class="modal-body">
                <form method="post" action="{{route('prodi_pendidikan_integrasi_kegiatan_penelitian_add')}}" enctype="multipart/form-data">

                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="judul">Judul Penelitian/Pengabdian kepada Masyarakat</label>
                        <input type="text" class="form-control" id="judul_penelitian_pkm" name="judul_penelitian_pkm" required="" placeholder="" />
                    </div>

                    <div class="form-group">
                        <label for="judul">Nama Dosen</label>
                        <select type="text" class="form-control" id="nama_dosen" name="id_dosen" required="">
                          @foreach($dosen as $dosen)
                          <option value="{{$dosen->id}}">{{$dosen->nama_dosen}}</option>
                          @endforeach
                      </select>
                  </div>

                  <div class="form-group">
                    <label for="judul">Mata Kuliah</label>
                    <input type="text" class="form-control" id="matakuliah" name="matakuliah" required="" />

                </div>

                <div class="form-group">
                    <label for="judul">Bentuk Integrasi</label>
                    <input type="text" class="form-control" id="bentuk_integrasi" name="bentuk_integrasi" required="" />
                </div>

                <div class="form-group">
                    <label for="judul">Tahun Akademik</label>
                    <input type="text" class="form-control" id="tahun" name="tahun" required="" placeholder="2020/2021" />
                </div>

                <div class="form-group">
                    <label for="judul">Unggah File Bukti Dokumen (opsional)</label>
                    <input type="file" class="form-control" id="file_bukti_dokumen" name="file_bukti_dokumen" />
                </div>

                <div class="form-group">
                    <label for="judul">Link Bukti Dokumen (opsional)</label>
                    <input type="text" class="form-control" id="link_bukti_dokumen" name="link_bukti_dokumen" />
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



<div id="updateModal" class="modal fade" role="dialog">
  <div class="modal-dialog ">
   <!--Modal content-->
   <form action="" id="updateModalform" method="post" enctype="multipart/form-data">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Anda yakin ingin memperbarui Data ini ?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
  </div>
  <div class="modal-body">
    {{ csrf_field() }}
    {{ method_field('POST') }}

    <div class="form-group">
        <label for="judul">Judul Penelitian/Pengabdian kepada Masyarakat</label>
        <input type="text" class="form-control" id="judul_penelitian_pkm_update" name="judul_penelitian_pkm" required="" placeholder="" />
    </div>

    <div class="form-group">
        <label for="judul">Nama Dosen</label>
        <input type="text" class="form-control" id="nama_dosen_update" name="nama_dosen" readonly="" required="" />
    </div>

    <div class="form-group">
        <label for="judul">Mata Kuliah</label>
        <input type="text" class="form-control" id="matakuliah_update" name="matakuliah" required="" />

    </div>

    <div class="form-group">
        <label for="judul">Bentuk Integrasi</label>
        <input type="text" class="form-control" id="bentuk_integrasi_update" name="bentuk_integrasi" required="" />
    </div>

    <div class="form-group">
        <label for="judul">Tahun Akademik</label>
        <input type="text" class="form-control" id="tahun_update" name="tahun" required="" placeholder="2020/2021" />
    </div>

    <div class="form-group">
        <label for="judul">Unggah File Bukti Dokumen (opsional)</label>
        <input type="file" class="form-control" id="file_bukti_dokumen_update" name="file_bukti_dokumen" />
    </div>

    <div class="form-group">
        <label for="judul">Link Bukti Dokumen (opsional)</label>
        <input type="text" class="form-control" id="link_bukti_dokumen_update" name="link_bukti_dokumen" />
    </div>

    <button type="button" class="btn btn-secondary float-right" data-dismiss="modal">Batal</button>
    <button type="submit"  class="btn btn-primary float-right mr-2" >Perbarui</button>
</div>
</div>
</form>
</div>
</div>


<div id="DeleteModal" class="modal fade" role="dialog">
    <div class="modal-dialog ">
        <!-- Modal content-->
        <form action="" id="deleteForm" method="post">

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Hapus data ini?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{ csrf_field() }}
                    {{ method_field('POST') }}
                    <p>Apakah anda yakin ingin Menghapus data ini ?</p>
                    <button type="button" class="btn btn-secondary float-right" data-dismiss="modal">Batal</button>
                    <button type="submit" name="" class="btn btn-danger float-right mr-2" data-dismiss="modal" onclick="formSubmit()">Hapus</button>
                </div>
            </div>
        </form>
    </div>
</div> 

@endsection


@section('scripts')
<script type="text/javascript">
    function deleteData(id) {
        var id = id;
        var url = '{{route("prodi_pendidikan_integrasi_kegiatan_penelitian_delete", ":id") }}';
        url = url.replace(':id', id);
        $("#deleteForm").attr('action', url);
    }

    function formSubmit() {
        $("#deleteForm").submit();
    }
</script>


<script>
  $(document).ready(function() {
    var table = $('#dataTable').DataTable();
    table.on('click', '.edit', function() {
      $tr = $(this).closest('tr');
      if ($($tr).hasClass('child')) {
        $tr = $tr.prev('.parent');
    }
    var data = table.row($tr).data();
    console.log(data);
    $('#judul_penelitian_pkm_update').val(data[1]);
    $('#nama_dosen_update').val(data[2]);
    $('#matakuliah_update').val(data[3]);
    $('#bentuk_integrasi_update').val(data[4]);
    $('#tahun_update').val(data[5]);
    $('#link_bukti_dokumen_update').val(data[7]);
    $('#updateModalform').attr('action','prodi_pendidikan_integrasi_kegiatan_penelitian_update/'+ data[9]);
    $('#updateModal').modal('show');
});
});
</script>

@endsection