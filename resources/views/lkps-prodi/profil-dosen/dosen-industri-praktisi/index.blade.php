@extends('layouts.lkps-prodi-master')

@section('title')
Dosen Industri / Praktisi
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
            <h4 style="margin-right: 58%;">Data Dosen industri / Praktisi</h4>
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
                            <th style="text-align: center; vertical-align: middle;">Nama Dosen Industri/ Praktisi</th>
                            <th style="text-align: center; vertical-align: middle;">NIDK</th>
                            <th style="text-align: center; vertical-align: middle;">Perusahaan/ Industri</th>
                            <th style="text-align: center; vertical-align: middle;">Pendidikan Tertinggi</th>
                            <th style="text-align: center; vertical-align: middle;">Bidang Keahlian</th>
                            <th style="text-align: center; vertical-align: middle;">File Sertifikat Kompetensi/ Profesi/ industri</th>
                            <th style="text-align: center; vertical-align: middle;">Link Sertifikat Kompetensi/ Profesi/ industri</th>
                            <th style="text-align: center; vertical-align: middle;">Mata Kuliah yang Diampu</th>
                            <th style="text-align: center; vertical-align: middle;">Bobot Kredit (sks)</th>
                            <th style="text-align: center; vertical-align: middle;">Tahun</th>
                            <th style="text-align: center; vertical-align: middle;">File Bukti Dokumen</th>
                            <th style="text-align: center; vertical-align: middle;">Link Bukti Dokumen</th>
                            <th style="text-align: center; vertical-align: middle;">Aksi</th>
                            <th style="display: none;">id_hidden</th>
                        </tr>

                    </thead>
                    <tbody>
                        @php $no=1 @endphp
                        @foreach($dosen_industri as $data)
                        <tr>
                            <td>{{$no++ }}</td>
                            <td>{{$data->nama_dosen }}</td>
                            <td>{{$data->nidk }}</td>
                            <td>{{$data->perusahaan }}</td>
                            <td>{{$data->pendidikan_tertinggi }}</td>
                            <td>{{$data->bidang_keahlian }}</td>
                            <td><a href="{{route('prodi-file_download_ser_kompetensi_industri',$data->id)}}"><button class="btn btn-info ">Download</button></a></td>
                            <td>{{$data->link_sertifikat_kompetensi }}</td>
                            <td>{{$data->matakuliah_diampu }}</td>
                            <td>{{$data->bobot_kredit }}</td>
                            <td>{{$data->tahun }}</td>
                            <td><a href="{{route('prodi-file_download_bukti_dokumen_industri',$data->id)}}"><button class="btn btn-info ">Download</button></a></td>
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
                    1. Data Dosen Industri/Praktisi yang ditugaskan sebagai pengampu mata kuliah kompetensi di Program Studi yang diakreditasi pada saat
                    TS (Tahun Akademik penuh terakhir saat pengajuan usulan akreditasi) <br>
                    2. Unggah file dengan format (jpg/png/word/pdf/rar/zip) dan link drive bukti Sertifikat Kompetensi/Profesi/Industri <br>
                    3. Unggah file dengan format (word/pdf/rar/zip) dan link drive Bukti Dokumen Surat Keputusan tentang Pengampu Mata Kuliah dan Beban Mengajar (Jumlah sks)
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
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Dosen industri / Praktisi</h5>

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
                    <label for="judul">NIDK</label>
                    <input type="text" class="form-control" id="nidk" name="nidk" required="" />
                </div>

                <div class="form-group">
                    <label for="judul">Perusahaan/ Industri</label>
                    <input type="text" class="form-control" id="perusahaan" name="perusahaan" required="" />
                </div>

                <div class="form-group">
                    <label for="judul">Pendidikan Tertinggi</label>
                    <input type="text" class="form-control" id="pendidikan_tertinggi" name="pendidikan_tertinggi" required="" />
                </div>

                <div class="form-group">
                    <label for="judul">Bidang Keahlian</label>
                    <input type="text" class="form-control" id="bidang_keahlian" name="bidang_keahlian" required="" />
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
                    <label for="judul">Mata Kuliah yang diampu</label>
                    <input type="text" class="form-control" id="matakuliah_diampu" name="matakuliah_diampu" required="" />
                </div>


                <div class="form-group">
                    <label for="judul">Bobot Kredit (sks)</label>
                    <input type="text" class="form-control" id="bobot_kredit" name="bobot_kredit" required="" />
                </div>

                <div class="form-group">
                    <label for="judul">Tahun</label>
                    <input type="text" class="form-control" id="tahun" name="tahun" required="" />
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
        <label for="judul">Nama Dosen (DT)</label>
        <input type="text" class="form-control" id="nama_dosen_update" name="nama_dosen" readonly="" required="" />
    </div>

    <div class="form-group">
        <label for="judul">NIDK</label>
        <input type="text" class="form-control" id="nidk_update" name="nidk" required="" />
    </div>

    <div class="form-group">
        <label for="judul">Perusahaan/ Industri</label>
        <input type="text" class="form-control" id="perusahaan_update" name="perusahaan" required="" />
    </div>

    <div class="form-group">
        <label for="judul">Pendidikan Tertinggi</label>
        <input type="text" class="form-control" id="pendidikan_tertinggi_update" name="pendidikan_tertinggi" required="" />
    </div>

    <div class="form-group">
        <label for="judul">Bidang Keahlian</label>
        <input type="text" class="form-control" id="bidang_keahlian_update" name="bidang_keahlian" required="" />
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
        <label for="judul">Mata Kuliah yang diampu</label>
        <input type="text" class="form-control" id="matakuliah_diampu_update" name="matakuliah_diampu" required="" />
    </div>


    <div class="form-group">
        <label for="judul">Bobot Kredit (sks)</label>
        <input type="text" class="form-control" id="bobot_kredit_update" name="bobot_kredit" required="" />
    </div>

    <div class="form-group">
        <label for="judul">Tahun</label>
        <input type="text" class="form-control" id="tahun_update" name="tahun" required="" />
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
        var url = '{{route("prodi_profil_dosen_dosen_industri_praktisi_delete", ":id") }}';
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
    $('#nidk_update').val(data[2]);
    $('#perusahaan_update').val(data[3]);
    $('#pendidikan_tertinggi_update').val(data[4]);
    $('#bidang_keahlian_update').val(data[5]);
    $('#link_sertifikat_kompetensi_update').val(data[7]);
    $('#matakuliah_diampu_update').val(data[8]);
    $('#bobot_kredit_update').val(data[9]);
    $('#tahun_update').val(data[10]);
    $('#link_bukti_dokumen_update').val(data[12]);
    $('#updateModalform').attr('action','prodi_profil_dosen_dosen_industri_praktisi_update/'+ data[14]);
    $('#updateModal').modal('show');
});
});
</script>

@endsection