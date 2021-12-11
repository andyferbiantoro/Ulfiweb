<style type="text/css">
    /* ============ desktop view ============ */
    @media all and (min-width: 992px) {

        .dropdown-menu li {
            position: relative;
        }

        .dropdown-menu .submenu {
            display: none;
            position: absolute;
            left: 100%;
            top: -7px;
        }

        .dropdown-menu .submenu-left {
            right: 100%;
            left: auto;
        }

        .dropdown-menu>li:hover {
            background-color: #f1f1f1
        }

        .dropdown-menu>li:hover>.submenu {
            display: block;
        }
    }

    /* ============ desktop view .end// ============ */

    /* ============ small devices ============ */
    @media (max-width: 991px) {

        .dropdown-menu .dropdown-menu {
            margin-left: 0.7rem;
            margin-right: 0.7rem;
            margin-bottom: .5rem;
        }

    }

    /* ============ small devices .end// ============ */
</style>


<script type="text/javascript">
    //	window.addEventListener("resize", function() {
    //		"use strict"; window.location.reload(); 
    //	});


    document.addEventListener("DOMContentLoaded", function() {


        /////// Prevent closing from click inside dropdown
        document.querySelectorAll('.dropdown-menu').forEach(function(element) {
            element.addEventListener('click', function(e) {
                e.stopPropagation();
            });
        })



        // make it as accordion for smaller screens
        if (window.innerWidth < 992) {

            // close all inner dropdowns when parent is closed
            document.querySelectorAll('.navbar .dropdown').forEach(function(everydropdown) {
                everydropdown.addEventListener('hidden.bs.dropdown', function() {
                    // after dropdown is hidden, then find all submenus
                    this.querySelectorAll('.submenu').forEach(function(everysubmenu) {
                        // hide every submenu as well
                        everysubmenu.style.display = 'none';
                    });
                })
            });

            document.querySelectorAll('.dropdown-menu a').forEach(function(element) {
                element.addEventListener('click', function(e) {

                    let nextEl = this.nextElementSibling;
                    if (nextEl && nextEl.classList.contains('submenu')) {
                        // prevent opening link if link needs to open dropdown
                        e.preventDefault();
                        console.log(nextEl);
                        if (nextEl.style.display == 'block') {
                            nextEl.style.display = 'none';
                        } else {
                            nextEl.style.display = 'block';
                        }

                    }
                });
            })
        }
        // end if innerWidth

    });
    // DOMContentLoaded  end
</script>



<aside id="sidebar-wrapper">
    <div class="sidebar-brand">
        <a href="index.html">LKPS</a>
    </div>

    <ul class="sidebar-menu">
        @if(Auth::user()->role == 'kappm')
        <li class="{{(request()->is('dashboard-kappm')) ? 'active' : ''}}"><a class="nav-link" href="{{ route('dashboard-kappm') }}"><i class="fas fa-home"></i><span>Beranda</span></a></li>
        @endif

        @if(Auth::user()->role == 'prodi')
        <li class="{{(request()->is('dashboard-prodi')) ? 'active' : ''}}"><a class="nav-link" href="{{ route('dashboard-prodi') }}"><i class="fas fa-home"></i><span>Beranda</span></a></li>
        @endif

        @if(Auth::user()->role == 'auditor')
        <li class="{{(request()->is('dashboard-auditor')) ? 'active' : ''}}"><a class="nav-link" href="{{ route('dashboard-auditor') }}"><i class="fas fa-home"></i><span>Beranda</span></a></li>
        @endif

        <li class="{{(request()->is('data_lkps')) ? 'active' : ''}}"><a class="nav-link" href="{{ route('data_lkps') }}"><i class="fas fa-caret-right"></i><span>Data LKPS</span></a></li>

        <li class="{{(request()->is('daftar_program_studi_upps')) ? 'active' : ''}}"><a class="nav-link" href="{{ route('daftar_program_studi_upps') }}"><i class="fas fa-caret-right"></i><span>Daftar Program Studi di UPPS</span></a></li>



        <li class="">
            <a href="{{(request()->is('kerja_sama_tridharma_pendidikan')) ? 'active' : ''}}" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-caret-right"></i>
                <span>Kerja Sama Tridharma</span></a>
            <ul class="dropdown-menu">
                <li class="{{(request()->is('kerja_sama_tridharma_pendidikan')) ? 'active' : ''}}"><a class="nav-link" href="{{ route('kerja_sama_tridharma_pendidikan') }}"><i class="fas fa-circle"></i><span>Pendidikan</span></a></li>

                <li class="{{(request()->is('kerja_sama_tridharma_penelitian')) ? 'active' : ''}}"><a class="nav-link" href="{{ route('kerja_sama_tridharma_penelitian') }}"><i class="fas fa-circle"></i><span>Penelitian</span></a></li><br>

                <li class="{{(request()->is('kerja_sama_tridharma_pengabdian_kepada_masyarakat')) ? 'active' : ''}}"><a class="nav-link" href="{{ route('kerja_sama_tridharma_pengabdian_kepada_masyarakat') }}"><i class="fas fa-circle"></i><span>Pengabdian Kepada Masyarakat</span></a></li><br>
            </ul>
        </li>

        <li class="">
            <a href="{{(request()->is('mahasiswa_seleksi_mahasiswa_baru')) ? 'active' : ''}}" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-caret-right"></i>
                <span>Mahasiswa</span></a>
            <ul class="dropdown-menu">
                <li class="{{(request()->is('mahasiswa_seleksi_mahasiswa_baru')) ? 'active' : ''}}"><a class="nav-link" href="{{ route('mahasiswa_seleksi_mahasiswa_baru') }}"><i class="fas fa-circle"></i>Seleksi Mahasiswa Baru</a></li><br>
                <li class="{{(request()->is('mahasiswa_mahasiswa_asing')) ? 'active' : ''}}"><a class="nav-link" href="{{ route('mahasiswa_mahasiswa_asing') }}"><i class="fas fa-circle"></i>Mahasiswa Asing</a></li>
            </ul>
        </li>

        <li class="">
            <a href="{{(request()->is('profil_dosen_dosen_tetap_perguruan_tinggi')) ? 'active' : ''}}" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-caret-right"></i>
                <span>Profil Dosen</span></a>
            <ul class="dropdown-menu">
                <li class="{{(request()->is('profil_dosen_dosen_tetap_perguruan_tinggi')) ? 'active' : ''}}"><a class="nav-link" href="{{ route('profil_dosen_dosen_tetap_perguruan_tinggi') }}"><i class="fas fa-circle"></i><span>Dosen Tetap Perguruan Tinggi</span></a></li><br>
                <li class="{{(request()->is('profil_dosen_dosen_pembimbing_utama_tugas_akhir')) ? 'active' : ''}}"><a class="nav-link" href="{{ route('profil_dosen_dosen_pembimbing_utama_tugas_akhir') }}"><i class="fas fa-circle"></i><span>Dosen Pembimbing Utama Tugas Akhir</span></a></li><br><br>
                <li class="{{(request()->is('profil_dosen_ewmp_dosen_tetap_perguruan_tinggi')) ? 'active' : ''}}"><a class="nav-link" href="{{ route('profil_dosen_ewmp_dosen_tetap_perguruan_tinggi') }}"><i class="fas fa-circle"></i><span>EWMP Dosen Tetap Perguruan Tinggi</span></a></li> <br><br>
                <li class="{{(request()->is('profil_dosen_dosen_tidak_tetap')) ? 'active' : ''}}"><a class="nav-link" href="{{ route('profil_dosen_dosen_tidak_tetap') }}"><i class="fas fa-circle"></i><span>Dosen Tidak Tetap</span></a></li><br>
                <li class="{{(request()->is('profil_dosen_dosen_industri_praktisi')) ? 'active' : ''}}"><a class="nav-link" href="{{ route('profil_dosen_dosen_industri_praktisi') }}"><i class="fas fa-circle"></i><span>Dosen Industri/Praktisi</span></a></li><br>

            </ul>
        </li>

        <li class="">
            <a href="{{(request()->is('kinerja_dosen_pengakuan_rekognisi_dtps')) ? 'active' : ''}}" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-caret-right"></i>
                <span>Kinerja Dosen</span></a>
            <ul class="dropdown-menu">
                <li class="{{(request()->is('kinerja_dosen_pengakuan_rekognisi_dtps')) ? 'active' : ''}}"><a class="nav-link" href="{{ route('kinerja_dosen_pengakuan_rekognisi_dtps') }}"><i class="fas fa-circle"></i><span>Pengakuan/Rekognisi DTPS</span></a></li><br>
                <li class="{{(request()->is('kinerja_dosen_penelitian_dtps')) ? 'active' : ''}}"><a class="nav-link" href="{{ route('kinerja_dosen_penelitian_dtps') }}"><i class="fas fa-circle"></i><span>Penelitian DTPS</span></a></li><br>
                <li class="{{(request()->is('kinerja_dosen_pengabdian_kepada_masyarakat_dtps')) ? 'active' : ''}}"><a class="nav-link" href="{{ route('kinerja_dosen_pengabdian_kepada_masyarakat_dtps') }}"><i class="fas fa-circle"></i><span>Pengabdian Kepada Masyarakat DTPS</span></a></li><br><br>
                <li class="{{(request()->is('kinerja_dosen_pagelaran_pameran_prestasi_publikasi_ilmiah_dtps')) ? 'active' : ''}}"><a class="nav-link" href="{{ route('kinerja_dosen_pagelaran_pameran_prestasi_publikasi_ilmiah_dtps') }}"><i class="fas fa-circle"></i><span>Pagelaran/Pameran/ Prestasi/Publikasi Ilmiah DTPS</span></a></li><br>
                <li class="{{(request()->is('kinerja_dosen_karya_ilmiah_dtps_yang_disitasi')) ? 'active' : ''}}"><a class="nav-link" href="{{ route('kinerja_dosen_karya_ilmiah_dtps_yang_disitasi') }}"><i class="fas fa-circle"></i><span>Karya Ilmiah DTPS yang D isitasi</span></a></li><br><br>
                <li class="{{(request()->is('kinerja_dosen_produk_jasa_dtps_diadopsi_oleh_industri_masyarakat')) ? 'active' : ''}}"><a class="nav-link" href="{{ route('kinerja_dosen_produk_jasa_dtps_diadopsi_oleh_industri_masyarakat') }}"><i class="fas fa-circle"></i><span>Produk/Jasa DTPS yang Diapdosi oleh Industri/Masyarakat</span></a></li><br><br>
                <li class="{{(request()->is('kinerja_dosen_hki_paten')) ? 'active' : ''}}"><a class="nav-link" href="{{ route('kinerja_dosen_hki_paten') }}"><i class="fas fa-circle"></i><span>HKI (Paten, Paten Sederhana)</span></a></li><br><br>
                <li class="{{(request()->is('kinerja_dosen_hki_hak_cipta')) ? 'active' : ''}}"><a class="nav-link" href="{{ route('kinerja_dosen_hki_hak_cipta') }}"><i class="fas fa-circle"></i><span>HKI (Hak Cipta, Desain Produk Industri) </span></a></li><br><br>
                <li class="{{(request()->is('kinerja_dosen_teknologi_tepat_guna')) ? 'active' : ''}}"><a class="nav-link" href="{{ route('kinerja_dosen_teknologi_tepat_guna') }}"><i class="fas fa-circle"></i><span>Teknologi Tepat Guna, Produk, Karya Seni, Rekayasa Sosial</span></a></li><br><br>
                <li class="{{(request()->is('kinerja_dosen_buku_berisbn')) ? 'active' : ''}}"><a class="nav-link" href="{{ route('kinerja_dosen_buku_berisbn') }}"><i class="fas fa-circle"></i><span>Buku ber-ISBN, Book Chapter</span></a></li><br><br>
            </ul>

        </li>

        <li class="{{(request()->is('penggunaan_dana')) ? 'active' : ''}}"><a class="nav-link" href="{{ route('penggunaan_dana') }}"><i class="fas fa-caret-right"></i><span>Penggunaan Dana</span></a></li>

        <li class="">
            <a href="{{(request()->is('pendidikan_kurikulum')) ? 'active' : ''}}" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-caret-right"></i>
                <span>Pendidikan</span></a>
            <ul class="dropdown-menu">
                <li class="{{(request()->is('pendidikan_kurikulum')) ? 'active' : ''}}"><a class="nav-link" href="{{ route('pendidikan_kurikulum') }}"><i class="fas fa-circle"></i><span>Kurikulum</span></a></li> <br>
                <li class="{{(request()->is('pendidikan_integrasi_kegiatan_penelitian')) ? 'active' : ''}}"><a class="nav-link" href="{{ route('pendidikan_integrasi_kegiatan_penelitian') }}"><i class="fas fa-circle"></i><span>Integrasi Kegiatan Penelitian/PkM</span></a></li><br>
                <li class="{{(request()->is('pendidikan_kepuasan_mahasiswa')) ? 'active' : ''}}"><a class="nav-link" href="{{ route('pendidikan_kepuasan_mahasiswa') }}"><i class="fas fa-circle"></i><span>Kepuasan Mahasiswa</span></a></li> <br>
            </ul>
        </li>

        <li class="{{(request()->is('penelitian_dtps_yang_melibatkan_mahasiswa')) ? 'active' : ''}}">
            <a href="{{(request()->is('penelitian_dtps_yang_melibatkan_mahasiswa')) ? 'active' : ''}}" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-caret-right"></i>
                <span>Penelitian</span></a>
            <ul class="dropdown-menu">
                <li class="{{(request()->is('penelitian_dtps_yang_melibatkan_mahasiswa')) ? 'active' : ''}}"><a class="nav-link" href="{{ route('penelitian_dtps_yang_melibatkan_mahasiswa') }}"><i class="fas fa-circle"></i><span>Data Penelitian DTPS</span></a></li><br>
            </ul>
        </li>

        <li class="{{(request()->is('pkm_dtps_yang_melibatkan_mahasiswa')) ? 'active' : ''}}"><a class="nav-link" href="{{ route('pkm_dtps_yang_melibatkan_mahasiswa') }}"><i class="fas fa-caret-right"></i><span>Pengabdian Kepada Masyarakat</span></a></li>

        <li class="">
            <a href="{{(request()->is('ipk_lulusan')) ? 'active' : ''}}" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-caret-right"></i>
                <span>Luaran dan Capaian Tridharma</span></a>
            <ul class="dropdown-menu ">
                <li class="{{(request()->is('ipk_lulusan')) ? 'active' : ''}}"><a class="nav-link" href="{{ route('ipk_lulusan') }}"><i class="fas fa-circle"></i><span>Index Prestasi Kumulatif Lulusan</span></a></li><br>

                <li class="{{(request()->is('prestasi_akademik_mahasiswa')) ? 'active' : ''}}"><a class="nav-link" href="{{ route('prestasi_akademik_mahasiswa') }}"><i class="fas fa-circle"></i><span>Prestasi Akademik Mahasiswa</span></a></li><br>
                <li class="{{(request()->is('prestasi_non_akademik_mahasiswa')) ? 'active' : ''}}"><a class="nav-link" href="{{ route('prestasi_non_akademik_mahasiswa') }}"><i class="fas fa-circle"></i><span>Prestasi Non-Akademik Mahasiswa</span></a></li><br>

                <li class="{{(request()->is('masa_studi_lulusan_program_d3')) ? 'active' : ''}}"><a class="nav-link" href="{{ route('masa_studi_lulusan_program_d3') }}"><i class="fas fa-circle"></i><span>Masa Studi Lulusan Program D3</span></a></li><br>
                <li class="{{(request()->is('masa_studi_lulusan_program_sarajana_terapan')) ? 'active' : ''}}"><a class="nav-link" href="{{ route('masa_studi_lulusan_program_sarajana_terapan') }}"><i class="fas fa-circle"></i><span>Masa Studi Lulusan Program Sarjana Terapan</span></a></li><br>

                <li class="{{(request()->is('waktu_tunggu_lulusan_program_d3')) ? 'active' : ''}}"><a class="nav-link" href="{{ route('waktu_tunggu_lulusan_program_d3') }}"><i class="fas fa-circle"></i><span>Waktu Tunggu Lulusan Program D3</span></a></li><br>
                <li class="{{(request()->is('waktu_tunggu_lulusan_program_sarajana_terapan')) ? 'active' : ''}}"><a class="nav-link" href="{{ route('waktu_tunggu_lulusan_program_sarajana_terapan') }}"><i class="fas fa-circle"></i><span>Waktu Tunggu Lulusan Program Sarjana Terapan</span></a></li><br>
                <li class="{{(request()->is('kesesuaian_bidang_kerja_lulusan')) ? 'active' : ''}}"><a class="nav-link" href="{{ route('kesesuaian_bidang_kerja_lulusan') }}"><i class="fas fa-circle"></i><span>Kesesuaian Bidang Kerja Lulusan</span></a></li><br>

                <li class="{{(request()->is('tempat_kerja_lulusan')) ? 'active' : ''}}"><a class="nav-link" href="{{ route('tempat_kerja_lulusan') }}"><i class="fas fa-circle"></i><span>Tempat Kerja Lulusan</span></a></li><br>
                <li class="{{(request()->is('referensi_kepuasan_pengguna_lulusan')) ? 'active' : ''}}"><a class="nav-link" href="{{ route('referensi_kepuasan_pengguna_lulusan') }}"><i class="fas fa-circle"></i><span>Referensi Kepuasan Pengguna Lulusan</span></a></li><br>
                <li class="{{(request()->is('kepuasan_pengguna_lulusan')) ? 'active' : ''}}"><a class="nav-link" href="{{ route('kepuasan_pengguna_lulusan') }}"><i class="fas fa-circle"></i><span>Kepuasan Pengguna Lulusan</span></a></li><br>

                <li class="{{(request()->is('pagelaran_pameran_prestasi_publikasi_ilmiah_mahasiswa')) ? 'active' : ''}}"><a class="nav-link" href="{{ route('pagelaran_pameran_prestasi_publikasi_ilmiah_mahasiswa') }}"><i class="fas fa-circle"></i><span>Publikasi Ilmiah Mahasiswa</span></a></li><br>
                <li class="{{(request()->is('prodi_produk_jasa_mahasiswa_diadopsi_oleh_industri_masyarakat')) ? 'active' : ''}}"><a class="nav-link" href="{{ route('produk_jasa_mahasiswa_diadopsi_oleh_industri_masyarakat') }}"><i class="fas fa-circle"></i><span>Produk/Jasa Mahasiswa</span></a></li><br>

                <li class="{{(request()->is('mahasiswa_hki_paten')) ? 'active' : ''}}"><a class="nav-link" href="{{ route('mahasiswa_hki_paten') }}"><i class="fas fa-circle"></i><span>HKI (Paten) Mahasiswa</span></a></li><br>
                <li class="{{(request()->is('mahasiswa_hki_hak_cipta')) ? 'active' : ''}}"><a class="nav-link" href="{{ route('mahasiswa_hki_hak_cipta') }}"><i class="fas fa-circle"></i><span>HKI (Hak Cipta) Mahasiswa</span></a></li><br>
                <li class="{{(request()->is('mahasiswa_teknologi_tepat_guna')) ? 'active' : ''}}"><a class="nav-link" href="{{ route('mahasiswa_teknologi_tepat_guna') }}"><i class="fas fa-circle"></i><span>Teknologi Tepat Guna Mahasiswa</span></a></li><br>
                <li class="{{(request()->is('mahasiswa_buku_berisbn')) ? 'active' : ''}}"><a class="nav-link" href="{{ route('mahasiswa_buku_berisbn') }}"><i class="fas fa-circle"></i><span>Buku ber-ISBN Mahasiswa</span></a></li><br>

                <!-- <li class="dropdown-submenu">
                        <a class="test" href=" #" data-toggle="dropdown"><i class="fas fa-caret-right"></i>
                            <span>Prestasi Mahasiswa</span></a>
                        <ul class="dropdown-menu">
                            <li tabindex="-1" class=""><a class="dropdown-item" href=""><i class="fas fa-circle"></i><span>Index Prestasi Kumulatif Lulusan</span></a></li><br>
                        </ul>
                    </li><br><br> -->
                <!-- <li class=""><a class="nav-link" href=""><i class="fas fa-circle"></i><span>Efektifitas dan Produktifitas Pendidikan</span></a></li><br><br> -->
                <!-- <li class=""><a class="nav-link" href=""><i class="fas fa-circle"></i><span>Daya Saing Lulusan</span></a></li><br> -->
                <!-- <li class=""><a class="nav-link" href=""><i class="fas fa-circle"></i><span>Kinerja Lulusan</span></a></li><br> -->
                <!-- <li class=""><a class="nav-link" href=""><i class="fas fa-circle"></i><span>Luaran Penelitian dan PkM Mahasiswa</span></a></li><br> -->
            </ul>
        </li>

    </ul>
</aside>