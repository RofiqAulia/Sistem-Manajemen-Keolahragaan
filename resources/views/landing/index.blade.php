<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>{{ config('app.name') . ' | Sistem Manajemen Olahraga UKM Olah Raga Polinema' }}</title>

  <!-- Favicons -->
  <link href="{{ asset('/vendor/landing/img/favicon.png') }}" rel="icon">
  <link href="{{ asset('/vendor/landing/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('/vendor/landing/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('/vendor/landing/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('/vendor/landing/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
  <link href="{{ asset('/vendor/landing/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
  <link href="{{ asset('/vendor/landing/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{ asset('/vendor/landing/css/style.css') }}" rel="stylesheet" type="text/css">
</head>

<body>
  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center">
    <div class="container d-flex align-items-center">

      <div class="logo me-auto">
        <h1><a href="#">SI-OR</a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
      </div>

      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
          <li><a class="nav-link scrollto active" href="#beranda">Beranda</a></li>
          <li><a class="nav-link scrollto" href="#tentang">Tentang</a></li>
          <li><a class="nav-link scrollto" href="#kegiatan">Kegiatan</a></li>
          <li><a class="nav-link scrollto" href="#situs-sejarah">Situs Sejarah</a></li>
          <li class="dropdown"><a class="nav-link scrollto" href="#dokumen-surat"><span>Dokumen & Surat Pengantar</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li class="dropdown"><a class="nav-link"><span>Dokumen</span> <i class="bi bi-chevron-right"></i></a>

              </li>
              <li class="dropdown"><a class="nav-link"><span>Surat Pengantar</span> <i class="bi bi-chevron-right"></i></a>
                <ul>
                </ul>
              </li>
            </ul>
          </li>
          <li>
            <a class="nav-link">
              <button class="btn btn-outline-primary px-4" onclick="window.location.href='#'">
                @auth
                  Dashboard
                @endauth
                @guest
                  Login
                @endguest
              </button>
            </a>
          </li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->
    </div>
  </header><!-- End Header -->

  <!-- ======= beranda Section ======= -->
  <section id="beranda" class="d-flex flex-column justify-content-center align-items-center"
  style="background: url('{{ asset('/assets/images/ukmor.jpg') }}') center center;">
    <div class="container text-center text-md-left" data-aos="fade-up">
      <h1>Welcome to <span>SI-OR</span></h1>
      <h2>Sistem Informasi Manajemen Olahraga, Politeknik Negeri Malang</h2>
      <a href="#tentang" class="btn-get-started scrollto">Kenali Lebih Dalam</a>
    </div>
  </section><!-- End beranda -->

  <main id="main">

    <section id="tentang" class="about my-5">
      <div class="container">
        <div class="row">
          <div class="col-lg-6">
            <img src="{{ asset('assets/images/timor.jpg') }}" class="img-fluid" alt="Gambar Tentang Kami">
          </div>
          <div class="col-lg-6 pt-4 pt-lg-0 align-item-center justify-content-center">
            <h3>Tentang SI-OR</h3>
            <br>
            <p>
              Sistem Ini dibuat dan dilengkapi untuk informasi mahasiswa dengan minat dan bakat di bidang olahraga
            </p>
            <p>
              Selain itu, Siwarga memberikan kemampuan untuk menganalisis data populasi secara real-time, sehingga memungkinkan pengambil keputusan untuk merencanakan dan mengimplementasikan kebijakan yang lebih efektif. Dengan integrasi yang mulus dan antarmuka yang ramah pengguna, Siwarga menjadi alat yang tak tergantikan dalam membangun masyarakat yang lebih terorganisir, inklusif, dan responsif terhadap kebutuhan warganya.
            </p>
          </div>
        </div>
      </div>
    </section>
    
    <section id="kegiatan" class="kegiatan section-bg">
      <div class="container">
        <div class="section-title">
          <h2>Kegiatan Olahraga</h2>
        </div>
        <div class="row">
          <div class="col-lg-12">
            <ul id="kegiatan-filters">
              <li data-filter="*" class="filter-active">Semua</li>
              <li data-filter=".filter-Mingguan">Mingguan</li>
              <li data-filter=".filter-Bulanan">Bulanan</li>
              <li data-filter=".filter-Tahunan">Tahunan</li>
              <li data-filter=".filter-Insidental">Insidental</li>
            </ul>
          </div>
        </div>
        <div class="row kegiatan-container">
        </div>
      </div>
    </section>    
    
    <section id="situs-sejarah" class="situs-sejarah">
      <div class="container">
        <div class="section-title">
          <h2>Situs Sejarah</h2>
        </div>
        <div class="situs-sejarah-slider swiper" data-aos="fade-up" data-aos-delay="100">
          <div class="swiper-wrapper">
          </div>
          <div class="swiper-pagination"></div>
        </div>
      </div>
    </section>    

    <section id="dokumen-surat" class="dokumen-surat section-bg">
      <div class="container">
        <div class="section-title">
          <h2>Dokumen & Surat Pengantar</h2>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="icon-box">
              <i class="bi bi-book"></i>
              <h4><a>Dokumen</a></h4>
              <p style="text-align: justify;">Dokumen adalah rekaman tertulis atau cetakan yang memuat informasi atau data tertentu, yang disusun dan disimpan untuk tujuan tertentu seperti komunikasi, referensi, atau bukti.</p>
              <div class="accordion mt-4" id="accordionDokumen">
                <div class="accordion-item">
                  <h2 class="accordion-header">
                    <button class="accordion-button fs-6 fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseDokumen">
                      Daftar Dokumen
                    </button>
                  </h2>
                  <div id="collapseDokumen" class="accordion-collapse collapse" data-bs-parent="#accordionDokumen">
                    <div class="accordion-body">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6 mt-4 mt-lg-0">
            <div class="icon-box">
              <i class="bi bi-envelope-open"></i>
              <h4><a>Surat Pengantar</a></h4>
              <p style="text-align: justify;">Surat pengantar adalah dokumen yang digunakan untuk mengantar atau menyampaikan sesuatu kepada pihak lain, dengan menjelaskan maksud atau tujuan pengiriman.</p>
              <div class="accordion mt-4" id="accordionSuratPengantar">
                <div class="accordion-item">
                  <h2 class="accordion-header">
                    <button class="accordion-button fs-6 fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSuratPengantar">
                      Daftar Surat Pengantar
                    </button>
                  </h2>
                  <div id="collapseSuratPengantar" class="accordion-collapse collapse" data-bs-parent="#accordionSuratPengantar">
                    <div class="accordion-body">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>    

    <section id="developer" class="developer">
      <div class="container">
        <div class="section-title">
          <h2>Pengembang</h2>
        </div>
        <div class="row justify-content-center">
          <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
            <div class="member" id="sigit-firmansyah">
              <img src="{{ asset('assets/images/default-avatar.jpg') }}" alt="">
              <h4>M. Sigit Firmansyah</h4>
              <span>Project Manager</span>
              <div class="social">
                <a href="https://github.com/siegtf" target="_blank"><i class="bi bi-github"></i></a>
                <a href=""><i class="bi bi-linkedin"></i></a>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
            <div class="member" id="diva-aji">
              <img src="{{ asset('assets/images/default-avatar.jpg') }}" alt="">
              <h4>Diva Aji Kurniawan</h4>
              <span>Full Stack Developer</span>
              <div class="social">
                <a href="https://github.com/DivaAji" target="_blank"><i class="bi bi-github"></i></a>
                <a href=""><i class="bi bi-linkedin"></i></a>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
            <div class="member" id="fadly-nugraha">
              <img src="{{ asset('assets/images/default-avatar.jpg') }}" alt="">
              <h4>Fadly Nugraha Jati</h4>
              <span>Full Stack Developer</span>
              <div class="social">
                <a href="https://github.com/fadlynj" target="_blank"><i class="bi bi-github"></i></a>
                <a href=""><i class="bi bi-linkedin"></i></a>
              </div>
            </div>
          </div>
        </div>
        <div class="row justify-content-center">
          <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
            <div class="member" id="rofiq-aulia">
              <img src="{{ asset('assets/images/default-avatar.jpg') }}" alt="">
              <h4>M. Rofiq Aulia</h4>
              <span>Full Stack Developer</span>
              <div class="social">
                <a href="https://github.com/RofiqAulia" target="_blank"><i class="bi bi-github"></i></a>
                <a href=""><i class="bi bi-linkedin"></i></a>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
            <div class="member" id="masyithah-sophia">
              <img src="{{ asset('assets/images/default-avatar.jpg') }}" alt="">
              <h4>Masyithah Sophia Damayanti</h4>
              <span>Full Stack Developer</span>
              <div class="social">
                <a href="https://github.com/Masyithah28" target="_blank"><i class="bi bi-github"></i></a>
                <a href=""><i class="bi bi-linkedin"></i></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>    

    <footer id="footer">
      <div class="footer-top">
        <div class="container">
          <div class="row">
            <div class="col-lg-2 col-md-6 footer-contact">
              <h3>SI-OR</h3>
              <p style="text-align: justify;">
                UKM Olah Raga <br>
                Politeknik Negeri Malang <br>
                Kota Malang <br>
              </p>
            </div>
            <div class="col-lg-3 col-md-6 footer-links">
              <h4>Daftar Link</h4>
              <ul>
                <li><i class="bx bx-chevron-right"></i> <a href="#beranda">Beranda</a></li>
                <li><i class="bx bx-chevron-right"></i> <a href="#tentang">Tentang</a></li>
                <li><i class="bx bx-chevron-right"></i> <a href="#kegiatan">Kegiatan</a></li>
                <li><i class="bx bx-chevron-right"></i> <a href="#situs-sejarah">Situs Sejarah</a></li>
                <li><i class="bx bx-chevron-right"></i> <a href="#dokumen-surat">Dokumen & Surat Pengantar</a></li>
              </ul>
            </div>
            <div class="col-lg-3 col-md-6 footer-links">
              <h4>Pengembang</h4>
              <ul>
                <li><i class="bx bx-chevron-right"></i> <a href="#sigit-firmansyah">M. Sigit Firmansyah</a></li>
                <li><i class="bx bx-chevron-right"></i> <a href="#diva-aji">Diva Aji Kurniawan</a></li>
                <li><i class="bx bx-chevron-right"></i> <a href="#fadly-nugraha">Fadly Nugraha Jati</a></li>
                <li><i class="bx bx-chevron-right"></i> <a href="#rofiq-aulia">M. Rofiq Aulia</a></li>
                <li><i class="bx bx-chevron-right"></i> <a href="#masyithah-sophia">Masyithah Sophia Damayanti</a></li>
              </ul>
            </div>
            <div class="col-lg-4 col-md-6 footer-newsletter">
              <h4>Kolaborasi Dengan</h4>
              <div class="row mt-2">
                <div class="col-sm-6">
                  <a href="https://jti.polinema.ac.id" target="_blank">
                    <img src="{{ asset('assets/images/logo-jti-polinema.png') }}" alt="Logo JTI Polinema" class="image-fluid">
                  </a>
                </div>
                <div class="col-sm-6">
                  <a href="https://polinema.ac.id" target="_blank">
                    <img src="{{ asset('assets/images/logo-polinema.png') }}" alt="Logo Polinema" class="image-fluid">
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    
      <div class="container d-md-flex py-4">
        <div class="me-md-auto text-center text-md-start">
          <div class="copyright">
            &copy; Copyright <strong><span>SI-OR</span></strong>. All Rights Reserved
          </div>
          <div class="credits">
            Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
          </div>
        </div>
      </div>
    </footer>    

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{ asset('/vendor/landing/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('/vendor/landing/vendor/glightbox/js/glightbox.min.js') }}"></script>
  <script src="{{ asset('/vendor/landing/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
  <script src="{{ asset('/vendor/landing/vendor/swiper/swiper-bundle.min.js') }}"></script>
  <script src="{{ asset('/vendor/landing/vendor/waypoints/noframework.waypoints.js') }}"></script>

  <!-- Template Main JS File -->
  <script src="{{ asset('/vendor/landing/js/main.js') }}"></script>
</body>
</html>