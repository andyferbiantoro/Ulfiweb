@extends('layouts.lkps-prodi-master')

@section('title')
Seleksi Mahasiswa Baru
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

            <h4 style="margin-right: 43%;">Data Seleksi Mahasiswa Baru</h4>
            <div class="text-right">
                <button type="button" class="btn btn-success fa fa-plus" data-toggle="modal" data-target="#ModalTambah">
                    Tambah Data
                </button>
                <a href="{{route('prodi_lihat_mahasiswa_seleksi_mahasiswa_baru')}}">
                    <button type="button" class="btn btn-primary fa fa-book">
                        Lihat Laporan
                    </button></a>
                    <button onclick="printDiv('pdf','Title')">print div</button>

                </div>
            </div>
            <div class="card-body">
                <div class="text-right">
                    <form class="form-inline">
                        <div class="form-group mx-sm-1 mb-2">
                            <!-- <label for="inputPassword2" class="sr-only">Password</label> -->
                            <input type="text" class="form-control" id="filter" name="filter" placeholder="Tahun Akademik" value="{{ old('filter') }}">
                        </div>
                        <button type="submit" class="btn btn-primary mb-2 fa fa-filter">Filter</button>
                    </form><br>
                </div>
                <div class="table-responsive">
                <div id="pdf">
                    <table id="dataTable" class="table table-hover">
                        <thead>
                            <tr>
                                <th rowspan="2" style="text-align: center; vertical-align: middle;">No</th>
                                <th rowspan="2" style="text-align: center; vertical-align: middle;">Tahun Akakdemik</th>
                                <th rowspan="2" style="text-align: center; vertical-align: middle;">Daya Tampung</th>
                                <th colspan="2" style="text-align: center; vertical-align: middle;">Jumlah Calon Mahasiswa</th>
                                <th colspan="2" style="text-align: center; vertical-align: middle;">Jumlah Mahasiswa Baru</th>
                                <th colspan="2" style="text-align: center; vertical-align: middle;">Jumlah Mahasiswa Aktif</th>
                                <th rowspan="2" style="text-align: center; vertical-align: middle;">File Bukti Dokumen</th>
                                <th rowspan="2" style="text-align: center; vertical-align: middle;">Link Bukti Dokumen</th>
                                <th rowspan="2" style="text-align: center; vertical-align: middle;">Aksi</th>
                            </tr>
                            <tr>
                                <th style="text-align: center; vertical-align: middle;">Pendaftar</th>
                                <th style="text-align: center; vertical-align: middle;">Lulus Seleksi</th>
                                <th style="text-align: center; vertical-align: middle;">Reguler</th>
                                <th style="text-align: center; vertical-align: middle;">Transfer</th>
                                <th style="text-align: center; vertical-align: middle;">Reguler</th>
                                <th style="text-align: center; vertical-align: middle;">Transfer</th>
                                <th style="display: none;">id_hidden</th>

                            </tr>
                        </thead>
                        <tbody>
                            @php $no=1 @endphp
                            @foreach($seleksi_mhs_baru as $data)
                            <tr>
                                <td style="text-align: center; vertical-align: middle;">{{$no++}}</td>
                                <td style="text-align: center; vertical-align: middle;">{{$data->tahun_akademik }}</td>
                                <td style="text-align: center; vertical-align: middle;">{{$data->daya_tampung }}</td>
                                <td style="text-align: center; vertical-align: middle;">{{$data->jumlah_calonMahasiswa_pendaftar }}</td>
                                <td style="text-align: center; vertical-align: middle;">{{$data->jumlah_calonMahasiswa_lulus }}</td>
                                <td style="text-align: center; vertical-align: middle;">{{$data->jumlah_mahasiswaBaru_reguler }}</td>
                                <td style="text-align: center; vertical-align: middle;">{{$data->jumlah_mahasiswaBaru_transfer }}</td>
                                <td style="text-align: center; vertical-align: middle;">{{$data->jumlah_mahasiswaAktif_reguler }}</td>
                                <td style="text-align: center; vertical-align: middle;">{{$data->jumlah_mahasiswaAktif_transfer }}</td>
                                <td style="text-align: center; vertical-align: middle;"><a href="{{route('prodi-file_download_mhs_asing',$data->id)}}"><button class="btn btn-info ">Download</button></a></td>
                                <td style="text-align: center; vertical-align: middle;"><a href="{{$data->link_bukti_dokumen}}">{{$data->link_bukti_dokumen}}</a></td>
                                <td>

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
                                <th colspan="3" style="text-align: center; vertical-align: middle;">Jumlah</th>
                                <!-- <th rowspan="2" style="text-align: center; vertical-align: middle;">No</th> -->
                                <th style="text-align: center; vertical-align: middle;">{{$calon_mhs_pendaftar}}</th>
                                <th style="text-align: center; vertical-align: middle;">{{$calon_mhs_lulus}}</th>
                                <th style="text-align: center; vertical-align: middle;">{{$mhs_baru_reguler}}</th>
                                <th style="text-align: center; vertical-align: middle;">{{$mhs_baru_transfer}}</th>
                                <th style="text-align: center; vertical-align: middle;">{{$mhs_aktif_reguler}}</th>
                                <th style="text-align: center; vertical-align: middle;">{{$mhs_aktif_transfer}}</th>
                                <th colspan="3" style="text-align: center; vertical-align: middle;"></th>
                            </tr>
                        </thead>
                    </table>

                </div>
            </div>
            </div>
        </div>
    </div>
</div>
<!-- <div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4>Jumlah Seleksi Mahasiswa Baru</h4>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="" class="table table-hover">
                        <thead>
                            <tr>
                                <th colspan="2" style="text-align: center; vertical-align: middle;">Jumlah Calon Mahasiswa</th>
                                <th colspan="2" style="text-align: center; vertical-align: middle;">Jumlah Mahasiswa Baru</th>
                                <th colspan="2" style="text-align: center; vertical-align: middle;">Jumlah Mahasiswa Aktif</th>
                            </tr>
                            <tr>
                                <th style="text-align: center; vertical-align: middle;">Pendaftar</th>
                                <th style="text-align: center; vertical-align: middle;">Lulus Seleksi</th>
                                <th style="text-align: center; vertical-align: middle;">Reguler</th>
                                <th style="text-align: center; vertical-align: middle;">Transfer</th>
                                <th style="text-align: center; vertical-align: middle;">Reguler</th>
                                <th style="text-align: center; vertical-align: middle;">Transfer</th>

                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{$calon_mhs_pendaftar}}</td>
                                <td>{{$calon_mhs_lulus}}</td>
                                <td>{{$mhs_baru_reguler}}</td>
                                <td>{{$mhs_baru_transfer}}</td>
                                <td>{{$mhs_aktif_reguler}}</td>
                                <td>{{$mhs_aktif_transfer}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div> -->

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <b> Keterangan : </b><br>
                <p style="font-size: 10px;">
                    1. Tahun Akademik merupakan tahun akademik penuh terakhir saat pengajuan usulan akreditasi (TS)<br>
                    2. Data Daya Tampung, jumlah calon mahasiswa (pendaftar dan peserta yang lulus seleksi), jumlah mahasiswa baru (reguler dan transfer)
                    dan jumlah mahasiswa aktif (reguler dan transfer) dalam 5 tahun terakhir. <br>
                    3. Unggah file dengan format (rar/zip) dan link Drive Bukti Dokumen dalam 5 Tahun terakhir seperti : <br>
                    a. Surat Keputusan tentang Penetapan Daya Tampung <br>
                    b. Dokumen Data Penerimaan Mahasiswa Baru <br>
                    c. Surat Keputusan Penetapan Kelulusan Mahasiswa Baru <br>
                    d. Dokumen Data Registrasi Mahasiswa Baru <br>
                    e. Data Mahasiswa Aktif di PDDIKTI <br>
                    f. Dokumen Pendukung seperti Notulasi Rapat, Surat Undangan dan Daftar Hadir
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

<!-- Modal Lihat -->
<div class="modal fade" id="ModalLihat" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Data Mahasiswa Baru Tahun Akademik ......</h5>
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
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table id="dataTable" class="table table-hover">
                        <thead>
                            <tr>
                                <th rowspan="2" style="text-align: center; vertical-align: middle;">Daya Tampung</th>
                                <th colspan="2" style="text-align: center; vertical-align: middle;">Jumlah Calon Mahasiswa</th>
                                <th colspan="2" style="text-align: center; vertical-align: middle;">Jumlah Mahasiswa Baru</th>
                                <th colspan="2" style="text-align: center; vertical-align: middle;">Jumlah Mahasiswa Aktif</th>
                                <th rowspan="2" style="text-align: center; vertical-align: middle;">File Bukti Dokumen</th>
                                <th rowspan="2" style="text-align: center; vertical-align: middle;">Link Bukti Dokumen</th>
                            </tr>
                            <tr>
                                <th style="text-align: center; vertical-align: middle;">Pendaftar</th>
                                <th style="text-align: center; vertical-align: middle;">Lulus Seleksi</th>
                                <th style="text-align: center; vertical-align: middle;">Reguler</th>
                                <th style="text-align: center; vertical-align: middle;">Transfer</th>
                                <th style="text-align: center; vertical-align: middle;">Reguler</th>
                                <th style="text-align: center; vertical-align: middle;">Transfer</th>

                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td id="daya_tampung_show"></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>

            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah -->
<div class="modal fade" id="ModalTambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Mahasiswa Baru</h5>

            </div>
            <div class="modal-body">
                <form method="post" action="{{route('prodi_mahasiswa_seleksi_mahasiswa_baru_add')}}" enctype="multipart/form-data">

                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="judul">Tahun Akademik</label>
                        <input type="text" class="form-control" id="tahun_akademik" name="tahun_akademik" required="" placeholder="2020/2021" />
                        <!-- <div class="col-sm-5">
                            <input type="text" class="form-control " id="th_akademik1" name="th_akademik1" required="" />
                        </div>
                        <b style="font-size: 20px;">/</b>
                        <div class="col-sm-5">
                            <input type="text" class="form-control " id="th_akademik2" name="th_akademik2" required="" />

                        </div> -->
                    </div>
                    <div class="form-group">
                        <label for="judul">Daya Tampung</label>
                        <input type="text" class="form-control" id="daya_tampung" name="daya_tampung" required="" />
                    </div>

                    <div class="form-group">
                        <label for="judul">Jumlah Calon Mahasiswa Pendaftar</label>
                        <input type="text" class="form-control" id="jumlah_calonMahasiswa_pendaftar" name="jumlah_calonMahasiswa_pendaftar" required="" />
                    </div>
                    <div class="form-group">
                        <label for="judul">Jumlah Calon Mahasiswa Lulus Seleksi</label>
                        <input type="text" class="form-control" id="jumlah_calonMahasiswa_lulus" name="jumlah_calonMahasiswa_lulus" required="" />
                    </div>
                    <div class="form-group">
                        <label for="judul">Jumlah Mahasiswa Baru Reguler</label>
                        <input type="text" class="form-control" id="jumlah_mahasiswaBaru_reguler" name="jumlah_mahasiswaBaru_reguler" required="" />
                    </div>
                    <div class="form-group">
                        <label for="judul">Jumlah Mahasiswa Baru Transfer</label>
                        <input type="text" class="form-control" id="jumlah_mahasiswaBaru_transfer" name="jumlah_mahasiswaBaru_transfer" required="" />
                    </div>
                    <div class="form-group">
                        <label for="judul">Jumlah Mahasiswa Aktif Reguler</label>
                        <input type="text" class="form-control" id="jumlah_mahasiswaAktif_reguler" name="jumlah_mahasiswaAktif_reguler" required="" />
                    </div>
                    <div class="form-group">
                        <label for="judul">Jumlah Mahasiswa Aktif Transfer</label>
                        <input type="text" class="form-control" id="jumlah_mahasiswaAktif_transfer" name="jumlah_mahasiswaAktif_transfer" required="" />
                    </div>

                    <div class="form-group">
                        <label for="judul">Unggah File Bukti Dokumen (opsional)</label>
                        <input type="file" class="form-control" id="file_bukti_dokumen" name="file_bukti_dokumen" required="" />
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



<!-- Modal Edit -->
<div class="modal fade" id="ModalEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Data Mahasiswa Baru</h5>

            </div>
            <div class="modal-body">
                <form action="" id="updateform" method="post" enctype="multipart/form-data">

                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="judul">Tahun Akademik</label>
                        <input type="text" class="form-control" id="tahun_akademik_update" name="tahun_akademik" required="" />
                        <!-- <div class="col-sm-5">
                            <input type="text" class="form-control " id="th_akademik1" name="th_akademik1" required="" />
                        </div>
                        <b style="font-size: 20px;">/</b>
                        <div class="col-sm-5">
                            <input type="text" class="form-control " id="th_akademik2" name="th_akademik2" required="" />

                        </div> -->
                    </div>
                    <div class="form-group">
                        <label for="judul">Daya Tampung</label>
                        <input type="text" class="form-control" id="daya_tampung_update" name="daya_tampung" required="" />
                    </div>

                    <div class="form-group">
                        <label for="judul">Jumlah Calon Mahasiswa Pendaftar</label>
                        <input type="text" class="form-control" id="jumlah_calonMahasiswa_pendaftar_update" name="jumlah_calonMahasiswa_pendaftar" required="" />
                    </div>
                    <div class="form-group">
                        <label for="judul">Jumlah Calon Mahasiswa Lulus Seleksi</label>
                        <input type="text" class="form-control" id="jumlah_calonMahasiswa_lulus_update" name="jumlah_calonMahasiswa_lulus" required="" />
                    </div>
                    <div class="form-group">
                        <label for="judul">Jumlah Mahasiswa Baru Reguler</label>
                        <input type="text" class="form-control" id="jumlah_mahasiswaBaru_reguler_update" name="jumlah_mahasiswaBaru_reguler" required="" />
                    </div>
                    <div class="form-group">
                        <label for="judul">Jumlah Mahasiswa Baru Transfer</label>
                        <input type="text" class="form-control" id="jumlah_mahasiswaBaru_transfer_update" name="jumlah_mahasiswaBaru_transfer" required="" />
                    </div>
                    <div class="form-group">
                        <label for="judul">Jumlah Mahasiswa Aktif Reguler</label>
                        <input type="text" class="form-control" id="jumlah_mahasiswaAktif_reguler_update" name="jumlah_mahasiswaAktif_reguler" required="" />
                    </div>
                    <div class="form-group">
                        <label for="judul">Jumlah Mahasiswa Aktif Transfer</label>
                        <input type="text" class="form-control" id="jumlah_mahasiswaAktif_transfer_update" name="jumlah_mahasiswaAktif_transfer" required="" />
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
                    <p>Apakah anda yakin ingin Menghapus data Seleksi Mahasiswa Baru ini ?</p>
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
    var url = '{{route("prodi_mahasiswa_seleksi_mahasiswa_baru_delete", ":id") }}';
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
    $('#tahun_akademik_update').val(data[1]);
    $('#daya_tampung_update').val(data[2]);
    $('#jumlah_calonMahasiswa_pendaftar_update').val(data[3]);
    $('#jumlah_calonMahasiswa_lulus_update').val(data[4]);
    $('#jumlah_mahasiswaBaru_reguler_update').val(data[5]);
    $('#jumlah_mahasiswaBaru_transfer_update').val(data[6]);
    $('#jumlah_mahasiswaAktif_reguler_update').val(data[7]);
    $('#jumlah_mahasiswaAktif_transfer_update').val(data[8]);
    $('#link_bukti_dokumen_update').val(data[10]);
    $('#updateform').attr('action','prodi_mahasiswa_seleksi_mahasiswa_baru_update/'+ data[12]);
    $('#ModalEdit').modal('show');
});
});
</script>


<script>
  $(document).ready(function() {
    var table = $('#dataTable').DataTable();
    table.on('click', '.show', function() {
      $tr = $(this).closest('tr');
      if ($($tr).hasClass('child')) {
        $tr = $tr.prev('.parent');
    }
    var data = table.row($tr).data();
    console.log(data);
    $('#tahun_akademik_show').val(data[1]);
    $('#daya_tampung_show').val(data[2]);
    $('#jumlah_calonMahasiswa_pendaftar_show').val(data[3]);
    $('#jumlah_calonMahasiswa_lulus_show').val(data[4]);
    $('#jumlah_mahasiswaBaru_reguler_show').val(data[5]);
    $('#jumlah_mahasiswaBaru_transfer_show').val(data[6]);
    $('#jumlah_mahasiswaAktif_reguler_show').val(data[7]);
    $('#jumlah_mahasiswaAktif_transfer_show').val(data[8]);
    $('#link_bukti_dokumen_show').val(data[10]);
    $('#ModalLihat').modal('show');
});
});
</script>


@endsection 
<script type="text/javascript">
  function printDiv(divId,
  title) {

  let mywindow = window.open('', 'PRINT', 'height=650,width=900,top=100,left=150');

  mywindow.document.write(`<html><head><title>${title}</title>`);
  mywindow.document.write('</head><body >');
  mywindow.document.write(document.getElementById(divId).innerHTML);
  mywindow.document.write('</body></html>');

  mywindow.document.close(); // necessary for IE >= 10
  mywindow.focus(); // necessary for IE >= 10*/

  mywindow.print();
  mywindow.close();

  return true;
}



</script>  