@extends('components.user.layout.header')
@section('section-hero')
<div class="col-lg-6 d-lg-flex flex-lg-column justify-content-center align-items-stretch pt-5 pt-lg-0 order-2 order-lg-1" data-aos="fade-up">
  <div>
    <h1>Selamat Datang Di LaporinAjaYuk!</h1>
    <h2>
        LaporinAjaYuk Adalah Sistem Pelaporan Pengaduan Masyarakat Berbasis Website.
        Silahkan Buat Aduanmu Disini! Akan Kami Proses dan Akan Kami Realisasikan!</h2>
    <a href="{{ route('user.login') }}" class="download-btn"><i class="bx bx-log-in-circle"></i> Login Disini!</a>
    <a href="{{ route('user.register') }}" class="download-btn"><i class="bx bx-send"></i> Register Disini!</a>
  </div>
</div>
<div class="col-lg-6 d-lg-flex flex-lg-column align-items-stretch order-1 order-lg-2 hero-img" data-aos="fade-up">
  <img src="{{ asset('assets') }}/img/img-laporin-aja-yuk-1.svg" class="img-fluid" alt="">
</div>
@endsection
@section('content-user')

    <!-- ======= App Features Section ======= -->
    <section id="features" class="features">
      <div class="container">

        <div class="section-title">
          <h2>Bagaimana Cara Menggunakan LaporinAjaYuk Ini?</h2>
        </div>

        <div class="row no-gutters">
          <div class="col-xl-7 d-flex align-items-stretch order-2 order-lg-1">
            <div class="content d-flex flex-column justify-content-center">
              <div class="row">
                <div class="col-md-6 icon-box" data-aos="fade-up">
                  <i class="bx bx-send"></i>
                  <h4>Register Terlebih Dahulu </h4>
                  <p>
                      Silahkan mendaftarkan akun anda terlebih dahulu untuk mengakses LaporinAjaYuk ini.
                  </p>
                </div>
                <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="100">
                  <i class="bx bx-log-in-circle"></i>
                  <h4>Login Dengan Akun Yang Sudah Ada</h4>
                  <p>Jika akun anda sudah didaftarkan, silahkan login dengan akun yang suda terdaftar.</p>
                </div>
                <div class="col-md-12 icon-box" data-aos="fade-up" data-aos-delay="300">
                  <i class="fa fa-plus-square"></i>
                  <h4>Buat Aduanmu!</h4>
                  <p>Silahkan buat aduan dan ikuti ketentuan pembuatannya!</p>
                </div>
                <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="400">
                  <i class="fa fa-info-circle"></i>
                  <h4>Tunggu Verifikasi dan Tanggapan!</h4>
                  <p>Jika sudah membuat aspirasi / aduan, tunggu aspirasi / aduan tersebut diverifikasi dan ditanggapi oleh pusat.</p>
                </div>
                <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="300">
                  <i class="fa fa-download"></i>
                  <h4>Unduh Hasil!</h4>
                  <p>Silahkan Unduh Hasil Aduan Dan Tanggapan! Jika Aduan Sudah Di Verifikasi dan Di Tanggapi!</p>
                </div>
              </div>
            </div>
          </div>
          <div class="image col-xl-5 d-flex align-items-stretch justify-content-center order-1 order-lg-2" data-aos="fade-left" data-aos-delay="100">
            <img src="{{ asset('assets') }}/img/features.svg" class="img-fluid" alt="">
          </div>
        </div>

      </div>
    </section><!-- End App Features Section -->

    <!-- ======= Frequently Asked Questions Section ======= -->
    <section id="faq" class="faq section-bg">
      <div class="container">

        <div class="section-title">
          <h2>Pertanyaan Umum</h2>
        </div>

        <div class="accordion-list">
          <ul>
            <li data-aos="fade-up">
              <i class="bx bx-help-circle icon-help"></i> <a data-toggle="collapse" class="collapse" href="#accordion-list-1">LaporinAjaYuk Apakah Bisa Membuat Aduan? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
              <div id="accordion-list-1" class="collapse show" data-parent=".accordion-list">
                <p>
                  Bisa. Pada LaporinAjaYuk Ini Fitur Utamanya Adalah Membuat Aduan yang Kemudian Akan Di Verifikasi Oleh Pusat dan Akan Segera Direalisasikan!
                </p>
              </div>
            </li>
            

            <li data-aos="fade-up" data-aos-delay="100">
              <i class="bx bx-help-circle icon-help"></i> <a data-toggle="collapse" href="#accordion-list-2" class="collapsed">Adakah Ketentuan Untuk Membuat Aduan di LaporinAjaYuk Ini? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
              <div id="accordion-list-2" class="collapse" data-parent=".accordion-list">
                <p>
                  Ada. Berikut Ketentuan Tersebut :
                  <ul>
                    <li><span class="fa fa-chevron-circle-right text-success"></span> Tidak Boleh Mengandung SARA, Pornografi, Kata - Kata Kotor atau Hal - Hal yang Bersifat Negatif.</li>
                    <li><span class="fa fa-chevron-circle-right text-success"></span> Pastikan Data yang Diisi Adalah Data yang Benar - Benar Real.</li>
                    <li><span class="fa fa-chevron-circle-right text-success"></span> Jika Terdapat Sistem Yang Error Silahkan Kontak Kami Di Form yang Sudah Disediakan atau Hubungi Admin <i class="fa fa-whatsapp"></i> : +62 831 303 581 18 / +62 812 225 349 37</li>
                  </ul>
                </p>
              </div>
            </li>

            <li data-aos="fade-up" data-aos-delay="300">
              <i class="bx bx-help-circle icon-help"></i> <a data-toggle="collapse" href="#accordion-list-4" class="collapsed">Apakah Aduan Akan Ditanggapi dan Segera Direalisasikan? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
              <div id="accordion-list-4" class="collapse" data-parent=".accordion-list">
                <p>
                  Aduan Akan Ditanggapi Oleh Petugas yang Berada Di Pusat, Maka Mohon Maaf Apabila Verifikasi Aduan Tersebut Memakan Proses yang Agak Lama. Direalisasikannya Aduan Tergantung Dari Fakta yang Disampaikan, Maka Petugas Akan Survei Secara Lapangan.
                </p>
              </div>
            </li>
            
            <li data-aos="fade-up" data-aos-delay="400">
              <i class="bx bx-help-circle icon-help"></i> <a data-toggle="collapse" href="#accordion-list-5" class="collapsed">Bagaimana Cara Merealisasikan Aduan Tersebut? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
              <div id="accordion-list-5" class="collapse" data-parent=".accordion-list">
                <p>
                  Kami Akan Melapor Kembali Ke Pemerintah dan Dinas yang Terkait yang Memiliki Tugas dan Wewenang Khusus Dalam Hal Realisasi, Lalu Melakukan Survei Secara Lapangan.
                </p>
              </div>
            </li>

            <li data-aos="fade-up" data-aos-delay="200">
              <i class="bx bx-help-circle icon-help"></i> <a data-toggle="collapse" href="#accordion-list-3" class="collapsed">Jika Sudah Membuat Aduan Adakah Langkah Selanjutnya? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
              <div id="accordion-list-3" class="collapse" data-parent=".accordion-list">
                <p>
                  Jika Sudah Membuat Aduan (yang Sudah Di Tanggapi Oleh Pusat), Silahkan Generate atau Download Surat Keterangan Berdasarkan Aduan Anda, Sebagai Bukti Tulisan.
                </p>
              </div>
            </li>

          </ul>
        </div>

      </div>
    </section><!-- End Frequently Asked Questions Section -->

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
      <div class="container">

        <div class="section-title">
          <h2>Contact</h2>
        </div>

        <div class="row">

          <div class="col-lg-6">
            <div class="row">
              <div class="col-lg-6 info" data-aos="fade-up">
                <i class="bx bx-map"></i>
                <h4>Address</h4>
                <p>Komplek SMP Negeri 2 Cianjur,<br>Jawa Barat, Kode Pos 43212</p>
              </div>
              <div class="col-lg-6 info" data-aos="fade-up" data-aos-delay="100">
                <i class="bx bx-phone"></i>
                <h4>Call Us</h4>
                <p>+62 831 303 581 18<br>+62 812 225 349 37</p>
              </div>
              <div class="col-lg-12 info" data-aos="fade-up" data-aos-delay="200">
                <i class="bx bx-envelope"></i>
                <h4>Email Us</h4>
                <p>adityamuhamadputra@gmail.com</p>
              </div>
            </div>
          </div>

          <div class="col-lg-6">
            <form method="post" action="#" role="form" class="php-email-form" data-aos="fade-up">
              <div class="form-group">
                <input placeholder="Your Name" type="text" name="name" class="form-control" id="name" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
                <div class="validate"></div>
              </div>
              <div class="form-group">
                <input placeholder="Your Email" type="email" class="form-control" name="email" id="email" data-rule="email" data-msg="Please enter a valid email" />
                <div class="validate"></div>
              </div>
              <div class="form-group">
                <input placeholder="Subject" type="text" class="form-control" name="subject" id="subject" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject" />
                <div class="validate"></div>
              </div>
              <div class="form-group">
                <textarea placeholder="Message" class="form-control" name="message" rows="5" data-rule="required" data-msg="Please write something for us"></textarea>
                <div class="validate"></div>
              </div>
              <div class="mb-3">
                <div class="loading">Loading</div>
                <div class="error-message"></div>
                <div class="sent-message">Your message has been sent. Thank you!</div>
              </div>
              <div class="text-center"><button type="submit">Send Message</button></div>
            </form>
          </div>
        </div>
      </div>
    </section><!-- End Contact Section -->
@endsection
@section('nav-user')
<li class="active"><a href="">Beranda</a></li>
<li><a href="#faq">F.A.Q</a></li>
<li><a href="#contact">Contact Us</a></li>

<li class="get-started"><a href="{{ route('user.login') }}"><i class="fa fa-sign-in"></i> Get Started</a></li>
@endsection
