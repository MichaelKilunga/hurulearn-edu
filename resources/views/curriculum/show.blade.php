<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $curriculum->title }} – HuruLearn Reading Room</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --indigo: #1e1b4b;
            --indigo-dark: #0f0d2e;
            --blue: #3b82f6;
            --blue-light: #60a5fa;
            --amber: #f59e0b;
            --white: #ffffff;
            --gray-100: #f3f4f6;
            --gray-400: #9ca3af;
            --gray-800: #1f2937;
            --card-bg: rgba(255, 255, 255, 0.03);
            --border: rgba(255, 255, 255, 0.08);
        }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; background: var(--indigo-dark); color: var(--white); height: 100vh; display: flex; flex-direction: column; overflow: hidden; }
        
        /* Nav */
        nav {
            padding: 1rem 2rem; display: flex; align-items: center; justify-content: space-between;
            background: rgba(15,13,46,0.9); backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--border); z-index: 100;
        }
        .nav-left { display: flex; align-items: center; gap: 1rem; }
        .back-btn { color: var(--gray-400); text-decoration: none; display: flex; align-items: center; gap: .5rem; font-size: .9rem; transition: color .2s; }
        .back-btn:hover { color: #fff; }
        .nav-title h1 { font-family: 'Space Grotesk', sans-serif; font-size: 1.05rem; font-weight: 700; max-width: 450px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .nav-title p { font-size: .72rem; color: var(--gray-400); text-transform: uppercase; letter-spacing: 0.05em; }

        .split-container { flex: 1; display: flex; overflow: hidden; }

        /* Left Panel: Reading Material */
        .reading-panel {
            flex: 1.2; padding: 3rem; overflow-y: auto; background: rgba(255,255,255,0.01);
            border-right: 1px solid var(--border); display: flex; flex-direction: column; gap: 2rem;
            scrollbar-width: thin;
        }
        .reading-panel::-webkit-scrollbar { width: 6px; }
        .reading-panel::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.1); border-radius: 3px; }
        
        .reading-header h2 { font-family: 'Space Grotesk', sans-serif; font-size: 2rem; line-height: 1.3; background: linear-gradient(135deg, #fff, var(--gray-400)); -webkit-background-clip: text; -webkit-text-fill-color: transparent; margin-bottom: 1rem; }
        .reading-tags { display: flex; gap: 0.5rem; flex-wrap: wrap; }
        .tag-pill { font-size: 0.72rem; padding: 0.25rem 0.65rem; border-radius: 6px; background: rgba(255,255,255,0.05); border: 1px solid var(--border); color: var(--gray-400); text-transform: uppercase; font-weight: 600; }

        .reading-summary { border-left: 3px solid var(--amber); padding-left: 1.2rem; margin: 1.5rem 0; font-style: italic; color: var(--gray-400); font-size: 0.98rem; line-height: 1.6; }
        
        .reading-body { font-size: 1.1rem; line-height: 1.8; color: var(--gray-100); display: flex; flex-direction: column; gap: 1.5rem; }
        .reading-body p { margin-bottom: 0.5rem; text-align: justify; }

        /* Right Panel: Interactive AI Tutor */
        .chat-panel {
            flex: 0.9; display: flex; flex-direction: column; background: rgba(15,13,46,0.3);
            position: relative;
        }
        .chat-header {
            padding: 1.2rem 1.8rem; border-bottom: 1px solid var(--border);
            background: rgba(15,13,46,0.5); backdrop-filter: blur(10px);
            display: flex; justify-content: space-between; align-items: center;
        }
        .chat-header h3 { font-family: 'Space Grotesk', sans-serif; font-size: 1rem; font-weight: 700; color: var(--amber); display: flex; align-items: center; gap: 0.5rem; }
        .chat-header h3::before { content: ''; display: inline-block; width: 8px; height: 8px; border-radius: 50%; background: #10b981; animation: pulse 1.5s infinite; }

        .chat-messages { flex: 1; overflow-y: auto; padding: 2rem 1.8rem; display: flex; flex-direction: column; gap: 1.5rem; scroll-behavior: smooth; }
        .chat-messages::-webkit-scrollbar { width: 4px; }
        .chat-messages::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.06); border-radius: 2px; }

        .message { display: flex; flex-direction: column; gap: 0.4rem; max-width: 85%; }
        .message.own { align-self: flex-end; }
        .message.tutor { align-self: flex-start; }

        .avatar-label { font-size: 0.72rem; color: var(--gray-400); font-weight: 600; display: flex; align-items: center; gap: 0.4rem; }
        .message.own .avatar-label { justify-content: flex-end; color: var(--blue-light); }
        .message.tutor .avatar-label { color: var(--amber); }

        .msg-bubble {
            padding: 0.9rem 1.15rem; border-radius: 16px; font-size: 0.92rem; line-height: 1.6;
            word-wrap: break-word; text-align: left;
        }
        .message.own .msg-bubble { background: linear-gradient(135deg, var(--blue), #1d4ed8); color: #fff; border-top-right-radius: 4px; }
        .message.tutor .msg-bubble { background: var(--card-bg); border: 1px solid var(--border); color: var(--gray-100); border-top-left-radius: 4px; }

        .typing-indicator { align-self: flex-start; padding: 0.5rem 1rem; display: flex; gap: 5px; }
        .typing-indicator span { width: 7px; height: 7px; background: var(--amber); border-radius: 50%; opacity: 0.4; animation: typing 1.2s infinite ease-in-out; }
        .typing-indicator span:nth-child(2) { animation-delay: 0.2s; }
        .typing-indicator span:nth-child(3) { animation-delay: 0.4s; }

        /* Input area */
        .chat-input-area { padding: 1.5rem 1.8rem; border-top: 1px solid var(--border); background: rgba(15,13,46,0.6); }
        .chat-input-wrapper { display: flex; gap: 0.8rem; background: rgba(255,255,255,0.04); border: 1px solid var(--border); border-radius: 14px; padding: 0.5rem 0.8rem; align-items: center; transition: border-color 0.2s; }
        .chat-input-wrapper:focus-within { border-color: var(--blue-light); }
        .chat-input-wrapper textarea { flex: 1; background: transparent; border: none; color: #fff; outline: none; padding: 0.4rem; font-size: 0.92rem; resize: none; max-height: 80px; font-family: inherit; }
        
        .send-btn { width: 38px; height: 38px; border-radius: 10px; background: var(--amber); border: none; display: flex; align-items: center; justify-content: center; cursor: pointer; color: #fff; transition: transform 0.2s, background 0.2s; }
        .send-btn:hover { background: #d97706; transform: scale(1.03); }
        .send-btn:active { transform: scale(0.97); }

        /* Suggestions block */
        .chat-suggestions { display: flex; gap: 0.6rem; margin-bottom: 0.8rem; flex-wrap: wrap; }
        .suggestion-btn { background: rgba(255,255,255,0.03); border: 1px solid var(--border); border-radius: 8px; padding: 0.4rem 0.8rem; color: var(--gray-400); font-size: 0.8rem; cursor: pointer; transition: all 0.2s; font-weight: 500; }
        .suggestion-btn:hover { background: rgba(255,255,255,0.07); border-color: var(--amber); color: #fff; }

        @keyframes pulse {
            0% { transform: scale(0.9); opacity: 0.5; }
            50% { transform: scale(1.1); opacity: 1; }
            100% { transform: scale(0.9); opacity: 0.5; }
        }

        @keyframes typing {
            0%, 100% { transform: translateY(0); opacity: 0.4; }
            50% { transform: translateY(-5px); opacity: 1; }
        }

        @media (max-width: 900px) {
            .split-container { flex-direction: column; }
            .reading-panel { flex: 1; border-right: none; border-bottom: 1px solid var(--border); padding: 2rem 1.5rem; }
            .chat-panel { flex: 1; }
            body { overflow: auto; height: auto; }
            .split-container { height: calc(100vh - 65px); }
        }
    </style>
</head>
<body>
    <nav>
        <div class="nav-left">
            <a href="{{ route('curriculum.index') }}" class="back-btn">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
                <span>Back</span>
            </a>
            <div class="nav-title">
                <h1>{{ $curriculum->title }}</h1>
                <p>HuruLearn Reading Room</p>
            </div>
        </div>
        <div>
            <a href="{{ route('chat.index') }}" class="btn btn-outline" style="padding: .5rem 1.2rem; font-size: .8rem;">Instant Web Chat</a>
        </div>
    </nav>

    <div class="split-container">
        <!-- Left Panel: Content -->
        <article class="reading-panel">
            <div class="reading-header">
                <h2>{{ $curriculum->title }}</h2>
                <div class="reading-tags">
                    <span class="tag-pill">{{ $curriculum->language == 'sw' ? 'Kiswahili' : 'English' }}</span>
                    @if($curriculum->tags)
                        @foreach(explode(',', $curriculum->tags) as $tag)
                            <span class="tag-pill">{{ trim($tag) }}</span>
                        @endforeach
                    @endif
                </div>
            </div>

            @if($curriculum->summary)
                <div class="reading-summary">
                    <strong>Muhtasari / Summary:</strong> {{ $curriculum->summary }}
                </div>
            @endif

            <div class="reading-body">
                @foreach(preg_split('/\n+/', $curriculum->content) as $paragraph)
                    @if(trim($paragraph))
                        <p>{{ trim($paragraph) }}</p>
                    @endif
                @endforeach
            </div>
        </article>

        <!-- Right Panel: Interactive AI Tutor -->
        <section class="chat-panel">
            <div class="chat-header">
                <h3>AI Study Assistant</h3>
                <span style="font-size: 0.75rem; color: var(--gray-400);">Guided Tutoring</span>
            </div>

            <div class="chat-messages" id="chat-messages">
                <!-- Initial greeting based on language -->
                <div class="message tutor">
                    <span class="avatar-label">✦ AI Tutor</span>
                    <div class="msg-bubble">
                        @if($curriculum->language == 'sw')
                            Habari! Mimi ni mwalimu wako msaidizi. Nimesoma mada ya kiada ya **"{{ $curriculum->title }}"** pamoja nawe. Unapoendelea kusoma upande wa kushoto, unaweza kuniuliza maswali yoyote ya kuelewa zaidi. Bonyeza vitufe hapa chini tuanze!
                        @else
                            Hello! I am your AI teaching assistant. I have reviewed the textbook topic **"{{ $curriculum->title }}"** with you. As you read along on the left, feel free to ask me any questions to clarify the concepts. Click the buttons below to begin!
                        @endif
                    </div>
                </div>
            </div>

            <div class="typing-indicator hidden" id="typing-indicator">
                <span></span><span></span><span></span>
            </div>

            <div class="chat-input-area">
                <div class="chat-suggestions">
                    @if($curriculum->language == 'sw')
                        <button class="suggestion-btn" data-query="Niazishe swali la kwanza la zoezi">Quiz me! 📝</button>
                        <button class="suggestion-btn" data-query="Nieleze mada hii kwa maneno rahisi sana">Eleza kwa ufupi 💡</button>
                        <button class="suggestion-btn" data-query="Ni nini matumizi ya mada hii katika maisha ya kila siku?">Mifano halisi 🌍</button>
                    @else
                        <button class="suggestion-btn" data-query="Start the first quiz question">Quiz me! 📝</button>
                        <button class="suggestion-btn" data-query="Explain this topic in very simple terms">Simplify 💡</button>
                        <button class="suggestion-btn" data-query="What is the real-world application of this topic?">Real-world usage 🌍</button>
                    @endif
                </div>
                <form id="tutor-chat-form" class="chat-input-wrapper">
                    @csrf
                    <textarea id="chat-input" placeholder="Type a message or click a suggestion..." rows="1" autocomplete="off"></textarea>
                    <button type="submit" class="send-btn">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="22" y1="2" x2="11" y2="13"></line><polyline points="22 2 15 22 11 13 2 9 22 2"></polyline></svg>
                    </button>
                </form>
            </div>
        </section>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const chatMessages = document.getElementById('chat-messages');
            const tutorChatForm = document.getElementById('tutor-chat-form');
            const chatInput = document.getElementById('chat-input');
            const typingIndicator = document.getElementById('typing-indicator');

            // Auto-expand textarea
            chatInput.addEventListener('input', function() {
                this.style.height = 'auto';
                this.style.height = (this.scrollHeight > 80 ? 80 : this.scrollHeight) + 'px';
            });

            // Submit handler
            tutorChatForm.addEventListener('submit', async (e) => {
                e.preventDefault();
                const msg = chatInput.value.trim();
                if (!msg) return;

                chatInput.value = '';
                chatInput.style.height = 'auto';

                submitQuery(msg);
            });

            // Suggestions buttons handler
            document.querySelectorAll('.suggestion-btn').forEach(btn => {
                btn.addEventListener('click', () => {
                    const query = btn.getAttribute('data-query');
                    submitQuery(query);
                });
            });

            async function submitQuery(msg) {
                // Render user message
                addMessage(msg, 'own');
                scrollToBottom();

                // Show typing indicator
                typingIndicator.classList.remove('hidden');
                scrollToBottom();

                try {
                    const response = await fetch("{{ route('curriculum.chat', $curriculum->id) }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                        },
                        body: JSON.stringify({ message: msg })
                    });

                    typingIndicator.classList.add('hidden');

                    if (response.ok) {
                        const data = await response.json();
                        if (data.status === 'success') {
                            addMessage(data.response, 'tutor');
                        } else {
                            addMessage('⚠️ Sorry, could not process request.', 'tutor');
                        }
                    } else {
                        addMessage('⚠️ Server error occurred.', 'tutor');
                    }
                } catch (error) {
                    console.error(error);
                    typingIndicator.classList.add('hidden');
                    addMessage('❌ Network connection error.', 'tutor');
                }
                scrollToBottom();
            }

            function addMessage(text, sender) {
                const div = document.createElement('div');
                div.className = `message ${sender}`;
                
                const label = document.createElement('span');
                label.className = 'avatar-label';
                label.textContent = sender === 'own' ? '✦ You' : '✦ AI Tutor';

                const bubble = document.createElement('div');
                bubble.className = 'msg-bubble';
                // Convert markdown-like newlines to HTML breaks
                bubble.innerHTML = text.replace(/\n/g, '<br>');

                div.appendChild(label);
                div.appendChild(bubble);
                chatMessages.appendChild(div);
            }

            function scrollToBottom() {
                chatMessages.scrollTop = chatMessages.scrollHeight;
            }
        });
    </script>
</body>
</html>
