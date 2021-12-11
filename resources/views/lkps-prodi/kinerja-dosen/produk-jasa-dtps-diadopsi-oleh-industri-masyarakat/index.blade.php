@extends('layouts.lkps-prodi-master')

@section('title')
Produk/Jasa DTPS yang Diadopsi oleh Industri/Masyarakat
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
            <h4 style="margin-right: 30%;">Data Produk/Jasa DTPS yang Diadopsi oleh Industri/Masyarakat</h4>
            <div class="text-right">
                <button type="button" class="btn btn-success fa fa-plus" data-toggle="modal" data-target="#ModalTambah">
                    Tambah Data
                </button>

            </div>
        </div>
        <div class="card-body">
            <div class="text-right">
                <form class="form-inline">
                    <div class="form-group mx-sm-1 mb-2">
                        <!-- <label for="inputPassword2" class="sr-only">Password</label> -->
                        <input type="text" class="form-control" id="filter" name="filter" placeholder="Tahun" value="{{ old('filter') }}">
                    </div>
                    <button type="submit" class="btn btn-primary mb-2 fa fa-filter">Filter</button>
                </form><br>
                <button class="btn btn-success mb-2" onclick="print('printPDF', 'Title')">Cetak PDF</button>
            </div>
            <div class="table-responsive">
                <table id="dataTable" class="table table-hover">
                    <thead>
                        <tr>
                            <th style="text-align: center; vertical-align: middle;">No</th>
                            <th style="text-align: center; vertical-align: middle;">Nama Dosen</th>
                            <th style="text-align: center; vertical-align: middle;">Nama Produk/Jasa</th>
                            <th style="text-align: center; vertical-align: middle;">Deskripsi Produk/Jasa</th>
                            <th style="text-align: center; vertical-align: middle;">File Bukti</th>
                            <th style="text-align: center; vertical-align: middle;">Link Bukti</th>
                            <th style="text-align: center; vertical-align: middle;">Tahun</th>
                            <th style="text-align: center; vertical-align: middle;">Aksi</th>
                            <th style="display: none;">id_hidden</th>
                        </tr>

                    </thead>
                    <tbody>
                        @php $no=1 @endphp
                        @foreach($produk_dtps as $data)
                        <tr>
                            <td>{{$no++ }}</td>
                            <td>{{$data->nama_dosen }}</td>
                            <td>{{$data->nama_produk }}</td>
                            <td>{{$data->deskripsi_produk }}</td>
                            <td><a href="{{route('prodi-file_download_file_bukti_produk_dtps',$data->id)}}"><button class="btn btn-info ">Download</button></a></td>
                            <td><a href="{{$data->link_bukti}}">{{$data->link_bukti}}</a></td>
                            <td>{{$data->tahun }}</td>
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
                    1. Nama Produk/Jasa karya DTPS yang diadopsi oleh industri/masyarakat dalam 3 tahun terakhir <br>
                    2. Jenis Produk/Jasa harus relevan dengan bidang Program Studi <br>
                    3. Unggah file dengan format (jpg/png/word/pdf/rar/zip) dan link drive bukti Hak Paten
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
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Produk/Jasa DTPS yang Diapdopsi oleh Industri/Masyarakat</h5>

            </div>
            <div class="modal-body">
                <form method="post" action="{{route('prodi_kinerja_dosen_produk_jasa_dtps_diadopsi_oleh_industri_masyarakat_add')}}" enctype="multipart/form-data">

                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="judul">Nama Dosen</label>
                        <select type="text" class="form-control" id="nama_dosen" name="id_dosen" required="">
                          @foreach($dosen as $dosen)
                          <option value="{{$dosen->id}}">{{$dosen->nama_dosen}}</option>
                          @endforeach
                      </select>
                  </div>

                  <div class="form-group">
                    <label for="judul">Nama Produk/Jasa</label>
                    <input type="text" class="form-control" id="nama_produk" name="nama_produk" required="" />
                </div>

                <div class="form-group">
                    <label for="judul">Deskripsi Produk/Jasa</label>
                    <input type="text" class="form-control" id="deskripsi_produk" name="deskripsi_produk" required="" />
                </div>


                <div class="form-group">
                    <label for="judul">Unggah File Bukti (opsional)</label>
                    <input type="file" class="form-control" id="file_bukti" name="file_bukti" />
                </div>

                <div class="form-group">
                    <label for="judul">Link Bukti (opsional)</label>
                    <input type="text" class="form-control" id="link_bukti" name="link_bukti" />
                </div>

                <div class="form-group">
                    <label for="judul">Tahun</label>
                    <input type="text" class="form-control" id="tahun" name="tahun" required="" />
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
        <label for="judul">Nama Dosen</label>
        <input type="text" class="form-control" id="nama_dosen_update" name="nama_dosen" readonly="" required="" />
    </div>

    <div class="form-group">
        <label for="judul">Nama Produk/Jasa</label>
        <input type="text" class="form-control" id="nama_produk_update" name="nama_produk" required="" />
    </div>

    <div class="form-group">
        <label for="judul">Deskripsi Produk/Jasa</label>
        <input type="text" class="form-control" id="deskripsi_produk_update" name="deskripsi_produk" required="" />
    </div>


    <div class="form-group">
        <label for="judul">Unggah File Bukti (opsional)</label>
        <input type="file" class="form-control" id="file_bukti_update" name="file_bukti" />
    </div>

    <div class="form-group">
        <label for="judul">Link Bukti (opsional)</label>
        <input type="text" class="form-control" id="link_bukti_update" name="link_bukti" />
    </div>

    <div class="form-group">
        <label for="judul">Tahun</label>
        <input type="text" class="form-control" id="tahun_update" name="tahun" required="" />
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
        var url = '{{route("prodi_kinerja_dosen_produk_jasa_dtps_diadopsi_oleh_industri_masyarakat_delete", ":id") }}';
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
    $('#nama_dosen_update').val(data[1]);
    $('#nama_produk_update').val(data[2]);
    $('#deskripsi_produk_update').val(data[3]);
    $('#link_bukti_update').val(data[5]);
    $('#tahun_update').val(data[6]);
    $('#updateModalform').attr('action','prodi_kinerja_dosen_produk_jasa_dtps_diadopsi_oleh_industri_masyarakat_update/'+ data[8]);
    $('#updateModal').modal('show');
});
});
</script>

@endsection