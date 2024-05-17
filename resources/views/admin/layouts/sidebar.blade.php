<nav class="sidebar sidebar-offcanvas mt-3" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="{{route ('dashboard')}}" id="berandaLink">
                <i class="fa-solid fa-house menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        <li class="nav-item mt-3" style="background-color: #FFC100; border-radius: 10px;">
            <div class="row p-2 ml-2">
                <span class="menu-title">Master</span>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route ('user.index')}}">
                <i class="fa-solid fa-user menu-icon"></i>
                <span class="menu-title">User</span>
            </a>
        </li>

        <li class="nav-item mt-4" style="background-color: #FFC100; border-radius: 10px;">
            <div class="row p-2 ml-2">
                <span class="menu-title">Menu</span>
            </div>
        </li>
        @if(Auth::user()->hasRole('Admin'))
        <li class="nav-item dropdown" id="beranda">
            <a class="nav-link" href="#">
                <i class="fa-solid fa-cube menu-icon"></i>
                <span class="menu-title">Beranda</span>
            </a>
            <div class="submenu">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fa-solid fa-bars menu-icon"></i>
                            <span class="menu-title">Berita Terbaru</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fa-solid fa-bars menu-icon"></i>
                            <span class="menu-title">Fasilitas</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fa-solid fa-bars menu-icon"></i>
                            <span class="menu-title">Akreditasi</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fa-solid fa-bars menu-icon"></i>
                            <span class="menu-title">Kerjasama Mitra</span>
                        </a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item dropdown" id="profilProdi">
            <a class="nav-link" href="#">
                <i class="fa-solid fa-warehouse menu-icon"></i>
                <span class="menu-title">Profil Prodi</span>
            </a>
            <div class="submenu">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fa-solid fa-bars menu-icon"></i>
                            <span class="menu-title">Sejarah TRPL</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fa-solid fa-bars menu-icon"></i>
                            <span class="menu-title">Visi, Misi, Tujuan TRPL</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fa-solid fa-bars menu-icon"></i>
                            <span class="menu-title">Kurikulum</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fa-solid fa-bars menu-icon"></i>
                            <span class="menu-title">Akreditasi</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fa-solid fa-bars menu-icon"></i>
                            <span class="menu-title">Fasilitas</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fa-solid fa-bars menu-icon"></i>
                            <span class="menu-title">Dosen dan Staff</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fa-solid fa-bars menu-icon"></i>
                            <span class="menu-title">Struktur Organisasi</span>
                        </a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item dropdown" id="kemahasiswaan">
            <a class="nav-link" href="#">
                <i class="fa-solid fa-users menu-icon"></i>
                <span class="menu-title">Kemahasiswaan</span>
            </a>
            <div class="submenu">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fa-solid fa-bars menu-icon"></i>
                            <span class="menu-title">Kegiatan</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fa-solid fa-bars menu-icon"></i>
                            <span class="menu-title">Prestasi</span>
                        </a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="icon-folder menu-icon"></i>
                <span class="menu-title">Dokumen Mutu</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="icon-folder menu-icon"></i>
                <span class="menu-title">Dokumen MKI</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="icon-folder menu-icon"></i>
                <span class="menu-title">Dokumen TA</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="icon-folder menu-icon"></i>
                <span class="menu-title">Surat Edar Mahasiswa</span>
            </a>
        </li>
        @endif
        @if(Auth::user()->hasRole('Kaprodi'))
        <li class="nav-item dropdown" id="beranda">
            <a class="nav-link" href="#">
                <i class="fa-solid fa-cube menu-icon"></i>
                <span class="menu-title">Beranda</span>
            </a>
            <div class="submenu">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fa-solid fa-bars menu-icon"></i>
                            <span class="menu-title">Berita Terbaru</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fa-solid fa-bars menu-icon"></i>
                            <span class="menu-title">Fasilitas</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fa-solid fa-bars menu-icon"></i>
                            <span class="menu-title">Akreditasi</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fa-solid fa-bars menu-icon"></i>
                            <span class="menu-title">Kerjasama Mitra</span>
                        </a>
                    </li>
                </ul>
            </div>
        </li>
        @endif
    </ul>
</nav>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>

<script>
$(document).ready(function(){
    // Sembunyikan submenu saat halaman dimuat
    $(".submenu").hide();

    // Tambahkan event click pada menu "Beranda"
    $("#beranda").click(function(e) {
        e.preventDefault();
        // Toggle tampilan submenu
        $("#beranda .submenu").slideToggle();
    });

    // Tambahkan event click pada menu "ProfilProdi"
    $("#profilProdi").click(function(e) {
        e.preventDefault();
        // Toggle tampilan submenu
        $("#profilProdi .submenu").slideToggle();
    });

    // Tambahkan event click pada menu "kemahasiswaan"
    $("#kemahasiswaan").click(function(e) {
        e.preventDefault();
        // Toggle tampilan submenu
        $("#kemahasiswaan .submenu").slideToggle();
    });
});

</script>