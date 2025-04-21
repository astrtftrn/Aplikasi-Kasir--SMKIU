<!-- Sidebar Start -->
<aside class="left-sidebar">
    <div class="scroll-container">
        <div class="brand-logo d-flex align-items-center justify-content-between">
            <a href="./index.html" class="text-nowrap logo-img">
                <img src="{{ asset('assets/images/logos/gambarkasir-.png') }}" width="160" alt="gambar kasir" />
                <img src="{{ asset('assets/images/logos/logoutm.png') }}" class="logo-utm" alt="logo utm" />
            </a>
            <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-8"></i>
            </div>
        </div>

        <nav class="sidebar-nav" data-simplebar>
            <ul id="sidebarnav">
                @if(auth()->user()->role == 'admin')
                    <li class="nav-title">Admin</li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="/dashboard">
                            <i class="ti ti-dashboard"></i> <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="/pelanggan">
                            <i class="ti ti-users"></i> <span>Pelanggan</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="/penjualan">
                            <i class="ti ti-file-invoice"></i> <span>Penjualan</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="/produk">
                            <i class="ti ti-package"></i> <span>Produk</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="/kategoriproduk">
                            <i class="ti ti-tag"></i> <span>Kategori Produk</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="/pembayaran">
                            <i class="ti ti-cash"></i> <span>Pembayaran</span>
                        </a>
                    </li>
                @endif

                @if(auth()->user()->role == 'kasir')
                    <li class="nav-title">Kasir</li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="/dashboard">
                            <i class="ti ti-dashboard"></i> <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="/pelanggan">
                            <i class="ti ti-users"></i> <span>Pelanggan</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="/penjualan">
                            <i class="ti ti-shopping-cart"></i> <span>Penjualan</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="/produk">
                            <i class="ti ti-package"></i> <span>Produk</span>
                        </a>
                    </li>
                @endif

                <!-- Tambahkan Cetak Laporan di atas menu Akun -->
                <li class="nav-title">Laporan</li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('penjualan.laporan.cetak') }}">
                        <i class="ti ti-printer"></i> <span>Cetak Laporan</span>
                    </a>
                </li>

                <!-- Menu Akun -->
                <li class="nav-title">Akun</li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="#" id="logout-link">
                        <i class="ti ti-logout"></i> <span>Logout</span>
                    </a>
                </li>

            </ul>
        </nav>
    </div>
</aside>

<!-- Form logout (tetap disembunyikan) -->
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>

<!-- SweetAlert Script -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.getElementById('logout-link').addEventListener('click', function(e) {
        e.preventDefault();  // Mencegah link default behavior

        // Menampilkan SweetAlert konfirmasi logout
        Swal.fire({
            title: 'Apakah kamu yakin ingin logout?',
            text: "Kamu akan keluar dari akun ini.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, Logout',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                // Jika pengguna mengonfirmasi, submit form logout
                document.getElementById('logout-form').submit();
                
                // Menampilkan SweetAlert setelah logout berhasil
                Swal.fire({
                    title: 'Anda berhasil logout',
                    text: 'Terima kasih telah menggunakan aplikasi kami!',
                    icon: 'success',
                    confirmButtonText: 'Tutup'
                });
            }
        });
    });
</script>

<!-- CSS Styling -->
<style>
    /* Sidebar Styling */
    .left-sidebar {
        width: 250px;
        height: 100vh;
        background: linear-gradient(135deg, #4facfe, #00c6ff);
        color: #fff;
        display: flex;
        flex-direction: column;
        position: fixed;
    }

    .scroll-container {
        flex: 1;
        overflow-y: auto;
        padding: 15px;
    }

    .brand-logo {
        padding: 15px;
        text-align: center;
        border-bottom: 2px solid rgba(255, 255, 255, 0.2);
    }

    .logo-utm {
        width: 35px;
        position: absolute;
        top: 10px;
        left: 10px;
    }

    /* Sidebar Nav */
    .sidebar-nav {
        margin-top: 10px;
    }

    .nav-title {
        padding: 10px 15px;
        font-size: 13px;
        font-weight: bold;
        text-transform: uppercase;
        opacity: 0.8;
        border-bottom: 1px solid rgba(255, 255, 255, 0.2);
    }

    .sidebar-item {
        list-style: none;
        margin-bottom: 5px;
    }

    .sidebar-link {
        display: flex;
        align-items: center;
        padding: 10px 15px;
        color: #fff;
        text-decoration: none;
        border-radius: 6px;
        transition: all 0.3s ease;
    }

    .sidebar-link:hover {
        background: rgba(255, 255, 255, 0.2);
        transform: translateX(3px);
    }

    .sidebar-link i {
        font-size: 18px;
        margin-right: 10px;
    }

    .sidebar-item.active .sidebar-link {
        background: rgba(255, 255, 255, 0.4);
        font-weight: bold;
        transform: scale(1.05);
    }
</style>
