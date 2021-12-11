@extends('layouts.lkps-prodi-master')

@section('title')
Pengakuan / Rekognisi DTPS
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
            <h4 style="margin-right: 55%;">Data Pengakuan / Rekognisi DTPS</h4>
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
                            <th style="text-align: center; vertical-align: middle;">Bidang Keahlian</th>
                            <th style="text-align: center; vertical-align: middle;">File Rekognisi dan Bukti Pendukung</th>
                            <th style="text-align: center; vertical-align: middle;">Link Rekognisi dan Bukti Pendukung</th>
                            <th style="text-align: center; vertical-align: middle;">Tingkat</th>
                            <th style="text-align: center; vertical-align: middle;">Tahun</th>
                            <th style="text-align: center; vertical-align: middle;">Aksi</th>
                            <th style="display: none;">id_hidden</th>
                        </tr>

                    </thead>
                    <tbody>
                        @php $no=1 @endphp
                        @foreach($pengakuan_dtps as $data)
                        <tr>
                            <td>{{$no++ }}</td>
                            <td>{{$data->nama_dosen }}</td>
                            <td>{{$data->bidang_keahlian }}</td>
                            <td><a href="{{route('prodi-file_download_bukti_pendukung',$data->id)}}"><button class="btn btn-info ">Download</button></a></td>
                            <td><a href="{{$data->link_rekognisi_buktiPendukung}}">{{$data->link_rekognisi_buktiPendukung}}</a></td>
                            <td>{{$data->tingkat }}</td>
                            <td>{{$data->tahun }}</td>
                            <td>
                                   <!--  <a href="">
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
                    1. Pengajuan/Rekognisi atas kepakaran/prestasi/kinerja DTPS yang diterima dalam 3 tahun terakhir <br>
                    2. Unggah file dengan format (jpg/png/word/pdf/rar/zip) dan link (Link Jurnal atau Link Drive) Rekognisi atau Bukti Pengakuan atas kepakaran/prestasi/kinerja dapat berupa : <br>
                    a. Menjadi visiting lecturer atau visiting scholar di Program Studi/ Perguruan Tinggi terakreditasi A atau Program Studi
                    /Perguruan Tinggi Internasional bereputasi. <br>
                    b. Menjadi keynote speaker/invited speaker pada pertemuan ilmiah tingkat Nasional/Internasional. <br>
                    c. Menjadi editor atau mitra bestari pada jurnal Nasional terakreditasi/jurnal Internasional bereputasi di bidang yang sesuai dengan bidang Program Studi. <br>
                    d. Menjadi tenaga ahli/konsultan di lembaga/industri tingkat Wilayah/Nasional/Internasional pada bidang yang sesuai dengan bidang Program Studi. <br>
                    e. Mendapat penghargaan atas prestasi dan kinerja di tingkat Wilayah/Nasional/Internasional
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
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Pengakuan/Rekognisi DTPS</h5>

            </div>
            <div class="modal-body">
                <form method="post" action="{{route('prodi_kinerja_dosen_pengakuan_rekognisi_dtps_add')}}" enctype="multipart/form-data">

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
                    <label for="judul">Bidang Keahlian</label>
                    <input type="text" class="form-control" id="bidang_keahlian" name="bidang_keahlian" required="" />
                </div>


                <div class="form-group">
                    <label for="judul">Unggah File Rekognisi dan Bukti Pendukung (opsional)</label>
                    <input type="file" class="form-control" id="file_rekognisi_buktiPendukung" name="file_rekognisi_buktiPendukung" />
                </div>

                <div class="form-group">
                    <label for="judul">Link Rekognisi dan Bukti Pendukung (opsional)</label>
                    <input type="text" class="form-control" id="link_rekognisi_buktiPendukung" name="link_rekognisi_buktiPendukung" />
                </div>


                <div class="form-group">
                    <label for="judul">Tingkat</label>
                    <select type="text" class="form-control" id="tingkat" name="tingkat" required="">
                        <option >Wilayah</option>
                        <option >Nasional</option>
                        <option >Internasional</option>
                    </select>
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
        <label for="judul">Bidang Keahlian</label>
        <input type="text" class="form-control" id="bidang_keahlian_update" name="bidang_keahlian" required="" />
    </div>


    <div class="form-group">
        <label for="judul">Unggah File Rekognisi dan Bukti Pendukung (opsional)</label>
        <input type="file" class="form-control" id="file_rekognisi_buktiPendukung_update" name="file_rekognisi_buktiPendukung" />
    </div>

    <div class="form-group">
        <label for="judul">Link Rekognisi dan Bukti Pendukung (opsional)</label>
        <input type="text" class="form-control" id="link_rekognisi_buktiPendukung_update" name="link_rekognisi_buktiPendukung" />
    </div>


    <div class="form-group">
        <label for="judul">Tingkat</label>
        <select type="text" class="form-control" id="tingkat_update" name="tingkat" required="">
            <option >Wilayah</option>
            <option >Nasional</option>
            <option >Internasional</option>
        </select>
    </div>

    <div class="form-group">
        <label for="judul">Tahun</label>
        <input type="text" class="form-control" id="tahun_update" name="tahun" required="" />
    </div>


    <div class="form-group">
        <input type="hidden" class="form-control" id="id_user" name="id_user" value="{{ Auth::user()->id }}" />
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
        var url = '{{route("prodi_kinerja_dosen_pengakuan_rekognisi_dtps_delete", ":id") }}';
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
    $('#bidang_keahlian_update').val(data[2]);
    $('#link_rekognisi_buktiPendukung_update').val(data[4]);
    $('#tingkat_update').val(data[5]);
    $('#tahun_update').val(data[6]);
    $('#updateModalform').attr('action','prodi_kinerja_dosen_pengakuan_rekognisi_dtps_update/'+ data[8]);
    $('#updateModal').modal('show');
});
});
</script>

@endsection