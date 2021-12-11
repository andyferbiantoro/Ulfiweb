@extends('layouts.lkps-master')

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
                <h4 style="margin-right: 63%;">Data Mahasiswa Asing</h4>
                <div class="text-right">
                    <a href="{{route('lihat_mahasiswa_mahasiswa_asing')}}">
                        <button type="button" class="btn btn-primary fa fa-book">
                            Lihat Laporan
                        </button></a>
                </div>
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
                      <input type="text" class="form-control" id="filter" name="filter" placeholder="Tahun Akademik"  value="{{ old('filter') }}">
                  </div>
                  <button type="submit" class="btn btn-primary mb-2 fa fa-filter">Filter</button>

              </form><br>
              </div>

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



@endsection