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

        <!-- =========={ CONTACT SECTION / RIWAYAT TAMU }==========  -->
  <div id="contact" class="section py-6 pt-md-7 bg-body">
    <div class="container">
      <header class="text-center mx-auto mb-5">
        <h2 class="h3 fw-bold">Daftar <span class="fw-light">Tamu</span></h2>
        <hr class="divider my-4 bg-warning border-warning">
        <p class="lead text-muted">Riwayat kunjungan tamu hari ini.</p>
      </header>

      <!-- ✅ Desain Kartu Horizontal Modern -->
      <style>
        .card-guest {
          display: flex;
          border: 1px solid #ddd;
          
          border-radius: 30px;
          overflow: hidden;
          margin-bottom: 1.5rem;
          box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
          background-color: #ffffffff;
        }

        .card-guest .left {
          background-color: whitesmoke;
          color: white;
          width: 350px;
          display: flex;
          align-items: center;
          justify-content: center;
        }

        .card-guest .left img {
          width: 70px;
          height: 70px;
          border-radius: 50%;
          object-fit: cover;
          border: 2px solid white;
        }

        .card-guest .right {
          padding: 1.2rem;
          flex: 1;
        }

        .card-guest .right h5 {
          margin: 0;
          font-weight: bold;
          font-size: 1.2rem;
        }

        .card-guest .right small {
          color: gray;
        }

        .card-guest .info {
          margin-top: 10px;
          font-size: 0.95rem;
        }

        .card-guest .info div {
          margin-bottom: 5px;
        }
      </style>

      <?php if (!empty($guests)): ?>
        <?php foreach ($guests as $guest): ?>
          <div class="card-guest">
            <div class="left">
              <img src="<?= base_url('assets/uploads/' . $guest->photo) ?>" alt="Foto Tamu">
            </div>
            <div class="right">
              <h5><?= $guest->name ?></h5>
              <small><?= date('d M Y', strtotime($guest->created_at)) ?></small>
              <div class="info">
                <div><strong>Nomor HP:</strong> <?= $guest->phone ?></div>
                <div><strong>Instansi:</strong> <?= $guest->institution ?></div>
                <div><strong>Keperluan:</strong> <?= $guest->purpose ?></div>
                <div><strong>Bertemu:</strong> <?= $guest->user_name ?></div>
                <div><strong>Ruangan:</strong> <?= $guest->room_name ?></div>
              </div>
              <a href="" class="btn btn-sm btn-outline-secondary mt-2" data-bs-toggle="modal" data-bs-target="#detail_tamu<?= $guest->id; ?>">Lihat Detail</a>
            </div>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <div class="alert alert-warning">Tidak ada tamu hari ini.</div>
      <?php endif; ?>
    </div>
  </div><!-- End Contact -->

  <!-- =========={ MODAL DETAIL }========== -->
  <?php foreach ($guests as $guest): ?>
    <div class="modal fade" id="detail_tamu<?php echo $guest->id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Detail Tamu: <?= $guest->name ?></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-lg-5">
                <img src="<?= base_url('assets/uploads/' . $guest->photo) ?>" width="100%" class="img img-thumbnail" alt="">
              </div>
              <div class="col-lg-7">
                <table class="table mt-2">
                  <tr><td><b>Nama Lengkap</b></td><td>:</td><td><?= $guest->name ?></td></tr>
                  <tr><td><b>Nomor HP</b></td><td>:</td><td><?= $guest->phone ?></td></tr>
                  <tr><td><b>Asal Instansi</b></td><td>:</td><td><?= $guest->institution ?></td></tr>
                  <tr><td><b>Keperluan</b></td><td>:</td><td><?= $guest->purpose ?></td></tr>
                  <tr><td><b>Bertemu Dengan</b></td><td>:</td><td><?= $guest->user_name ?></td></tr>
                  <tr><td><b>Ruangan</b></td><td>:</td><td><?= $guest->room_name ?></td></tr>
                  <tr><td><b>Tandatangan</b></td><td>:</td><td><img src="<?= base_url('assets/img/icon_ceklis.png') ?>" width="25px" alt=""></td></tr>
                </table>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
          </div>
        </div>
      </div>
    </div>
  <?php endforeach; ?>

</main><!-- end main -->
