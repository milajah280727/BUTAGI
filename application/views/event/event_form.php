<div class="container">
    <h2 class="event-title">Isi Biodata untuk <?= $event->nama_event; ?></h2>
    <form method="post" action="<?= site_url('event/submit_form'); ?>" class="butagi-form">
        <input type="hidden" name="kode_event" value="<?= $event->kode_event; ?>">
        <div class="form-group">
            <label for="nama" class="form-label">
                <i class="fas fa-user"></i> Nama
            </label>
            <input type="text" name="nama" id="nama" class="form-control" placeholder="Masukkan nama Anda" required>
        </div>
        <div class="form-group">
            <label for="no_hp" class="form-label">
                <i class="fas fa-phone"></i> No HP
            </label>
            <input type="tel" name="no_hp" id="no_hp" class="form-control" placeholder="Contoh: 081234567890" required>
        </div>
        <div class="form-group">
            <label for="hubungan" class="form-label">
                <i class="fas fa-link"></i> Hubungan (opsional)
            </label>
            <input type="text" name="hubungan" id="hubungan" class="form-control" placeholder="Misalnya: Kolega, Tamu">
        </div>
        <button type="submit" class="btn btn-primary">Submit & Dapat QR <i class="fas fa-qrcode"></i></button>
    </form>
</div>

<style>
    /* Palet warna Butagi (modern dan institusi) */
    :root {
        --primary-color: #003087; /* Biru tua */
        --secondary-color: #FFC107; /* Kuning aksen */
        --accent-color: #28a745; /* Hijau untuk konfirmasi */
        --background-color: #f8f9fa;
        --text-color: #333;
    }

    .container {
        max-width: 500px;
        margin: 40px auto;
        padding: 30px;
        background: linear-gradient(135deg, #ffffff 0%, #f0f2f5 100%);
        border-radius: 15px;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        position: relative;
        overflow: hidden;
    }

    .event-title {
        font-size: 1.8rem;
        color: var(--primary-color);
        text-align: center;
        margin-bottom: 25px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .butagi-form {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .form-group {
        position: relative;
    }

    .form-label {
        display: flex;
        align-items: center;
        font-weight: 500;
        color: var(--text-color);
        margin-bottom: 8px;
        font-size: 1.1rem;
    }

    .form-label i {
        margin-right: 8px;
        color: var(--primary-color);
    }

    .form-control {
        width: 100%;
        padding: 12px 15px 12px 40px;
        border: 2px solid #e9ecef;
        border-radius: 8px;
        font-size: 1rem;
        background: #fff;
        transition: all 0.3s ease;
        position: relative;
    }

    .form-control:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 10px rgba(0, 48, 135, 0.2);
        background: #f8f9fa;
    }

    .form-control::placeholder {
        color: #6c757d;
        opacity: 0.8;
    }

    .btn-primary {
        background: linear-gradient(45deg, var(--primary-color), #001f5f);
        color: #fff;
        padding: 12px 25px;
        border: none;
        border-radius: 8px;
        font-size: 1.1rem;
        font-weight: 600;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 48, 135, 0.3);
    }

    .btn-primary i {
        font-size: 1.2rem;
    }

    /* Animasi dekorasi modern */
    .container::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, var(--secondary-color) 0%, transparent 70%);
        opacity: 0.1;
        animation: rotate 15s linear infinite;
        z-index: -1;
    }

    @keyframes rotate {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    /* Responsif untuk Mobile */
    @media (max-width: 768px) {
        .container {
            margin: 20px;
            padding: 20px;
            width: 90%;
        }

        .event-title {
            font-size: 1.5rem;
        }

        .form-label {
            font-size: 1rem;
        }

        .form-control {
            font-size: 0.9rem;
            padding: 10px 15px 10px 35px;
        }

        .btn-primary {
            font-size: 1rem;
            padding: 10px 20px;
        }
    }
</style>

<!-- Font Awesome untuk ikon -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">