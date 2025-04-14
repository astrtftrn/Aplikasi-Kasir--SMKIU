<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>KSMKIU</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Favicons -->
    <link href="{{ asset('assets/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">

    <!-- =======================================================
  * Template Name: FlexStart
  * Template URL: https://bootstrapmade.com/flexstart-bootstrap-startup-template/
  * Updated: Nov 01 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body class="index-page">

    <header id="header" class="header d-flex align-items-center fixed-top">
        <div class="container-fluid container-xl position-relative d-flex align-items-center">

            <a href="index.html" class="logo d-flex align-items-center me-auto">
                <!-- Uncomment the line below if you also wish to use an image logo -->
                <img src="{{ asset('assets/images/logos/logo.png') }}" alt="Logo">
                <h1 class="sitename"> APLIKASI KASIR SMK INFORMATIKA UTAMA</h1>
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="#hero" class="active">Home<br></a></li>
                    <li><a href="#about">About</a></li>
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>

            <a class="btn-getstarted flex-md-shrink-0" href="{{ route('login') }}">LOGIN</a>
            <a class="btn-getstarted flex-md-shrink-0 ms-2" href="{{ route('register') }}">REGISTER</a>

        </div>
    </header>

    <main class="main">

        <!-- Hero Section -->
        <section id="hero" class="hero section">

            <div class="container">
                <div class="row gy-4">
                    <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center">
                        <!-- Bagian Hero -->
                        <h1 data-aos="fade-up">Solusi Modern untuk Pengelolaan Kasir Sekolah</h1>
                        <p data-aos="fade-up" data-aos-delay="100">Kami menghadirkan aplikasi kasir digital yang efisien
                            dan mudah digunakan untuk mendukung kegiatan operasional SMK Informatika Utama.</p>
                        <a href="#about" class="btn-get-started">Mulai Sekarang <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-out">
                    <img src="{{ asset('assets/images/logos/hero-img.png') }}" class="img-fluid animated"
                        alt="">
                </div>
            </div>
            </div>

        </section><!-- /Hero Section -->

        <!-- About Section -->
        <section id="about" class="about section">

            <div class="container" data-aos="fade-up">
                <div class="row gx-0">

                    <div class="col-lg-6 d-flex flex-column justify-content-center" data-aos="fade-up"
                        data-aos-delay="200">
                        <div class="content">
                            <h3>Tentang Kami</h3>
                            <h2>Aplikasi Kasir Sekolah Terintegrasi</h2>
                            <p>
                                Aplikasi Kasir SMK Informatika Utama adalah sistem pencatatan transaksi kasir digital
                                yang dirancang khusus untuk kebutuhan sekolah. Dengan tampilan modern dan fitur yang
                                lengkap, mempermudah administrasi keuangan di lingkungan pendidikan.
                            </p>
                            <a href="#"
                                class="btn-read-more d-inline-flex align-items-center justify-content-center align-self-center">
                                <span>Selengkapnya</span>
                                <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 d-flex align-items-center" data-aos="zoom-out" data-aos-delay="200">
                    <img src="{{ asset('assets/images/logos/about.jpg') }}" class="img-fluid" alt="About Image">
                </div>

            </div>
            </div>

        </section><!-- /About Section -->

        <!-- Values Section -->
        <section id="values" class="values section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Nilai Utama Kami</h2>
                <p>Apa yang kami junjung tinggi dalam pengembangan aplikasi kasir ini</p>
            </div><!-- End Section Title -->

            <div class="container">

                <div class="row gy-4">

                    <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
                        <div class="card">
                            <img src="{{ asset('assets/images/logos/values-1.png') }}" class="img-fluid"
                                alt="Values Image">
                            <h3>Transparansi dan Akurasi</h3>
                            <p>Pencatatan transaksi dilakukan secara akurat dan transparan untuk memudahkan audit dan
                                laporan keuangan sekolah.</p>

                        </div>
                    </div><!-- End Card Item -->

                    <div class="container copyright text-center mt-4">
                        <p>© <span>Hak Cipta</span> <strong class="px-1 sitename">Aplikasi Kasir SMK Informatika
                                Utama</strong> <span>Seluruh Hak Dilindungi</span></p>
                        <div class="credits">
                            Dikembangkan oleh <a href="#">Tim IT SMK Informatika Utama</a>
                        </div>
                    </div>

                    </footer>

                    <!-- Scroll Top -->
                    <a href="#" id="scroll-top"
                        class="scroll-top d-flex align-items-center justify-content-center"><i
                            class="bi bi-arrow-up-short"></i></a>

                    <!-- Vendor JS Files -->
                    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
                    <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>
                    <script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
                    <script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
                    <script src="{{ asset('assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
                    <script src="{{ asset('assets/vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
                    <script src="{{ asset('assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
                    <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>

                    <!-- Main JS File -->
                    <script src="assets/js/main.js"></script>

</body>

</html>
