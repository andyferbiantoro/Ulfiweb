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
      <div class="card-header text-center">
        <h4 >Submit Data Laporan Kinerja Program Studi</h4>
      </div>

      <div class="row">
        <div class="col-lg-3"></div>
        <div class="col-lg-3">Mulai tanggal : {{date("j F Y", strtotime($batas_waktu->tanggal_awal))}}</div>
        <div class="col-lg-3">Sampai tanggal : {{date("j F Y", strtotime($batas_waktu->tanggal_akhir))}}</div>
        <div class="col-lg-3"></div>
      </div><br>

      <!-- Button Untuk tambah Data dengan modal -->
      <div class="card-body text-center">
        @if( $deadline )
        <button type="button" class="btn btn-primary btn-sm fa fa-check" data-toggle="modal" data-target="#submitModal">
          Submit Data LKPS
        </button>
        @endif

         @if( $deadline == null )
         
            <p style="color: red">Submit Data LKPS Sudah Melewati Deadline</p>
        
        @endif


<!-- Modal -->
<div class="modal fade" id="submitModals" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Submit Data Laporan Kinerja Program Studi ?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-primary">Submit</button>
      </div>
    </div>
  </div>
</div>


<div id="submitModal" class="modal fade" role="dialog">
    <div class="modal-dialog ">
        <!-- Modal content-->
        <form action="{{route('submit_lkps_prodi_proses')}}" id="submitForm" method="post">

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Submit Data Laporan Kinerja Program Studi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{ csrf_field() }}
                    {{ method_field('POST') }}
                    <p>Apakah anda yakin ingin Submit Data Laporan Kinerja Program Studi?</p>
                    <button type="button" class="btn btn-secondary float-right" data-dismiss="modal">Batal</button>
                    <button class="btn btn-primary" type="Submit">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div> 
        <!-- end button -->

        <!-- Tabel Data LKPS-->
       
</div>
<!-- end card -->

<!-- Untuk Mengatur Keterangan -->


@endsection

