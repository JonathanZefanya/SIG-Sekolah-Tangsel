<head>
    <?= $this->include('home/_head') ?>
    <style>
        .chat-wrapper {
            max-width: 768px;
            margin: auto;
            border: 1px solid #ccc;
            border-radius: 10px;
            padding: 15px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        .chat-box {
            height: 65vh;
            overflow-y: auto;
            padding: 10px;
            background-color: #f9f9f9;
            border-radius: 8px;
            margin-bottom: 1rem;
            scroll-behavior: smooth;
        }

        .chat-message {
            margin: 10px 0;
            max-width: 80%;
            padding: 10px 15px;
            border-radius: 15px;
            line-height: 1.4;
        }

        .chat-message.user {
            background-color: #007bff;
            color: #fff;
            align-self: flex-end;
            margin-left: auto;
            border-bottom-right-radius: 0;
        }

        .chat-message.bot {
            background-color: #e2e2e2;
            align-self: flex-start;
            margin-right: auto;
            border-bottom-left-radius: 0;
        }

        .chat-controls {
            display: flex;
            gap: 10px;
            align-items: center;
        }
    </style>
</head>

<body class="index-page bg-gray-200">
    <div class="container position-sticky z-index-sticky top-0">
        <div class="row">
            <div class="col-12">
                <nav class="navbar navbar-expand-lg  blur border-radius-xl top-0 z-index-fixed shadow position-absolute my-3 py-2 start-0 end-0 mx-4">
                    <div class="container-fluid px-0">
                        <a class="navbar-brand font-weight-bolder ms-sm-3" href="<?= base_url('/') ?>">
                            <i class="fas fa-map-marker-alt me-1" style="color: #344767;"></i> Geografis Sekolah Tangsel
                        </a>
                        <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon mt-2">
                                <span class="navbar-toggler-bar bar1"></span>
                                <span class="navbar-toggler-bar bar2"></span>
                                <span class="navbar-toggler-bar bar3"></span>
                            </span>
                        </button>
                        <div class="collapse navbar-collapse pt-3 pb-2 py-lg-0 w-100" id="navigation">
                            <ul class="navbar-nav navbar-nav-hover ms-auto">
                                <li class="nav-item ms-lg-auto me-2">
                                    <a class="nav-link nav-link-icon" href="/">
                                        <p class="d-inline text-sm z-index-1 font-weight-bold">Beranda</p>
                                    </a>
                                </li>

                                <li class="nav-item ms-lg-auto me-2">
                                    <a class="nav-link nav-link-icon" href="/#tentang">
                                        <p class="d-inline text-sm z-index-1 font-weight-bold">Tentang</p>
                                    </a>
                                </li>

                                <li class="nav-item ms-lg-auto me-2">
                                    <a class="nav-link nav-link-icon" href="/#sekolah">
                                        <p class="d-inline text-sm z-index-1 font-weight-bold">Data Sekolah</p>
                                    </a>
                                </li>

                                <li class="nav-item ms-lg-auto me-2">
                                    <a class="nav-link nav-link-icon" href="/#peta">
                                        <p class="d-inline text-sm z-index-1 font-weight-bold">Peta Sekolah</p>
                                    </a>
                                </li>

                                <li class="nav-item my-auto ms-3 ms-lg-4">
                                    <?php if (!session()->get('logged_in')) : ?>
                                        <a href="<?= site_url('/login') ?>" class="btn btn-sm bg-gradient-primary mb-0 me-1 mt-2 mt-md-0">Masuk</a>
                                    <?php else : ?>
                                        <a href="<?= site_url('/dashboard') ?>" class="text-sm text-primary fw-bold mb-0 me-1 mt-2 mt-md-0"><?= ucwords(session()->get('user_name')) ?></a>
                                    <?php endif; ?>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
                <!-- End Navbar -->
            </div>
        </div>
    </div>

    <div class="container mt-7">
        <div class="chat-wrapper d-flex flex-column">
            <h4 class="mb-3">Chatbot Gemini</h4>
            <div class="chat-box d-flex flex-column" id="chatBox"></div>

            <form id="chatForm" class="chat-controls">
                <input type="text" id="userInput" class="form-control" placeholder="Tulis pesan..." required>
                <button type="submit" class="btn btn-primary">Kirim</button>
                <button type="button" class="btn btn-danger" id="clearHistory">Hapus Pesan</button>
            </form>
        </div>
    </div>
    <!-- Footer -->
    <?= $this->include('home/_footer') ?>

    <?= $this->include('home/_script') ?>

</body>

<script>
const chatBox = document.getElementById('chatBox');
const chatForm = document.getElementById('chatForm');
const userInput = document.getElementById('userInput');
const clearHistory = document.getElementById('clearHistory');

let chatHistory = JSON.parse(localStorage.getItem('chatHistory')) || [];

// Render chat history on load
chatHistory.forEach(item => {
    appendMessage(item.sender, item.text);
});
scrollToBottom();

chatForm.addEventListener('submit', async function(e) {
    e.preventDefault();
    const message = userInput.value.trim();
    if (!message) return;

    appendMessage('user', message);
    saveToHistory('user', message);
    userInput.value = '';

    try {
        const response = await fetch("https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent?key=<?= $api_key ?>", {
            method: "POST",
            headers: {"Content-Type": "application/json"},
            body: JSON.stringify({
                contents: [
                    {
                        role: "user",
                        parts: [
                            {text: "Kamu adalah BOT dari website SIG SEKOLAH TANGSEL. Jawablah hanya pertanyaan yang berkaitan dengan sekolah SD, SMP, dan SMA di Kota Tangerang Selatan. Jika pertanyaannya di luar topik, katakan dengan sopan bahwa kamu hanya melayani topik seputar sekolah di Tangsel."}
                        ]
                    },
                    {
                        role: "user",
                        parts: [{text: message}]
                    }
                ]
            })
        });

        const data = await response.json();
        if (data.error) {
            appendMessage('bot', `Error: ${data.error.message}`);
            saveToHistory('bot', `Error: ${data.error.message}`);
            return;
        }

        const reply = data?.candidates?.[0]?.content?.parts?.[0]?.text ?? '(Tidak ada respons)';
        appendMessage('bot', reply);
        saveToHistory('bot', reply);
    } catch (error) {
        appendMessage('bot', `Error: ${error.message}`);
        saveToHistory('bot', `Error: ${error.message}`);
    }
});

clearHistory.addEventListener('click', () => {
    localStorage.removeItem('chatHistory');
    chatBox.innerHTML = '';
});

function appendMessage(sender, text) {
    const div = document.createElement('div');
    div.className = `chat-message ${sender}`;
    div.innerText = (sender === 'user' ? 'Anda: ' : 'Bot: ') + text;
    chatBox.appendChild(div);
    scrollToBottom();
}

function saveToHistory(sender, text) {
    chatHistory.push({ sender, text });
    localStorage.setItem('chatHistory', JSON.stringify(chatHistory));
}

function scrollToBottom() {
    chatBox.scrollTop = chatBox.scrollHeight;
}
</script>