<aside id="sidebar-wrapper">
    <div class="sidebar-brand">
        <a href="index.html">LKPS prodi</a>
    </div>
  <!--   <div class="sidebar-brand sidebar-brand-sm">
        <a href="index.html">LKPS prodi</a>
    </div> -->
    <ul class="sidebar-menu">
        <li class="{{(request()->is('dashboard-prodi')) ? 'active' : ''}}"><a class="nav-link" href="{{ route('dashboard-prodi') }}"><i class="fas fa-home"></i><span>Beranda</span></a></li>

       <li class="{{(request()->is('prodi-pengumuman')) ? 'active' : ''}}"><a class="nav-link" href="{{ route('prodi-pengumuman') }}"><i class="fas fa-bullhorn"></i><span>Pengumuman</span></a></li>

        <li class="{{(request()->is('prodi_data_lkps')) ? 'active' : ''}}"><a class="nav-link" href="{{ route('prodi_data_lkps') }}"><i class="fas fa-clipboard"></i><span>Laporan Kinerja Program Studi</span></a></li>

        <li class="{{(request()->is('prodi-profil')) ? 'active' : ''}}"><a class="nav-link" href="{{ route('prodi-profil') }}"><i class="fas fa-user"></i><span>Kelola Akun</span></a></li>

       <li class="{{(request()->is('prodi-perjanjian_kinerja')) ? 'active' : ''}}"><a class="nav-link" href="{{ route('prodi-perjanjian_kinerja') }}"><i class="fas fa-file-contract"></i><span>Perjanjian Kinerja </span></a></li>

       <li class="{{(request()->is('prodi-hasil_penilaian_lkps')) ? 'active' : ''}}"><a class="nav-link" href="{{ route('prodi-hasil_penilaian_lkps') }}"><i class="fas fa-book"></i><span>Hasil Penilaian Laporan Kinerja Program Studi</span></a></li>
    </ul>
</aside>


