<!-- Tambahkan SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Bagian utama tetap sama -->
<main id="content">
    <!-- HERO -->
    <div id="hero" class="section py-7 py-md-8 jarallax" data-jarallax-video="https://www.youtube.com/watch?v=slRB0gbIof0&list=PLtNOL2RWahUx60ol2OPjJ1Oli47zjLPbK">
        <div class="overlay bg-gradient-primary opacity-80 z-index-n1"></div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-7" data-aos="fade-up">
                    <div class="mt-6 mt-lg-4 py-0 py-lg-5 text-center">
                        <h1 class="display-4 fw-bold text-white mb-3">Selamat Datang <br><span class="fw-light">di SMK Negeri 1 Subang</span></h1><hr><br>
                        <p class="lead text-light mb-5">Silakan untuk mengisi form Buku Tamu Digital dengan mengklik Icon dibawah ini.</p><br>
                        <div>
                            <a href="<?php echo base_url('GuestController/guest_form'); ?>" class="btn btn-lg btn-warning text-dark"> Isi Form Buku Tamu</a>
                        </div>

                        <style>
                            .qr-card {
                                background: #fff;
                                padding: 20px;
                                border-radius: 15px;
                                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
                                max-width: 350px;
                                margin: 0 auto;
                                position: relative;
                                z-index: 1;
                                border: 2px solid #007bff;
                            }
                            
                            #scan-status {
                                margin: 10px 0;
                                padding: 10px;
                                border-radius: 5px;
                                display: none;
                            }
                            
                            #qr-reader-container {
                                position: fixed;
                                top: 50%;
                                left: 50%;
                                transform: translate(-50%, -50%);
                                width: 100%;
                                max-width: 400px;
                                z-index: 1000;
                                opacity: 0;
                                transition: opacity 0.3s ease-in-out;
                            }
                            
                            #qr-reader-container.active {
                                opacity: 1;
                            }
                            
                            #qr-reader {
                                width: 100%;
                                max-width: 300px;
                                height: 225px;
                                border: 2px solid #007bff;
                                border-radius: 10px;
                                position: relative;
                                margin: 0 auto;
                                overflow: hidden;
                            }
                            
                            #qr-reader video {
                                width: 100% !important;
                                height: 100% !important;
                                object-fit: cover;
                                border-radius: 8px;
                            }
                            
                            #qr-reader canvas {
                                position: absolute !important;
                                top: 0 !important;
                                left: 0 !important;
                                width: 100% !important;
                                height: 100% !important;
                            }
                            
                            .btn {
                                padding: 10px 20px;
                                border: none;
                                border-radius: 5px;
                                cursor: pointer;
                                margin: 5px;
                                font-size: 16px;
                            }
                            
                            .btn-secondary {
                                background: #6c757d;
                                color: white;
                            }
                            
                            .btn-danger {
                                background: #dc3545;
                                color: white;
                            }
                            
                            .btn-warning {
                                background: #ffc107;
                                color: black;
                            }
                            
                            .btn:disabled {
                                opacity: 0.6;
                                cursor: not-allowed;
                            }
                            
                            .instruction {
                                margin-top: 10px;
                                color: #666;
                                font-size: 14px;
                            }
                            
                            .scan-line {
                                width: 200px;
                                height: 2px;
                                background: #00ff00;
                                position: absolute;
                                top: 50%;
                                left: 50%;
                                transform: translateX(-50%);
                                animation: scan 2s linear infinite;
                            }
                            
                            @keyframes scan {
                                0% { top: 20%; }
                                50% { top: 50%; }
                                100% { top: 80%; }
                            }

                            body.blur-active {
                                background: rgba(0, 0, 0, 0.5);
                                backdrop-filter: blur(5px);
                                transition: backdrop-filter 0.3s ease;
                            }
                            
                            .debug-info {
                                background: #f8f9fa;
                                border: 1px solid #dee2e6;
                                border-radius: 5px;
                                padding: 10px;
                                margin: 20px 0;
                                font-size: 12px;
                                font-family: monospace;
                            }

                            /* Instagram-like style */
                            .instagram-style {
                                background: #fff;
                                padding: 15px;
                                border-radius: 15px;
                                box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
                                max-width: 350px;
                                margin: 0 auto;
                                border: 1px solid #dbdbdb;
                                position: relative;
                                overflow: hidden;
                            }

                            .instagram-style::before {
                                content: '';
                                position: absolute;
                                top: 0;
                                left: 0;
                                width: 100%;
                                height: 4px;
                                background: linear-gradient(to right, #405de6, #5851db, #833ab4, #c13584, #e1306c, #fd1d1d);
                            }
                        </style>

                        <!-- <div>
                            <button id="scan-qr" class="btn btn-secondary">Scan QR Tamu</button>
                        </div> -->
                        
                        <div id="scan-status"></div>
                        
                        <div id="qr-reader-container" style="display: none;">
                            <div class="qr-card instagram-style">
                                <div id="qr-reader">
                                    <div id="scan-line" class="scan-line" style="display: none;"></div>
                                </div>
                                <div class="instruction">
                                    Arahkan QR Code ke dalam frame kamera
                                </div>
                            </div>
                        </div>
                        
                        <div id="debug-info" class="debug-info" style="display: none;">
                            <div id="debug-content" style="display: none;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="masthead animated-up-down d-none d-md-block">
            <a href="#contact">
                <div class="mouse-icon">
                    <div class="scroller"><span class="visually-hidden">Scroll button</span></div>
                </a>
            </div>
        </div>
    </div>

    <!-- SECTIONS / RIWAYAT TAMU -->
    <div id="contact" class="section py-6 pt-md-7 bg-body">
        <div class="container">
            <header class="text-center mx-auto mb-5">
                <h2 class="h3 fw-bold">Daftar <span class="fw-light">Tamu Terpilih</span></h2>
                <hr class="divider my-4 bg-warning border-warning">
                <p class="lead text-muted">Daftar tamu yang dipilih untuk ditampilkan.</p>
            </header>

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
                <div class="swiper-pagination"></div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>
            <?php else: ?>
            <div class="alert alert-warning">Tidak ada tamu terpilih.</div>
            <?php endif; ?>
        </div>
    </div>
</main>

<!-- Tambahkan notifikasi -->
<div id="custom-notification" class="notification" style="display: none;">
    <div class="notification-content">
        <span id="notification-message"></span>
        <button class="close-btn" onclick="hideNotification()">×</button>
    </div>
</div>

<style>
    .notification {
        position: fixed;
        top: 20px;
        left: 50%;
        transform: translateX(-50%);
        z-index: 2000;
        width: 90%;
        max-width: 400px;
        padding: 15px;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        animation: slideIn 0.3s ease-out, fadeOut 0.3s ease-in 3s forwards;
    }

    .notification-content {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    #notification-message {
        font-size: 1.1rem;
        color: #fff;
    }

    .close-btn {
        background: none;
        border: none;
        font-size: 1.5rem;
        color: #fff;
        cursor: pointer;
        padding: 0 5px;
    }

    .notification.success {
        background-color: #28a745;
    }

    .notification.error {
        background-color: #dc3545;
    }

    .notification.warning {
        background-color: #ffc107;
        color: #333;
    }

    .notification.warning .close-btn {
        color: #333;
    }

    @keyframes slideIn {
        from { top: -50px; opacity: 0; }
        to { top: 20px; opacity: 1; }
    }

    @keyframes fadeOut {
        to { opacity: 0; }
    }

    /* Tambahan untuk Swiper (sudah ada, tidak diubah) */
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
        height: 350px;
        display: flex;
        flex-direction: column;
        align-items: left;
        text-align: left;
    }

    .card-guest .photo-container {
        background-color: whitesmoke;
        width: 100%;
        height: 200px;
        display: flex;
        justify-content: center;
        align-items: center;
        overflow: hidden;
    }

    .card-guest .photo-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border: 2px solid white;
    }

    .card-guest .details-container {
        padding: 1.2rem;
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: center;
        background-color: transparent;
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
                                    <img src="<?= base_url('assets/uploads/' . $guest->photo) ?>" alt="Foto Tamu" class="img-fluid rounded-circle">
                                </div>
                                <div class="details-container">
                                    <h5><?= $guest->name ?></h5>
                                    <small><?= date('d M Y', strtotime($guest->created_at)) ?></small>
                                    <div class="info mt-3">
                                        <div><strong>Instansi:</strong> <?= $guest->institution ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php $first_item = false; ?>
                    <?php endforeach; ?>
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