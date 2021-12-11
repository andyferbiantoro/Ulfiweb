@extends('layouts.lkps-prodi-master')

@section('title')
Data Penggunaan Dana
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
                <h4 style="margin-right: 48%;">Data Penggunaan Dana</h4>
                <div class=" text-right">
                    <button type="button" class="btn btn-success fa fa-plus" data-toggle="modal" data-target="#ModalTambah">
                        Tambah Data
                    </button>
                    <a href="{{route('prodi_lihat_penggunaan_dana')}}">
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
                                <th rowspan="2" style="text-align: center; vertical-align: middle;">Jenis Penggunaan</th>
                                <th colspan="3" style="text-align: center; vertical-align: middle;">Unit Pengelola Program Studi</th>
                                <th rowspan="2" style="text-align: center; vertical-align: middle;">Rata-rata pada Unit Pengelola Program Studi</th>
                                <th colspan="3" style="text-align: center; vertical-align: middle;">Program Studi</th>
                                <th rowspan="2" style="text-align: center; vertical-align: middle;">Rata-rata pada Program Studi</th>
                                <th rowspan="2" style="text-align: center; vertical-align: middle;">Tahun Akademik</th>
                                <th rowspan="2" style="text-align: center; vertical-align: middle;">File Bukti Dokumen</th>
                                <th rowspan="2" style="text-align: center; vertical-align: middle;">Link Bukti Dokumen</th>
                                <th rowspan="2" style="text-align: center; vertical-align: middle;">Aksi</th>
                                <th style="display: none;">id_hidden</th>
                            </tr>
                            <tr>
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
                            @foreach($data_penggunaan_dana as $data)
                            <tr>
                                <td style="text-align: center; vertical-align: middle;">{{$no++ }}</td>
                                <td style="text-align: center; vertical-align: middle;">{{$data->jenis_penggunaan }}</td>
                                <td style="text-align: center; vertical-align: middle;">{{$data->upps_ts2 }}</td>
                                <td style="text-align: center; vertical-align: middle;">{{$data->upps_ts1 }}</td>
                                <td style="text-align: center; vertical-align: middle;">{{$data->upps_ts }}</td>
                                <td style="text-align: center; vertical-align: middle;">{{$data->rata2_upps }}</td>
                                <td style="text-align: center; vertical-align: middle;">{{$data->prodi_ts2 }}</td>
                                <td style="text-align: center; vertical-align: middle;">{{$data->prodi_ts1 }}</td>
                                <td style="text-align: center; vertical-align: middle;">{{$data->prodi_ts }}</td>
                                <td style="text-align: center; vertical-align: middle;">{{$data->rata2_prodi }}</td>
                                <td style="text-align: center; vertical-align: middle;">{{$data->tahun_akademik }}</td>
                                <td style="text-align: center; vertical-align: middle;"><a href="{{route('prodi-file_download_dokumen_penggunaan_dana',$data->id)}}"><button class="btn btn-info ">Download</button></a></td>
                                <td style="text-align: center; vertical-align: middle;"><a href="{{$hasil->link_bukti_dokumen}}">{{$hasil->link_bukti_dokumen}}</a></td>
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
                                <th style="text-align: center; vertical-align: middle;">1</th>
                                <th style="text-align: center; vertical-align: middle;">1</th>
                                <th style="text-align: center; vertical-align: middle;">1</th>
                                <th style="text-align: center; vertical-align: middle;">1</th>
                                <th colspan="5" style="text-align: center; vertical-align: middle;"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="text-align: center; vertical-align: middle;">{{$no++ }}</td>
                                <td style="text-align: center; vertical-align: middle;">{{$data->jenis_penggunaan }}</td>
                                <td style="text-align: center; vertical-align: middle;">{{$data->upps_ts2 }}</td>
                                <td style="text-align: center; vertical-align: middle;">{{$data->upps_ts1 }}</td>
                                <td style="text-align: center; vertical-align: middle;">{{$data->upps_ts }}</td>
                                <td style="text-align: center; vertical-align: middle;">{{$data->rata2_upps }}</td>
                                <td style="text-align: center; vertical-align: middle;">{{$data->prodi_ts2 }}</td>
                                <td style="text-align: center; vertical-align: middle;">{{$data->prodi_ts1 }}</td>
                                <td style="text-align: center; vertical-align: middle;">{{$data->prodi_ts }}</td>
                                <td style="text-align: center; vertical-align: middle;">{{$data->rata2_prodi }}</td>
                                <td style="text-align: center; vertical-align: middle;">{{$data->tahun_akademik }}</td>
                                <td style="text-align: center; vertical-align: middle;"><a href="{{route('prodi-file_download_dokumen_penggunaan_dana',$data->id)}}"><button class="btn btn-info ">Download</button></a></td>
                                <td style="text-align: center; vertical-align: middle;"><a href="{{$hasil->link_bukti_dokumen}}">{{$hasil->link_bukti_dokumen}}</a></td>
                                <td>
                                    <!-- <a href="">
                                        <button class="btn-sm btn btn-warning fa fa-eye" title="Lihat"></button>
                                    </a> -->
                                    <button class="btn btn-success btn-sm fa fa-edit edit" title="Edit"></button>

                                    <a href="#" data-toggle="modal" onclick="deleteData({{$data->id}})" data-target="#DeleteModal">
                                        <button class="btn btn-danger btn-sm fa fa-trash" title="Hapus"></button>
                                    </a>
                                </td>
                                <td style="display: none;">{{$data->id}}</td>
                            </tr>
                        </tbody>
                        <thead>
                            <tr>
                                <th colspan="2" style="text-align: center; vertical-align: middle;">Jumlah</th>
                                <th style="text-align: center; vertical-align: middle;">1</th>
                                <th style="text-align: center; vertical-align: middle;">1</th>
                                <th style="text-align: center; vertical-align: middle;">1</th>
                                <th style="text-align: center; vertical-align: middle;">1</th>
                                <th style="text-align: center; vertical-align: middle;">1</th>
                                <th style="text-align: center; vertical-align: middle;">1</th>
                                <th style="text-align: center; vertical-align: middle;">1</th>
                                <th style="text-align: center; vertical-align: middle;">1</th>
                                <th colspan="5" style="text-align: center; vertical-align: middle;"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="text-align: center; vertical-align: middle;">{{$no++ }}</td>
                                <td style="text-align: center; vertical-align: middle;">{{$data->jenis_penggunaan }}</td>
                                <td style="text-align: center; vertical-align: middle;">{{$data->upps_ts2 }}</td>
                                <td style="text-align: center; vertical-align: middle;">{{$data->upps_ts1 }}</td>
                                <td style="text-align: center; vertical-align: middle;">{{$data->upps_ts }}</td>
                                <td style="text-align: center; vertical-align: middle;">{{$data->rata2_upps }}</td>
                                <td style="text-align: center; vertical-align: middle;">{{$data->prodi_ts2 }}</td>
                                <td style="text-align: center; vertical-align: middle;">{{$data->prodi_ts1 }}</td>
                                <td style="text-align: center; vertical-align: middle;">{{$data->prodi_ts }}</td>
                                <td style="text-align: center; vertical-align: middle;">{{$data->rata2_prodi }}</td>
                                <td style="text-align: center; vertical-align: middle;">{{$data->tahun_akademik }}</td>
                                <td style="text-align: center; vertical-align: middle;"><a href="{{route('prodi-file_download_dokumen_penggunaan_dana',$data->id)}}"><button class="btn btn-info ">Download</button></a></td>
                                <td style="text-align: center; vertical-align: middle;">{{$data->link_bukti_dokumen }}</td>
                                <td>
                                    <!-- <a href="">
                                        <button class="btn-sm btn btn-warning fa fa-eye" title="Lihat"></button>
                                    </a> -->
                                    <button class="btn btn-success btn-sm fa fa-edit edit" title="Edit"></button>

                                    <a href="#" data-toggle="modal" onclick="deleteData({{$data->id}})" data-target="#DeleteModal">
                                        <button class="btn btn-danger btn-sm fa fa-trash" title="Hapus"></button>
                                    </a>
                                </td>
                                <td style="display: none;">{{$data->id}}</td>
                            </tr>
                        </tbody>
                        <thead>
                            <tr>
                                <th colspan="2" style="text-align: center; vertical-align: middle;">Jumlah</th>
                                <th style="text-align: center; vertical-align: middle;">1</th>
                                <th style="text-align: center; vertical-align: middle;">1</th>
                                <th style="text-align: center; vertical-align: middle;">1</th>
                                <th style="text-align: center; vertical-align: middle;">1</th>
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
                    1. Data penggunaan dana yang dikelola oleh Unit Pengelola Program Studi (UPPS) dan data penggunaan dana yang dialokasikan ke Program Studi yang diakreditasi dalam 3 tahun terakhir.<br>
                    2. Tahun Akademik merupakan Tahun Akademik n tahun sebelum TS (TS-n) atau tahun akademik penuh terakhir saat Pengajuan usulan Akreditasi (TS).<br>
                    3. Unggah file dengan format (rar/zip) dan Link Drive bukti dokumen dalam 3 tahun terakhir yang terkait mengenai penggunaan dana
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
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Penggunaan Dana</h5>

            </div>
            <div class="modal-body">
                <form method="post" action="{{route('prodi_penggunaan_dana_add')}}" enctype="multipart/form-data">

                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="judul">Jenis Penggunaan</label>
                        <select type="text" class="form-control" id="jenis_penggunaan" name="jenis_penggunaan">
                            <option>Biaya Operasional</option>
                            <option>DLL (Dibuat Otomatis)</option>

                        </select>
                    </div>

                    <div class="form-group">
                        <label for="judul">Unit Pengelola Program Studi</label>
                        <input type="text" class="form-control" id="upps_ts2" name="upps_ts2" required="" placeholder="TS-2" /><br>
                        <input type="text" class="form-control" id="upps_ts1" name="upps_ts1" required="" placeholder="TS-1" /><br>
                        <input type="text" class="form-control" id="upps_ts" name="upps_ts" required="" placeholder="TS" />

                    </div>

                    <div class="form-group">
                        <label for="judul">Program Studi</label>
                        <input type="text" class="form-control" id="prodi_ts2" name="prodi_ts2" required="" placeholder="TS-2" /><br>
                        <input type="text" class="form-control" id="prodi_ts1" name="prodi_ts1" required="" placeholder="TS-1" /><br>
                        <input type="text" class="form-control" id="prodi_ts" name="prodi_ts" required="" placeholder="TS" />

                    </div>

                    <div class="form-group">
                        <label for="judul">Tahun Akademik</label>
                        <input type="text" class="form-control" id="tahun_akademik" name="tahun_akademik" required="" placeholder="2020/2021" />
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
                    <h5 class="modal-title">Anda yakin ingin memperbarui Data ini ?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{ csrf_field() }}
                    {{ method_field('POST') }}

                    <div class="form-group">
                        <label for="judul">Jenis Penggunaan</label>
                        <select type="text" class="form-control" id="jenis_penggunaan_update" name="jenis_penggunaan">
                            <option>Biaya Operasional</option>
                            <option>DLL (Dibuat Otomatis)</option>

                        </select>
                    </div>

                    <div class="form-group">
                        <label for="judul">Unit Pengelola Program Studi</label>
                        <input type="text" class="form-control" id="upps_ts2_update" name="upps_ts2" required="" placeholder="TS-2" /><br>
                        <input type="text" class="form-control" id="upps_ts1_update" name="upps_ts1" required="" placeholder="TS-1" /><br>
                        <input type="text" class="form-control" id="upps_ts_update" name="upps_ts" required="" placeholder="TS" />

                    </div>

                    <div class="form-group">
                        <label for="judul">Program Studi</label>
                        <input type="text" class="form-control" id="prodi_ts2_update" name="prodi_ts2" required="" placeholder="TS-2" /><br>
                        <input type="text" class="form-control" id="prodi_ts1_update" name="prodi_ts1" required="" placeholder="TS-1" /><br>
                        <input type="text" class="form-control" id="prodi_ts_update" name="prodi_ts" required="" placeholder="TS" />

                    </div>

                    <div class="form-group">
                        <label for="judul">Tahun Akademik</label>
                        <input type="text" class="form-control" id="tahun_akademik_update" name="tahun_akademik" required="" placeholder="2020/2021" />
                    </div>

                    <div class="form-group">
                        <label for="judul">Unggah File Bukti Dokumen (opsional)</label>
                        <input type="file" class="form-control" id="file_bukti_dokumen" name="file_bukti_dokumen" />
                    </div>

                    <div class="form-group">
                        <label for="judul">Link Bukti Dokumen (opsional)</label>
                        <input type="text" class="form-control" id="link_bukti_dokumen_update" name="link_bukti_dokumen" />
                    </div>

                    <button type="button" class="btn btn-secondary float-right" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary float-right mr-2">Perbarui</button>
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
        var url = '{{route("prodi_penggunaan_dana_delete", ":id") }}';
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
            $('#jenis_penggunaan_update').val(data[1]);
            $('#upps_ts2_update').val(data[2]);
            $('#upps_ts1_update').val(data[3]);
            $('#upps_ts_update').val(data[4]);
            $('#prodi_ts2_update').val(data[6]);
            $('#prodi_ts1_update').val(data[7]);
            $('#prodi_ts_update').val(data[8]);
            $('#tahun_akademik_update').val(data[10]);
            $('#link_bukti_dokumen_update').val(data[12]);
            $('#updateModalform').attr('action', 'prodi_penggunaan_dana_update/' + data[14]);
            $('#updateModal').modal('show');
        });
    });
</script>

@endsection