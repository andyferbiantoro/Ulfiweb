@extends('layouts.lkps-prodi-master')

@section('title')
Data Kepuasan Mahasiswa
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
                <h4 style="margin-right: 45%;">Data Kepuasan Mahasiswa</h4>
                <div class=" text-right">
                    <button type="button" class="btn btn-success fa fa-plus" data-toggle="modal" data-target="#ModalTambah">
                        Tambah Data
                    </button>
                    <a href="{{route('prodi_lihat_pendidikan_kepuasan_mahasiswa')}}">
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
                        <table id="" class="table table-hover">
                            <thead>
                                <tr>
                                    <th rowspan="2" style="text-align: center; vertical-align: middle;">No</th>
                                    <th rowspan="2" style="text-align: center; vertical-align: middle;">Aspek yang Diukur</th>
                                    <th colspan="4" style="text-align: center; vertical-align: middle;">Tingkat Kepuasan Mahasiswa</th>
                                    <th rowspan="2" style="text-align: center; vertical-align: middle;">Rencana Tindak Lanjut oleh UPPS/PS</th>
                                    <th rowspan="2" style="text-align: center; vertical-align: middle;">File Bukti Dokumen</th>
                                    <th rowspan="2" style="text-align: center; vertical-align: middle;">Link Bukti Dokumen</th>
                                    <th rowspan="2" style="text-align: center; vertical-align: middle;">Tahun</th>
                                    <th rowspan="2" style="text-align: center; vertical-align: middle;">Aksi</th>
                                    <th style="display: none;">id_hidden</th>
                                </tr>
                                <tr>
                                    <th style="text-align: center; vertical-align: middle;">Sangat Baik</th>
                                    <th style="text-align: center; vertical-align: middle;">Baik</th>
                                    <th style="text-align: center; vertical-align: middle;">Cukup</th>
                                    <th style="text-align: center; vertical-align: middle;">Kurang</th>
                                    <th style="display: none;">id_hidden</th>

                                </tr>
                            </thead>
                            <tbody>
                                @php $no=1 @endphp
                                @foreach($data_kepuasan_mahasiswa as $data)
                                <tr>
                                    <td style="text-align: center; vertical-align: middle;">{{$no++ }}</td>
                                    <td style="text-align: center; vertical-align: middle;">{{$data->aspek_diukir }}</td>
                                    <td style="text-align: center; vertical-align: middle;">{{$data->tingkat_kepuasanMahasiswa_sangatBaik }}</td>
                                    <td style="text-align: center; vertical-align: middle;">{{$data->tingkat_kepuasanMahasiswa_baik }}</td>
                                    <td style="text-align: center; vertical-align: middle;">{{$data->tingkat_kepuasanMahasiswa_cukup }}</td>
                                    <td style="text-align: center; vertical-align: middle;">{{$data->tingkat_kepuasanMahasiswa_kurang }}</td>
                                    <td style="text-align: center; vertical-align: middle;">{{$data->rencana_tindak_lanjut }}</td>
                                    <td style="text-align: center; vertical-align: middle;"><a href="{{route('prodi-file_download_dokumen_kepuasan_mhs',$data->id)}}"><button class="btn btn-info ">Download</button></a></td>
                                    <td style="text-align: center; vertical-align: middle;"><a href="{{$data->link_bukti_dokumen}}">{{$data->link_bukti_dokumen}}</a></td>
                                    <td style="text-align: center; vertical-align: middle;">{{$data->tahun }}</td>
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
                        <thead>
                            <tr>
                                <th colspan="2" style="text-align: center; vertical-align: middle;">Jumlah</th>
                                <th style="text-align: center; vertical-align: middle;">1</th>
                                <th style="text-align: center; vertical-align: middle;">1</th>
                                <th style="text-align: center; vertical-align: middle;">1</th>
                                <th style="text-align: center; vertical-align: middle;">1</th>
                                <th colspan="5" style="text-align: center; vertical-align: middle;"></th>
                            </tr>
                        </thead>
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
                    1. Hasil pengukuran kepuasan Mahasiswa terhadap proses pendidikan <br>
                    2. Data diambil dari hasil studi penelusuran yang dilakukan pada saat TS (Tahun Akademik Penuh terakhir saat pengajuan usulan akreditasi) <br>
                    3. Unggah file dengan format (word/pdf/excel/rar/zip) dan Link Drive Bukti dokumen seperti : <br>
                    a. Buku pedoman survei kepuasan mahasiswa <br>
                    b. Laporan survei kepuasan mahasiswa <br>
                    c. Respon kepuasan mahasiswa <br>
                    d. Rekapitulasi data kepuasan mahasiswa <br>
                    e. Kuisioner kepuasan mahasiswa
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
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Kepuasan Mahasiswa</h5>
                
            </div>
            <div class="modal-body">
                <form method="post" action="{{route('prodi_pendidikan_kepuasan_mahasiswa_add')}}" enctype="multipart/form-data">

                    {{csrf_field()}}

                    <div class="form-group">
                        <label for="judul">Aspek yang diukur</label>
                        <select type="text" class="form-control" id="aspek_diukir" name="aspek_diukir">
                            <option>Keandalan</option>
                            <option>DLL (Dibuat Otomatis)</option>

                        </select>
                    </div>

                    <div class="form-group">
                        <label for="judul">Tingkat Kepuasan Mahasiswa Sangat Baik</label>
                        <input type="text" class="form-control" id="tingkat_kepuasanMahasiswa_sangatBaik" name="tingkat_kepuasanMahasiswa_sangatBaik" required="" placeholder="Sangat Baik" />

                    </div>

                    <div class="form-group">
                        <label for="judul">Tingkat Kepuasan Mahasiswa Baik</label>
                        <input type="text" class="form-control" id="tingkat_kepuasanMahasiswa_baik" name="tingkat_kepuasanMahasiswa_baik" required="" placeholder="Baik" />

                    </div>

                    <div class="form-group">
                        <label for="judul">Tingkat Kepuasan Mahasiswa Cukup</label>
                        <input type="text" class="form-control" id="tingkat_kepuasanMahasiswa_cukup" name="tingkat_kepuasanMahasiswa_cukup" required="" placeholder="Cukup" />

                    </div>

                    <div class="form-group">
                        <label for="judul">Tingkat Kepuasan Mahasiswa Kurang</label>
                        <input type="text" class="form-control" id="tingkat_kepuasanMahasiswa_kurang" name="tingkat_kepuasanMahasiswa_kurang" required="" placeholder="Kurang" />

                    </div>

                    <div class="form-group">
                        <label for="judul">Rencana Tindak Lanjut oleh UPPS/PS</label>
                        <textarea type="text" class="form-control" id="rencana_tindak_lanjut" name="rencana_tindak_lanjut" required="" placeholder=""> </textarea>
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
                        <label for="judul">Tahun</label>
                        <input type="text" class="form-control" id="tahun" name="tahun" required="" placeholder="2020/2021" />
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
        <label for="judul">Aspek yang diukur</label>
        <select type="text" class="form-control" id="aspek_diukir_update" name="aspek_diukir">
            <option>Keandalan</option>
            <option>DLL (Dibuat Otomatis)</option>

        </select>
    </div>

    <div class="form-group">
        <label for="judul">Tingkat Kepuasan Mahasiswa Sangat Baik</label>
        <input type="text" class="form-control" id="tingkat_kepuasanMahasiswa_sangatBaik_update" name="tingkat_kepuasanMahasiswa_sangatBaik" required="" placeholder="Sangat Baik" />

    </div>

    <div class="form-group">
        <label for="judul">Tingkat Kepuasan Mahasiswa Baik</label>
        <input type="text" class="form-control" id="tingkat_kepuasanMahasiswa_baik_update" name="tingkat_kepuasanMahasiswa_baik" required="" placeholder="Baik" />

    </div>

    <div class="form-group">
        <label for="judul">Tingkat Kepuasan Mahasiswa Cukup</label>
        <input type="text" class="form-control" id="tingkat_kepuasanMahasiswa_cukup_update" name="tingkat_kepuasanMahasiswa_cukup" required="" placeholder="Cukup" />

    </div>

    <div class="form-group">
        <label for="judul">Tingkat Kepuasan Mahasiswa Kurang</label>
        <input type="text" class="form-control" id="tingkat_kepuasanMahasiswa_kurang_update" name="tingkat_kepuasanMahasiswa_kurang" required="" placeholder="Kurang" />

    </div>

    <div class="form-group">
        <label for="judul">Rencana Tindak Lanjut oleh UPPS/PS</label>
        <textarea type="text" class="form-control" id="rencana_tindak_lanjut_update" name="rencana_tindak_lanjut" required="" placeholder=""> </textarea>
    </div>

    <div class="form-group">
        <label for="judul">Unggah File Bukti Dokumen (opsional)</label>
        <input type="file" class="form-control" id="file_bukti_dokumen_update" name="file_bukti_dokumen" />
    </div>

    <div class="form-group">
        <label for="judul">Link Bukti Dokumen (opsional)</label>
        <input type="text" class="form-control" id="link_bukti_dokumen_update" name="link_bukti_dokumen" />
    </div>

    <div class="form-group">
        <label for="judul">Tahun</label>
        <input type="text" class="form-control" id="tahun_update" name="tahun" required="" placeholder="2020/2021" />
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
        var url = '{{route("prodi_pendidikan_kepuasan_mahasiswa_delete", ":id") }}';
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
    $('#aspek_diukir_update').val(data[1]);
    $('#tingkat_kepuasanMahasiswa_sangatBaik_update').val(data[2]);
    $('#tingkat_kepuasanMahasiswa_baik_update').val(data[3]);
    $('#tingkat_kepuasanMahasiswa_cukup_update').val(data[4]);
    $('#tingkat_kepuasanMahasiswa_kurang_update').val(data[5]);
    $('#rencana_tindak_lanjut_update').val(data[6]);
    $('#link_bukti_dokumen_update').val(data[8]);
    $('#tahun_update').val(data[9]);
    $('#updateModalform').attr('action','prodi_pendidikan_kepuasan_mahasiswa_update/'+ data[11]);
    $('#updateModal').modal('show');
});
});
</script>

@endsection