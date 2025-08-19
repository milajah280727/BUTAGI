	<!DOCTYPE html>
	<html lang="id">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Form Input Suara dengan Card Transisi</title>
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
				display: none;
				background-color: #fff;
				border: 1px solid #ccc;
				box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
				margin-bottom: 1.5rem;
				border-radius: 8px;
				animation: fadeInScale 0.5s ease-in-out;
			}
			.card.active {
				display: block;
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
			.btn-secondary {
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
			.btn-outline-secondary {
				border: 1px solid #6c757d;
				color: #6c757d;
				background-color: transparent;
			}
			.btn-outline-secondary:hover {
				background-color: #6c757d;
				color: white;
			}
			.mt-2 {
				margin-top: 0.5rem;
			}
			.mt-3 {
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
			#status {
				margin-top: 1rem;
				color: #333;
				font-size: 1rem;
			}
			#keyboard {
				background-color: #f9f9f9;
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
			}
			#keyboardKeys {
				display: grid;
				grid-template-columns: repeat(10, 1fr);
				gap: 5px;
				max-width: 600px;
				margin: 0 auto;
			}
			#keyboardKeys .btn {
				padding: 10px;
				text-align: center;
			}
			#keyboardKeys .space-key {
				grid-column: span 4;
			}
			#keyboardKeys .backspace-key {
				grid-column: span 2;
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
								<form id="voiceForm" class="needs-validation" method="POST" action="<?= site_url('GuestController/submit_form'); ?>" enctype="multipart/form-data">
									<h1 class="h3 mb-4 text-center">Informasi Tamu</h1>
									<hr class="divider my-4 mx-auto bg-warning border-warning">
									<div id="cameraPreview" class="card mb-4">
										<div class="card-body text-center">
											<h5 class="card-title">Preview Kamera</h5>
											<video id="video" class="img-fluid rounded" autoplay></video>
										</div>
									</div>
									<div id="photoResult" class="card mb-4" style="display: none;">
										<div class="card-body text-center">
											<h5 class="card-title">Foto Tamu</h5>
											<img id="photo" src="" class="img-fluid rounded" alt="Foto Tamu">
										</div>
									</div>
									<input type="hidden" id="photoInput" name="photo" required>
									<p id="photoError" class="alert alert-danger text-center" style="display: none;">Foto wajib diambil!</p>
									<div class="card mb-4" id="card-name">
										<div class="card-body">
											<label for="name" class="form-label">Nama Lengkap:</label>
											<input type="text" id="name" name="name" class="form-control" placeholder="Masukkan nama lengkap" required>
											<div class="invalid-feedback">Silakan masukkan nama lengkap.</div>
										</div>
									</div>
									<div class="card mb-4" id="card-phone">
										<div class="card-body">
											<label for="phone" class="form-label">Nomor Handphone/WhatsApp:</label>
											<input type="text" id="phone" name="phone" class="form-control" placeholder="Masukkan nomor handphone" required>
											<div class="invalid-feedback">Silakan masukkan nomor handphone.</div>
										</div>
									</div>
									<div class="card mb-4" id="card-institution">
										<div class="card-body">
											<label for="institution" class="form-label">Asal Instansi/Perusahaan:</label>
											<input type="text" id="institution" name="institution" class="form-control" placeholder="Masukkan asal instansi" required>
											<div class="invalid-feedback">Silakan masukkan asal instansi.</div>
										</div>
									</div>
									<div class="card mb-4" id="card-admin">
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
										</div>
										<div class="card-body">
											<label for="room_name" class="form-label">Ruangan:</label>
											<input type="text" id="room_name" name="room_name" class="form-control" readonly>
										</div>
									</div>
									<div class="card mb-4" id="card-purpose">
										<div class="card-body">
											<label for="purpose" class="form-label">Keperluan:</label>
											<textarea id="purpose" name="purpose" class="form-control" placeholder="Masukkan keperluan" required></textarea>
											<div class="invalid-feedback">Silakan masukkan keperluan.</div>
										</div>
									</div>
									<div class="card mb-4" id="card-signature">
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
									<div id="keyboard" class="card mb-4" style="display: none;">
										<div class="card-body">
											<h5 class="card-title">Koreksi Manual</h5>
											<div id="keyboardKeys" class="d-flex flex-wrap gap-2"></div>
											<button type="button" onclick="submitKeyboardInput()" class="btn btn-primary mt-3">Selesai Koreksi</button>
										</div>
									</div>
									<p id="status" class="text-center mt-3">Status: Siap memulai, mohon ucapkan "setuju" untuk mengaktifkan kamera!</p>
									<div id="result" class="card mt-4" style="display: none;">
										<div class="card-body">
											<h5 class="card-title">Hasil Input</h5>
											<p id="resultText"></p>
										</div>
									</div>
									<div class="d-grid mt-4">
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
		</div>
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
				document.getElementById('status').textContent = 'Mohon maaf, peramban Anda tidak mendukung fitur pengenalan suara.';
				Swal.fire({
					icon: 'error',
					title: 'Kesalahan',
					text: 'Peramban tidak mendukung pengenalan suara.'
				});
			}
			const synth = window.speechSynthesis;
			function speak(text, onEndCallback) {
				if (synth) {
					const utterance = new SpeechSynthesisUtterance(text);
					utterance.lang = 'id-ID';
					utterance.rate = 1.0;
					utterance.pitch = 1.0;
					if (onEndCallback) utterance.onend = onEndCallback;
					synth.speak(utterance);
				} else if (onEndCallback) {
					onEndCallback();
				}
			}
			let stream = null;
			const video = document.getElementById('video');
			const photo = document.getElementById('photo');
			const photoInput = document.getElementById('photoInput');
			const canvasCamera = document.createElement('canvas');
			async function startCamera() {
				try {
					stream = await navigator.mediaDevices.getUserMedia({ video: true });
					video.srcObject = stream;
					document.getElementById('cameraPreview').style.display = 'block';
				} catch (err) {
					document.getElementById('status').textContent = 'Mohon maaf, gagal mengakses kamera. Silakan coba kembali.';
					speak('Mohon maaf, gagal mengakses kamera. Silakan coba kembali.', () => {
						document.getElementById('micIndicator').style.backgroundColor = 'green';
						recognition.start();
					});
					Swal.fire({
						icon: 'error',
						title: 'Kesalahan Kamera',
						text: 'Gagal mengakses kamera. Silakan coba kembali.'
					});
				}
			}
			function stopCamera() {
				if (stream) {
					stream.getTracks().forEach(track => track.stop());
					video.srcObject = null;
					document.getElementById('cameraPreview').style.display = 'none';
				}
			}
			function takePhoto() {
				canvasCamera.width = video.videoWidth;
				canvasCamera.height = video.videoHeight;
				canvasCamera.getContext('2d').drawImage(video, 0, 0);
				const photoData = canvasCamera.toDataURL('image/png');
				photo.src = photoData;
				photoInput.value = photoData;
				document.getElementById('photoResult').style.display = 'block';
				stopCamera();
			}
			const admins = <?php echo json_encode($admins); ?>;
			const questions = [
				{ text: 'Mohon sebutkan nama lengkap Anda.', field: 'name', card: 'card-name' },
				{ text: 'Mohon sebutkan nomor telepon atau WhatsApp Anda.', field: 'phone', card: 'card-phone' },
				{ text: 'Mohon sebutkan asal instansi atau perusahaan Anda.', field: 'institution', card: 'card-institution' },
				{ text: 'Mohon pilih admin atau staf sekolah yang ingin Anda temui dengan menekan tombol yang sesuai.', field: 'admin_id', card: 'card-admin', manual: true },
				{ text: 'Mohon sebutkan keperluan kunjungan Anda.', field: 'purpose', card: 'card-purpose' },
				{ text: 'Mohon berikan tanda tangan Anda pada area yang disediakan.', field: 'signature-canvas', card: 'card-signature', manual: true }
			];
			let currentQuestionIndex = 0;
			let isConfirming = false;
			let isAskingCameraPermission = false;
			let isWaitingForPhotoReady = false;
			let isWaitingForKeyboardConfirmation = false;
			let isSelectingAdmin = false;
			let isConfirmingSignature = false;
			let isWaitingForChatbotChoice = false;
			let selectedAdminName = '';
			let persuasionAttempts = 0;
			const persuasionMessages = [
				'Foto diperlukan untuk keperluan administrasi dan akan disimpan dengan aman. Mohon ucapkan "setuju" jika Anda menyetujui.',
				'Kami menjamin keamanan data Anda. Foto ini diperlukan untuk melanjutkan proses. Mohon ucapkan "setuju" jika Anda setuju.',
				'Foto Anda akan membantu kami melengkapi data kunjungan. Mohon ucapkan "setuju" jika Anda setuju.'
			];
			let timeoutId = null;
			const keyboard = document.getElementById('keyboard');
			const keyboardKeys = document.getElementById('keyboardKeys');
			const qwertyLayout = [
				['q', 'w', 'e', 'r', 't', 'y', 'u', 'i', 'o', 'p'],
				['a', 's', 'd', 'f', 'g', 'h', 'j', 'k', 'l'],
				['z', 'x', 'c', 'v', 'b', 'n', 'm', ',', '.', '-'],
				['space', 'space', 'space', 'space', 'backspace', 'backspace']
			];
			qwertyLayout.forEach(row => {
				row.forEach(key => {
					const keyElement = document.createElement('span');
					keyElement.className = `btn btn-outline-secondary me-1 mb-1 ${key === 'space' ? 'space-key' : key === 'backspace' ? 'backspace-key' : ''}`;
					keyElement.textContent = key === 'space' ? 'Spasi' : key === 'backspace' ? 'Hapus' : key;
					keyElement.onclick = () => {
						const inputField = document.getElementById(questions[currentQuestionIndex].field);
						if (inputField.tagName === 'TEXTAREA' || inputField.type === 'text') {
							if (key === 'space') {
								inputField.value += ' ';
							} else if (key === 'backspace') {
								inputField.value = inputField.value.slice(0, -1);
							} else {
								inputField.value += key;
							}
						}
					};
					keyboardKeys.appendChild(keyElement);
				});
			});
			function showCard(index) {
				questions.forEach((q, i) => {
					const card = document.getElementById(q.card);
					card.classList.toggle('active', i === index);
				});
			}
			function startVoiceInput() {
				if (!recognition) return;
				keyboard.style.display = 'none';
				document.getElementById('photoResult').style.display = 'none';
				currentQuestionIndex = 0;
				isConfirming = false;
				isAskingCameraPermission = true;
				isWaitingForPhotoReady = false;
				isWaitingForKeyboardConfirmation = false;
				isSelectingAdmin = false;
				isConfirmingSignature = false;
				isWaitingForChatbotChoice = false;
				persuasionAttempts = 0;
				showCard(-1);
				askCameraPermission();
			}
			function askCameraPermission() {
				const permissionText = 'Apakah Anda mengizinkan pengambilan foto untuk keperluan administrasi? Mohon ucapkan "setuju" jika Anda menyetujui.';
				document.getElementById('status').textContent = permissionText;
				speak(permissionText, () => {
					document.getElementById('micIndicator').style.backgroundColor = 'green';
					recognition.start();
				});
				timeoutId = setTimeout(() => {
					const noResponseText = 'Mohon maaf, belum ada tanggapan. Silakan ucapkan "setuju" jika Anda menyetujui.';
					document.getElementById('status').textContent = noResponseText;
					speak(noResponseText, () => {
						document.getElementById('micIndicator').style.backgroundColor = 'green';
						recognition.start();
					});
				}, 25000);
			}
			function askPhotoReady() {
				const readyText = 'Apakah Anda siap untuk difoto? Mohon ucapkan "siap" jika Anda sudah siap.';
				document.getElementById('status').textContent = readyText;
				speak(readyText, () => {
					document.getElementById('micIndicator').style.backgroundColor = 'green';
					recognition.start();
				});
				timeoutId = setTimeout(() => {
					const noResponseText = 'Mohon maaf, belum ada tanggapan. Silakan ucapkan "siap" jika Anda sudah siap.';
					document.getElementById('status').textContent = noResponseText;
					speak(noResponseText, () => {
						document.getElementById('micIndicator').style.backgroundColor = 'green';
						recognition.start();
					});
				}, 25000);
			}
			function countdownAndTakePhoto() {
				document.getElementById('status').textContent = 'Tiga';
				speak('Tiga', () => {
					document.getElementById('status').textContent = 'Dua';
					speak('Dua', () => {
						document.getElementById('status').textContent = 'Satu, foto diambil!';
						speak('Satu, foto diambil!', () => {
							takePhoto();
							const nextText = 'Foto telah berhasil diambil. Mari lanjutkan pengisian formulir.';
							document.getElementById('status').textContent = nextText;
							speak(nextText, () => askQuestion());
						});
					});
				});
			}
			function selectAdmin(adminId, adminName, roomName) {
				document.getElementById('admin_id').value = adminId;
				document.getElementById('room_name').value = roomName;
				selectedAdminName = adminName;
				isSelectingAdmin = true;
				const confirmText = `Anda memilih ${adminName}. Apakah pilihan ini sudah benar? Ucapkan "ya" jika sesuai.`;
				document.getElementById('status').textContent = confirmText;
				speak(confirmText, () => {
					document.getElementById('micIndicator').style.backgroundColor = 'green';
					recognition.start();
				});
				timeoutId = setTimeout(() => {
					const noResponseText = `Mohon maaf, belum ada tanggapan. Silakan ucapkan "ya" jika sesuai untuk bertemu dengan ${adminName}.`;
					document.getElementById('status').textContent = noResponseText;
					speak(noResponseText, () => {
						document.getElementById('micIndicator').style.backgroundColor = 'green';
						recognition.start();
					});
				}, 25000);
			}
			function confirmSignature() {
				isConfirmingSignature = true;
				const confirmText = 'Apakah tanda tangan Anda sudah sesuai? Mohon ucapkan "sudah" jika benar, atau "belum" jika perlu diperbaiki.';
				document.getElementById('status').textContent = confirmText;
				speak(confirmText, () => {
					document.getElementById('micIndicator').style.backgroundColor = 'green';
					recognition.start();
				});
				timeoutId = setTimeout(() => {
					const noResponseText = 'Mohon maaf, belum ada tanggapan. Silakan ucapkan "sudah" atau "belum".';
					document.getElementById('status').textContent = noResponseText;
					speak(noResponseText, () => {
						document.getElementById('micIndicator').style.backgroundColor = 'green';
						recognition.start();
					});
				}, 25000);
			}
			function askChatbotChoice() {
				isWaitingForChatbotChoice = true;
				const choiceText = 'Mohon menunggu konfirmasi dengan duduk di tempat yang telah disediakan. Apakah Anda ingin berbincang dengan chatbot untuk mengetahui lebih lanjut tentang SMKN 1 Subang? Ucapkan "ya" untuk melanjutkan ke chatbot, atau "tidak" untuk kembali ke halaman utama.';
				document.getElementById('status').textContent = choiceText;
				speak(choiceText, () => {
					document.getElementById('micIndicator').style.backgroundColor = 'green';
					recognition.start();
				});
				timeoutId = setTimeout(() => {
					const noResponseText = 'Mohon maaf, belum ada tanggapan. Silakan ucapkan "ya" untuk chatbot, atau "tidak" untuk kembali ke halaman utama.';
					document.getElementById('status').textContent = noResponseText;
					speak(noResponseText, () => {
						document.getElementById('micIndicator').style.backgroundColor = 'green';
						recognition.start();
					});
				}, 25000);
			}
			function askQuestion() {
				if (currentQuestionIndex >= questions.length) {
					submitForm();
					return;
				}
				const currentQuestion = questions[currentQuestionIndex];
				showCard(currentQuestionIndex);
				document.getElementById('status').textContent = currentQuestion.text;
				if (!currentQuestion.manual) {
					document.getElementById(currentQuestion.field).value = '';
				}
				speak(currentQuestion.text, () => {
					if (!currentQuestion.manual) {
						document.getElementById('micIndicator').style.backgroundColor = 'green';
						recognition.start();
					} else if (currentQuestion.field === 'signature-canvas') {
						document.getElementById('micIndicator').style.backgroundColor = 'red';
						setTimeout(confirmSignature, 5000);
					}
				});
				if (!currentQuestion.manual) {
					timeoutId = setTimeout(() => {
						const noInputText = 'Mohon maaf, belum ada tanggapan. Silakan berikan jawaban Anda.';
						document.getElementById('status').textContent = noInputText;
						speak(noInputText, () => {
							document.getElementById('micIndicator').style.backgroundColor = 'green';
							recognition.start();
						});
					}, 25000);
				}
				if (currentQuestion.field === 'admin_id') {
					document.querySelectorAll('#admin-buttons .btn').forEach(button => {
						button.onclick = () => {
							const adminId = button.getAttribute('data-admin-id');
							const roomName = button.getAttribute('data-room');
							const adminName = button.textContent.trim();
							selectAdmin(adminId, adminName, roomName);
						};
					});
				}
			}
			function confirmInput() {
				const currentQuestion = questions[currentQuestionIndex];
				const inputField = document.getElementById(currentQuestion.field);
				let confirmText = currentQuestion.field === 'purpose' ? 'Apakah keperluan yang Anda sebutkan sudah sesuai? Ucapkan "lanjut" jika benar, atau "koreksi" jika perlu diperbaiki.' : `Apakah data berikut sudah benar: ${inputField.value}? Ucapkan "lanjut" jika sesuai, atau "koreksi" jika perlu diperbaiki.`;
				document.getElementById('status').textContent = confirmText;
				speak(confirmText, () => {
					document.getElementById('micIndicator').style.backgroundColor = 'green';
					recognition.start();
				});
				timeoutId = setTimeout(() => {
					const noConfirmText = 'Mohon maaf, belum ada tanggapan. Silakan ucapkan "lanjut" atau "koreksi".';
					document.getElementById('status').textContent = noConfirmText;
					speak(noConfirmText, () => {
						document.getElementById('micIndicator').style.backgroundColor = 'green';
						recognition.start();
					});
				}, 25000);
				isConfirming = true;
			}
			function confirmKeyboardInput() {
				const confirmText = 'Apakah data yang telah diketik sudah sesuai? Ucapkan "lanjut" untuk melanjutkan ke formulir berikutnya.';
				document.getElementById('status').textContent = confirmText;
				speak(confirmText, () => {
					document.getElementById('micIndicator').style.backgroundColor = 'green';
					recognition.start();
				});
				isWaitingForKeyboardConfirmation = true;
			}
			function submitKeyboardInput() {
				keyboard.style.display = 'none';
				isConfirming = false;
				confirmKeyboardInput();
			}
			function submitForm() {
				showCard(-1);
				if (!photoInput.value) {
					document.getElementById('status').textContent = 'Mohon ambil foto terlebih dahulu.';
					document.getElementById('photoError').style.display = 'block';
					speak('Mohon ambil foto terlebih dahulu.', () => {
						document.getElementById('micIndicator').style.backgroundColor = 'green';
						askCameraPermission();
					});
					Swal.fire({
						icon: 'info',
						title: 'Foto Belum Diambil',
						text: 'Mohon ambil foto terlebih dahulu.'
					});
					return;
				}
				if (signaturePad.isEmpty()) {
					document.getElementById('status').textContent = 'Mohon berikan tanda tangan Anda.';
					speak('Mohon berikan tanda tangan Anda.', () => {
						document.getElementById('micIndicator').style.backgroundColor = 'red';
						showCard(questions.length - 1);
						setTimeout(confirmSignature, 5000);
					});
					Swal.fire({
						icon: 'info',
						title: 'Tanda Tangan Belum Diberikan',
						text: 'Mohon berikan tanda tangan Anda.'
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
					success: function(response) {
						document.getElementById('status').textContent = 'Terima kasih atas kunjungan Anda di SMKN 1 Subang.';
						speak('Terima kasih atas kunjungan Anda di SMKN 1 Subang.', () => {
							Swal.fire({
								title: 'Terima kasih atas kunjungan Anda di SMKN 1 Subang',
								imageUrl: "<?= base_url('assets/img/thanks.png') ?>",
								imageWidth: 200,
								imageHeight: 200,
								text: 'Mohon menunggu konfirmasi dengan duduk di tempat yang telah disediakan. Apakah Anda ingin berbincang dengan chatbot untuk mengetahui lebih lanjut tentang SMKN 1 Subang? Ucapkan "ya" untuk chatbot, atau "tidak" untuk kembali ke halaman utama.'
							});
							askChatbotChoice();
						});
					},
					error: function() {
						Swal.fire({
							icon: 'error',
							title: 'Gagal',
							text: 'Gagal menyimpan data. Mohon coba kembali.'
						});
						document.getElementById('status').textContent = 'Gagal menyimpan data. Mohon coba kembali.';
						speak('Gagal menyimpan data. Mohon coba kembali.', () => {
							document.getElementById('micIndicator').style.backgroundColor = 'green';
							startVoiceInput();
						});
					}
				});
			}
			recognition.onresult = function(event) {
				clearTimeout(timeoutId);
				const transcript = event.results[0][0].transcript.toLowerCase();
				const currentQuestion = questions[currentQuestionIndex];
				if (isAskingCameraPermission) {
					if (transcript.includes('setuju') || transcript.includes('ya') || transcript.includes('ok')) {
						document.getElementById('status').textContent = 'Terima kasih, kamera akan diaktifkan.';
						speak('Terima kasih, kamera akan diaktifkan.', () => {
							isAskingCameraPermission = false;
							isWaitingForPhotoReady = true;
							startCamera();
							askPhotoReady();
						});
					} else if (transcript.includes('tidak') || transcript.includes('jangan')) {
						persuasionAttempts++;
						const persuasionText = persuasionMessages[persuasionAttempts % persuasionMessages.length];
						document.getElementById('status').textContent = persuasionText;
						speak(persuasionText, () => {
							document.getElementById('micIndicator').style.backgroundColor = 'green';
							recognition.start();
						});
						timeoutId = setTimeout(() => {
							const noResponseText = 'Mohon maaf, belum ada tanggapan. Silakan ucapkan "setuju" jika Anda menyetujui.';
							document.getElementById('status').textContent = noResponseText;
							speak(noResponseText, () => {
								document.getElementById('micIndicator').style.backgroundColor = 'green';
								recognition.start();
							});
						}, 25000);
					} else {
						document.getElementById('micIndicator').style.backgroundColor = 'green';
						recognition.start();
					}
				} else if (isWaitingForPhotoReady) {
					if (transcript.includes('siap')) {
						document.getElementById('status').textContent = 'Baik, Anda telah siap untuk difoto.';
						speak('Baik, Anda telah siap untuk difoto.', () => {
							isWaitingForPhotoReady = false;
							countdownAndTakePhoto();
						});
					} else {
						document.getElementById('micIndicator').style.backgroundColor = 'green';
						recognition.start();
					}
				} else if (isWaitingForKeyboardConfirmation) {
					if (transcript.includes('lanjut')) {
						document.getElementById('status').textContent = 'Baik, kami akan melanjutkan ke formulir berikutnya.';
						speak('Baik, kami akan melanjutkan ke formulir berikutnya.', () => {
							isWaitingForKeyboardConfirmation = false;
							currentQuestionIndex++;
							document.getElementById('micIndicator').style.backgroundColor = 'red';
							recognition.stop();
							askQuestion();
						});
					} else {
						document.getElementById('micIndicator').style.backgroundColor = 'green';
						recognition.start();
					}
				} else if (isSelectingAdmin) {
					if (transcript.includes('ya')) {
						document.getElementById('status').textContent = 'Baik, pilihan admin atau staf sekolah telah dikonfirmasi.';
						speak('Baik, pilihan admin atau staf sekolah telah dikonfirmasi.', () => {
							isSelectingAdmin = false;
							currentQuestionIndex++;
							document.getElementById('micIndicator').style.backgroundColor = 'red';
							recognition.stop();
							askQuestion();
						});
					} else {
						document.getElementById('status').textContent = `Mohon maaf, silakan pilih admin atau staf sekolah lain.`;
						speak(`Mohon maaf, silakan pilih admin atau staf sekolah lain.`, () => {
							isSelectingAdmin = false;
							document.getElementById('admin_id').value = '';
							document.getElementById('room_name').value = '';
							document.getElementById('micIndicator').style.backgroundColor = 'red';
							recognition.stop();
							askQuestion();
						});
					}
				} else if (isConfirmingSignature) {
					if (transcript.includes('sudah')) {
						document.getElementById('status').textContent = 'Baik, tanda tangan Anda telah dikonfirmasi.';
						speak('Baik, tanda tangan Anda telah dikonfirmasi.', () => {
							isConfirmingSignature = false;
							currentQuestionIndex++;
							document.getElementById('micIndicator').style.backgroundColor = 'red';
							recognition.stop();
							askQuestion();
						});
					} else if (transcript.includes('belum')) {
						signaturePad.clear();
						document.getElementById('status').textContent = 'Baik, silakan berikan tanda tangan kembali.';
						speak('Baik, silakan berikan tanda tangan kembali.', () => {
							isConfirmingSignature = false;
							document.getElementById('micIndicator').style.backgroundColor = 'red';
							setTimeout(confirmSignature, 5000);
						});
					} else {
						document.getElementById('micIndicator').style.backgroundColor = 'green';
						recognition.start();
					}
				} else if (isWaitingForChatbotChoice) {
					if (transcript.includes('ya')) {
						document.getElementById('status').textContent = 'Baik, Anda akan diarahkan ke chatbot.';
						speak('Baik, Anda akan diarahkan ke chatbot.', () => {
							window.location.href = '<?= site_url('chatbot/test') ?>';
						});
					} else if (transcript.includes('tidak')) {
						document.getElementById('status').textContent = 'Baik, Anda akan diarahkan kembali ke halaman utama.';
						speak('Baik, Anda akan diarahkan kembali ke halaman utama.', () => {
							window.location.href = '<?= base_url() ?>';
						});
					} else {
						document.getElementById('micIndicator').style.backgroundColor = 'green';
						recognition.start();
					}
				} else if (isConfirming) {
					if (transcript.includes('lanjut') || transcript.includes('ya')) {
						document.getElementById('status').textContent = 'Baik, data telah dikonfirmasi.';
						speak('Baik, data telah dikonfirmasi.', () => {
							currentQuestionIndex++;
							isConfirming = false;
							document.getElementById('micIndicator').style.backgroundColor = 'red';
							recognition.stop();
							askQuestion();
						});
					} else if (transcript.includes('koreksi') || transcript.includes('tidak')) {
						const retryText = currentQuestion.field === 'admin_id' ? 'Baik, silakan pilih admin atau staf sekolah kembali.' : 'Apakah Anda ingin mengulang dengan suara atau mengetik? Ucapkan "ulang" untuk suara, atau "ketik" untuk mengetik.';
						document.getElementById('status').textContent = retryText;
						speak(retryText, () => {
							document.getElementById('micIndicator').style.backgroundColor = 'green';
							recognition.start();
						});
						timeoutId = setTimeout(() => {
							const noConfirmText = currentQuestion.field === 'admin_id' ? 'Mohon maaf, belum ada pilihan admin atau staf sekolah. Silakan pilih salah satu tombol.' : 'Mohon maaf, belum ada tanggapan. Silakan ucapkan "ulang" atau "ketik".';
							document.getElementById('status').textContent = noConfirmText;
							speak(noConfirmText, () => {
								document.getElementById('micIndicator').style.backgroundColor = 'green';
								recognition.start();
							});
						}, 25000);
					} else if (transcript.includes('ulang')) {
						const inputField = document.getElementById(currentQuestion.field);
						if (currentQuestion.field === 'admin_id') {
							inputField.value = '';
							document.getElementById('room_name').value = '';
						} else {
							inputField.value = '';
						}
						isConfirming = false;
						document.getElementById('micIndicator').style.backgroundColor = 'red';
						recognition.stop();
						askQuestion();
					} else if (transcript.includes('ketik') && currentQuestion.field !== 'admin_id' && currentQuestion.field !== 'signature-canvas') {
						const keyboardText = `Silakan ketik untuk memperbaiki "${currentQuestion.text}"`;
						document.getElementById('status').textContent = keyboardText;
						speak(keyboardText, () => {
							document.getElementById('micIndicator').style.backgroundColor = 'red';
							recognition.stop();
						});
						keyboard.style.display = 'block';
						isConfirming = false;
					} else {
						document.getElementById('micIndicator').style.backgroundColor = 'green';
						recognition.start();
					}
				} else {
					document.getElementById(currentQuestion.field).value = event.results[0][0].transcript;
					document.getElementById('status').textContent = 'Terima kasih, jawaban Anda telah diterima.';
					speak('Terima kasih, jawaban Anda telah diterima.', () => {
						document.getElementById('micIndicator').style.backgroundColor = 'red';
						recognition.stop();
						confirmInput();
					});
				}
			};
			recognition.onerror = function(event) {
				if (event.error === 'no-speech' && (isWaitingForKeyboardConfirmation || keyboard.style.display === 'block')) {
					document.getElementById('micIndicator').style.backgroundColor = 'green';
					recognition.start();
					return;
				}
				clearTimeout(timeoutId);
				document.getElementById('status').textContent = 'Mohon maaf, terjadi kesalahan: ' + event.error + '. Silakan coba kembali.';
				speak('Mohon maaf, terjadi kesalahan: ' + event.error + '. Silakan coba kembali.', () => {
					document.getElementById('micIndicator').style.backgroundColor = 'green';
					startVoiceInput();
				});
				Swal.fire({
					icon: 'error',
					title: 'Kesalahan',
					text: 'Terjadi kesalahan: ' + event.error
				});
				keyboard.style.display = 'none';
				stopCamera();
				document.getElementById('photoResult').style.display = 'none';
			};
			recognition.onend = function() {
				if (!synth.speaking && (isAskingCameraPermission || isWaitingForPhotoReady || isConfirming || isWaitingForKeyboardConfirmation || isSelectingAdmin || isConfirmingSignature || isWaitingForChatbotChoice) && keyboard.style.display !== 'block') {
					document.getElementById('micIndicator').style.backgroundColor = 'green';
					recognition.start();
				} else {
					document.getElementById('micIndicator').style.backgroundColor = 'red';
				}
			};
			$(document).ready(function() {
				startVoiceInput();
			});
		</script>
	</main>
	</body>
	</html>
