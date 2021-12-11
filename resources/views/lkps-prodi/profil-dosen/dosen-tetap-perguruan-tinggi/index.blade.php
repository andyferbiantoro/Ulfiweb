@extends('layouts.lkps-prodi-master')

@section('title')
Dosen Tetap Perguruan Tinggi
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
            <h4 style="margin-right: 52%;">Data Dosen Tetap Perguruan Tinggi</h4>
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
                            <th style="text-align: center; vertical-align: middle;">NIDN/NIDK</th>
                            <th style="text-align: center; vertical-align: middle;">Pendidikan Pasca Sarjana</th>
                            <th style="text-align: center; vertical-align: middle;">Bidang Keahlian</th>
                            <th style="text-align: center; vertical-align: middle;">Kesesuaian dengan Kompetensi Inti Program Studi</th>
                            <th style="text-align: center; vertical-align: middle;">Jabatan Akademik</th>
                            <th style="text-align: center; vertical-align: middle;">File Sertifikat Pendidik Profesional</th>
                            <th style="text-align: center; vertical-align: middle;">Link Sertifikat Pendidik Profesional</th>
                            <th style="text-align: center; vertical-align: middle;">File Sertifikat Kompetensi/Profesi/Industri</th>
                            <th style="text-align: center; vertical-align: middle;">Link Sertifikat Kompetensi/Profesi/Industri</th>
                            <th style="text-align: center; vertical-align: middle;">Mata Kuliah yang Diampu Pada Program Studi yang Diakreditasi</th>
                            <th style="text-align: center; vertical-align: middle;">Kesesuaian Bidang Keahlian dengan Mata Kuliah yang Diampu</th>
                            <th style="text-align: center; vertical-align: middle;">Mata Kuliah yang Diampu pada Program Studi Lain</th>
                            <th style="text-align: center; vertical-align: middle;">File Bukti Dokumen</th>
                            <th style="text-align: center; vertical-align: middle;">Link Bukti Dokumen</th>
                            <th style="text-align: center; vertical-align: middle;">Tahun</th>
                            <th style="text-align: center; vertical-align: middle;">Aksi</th>
                            <th style="display: none;">id_hidden</th>
                        </tr>

                    </thead>
                    <tbody>
                        @php $no=1 @endphp
                        @foreach($data_dosen_perguruantinggi as $data)
                        <tr>
                            <td>{{$no++ }}</td>
                            <td>{{$data->nama_dosen }}</td>
                            <td>{{$data->nidn }}</td>
                            <td>{{$data->pendidikan_pasca_sarjana }}</td>
                            <td>{{$data->bidang_keahlian }}</td>
                            <td>{{$data->kesesuaian_kompotensi_prodi }}</td>
                            <td>{{$data->jabatan_akademik }}</td>
                            <td><a href="{{route('prodi-file_download_ser_pendidik',$data->id)}}"><button class="btn btn-info ">Download</button></a></td>
                            <td>{{$data->link_sertifikat_pendidik }}</td>
                            <td><a href="{{route('prodi-file_download_ser_kompetensi',$data->id)}}"><button class="btn btn-info ">Download</button></a></td>
                            <td>{{$data->link_sertifikat_kompetensi }}</td>
                            <td>{{$data->matakuliah_prodi_diakreditasi }}</td>
                            <td>{{$data->kesesuaian_bidang_keahlian }}</td>
                            <td>{{$data->matakuliah_prodi_lain }}</td>
                            <td><a href="{{route('prodi-file_download_bukti_dokumen',$data->id)}}"><button class="btn btn-info ">Download</button></a></td>
                            <td><a href="{{$data->link_bukti_dokumen}}">{{$data->link_bukti_dokumen}}</a></td>
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
                    1. Data Dosen Tetap Perguruan Tinggi yang ditugaskan sebagai pengampu mata kuliah di Program Studi yang diakreditasi (DTPS) pada saat
                    TS (Tahun Akademik penuh terakhir saat pengajuan usulan akreditasi) <br>
                    2. Unggah file dengan format (jpg/png/word/pdf/rar/zip) dan link drive bukti Sertifikat Pendidik Profesional <br>
                    3. Unggah file dengan format (jpg/png/word/pdf/rar/zip) dan link drive bukti Sertifikat Kompetensi/Profesi/Industri <br>
                    4. Unggah file dengan format (rar/zip) dan link drive bukti dokumen seperti : <br>
                    a. Forlap Dikti (Forum Laporan Pendidikan Tinggi) <br>
                    b. Surat Keputusan tentang Penugasan Dosen Program Studi <br>
                    c. Surat Keputusan Jabatan Fungsional Dosen pada Jabatan Akademik <br>
                    d. Dokumen Ijazah Dosen <br>
                    e. Surat Keputusan Dosen Pengampu Mata Kuliah Program Studi
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
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Dosen Tetap Perguruan Tinggi</h5>
            </div>
            <div class="modal-body">
                <form method="post" action="{{route('prodi_profil_dosen_dosen_tetap_perguruan_tinggi_add')}}" enctype="multipart/form-data">

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
                    <label for="judul">NIDN/NIDK</label>
                    <input type="text" class="form-control" id="nidn" name="nidn" required="" />
                </div>

                <div class="form-group">
                    <label for="judul">Pendidikan Pasca Sarjana</label>
                    <input type="text" class="form-control" id="pendidikan_pasca_sarjana" name="pendidikan_pasca_sarjana" required="" />
                </div>

                <div class="form-group">
                    <label for="judul">Bidang Keahlian</label>
                    <input type="text" class="form-control" id="bidang_keahlian" name="bidang_keahlian" required="" />
                </div>

                    <!-- <div class="form-check">
                        <label for="judul">Kesesuaian dengan Kompetensi Program Studi   </label>
                        <input type="checkbox" class="form-form-check-input" id="waktu" name="waktu" required="" />
                    </div> -->
                    <div class="form-group">
                        <label for="judul">Kesesuaian dengan Kompetensi Program Studi</label>
                        <select type="text" class="form-control" id="kesesuaian_kompotensi_prodi" name="kesesuaian_kompotensi_prodi" required="">
                            <option>Sesuai</option>
                            <option>Tidak Sesuai</option>

                        </select>
                    </div>

                    <div class="form-group">
                        <label for="judul">Jabatan Akademik</label>
                        <select type="text" class="form-control" id="jabatan_akademik" name="jabatan_akademik" required="">
                            <option>Tenaga Pengajar</option>
                            <option>Asisten Ahli</option>
                            <option>Lektor</option>
                            <option>Lektor Kepala</option>
                            <option>Guru Besar</option>
                        </select>
                    </div>


                    <div class="form-group">
                        <label for="judul">Unggah File Sertifikat Pendidik Profesional (opsional)</label>
                        <input type="file" class="form-control" id="file_sertifikat_pendidik" name="file_sertifikat_pendidik" />
                    </div>

                    <div class="form-group">
                        <label for="judul">Link Sertifikat Pendidik Profesional (opsional)</label>
                        <input type="text" class="form-control" id="link_sertifikat_pendidik" name="link_sertifikat_pendidik" />
                    </div>

                    <div class="form-group">
                        <label for="judul">Unggah File Sertifikat Kompetensi/Profesi/Industri (opsional)</label>
                        <input type="file" class="form-control" id="file_sertifikat_kompetensi" name="file_sertifikat_kompetensi" />
                    </div>

                    <div class="form-group">
                        <label for="judul">Link Sertifikat Kompetensi/Profesi/Industri (opsional)</label>
                        <input type="text" class="form-control" id="link_sertifikat_kompetensi" name="link_sertifikat_kompetensi" />
                    </div>

                    <div class="form-group">
                        <label for="judul">Mata Kuliah yang diampu pada Program Studi yang Diakreditasi</label>
                        <input type="text" class="form-control" id="matakuliah_prodi_diakreditasi" name="matakuliah_prodi_diakreditasi" required="" />
                    </div>

                    <div class="form-group">
                        <label for="judul">Kesesuaian Bidang Keahlian dengan Mata Kuliah yang Diampu</label>
                        <select type="text" class="form-control" id="kesesuaian_bidang_keahlian" name="kesesuaian_bidang_keahlian" required="">
                            <option>Sesuai</option>
                            <option>Tidak Sesuai</option>

                        </select>
                    </div>

                    <div class="form-group">
                        <label for="judul">Mata Kuliah yang diampu pada Program Studi Lain</label>
                        <input type="text" class="form-control" id="matakuliah_prodi_lain" name="matakuliah_prodi_lain" required="" />
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





<div id="updateLkps" class="modal fade" role="dialog">
  <div class="modal-dialog ">
   <!--Modal content-->
   <form action="" id="updatelkpsform" method="post" enctype="multipart/form-data">
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
        <label for="judul">Nama Dosen</label>
        <input type="text" class="form-control" id="nama_dosen_update" name="nama_dosen" required="" />
    </div>

    <div class="form-group">
        <label for="judul">NIDN/NIDK</label>
        <input type="text" class="form-control" id="nidn_update" name="nidn" required="" />
    </div>

    <div class="form-group">
        <label for="judul">Pendidikan Pasca Sarjana</label>
        <input type="text" class="form-control" id="pendidikan_pasca_sarjana_update" name="pendidikan_pasca_sarjana" required="" />
    </div>

    <div class="form-group">
        <label for="judul">Bidang Keahlian</label>
        <input type="text" class="form-control" id="bidang_keahlian_update" name="bidang_keahlian" required="" />
    </div>

                    <!-- <div class="form-check">
                        <label for="judul">Kesesuaian dengan Kompetensi Program Studi   </label>
                        <input type="checkbox" class="form-form-check-input" id="waktu" name="waktu" required="" />
                    </div> -->
                    <div class="form-group">
                        <label for="judul">Kesesuaian dengan Kompetensi Program Studi</label>
                        <select type="text" class="form-control" id="kesesuaian_kompotensi_prodi_update" name="kesesuaian_kompotensi_prodi" required="">
                            <option>Sesuai</option>
                            <option>Tidak Sesuai</option>

                        </select>
                    </div>

                    <div class="form-group">
                        <label for="judul">Jabatan Akademik</label>
                        <select type="text" class="form-control" id="jabatan_akademik_update" name="jabatan_akademik" required="">
                            <option>Tenaga Pengajar</option>
                            <option>Asisten Ahli</option>
                            <option>Lektor</option>
                            <option>Lektor Kepala</option>
                            <option>Guru Besar</option>
                        </select>
                    </div>


                    <div class="form-group">
                        <label for="judul">Unggah File Sertifikat Pendidik Profesional (opsional)</label>
                        <input type="file" class="form-control" id="file_sertifikat_pendidik_update" name="file_sertifikat_pendidik" />
                    </div>

                    <div class="form-group">
                        <label for="judul">Link Sertifikat Pendidik Profesional (opsional)</label>
                        <input type="text" class="form-control" id="link_sertifikat_pendidik_update" name="link_sertifikat_pendidik" />
                    </div>

                    <div class="form-group">
                        <label for="judul">Unggah File Sertifikat Kompetensi/Profesi/Industri (opsional)</label>
                        <input type="file" class="form-control" id="file_sertifikat_kompetensi_update" name="file_sertifikat_kompetensi" />
                    </div>

                    <div class="form-group">
                        <label for="judul">Link Sertifikat Kompetensi/Profesi/Industri (opsional)</label>
                        <input type="text" class="form-control" id="link_sertifikat_kompetensi_update" name="link_sertifikat_kompetensi" />
                    </div>

                    <div class="form-group">
                        <label for="judul">Mata Kuliah yang diampu pada Program Studi yang Diakreditasi</label>
                        <input type="text" class="form-control" id="matakuliah_prodi_diakreditasi_update" name="matakuliah_prodi_diakreditasi" required="" />
                    </div>

                    <div class="form-group">
                        <label for="judul">Kesesuaian Bidang Keahlian dengan Mata Kuliah yang Diampu</label>
                        <select type="text" class="form-control" id="kesesuaian_bidang_keahlian_update" name="kesesuaian_bidang_keahlian" required="">
                            <option>Sesuai</option>
                            <option>Tidak Sesuai</option>

                        </select>
                    </div>

                    <div class="form-group">
                        <label for="judul">Mata Kuliah yang diampu pada Program Studi Lain</label>
                        <input type="text" class="form-control" id="matakuliah_prodi_lain_update" name="matakuliah_prodi_lain" required="" />
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
        var url = '{{route("prodi_profil_dosen_dosen_tetap_perguruan_tinggi_delete", ":id") }}';
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
    $('#nidn_update').val(data[2]);
    $('#pendidikan_pasca_sarjana_update').val(data[3]);
    $('#bidang_keahlian_update').val(data[4]);
    $('#kesesuaian_kompotensi_prodi_update').val(data[5]);
    $('#jabatan_akademik_update').val(data[6]);
    $('#link_sertifikat_pendidik_update').val(data[8]);
    $('#link_sertifikat_kompetensi_update').val(data[10]);
    $('#matakuliah_prodi_diakreditasi_update').val(data[11]);
    $('#kesesuaian_bidang_keahlian_update').val(data[12]);
    $('#matakuliah_prodi_lain_update').val(data[13]);
    $('#link_bukti_dokumen_update').val(data[15]);
    $('#tahun_update').val(data[16]);
    $('#updatelkpsform').attr('action','prodi_profil_dosen_dosen_tetap_perguruan_tinggi_update/'+ data[18]);
    $('#updateLkps').modal('show');
});
});
</script>

@endsection