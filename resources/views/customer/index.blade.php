@extends('layouts.landing')

@section('title', 'BUMDes Air Pegunungan')

@section('content')
    <!-- Hero Section -->
    <section id="hero" class="hero section">

        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center">
                    <h1 data-aos="fade-up">Murni Dari Alam, Untuk Kesejahteraan Bersama
                    </h1>
                    <p data-aos="fade-up" data-aos-delay="100">Air Pegunungan: Sumber Kehidupan dan Pemberdayaan
                        Desa
                    </p>
                    <form action="{{ route('bills') }}" method="GET">
                        @csrf
                        <div class="input-group mb-3 me-3">
                            <input type="number" class="form-control" placeholder="ID Pelanggan/Meter"
                                aria-label="ID Pelanggan/Meter" aria-describedby="button-addon2" name="meter_id">
                            <button type="submit" class="btn btn-get-started" type="button" id="button-addon2">Cek
                                Tagihan</button>
                        </div>
                    </form>
                </div>
                <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-out">
                    <img src="assets/img/small_town.svg" class="img-fluid animated" alt="">
                </div>
            </div>
        </div>

    </section><!-- /Hero Section -->

    <!-- About Section -->
    <section id="about" class="about section">

        <div class="container" data-aos="fade-up">
            <div class="row gx-0">

                <div class="col-lg-6 d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-delay="200">
                    <div class="content">
                        <h3>Tentang BUMDes Air Pegunungan</h3>
                        <p style="text-align: justify">
                            BUMDes Air Pegunungan adalah Badan Usaha Milik Desa yang berfokus pada pengelolaan dan
                            distribusi air pegunungan yang murni dan berkualitas. Berdiri sejak tahun 2021, kami
                            berkomitmen untuk memberikan manfaat maksimal kepada masyarakat desa
                            melalui pemanfaatan sumber daya alam yang berkelanjutan.

                            Kami percaya bahwa air adalah sumber kehidupan. Oleh karena itu, dengan mengedepankan
                            prinsip-prinsip keberlanjutan dan pemberdayaan masyarakat, kami berupaya meningkatkan
                            kualitas hidup warga desa dan menjaga kelestarian lingkungan. Melalui berbagai program
                            dan inisiatif, kami tidak hanya menyediakan air bersih, tetapi juga menciptakan lapangan
                            kerja dan kesempatan ekonomi bagi masyarakat lokal.

                            Visi kami adalah menjadi model BUMDes yang unggul dalam pengelolaan sumber daya alam,
                            sementara misi kami adalah menyediakan air berkualitas, mendukung pemberdayaan ekonomi
                            desa, dan menjaga kelestarian alam untuk generasi mendatang. Dengan semangat gotong
                            royong dan inovasi, kami terus bergerak maju demi kesejahteraan bersama.

                        </p>
                        <div class="text-center text-lg-start">
                            <a href="#"
                                class="btn-read-more d-inline-flex align-items-center justify-content-center align-self-center">
                                <span>Lihat Detail</span>
                                <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 d-flex align-items-center" data-aos="zoom-out" data-aos-delay="200">
                    <img src="assets/img/undraw_stand_out_-1-oag.svg" class="img-fluid" alt="">
                </div>

            </div>
        </div>

    </section><!-- /About Section -->

    <!-- Pricing Section -->
    <section id="tariffs" class="pricing section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Tarif Penggunaan</h2>
            <p>BUMDes Air Bersih Pegunungan<br></p>
        </div><!-- End Section Title -->

        <div class="container">
            <table id="table-tariff" class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kelompok Pelanggan</th>
                        <th>Kategory</th>
                        <th>0 - 3 M<sup>3</sup></th>
                        <th>> 3 - 10 M<sup>3</sup></th>
                        <th>>10 - 20 M<sup>3</sup></th>
                        <th>>20 M<sup>3</sup></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tariffs as $tariff)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $tariff->tariff_name }}</td>
                            <td>{{ $tariff->tariff_category }}</td>
                            <td>{{ $tariff->t0_3_M3 }}</td>
                            <td>{{ $tariff->t__3_10_M3 }}</td>
                            <td>{{ $tariff->t__10_20_M3 }}</td>
                            <td>{{ $tariff->t__20_M3 }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </section><!-- /Pricing Section -->

    <!-- Faq Section -->
    <section id="faq" class="faq section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>F.A.Q</h2>
            <p>Pertanyaan yang Sering Diajukan</p>
        </div><!-- End Section Title -->

        <div class="container">

            <div class="row">

                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">

                    <div class="faq-container">

                        <div class="faq-item faq-active">
                            <h3>Apa itu BUMDes Air Pegunungan?</h3>
                            <div class="faq-content">
                                <p>BUMDes Air Pegunungan adalah Badan Usaha Milik Desa yang mengelola dan
                                    mendistribusikan air pegunungan berkualitas tinggi. Kami berkomitmen untuk
                                    menyediakan air bersih sekaligus mendukung kesejahteraan dan pemberdayaan
                                    masyarakat desa.
                                </p>
                            </div>
                            <i class="faq-toggle bi bi-chevron-right"></i>
                        </div><!-- End Faq item-->

                        <div class="faq-item">
                            <h3>Dari mana sumber air yang digunakan oleh BUMDes Air Pegunungan?</h3>
                            <div class="faq-content">
                                <p>Sumber air kami berasal dari mata air pegunungan yang terjaga kebersihannya. Kami
                                    memastikan bahwa air yang kami kelola memiliki kualitas terbaik dan aman untuk
                                    dikonsumsi.
                                </p>
                            </div>
                            <i class="faq-toggle bi bi-chevron-right"></i>
                        </div><!-- End Faq item-->

                        <div class="faq-item">
                            <h3>Bagaimana cara mendapatkan air dari BUMDes Air Pegunungan?</h3>
                            <div class="faq-content">
                                <p>Anda dapat menghubungi kami melalui kontak yang tersedia di halaman ini atau
                                    mengunjungi kantor BUMDes Air Pegunungan di desa kami. Kami menyediakan layanan
                                    distribusi air ke berbagai lokasi.
                                </p>
                            </div>
                            <i class="faq-toggle bi bi-chevron-right"></i>
                        </div><!-- End Faq item-->

                    </div>

                </div><!-- End Faq Column-->

                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">

                    <div class="faq-container">

                        <div class="faq-item">
                            <h3>Apakah air pegunungan ini aman untuk diminum?</h3>
                            <div class="faq-content">
                                <p>Ya, air yang kami distribusikan telah melalui proses penyaringan dan pengujian
                                    kualitas yang ketat untuk memastikan bahwa air tersebut aman untuk diminum dan
                                    digunakan dalam kegiatan sehari-hari.
                                </p>
                            </div>
                            <i class="faq-toggle bi bi-chevron-right"></i>
                        </div><!-- End Faq item-->

                        <div class="faq-item">
                            <h3> Apa saja manfaat dari menggunakan air pegunungan?</h3>
                            <div class="faq-content">
                                <p>Air pegunungan memiliki kualitas yang sangat baik, bebas dari kontaminasi kimia,
                                    dan kaya akan mineral alami yang bermanfaat bagi kesehatan. Selain itu, dengan
                                    menggunakan air dari BUMDes Air Pegunungan, Anda juga turut berkontribusi dalam
                                    mendukung perekonomian dan kesejahteraan masyarakat desa.
                                </p>
                            </div>
                            <i class="faq-toggle bi bi-chevron-right"></i>
                        </div><!-- End Faq item-->

                        <div class="faq-item">
                            <h3>Apakah BUMDes Air Pegunungan menyediakan layanan ke daerah di luar desa?</h3>
                            <div class="faq-content">
                                <p>Kami berupaya untuk melayani kebutuhan air tidak hanya di desa kami tetapi juga
                                    di daerah sekitar. Silakan hubungi kami untuk informasi lebih lanjut mengenai
                                    cakupan layanan distribusi kami.
                                </p>
                            </div>
                            <i class="faq-toggle bi bi-chevron-right"></i>
                        </div><!-- End Faq item-->

                    </div>

                </div><!-- End Faq Column-->

            </div>

        </div>

    </section><!-- /Faq Section -->

    <!-- Contact Section -->
    <section id="contact" class="contact section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Contact</h2>
            <p>Hubungi Kami</p>
        </div><!-- End Section Title -->

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="row gy-4">

                <div class="col-lg-6">

                    <div class="row gy-4">
                        <div class="col-md-6">
                            <div class="info-item" data-aos="fade" data-aos-delay="200">
                                <i class="bi bi-geo-alt"></i>
                                <h3>Alamat</h3>
                                <p>Jl. Arah Idano Gawo Km. 3,4 Desa Hiliadulo</p>
                                <p>Kec. Idanogawo Kab. Nias</p>
                            </div>
                        </div><!-- End Info Item -->

                        <div class="col-md-6">
                            <div class="info-item" data-aos="fade" data-aos-delay="300">
                                <i class="bi bi-telephone"></i>
                                <h3>Telepon</h3>
                                <p>+1 5589 55488 55</p>
                                <p>+1 6678 254445 41</p>
                            </div>
                        </div><!-- End Info Item -->

                        <div class="col-md-6">
                            <div class="info-item" data-aos="fade" data-aos-delay="400">
                                <i class="bi bi-envelope"></i>
                                <h3>Email</h3>
                                <p>admin@bumdes.com</p>
                                <p>manajemen@bumdes.com</p>
                            </div>
                        </div><!-- End Info Item -->

                        <div class="col-md-6">
                            <div class="info-item" data-aos="fade" data-aos-delay="500">
                                <i class="bi bi-clock"></i>
                                <h3>Jam Buka Kantor</h3>
                                <p>Senin - Jumat</p>
                                <p>8:00 - 15.00 WIB</p>
                            </div>
                        </div><!-- End Info Item -->

                    </div>

                </div>

                <div class="col-lg-6">
                    <form action="forms/contact.php" method="post" class="php-email-form" data-aos="fade-up"
                        data-aos-delay="200">
                        <div class="row gy-4">

                            <div class="col-md-6">
                                <input type="text" name="name" class="form-control" placeholder="Nama Anda"
                                    required="">
                            </div>

                            <div class="col-md-6 ">
                                <input type="email" class="form-control" name="email" placeholder="Email Anda"
                                    required="">
                            </div>

                            <div class="col-md-12">
                                <input type="text" class="form-control" name="subject" placeholder="Subject"
                                    required="">
                            </div>

                            <div class="col-md-12">
                                <textarea class="form-control" name="message" rows="6" placeholder="Pesan" required=""></textarea>
                            </div>

                            <div class="col-md-12 text-center">
                                <div class="loading">Loading</div>
                                <div class="error-message"></div>
                                <div class="sent-message">Pesan anda telah dikirim, harap tunggu konfirmasi 🤝
                                </div>

                                <button type="submit">Kirim Pesan</button>
                            </div>

                        </div>
                    </form>
                </div><!-- End Contact Form -->

            </div>

        </div>

    </section><!-- /Contact Section -->
@endsection
