@extends('layouts.lkps-prodi-master')

@section('title')
Daftar Program Studi di UPPS
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
      <h4 style="margin-right: 53%;">Data Daftar Program Studi di UPPS</h4>
      <div class="text-right">
        <button type="button" class="btn btn-success fa fa-plus" data-toggle="modal" data-target="#ModalTambah">
          Tambah Data
        </button>

      </div>
    </div>

    <div class="card-body">
      <div class="text-right">
        <form class="form-inline" action="{{route('prodi_daftar_program_studi_upps')}}" method="GET">
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
              <th style="text-align: center; vertical-align: middle;">Jenis Program</th>
              <th style="text-align: center; vertical-align: middle;">Nama Program Studi</th>
              <th style="text-align: center; vertical-align: middle;">Status/Peringkat</th>
              <th style="text-align: center; vertical-align: middle;">Nomor & Tanggal SK</th>
              <th style="text-align: center; vertical-align: middle;">Tanggal Kadaluarsa</th>
              <th style="text-align: center; vertical-align: middle;">Jumlah Mahasiswa Saat TS</th>
              <th style="text-align: center; vertical-align: middle;">File Bukti Salinan Surat Keputusan</th>
              <th style="text-align: center; vertical-align: middle;">Link Bukti Salinan Surat Keputusan</th>
              <th style="text-align: center; vertical-align: middle;">Tahun</th>
              <th style="text-align: center; vertical-align: middle;">Aksi</th>
              <th style="display: none;">id_hidden</th>
            </tr>
          </thead>
          <tbody>
            @php $no=1 @endphp
            @foreach($daftar_prodi_upps as $data)
            <tr>
              <td>{{$no++ }}</td>
              <td>{{$data->jenis_program }}</td>
              <td>{{$data->nama_prodi }}</td>
              <td>{{$data->peringkat_akreditasi }}</td>
              <td>{{$data->nomor_tanggal_sk }}</td>
              <td>{{$data->tanggal_kadaluarsa }}</td>
              <td>{{$data->jumlah_mahasiswa }}</td>
              <td><a href="{{route('prodi-file_download_upps',$data->id)}}"><button class="btn btn-info ">Download</button></a></td>
              <td><a href="{{$data->link_surat_keputusan}}">{{$data->link_surat_keputusan}}</a></td>
              <td>{{$data->tahun }}</td>
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
        <b>Keterangan : </b><br>
        <p style="font-size: 10px;">
          1. Jumlah Mahasiswa saat TS merupakan Jumlah Mahasiswa Aktif di masing-masing Program Studi Saat TS (Tahun Akademik
          Penuh Terakhir saat Pengajuan usulan Akreditasi).
          <br>
          2. Unggah File dengan Format (rar/zip) dan Link Drive Salinan Surat Keputusan seperti : <br>
          a. Salinan Surat Keputusan Pendirian Perguruan Tinggi. <br>
          b. Salinan Surat Keputusan Pembukaan Program Studi. <br>
          c. Salinan Surat Keputusan Akreditasi Program Studi Terbaru.
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


<div class="modal fade" id="ModalTambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Daftar Program Studi di UPPS</h5>

      </div>
      <div class="modal-body">
        <form method="post" action="{{route('prodi_daftar_program_studi_upps_add')}}" enctype="multipart/form-data">

          {{csrf_field()}}
          <div class="form-group">
            <label for="judul">Jenis Program</label>
            <select type="text" class="form-control" id="jenis_program" name="jenis_program" required="">
              <option>Diploma Tiga</option>
              <option>Sarjana</option>
              <option>Sarjana Terapan</option>
              <option>Magister</option>
              <option>Magister Terapan</option>
              <option>Doktor</option>
              <option>Doktor Terapan</option>
            </select>
          </div>

          <div class="form-group">
            <label for="judul">Nama Program Studi</label>
            <select type="text" class="form-control" id="id_prodi" name="id_prodi" required="">
              @foreach($prodi as $prodi)
              <option value="{{$prodi->id}}">{{$prodi->nama_prodi}}</option>
              @endforeach
            </select>
          </div>


          <div class="form-group">
            <label for="judul">Status / Peringkat</label>
            <select type="text" class="form-control" id="peringkat_akreditasi" name="peringkat_akreditasi" required="">
              <option >Terakreditasi Unggul</option>
              <option >Terakreditasi A</option>
              <option >Terakreditasi Baik Sekali</option>
              <option >Terakreditasi B</option>
              <option >Terakreditasi Baik</option>
              <option >Terakreditasi C</option>
              <option >Terakreditasi Minimum</option>
            </select>
          </div>

          <div class="form-group">
            <label for="judul">Nomor & Tanggal SK</label>
            <input type="text" class="form-control" id="nomor_tanggal_sk" name="nomor_tanggal_sk" required="" />
          </div>

          <div class="form-group">
            <label for="judul">Tanggal Kadaluarsa</label>
            <input type="date" class="form-control" id="tanggal_kadaluarsa" name="tanggal_kadaluarsa" required="" />
          </div>

          <div class="form-group">
            <label for="judul">Jumlah Mahasiswa Saat TS</label>
            <input type="text" class="form-control" id="jumlah_mahasiswa" name="jumlah_mahasiswa" required="" />
          </div>

          <div class="form-group">
            <label for="judul">Unggah File Salinan Surat Keputusan (opsional)</label>
            <input type="file" class="form-control" id="file_surat_keputusan" name="file_surat_keputusan" />
          </div>

          <div class="form-group">
            <label for="judul">Link Salinan Surat Keputusan (opsional)</label>
            <input type="text" class="form-control" id="link_surat_keputusan" name="link_surat_keputusan" />
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


<div id="updateUpps" class="modal fade" role="dialog">
  <div class="modal-dialog ">
   <!--Modal content-->
   <form action="" id="updateuppsform" method="post" enctype="multipart/form-data">
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
          <label for="judul">Nomor & Tanggal SK</label>
          <input type="text" class="form-control" id="nomor_tanggal_sk_update" name="nomor_tanggal_sk" required="" />
        </div>

        <div class="form-group">
          <label for="judul">Tanggal Kadaluarsa</label>
          <input type="date" class="form-control" id="tanggal_kadaluarsa_update" name="tanggal_kadaluarsa" required="" />
        </div>

        <div class="form-group">
          <label for="judul">Jumlah Mahasiswa Saat TS</label>
          <input type="text" class="form-control" id="jumlah_mahasiswa_update" name="jumlah_mahasiswa" required="" />
        </div>

        <div class="form-group">
          <label for="judul">Unggah File Salinan Surat Keputusan (opsional)</label>
          <input type="file" class="form-control" id="file_surat_keputusan" name="file_surat_keputusan" />
        </div>

        <div class="form-group">
          <label for="judul">Link Salinan Surat Keputusan (opsional)</label>
          <input type="text" class="form-control" id="link_surat_keputusan_update" name="link_surat_keputusan" />
        </div>

        <div class="form-group">
          <label for="judul">Tahun</label>
          <input type="text" class="form-control" id="tahun_update" name="tahun" required="" />
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
                    <p>Apakah anda yakin ingin Menghapus data Prodi Diupps ini ?</p>
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
    var url = '{{route("prodi_daftar_program_studi_upps_delete", ":id") }}';
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
      $('#nomor_tanggal_sk_update').val(data[4]);
      $('#tanggal_kadaluarsa_update').val(data[5]);
      $('#jumlah_mahasiswa_update').val(data[6]);
      $('#link_surat_keputusan_update').val(data[8]);
      $('#tahun_update').val(data[9]);
      $('#updateuppsform').attr('action','prodi_daftar_program_studi_upps_update/'+ data[11]);
      $('#updateUpps').modal('show');
    });
  });
</script>

@endsection