@extends('layouts.lkps-prodi-master')

@section('title')
Data Prestasi non-Akademik Mahasiswa
@endsection


@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 style="margin-right: 15%;">Data Prestasi non-Akademik Mahasiswa</h4><br>
                <div class="text-right">
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
                                <th style="text-align: center; vertical-align: middle;">Nama Kegiatan</th>
                                <th style="text-align: center; vertical-align: middle;">Tahun Perolehan</th>
                                <th style="text-align: center; vertical-align: middle;">Tingkat</th>
                                <th style="text-align: center; vertical-align: middle;">Prestasi yang Dicapai</th>
                                <th style="text-align: center; vertical-align: middle;">File Bukti Dokumen</th>
                                <th style="text-align: center; vertical-align: middle;">Link Bukti Dokumen</th>
                                <th style="text-align: center; vertical-align: middle;">Aksi</th>
                                <th style="display: none;">id_hidden</th>
                            </tr>
                        </thead>
                        <tbody>
                         @php $no=1 @endphp
                         @foreach($prestasi_non_akademik_mahasiswa as $data)
                         <tr>
                            <td>{{$no++ }}</td>
                            <td>{{$data->nama_kegiatan }}</td>
                            <td>{{$data->tahun_perolehan }}</td>
                            <td>{{$data->tingkat }}</td>
                            <td>{{$data->prestasi_dicapai }}</td>
                            <td><a href="{{route('prodi-file_download_dokumen_prestasi_non_akademik',$data->id)}}"><button class="btn btn-info ">Download</button></a></td>
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
                    1. Prestasi non-akademik yang dicapai mahasiswa Program Studi dalam 5 tahun terakhir <br>
                    2. Unggah File dengan Format (jpg/png/word/pdf/excel/rar/zip) dan Link Drive Bukti Dokumen seperti : <br>
                    a. Kebijakan mutu <br>
                    b. Manual mutu <br>
                    c. Standar mutu <br>
                    d. Buku pedoman pengembangan prestasi non-akademik mahasiswa <br>
                    e. Surat Keputusan tentang Pembina UKM <br>
                    f. Buku pedoman tentang PBAK (pengenalan budaya akademik kampus) <br>
                    g. Buku pedoman pembinaan organisasi kemahasiswa <br>
                    h. Dokumen pendukung seperti sertifikat/piagam penghargaan/piala/medali, foto kegiatan, laporan kegiatan dan daftar mahasiswa prestasi non-akademik
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
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Prestasi Akademik Mahasiswa</h5>
                
            </div>
            <div class="modal-body">
                <form method="post" action="{{route('prodi_prestasi_non_akademik_mahasiswa_add')}}" enctype="multipart/form-data">

                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="judul">Nama Kegiatan</label>
                        <input class="form-control" id="nama_kegiatan" name="nama_kegiatan" required="" />

                    </div>

                    <div class="form-group">
                        <label for="judul">Tahun Perolehan</label>
                        <input type="text" class="form-control" id="tahun_perolehan" name="tahun_perolehan" required="" placeholder="" />
                    </div>


                    <div class="form-group">
                        <label for="judul">Tingkat</label>
                        <select type="text" class="form-control" id="tingkat" name="tingkat" required="">
                            <option>Wilayah/Lokal</option>
                            <option>Nasional</option>
                            <option>Internasional</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="judul">Prestasi yang dicapai</label>
                        <input type="text" class="form-control" id="prestasi_dicapai" name="prestasi_dicapai" required="" />
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
        <label for="judul">Nama Kegiatan</label>
        <input class="form-control" id="nama_kegiatan_update" name="nama_kegiatan" required="" />

    </div>

    <div class="form-group">
        <label for="judul">Tahun Perolehan</label>
        <input type="text" class="form-control" id="tahun_perolehan_update" name="tahun_perolehan" required="" placeholder="" />
    </div>


    <div class="form-group">
        <label for="judul">Tingkat</label>
        <select type="text" class="form-control" id="tingkat_update" name="tingkat" required="">
            <option>Wilayah/Lokal</option>
            <option>Nasional</option>
            <option>Internasional</option>
        </select>
    </div>

    <div class="form-group">
        <label for="judul">Prestasi yang dicapai</label>
        <input type="text" class="form-control" id="prestasi_dicapai_update" name="prestasi_dicapai" required="" />
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
        var url = '{{route("prodi_prestasi_non_akademik_mahasiswa_delete", ":id") }}';
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
    $('#nama_kegiatan_update').val(data[1]);
    $('#tahun_perolehan_update').val(data[2]);
    $('#tingkat_update').val(data[3]);
    $('#prestasi_dicapai_update').val(data[4]);
    $('#link_bukti_dokumen_update').val(data[6]);
    $('#updateModalform').attr('action','prodi_prestasi_non_akademik_mahasiswa_update/'+ data[8]);
    $('#updateModal').modal('show');
});
});
</script>

@endsection