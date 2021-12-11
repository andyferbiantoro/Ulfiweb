@extends('layouts.lkps-prodi-master')

@section('title')
Mahasiswa Asing
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
               
                <h4 style="margin-right: 47%;">Data Mahasiswa Asing</h4>
                <div class="text-right">
                    <button type="button" class="btn btn-success fa fa-plus" data-toggle="modal" data-target="#ModalTambah">
                        Tambah Data
                    </button>
                    <a href="{{route('prodi_lihat_mahasiswa_mahasiswa_asing')}}">
                        <button type="button" class="btn btn-primary fa fa-book">
                            Lihat Laporan
                        </button></a>
                    </div>
                </div>
                <div class="card-body">
                    <form class="form-inline">
                        <div class="form-group mx-sm-1 mb-2">
                            <!-- <label for="inputPassword2" class="sr-only">Password</label> -->
                            <input type="text" class="form-control" id="filter" name="filter" placeholder="Tahun Akademik" value="{{ old('filter') }}">
                        </div>
                        <button type="submit" class="btn btn-primary mb-2 fa fa-filter">Filter</button>
                    </form><br>
                    <div class="table-responsive">
                        <table id="dataTable" class="table table-hover">
                            <thead>
                                <tr>
                                    <th rowspan="2" style="text-align: center; vertical-align: middle;">No</th>
                                    <th rowspan="2" style="text-align: center; vertical-align: middle;">Tahun Akademik</th>
                                    <th rowspan="2" style="text-align: center; vertical-align: middle;">Program Studi</th>
                                    <th colspan="3" style="text-align: center; vertical-align: middle;">Jumlah Mahasiswa Aktif</th>
                                    <th colspan="3" style="text-align: center; vertical-align: middle;">Jumlah Mahasiswa Asing Penuh Waktu(Full-time)</th>
                                    <th colspan="3" style="text-align: center; vertical-align: middle;">Jumlah Mahasiswa Asing Paruh Waktu(Part-time)</th>
                                    <th rowspan="2" style="text-align: center; vertical-align: middle;">File Bukti Dokumen</th>
                                    <th rowspan="2" style="text-align: center; vertical-align: middle;">Link Bukti Dokumen</th>
                                    <th rowspan="2" style="text-align: center; vertical-align: middle;">Aksi</th>
                                </tr>
                                <tr>
                                    <th style="text-align: center; vertical-align: middle;">TS-2</th>
                                    <th style="text-align: center; vertical-align: middle;">TS-1</th>
                                    <th style="text-align: center; vertical-align: middle;">TS</th>
                                    <th style="text-align: center; vertical-align: middle;">TS-2</th>
                                    <th style="text-align: center; vertical-align: middle;">TS-1</th>
                                    <th style="text-align: center; vertical-align: middle;">TS</th>
                                    <th style="text-align: center; vertical-align: middle;">TS-2</th>
                                    <th style="text-align: center; vertical-align: middle;">TS-1</th>
                                    <th style="text-align: center; vertical-align: middle;">TS</th>
                                    <th style="display: none;">id_hidden</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $no=1 @endphp
                                @foreach($mhs_asing as $data)
                                <tr>
                                    <td>{{$no++ }}</td>
                                    <td>{{$data->tahun_akademik }}</td>
                                    <td>{{$data->nama_prodi }}</td>
                                    <td>{{$data->jumlah_mahasiswaAktif_ts2 }}</td>
                                    <td>{{$data->jumlah_mahasiswaAktif_ts1 }}</td>
                                    <td>{{$data->jumlah_mahasiswaAktif_ts }}</td>
                                    <td>{{$data->jumlah_mahasiswaFullTime_ts2 }}</td>
                                    <td>{{$data->jumlah_mahasiswaFullTime_ts1 }}</td>
                                    <td>{{$data->jumlah_mahasiswaFullTime_ts }}</td>
                                    <td>{{$data->jumlah_mahasiswaPartTime_ts2 }}</td>
                                    <td>{{$data->jumlah_mahasiswaPartTime_ts1 }}</td>
                                    <td>{{$data->jumlah_mahasiswaPartTime_ts }}</td>
                                    <td><a href="{{route('prodi-file_download_mhs_baru',$data->id)}}"><button class="btn btn-info ">Download</button></a></td>
                                    <td><a href="{{$data->link_bukti_dokumen}}">{{$data->link_bukti_dokumen}}</a></td>
                                    <td>
                                    <!-- <a href="">
                                        <button class="btn-sm btn btn-success fa fa-eye" title="Lihat"></button>
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
                    1. Form Mahasiswa Asing diisi oleh pengusul dari Program Studi pada Program Sarjana Terapan<br>
                    2. Tahun Akademik merupakan tahun akademik penuh terakhir saat pengajuan usulan akreditasi (TS)<br>
                    3. Data Mahasiswa Asing pada jumlah mahasiswa aktif, jumlah mahasiswa asing penuh waktu (full-time) dan jumlah
                    mahasiswa asing paruh waktu (part-time). atau jumlah mahasiswa asing yang terdaftar di seluruh Program Studi pada Unit Pegelola
                    Program Studi (UPPS) dalam 3 tahun terakhir <br>
                    4. Mahasiswa asing dapat terdaftar untuk mengikuti program pendidikan secara penuh (full-time). Mahasiswa Asing paruh waktu (part-time)
                    adalah mahasiswa yang terdaftar di Program Studi untuk mengikuti kegiatan pertukaran studi (studi exchange), credit earning, atau kegiatan
                    sejenis yang relevan. <br>
                    5. Unggah file dengan format (rar/zip) dan link drive bukti okumen dalam 3 tahun terakhir seperti: <br>
                    a. Surat Keputusan tentang Penetapan Daya Tampung <br>
                    b. Dokumen Data Penerimaan Mahasiswa Asing <br>
                    c. Surat Keputusan Penetapan Kelulusan Mahasiswa Asing <br>
                    d. Dokumen Data Registrasi Mahasiswa Asing <br>
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
<!-- modal -->
<div class="modal fade" id="ModalTambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Mahasiswa Asing</h5>
                
            </div>
            <div class="modal-body">
                <form method="post" action="{{route('prodi_mahasiswa_mahasiswa_asing_add')}}" enctype="multipart/form-data">

                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="judul">Tahun Akademik</label>
                        <input type="text" class="form-control" id="tahun_akademik" name="tahun_akademik" required="" placeholder="2020/2021" />
                    </div>

                    <div class="form-group">
                        <label for="judul">Program Studi</label>
                        <input type="text" readonly="" class="form-control " id="id_prodi" name="id_prodi" required="" value="{{ Auth::user()->id_prodi }}" placeholder="Prodi yang login (contoh : Teknik Informatika)" />
                        <!-- <select type="text" class="form-control" id="prodi" name="prodi" required="">
                            <option value="">Teknik Informatika</option>
                            <option value="">Teknik Sipil</option>
                            <option value="">Teknik Mesin</option>
                            <option value="">Agribisnis</option>
                            <option value="">Manajemen Bisnis Pariwisata</option>
                            <option value="">Teknologi Pengolahan Hasil Ternak</option>
                            <option value="">Teknik Manufaktur Kapal</option>
                        </select> -->
                    </div>

                    <div class="form-group">
                        <label for="judul">Jumlah Mahasiswa Aktif pada TS-2</label>
                        <input type="text" class="form-control" id="jumlah_mahasiswaAktif_ts2" name="jumlah_mahasiswaAktif_ts2" required="" />
                    </div>
                    <div class="form-group">
                        <label for="judul">Jumlah Mahasiswa Aktif pada TS-1</label>
                        <input type="text" class="form-control" id="jumlah_mahasiswaAktif_ts1" name="jumlah_mahasiswaAktif_ts1" required="" />
                    </div>
                    <div class="form-group">
                        <label for="judul">Jumlah Mahasiswa Aktif pada TS</label>
                        <input type="text" class="form-control" id="jumlah_mahasiswaAktif_ts" name="jumlah_mahasiswaAktif_ts" required="" />
                    </div>

                    <div class="form-group">
                        <label for="judul">Jumlah Mahasiswa Asing Penuh Waktu (Full-time) pada TS-2</label>
                        <input type="text" class="form-control" id="jumlah_mahasiswaFullTime_ts2" name="jumlah_mahasiswaFullTime_ts2" required="" />
                    </div>
                    <div class="form-group">
                        <label for="judul">Jumlah Mahasiswa Asing Penuh Waktu (Full-time) pada TS-1</label>
                        <input type="text" class="form-control" id="jumlah_mahasiswaFullTime_ts1" name="jumlah_mahasiswaFullTime_ts1" required="" />
                    </div>
                    <div class="form-group">
                        <label for="judul">Jumlah Mahasiswa Asing Penuh Waktu (Full-time) pada TS</label>
                        <input type="text" class="form-control" id="jumlah_mahasiswaFullTime_ts" name="jumlah_mahasiswaFullTime_ts" required="" />
                    </div>

                    <div class="form-group">
                        <label for="judul">Jumlah Mahasiswa Asing Paruh Waktu (Part-time) pada TS-2</label>
                        <input type="text" class="form-control" id="jumlah_mahasiswaPartTime_ts2" name="jumlah_mahasiswaPartTime_ts2" required="" />
                    </div>
                    <div class="form-group">
                        <label for="judul">Jumlah Mahasiswa Asing Paruh Waktu (Part-time) pada TS-1</label>
                        <input type="text" class="form-control" id="jumlah_mahasiswaPartTime_ts1" name="jumlah_mahasiswaPartTime_ts1" required="" />
                    </div>
                    <div class="form-group">
                        <label for="judul">Jumlah Mahasiswa Asing Paruh Waktu (Part-time) pada TS</label>
                        <input type="text" class="form-control" id="jumlah_mahasiswaPartTime_ts" name="jumlah_mahasiswaPartTime_ts" required="" />
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
                        <input type="text" class="form-control" id="tahun_akademik_update" name="tahun_akademik" required="" placeholder="2020/2021" />
                    </div>

                    <div class="form-group">
                        <input type="hidden" readonly="" class="form-control " id="id_prodi_update" name="id_prodi" required="" value="{{ Auth::user()->id_prodi }}" placeholder="Prodi yang login (contoh : Teknik Informatika)" />
                    </div>

                    <div class="form-group">
                        <label for="judul">Jumlah Mahasiswa Aktif pada TS-2</label>
                        <input type="text" class="form-control" id="jumlah_mahasiswaAktif_ts2_update" name="jumlah_mahasiswaAktif_ts2" required="" />
                    </div>
                    <div class="form-group">
                        <label for="judul">Jumlah Mahasiswa Aktif pada TS-1</label>
                        <input type="text" class="form-control" id="jumlah_mahasiswaAktif_ts1_update" name="jumlah_mahasiswaAktif_ts1" required="" />
                    </div>
                    <div class="form-group">
                        <label for="judul">Jumlah Mahasiswa Aktif pada TS</label>
                        <input type="text" class="form-control" id="jumlah_mahasiswaAktif_ts_update" name="jumlah_mahasiswaAktif_ts" required="" />
                    </div>

                    <div class="form-group">
                        <label for="judul">Jumlah Mahasiswa Asing Penuh Waktu (Full-time) pada TS-2</label>
                        <input type="text" class="form-control" id="jumlah_mahasiswaFullTime_ts2_update" name="jumlah_mahasiswaFullTime_ts2" required="" />
                    </div>
                    <div class="form-group">
                        <label for="judul">Jumlah Mahasiswa Asing Penuh Waktu (Full-time) pada TS-1</label>
                        <input type="text" class="form-control" id="jumlah_mahasiswaFullTime_ts1_update" name="jumlah_mahasiswaFullTime_ts1" required="" />
                    </div>
                    <div class="form-group">
                        <label for="judul">Jumlah Mahasiswa Asing Penuh Waktu (Full-time) pada TS</label>
                        <input type="text" class="form-control" id="jumlah_mahasiswaFullTime_ts_update" name="jumlah_mahasiswaFullTime_ts" required="" />
                    </div>

                    <div class="form-group">
                        <label for="judul">Jumlah Mahasiswa Asing Paruh Waktu (Part-time) pada TS-2</label>
                        <input type="text" class="form-control" id="jumlah_mahasiswaPartTime_ts2_update" name="jumlah_mahasiswaPartTime_ts2" required="" />
                    </div>
                    <div class="form-group">
                        <label for="judul">Jumlah Mahasiswa Asing Paruh Waktu (Part-time) pada TS-1</label>
                        <input type="text" class="form-control" id="jumlah_mahasiswaPartTime_ts1_update" name="jumlah_mahasiswaPartTime_ts1" required="" />
                    </div>
                    <div class="form-group">
                        <label for="judul">Jumlah Mahasiswa Asing Paruh Waktu (Part-time) pada TS</label>
                        <input type="text" class="form-control" id="jumlah_mahasiswaPartTime_ts_update" name="jumlah_mahasiswaPartTime_ts" required="" />
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
                    <p>Apakah anda yakin ingin Menghapus data Seleksi Mahasiswa Asing ini ?</p>
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
    $('#jumlah_mahasiswaAktif_ts2_update').val(data[3]);
    $('#jumlah_mahasiswaAktif_ts1_update').val(data[4]);
    $('#jumlah_mahasiswaAktif_ts_update').val(data[5]);
    $('#jumlah_mahasiswaFullTime_ts2_update').val(data[6]);
    $('#jumlah_mahasiswaFullTime_ts1_update').val(data[7]);
    $('#jumlah_mahasiswaFullTime_ts_update').val(data[8]);
    $('#jumlah_mahasiswaPartTime_ts2_update').val(data[9]);
    $('#jumlah_mahasiswaPartTime_ts1_update').val(data[10]);
    $('#jumlah_mahasiswaPartTime_ts_update').val(data[11]);
    $('#link_bukti_dokumen_update').val(data[13]);
    $('#updateform').attr('action','prodi_mahasiswa_mahasiswa_asing_update/'+ data[15]);
    $('#ModalEdit').modal('show');
});
});
</script>

@endsection