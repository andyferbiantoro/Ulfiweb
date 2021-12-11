@extends('layouts.lkps-prodi-master')

@section('title')
Dosen Pembimbing Utama Tugas Akhir
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
                <h4 style="margin-right: 30%;">Data Dosen Pembimbing Utama Tugas Akhir</h4>
                <div class="text-right">
                    <button type="button" class="btn btn-success fa fa-plus" data-toggle="modal" data-target="#ModalTambah">
                        Tambah Data
                    </button>
                    <a href="{{route('prodi_lihat_profil_dosen_dosen_pembimbing_utama_tugas_akhir')}}">
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
                                    <th rowspan="3" style="text-align: center; vertical-align: middle;">No</th>
                                    <th rowspan="3" style="text-align: center; vertical-align: middle;">Tahun Akademik</th>
                                    <th rowspan="3" style="text-align: center; vertical-align: middle;">Nama Dosen</th>
                                    <th colspan="8" style="text-align: center; vertical-align: middle;">Jumlah Mahasiswa yang Dibimbing</th>
                                    <th rowspan="3" style="text-align: center; vertical-align: middle;">Rata-rata Jumlah Bimbingan di Semua Program/Semester</th>
                                    <th rowspan="3" style="text-align: center; vertical-align: middle;">File Bukti Dokumen</th>
                                    <th rowspan="3" style="text-align: center; vertical-align: middle;">Link Bukti Dokumen</th>
                                    <th rowspan="3" style="text-align: center; vertical-align: middle;">Aksi</th>
                                </tr>
                                <tr>
                                    <th colspan="4" style="text-align: center; vertical-align: middle;">Pada Program Studi yang Diakreditasi</th>
                                    <th colspan="4" style="text-align: center; vertical-align: middle;">Pada Program Studi Lain di Perguruan Tinggi</th>

                                </tr>
                                <tr>
                                    <th style="text-align: center; vertical-align: middle;">TS-2</th>
                                    <th style="text-align: center; vertical-align: middle;">TS-1</th>
                                    <th style="text-align: center; vertical-align: middle;">TS</th>
                                    <th style="text-align: center; vertical-align: middle;">Rata-rata</th>
                                    <th style="text-align: center; vertical-align: middle;">TS-2</th>
                                    <th style="text-align: center; vertical-align: middle;">TS-1</th>
                                    <th style="text-align: center; vertical-align: middle;">TS</th>
                                    <th style="text-align: center; vertical-align: middle;">Rata-rata</th>
                                    <th style="display: none;">id_hidden</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $no=1 @endphp
                                @foreach($data_dospem_utama_tugasakhir as $data)
                                <tr>
                                    <td>{{$no++}}</td>
                                    <td>{{$data->tahun_akademik }}</td>
                                    <td>{{$data->nama_dosen }}</td>
                                    <td>{{$data->jumlahMahasiswa_prodiDiakreditasi_ts2 }}</td>
                                    <td>{{$data->jumlahMahasiswa_prodiDiakreditasi_ts1 }}</td>
                                    <td>{{$data->jumlahMahasiswa_prodiDiakreditasi_ts }}</td>
                                    <td>{{$data->rata2_1}}</td>
                                    <td>{{$data->jumlahMahasiswa_prodiLain_perguruanTinggi_ts2 }}</td>
                                    <td>{{$data->jumlahMahasiswa_prodiLain_perguruanTinggi_ts1 }}</td>
                                    <td>{{$data->jumlahMahasiswa_prodiLain_perguruanTinggi_ts}}</td>
                                    <td>{{$data->rata2_2}}</td>
                                    <td>{{$data->rata2_bimbingan}}</td>
                                    <td><a href="{{route('prodi-file_download_bukti_dokumen_dospem',$data->id)}}"><button class="btn btn-info ">Download</button></a></td>
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
                        1. Tahun Akademik merupakan tahun akademik penuh terakhir saat pengajuan usulan akreditasi (TS)<br>
                        2. Data Dosen Pembimbing Utama kegiatan Tugas Akhir mahasiswa pada Program Studi yang Diakreditasi dan pada Program Studi Lain
                        di Perguruan Tinggi dalam 3 tahun terakhir <br>
                        3. Unggah file dengan format (word/pdf/excel/rar/zip) dan link drive bukti Dokumen dalam 3 tahun terakhir seperti : <br>
                        a. Surat Penugasan yang diterbitkan oleh Unit Pengelola Program Studi (UPPS) <br>
                        b Surat Keputusan tentang Pembimbing Tugas Akhir mahasiswa <br>
                        c. Daftar Dosen Pembimbing Utama Tugas Akhir
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
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Dosen Pembimbing Utama Tugas Akhir</h5>
                    
                </div>
                <div class="modal-body">
                    <form method="post" action="{{route('prodi_profil_dosen_dosen_pembimbing_utama_tugas_akhir_add')}}" enctype="multipart/form-data">

                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="judul">Tahun Akademik</label>
                            <input type="text" class="form-control" id="tahun_akademik" name="tahun_akademik" required="" placeholder="2020/2021" />
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
                        <label for="judul">Jumlah Mahasiswa pada Prodi Daikrediatasi</label>
                        <input type="number" class="form-control" id="jumlahMahasiswa_prodiDiakreditasi_ts2" name="jumlahMahasiswa_prodiDiakreditasi_ts2" required="" placeholder="TS-2" /> <br>
                        <input type="number" class="form-control" id="jumlahMahasiswa_prodiDiakreditasi_ts1" name="jumlahMahasiswa_prodiDiakreditasi_ts1" required="" placeholder="TS-1" /> <br>
                        <input type="number" class="form-control" id="jumlahMahasiswa_prodiDiakreditasi_ts" name="jumlahMahasiswa_prodiDiakreditasi_ts" required="" placeholder="TS" />
                    </div>

                    <div class="form-group">
                        <label for="judul">Jumlah Mahasiswa pada Prodi Lain di Perguruan Tinggi</label>
                        <input type="number" class="form-control" id="jumlahMahasiswa_prodiLain_perguruanTinggi_ts2" name="jumlahMahasiswa_prodiLain_perguruanTinggi_ts2" required="" placeholder="TS-2" /> <br>
                        <input type="number" class="form-control" id="jumlahMahasiswa_prodiLain_perguruanTinggi_ts1" name="jumlahMahasiswa_prodiLain_perguruanTinggi_ts1" required="" placeholder="TS-1" /> <br>
                        <input type="number" class="form-control" id="jumlahMahasiswa_prodiLain_perguruanTinggi_ts" name="jumlahMahasiswa_prodiLain_perguruanTinggi_ts" required="" placeholder="TS" />
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
        <h5 class="modal-title">Anda yakin ingin memperbarui Data Menu ini ?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
  </div>
  <div class="modal-body">
    {{ csrf_field() }}
    {{ method_field('POST') }}


    <div class="form-group">
        <label for="judul">Tahun Akademik</label>
        <input type="text" class="form-control" id="tahun_akademik_update" name="tahun_akademik" required="" placeholder="2020/2021" />
    </div>

    <div class="form-group">
        <label for="judul">Nama Dosen</label>
        <input type="text" class="form-control" id="nama_dosen_update" name="nama_dosen_update" required="" />
    </div>

    <div class="form-group">
        <label for="judul">Jumlah Mahasiswa pada Prodi Daikrediatasi</label>
        <input type="number" class="form-control" id="jumlahMahasiswa_prodiDiakreditasi_ts2_update" name="jumlahMahasiswa_prodiDiakreditasi_ts2" required="" placeholder="TS-2" /> <br>
        <input type="number" class="form-control" id="jumlahMahasiswa_prodiDiakreditasi_ts1_update" name="jumlahMahasiswa_prodiDiakreditasi_ts1" required="" placeholder="TS-1" /> <br>
        <input type="number" class="form-control" id="jumlahMahasiswa_prodiDiakreditasi_ts_update" name="jumlahMahasiswa_prodiDiakreditasi_ts" required="" placeholder="TS" />
    </div>

    <div class="form-group">
        <label for="judul">Jumlah Mahasiswa pada Prodi Lain di Perguruan Tinggi</label>
        <input type="number" class="form-control" id="jumlahMahasiswa_prodiLain_perguruanTinggi_ts2_update" name="jumlahMahasiswa_prodiLain_perguruanTinggi_ts2" required="" placeholder="TS-2" /> <br>
        <input type="number" class="form-control" id="jumlahMahasiswa_prodiLain_perguruanTinggi_ts1_update" name="jumlahMahasiswa_prodiLain_perguruanTinggi_ts1" required="" placeholder="TS-1" /> <br>
        <input type="number" class="form-control" id="jumlahMahasiswa_prodiLain_perguruanTinggi_ts_update" name="jumlahMahasiswa_prodiLain_perguruanTinggi_ts" required="" placeholder="TS" />
    </div>

    <div class="form-group">
        <label for="judul">Unggah File Bukti Dokumen (opsional)</label>
        <input type="file" class="form-control" id="file_bukti_dokumen" name="file_bukti_dokumen" />
    </div>

    <div class="form-group">
        <label for="judul">Link Bukti Dokumen (opsional)</label>
        <input type="text" class="form-control" id="link_bukti_dokumen_update" name="link_bukti_dokumen" />
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
        var url = '{{route("prodi_profil_dosen_dosen_pembimbing_utama_tugas_akhir_delete", ":id") }}';
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
    $('#nama_dosen_update').val(data[2]);
    $('#jumlahMahasiswa_prodiDiakreditasi_ts2_update').val(data[3]);
    $('#jumlahMahasiswa_prodiDiakreditasi_ts1_update').val(data[4]);
    $('#jumlahMahasiswa_prodiDiakreditasi_ts_update').val(data[5]);
    $('#jumlahMahasiswa_prodiLain_perguruanTinggi_ts2_update').val(data[7]);
    $('#jumlahMahasiswa_prodiLain_perguruanTinggi_ts1_update').val(data[8]);
    $('#jumlahMahasiswa_prodiLain_perguruanTinggi_ts_update').val(data[9]);
    $('#link_bukti_dokumen_update').val(data[13]);
    $('#updateModalform').attr('action','prodi_profil_dosen_dosen_pembimbing_utama_tugas_akhir_update/'+ data[15]);
    $('#updateModal').modal('show');
});
});
</script>

@endsection