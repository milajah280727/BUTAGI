<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SmartNes Assistant - Buku Tamu</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <style>
    body {
      background-color: #f4f6f9;
      font-family: 'poppins', sans-serif;
      color: #333;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }
    main {
      flex: 1 0 auto;
    }
    .glass-container {
      background-color: white;
      border-radius: 15px;
      padding: 25px;
      margin-top: 80px;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
    }
    h2 {
      font-weight: 600;
      color: #2c3e50;
    }
    .chat-container {
      max-height: 400px;
      overflow-y: auto;
      margin-bottom: 20px;
      padding: 15px;
      border: 1px solid #e1e4e8;
      border-radius: 10px;
      background-color: #f9fafb;
    }
    .user-bubble, .bot-bubble {
      padding: 10px 15px;
      border-radius: 10px;
      margin: 6px 0;
      max-width: 75%;
      word-wrap: break-word;
      font-size: 14px;
      line-height: 1.4;
    }
    .user-bubble {
      background-color: #e0f7fa;
      color: #000;
      margin-left: auto;
      text-align: right;
    }
    .bot-bubble {
      background-color: #edf2f7;
      color: #333;
      margin-right: auto;
      text-align: left;
    }
    .bot-image-container {
      max-width: 75%;
      margin-right: auto;
      margin: 6px 0;
      text-align: left;
    }
    .bot-image {
      max-width: 100%;
      max-height: 200px;
      border-radius: 10px;
      display: block;
      cursor: pointer;
    }
    .modal-image {
      max-width: 90vw;
      max-height: 90vh;
      display: block;
      margin: 0 auto;
    }
    .chat-input {
      border: 1px solid #ced4da;
      border-radius: 20px;
      padding: 10px 20px;
      width: 100%;
      outline: none;
      font-size: 14px;
    }
    .btn-send, .btn-voice, .btn-back {
      border-radius: 20px;
      border: none;
      padding: 10px 20px;
      transition: background-color 0.3s ease;
    }
    .btn-send {
      background-color: #0d6efd;
      color: white;
    }
    .btn-send:hover {
      background-color: #084298;
    }
    .btn-voice {
      background-color: #28a745;
      color: white;
    }
    .btn-voice:hover {
      background-color: #218838;
    }
    .btn-voice.recording {
      background-color: #dc3545;
    }
    .btn-back {
      background-color: #6c757d;
      color: white;
    }
    .btn-back:hover {
      background-color: #5a6268;
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
      cursor: pointer;
    }
    footer {
      flex-shrink: 0;
      background-color: #6c757d;
      color: white;
      text-align: center;
      padding: 1rem 0;
    }
  </style>
</head>
<body>
  <div id="micIndicator" onclick="toggleVoiceRecognition()"></div>
  <main>
    <div class="container">
      <div class="glass-container shadow-lg">
        <h2 class="text-center mb-4">NESAS Assistant</h2>
        <div class="chat-container" id="chatContainer">
          <div class="bot-bubble">Hallo Netines, apa yang bisa saya bantu di sini? Anda bisa bertanya tentang profil sekolah, jurusan, pendaftaran, fasilitas, atau kontak SMKN 1 Subang. Coba bilang atau ketik salah satu topik itu!</div>
          
        </div>
        <div class="d-flex">
          <input type="text" id="chatInput" class="chat-input me-2" placeholder="Tanyakan sesuatu...">
          <button class="btn btn-warning btn-send me-2" onclick="sendMessage()">Kirim</button>
          <button class="btn btn-voice me-2" id="voiceButton" onclick="toggleVoiceRecognition()">Mulai Bicara</button>
          <a href="<?= base_url() ?>" class="btn btn-back">Kembali</a>
        </div>
      </div>
    </div>
  </main>
  <!-- Bootstrap Modal for Enlarged Image -->
  <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="imageModalLabel">Image Preview</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <img id="modalImage" src="" class="modal-image" alt="Enlarged chatbot image">
        </div>
      </div>
    </div>
  </div>
  <footer>
    <p>&copy; 2025 SMKN 1 Subang. All rights reserved.</p>
  </footer>
  <script>
    const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
    let recognition;
    let isRecording = false;
    if (SpeechRecognition) {
      recognition = new SpeechRecognition();
      recognition.lang = 'id-ID';
      recognition.interimResults = false;
      recognition.maxAlternatives = 1;
    } else {
      addChatBubble('Maaf, browser Anda tidak mendukung Speech Recognition.', false);
    }
    const synth = window.speechSynthesis;
    function speak(text, onEndCallback) {
      if (synth) {
        if (isRecording) {
          recognition.stop();
          isRecording = false;
          document.getElementById('voiceButton').textContent = 'Mulai Bicara';
          document.getElementById('voiceButton').classList.remove('recording');
          document.getElementById('micIndicator').style.backgroundColor = 'red';
        }
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
    const autocorrectMap = {
      'ada jurusan apasaja': 'jurusan apa saja',
      'apa saja jurusan': 'apa saja jurusan',
      'syarat daftar': 'syarat pendaftaran',
      'cara pendaftaran': 'cara daftar',
      'biaya sekolahan': 'biaya sekolah',
      'fasilitas apa': 'fasilitas sekolah',
      'jadwal sekolahan': 'jadwal sekolah',
      'ekskul': 'ekstrakurikuler',
      'kontak sekolahan': 'kontak sekolah',
      'alamat sekolahan': 'alamat sekolah',
      'prestasi apa': 'prestasi sekolah',
      'prakerin': 'praktik kerja',
      'beasiswa apa': 'beasiswa',
      'guru siapa': 'guru dan staf',
      'visi misi sekolah ini apa': 'visi misi',
      'kurikulum apa': 'kurikulum',
      'daftar online': 'pendaftaran online',
      'hari buka apa': 'hari buka',
      'program apa': 'program unggulan'
    };
    function autocorrectInput(text) {
      text = text.toLowerCase();
      for (const [wrong, correct] of Object.entries(autocorrectMap)) {
        if (text.includes(wrong)) {
          return correct;
        }
      }
      return text;
    }
    function toggleVoiceRecognition() {
      if (!recognition) return;
      if (isRecording) {
        recognition.stop();
      } else {
        synth.cancel();
        document.getElementById('voiceButton').textContent = 'Berhenti';
        document.getElementById('voiceButton').classList.add('recording');
        document.getElementById('micIndicator').style.backgroundColor = 'green';
        recognition.start();
        isRecording = true;
      }
    }
    function showImage(imageSrc) {
      document.getElementById('modalImage').src = imageSrc;
    }
    recognition.onresult = function(event) {
      const transcript = event.results[0][0].transcript;
      const correctedTranscript = autocorrectInput(transcript);
      document.getElementById('chatInput').value = correctedTranscript;
      addChatBubble(correctedTranscript, true);
      sendVoiceMessage(correctedTranscript);
      isRecording = false;
      document.getElementById('voiceButton').textContent = 'Mulai Bicara';
      document.getElementById('voiceButton').classList.remove('recording');
      document.getElementById('micIndicator').style.backgroundColor = 'red';
    };
    recognition.onerror = function(event) {
      const errorMessage = 'Maaf, terjadi kesalahan saat merekam suara: ' + event.error;
      addChatBubble(errorMessage, false);
      speak(errorMessage, () => {
        document.getElementById('micIndicator').style.backgroundColor = 'red';
      });
      isRecording = false;
      document.getElementById('voiceButton').textContent = 'Mulai Bicara';
      document.getElementById('voiceButton').classList.remove('recording');
      document.getElementById('micIndicator').style.backgroundColor = 'red';
    };
    recognition.onend = function() {
      if (isRecording && !synth.speaking) {
        setTimeout(() => {
          if (isRecording && !synth.speaking) {
            document.getElementById('micIndicator').style.backgroundColor = 'green';
            recognition.start();
          }
        }, 500);
      } else {
        document.getElementById('voiceButton').textContent = 'Mulai Bicara';
        document.getElementById('voiceButton').classList.remove('recording');
        document.getElementById('micIndicator').style.backgroundColor = 'red';
        isRecording = false;
      }
    };
    function sendMessage() {
      const input = document.getElementById("chatInput");
      const message = input.value.trim();
      if (message === "") return;
      addChatBubble(message, true);
      input.value = "";
      sendVoiceMessage(message);
    }
    function sendVoiceMessage(message) {
      fetch("<?= base_url('chatbotController/ask') ?>", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: "chatInput=" + encodeURIComponent(message)
      })
      .then(res => res.json())
      .then(data => {
        if (data.response.trim() === "Maaf, saya belum mengerti pertanyaan Anda.") {
          const outOfScopeMessage = "Maaf, kami tidak memiliki atau tidak boleh menyebarkan informasi tersebut ke publik. Coba tanyakan tentang profil sekolah, jurusan, pendaftaran, fasilitas, atau kontak SMKN 1 Subang!";
          addChatBubble(outOfScopeMessage, false);
          speak(outOfScopeMessage);
        } else {
          addChatBubble(data.response, false, data.image);
          speak(data.response);
        }
      })
      .catch(err => {
        const errorMessage = "Maaf, terjadi kesalahan koneksi.";
        addChatBubble(errorMessage, false);
        speak(errorMessage);
      });
    }
    function addChatBubble(message, isUser = true, image = null) {
      const chatContainer = document.getElementById("chatContainer");
      if (isUser) {
        const bubble = document.createElement("div");
        bubble.className = "user-bubble";
        bubble.textContent = message;
        chatContainer.appendChild(bubble);
      } else {
        const bubble = document.createElement("div");
        bubble.className = "bot-bubble";
        bubble.textContent = message;
        chatContainer.appendChild(bubble);
        if (image) {
          const imageContainer = document.createElement("div");
          imageContainer.className = "bot-image-container";
          const img = document.createElement("img");
          img.src = image;
          img.className = "bot-image";
          img.alt = "Chatbot image";
          img.loading = "lazy";
          img.setAttribute("data-bs-toggle", "modal");
          img.setAttribute("data-bs-target", "#imageModal");
          img.onclick = () => showImage(image);
          imageContainer.appendChild(img);
          chatContainer.appendChild(imageContainer);
        }
      }
      chatContainer.scrollTop = chatContainer.scrollHeight;
    }
  </script>
</body>
</html>
