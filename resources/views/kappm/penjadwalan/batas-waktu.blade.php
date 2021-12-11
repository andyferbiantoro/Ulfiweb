@extends('layouts.kappm-master')

@section('title')
Batas Waktu LKPS
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
            <div class="card-header text-center">
                <h4>Batas Waktu Laporan Kinerja Program Studi</h4>
            </div>

            <!-- Button Untuk tambah Data dengan modal -->
            <div class="card-body">

                <form class="form-inline" method="post" action="{{route('kappm-batas_waktu_lkps_add')}}">
                    {{csrf_field()}}
                    <div class="form-group mx-sm-1 mb-2">
                        <!-- <label for="inputPassword2" class="sr-only">Password</label> -->
                        <select type="text" class="form-control" id="nama_prodi" name="id_prodi" required="">
                            <option selected disabled value=""> -- Pilih Program Studi -- </option>
                            @foreach($prodi as $prodi)
                            <option value="{{$prodi->id}}">{{$prodi->nama_prodi}}</option>
                            @endforeach
                        </select>

                        <input type="date" style="margin-left: 10px;" class="form-control" id="tanggal_awal" name="tanggal_awal" placeholder="Awal" value="">
                        <input type="date" style="margin-left: 10px;" class="form-control" id="tanggal_akhir" name="tanggal_akhir" placeholder="Akhir" value="">
                        <input type="text" style="margin-left: 10px;" class="form-control" id="tahun" name="tahun" placeholder="Tahun" value="">

                    </div>
                    <button type="submit" class="btn btn-primary mb-2">Tambah</button>
                </form><br><br>

                <div class="table-responsive">
                    <table id="dataTable" class="table table-hover">
                        <thead>
                            <tr>
                                <th style="text-align: center; vertical-align: middle;">No</th>
                                <th style="text-align: center; vertical-align: middle;">Program Studi</th>
                                <th style="text-align: center; vertical-align: middle;">Tanggal Awal</th>
                                <th style="text-align: center; vertical-align: middle;">Tanggal Akhir</th>
                                <th style="text-align: center; vertical-align: middle;">Tahun</th>
                                <th style="text-align: center; vertical-align: middle;">Aksi</th>
                                <th style="display: none;">hidden</th>
                                <th style="display: none;">hidden</th>
                                <th style="display: none;">hidden</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no=1 @endphp
                            @foreach($data_batas_waktu as $data)
                            <tr>
                                <td style="text-align: center; vertical-align: middle;">{{$no++}}</td>
                                <td style="text-align: center; vertical-align: middle;">{{$data->nama_prodi}}</td>
                                <td style="text-align: center; vertical-align: middle;">{{date("j F Y", strtotime($data->tanggal_awal))}}</td>
                                <td style="text-align: center; vertical-align: middle;">{{date("j F Y", strtotime($data->tanggal_akhir))}}</td>
                                <td style="text-align: center; vertical-align: middle;">{{$data->tahun}}</td>
                                <td>
                                    <button class="btn btn-success btn-sm fa fa-edit edit" title="Edit"></button>

                                    <a href="#" data-toggle="modal" onclick="deleteData({{$data->id}})" data-target="#DeleteModal">
                                        <button class="btn btn-danger btn-sm fa fa-trash" title="Hapus"></button>
                                    </a>
                                    @if($data->status == 1)
                                    <a href="#" data-toggle="modal" onclick="bukaAkses({{$data->id_prodi}})" data-target="#BukaAksesModal">
                                        <button class="btn btn-warning btn-sm fa fa-lock-open" title="Buka Pembatasan"></button>
                                    </a>
                                    @endif

                                    @if($data->status == 0 )
                                    <p style="color: green">Akses Edit Data telah diberikan</p>
                                    @endif

                                    
                                </td>
                                <td style="display: none;">{{$data->tanggal_awal}}</td>
                                <td style="display: none;">{{$data->tanggal_akhir}}</td>
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
                            <label for="judul">Tanggal Awal</label>
                            <input type="date" class="form-control" id="tanggal_awal_update" name="tanggal_awal" />
                        </div>

                        <div class="form-group">
                            <label for="judul">Tanggal Akhir</label>
                            <input type="date" class="form-control" id="tanggal_akhir_update" name="tanggal_akhir" />
                        </div>

                        <div class="form-group">
                            <label for="judul">Tahun</label>
                            <input type="text" class="form-control" id="tahun_update" name="tahun" />
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


    <div id="BukaAksesModal" class="modal fade" role="dialog">
        <div class="modal-dialog ">
            <!-- Modal content-->
            <form action="" id="bukaaksesForm" method="post">

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Buka Pembatasan pada Prodi ini ?</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        {{ csrf_field() }}
                        {{ method_field('POST') }}
                        <p>Apakah anda yakin ingin memberikan akses kembali ?</p>
                        <button type="button" class="btn btn-secondary float-right" data-dismiss="modal">Batal</button>
                        <button type="submit" name="" class="btn btn-warning float-right mr-2" data-dismiss="modal" onclick="formSubmit()">Buka Akses</button>
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
            var url = '{{route("kappm-batas_waktu_lkps_delete", ":id") }}';
            url = url.replace(':id', id);
            $("#deleteForm").attr('action', url);
        }

        function formSubmit() {
            $("#deleteForm").submit();
        }
    </script>


    <script type="text/javascript">
        function bukaAkses(id) {
            var id = id;
            var url = '{{route("kappm-batas_waktu_lkps_buka_akses", ":id_prodi") }}';
            url = url.replace(':id', id);
            $("#bukaaksesForm").attr('action', url);
        }

        function formSubmit() {
            $("#bukaaksesForm").submit();
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
                $('#tanggal_awal_update').val(data[6]);
                $('#tanggal_akhir_update').val(data[7]);
                $('#tahun_update').val(data[4]);
                $('#updateModalform').attr('action', 'kappm-batas_waktu_lkps_update/' + data[8]);
                $('#updateModal').modal('show');
            });
        });
    </script>

    @endsection