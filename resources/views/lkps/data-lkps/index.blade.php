@extends('layouts.lkps-master')

@section('title')
Data LKPS
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
        <h4>Data Laporan Kinerja Program Studi (LKPS)</h4>
      </div>
      <div class="card-body">
        
       <div class="text-right">
        <form class="form-inline">
          <div class="form-group mx-sm-1 mb-2">
            <!-- <label for="inputPassword2" class="sr-only">Password</label> -->

            <!-- Filter Prodi -->
            <div class="form-group">
              <select type="text" class="form-control" id="filter_prodi" name="filter_prodi" required="">
                <option selected disabled value=""> -- Pilih Program Studi -- </option>
                @foreach($prodi as $prodi)
                <option value="{{$prodi->id}}" @if($prodi->id == $prod) {{'selected="selected"'}} @endif>{{$prodi->nama_prodi}}</option>
                @endforeach
              </select>
            </div>
          </div>
          <button type="submit" class="btn btn-primary mb-2 fa fa-filter">Filter Prodi</button>

          <!-- filter tahun -->
          <div class="form-group mx-sm-1 mb-2">
            <!-- <label for="inputPassword2" class="sr-only">Password</label> -->
            <input type="text" class="form-control" id="filter" name="filter" placeholder="Tahun"  value="{{ old('filter') }}">
          </div>
          <button type="submit" class="btn btn-primary mb-2 fa fa-filter">Filter</button>

        </form><br>
        <button class="btn btn-success mb-2" onclick="print('printPDF', 'Title')">Cetak PDF</button>
      </div>

      
       <div id="printPDF">
      <div class="table-responsive">
        <table id="dataTable" class="table table-hover">
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
          </tr>
          @endforeach
            </tbody>
          </table>
        </div>
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
          1. TS (Tahun Akademik Penuh Terakhir saat Pengajuan usulan Akreditasi).
          <br>
          2. Unggah File dengan Format (rar/zip) dan Link Drive Laporan Evaluasi seperti : <br>
          a. Laporan Evauasi Kinerja Program Studi.<br>
          b. Laporan Evaluasi Diri.
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

<!-- --modal-- -->
<!-- <div class="modal fade" id="ModalTambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Laporan Kinerja Program Studi (LKPS)</h5>
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
        <form method="post" action="" enctype="multipart/form-data">

          {{csrf_field()}}
          <div class="form-group">
            <label for="judul">Nama Program Studi</label>
            <select type="text" class="form-control" id="nama_prodi" name="nama_prodi" required="">

            </select>
          </div>

          <div class="form-group">
            <label for="judul">Jenis Program</label>
            <select type="text" class="form-control" id="jenis_program" name="jenis_program" required="">

            </select>
          </div>

          <div class="form-group">
            <label for="judul">Peringkat Akreditasi Program Studi</label>
            <select type="text" class="form-control" id="peringkat_prodi" name="peringkat_prodi" required="">

            </select>
          </div>

          <div class="form-group">
            <label for="judul">Nomor SK BAN-PT</label>
            <input type="text" class="form-control" id="no_sk" name="no_sk" required="" />
          </div>

          <div class="form-group">
            <label for="judul">Tanggal Kadaluarsa</label>
            <input type="date" class="form-control" id="tgl_kadaluarsa" name="tgl_kadaluarsa" required="" />
          </div>

          <div class="form-group">
            <label for="judul">Nama Unit Pengelola</label>
            <input type="text" class="form-control" id="nama_pengelola" name="nama_pengelola" required="" />
          </div>

          <div class="form-group">
            <label for="judul">Nama Perguruan Tinggi</label>
            <input type="text" class="form-control" id="nama_pt" name="nama_pt" required="" />
          </div>

          <div class="form-group">
            <label for="judul">Alamat Perguruan Tinggi</label>
            <input type="text" class="form-control" id="alamat_pt" name="alamat_pt" required="" />
          </div>

          <div class="form-group">
            <label for="judul">Kota / Kabupaten</label>
            <input type="text" class="form-control" id="kab" name="kab" required="" />
          </div>

          <div class="form-group">
            <label for="judul">Kode Pos</label>
            <input type="text" class="form-control" id="kode_pos" name="kode_pos" required="" />
          </div>

          <div class="form-group">
            <label for="judul">Nomor Telepon</label>
            <input type="text" class="form-control" id="no_telp" name="no_telp" required="" />
          </div>

          <div class="form-group">
            <label for="judul">E-mail</label>
            <input type="text" class="form-control" id="email" name="email" required="" />
          </div>

          <div class="form-group">
            <label for="judul">Website</label>
            <input type="text" class="form-control" id="web" name="web" required="" />
          </div>

          <div class="form-group">
            <label for="judul">TS (Tahun Akademik)</label>
            <input type="text" class="form-control" id="th_akademik" name="th_akademik" required="" />
          </div>

          <div class="form-group">
            <label for="judul">Unggah File Laporan Evaluasi</label>
            <input type="file" class="form-control" id="file_laporan" name="file_laporan" required="" />
          </div>

          <div class="form-group">
            <label for="judul">Link Laporan Evaluasi (optional)</label>
            <input type="text" class="form-control" id="link_evaluasi" name="link_evaluasi" />
          </div>

          <div class="form-group">
            <label for="judul">Nama Pengusul</label>
            <input type="text" class="form-control" id="nama_pengusul" name="nama_pengusul" required="" />
          </div>

          <div class="form-group">
            <label for="judul">Tanggal Usulan</label>
            <input type="date" class="form-control" id="tgl_usulan" name="tgl_usulan" required="" />
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
</div> -->



@endsection
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