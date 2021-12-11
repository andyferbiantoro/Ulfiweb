@extends('layouts.lkps-prodi-master')

@section('title')
Data LKPS
@endsection


@section('content')

<!-- Card View -->
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
        <h4 style="margin-right: 45%;">Data Laporan Kinerja Program Studi (LKPS)</h4>
        <div class="text-right">
          <button type="button" class="btn btn-success fa fa-plus" data-toggle="modal" data-target="#ModalTambah">
            Tambah Data
          </button>

        </div>
      </div>

      <!-- Button Untuk tambah Data dengan modal -->
      <div class="card-body">
        <div class="text-right">
          <form class="form-inline" action="{{route('prodi_data_lkps')}}" method="GET">
            <div class="form-group mx-sm-1 mb-2">
              <!-- <label for="inputPassword2" class="sr-only">Password</label> -->
              <input type="text" class="form-control" id="filter" name="filter" placeholder="Tahun" value="{{ old('filter') }}">
            </div>
            <button type="submit" class="btn btn-primary mb-2 fa fa-filter">Filter</button>
          </form><br>
            <button class="btn btn-success mb-2" onclick="print('printPDF', 'Title')">Cetak PDF</button>
        </div>
        <!-- end button -->

        <!-- Tabel Data LKPS-->
        <div id="printPDF">
        <div class="table-responsive">
          <table id="dataTable"  class="table table-hover">
            <thead>
              <tr>
                <th style="text-align: center; vertical-align: middle;">No</th>
                <th style="text-align: center; vertical-align: middle;">Nama Program Studi</th>
                <th style="text-align: center; vertical-align: middle;">Jenis Program</th>
                <th style="text-align: center; vertical-align: middle;">Peringkat Akreditasi Program Studi</th>
                <th style="text-align: center; vertical-align: middle;">Nomor SK BAN-PT</th>
                <th style="text-align: center; vertical-align: middle;">Tanggal Kadaluarsa</th>
                <th style="text-align: center; vertical-align: middle;">Nama Unit Pengelola</th>
                <th style="text-align: center; vertical-align: middle;">Nama Perguruan Tinggi</th>
                <th style="text-align: center; vertical-align: middle;">Alamat</th>
                <th style="text-align: center; vertical-align: middle;">Kota / Kabupaten</th>
                <th style="text-align: center; vertical-align: middle;">Kode Pos</th>
                <th style="text-align: center; vertical-align: middle;">Nomor Telepon</th>
                <th style="text-align: center; vertical-align: middle;">Email</th>
                <th style="text-align: center; vertical-align: middle;">Website</th>
                <th style="text-align: center; vertical-align: middle;">Ts(Tahun Akademik)</th>
                <th style="text-align: center; vertical-align: middle;">File Laporan Evaluasi</th>
                <th style="text-align: center; vertical-align: middle;">Link Laporan Evaluasi</th>
                <th style="text-align: center; vertical-align: middle;">Nama Pengusul</th>
                <th style="text-align: center; vertical-align: middle;">Tanggal</th>
                <th style="text-align: center; vertical-align: middle;">Aksi</th>
                <th style="display: none;">id_hidden</th>
                
              </tr>
            </thead>
            <tbody>
              @php $no=1 @endphp
              @foreach($data_lkps as $data)
              <tr>
                <td>{{$no++}}</td>
                <td>{{$data->nama_prodi }}</td>
                <td>{{$data->jenis_program }}</td>
                <td>{{$data->peringkat_akreditasi }}</td>
                <td>{{$data->nomor_sk_banpt }}</td>
                <td>{{$data->tanggal_kadaluarsa}}</td>
                <td>{{$data->nama_unit_pengelola }}</td>
                <td>{{$data->nama_perguruan_tinggi }}</td>
                <td>{{$data->alamat }}</td>
                <td>{{$data->kabupaten }}</td>
                <td>{{$data->kode_pos }}</td>
                <td>{{$data->nomor_tlp }}</td>
                <td>{{$data->email }}</td>
                <td>{{$data->website }}</td>
                <td>{{$data->tahun_akademik }}</td>
                <td><a href="{{route('prodi-file_download_lkps',$data->id)}}"><button class="btn btn-info ">Download</button></a></td>
                <td><a href="{{$data->link_laporan_evaluasi}}">{{$data->link_laporan_evaluasi}}</a></td>
                <td>{{$data->nama_pengusul }}</td>
                <td>{{$data->tanggal }}</td>
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

                  @if($data->status == 1 || $data->status == 2 )
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
        <!-- end table -->
      </div>
    </div>
  </div>
</div>
<!-- end card -->

<!-- Untuk Mengatur Keterangan -->
<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-body">
        <b> Keterangan : </b><br>
        <p style="font-size: 10px;">
          1. TS (Tahun Akademik Penuh Terakhir saat Pengajuan usulan Akreditasi).<br>
          2. Unggah File dengan Format (rar/zip) dan Link Drive Laporan Evaluasi seperti : <br>
          a. Laporan Evauasi Kinerja Program Studi.<br>
          b. Laporan Evaluasi Diri.
        </p>
      </div>
    </div>
  </div>
</div>
<!-- end keterangan -->

<!-- Untuk Mengatur Komentar -->
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
<!-- end komentar -->

<!-- --modal Form Tambah Data-- -->
<!-- modal adalah view yang pop-up/muncul saat tombol diklik -->
<div class="modal fade" id="ModalTambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Laporan Kinerja Program Studi (LKPS)</h5>
        
      </div>
      <div class="modal-body">
        <form method="post" action="{{route('prodi_data_lkps_add')}}" enctype="multipart/form-data">

          {{csrf_field()}}
          <div class="form-group">
            <label for="judul">Nama Program Studi</label>
            <select type="text" class="form-control" id="nama_prodi" name="id_prodi" required="">
              @foreach($prodi as $prodi)
              <option value="{{$prodi->id}}">{{$prodi->nama_prodi}}</option>
              @endforeach
            </select>
          </div>

          <div class="form-group">
            <label for="judul">Jenis Program</label>
            <select type="text" class="form-control" id="jenis_program" name="jenis_program" required="">
              <option >Diploma Tiga</option>
              <option>Sarjana</option>
              <option >Sarjana Terapan</option>
              <option >Magister</option>
              <option >Magister Terapan</option>
              <option >Doktor</option>
              <option >Doktor Terapan</option>
            </select>
          </div>

          <div class="form-group">
            <label for="judul">Peringkat Akreditasi Program Studi</label>
            <select type="text" class="form-control" id="peringkat_akreditasi" name="peringkat_akreditasi" required="">
              <option>Terakreditasi Unggul</option>
              <option >Terakreditasi A</option>
              <option >Terakreditasi Baik Sekali</option>
              <option >Terakreditasi B</option>
              <option >Terakreditasi Baik</option>
              <option >Terakreditasi C</option>
              <option >Terakreditasi Minimum</option>
            </select>
          </div>

          <div class="form-group">
            <label for="judul">Nomor SK BAN-PT</label>
            <input type="text" class="form-control" id="nomor_sk_banpt" name="nomor_sk_banpt" required="" />
          </div>

          <div class="form-group">
            <label for="judul">Tanggal Kadaluarsa</label>
            <input type="date" class="form-control" id="tanggal_kadaluarsa" name="tanggal_kadaluarsa" required="" />
          </div>

          <div class="form-group">
            <label for="judul">Nama Unit Pengelola</label>
            <input type="text" class="form-control" id="nama_unit_pengelola" name="nama_unit_pengelola" required="" />
          </div>

          <div class="form-group">
            <label for="judul">Nama Perguruan Tinggi</label>
            <input type="text" class="form-control" id="nama_perguruan_tinggi" name="nama_perguruan_tinggi" required="" />
          </div>

          <div class="form-group">
            <label for="judul">Alamat Perguruan Tinggi</label>
            <input type="text" class="form-control" id="alamat" name="alamat" required="" />
          </div>

          <div class="form-group">
            <label for="judul">Kota / Kabupaten</label>
            <input type="text" class="form-control" id="kabupaten" name="kabupaten" required="" />
          </div>

          <div class="form-group">
            <label for="judul">Kode Pos</label>
            <input type="text" class="form-control" id="kode_pos" name="kode_pos" required="" />
          </div>

          <div class="form-group">
            <label for="judul">Nomor Telepon</label>
            <input type="text" class="form-control" id="nomor_tlp" name="nomor_tlp" required="" />
          </div>

          <div class="form-group">
            <label for="judul">E-mail</label>
            <input type="text" class="form-control" id="email" name="email" required="" />
          </div>

          <div class="form-group">
            <label for="judul">Website</label>
            <input type="text" class="form-control" id="website" name="website" required="" />
          </div>
          <div class="form-group">
            <label for="judul">Tahun Akademik</label>
            <input type="number" class="form-control" id="tahun_akademik" name="tahun_akademik" required="" />
          </div>
          <div class="form-group">
            <label for="judul">Unggah File Laporan Evaluasi (opsional)</label>
            <input type="file" class="form-control" id="file_laporan_evaluasi" name="file_laporan_evaluasi" required="" />
          </div>

          <div class="form-group">
            <label for="judul">Link Laporan Evaluasi (opsional)</label>
            <input type="text" class="form-control" id="link_laporan_evaluasi" name="link_laporan_evaluasi" />
          </div>

          <div class="form-group">
            <label for="judul">Nama Pengusul</label>
            <input type="text" class="form-control" id="nama_pengusul" name="nama_pengusul" required="" />
          </div>

          <div class="form-group">
            <label for="judul">Tanggal Usulan</label>
            <input type="date" class="form-control" id="tanggal" name="tanggal" required="" />
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
<!-- end modal -->



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
          <label for="judul">Nama Program Studi</label>
          <input type="text" class="form-control" id="nama_prodi_update" name="nama_prodi" readonly="" required="" />
        </div>

        <div class="form-group">
          <label for="judul">Jenis Program</label>
          <input type="text" class="form-control" id="jenis_program_update" name="jenis_program" required="" />
        </div>

        <div class="form-group">
          <label for="judul">Peringkat Akreditasi Program Studi</label>
          <input type="text" class="form-control" id="peringkat_akreditasi_update" name="peringkat_akreditasi" required="" />
        </div>

        <div class="form-group">
          <label for="judul">Nomor SK BAN-PT</label>
          <input type="text" class="form-control" id="nomor_sk_banpt_update" name="nomor_sk_banpt" required="" />
        </div>

        <div class="form-group">
          <label for="judul">Tanggal Kadaluarsa</label>
          <input type="date" class="form-control" id="tanggal_kadaluarsa_update" name="tanggal_kadaluarsa" required="" />
        </div>

        <div class="form-group">
          <label for="judul">Nama Unit Pengelola</label>
          <input type="text" class="form-control" id="nama_unit_pengelola_update" name="nama_unit_pengelola" required="" />
        </div>

        <div class="form-group">
          <label for="judul">Nama Perguruan Tinggi</label>
          <input type="text" class="form-control" id="nama_perguruan_tinggi_update" name="nama_perguruan_tinggi" required="" />
        </div>

        <div class="form-group">
          <label for="judul">Alamat Perguruan Tinggi</label>
          <input type="text" class="form-control" id="alamat_update" name="alamat" required="" />
        </div>

        <div class="form-group">
          <label for="judul">Kota / Kabupaten</label>
          <input type="text" class="form-control" id="kabupaten_update" name="kabupaten" required="" />
        </div>

        <div class="form-group">
          <label for="judul">Kode Pos</label>
          <input type="text" class="form-control" id="kode_pos_update" name="kode_pos" required="" />
        </div>

        <div class="form-group">
          <label for="judul">Nomor Telepon</label>
          <input type="text" class="form-control" id="nomor_tlp_update" name="nomor_tlp" required="" />
        </div>

        <div class="form-group">
          <label for="judul">E-mail</label>
          <input type="text" class="form-control" id="email_update" name="email" required="" />
        </div>

        <div class="form-group">
          <label for="judul">Website</label>
          <input type="text" class="form-control" id="website_update" name="website" required="" />
        </div>
        <div class="form-group">
          <label for="judul">Tahun Akademik</label>
          <input type="number" class="form-control" id="tahun_akademik_update" name="tahun_akademik" required="" />
        </div>
        <div class="form-group">
          <label for="judul">Unggah File Laporan Evaluasi (opsional)</label>
          <input type="file" class="form-control" id="file_laporan_evaluasi" name="file_laporan_evaluasi" />
        </div>

        <div class="form-group">
          <label for="judul">Link Laporan Evaluasi (opsional)</label>
          <input type="text" class="form-control" id="link_laporan_evaluasi_update" name="link_laporan_evaluasi" />
        </div>

        <div class="form-group">
          <label for="judul">Nama Pengusul</label>
          <input type="text" class="form-control" id="nama_pengusul_update" name="nama_pengusul" required="" />
        </div>

        <div class="form-group">
          <label for="judul">Tanggal Usulan</label>
          <input type="date" class="form-control" id="tanggal_update" name="tanggal" required="" />
        </div>

        <div class="form-group">
          <input type="hidden" class="form-control" id="id_user" name="id_user" value="{{ Auth::user()->id }}" />
        </div>

        <div class="form-group">
          <input type="hidden" class="form-control" id="id_prodi" name="id_prodi" value="{{ Auth::user()->id_prodi }}" />
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
                    <p>Apakah anda yakin ingin Menghapus data LKPS ini ?</p>
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
        var url = '{{route("prodi_data_lkps_delete", ":id") }}';
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
      $('#nama_prodi_update').val(data[1]);
      $('#jenis_program_update').val(data[2]);
      $('#peringkat_akreditasi_update').val(data[3]);
      $('#nomor_sk_banpt_update').val(data[4]);
      $('#tanggal_kadaluarsa_update').val(data[5]);
      $('#nama_unit_pengelola_update').val(data[6]);
      $('#nama_perguruan_tinggi_update').val(data[7]);
      $('#alamat_update').val(data[8]);
      $('#kabupaten_update').val(data[9]);
      $('#kode_pos_update').val(data[10]);
      $('#nomor_tlp_update').val(data[11]);
      $('#email_update').val(data[12]);
      $('#website_update').val(data[13]);
      $('#tahun_akademik_update').val(data[14]);
      $('#link_laporan_evaluasi_update').val(data[16]);
      $('#nama_pengusul_update').val(data[17]);
      $('#tanggal_update').val(data[18]);
      $('#updatelkpsform').attr('action','prodi_data_lkps_update/'+ data[20]);
      $('#updateLkps').modal('show');
    });
  });
</script>



<script type="text/javascript">
    function print(elem) {
        var mywindow = window.open('', 'PRINT', 'height=1000,width=1200');

        mywindow.document.write('<html><head><link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">');
        mywindow.document.write('</head><body >');
        mywindow.document.write('<h1 class="text-center">' + 'Laporan Data LKPS' + '</h1>');
        mywindow.document.write('<br><br>');
        mywindow.document.write(document.getElementById(elem).innerHTML);
        mywindow.document.write('</body></html>');

    mywindow.document.close(); // necessary for IE >= 10
    mywindow.focus(); // necessary for IE >= 10*/

    mywindow.print(),2000;
    mywindow.close();
    // return true;
}
</script>   
@endsection