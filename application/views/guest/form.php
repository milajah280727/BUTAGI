<!-- =========={ MAIN }==========  -->
<main id="content">
    <!-- =========={ HERO }==========  -->
    <div id="hero" class="section py-7 py-md-8 jarallax" data-jarallax-video="https://www.youtube.com/watch?v=slRB0gbIof0&list=PLtNOL2RWahUx60ol2OPjJ1Oli47zjLPbK">
        <!-- background overlay -->
        <div class="overlay bg-gradient-primary opacity-80 z-index-n1"></div>

        <div class="container">
            <div class="row justify-content-center">
                <!-- content -->
                <div class="col-lg-7" data-aos="fade-up">
                    <div class="mt-6 mt-lg-4 py-0 py-lg-5 text-center">
                        <!-- Pesan Error jika login gagal -->
                        <h1 class="display-4 fw-bold text-white mb-3">Selamat Datang <br><span class="fw-light">di SMK Negeri 1 Subang</span></h1><hr><br>
                        <p class="lead text-light mb-5">Silakan untuk mengisi form Buku Tamu Digital dengan mengklik Icon dibawah ini.</p><br>
                        <a href="<?php echo base_url('');?>GuestController/guest_form" class="btn btn-lg btn-warning text-dark">
                            Isi Form Buku Tamu
                            <svg class="bi bi-chevron-double-right ms-2" width=".8rem" height=".8rem" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M3.646 1.646a.5.5 0 01.708 0l6 6a.5.5 0 010 .708l-6 6a.5.5 0 01-.708-.708L9.293 8 3.646 2.354a.5.5 0 010-.708z" clip-rule="evenodd"></path>
                                <path fill-rule="evenodd" d="M7.646 1.646a.5.5 0 01.708 0l6 6a.5.5 0 010 .708l-6 6a.5.5 0 01-.708-.708L13.293 8 7.646 2.354a.5.5 0 010-.708z" clip-rule="evenodd"></path>
                            </svg>
                        </a>
                    </div>
                </div><!-- end content -->
            </div>
        </div>

        <!--  -->

        <!-- mathead -->
        <div class="masthead animated-up-down d-none d-md-block">
            <a href="#contact">
                <div class="mouse-icon">
                    <div class="scroller"><span class="visually-hidden">Scroll button</span></div>
                </div>
            </a>
        </div>
    </div><!-- end hero -->

<!-- =========={ SECTIONS / RIWAYAT TAMU }========== -->
<div id="contact" class="section py-6 pt-md-7 bg-body">
    <div class="container">
        <!-- Update header untuk Daftar Tamu Terpilih -->
        <header class="text-center mx-auto mb-5">
            <h2 class="h3 fw-bold">Daftar <span class="fw-light">Tamu Terpilih</span></h2>
            <hr class="divider my-4 bg-warning border-warning">
            <p class="lead text-muted">Daftar tamu yang dipilih untuk ditampilkan.</p>
        </header>

        <!-- Swiper CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

        <!-- Styling untuk Carousel -->
        <style>
            .swiper-container {
        width: 100%;
        padding: 20px 0;
    }
.swiper-container {
        width: 100%;
        padding: 20px 0;
    }

    .card-guest {
        border: 1px solid #ddd;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        background-color: transparent;
        height: 350px; /* Adjusted height for larger photo */
        display: flex;
        flex-direction: column;
        align-items: left;
        text-align: left;
    }

    .card-guest .photo-container {
        background-color: whitesmoke;
        width: 100%;
        height: 200px; /* Increased height to accommodate larger photo */
        display: flex;
        justify-content: center;
        align-items: center;
        overflow: hidden; /* Ensure photo doesn't overflow */
    }

    .card-guest .photo-container img {
        width: 100%;
        height: 100%;
        object-fit: cover; /* Fill container while maintaining aspect ratio */
        border: 2px solid white; /* Preserve border */
    }

    .card-guest .details-container {
        padding: 1.2rem;
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: center;
        background-color: transparent; /* Transparent background */
    }

    .card-guest .details-container h5 {
        margin: 0;
        font-weight: bold;
        font-size: 1.2rem;
    }

    .card-guest .details-container small {
        color: white;
    }

    .card-guest .info {
        margin-top: 10px;
        font-size: 0.95rem;
    }

    .card-guest .info div {
        margin-bottom: 5px;
    }

    /* Styling Tombol Navigasi Swiper */
    .swiper-button-next,
    .swiper-button-prev {
        color: #333;
        background-color: rgba(255, 255, 255, 0.8);
        border-radius: 50%;
        width: 40px;
        height: 40px;
    }

    .swiper-button-next:after,
    .swiper-button-prev:after {
        font-size: 20px;
    }

    .swiper-pagination {
        position: relative;
        margin-top: 20px;
    }

    .swiper-pagination-bullet {
        background-color: #333;
    }

    .swiper-pagination-bullet-active {
        background-color: #43350cff;
    }
        </style>

        <!-- Struktur Carousel -->
        <?php if (!empty($guests)): ?>
    <div class="swiper-container">
        <div class="swiper-wrapper">
            <?php $first_item = true; ?>
            <?php foreach ($guests as $guest): ?>
                <div class="swiper-slide">
                    <div class="card-guest">
                        <div class="photo-container">
                            <img src="<?= base_url('assets/uploads/' . $guest->photo) ?>" alt="Foto Tamu" class="img-fluid">
                        </div>
                        <div class="details-container">
                            <h5><?= $guest->name ?></h5>
                            <small><?= date('d M Y H:i', strtotime($guest->created_at)) ?></small>
                            <div class="info mt-3">
                                <div><strong>Instansi:</strong> <?= $guest->institution ?></div>
                                <div><strong>Tanggal Kunjungan:</strong> <?= date('d M Y H:i', strtotime($guest->created_at)) ?></div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php $first_item = false; ?>
            <?php endforeach; ?>
        </div>
        <!-- Add Pagination -->
        <div class="swiper-pagination"></div>
        <!-- Add Navigation -->
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
    </div>

                <!-- Tombol Navigasi -->
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>

                <!-- Paginasi -->
                <div class="swiper-pagination"></div>
            </div>
        <?php else: ?>
            <div class="alert alert-warning">Tidak ada tamu terpilih.</div>
        <?php endif; ?>

        <!-- Swiper JS -->
        <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

        <!-- Script Inisialisasi Swiper -->
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const swiper = new Swiper('.swiper-container', {
                    slidesPerView: 1,
                    spaceBetween: 20,
                    loop: true,
                    autoplay: {
                        delay: 3000,
                        disableOnInteraction: false,
                    },
                    navigation: {
                        nextEl: '.swiper-button-next',
                        prevEl: '.swiper-button-prev',
                    },
                    pagination: {
                        el: '.swiper-pagination',
                        clickable: true,
                    },
                    breakpoints: {
                        768: {
                            slidesPerView: 2,
                            spaceBetween: 20,
                        },
                        1024: {
                            slidesPerView: 3,
                            spaceBetween: 30,
                        },
                    },
                });
            });
        </script>
    </div>
</div>
<!-- Akhir Contact -->
</main>
