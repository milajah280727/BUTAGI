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

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="https://unpkg.com/html5-qrcode@2.3.8/html5-qrcode.min.js"></script>

<script>
    // Global variables
    let html5QrCode = null;
    let isScanning = false;
    let scanCount = 0;
    let lastScannedCode = '';
    let lastScannedTime = 0;

    // Safe DOM element getter with error handling
    function safeGetElement(id, context = 'Getting element') {
        const element = document.getElementById(id);
        if (!element) {
            debugLog(`⚠️ Warning: Element with ID '${id}' not found in ${context}`);
            return null;
        }
        return element;
    }

    // Debug function with enhanced error handling
    function debugLog(message) {
        let el = document.getElementById("debug-content");
        if (el) {
            el.innerHTML += message + "<br>";
        } else {
            console.log(message); // fallback ke console
        }
    }

    // Enhanced status update function with safety checks
    function updateStatus(message, type = 'info') {
        const statusDiv = safeGetElement('scan-status');
        if (!statusDiv) {
            debugLog(`❌ Cannot update status: scan-status element not found`);
            return;
        }
        
        statusDiv.style.display = 'block';
        statusDiv.textContent = message;
        
        const styles = {
            success: { bg: '#d4edda', color: '#155724', border: '1px solid #c3e6cb' },
            error: { bg: '#f8d7da', color: '#721c24', border: '1px solid #f5c6cb' },
            info: { bg: '#d1ecf1', color: '#0c5460', border: '1px solid #bee5eb' },
            warning: { bg: '#fff3cd', color: '#856404', border: '1px solid #ffeaa7' }
        };
        
        const style = styles[type] || styles.info;
        statusDiv.style.backgroundColor = style.bg;
        statusDiv.style.color = style.color;
        statusDiv.style.border = style.border;
        
        debugLog(`Status: ${message} (${type})`);
    }

    function hideStatus() {
        const statusDiv = safeGetElement('scan-status');
        if (statusDiv) {
            statusDiv.style.display = 'none';
        }
    }

    // Enhanced initialization with better error handling
    document.addEventListener('DOMContentLoaded', function () {
        debugLog('=== PAGE LOADED - INITIALIZING QR SCANNER ===');
        
        const criticalElements = ['scan-qr', 'scan-status', 'qr-reader-container', 'qr-reader', 'debug-info', 'debug-content'];
        let missingCritical = [];
        criticalElements.forEach(id => {
            if (!document.getElementById(id)) {
                missingCritical.push(id);
            }
        });
        
        if (missingCritical.length > 0) {
            console.error('❌ Missing critical DOM elements:', missingCritical);
            debugLog('❌ Missing critical elements: ' + missingCritical.join(', '));
            return;
        }
        
        debugLog('✅ All critical DOM elements found');
        
        const optionalElements = ['scan-line'];
        optionalElements.forEach(id => {
            if (!document.getElementById(id)) {
                debugLog(`⚠️ Optional element missing: ${id}`);
            }
        });
        
        if (navigator.permissions) {
            navigator.permissions.query({name: 'camera'}).then(function(result) {
                debugLog('Camera permission: ' + result.state);
            }).catch(err => {
                debugLog('Cannot check camera permission: ' + err.message);
            });
        }
        
        const scanButton = safeGetElement('scan-qr');
        if (scanButton) {
            scanButton.addEventListener('click', handleScanClick);
            debugLog('✅ Event listener added to scan button');
        } else {
            debugLog('❌ Failed to add event listener: scan button not found');
        }
    });

    function handleScanClick() {
        const button = safeGetElement('scan-qr');
        if (!button) {
            debugLog('❌ Scan button not found in handleScanClick');
            return;
        }
        
        if (isScanning) {
            stopScanner();
            return;
        }
        
        startScanner();
    }

    function startScanner() {
        const button = safeGetElement('scan-qr');
        if (!button) {
            debugLog('❌ Cannot start scanner: scan button not found');
            return;
        }
        
        debugLog('=== STARTING QR SCANNER ===');
        updateStatus('Meminta akses kamera...', 'info');
        button.textContent = 'Menginisialisasi...';
        button.disabled = true;
        
        const qrReaderElement = safeGetElement('qr-reader');
        if (!qrReaderElement) {
            debugLog('❌ QR reader element not found');
            updateStatus('Error: QR reader element tidak ditemukan', 'error');
            button.textContent = 'Scan QR Tamu';
            button.disabled = false;
            return;
        }
        
        try {
            html5QrCode = new Html5Qrcode("qr-reader");
            
            Html5Qrcode.getCameras().then(devices => {
                debugLog(`Found ${devices.length} camera(s)`);
                
                if (devices && devices.length > 0) {
                    let cameraId = devices[0].id;
                    let cameraName = devices[0].label || 'Default Camera';
                    
                    for (let device of devices) {
                        const label = device.label.toLowerCase();
                        if (label.includes('back') || label.includes('rear') || label.includes('environment')) {
                            cameraId = device.id;
                            cameraName = device.label;
                            debugLog(`Using back camera: ${cameraName}`);
                            break;
                        }
                    }
                    
                    updateStatus(`Memulai kamera: ${cameraName}`, 'info');
                    
                    const config = {
                        fps: 10,
                        qrbox: { width: 250, height: 250 },
                        aspectRatio: 1.0,
                        disableFlip: false
                    };
                    
                    debugLog('Scanner config: ' + JSON.stringify(config));
                    
                    html5QrCode.start(
                        cameraId,
                        config,
                        onScanSuccess,
                        onScanFailure
                    ).then(() => {
                        debugLog('✅ Scanner started successfully');
                        
                        const qrReaderContainer = safeGetElement('qr-reader-container');
                        const scanLine = safeGetElement('scan-line');
                        
                        if (qrReaderContainer) {
                            qrReaderContainer.style.display = 'block';
                            document.body.classList.add('blur-active');
                            setTimeout(() => qrReaderContainer.classList.add('active'), 10); // Smooth fade-in
                        }
                        if (scanLine) {
                            scanLine.style.display = 'block';
                        }
                        
                        button.textContent = 'Berhenti Scan';
                        button.className = 'btn btn-danger';
                        button.disabled = false;
                        isScanning = true;
                        
                        updateStatus('Scanner aktif - arahkan QR code ke kamera', 'success');
                        setTimeout(() => {
                            if (isScanning) hideStatus();
                        }, 3000);
                        
                    }).catch(err => {
                        debugLog('❌ Error starting scanner: ' + err.message);
                        updateStatus('Gagal memulai scanner: ' + err.message, 'error');
                        
                        button.textContent = 'Scan QR Tamu';
                        button.className = 'btn btn-secondary';
                        button.disabled = false;
                        
                        html5QrCode = null;
                    });
                    
                } else {
                    debugLog('No cameras found');
                    updateStatus('Tidak ada kamera yang ditemukan', 'error');
                    button.textContent = 'Scan QR Tamu';
                    button.disabled = false;
                    html5QrCode = null;
                }
                
            }).catch(err => {
                debugLog('❌ Error accessing cameras: ' + err.message);
                updateStatus('Tidak dapat mengakses kamera: ' + err.message, 'error');
                
                button.textContent = 'Scan QR Tamu';
                button.disabled = false;
                html5QrCode = null;
            });
            
        } catch (err) {
            debugLog('❌ Exception in startScanner: ' + err.message);
            updateStatus('Error dalam inisialisasi: ' + err.message, 'error');
            
            button.textContent = 'Scan QR Tamu';
            button.disabled = false;
            html5QrCode = null;
        }
    }

    function stopScanner() {
        const button = safeGetElement('scan-qr');
        if (!button) {
            debugLog('❌ Cannot stop scanner: scan button not found');
            return;
        }
        
        debugLog('=== STOPPING SCANNER ===');
        updateStatus('Menghentikan scanner...', 'info');
        
        if (html5QrCode) {
            html5QrCode.stop().then(() => {
                debugLog('✅ Scanner stopped successfully');
                
                const qrReaderContainer = safeGetElement('qr-reader-container');
                const scanLine = safeGetElement('scan-line');
                
                if (qrReaderContainer) {
                    qrReaderContainer.classList.remove('active');
                    document.body.classList.remove('blur-active');
                    setTimeout(() => qrReaderContainer.style.display = 'none', 300); // Smooth fade-out
                }
                if (scanLine) {
                    scanLine.style.display = 'none';
                }
                
                button.textContent = 'Scan QR Tamu';
                button.className = 'btn btn-secondary';
                button.disabled = false;
                isScanning = false;
                hideStatus();
                
                html5QrCode = null;
                
            }).catch(err => {
                debugLog('❌ Error stopping scanner: ' + err.message);
                updateStatus('Error menghentikan scanner: ' + err.message, 'error');
                
                const qrReaderContainer = safeGetElement('qr-reader-container');
                const scanLine = safeGetElement('scan-line');
                
                if (qrReaderContainer) {
                    qrReaderContainer.classList.remove('active');
                    document.body.classList.remove('blur-active');
                    setTimeout(() => qrReaderContainer.style.display = 'none', 300);
                }
                if (scanLine) {
                    scanLine.style.display = 'none';
                }
                
                button.textContent = 'Scan QR Tamu';
                button.className = 'btn btn-secondary';
                button.disabled = false;
                isScanning = false;
                html5QrCode = null;
            });
        } else {
            debugLog('⚠️ No scanner instance to stop');
            const qrReaderContainer = safeGetElement('qr-reader-container');
            const scanLine = safeGetElement('scan-line');
            
            if (qrReaderContainer) {
                qrReaderContainer.classList.remove('active');
                document.body.classList.remove('blur-active');
                setTimeout(() => qrReaderContainer.style.display = 'none', 300);
            }
            if (scanLine) {
                scanLine.style.display = 'none';
            }
            
            button.textContent = 'Scan QR Tamu';
            button.className = 'btn btn-secondary';
            button.disabled = false;
            isScanning = false;
            hideStatus();
        }
    }

    function onScanSuccess(decodedText, decodedResult) {
        const currentTime = Date.now();
        
        if (decodedText === lastScannedCode && (currentTime - lastScannedTime) < 2000) {
            debugLog('Duplicate scan ignored: ' + decodedText);
            return;
        }
        
        scanCount++;
        lastScannedCode = decodedText;
        lastScannedTime = currentTime;
        
        debugLog(`=== QR CODE DETECTED #${scanCount} ===`);
        debugLog('QR Content: ' + decodedText);
        debugLog('Scan Result: ' + JSON.stringify(decodedResult));
        
        updateStatus('QR Code terdeteksi! Memproses...', 'success');
        
        if (html5QrCode) {
            html5QrCode.stop().then(() => {
                debugLog('✅ Scanner stopped after successful scan');
                
                const qrReaderContainer = safeGetElement('qr-reader-container');
                const scanLine = safeGetElement('scan-line');
                const button = safeGetElement('scan-qr');
                
                if (qrReaderContainer) {
                    qrReaderContainer.classList.remove('active');
                    document.body.classList.remove('blur-active');
                    setTimeout(() => qrReaderContainer.style.display = 'none', 300);
                }
                if (scanLine) {
                    scanLine.style.display = 'none';
                }
                if (button) {
                    button.textContent = 'Scan QR Tamu';
                    button.className = 'btn btn-secondary';
                    button.disabled = false;
                }
                
                isScanning = false;
                html5QrCode = null;
                
                processQRCode(decodedText);
                
            }).catch(err => {
                debugLog('❌ Error stopping after scan: ' + err.message);
                updateStatus('Error menghentikan setelah scan: ' + err.message, 'error');
                
                const qrReaderContainer = safeGetElement('qr-reader-container');
                const scanLine = safeGetElement('scan-line');
                const button = safeGetElement('scan-qr');
                
                if (qrReaderContainer) {
                    qrReaderContainer.classList.remove('active');
                    document.body.classList.remove('blur-active');
                    setTimeout(() => qrReaderContainer.style.display = 'none', 300);
                }
                if (scanLine) {
                    scanLine.style.display = 'none';
                }
                if (button) {
                    button.textContent = 'Scan QR Tamu';
                    button.className = 'btn btn-secondary';
                    button.disabled = false;
                }
                
                isScanning = false;
                html5QrCode = null;
                
                processQRCode(decodedText);
            }).catch(err => {
                debugLog('❌ Error stopping after scan: ' + err.message);
                updateStatus('Error menghentikan setelah scan: ' + err.message, 'error');
                
                const qrReaderContainer = safeGetElement('qr-reader-container');
                const scanLine = safeGetElement('scan-line');
                const button = safeGetElement('scan-qr');
                
                if (qrReaderContainer) {
                    qrReaderContainer.classList.remove('active');
                    document.body.classList.remove('blur-active');
                    setTimeout(() => qrReaderContainer.style.display = 'none', 300);
                }
                if (scanLine) {
                    scanLine.style.display = 'none';
                }
                if (button) {
                    button.textContent = 'Scan QR Tamu';
                    button.className = 'btn btn-secondary';
                    button.disabled = false;
                }
                
                isScanning = false;
                html5QrCode = null;
                
                processQRCode(decodedText);
            });
        } else {
            debugLog('⚠️ No scanner instance to stop, processing QR directly');
            isScanning = false;
            processQRCode(decodedText);
        }
    }

    // Scan failure callback (normal during scanning)
    function onScanFailure(error) {
        // This is called when no QR code is found - it's normal
        // We don't need to log every failure as it happens frequently
    }

    // Enhanced process QR Code function with proper URL handling
    function processQRCode(qrContent) {
        debugLog('=== PROCESSING QR CODE ===');
        debugLog('QR Content: ' + qrContent);
        
        updateStatus('Mengirim data ke server...', 'info');
        
        // Extract ID from URL if it's a full URL
        let processedContent = qrContent;
        if (qrContent.includes('http://localhost/butagi-mainn/event/scan/')) {
            const parts = qrContent.split('/');
            processedContent = parts[parts.length - 1]; // Get the ID part
            debugLog('Extracted ID from URL: ' + processedContent);
        } else if (qrContent.includes('http://butagi.test/event/scan/')) {
            const parts = qrContent.split('/');
            processedContent = parts[parts.length - 1]; // Get the ID part
            debugLog('Extracted ID from URL: ' + processedContent);
        }
        
        // Build URL dengan struktur CodeIgniter yang benar
        const baseUrl = window.location.origin;
        
        let possibleUrls = [
            `http://localhost/butagi-mainn/event/scan?qr=${encodeURIComponent(processedContent)}`,
            `${baseUrl}/butagi-mainn/event/scan?qr=${encodeURIComponent(processedContent)}`,
            `${baseUrl}/butagi-mainn/index.php/event/scan?qr=${encodeURIComponent(processedContent)}`,
            `http://localhost/butagi-mainn/index.php/event/scan?qr=${encodeURIComponent(processedContent)}`,
            `http://butagi.test/event/scan?qr=${encodeURIComponent(processedContent)}`,
            `http://butagi.test/index.php/event/scan?qr=${encodeURIComponent(processedContent)}`
        ];
        
        debugLog('Trying multiple URL patterns...');
        
        function tryUrls(urls, index = 0) {
            if (index >= urls.length) {
                debugLog('❌ All URL patterns failed');
                updateStatus('Error: Tidak dapat menemukan endpoint server', 'error');
                return;
            }
            
            const url = urls[index];
            debugLog(`Trying URL ${index + 1}/${urls.length}: ${url}`);
            
            fetch(url, { 
                method: 'GET',
                cache: 'no-store',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                }
            })
            .then(response => {
                debugLog(`URL ${index + 1} - Response status: ${response.status}`);
                
                if (response.status === 404) {
                    debugLog(`URL ${index + 1} returned 404, trying next...`);
                    tryUrls(urls, index + 1);
                    return null;
                }
                
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                
                debugLog(`✅ URL ${index + 1} successful: ${url}`);
                return response.text();
            })
            .then(text => {
                if (text === null) return;
                
                debugLog('Raw response: ' + text.substring(0, 500) + (text.length > 500 ? '...' : ''));
                
                if (text.trim().toLowerCase().startsWith('<!doctype html') || text.trim().toLowerCase().startsWith('<html')) {
                    debugLog(`URL ${index + 1} returned HTML page (likely error page), trying next...`);
                    tryUrls(urls, index + 1);
                    return;
                }
                
                let data;
                try {
                    data = JSON.parse(text);
                } catch (e) {
                    debugLog('JSON parse error: ' + e.message);
                    debugLog('Response appears to be: ' + (text.includes('<html') ? 'HTML page' : 'Invalid JSON'));
                    
                    if (index === urls.length - 1) {
                        throw new Error('Invalid JSON response from server. All URLs tried. Last response was: ' + text.substring(0, 200));
                    } else {
                        tryUrls(urls, index + 1);
                        return;
                    }
                }
                
                debugLog('Parsed response: ' + JSON.stringify(data));
                hideStatus();
                
                if (data.error) {
                    updateStatus('Error: ' + data.error, 'error');
                } else if (data.success && data.nama) {
                    updateStatus('Berhasil: ' + data.nama, 'success');
                    Swal.fire({
                        icon: 'success',
                        title: data.nama + ' - Terima kasih atas kunjungan Anda pertemuan ini orang tua murid di SMKN 1 Subang',
                        imageUrl: "<?= base_url('assets/img/thanks.png') ?>",
                        imageWidth: 200,
                        imageHeight: 200,
                        showConfirmButton: false,
                        timer: 5000
                    }).then(() => {
                        window.location.href = '<?= base_url() ?>';
                    });
                } else if (data.success) {
                    updateStatus('Berhasil diproses', 'success');
                    Swal.fire({
                        icon: 'success',
                        title: 'Terima kasih atas kunjungan Anda di SMKN 1 Subang',
                        imageUrl: "<?= base_url('assets/img/thanks.png') ?>",
                        imageWidth: 200,
                        imageHeight: 200,
                        showConfirmButton: false,
                        timer: 5000
                    }).then(() => {
                        window.location.href = '<?= base_url() ?>';
                    });
                } else {
                    updateStatus('Response tidak valid', 'warning');
                }
            })
            .catch(error => {
                debugLog(`URL ${index + 1} - Fetch error: ${error.message}`);
                
                if (error.message.includes('404')) {
                    tryUrls(urls, index + 1);
                } else {
                    updateStatus('Terjadi kesalahan: ' + error.message, 'error');
                }
            });
        }
        
        tryUrls(possibleUrls);
    }

    // Enhanced test function - HANYA UNTUK DEBUGGING
    function testQRProcess() {
        debugLog('=== TESTING QR PROCESS (DEBUGGING ONLY) ===');
        updateStatus('Testing QR process dengan ID dummy...', 'warning');
        
        if (!confirm('⚠️ Ini adalah fungsi test untuk debugging.\nApakah Anda yakin ingin melanjutkan?\n\n(Tombol ini harus dihapus setelah sistem bekerja dengan baik)')) {
            return;
        }
        
        processQRCode('3'); // Test dengan ID langsung
    }

    // Function untuk test koneksi ke berbagai endpoint
    function testEndpoints() {
        debugLog('=== TESTING ALL ENDPOINTS ===');
        
        const testUrls = [
            'http://localhost/BUTAGI/event/scan?qr=3',
            'http://localhost/BUTAGI/index.php/event/scan?qr=3',
            window.location.origin + '/BUTAGI/event/scan?qr=3',
            window.location.origin + '/BUTAGI/index.php/event/scan?qr=3',
            'http://butagi.test/event/scan?qr=3'
        ];
        
        testUrls.forEach((url, index) => {
            setTimeout(() => {
                fetch(url)
                    .then(response => {
                        debugLog(`Test URL ${index + 1}: ${response.status} - ${url}`);
                        return response.text();
                    })
                    .then(text => {
                        debugLog(`Test URL ${index + 1} Response: ${text.substring(0, 100)}...`);
                    })
                    .catch(err => {
                        debugLog(`Test URL ${index + 1}: ERROR - ${err.message} - ${url}`);
                    });
            }, index * 500);
        });
    }

    // Function untuk notifikasi kustom (opsional, tetap ada)
    function showNotification(message, type) {
        const notification = safeGetElement('custom-notification');
        const messageDiv = safeGetElement('notification-message');
        if (notification && messageDiv) {
            notification.className = `notification ${type}`;
            messageDiv.textContent = message;
            notification.style.display = 'block';
            setTimeout(hideNotification, 4000);
        }
    }

    function hideNotification() {
        const notification = safeGetElement('custom-notification');
        if (notification) {
            notification.style.display = 'none';
        }
    }

    // Inisialisasi Swiper
    const swiper = new Swiper('.swiper-container', {
        slidesPerView: 1,
        spaceBetween: 20,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        breakpoints: {
            640: {
                slidesPerView: 1,
                spaceBetween: 20,
            },
            768: {
                slidesPerView: 2,
                spaceBetween: 30,
            },
            1024: {
                slidesPerView: 3,
                spaceBetween: 40,
            },
        },
    });
</script>
