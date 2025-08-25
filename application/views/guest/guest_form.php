<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Buku Tamu</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }
        .section {
            position: relative;
        }
        .jarallax {
            background-size: cover;
            background-position: center;
        }
        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }
        .bg-primary {
            background-color: #007bff;
        }
        .opacity-90 {
            opacity: 0.9;
        }
        .z-index-n1 {
            z-index: -1;
        }
        .bg-light-dark {
            background-color: #e9ecef;
        }
        .border-top {
            border-top: 1px solid #dee2e6;
        }
        .container {
            max-width: 1140px;
            margin: 0 auto;
            padding: 0 15px;
        }
        .row {
            display: flex;
            flex-wrap: wrap;
            margin: 0 -15px;
        }
        .col-lg-12 {
            flex: 0 0 100%;
            max-width: 100%;
            padding: 0 15px;
        }
        .mt-n7 {
            margin-top: -5rem;
        }
        .p-5 {
            padding: 3rem;
        }
        .rounded-3 {
            border-radius: 0.3rem;
        }
        .bg-body {
            background-color: #fff;
        }
        .shadow-sm {
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        }
        .card {
            background-color: #fff;
            border: 1px solid #ccc;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 1.5rem;
            border-radius: 8px;
            animation: fadeInScale 0.5s ease-in-out;
        }
        .card.hidden {
            display: none;
        }
        @keyframes fadeInScale {
            from {
                opacity: 0;
                transform: scale(0.8);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }
        .card-body {
            padding: 1.25rem;
        }
        #cameraPreview .card-body {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
        .text-center {
            text-align: center;
        }
        .h3 {
            font-size: 1.75rem;
        }
        .mb-4 {
            margin-bottom: 1.5rem;
        }
        .divider {
            width: 100px;
            height: 3px;
        }
        .bg-warning {
            background-color: #ffc107;
        }
        .border-warning {
            border-color: #ffc107;
        }
        .my-4 {
            margin: 1.5rem 0;
        }
        .mx-auto {
            margin-left: auto;
            margin-right: auto;
        }
        .img-fluid {
            max-width: 100%;
            height: auto;
        }
        .rounded {
            border-radius: 0.25rem;
        }
        .form-label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        .form-control {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .invalid-feedback {
            display: none;
            color: #dc3545;
            font-size: 0.875rem;
        }
        .is-invalid ~ .invalid-feedback {
            display: block;
        }
        .alert {
            padding: 1rem;
            border-radius: 0.25rem;
        }
        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        .btn {
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            border-radius: 4px;
        }
        .btn-primary {
            background-color: #007bff;
            color: white;
        }
        .btn-danger {
            background-color: #dc3545;
            color: white;
        }
        .btn-outline-secondary {
            border: 1px solid #6c757d;
            color: #6c757d;
            background-color: transparent;
        }
        .btn-outline-secondary:hover {
            background-color: #6c757d;
            color: white;
        }
        .btn-outline-primary {
            border: 1px solid #007bff;
            color: #007bff;
            background-color: transparent;
        }
        .btn-outline-primary:hover {
            background-color: #007bff;
            color: white;
        }
        .mt-2 {
            margin-top: 0.5rem;
        }
        .mt-3 {
            margin-top: 1rem;
        }
        #take-photo {
            margin-top: 1rem;
        }
        .d-flex {
            display: flex;
        }
        .flex-wrap {
            flex-wrap: wrap;
        }
        .gap-2 {
            gap: 0.5rem;
        }
        .d-grid {
            display: grid;
        }
        .py-6 {
            padding-top: 4rem;
            padding-bottom: 4rem;
        }
        .py-md-7 {
            padding-top: 5rem;
            padding-bottom: 5rem;
        }
        .pb-5 {
            padding-bottom: 3rem;
        }
        .pb-md-6 {
            padding-bottom: 4rem;
        }
        .px-5 {
            padding-left: 3rem;
            padding-right: 3rem;
        }
        #video, #photo {
            max-width: 300px;
        }
        #admin-buttons .btn {
            margin: 5px;
        }
        #micIndicator {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background-color: red;
            position: fixed;
            top: 10px;
            right: 10px;
            z-index: 1000;
            display: none;
        }
        #keyboard {
            background-color: #f8f9fa;
            border: 1px solid #ccc;
            padding: 10px;
            border-radius: 8px;
            margin-top: 1rem;
            display: none;
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
        }
        .keyboard-row {
            display: flex;
            justify-content: center;
            margin-bottom: 5px;
        }
        .key {
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 4px;
            padding: 10px;
            text-align: center;
            cursor: pointer;
            font-size: 16px;
            min-width: 40px;
            margin: 0 2px;
        }
        .key:hover {
            background-color: #e0e0e0;
        }
        .key.special {
            background-color: #6c757d;
            color: white;
            min-width: 60px;
        }
        .key.special:hover {
            background-color: #5a6268;
        }
        .key.space {
            min-width: 200px;
        }
        .keyboard-row.offset-1 {
            margin-left: 20px;
        }
        .keyboard-row.offset-2 {
            margin-left: 40px;
        }
    </style>
</head>
<body>
<main id="content">
    <div id="hero" class="section py-6 py-md-7 jarallax overflow-hidden">
        <img class="jarallax-img" src="<?php echo base_url('assets/')?>src/img-min/bg/bg-planet.jpg" alt="title">
        <div class="overlay bg-primary opacity-90 z-index-n1"></div>
    </div>
    <div id="login-area" class="section pb-5 pb-md-6 border-top bg-light-dark">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12 px-5">
                    <div class="position-relative mt-n7">
                        <div class="p-5 rounded-3 bg-body shadow-sm">
                            <div id="micIndicator"></div>
                            <h1 class="h3 mb-4 text-center">Informasi Tamu</h1>
                            <hr class="divider my-4 mx-auto bg-warning border-warning">

                            <form id="voiceForm" class="needs-validation" method="POST" action="<?= site_url('GuestController/submit_form'); ?>" enctype="multipart/form-data">
                                <!-- Preview Kamera -->
                                <div id="cameraPreview" class="card mb-4">
                                    <div class="card-body">
                                        <h5 class="card-title">Preview Kamera</h5>
                                        <video id="video" class="img-fluid rounded" autoplay></video>
                                        <button type="button" id="take-photo" class="btn btn-primary mt-2">Ambil Foto</button>
                                    </div>
                                </div>
                                <div id="photoResult" class="card mb-4 hidden">
                                    <div class="card-body text-center">
                                        <h5 class="card-title">Foto Tamu</h5>
                                        <img id="photo" src="" class="img-fluid rounded" alt="Foto Tamu">
                                    </div>
                                </div>
                                <input type="hidden" id="photoInput" name="photo" required>
                                <p id="photoError" class="alert alert-danger text-center" style="display: none;">Foto wajib diambil!</p>

                                <!-- Card Input -->
                                <div class="card mb-4 hidden" id="card-name">
                                    <div class="card-body">
                                        <label for="name" class="form-label">Nama Lengkap:</label>
                                        <input type="text" id="name" name="name" class="form-control" placeholder="Masukkan nama lengkap" required>
                                        <button type="button" class="btn btn-outline-secondary mt-2 use-voice" data-field="name">Gunakan Suara</button>
                                        <button type="button" class="btn btn-primary mt-2 next-step" data-next="card-phone">Lanjut</button>
                                        <div class="invalid-feedback">Silakan masukkan nama lengkap.</div>
                                    </div>
                                </div>
                                <div class="card mb-4 hidden" id="card-phone">
                                    <div class="card-body">
                                        <label for="phone" class="form-label">Nomor Handphone/WhatsApp:</label>
                                        <input type="text" id="phone" name="phone" class="form-control" placeholder="Masukkan nomor handphone" required>
                                        <button type="button" class="btn btn-outline-secondary mt-2 use-voice" data-field="phone">Gunakan Suara</button>
                                        <button type="button" class="btn btn-primary mt-2 next-step" data-next="card-institution">Lanjut</button>
                                        <div class="invalid-feedback">Silakan masukkan nomor handphone.</div>
                                    </div>
                                </div>
                                <div class="card mb-4 hidden" id="card-institution">
                                    <div class="card-body">
                                        <label for="institution" class="form-label">Asal Instansi/Perusahaan:</label>
                                        <input type="text" id="institution" name="institution" class="form-control" placeholder="Masukkan asal instansi" required>
                                        <button type="button" class="btn btn-outline-secondary mt-2 use-voice" data-field="institution">Gunakan Suara</button>
                                        <button type="button" class="btn btn-primary mt-2 next-step" data-next="card-admin">Lanjut</button>
                                        <div class="invalid-feedback">Silakan masukkan asal instansi.</div>
                                    </div>
                                </div>
                                <div class="card mb-4 hidden" id="card-admin">
                                    <div class="card-body">
                                        <label class="form-label">Bertemu Dengan Admin atau Staf Sekolah:</label>
                                        <div id="admin-buttons" class="d-flex flex-wrap gap-2">
                                            <?php foreach ($admins as $admin): ?>
                                                <button type="button" class="btn btn-outline-primary" data-admin-id="<?= $this->security->xss_clean($admin->id) ?>" data-room="<?= $this->security->xss_clean($admin->room_name ?? '') ?>">
                                                    <?= $this->security->xss_clean($admin->admin_name) ?>
                                                </button>
                                            <?php endforeach; ?>
                                        </div>
                                        <input type="hidden" id="admin_id" name="user_id" required>
                                        <div class="invalid-feedback">Silakan pilih admin atau staf sekolah.</div>
                                        <button type="button" class="btn btn-primary mt-2 next-step" data-next="card-purpose">Lanjut</button>
                                    </div>
                                    <div class="card-body">
                                        <label for="room_name" class="form-label">Ruangan:</label>
                                        <input type="text" id="room_name" name="room_name" class="form-control" readonly>
                                    </div>
                                </div>
                                <div class="card mb-4 hidden" id="card-purpose">
                                    <div class="card-body">
                                        <label for="purpose" class="form-label">Keperluan:</label>
                                        <textarea id="purpose" name="purpose" class="form-control" placeholder="Masukkan keperluan" required></textarea>
                                        <button type="button" class="btn btn-outline-secondary mt-2 use-voice" data-field="purpose">Gunakan Suara</button>
                                        <button type="button" class="btn btn-primary mt-2 next-step" data-next="card-signature">Lanjut</button>
                                        <div class="invalid-feedback">Silakan masukkan keperluan.</div>
                                    </div>
                                </div>
                                <div class="card mb-4 hidden" id="card-signature">
                                    <div class="card-body text-center">
                                        <label for="signature-canvas" class="form-label">Tanda Tangan:</label>
                                        <canvas id="signature-canvas" width="400" height="250" style="border: 1px solid #ccc;" class="rounded"></canvas>
                                        <div class="mt-2">
                                            <button type="button" id="clear-signature" class="btn btn-danger">Bersihkan Tanda Tangan</button>
                                        </div>
                                        <input type="hidden" id="signature-input" name="signature" required>
                                        <div class="invalid-feedback">Silakan tambahkan tanda tangan.</div>
                                    </div>
                                </div>
                                <div id="keyboard"></div>
                                <div class="d-grid mt-4">
                                    <button type="submit" id="submit-form" class="btn btn-primary hidden">Submit Form</button>
                                    <a href="<?php echo base_url('')?>" class="btn btn-secondary">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="2rem" height="2rem" fill="currentColor" viewBox="0 0 512 512">
                                            <polyline points="328 112 184 256 328 400" style="fill:none;stroke:currentColor;stroke-linecap:round;stroke-linejoin:round;stroke-width:48px"/>
                                        </svg> Kembali ke halaman utama
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/jarallax@2.0.0/dist/jarallax.min.js"></script>
    <script>
        const canvas = document.getElementById('signature-canvas');
        const signaturePad = new SignaturePad(canvas);
        document.getElementById('clear-signature').addEventListener('click', () => {
            signaturePad.clear();
        });

        const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
        let recognition;
        if (SpeechRecognition) {
            recognition = new SpeechRecognition();
            recognition.lang = 'id-ID';
            recognition.interimResults = false;
            recognition.maxAlternatives = 1;
        } else {
            Swal.fire({
                icon: 'warning',
                title: 'Browser Tidak Mendukung',
                text: 'Browser Anda tidak mendukung pengenalan suara. Gunakan keyboard virtual.',
                showConfirmButton: false,
                timer: 5000
            });
        }

        let stream = null;
        const video = document.getElementById('video');
        const photo = document.getElementById('photo');
        const photoInput = document.getElementById('photoInput');
        const canvasCamera = document.createElement('canvas');
        let currentInput = null;
        let isShiftActive = false;
        let isSymbolMode = false;

        const qwertyLayout = [
            ['1', '2', '3', '4', '5', '6', '7', '8', '9', '0', '-', '='],
            ['q', 'w', 'e', 'r', 't', 'y', 'u', 'i', 'o', 'p'],
            ['a', 's', 'd', 'f', 'g', 'h', 'j', 'k', 'l'],
            ['z', 'x', 'c', 'v', 'b', 'n', 'm'],
            ['shift', 'space', 'backspace', 'enter']
        ];
        const symbolLayout = [
            ['!', '@', '#', '$', '%', '^', '&', '*', '(', ')', '_', '+'],
            ['q', 'w', 'e', 'r', 't', 'y', 'u', 'i', 'o', 'p'],
            ['a', 's', 'd', 'f', 'g', 'h', 'j', 'k', 'l'],
            ['z', 'x', 'c', 'v', 'b', 'n', 'm'],
            ['shift', 'space', 'backspace', 'enter']
        ];

        function createKeyboard() {
            const keyboard = document.getElementById('keyboard');
            keyboard.innerHTML = ''; // Bersihkan keyboard sebelumnya
            const layout = isSymbolMode ? symbolLayout : qwertyLayout;
            layout.forEach((row, index) => {
                const rowDiv = document.createElement('div');
                rowDiv.className = 'keyboard-row' + (index === 1 ? ' offset-1' : index === 2 ? ' offset-2' : '');
                row.forEach(key => {
                    const keyElement = document.createElement('div');
                    keyElement.className = 'key keyboard-key' + (key === 'shift' || key === 'backspace' || key === 'enter' ? ' special' : key === 'space' ? ' special space' : '');
                    keyElement.textContent = key === 'space' ? 'Spasi' : key === 'backspace' ? '⌫' : key === 'enter' ? 'Enter' : isShiftActive && !isSymbolMode && key.length === 1 && /[a-z]/.test(key) ? key.toUpperCase() : key;
                    keyElement.addEventListener('click', () => handleKeyPress(key));
                    rowDiv.appendChild(keyElement);
                });
                keyboard.appendChild(rowDiv);
            });
        }

        function updateKeyboard() {
            createKeyboard(); // Panggil ulang createKeyboard untuk memperbarui tampilan
        }

        function handleKeyPress(key) {
            if (!currentInput) return;
            const input = currentInput;
            if (key === 'shift') {
                if (!isSymbolMode) {
                    isShiftActive = !isShiftActive; // Toggle huruf besar/kecil
                } else {
                    isSymbolMode = false; // Kembali ke huruf kecil dari simbol
                    isShiftActive = false;
                }
                updateKeyboard();
            } else if (key === 'backspace') {
                input.value = input.value.slice(0, -1);
            } else if (key === 'space') {
                input.value += ' ';
            } else if (key === 'enter') {
                hideKeyboard();
                input.dispatchEvent(new Event('change')); // Trigger validasi
            } else {
                const char = isShiftActive && !isSymbolMode && key.length === 1 && /[a-z]/.test(key) ? key.toUpperCase() : key;
                input.value += char;
                // Reset simbol setelah input angka/simbol, kecuali untuk huruf
                if (isSymbolMode && key !== 'space' && key !== 'backspace' && key !== 'enter') {
                    isSymbolMode = false;
                    isShiftActive = false;
                    updateKeyboard();
                }
            }
            input.focus(); // Pertahankan fokus pada input
        }

        function showKeyboard(input) {
            currentInput = input;
            document.getElementById('keyboard').style.display = 'block';
            createKeyboard(); // Pastikan keyboard dibuat ulang dengan state terkini
            input.focus();
        }

        function hideKeyboard() {
            document.getElementById('keyboard').style.display = 'none';
            currentInput = null;
            isShiftActive = false;
            isSymbolMode = false;
        }

        // Deteksi klik di luar input dan keyboard
        document.addEventListener('click', (event) => {
            const keyboard = document.getElementById('keyboard');
            const inputs = ['name', 'phone', 'institution', 'purpose'].map(id => document.getElementById(id));
            const isKeyboardKey = event.target.classList.contains('keyboard-key');
            if (!inputs.includes(event.target) && !isKeyboardKey && !keyboard.contains(event.target)) {
                hideKeyboard();
            }
        });

        function speak(text, onEndCallback) {
            const utterance = new SpeechSynthesisUtterance(text);
            utterance.lang = 'id-ID';
            utterance.onend = onEndCallback;
            speechSynthesis.speak(utterance);
        }

        async function startCamera() {
            try {
                stream = await navigator.mediaDevices.getUserMedia({ video: true });
                video.srcObject = stream;
                document.getElementById('cameraPreview').classList.remove('hidden');
            } catch (err) {
                Swal.fire({
                    icon: 'error',
                    title: 'Kesalahan Kamera',
                    text: 'Gagal mengakses kamera. Silakan coba kembali.',
                    showConfirmButton: false,
                    timer: 5000
                });
            }
        }

        function stopCamera() {
            if (stream) {
                stream.getTracks().forEach(track => track.stop());
                video.srcObject = null;
                document.getElementById('cameraPreview').classList.add('hidden');
            }
        }

        function takePhoto() {
            canvasCamera.width = video.videoWidth;
            canvasCamera.height = video.videoHeight;
            canvasCamera.getContext('2d').drawImage(video, 0, 0);
            const photoData = canvasCamera.toDataURL('image/png');
            photo.src = photoData;
            photoInput.value = photoData;
            document.getElementById('photoResult').classList.remove('hidden');
            stopCamera();
            document.getElementById('cameraPreview').classList.add('hidden');
            document.getElementById('card-name').classList.remove('hidden');
        }

        function startVoiceInputForField(fieldId) {
            if (!recognition) return;
            const fieldPrompts = {
                'name': 'Silakan ucapkan nama lengkap Anda.',
                'phone': 'Silakan ucapkan nomor handphone Anda.',
                'institution': 'Silakan ucapkan asal instansi Anda.',
                'purpose': 'Silakan ucapkan keperluan Anda.'
            };
            speak(fieldPrompts[fieldId], () => {
                document.getElementById('micIndicator').style.display = 'block';
                document.getElementById('micIndicator').style.backgroundColor = 'green';
                recognition.start();
                let timeoutId = setTimeout(() => {
                    document.getElementById('micIndicator').style.display = 'none';
                    Swal.fire({
                        icon: 'info',
                        title: 'Tidak Ada Tanggapan',
                        text: 'Mohon coba kembali atau gunakan keyboard virtual.',
                        showConfirmButton: false,
                        timer: 5000
                    });
                }, 10000);
                recognition.onresult = function(event) {
                    clearTimeout(timeoutId);
                    document.getElementById(fieldId).value = event.results[0][0].transcript;
                    document.getElementById('micIndicator').style.display = 'none';
                    recognition.stop();
                    document.getElementById(fieldId).dispatchEvent(new Event('change'));
                };
                recognition.onerror = function(event) {
                    clearTimeout(timeoutId);
                    document.getElementById('micIndicator').style.display = 'none';
                    Swal.fire({
                        icon: 'error',
                        title: 'Kesalahan',
                        text: 'Terjadi kesalahan: ' + event.error,
                        showConfirmButton: false,
                        timer: 5000
                    });
                };
                recognition.onend = function() {
                    clearTimeout(timeoutId);
                    document.getElementById('micIndicator').style.display = 'none';
                };
            });
        }

        function submitForm(e) {
            e.preventDefault();
            if (!photoInput.value) {
                document.getElementById('photoError').style.display = 'block';
                Swal.fire({
                    icon: 'info',
                    title: 'Foto Belum Diambil',
                    text: 'Mohon ambil foto terlebih dahulu.',
                    showConfirmButton: false,
                    timer: 5000
                });
                return;
            }
            if (signaturePad.isEmpty()) {
                Swal.fire({
                    icon: 'info',
                    title: 'Tanda Tangan Belum Diberikan',
                    text: 'Mohon berikan tanda tangan Anda.',
                    showConfirmButton: false,
                    timer: 5000
                });
                return;
            }
            document.getElementById('signature-input').value = signaturePad.toDataURL('image/png');
            const form = document.getElementById('voiceForm');
            const formData = new FormData(form);
            $.ajax({
                url: form.action,
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function() {
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
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: 'Gagal menyimpan data. Mohon coba kembali.',
                        showConfirmButton: false,
                        timer: 5000
                    });
                }
            });
        }

        function showNextCard(currentCardId, nextCardId) {
            const currentCard = document.getElementById(currentCardId);
            const nextCard = document.getElementById(nextCardId);
            if (currentCardId.includes('name') && !document.getElementById('name').value) {
                document.getElementById('name').classList.add('is-invalid');
                return;
            }
            if (currentCardId.includes('phone') && !document.getElementById('phone').value) {
                document.getElementById('phone').classList.add('is-invalid');
                return;
            }
            if (currentCardId.includes('institution') && !document.getElementById('institution').value) {
                document.getElementById('institution').classList.add('is-invalid');
                return;
            }
            if (currentCardId.includes('admin') && !document.getElementById('admin_id').value) {
                document.getElementById('admin_id').classList.add('is-invalid');
                return;
            }
            if (currentCardId.includes('purpose') && !document.getElementById('purpose').value) {
                document.getElementById('purpose').classList.add('is-invalid');
                return;
            }
            currentCard.classList.add('hidden');
            nextCard.classList.remove('hidden');
            if (nextCardId === 'card-signature') {
                document.getElementById('submit-form').classList.remove('hidden');
            }
        }

        $(document).ready(function() {
            // Sembunyikan semua card kecuali cameraPreview
            ['card-name', 'card-phone', 'card-institution', 'card-admin', 'card-purpose', 'card-signature'].forEach(id => {
                document.getElementById(id).classList.add('hidden');
            });
            // Start kamera
            startCamera();
            document.getElementById('take-photo').addEventListener('click', takePhoto);
            // Submit form
            document.getElementById('voiceForm').addEventListener('submit', submitForm);
            // Admin buttons
            document.querySelectorAll('#admin-buttons .btn').forEach(button => {
                button.onclick = () => {
                    const adminId = button.getAttribute('data-admin-id');
                    const roomName = button.getAttribute('data-room');
                    document.getElementById('admin_id').value = adminId;
                    document.getElementById('room_name').value = roomName;
                    document.getElementById('admin_id').classList.remove('is-invalid');
                };
            });
            // Keyboard virtual
            createKeyboard();
            ['name', 'phone', 'institution', 'purpose'].forEach(id => {
                const input = document.getElementById(id);
                input.addEventListener('focus', () => showKeyboard(input));
                input.addEventListener('change', () => {
                    input.classList.remove('is-invalid');
                });
            });
            // Voice input dengan pemandu
            document.querySelectorAll('.use-voice').forEach(button => {
                button.addEventListener('click', () => {
                    const field = button.getAttribute('data-field');
                    startVoiceInputForField(field);
                });
            });
            // Tombol Lanjut
            document.querySelectorAll('.next-step').forEach(button => {
                button.addEventListener('click', () => {
                    const currentCardId = button.closest('.card').id;
                    const nextCardId = button.getAttribute('data-next');
                    showNextCard(currentCardId, nextCardId);
                });
            });
        });
    </script>
</main>
</body>
</html>
