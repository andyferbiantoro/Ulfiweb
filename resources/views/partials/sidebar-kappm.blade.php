<aside id="sidebar-wrapper">
    <div class="sidebar-brand">
        <a href="index.html">LKPS KAPPM</a>
    </div>
  
    <ul class="sidebar-menu">

        <li class="{{(request()->is('dashboard-kappm')) ? 'active' : ''}}"><a class="nav-link" href="{{ route('dashboard-kappm') }}"><i class="fas fa-home"></i><span>Beranda</span></a></li>

        <li class="{{(request()->is('kappm-pengumuman')) ? 'active' : ''}}"><a class="nav-link" href="{{ route('kappm-pengumuman') }}"><i class="fas fa-bullhorn"></i><span>Pengumuman</span></a></li>

        <li class="{{(request()->is('data_lkps')) ? 'active' : ''}}"><a class="nav-link" href="{{ route('data_lkps') }}"><i class="fas fa-clipboard"></i><span>Laporan Kinerja Program Studi</span></a></li>


        <li class="{{(request()->is('kappm-profil')) ? 'active' : ''}}"><a class="nav-link" href="{{ route('kappm-profil') }}"><i class="fas fa-user"></i><span>Kelola Akun</span></a></li>

        <li class="{{(request()->is('kappm-perjanjian_kinerja')) ? 'active' : ''}}"><a class="nav-link" href="{{ route('kappm-perjanjian_kinerja') }}"><i class="fas fa-file-contract"></i><span>Perjanjian Kinerja </span></a></li>

        <li class="{{(request()->is('kappm-hasil_penilaian_lkps')) ? 'active' : ''}}"><a class="nav-link" href="{{ route('kappm-hasil_penilaian_lkps') }}"><i class="fas fa-book"></i><span>Hasil Penilaian Laporan Kinerja Program Studi</span></a></li>
        
        <li class="{{(request()->is('kappm-batas_waktu_lkps')) ? 'active' : ''}}"><a class="nav-link" href="{{ route('kappm-batas_waktu_lkps') }}"><i class="fas fa-clock"></i><span>Batas Waktu LKPS</span></a></li>
        
        <li class="{{(request()->is('kappm-penunjukan_auditor')) ? 'active' : ''}}"><a class="nav-link" href="{{ route('kappm-penunjukan_auditor') }}"><i class="fas fa-users"></i><span>Penunjukan Auditor</span></a></li>
        
       
    </ul>
</aside>


