@extends('layouts.lkps-prodi-master')

@section('title')
Data Index Prestasi Kumulatif (IPK) Mahasiswa
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
                <h4 style="margin-right: 27%;">Data Index Prestasi Kumulatif (IPK) Mahasiswa</h4><br>
                <div class=" text-right">
                    <button type="button" class="btn btn-success fa fa-plus" data-toggle="modal" data-target="#ModalTambah">
                        Tambah Data
                    </button>
                    <a href="{{route('prodi_lihat_ipk_lulusan')}}">
                        <button type="button" class="btn btn-primary fa fa-book">
                            Lihat Laporan
                        </button></a>
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

                    <div class="table-responsive">
                        <table id="dataTable" class="table table-hover">
                            <thead>
                                <tr>
                                    <th rowspan="2" style="text-align: center; vertical-align: middle;">No</th>
                                    <th rowspan="2" style="text-align: center; vertical-align: middle;">Tahun Lulus</th>
                                    <th rowspan="2" style="text-align: center; vertical-align: middle;">Jumlah Lulusan</th>
                                    <th colspan="3" style="text-align: center; vertical-align: middle;">Indeks Prestasi Kumulatif</th>
                                    <th rowspan="2" style="text-align: center; vertical-align: middle;">File Bukti Dokumen</th>
                                    <th rowspan="2" style="text-align: center; vertical-align: middle;">Link Bukti Dokumen</th>
                                    <th rowspan="2" style="text-align: center; vertical-align: middle;">Aksi</th>
                                    <th style="display: none;">id_hidden</th>
                                </tr>
                                <tr>
                                    <th style="text-align: center; vertical-align: middle;">Minimal</th>
                                    <th style="text-align: center; vertical-align: middle;">Rata-rata</th>
                                    <th style="text-align: center; vertical-align: middle;">Maksimal</th>
                                    <th style="display: none;">id_hidden</th>

                                </tr>
                            </thead>
                            <tbody>
                                @php $no=1 @endphp
                                @foreach($ipk_lulusan as $data)
                                <tr>
                                    <td>{{$no++ }}</td>
                                    <td>{{$data->tahun_lulus }}</td>
                                    <td>{{$data->jumlah_lulusan }}</td>
                                    <td>{{$data->minimal_ipk }}</td>
                                    <td>{{$data->rataRata_ipk }}</td>
                                    <td>{{$data->maksimal_ipk }}</td>
                                    <td><a href="{{route('prodi-file_download_dokumen_ipk_lulusan',$data->id)}}"><button class="btn btn-info ">Download</button></a></td>
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
                    1. Tahun lulus merupakan tahun akademik n tahun sebelum TS (TS-n) sampai dengan tahun akademik penuh terakhir saat pengajuan usulan akreditasi (TS) <br>
                    2. Data Indeks Prestasi Kumulatif (IPK) lulusan dalam 3 tahun terakhir <br>
                    3. Data dilengkapi dengan jumlah lulusan pada setiap tahun kelulusan <br>
                    4. Unggah File dengan Format (word/pdf/excel/rar/zip) dan Link Drive Bukti Dokumen dalam 3 tahun terakhir seperti : <br>
                    a. Kebijakan mutu <br>
                    b. Manual mutu <br>
                    c. Standar mutu <br>
                    d. Buku kebijakan tentang pedoman pendidikan <br>
                    e. Surat Keputusan tentang kelulusan <br>
                    f. Dokumen pendukung seperti Buku wisuda dan PD DIKTI (pangkalan data) <br>
                    g. Rekapitulasi IPK Mahasiswa <br>
                    h. Daftar Mahasiswa Lulusan <br>
                    i. Daftar Prestasi Akademik
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
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Index Prestasi Kumulatif (IPK) Mahasiswa</h5>
                
            </div>
            <div class="modal-body">
                <form method="post" action="{{route('prodi_ipk_lulusan_add')}}" enctype="multipart/form-data">

                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="judul">Tahun Lulus</label>
                        <input class="form-control" id="tahun_lulus" name="tahun_lulus" required="" />

                    </div>

                    <div class="form-group">
                        <label for="judul">Jumlah Lulusan</label>
                        <input type="text" class="form-control" id="jumlah_lulusan" name="jumlah_lulusan" required="" placeholder="" />
                    </div>


                    <div class="form-group">
                        <label for="judul">Minimal Indeks Prestasi Kumulatif</label>
                        <input type="text" class="form-control" id="minimal_ipk" name="minimal_ipk" required="" />
                    </div>

                    <div class="form-group">
                        <label for="judul">Rata-rata Indeks Prestasi Kumulatif</label>
                        <input type="text" class="form-control" id="rataRata_ipk" name="rataRata_ipk" required="" />
                    </div>

                    <div class="form-group">
                        <label for="judul">Maksimal Indeks Prestasi Kumulatif</label>
                        <input type="text" class="form-control" id="maksimal_ipk" name="maksimal_ipk" required="" />
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
        <label for="judul">Tahun Lulus</label>
        <input class="form-control" id="tahun_lulus_update" name="tahun_lulus" required="" />

    </div>

    <div class="form-group">
        <label for="judul">Jumlah Lulusan</label>
        <input type="text" class="form-control" id="jumlah_lulusan_update" name="jumlah_lulusan" required="" placeholder="" />
    </div>


    <div class="form-group">
        <label for="judul">Minimal Indeks Prestasi Kumulatif</label>
        <input type="text" class="form-control" id="minimal_ipk_update" name="minimal_ipk" required="" />
    </div>

    <div class="form-group">
        <label for="judul">Rata-rata Indeks Prestasi Kumulatif</label>
        <input type="text" class="form-control" id="rataRata_ipk_update" name="rataRata_ipk" required="" />
    </div>

    <div class="form-group">
        <label for="judul">Maksimal Indeks Prestasi Kumulatif</label>
        <input type="text" class="form-control" id="maksimal_ipk_update" name="maksimal_ipk" required="" />
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
        var url = '{{route("prodi_ipk_lulusan_delete", ":id") }}';
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
    $('#tahun_lulus_update').val(data[1]);
    $('#jumlah_lulusan_update').val(data[2]);
    $('#minimal_ipk_update').val(data[3]);
    $('#rataRata_ipk_update').val(data[4]);
    $('#maksimal_ipk_update').val(data[5]);
    $('#link_bukti_dokumen_update').val(data[7]);
    $('#updateModalform').attr('action','prodi_ipk_lulusan_update/'+ data[9]);
    $('#updateModal').modal('show');
});
});
</script>

@endsection