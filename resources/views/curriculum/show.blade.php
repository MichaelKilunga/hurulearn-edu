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
            border-right: 1px solid var(--border); display: flex; flex-direction: column; gap: 1.8rem;
            scrollbar-width: thin; position: relative;
        }
        .reading-panel::-webkit-scrollbar { width: 6px; }
        .reading-panel::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.1); border-radius: 3px; }
        
        .reading-header h2 { font-family: 'Space Grotesk', sans-serif; font-size: 2rem; line-height: 1.3; background: linear-gradient(135deg, #white 30%, var(--gray-400)); -webkit-background-clip: text; -webkit-text-fill-color: transparent; margin-bottom: 1rem; }
        .reading-tags { display: flex; gap: 0.5rem; flex-wrap: wrap; }
        .tag-pill { font-size: 0.72rem; padding: 0.25rem 0.65rem; border-radius: 6px; background: rgba(255,255,255,0.05); border: 1px solid var(--border); color: var(--gray-400); text-transform: uppercase; font-weight: 600; }

        .reading-summary { border-left: 3px solid var(--amber); padding-left: 1.2rem; margin: 0.5rem 0; font-style: italic; color: var(--gray-400); font-size: 0.98rem; line-height: 1.6; }
        
        .reading-body { font-size: 1.1rem; line-height: 1.8; color: var(--gray-100); display: flex; flex-direction: column; gap: 0.75rem; transition: font-size 0.2s ease; }

        /* Interactive Paragraph Steps */
        .paragraph-step {
            display: flex; gap: 0.9rem; align-items: flex-start; padding: 0.85rem; 
            border-radius: 12px; transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1); 
            border: 1px solid transparent; cursor: pointer; position: relative;
        }
        .paragraph-step:hover {
            background: rgba(255, 255, 255, 0.03);
            border-color: rgba(255, 255, 255, 0.06);
        }
        .paragraph-step.read {
            background: rgba(20, 184, 166, 0.015);
            border-color: rgba(20, 184, 166, 0.06);
        }
        .paragraph-step.read .step-checkbox {
            border-color: #14b8a6 !important;
            background: #14b8a6 !important;
            color: #0f0d2e !important;
        }
        .paragraph-step.read .paragraph-content p {
            color: var(--gray-400);
        }

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
        .chat-header h3::before { content: ''; display: inline-block; width: 8px; height: 8px; border-radius: 50%; background: #10b981; box-shadow: 0 0 8px #10b981; animation: pulse 1.5s infinite; }

        .chat-messages { flex: 1; overflow-y: auto; padding: 2rem 1.8rem; display: flex; flex-direction: column; gap: 1.5rem; scroll-behavior: smooth; }
        .chat-messages::-webkit-scrollbar { width: 4px; }
        .chat-messages::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.06); border-radius: 2px; }

        .message { display: flex; flex-direction: column; gap: 0.4rem; max-width: 85%; animation: slideIn 0.3s cubic-bezier(0.4, 0, 0.2, 1) forwards; }
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

        .btn { display: inline-flex; align-items: center; justify-content: center; padding: .6rem 1.3rem; border-radius: 10px; font-size: .875rem; font-weight: 600; cursor: pointer; border: none; transition: all .2s; text-decoration: none; font-family: inherit; }
        .btn-outline { background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.12); color: #fff; }
        .btn-outline:hover { background: rgba(255,255,255,0.08); border-color: var(--blue-light); }
        .btn-primary { background: linear-gradient(135deg, var(--amber), #e67e22); color: #fff; box-shadow: 0 4px 15px rgba(245,158,11,0.25); }
        .btn-primary:hover { transform: translateY(-1px); box-shadow: 0 6px 20px rgba(245,158,11,0.35); }
        .btn-ghost { background: rgba(255,255,255,0.06); color: var(--gray-300); border: 1px solid rgba(255,255,255,0.1); }
        .btn-ghost:hover { background: rgba(255,255,255,0.1); }

        @keyframes pulse {
            0% { transform: scale(0.9); opacity: 0.5; }
            50% { transform: scale(1.1); opacity: 1; }
            100% { transform: scale(0.9); opacity: 0.5; }
        }

        @keyframes typing {
            0%, 100% { transform: translateY(0); opacity: 0.4; }
            50% { transform: translateY(-5px); opacity: 1; }
        }

        @keyframes slideIn {
            from { opacity: 0; transform: translateY(12px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes confetti-fall {
            0% { transform: translateY(0) rotate(0deg); opacity: 1; }
            100% { transform: translateY(105vh) rotate(360deg); opacity: 0; }
        }

        /* ── Audio Feature Styles ────────────────────────────── */
        .btn-mic {
            background: rgba(255, 255, 255, 0.06); border: 1px solid rgba(255, 255, 255, 0.1);
            color: var(--gray-400); width: 38px; height: 38px; border-radius: 10px;
            display: flex; align-items: center; justify-content: center; cursor: pointer;
            font-size: 1rem; flex-shrink: 0; transition: all 0.25s ease;
        }
        .btn-mic:hover { background: rgba(59, 130, 246, 0.15); border-color: rgba(59, 130, 246, 0.4); color: var(--blue-light); }
        .btn-mic.recording { background: rgba(239, 68, 68, 0.15); border-color: rgba(239, 68, 68, 0.5); color: #ef4444; animation: mic-pulse 1.2s infinite ease-in-out; }
        .btn-mic.unsupported { display: none; }

        @keyframes mic-pulse {
            0%, 100% { box-shadow: 0 0 0 0 rgba(239, 68, 68, 0.4); }
            50%       { box-shadow: 0 0 0 8px rgba(239, 68, 68, 0); }
        }

        /* Auto-Read Toggle */
        .btn-auto-read {
            background: rgba(255, 255, 255, 0.04); border: 1px solid rgba(255, 255, 255, 0.08);
            color: var(--gray-400); padding: 0.35rem 0.75rem; border-radius: 8px;
            font-size: 0.75rem; font-weight: 600; cursor: pointer; transition: all 0.2s; white-space: nowrap;
        }
        .btn-auto-read:hover { background: rgba(167, 139, 250, 0.1); border-color: rgba(167, 139, 250, 0.3); color: #a78bfa; }
        .btn-auto-read.active { background: rgba(167, 139, 250, 0.15); border-color: rgba(167, 139, 250, 0.5); color: #c4b5fd; }

        /* Read-Aloud Button */
        .btn-read-aloud {
            background: transparent; border: none; color: rgba(156, 163, 175, 0.5);
            font-size: 0.72rem; cursor: pointer; padding: 2px 6px; border-radius: 6px;
            display: flex; align-items: center; gap: 4px; transition: all 0.2s;
            align-self: flex-start; margin-top: 2px;
        }
        .btn-read-aloud:hover { color: #a78bfa; background: rgba(167, 139, 250, 0.1); }
        .btn-read-aloud.speaking { color: #a78bfa; }
        .btn-read-aloud .wave { display: inline-flex; gap: 2px; align-items: flex-end; height: 11px; }
        .btn-read-aloud .wave span {
            display: inline-block; width: 2px; background: #a78bfa;
            border-radius: 2px; animation: wave-bar 0.8s infinite ease-in-out;
        }
        .btn-read-aloud .wave span:nth-child(1) { height: 4px;  animation-delay: 0s; }
        .btn-read-aloud .wave span:nth-child(2) { height: 9px;  animation-delay: 0.15s; }
        .btn-read-aloud .wave span:nth-child(3) { height: 6px;  animation-delay: 0.3s; }
        .btn-read-aloud .wave span:nth-child(4) { height: 9px;  animation-delay: 0.45s; }
        .btn-read-aloud .wave span:nth-child(5) { height: 4px;  animation-delay: 0.6s; }
        @keyframes wave-bar {
            0%, 100% { transform: scaleY(0.4); opacity: 0.6; }
            50%       { transform: scaleY(1); opacity: 1; }
        }

        /* Mic banner */
        #mic-status-banner {
            padding: 0.45rem 1.8rem; background: rgba(239, 68, 68, 0.08);
            border-top: 1px solid rgba(239, 68, 68, 0.18); font-size: 0.78rem;
            color: #fca5a5; display: flex; align-items: center; gap: 0.5rem;
        }
        #mic-status-banner .pulse-dot { width: 7px; height: 7px; background: #ef4444; border-radius: 50%; animation: mic-pulse 1s infinite; flex-shrink: 0; }

        /* ── Listen to Notes Player ────────────────────────────── */

        /* Floating sticky player bar at bottom of reading panel */
        #listen-player {
            position: sticky; bottom: 0;
            background: rgba(10, 9, 35, 0.96);
            backdrop-filter: blur(16px);
            border-top: 1px solid rgba(167, 139, 250, 0.25);
            padding: 0.9rem 1.2rem;
            display: none;         /* shown when listening starts */
            flex-direction: column;
            gap: 0.65rem;
            z-index: 20;
            border-radius: 0 0 0 0;
            animation: slideUp 0.3s ease;
        }
        @keyframes slideUp {
            from { opacity: 0; transform: translateY(12px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        /* Player track bar */
        .player-track {
            display: flex; align-items: center; gap: 0.65rem;
        }
        .player-track-bar {
            flex: 1; height: 4px; background: rgba(255,255,255,0.08);
            border-radius: 4px; overflow: hidden; cursor: pointer;
        }
        .player-track-fill {
            height: 100%;
            background: linear-gradient(90deg, #a78bfa, #60a5fa);
            border-radius: 4px;
            transition: width 0.4s linear;
            width: 0%;
        }
        .player-track-label {
            font-size: 0.7rem; color: var(--gray-400); white-space: nowrap; min-width: 60px; text-align: right;
        }

        /* Player controls */
        .player-controls {
            display: flex; align-items: center; gap: 0.6rem; flex-wrap: wrap;
        }
        .btn-player {
            background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.1);
            color: #e5e7eb; border-radius: 10px; padding: 0.4rem 0.8rem;
            font-size: 0.78rem; font-weight: 600; cursor: pointer;
            display: flex; align-items: center; gap: 0.4rem;
            transition: all 0.2s; white-space: nowrap;
        }
        .btn-player:hover { background: rgba(167,139,250,0.15); border-color: rgba(167,139,250,0.4); color: #c4b5fd; }
        .btn-player.active { background: rgba(167,139,250,0.2); border-color: #a78bfa; color: #c4b5fd; }
        .btn-player.btn-play-pause {
            background: linear-gradient(135deg, #7c3aed, #4f46e5);
            border: none; color: #fff; padding: 0.45rem 1rem;
            box-shadow: 0 3px 10px rgba(124,58,237,0.3);
        }
        .btn-player.btn-play-pause:hover { box-shadow: 0 4px 14px rgba(124,58,237,0.45); transform: scale(1.03); }

        .player-info {
            flex: 1; font-size: 0.75rem; color: var(--gray-400);
            white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
        }
        .player-info strong { color: #a78bfa; font-weight: 700; }

        /* Speed badge */
        .speed-badge {
            font-size: 0.7rem; font-weight: 700; background: rgba(255,255,255,0.08);
            border: 1px solid rgba(255,255,255,0.1); color: var(--gray-400);
            padding: 0.3rem 0.55rem; border-radius: 7px; cursor: pointer;
            transition: all 0.2s; min-width: 42px; text-align: center;
        }
        .speed-badge:hover { background: rgba(167,139,250,0.15); border-color: rgba(167,139,250,0.4); color: #a78bfa; }

        /* Paragraph currently being read – highlight */
        .paragraph-step.listening-active {
            background: rgba(124, 58, 237, 0.07) !important;
            border-color: rgba(124, 58, 237, 0.25) !important;
            box-shadow: 0 0 0 1px rgba(124, 58, 237, 0.15);
        }
        .paragraph-step.listening-active .paragraph-content p {
            color: #e9d5ff !important;
        }

        /* Listen button in toolbar */
        .btn-listen {
            background: rgba(124, 58, 237, 0.12);
            border: 1px solid rgba(124, 58, 237, 0.3);
            color: #c4b5fd;
            padding: 0.3rem 0.8rem;
            border-radius: 8px;
            font-size: 0.75rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            white-space: nowrap;
            display: flex;
            align-items: center;
            gap: 0.35rem;
        }
        .btn-listen:hover { background: rgba(124,58,237,0.22); border-color: #a78bfa; color: #e9d5ff; }
        .btn-listen.listening { background: rgba(239,68,68,0.12); border-color: rgba(239,68,68,0.4); color: #fca5a5; }

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
            <!-- Sticky Reading progress & font controllers -->
            <div style="position: sticky; top: -3.1rem; background: rgba(15,13,46,0.95); backdrop-filter: blur(12px); padding: 1rem 0; z-index: 10; border-bottom: 1px solid var(--border); margin-bottom: 1.5rem; display: flex; align-items: center; justify-content: space-between; gap: 1rem; width: 100%;">
                <div style="flex: 1;">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.4rem; font-size: 0.75rem;">
                        <span style="color: var(--gray-400); font-weight: 600; letter-spacing: 0.05em;">PROGRESS / MAENDELEO:</span>
                        <span id="reading-percent" style="color: var(--amber); font-weight: 700;">0% Completed</span>
                    </div>
                    <div style="width: 100%; height: 5px; background: rgba(255,255,255,0.06); border-radius: 4px; overflow: hidden;">
                        <div id="reading-progress-bar" style="width: 0%; height: 100%; background: linear-gradient(90deg, var(--amber), #14b8a6); border-radius: 4px; transition: width 0.3s ease;"></div>
                    </div>
                </div>
                
                <div style="display: flex; align-items: center; gap: 0.5rem; flex-shrink: 0;">
                    <!-- 🎧 Listen to Notes button -->
                    <button type="button" id="listen-btn" class="btn-listen" title="Listen to the notes being read aloud">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="currentColor"><path d="M12 3a9 9 0 0 0-9 9v7c0 1.1.9 2 2 2h1v-8H4v-1a8 8 0 0 1 16 0v1h-2v8h1c1.1 0 2-.9 2-2v-7a9 9 0 0 0-9-9z"/></svg>
                        Listen
                    </button>
                    <!-- Font scaler controls -->
                    <div style="display: flex; align-items: center; gap: 0.3rem; background: rgba(255,255,255,0.03); border: 1px solid var(--border); padding: 0.15rem 0.45rem; border-radius: 8px;">
                        <button type="button" id="font-dec" style="background: transparent; border: none; color: var(--gray-400); cursor: pointer; padding: 0.2rem 0.4rem; font-size: 0.7rem; font-weight: 600;" title="Smaller text">A-</button>
                        <button type="button" id="font-reset" style="background: transparent; border: none; color: var(--amber); cursor: pointer; padding: 0.2rem 0.4rem; font-size: 0.7rem; font-weight: 700;" title="Reset text size">A</button>
                        <button type="button" id="font-inc" style="background: transparent; border: none; color: var(--gray-400); cursor: pointer; padding: 0.2rem 0.4rem; font-size: 0.7rem; font-weight: 600;" title="Larger text">A+</button>
                    </div>
                </div>
            </div>

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

            <!-- Reading Body split into interactive steps -->
            <div class="reading-body">
                @php $paragraphIndex = 0; @endphp
                @foreach(preg_split('/\n+/', $curriculum->content) as $paragraph)
                    @if(trim($paragraph))
                        @php $paragraphIndex++; @endphp
                        <div class="paragraph-step" data-step="{{ $paragraphIndex }}">
                            <div class="step-checkbox-wrapper" style="margin-top: 0.18rem; flex-shrink: 0;">
                                <div class="step-checkbox" style="width: 18px; height: 18px; border-radius: 50%; border: 1.5px solid var(--border); display: flex; align-items: center; justify-content: center; font-size: 0.6rem; color: transparent; transition: all 0.2s ease; background: rgba(255,255,255,0.01); font-weight: 900;">✓</div>
                            </div>
                            <div class="paragraph-content" style="flex: 1;">
                                <p style="margin: 0; text-align: justify; transition: color 0.25s; font-size: inherit; line-height: inherit;">{{ trim($paragraph) }}</p>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>

            <!-- Complete Topic Action Button -->
            <div style="margin-top: 3rem; padding-top: 2rem; border-top: 1px solid var(--border); text-align: center;">
                <button type="button" id="complete-topic-btn" class="btn btn-outline" style="padding: 0.85rem 2rem; font-size: 0.95rem; border-color: #14b8a6; color: #fff; background: rgba(20, 184, 166, 0.05); gap: 0.75rem; border-radius: 12px; transition: all 0.3s ease;">
                    <span id="complete-btn-icon">🔘</span>
                    <span id="complete-btn-text">Mark Topic as Completed</span>
                </button>
            </div>

            {{-- ── Listen-to-Notes floating player bar ── --}}
            <div id="listen-player">
                {{-- Track progress bar --}}
                <div class="player-track">
                    <span class="player-track-label" id="player-para-counter">0 / 0</span>
                    <div class="player-track-bar" id="player-track-bar" title="Click to seek">
                        <div class="player-track-fill" id="player-track-fill"></div>
                    </div>
                    <span class="speed-badge" id="player-speed-badge" title="Change reading speed">1×</span>
                </div>
                {{-- Controls --}}
                <div class="player-controls">
                    <button type="button" id="player-prev" class="btn-player" title="Previous paragraph">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="currentColor"><path d="M6 6h2v12H6zm3.5 6 8.5 6V6z"/></svg>
                    </button>
                    <button type="button" id="player-play-pause" class="btn-player btn-play-pause" title="Play / Pause">
                        <svg id="player-play-icon" width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M8 5v14l11-7z"/></svg>
                        <span id="player-play-label">Play Notes</span>
                    </button>
                    <button type="button" id="player-next" class="btn-player" title="Next paragraph">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="currentColor"><path d="M6 18l8.5-6L6 6v12zm2.5-6 5.5-3.9v7.8L8.5 12zM16 6h2v12h-2z"/></svg>
                    </button>
                    <button type="button" id="player-stop" class="btn-player" title="Stop and close player">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="currentColor"><path d="M6 6h12v12H6z"/></svg>
                        Stop
                    </button>
                    <span class="player-info" id="player-info-text">
                        {{ $curriculum->language == 'sw' ? 'Inasoma madhehebu...' : 'Reading notes...' }}
                    </span>
                </div>
            </div>
        </article>

        <!-- Right Panel: Interactive AI Tutor -->
        <section class="chat-panel">
            <div class="chat-header">
                <h3>AI Study Assistant</h3>
                <div style="display: flex; align-items: center; gap: 0.6rem;">
                    <button id="auto-read-toggle" class="btn-auto-read" title="Auto-read AI responses aloud">🔊 Auto</button>
                    <span style="font-size: 0.75rem; color: var(--gray-400);">Guided Tutoring</span>
                </div>
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

            {{-- Mic recording status banner --}}
            <div id="mic-status-banner" style="display:none;">
                <span class="pulse-dot"></span>
                <span id="mic-status-text">Listening... Speak your question</span>
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
                    <button type="button" id="mic-btn" class="btn-mic" title="Speak your question">🎤</button>
                    <textarea id="chat-input" placeholder="Type or tap 🎤 to speak..." autocomplete="off"></textarea>
                    <button type="submit" class="send-btn">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="22" y1="2" x2="11" y2="13"></line><polyline points="22 2 15 22 11 13 2 9 22 2"></polyline></svg>
                    </button>
                </form>
            </div>
        </section>
    </div>

    <!-- Celebration Modal overlay -->
    <div id="completion-modal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(15,13,46,0.85); backdrop-filter: blur(8px); z-index: 1000; align-items: center; justify-content: center; opacity: 0; transition: opacity 0.3s ease;">
        <div style="background: var(--indigo-dark); border: 1px solid var(--border); max-width: 460px; width: 90%; border-radius: 24px; padding: 2.5rem 2rem; text-align: center; box-shadow: 0 20px 50px rgba(0,0,0,0.5); transform: scale(0.9); transition: transform 0.3s ease;" id="completion-modal-content">
            <div style="font-size: 3.5rem; margin-bottom: 1rem;">🎉</div>
            <h3 style="font-family: 'Space Grotesk', sans-serif; font-size: 1.6rem; color: var(--white); margin-bottom: 0.5rem;">Hongera! Congratulations!</h3>
            <p style="font-size: 0.95rem; color: var(--gray-400); line-height: 1.55; margin-bottom: 2rem;">
                @if($curriculum->language == 'sw')
                    Umekamilisha kusoma mada hii ya **"{{ $curriculum->title }}"**. Je, uko tayari kujipima uelewa wako na Mwalimu wetu wa AI?
                @else
                    You have completed reading the topic **"{{ $curriculum->title }}"**. Ready to test your understanding with our AI Tutor?
                @endif
            </p>
            <div style="display: flex; flex-direction: column; gap: 0.75rem;">
                <button id="modal-quiz-btn" class="btn btn-primary" style="justify-content: center; font-size: 0.95rem; padding: 0.8rem;">
                    📝 Quiz Me Now / Nipime Maswali
                </button>
                <button id="modal-close-btn" class="btn btn-ghost" style="justify-content: center; font-size: 0.9rem; padding: 0.7rem; border-color: transparent;">
                    Tutaendelea Baadaye / Maybe Later
                </button>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const chatMessages = document.getElementById('chat-messages');
            const tutorChatForm = document.getElementById('tutor-chat-form');
            const chatInput = document.getElementById('chat-input');
            const typingIndicator = document.getElementById('typing-indicator');

            // ══════════════════════════════════════════════════════════
            //  TEXT SCALING & STEP PROGRESS
            // ══════════════════════════════════════════════════════════
            
            // Font Scaling
            const fontDec = document.getElementById('font-dec');
            const fontInc = document.getElementById('font-inc');
            const fontReset = document.getElementById('font-reset');
            const readingBody = document.querySelector('.reading-body');
            let currentFontSize = 1.1; // in rem

            if (fontDec && fontInc && fontReset && readingBody) {
                fontDec.addEventListener('click', (e) => {
                    e.stopPropagation();
                    if (currentFontSize > 0.85) {
                        currentFontSize -= 0.1;
                        readingBody.style.fontSize = `${currentFontSize}rem`;
                    }
                });
                fontInc.addEventListener('click', (e) => {
                    e.stopPropagation();
                    if (currentFontSize < 1.6) {
                        currentFontSize += 0.1;
                        readingBody.style.fontSize = `${currentFontSize}rem`;
                    }
                });
                fontReset.addEventListener('click', (e) => {
                    e.stopPropagation();
                    currentFontSize = 1.1;
                    readingBody.style.fontSize = `${currentFontSize}rem`;
                });
            }

            // Paragraph Checking & Step Progress
            const steps = document.querySelectorAll('.paragraph-step');
            const readingProgressBar = document.getElementById('reading-progress-bar');
            const readingPercentText = document.getElementById('reading-percent');
            const completeTopicBtn = document.getElementById('complete-topic-btn');
            const completeBtnText = document.getElementById('complete-btn-text');
            const completeBtnIcon = document.getElementById('complete-btn-icon');

            const curriculumId = '{{ $curriculum->id }}';
            const progressStorageKey = `hurulearn_steps_completed_${curriculumId}`;
            const completeStorageKey = `hurulearn_completed_curriculum_${curriculumId}`;

            // Load saved progress from localStorage
            let completedSteps = [];
            try {
                const saved = localStorage.getItem(progressStorageKey);
                if (saved) completedSteps = JSON.parse(saved);
            } catch(e) { console.error('Failed to load steps from localStorage', e); }

            // Initialize checkboxes according to stored values
            steps.forEach(step => {
                const stepNum = parseInt(step.getAttribute('data-step'));
                if (completedSteps.includes(stepNum)) {
                    step.classList.add('read');
                }

                // Attach click handler to toggle read state
                step.addEventListener('click', () => {
                    const activeStepNum = parseInt(step.getAttribute('data-step'));
                    if (step.classList.contains('read')) {
                        step.classList.remove('read');
                        completedSteps = completedSteps.filter(id => id !== activeStepNum);
                    } else {
                        step.classList.add('read');
                        completedSteps.push(activeStepNum);
                    }
                    localStorage.setItem(progressStorageKey, JSON.stringify(completedSteps));
                    updateProgressUI();
                });
            });

            // Handle persistence of overall completion
            const isTopicCompleted = localStorage.getItem(completeStorageKey) === 'true';
            if (isTopicCompleted) {
                markTopicAsCompletedUI(false); // don't fire confetti on initial page load
            }

            function updateProgressUI() {
                if (steps.length === 0) return;
                const ratio = completedSteps.length / steps.length;
                const pct = Math.round(ratio * 100);
                
                if (readingProgressBar) readingProgressBar.style.width = `${pct}%`;
                if (readingPercentText) readingPercentText.textContent = `${pct}% Completed`;

                // Highlight complete button when finished
                if (pct === 100) {
                    completeTopicBtn.style.borderColor = '#10b981';
                    completeTopicBtn.style.background = 'rgba(16, 185, 129, 0.15)';
                    completeTopicBtn.style.boxShadow = '0 0 15px rgba(16, 185, 129, 0.2)';
                } else if (localStorage.getItem(completeStorageKey) !== 'true') {
                    completeTopicBtn.style.borderColor = '#14b8a6';
                    completeTopicBtn.style.background = 'rgba(20, 184, 166, 0.05)';
                    completeTopicBtn.style.boxShadow = 'none';
                }
            }

            function markTopicAsCompletedUI(shouldTriggerConfetti = true) {
                localStorage.setItem(completeStorageKey, 'true');
                if (completeBtnText) completeBtnText.textContent = 'Topic Completed! (Read Again)';
                if (completeBtnIcon) completeBtnIcon.textContent = '✅';
                if (completeTopicBtn) {
                    completeTopicBtn.style.borderColor = '#10b981';
                    completeTopicBtn.style.background = 'rgba(16, 185, 129, 0.1)';
                    completeTopicBtn.style.color = '#a7f3d0';
                }

                if (shouldTriggerConfetti) {
                    triggerConfetti();
                    setTimeout(showCompletionModal, 600);
                }
            }

            // Click complete button manually
            if (completeTopicBtn) {
                completeTopicBtn.addEventListener('click', () => {
                    // Mark all paragraphs as read on completion
                    completedSteps = Array.from({length: steps.length}, (_, i) => i + 1);
                    localStorage.setItem(progressStorageKey, JSON.stringify(completedSteps));
                    steps.forEach(step => step.classList.add('read'));
                    updateProgressUI();
                    markTopicAsCompletedUI(true);
                });
            }

            // Initial UI state setup
            updateProgressUI();

            // Confetti Generation helper
            function triggerConfetti() {
                const colors = ['#f59e0b', '#3b82f6', '#14b8a6', '#ef4444', '#a78bfa'];
                for (let i = 0; i < 75; i++) {
                    const confetti = document.createElement('div');
                    confetti.style.background = colors[Math.floor(Math.random() * colors.length)];
                    confetti.style.left = Math.random() * 100 + 'vw';
                    confetti.style.top = '-20px';
                    confetti.style.width = Math.random() * 8 + 6 + 'px';
                    confetti.style.height = Math.random() * 14 + 10 + 'px';
                    confetti.style.position = 'fixed';
                    confetti.style.zIndex = '9999';
                    confetti.style.borderRadius = '2px';
                    confetti.style.opacity = Math.random() * 0.7 + 0.3;
                    confetti.style.transform = `rotate(${Math.random() * 360}deg)`;
                    
                    const duration = Math.random() * 2 + 1.5;
                    const fallDelay = Math.random() * 0.25;
                    confetti.style.animation = `confetti-fall ${duration}s linear ${fallDelay}s forwards`;
                    
                    document.body.appendChild(confetti);
                    setTimeout(() => confetti.remove(), (duration + fallDelay) * 1000);
                }
            }

            // ══════════════════════════════════════════════════════════
            //  CELEBRATION MODAL ACTIONS
            // ══════════════════════════════════════════════════════════
            const completionModal = document.getElementById('completion-modal');
            const completionModalContent = document.getElementById('completion-modal-content');
            const modalCloseBtn = document.getElementById('modal-close-btn');
            const modalQuizBtn = document.getElementById('modal-quiz-btn');

            function showCompletionModal() {
                if (!completionModal) return;
                completionModal.style.display = 'flex';
                setTimeout(() => {
                    completionModal.style.opacity = '1';
                    if (completionModalContent) completionModalContent.style.transform = 'scale(1)';
                }, 50);
            }

            function closeCompletionModal() {
                if (!completionModal) return;
                completionModal.style.opacity = '0';
                if (completionModalContent) completionModalContent.style.transform = 'scale(0.9)';
                setTimeout(() => {
                    completionModal.style.display = 'none';
                }, 300);
            }

            if (modalCloseBtn) modalCloseBtn.addEventListener('click', closeCompletionModal);
            if (completionModal) {
                completionModal.addEventListener('click', (e) => {
                    if (e.target === completionModal) closeCompletionModal();
                });
            }

            if (modalQuizBtn) {
                modalQuizBtn.addEventListener('click', () => {
                    closeCompletionModal();
                    // Choose correct quiz trigger query based on language
                    const quizQuery = '{{ $curriculum->language }}' === 'sw' 
                        ? 'Niazishe swali la kwanza la zoezi' 
                        : 'Start the first quiz question';
                    submitQuery(quizQuery);
                });
            }

            // ══════════════════════════════════════════════════════════
            //  CHAT ACTIONS & SUBMIT
            // ══════════════════════════════════════════════════════════

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

                // Add Read-Aloud button for tutor messages only
                if (sender === 'tutor') {
                    const readBtn = document.createElement('button');
                    readBtn.className = 'btn-read-aloud';
                    readBtn.title = 'Read aloud';
                    readBtn.innerHTML = `<svg width="12" height="12" viewBox="0 0 24 24" fill="currentColor"><path d="M3 9v6h4l5 5V4L7 9H3zm13.5 3c0-1.77-1.02-3.29-2.5-4.03v8.05c1.48-.73 2.5-2.25 2.5-4.02zM14 3.23v2.06c2.89.86 5 3.54 5 6.71s-2.11 5.85-5 6.71v2.06c4.01-.91 7-4.49 7-8.77s-2.99-7.86-7-8.77z"/></svg> Read`;
                    readBtn.addEventListener('click', () => {
                        const plain = text.replace(/<[^>]*>/g, ' ').replace(/\s+/g, ' ').trim();
                        if (readBtn.classList.contains('speaking')) {
                            audioEngine.stop();
                        } else {
                            audioEngine.speak(plain, readBtn);
                        }
                    });
                    div.appendChild(readBtn);

                    // Auto-read if enabled
                    if (autoReadEnabled) {
                        setTimeout(() => {
                            const plain = text.replace(/<[^>]*>/g, ' ').replace(/\s+/g, ' ').trim();
                            audioEngine.speak(plain, readBtn);
                        }, 300);
                    }
                }

                chatMessages.appendChild(div);
            }

            function scrollToBottom() {
                chatMessages.scrollTop = chatMessages.scrollHeight;
            }

            // ══════════════════════════════════════════════════════════
            //  AUDIO ENGINE  —  Speech Recognition (STT) + Synthesis (TTS)
            // ══════════════════════════════════════════════════════════

            // Detect curriculum language for default STT/TTS language
            const curriculumLang = '{{ $curriculum->language }}' === 'sw' ? 'sw-TZ' : 'en-US';

            // ── Voice Intelligence Engine ────────────────────────────────
            // Score-based language detection + natural voice selection
            // Optimised for Tanzanian students reading Swahili & English
            const VoiceIntelligence = {
                _voices: [],

                init() {
                    const load = () => { this._voices = speechSynthesis.getVoices(); };
                    this._voices = speechSynthesis.getVoices();
                    speechSynthesis.onvoiceschanged = load;
                },

                /**
                 * Determines the correct TTS language from the text content.
                 * Uses frequency scoring so a passage cannot be misidentified
                 * just because one Swahili particle appears in English text, or vice versa.
                 *
                 * hintLang — 'sw-TZ' | 'en-US' | 'auto'
                 *   sw-TZ : strong bias toward Swahili (used when curriculum is Swahili)
                 *   en-US : bias toward English (English curriculum)
                 *   auto  : Tanzania-first heuristic (used in open chat)
                 */
                detectLang(text, hintLang) {
                    const words = text.toLowerCase()
                        .replace(/[^a-z\s]/g, ' ')
                        .split(/\s+/)
                        .filter(w => w.length > 1);

                    if (!words.length) return hintLang === 'auto' ? 'sw-TZ' : hintLang;

                    const swSet = new Set([
                        // Particles / prepositions
                        'na','ya','wa','kwa','ni','la','za','cha','mwa','pa','au','tu',
                        // Adverbs
                        'sana','zaidi','kidogo','vizuri','haraka','hapa','pale','sasa',
                        'bado','tena','hata','pia','kabisa','kweli','kwanza',
                        // Demonstratives / pronouns
                        'hii','hizi','huo','hizo','hao','yote','zote','wake','wao',
                        'yake','yao','huyu','hawa','hiyo','hili','haya','hilo',
                        // Copula / stative
                        'iko','ipo','imo','yupo','wako','wapo','wamo','liko','lipo',
                        // Common expressions
                        'habari','asante','tafadhali','samahani','karibu','ndiyo',
                        'hapana','sawa','nzuri','kwaheri','pole','hongera',
                        // Education vocabulary
                        'mwanafunzi','wanafunzi','mwalimu','walimu','shule','darasa',
                        'kitabu','vitabu','somo','masomo','mtihani','swali','maswali',
                        'jibu','majibu','elimu','lugha','kiswahili','hesabu','historia',
                        'sayansi','kanuni','mada','sehemu','ubao','kalamu','faida',
                        // Conjunctions / subordinators
                        'kuhusu','jinsi','kwamba','lakini','ingawa','baada','kabla',
                        'wakati','pamoja','badala','kama','bila','ikiwa','japo',
                        // Subject pronouns
                        'mimi','wewe','yeye','sisi','nyinyi',
                        // Common infinitives
                        'kusoma','kuandika','kuelewa','kujua','kuona','kusikia',
                        'kufanya','kuwa','kwenda','kurudi','kufika','kupata',
                        'kujifunza','kuuliza','kujibu','kucheza','kufungua',
                    ]);

                    const enSet = new Set([
                        'the','a','an','is','are','was','were','be','been','being',
                        'have','has','had','do','does','did','will','would','could',
                        'should','may','might','can','shall','must','need',
                        'this','that','these','those','it','its','they','their','there',
                        'he','she','we','you','your','our','my','his','her',
                        'and','but','or','nor','for','so','yet','however','therefore',
                        'because','although','though','while','when','where','which',
                        'who','what','how','why','if','then','than','as',
                        'at','in','on','of','to','from','with','by','about','into',
                        'through','during','before','after','above','below','between',
                        'not','no','never','also','just','now','here','very','well',
                        'only','all','both','each','every','some','any','few','more',
                        'such','like','even','still','already','yet','again',
                    ]);

                    let swScore = 0, enScore = 0;
                    for (const w of words) {
                        if (swSet.has(w)) swScore++;
                        if (enSet.has(w)) enScore++;
                    }

                    const total   = words.length;
                    const swRatio = swScore / total;
                    const enRatio = enScore / total;

                    if (hintLang === 'sw-TZ') {
                        // Strong Swahili bias — only override when English dominates clearly
                        return (enRatio > swRatio * 2.2 && enRatio > 0.12) ? 'en-US' : 'sw-TZ';
                    }
                    if (hintLang === 'en-US') {
                        // English bias — switch to Swahili only when unambiguous
                        return (swRatio > enRatio * 1.5 && swRatio > 0.06) ? 'sw-TZ' : 'en-US';
                    }
                    // 'auto' (open chat) — Tanzania-first, default to Swahili unless clearly English
                    return (enRatio > swRatio * 1.8 && enRatio > 0.10) ? 'en-US' : 'sw-TZ';
                },

                /**
                 * Select the most natural available voice for the given language.
                 * Priority: Google online > Neural/Natural > any matching locale > fallback
                 * For Swahili with no sw voice: falls back to en-GB (clearest for African ears).
                 */
                pickVoice(lang) {
                    const voices  = this._voices.length ? this._voices : speechSynthesis.getVoices();
                    const code    = lang.slice(0, 2); // 'sw' or 'en'
                    const natural = v => !v.localService
                        || v.name.includes('Google')
                        || v.name.includes('Neural')
                        || v.name.includes('Natural')
                        || v.name.includes('Online');

                    if (code === 'sw') {
                        return voices.find(v => v.name.includes('Google') && v.lang.startsWith('sw'))
                            || voices.find(v => v.lang.startsWith('sw'))
                            // No Swahili voice — use British English (most neutral for TZ listeners)
                            || voices.find(v => v.name.includes('Google') && v.lang === 'en-GB')
                            || voices.find(v => v.name.includes('Google') && v.lang.startsWith('en'))
                            || voices.find(v => v.lang === 'en-GB')
                            || voices.find(v => natural(v) && v.lang.startsWith('en'))
                            || voices.find(v => v.lang.startsWith('en'))
                            || null;
                    }

                    return voices.find(v => natural(v) && v.lang === lang)
                        || voices.find(v => natural(v) && v.lang.startsWith(code))
                        || voices.find(v => v.lang === lang)
                        || voices.find(v => v.lang.startsWith(code))
                        || null;
                },

                /**
                 * Returns a natural speech rate for the given language.
                 * Swahili is slightly slower to preserve syllable clarity.
                 */
                getRate(lang, speedMultiplier = 1) {
                    const base = lang.startsWith('sw') ? 0.88 : 0.92;
                    return base * speedMultiplier;
                },
            };
            VoiceIntelligence.init();

            let autoReadEnabled = false;

            // ── Text-to-Speech (TTS) ─────────────────────────────────
            const audioEngine = {
                utterance: null,
                activeBtn: null,

                speak(text, btn) {
                    this.stop();
                    const utter = new SpeechSynthesisUtterance(text);

                    // Smart language detection with curriculum hint
                    utter.lang  = VoiceIntelligence.detectLang(text, curriculumLang);
                    utter.rate  = VoiceIntelligence.getRate(utter.lang);
                    utter.pitch = 1;

                    // Most natural available voice for the detected language
                    const voice = VoiceIntelligence.pickVoice(utter.lang);
                    if (voice) utter.voice = voice;

                    this.utterance = utter;
                    this.activeBtn = btn;

                    if (btn) {
                        btn.classList.add('speaking');
                        btn.innerHTML = `<span class="wave"><span></span><span></span><span></span><span></span><span></span></span> Stop`;
                    }

                    utter.onend  = () => this._resetBtn(btn);
                    utter.onerror = () => this._resetBtn(btn);
                    speechSynthesis.speak(utter);
                },

                stop() {
                    speechSynthesis.cancel();
                    if (this.activeBtn) this._resetBtn(this.activeBtn);
                    this.activeBtn = null;
                    this.utterance = null;
                },

                _resetBtn(btn) {
                    if (!btn) return;
                    btn.classList.remove('speaking');
                    btn.innerHTML = `<svg width="12" height="12" viewBox="0 0 24 24" fill="currentColor"><path d="M3 9v6h4l5 5V4L7 9H3zm13.5 3c0-1.77-1.02-3.29-2.5-4.03v8.05c1.48-.73 2.5-2.25 2.5-4.02zM14 3.23v2.06c2.89.86 5 3.54 5 6.71s-2.11 5.85-5 6.71v2.06c4.01-.91 7-4.49 7-8.77s-2.99-7.86-7-8.77z"/></svg> Read`;
                }
            };

            // Voice list managed by VoiceIntelligence.init() above

            // ── Auto-Read Toggle ──────────────────────────────────────
            const autoReadToggle = document.getElementById('auto-read-toggle');
            if (autoReadToggle) {
                autoReadToggle.addEventListener('click', () => {
                    autoReadEnabled = !autoReadEnabled;
                    autoReadToggle.classList.toggle('active', autoReadEnabled);
                    autoReadToggle.textContent = autoReadEnabled ? '🔊 Auto: ON' : '🔊 Auto';
                    autoReadToggle.title = autoReadEnabled ? 'Click to turn off auto-read' : 'Auto-read AI responses aloud';
                    if (!autoReadEnabled) audioEngine.stop();
                });
            }

            // ── Speech Recognition (STT) ──────────────────────────────
            const micBtn = document.getElementById('mic-btn');
            const micStatusBanner = document.getElementById('mic-status-banner');
            const micStatusText = document.getElementById('mic-status-text');

            const SpeechRecognitionAPI = window.SpeechRecognition || window.webkitSpeechRecognition;

            if (!SpeechRecognitionAPI) {
                if (micBtn) micBtn.classList.add('unsupported');
            } else {
                let recognition = null;
                let isRecording = false;

                function buildRecognition() {
                    const rec = new SpeechRecognitionAPI();
                    rec.continuous = false;
                    rec.interimResults = true;
                    rec.lang = curriculumLang; // Use curriculum's language for STT

                    rec.onstart = () => {
                        isRecording = true;
                        micBtn.classList.add('recording');
                        micBtn.title = 'Stop recording';
                        micBtn.textContent = '⏹';
                        micStatusBanner.style.display = 'flex';
                        micStatusText.textContent = 'Listening... Speak your question';
                        audioEngine.stop();
                    };

                    rec.onresult = (event) => {
                        let interim = '', final = '';
                        for (let i = event.resultIndex; i < event.results.length; i++) {
                            const t = event.results[i][0].transcript;
                            event.results[i].isFinal ? (final += t) : (interim += t);
                        }
                        chatInput.value = final || interim;
                        // Auto-resize textarea
                        chatInput.style.height = 'auto';
                        chatInput.style.height = Math.min(chatInput.scrollHeight, 80) + 'px';
                        if (interim) micStatusText.textContent = `Hearing: "${interim}"`;
                    };

                    rec.onspeechend = () => rec.stop();

                    rec.onend = () => {
                        isRecording = false;
                        micBtn.classList.remove('recording');
                        micBtn.title = 'Speak your question';
                        micBtn.textContent = '🎤';
                        micStatusBanner.style.display = 'none';
                        if (chatInput.value.trim()) chatInput.focus();
                    };

                    rec.onerror = (event) => {
                        isRecording = false;
                        micBtn.classList.remove('recording');
                        micBtn.title = 'Speak your question';
                        micBtn.textContent = '🎤';
                        let msg = 'Could not hear you. Please try again.';
                        if (event.error === 'not-allowed')  msg = 'Microphone access denied. Please allow it in browser settings.';
                        else if (event.error === 'network') msg = 'Network error during voice recognition.';
                        else if (event.error === 'no-speech') msg = 'No speech detected. Tap 🎤 to try again.';
                        micStatusText.textContent = msg;
                        setTimeout(() => { micStatusBanner.style.display = 'none'; }, 3500);
                    };

                    return rec;
                }

                micBtn.addEventListener('click', () => {
                    if (isRecording) {
                        if (recognition) recognition.stop();
                    } else {
                        recognition = buildRecognition();
                        try { recognition.start(); } catch (e) { console.error('STT start error:', e); }
                    }
                });
            }


            // ══════════════════════════════════════════════════════════
            //  LISTEN TO NOTES PLAYER
            // ══════════════════════════════════════════════════════════

            (function initListenPlayer() {

                // Collect all paragraph texts from reading body
                const paragraphSteps = Array.from(document.querySelectorAll('.paragraph-step'));
                const paragraphTexts = paragraphSteps.map(el => {
                    const p = el.querySelector('.paragraph-content p');
                    return p ? p.textContent.trim() : '';
                }).filter(t => t.length > 0);

                if (paragraphTexts.length === 0) return; // no content

                const listenBtn       = document.getElementById('listen-btn');
                const listenPlayer    = document.getElementById('listen-player');
                const playPauseBtn    = document.getElementById('player-play-pause');
                const playLabel       = document.getElementById('player-play-label');
                const playIcon        = document.getElementById('player-play-icon');
                const prevBtn         = document.getElementById('player-prev');
                const nextBtn         = document.getElementById('player-next');
                const stopBtn         = document.getElementById('player-stop');
                const trackFill       = document.getElementById('player-track-fill');
                const trackBar        = document.getElementById('player-track-bar');
                const paraCounter     = document.getElementById('player-para-counter');
                const speedBadge      = document.getElementById('player-speed-badge');
                const infoText        = document.getElementById('player-info-text');
                const readingPanel    = document.querySelector('.reading-panel');

                const speeds = [0.75, 1, 1.25, 1.5];
                let speedIndex = 1;          // default 1×
                let currentPara = 0;         // index of paragraph being read
                let isPlaying   = false;
                let isPaused    = false;
                let playerOpen  = false;

                // ── Helpers ──────────────────────────────────────────
                function openPlayer() {
                    playerOpen = true;
                    listenPlayer.style.display = 'flex';
                    listenBtn.classList.add('listening');
                    listenBtn.innerHTML = `<svg width="13" height="13" viewBox="0 0 24 24" fill="currentColor"><path d="M6 6h12v12H6z"/></svg> Stop`;
                    updateTrack();
                }

                function closePlayer() {
                    playerOpen = false;
                    stopSpeech();
                    isPlaying = false;
                    isPaused  = false;
                    currentPara = 0;
                    listenPlayer.style.display = 'none';
                    listenBtn.classList.remove('listening');
                    listenBtn.innerHTML = `<svg width="13" height="13" viewBox="0 0 24 24" fill="currentColor"><path d="M12 3a9 9 0 0 0-9 9v7c0 1.1.9 2 2 2h1v-8H4v-1a8 8 0 0 1 16 0v1h-2v8h1c1.1 0 2-.9 2-2v-7a9 9 0 0 0-9-9z"/></svg> Listen`;
                    clearHighlight();
                    updateTrack();
                    setPlayIcon(false);
                }

                function stopSpeech() {
                    speechSynthesis.cancel();
                }

                function clearHighlight() {
                    paragraphSteps.forEach(s => s.classList.remove('listening-active'));
                }

                function highlightPara(idx) {
                    clearHighlight();
                    if (paragraphSteps[idx]) {
                        paragraphSteps[idx].classList.add('listening-active');
                        // Scroll the paragraph into view inside the reading panel
                        paragraphSteps[idx].scrollIntoView({ behavior: 'smooth', block: 'center' });
                    }
                }

                function updateTrack() {
                    const total = paragraphTexts.length;
                    const done  = Math.min(currentPara + 1, total);
                    const pct   = total > 0 ? ((currentPara) / total) * 100 : 0;
                    if (trackFill)   trackFill.style.width = `${pct}%`;
                    if (paraCounter) paraCounter.textContent = `${isPlaying || isPaused ? done : 0} / ${total}`;
                }

                function setPlayIcon(playing) {
                    if (playing) {
                        // Pause icon
                        playIcon.innerHTML = '<path d="M6 19h4V5H6v14zm8-14v14h4V5h-4z"/>';
                        playLabel.textContent = '{{ $curriculum->language == "sw" ? "Simama" : "Pause" }}';
                    } else {
                        // Play icon
                        playIcon.innerHTML = '<path d="M8 5v14l11-7z"/>';
                        playLabel.textContent = '{{ $curriculum->language == "sw" ? "Sikiliza Maelezo" : "Play Notes" }}';
                    }
                }

                function speakParagraph(idx) {
                    if (idx >= paragraphTexts.length) {
                        // Finished all paragraphs
                        isPlaying = false;
                        isPaused  = false;
                        currentPara = 0;
                        clearHighlight();
                        updateTrack();
                        setPlayIcon(false);
                        if (infoText) infoText.innerHTML = `<strong>{{ $curriculum->language == 'sw' ? '✅ Kusoma kumekamilika!' : '✅ All notes read!' }}</strong>`;
                        return;
                    }

                    currentPara = idx;
                    highlightPara(idx);
                    updateTrack();

                    const text  = paragraphTexts[idx];
                    const utter = new SpeechSynthesisUtterance(text);

                    // Per-paragraph language check (handles mixed-language documents)
                    utter.lang  = VoiceIntelligence.detectLang(text, curriculumLang);
                    utter.rate  = VoiceIntelligence.getRate(utter.lang, speeds[speedIndex]);
                    utter.pitch = 1;

                    const voice = VoiceIntelligence.pickVoice(utter.lang);
                    if (voice) utter.voice = voice;

                    // Show brief preview of what's being read
                    if (infoText) {
                        const preview = text.length > 60 ? text.slice(0, 57) + '...' : text;
                        infoText.innerHTML = `<strong>§${idx + 1}</strong> ${preview}`;
                    }

                    utter.onend = () => {
                        if (isPlaying) speakParagraph(idx + 1); // auto-advance
                    };
                    utter.onerror = (e) => {
                        if (e.error === 'interrupted') return; // intentional stop
                        isPlaying = false;
                        setPlayIcon(false);
                    };

                    speechSynthesis.speak(utter);
                }

                // ── Controls ─────────────────────────────────────────

                // 🎧 Listen button (toolbar)
                listenBtn.addEventListener('click', () => {
                    if (playerOpen) {
                        closePlayer();
                    } else {
                        openPlayer();
                        // Auto-start playing
                        isPlaying = true;
                        isPaused  = false;
                        setPlayIcon(true);
                        speakParagraph(currentPara);
                    }
                });

                // ▶/⏸ Play / Pause
                playPauseBtn.addEventListener('click', () => {
                    if (!playerOpen) {
                        openPlayer();
                    }
                    if (isPlaying) {
                        // Pause
                        speechSynthesis.pause();
                        isPlaying = false;
                        isPaused  = true;
                        setPlayIcon(false);
                    } else if (isPaused) {
                        // Resume
                        speechSynthesis.resume();
                        isPlaying = true;
                        isPaused  = false;
                        setPlayIcon(true);
                    } else {
                        // Start from current
                        isPlaying = true;
                        isPaused  = false;
                        setPlayIcon(true);
                        stopSpeech();
                        speakParagraph(currentPara);
                    }
                });

                // ⏮ Previous paragraph
                prevBtn.addEventListener('click', () => {
                    if (currentPara > 0) {
                        stopSpeech();
                        const target = currentPara - 1;
                        if (isPlaying) {
                            speakParagraph(target);
                        } else {
                            currentPara = target;
                            highlightPara(target);
                            updateTrack();
                        }
                    }
                });

                // ⏭ Next paragraph
                nextBtn.addEventListener('click', () => {
                    if (currentPara < paragraphTexts.length - 1) {
                        stopSpeech();
                        const target = currentPara + 1;
                        if (isPlaying) {
                            speakParagraph(target);
                        } else {
                            currentPara = target;
                            highlightPara(target);
                            updateTrack();
                        }
                    }
                });

                // ⏹ Stop
                stopBtn.addEventListener('click', () => closePlayer());

                // Speed cycle: 0.75 → 1 → 1.25 → 1.5 → 0.75 …
                speedBadge.addEventListener('click', () => {
                    speedIndex = (speedIndex + 1) % speeds.length;
                    speedBadge.textContent = speeds[speedIndex] + '×';
                    // Restart current paragraph with new speed if playing
                    if (isPlaying) {
                        stopSpeech();
                        speakParagraph(currentPara);
                    }
                });

                // Click on track bar to seek to a paragraph
                trackBar.addEventListener('click', (e) => {
                    const rect = trackBar.getBoundingClientRect();
                    const ratio = (e.clientX - rect.left) / rect.width;
                    const target = Math.floor(ratio * paragraphTexts.length);
                    const clamped = Math.max(0, Math.min(target, paragraphTexts.length - 1));
                    stopSpeech();
                    currentPara = clamped;
                    if (isPlaying) {
                        speakParagraph(clamped);
                    } else {
                        highlightPara(clamped);
                        updateTrack();
                    }
                });

                // Clicking a paragraph step while player is open seeks to it
                paragraphSteps.forEach((step, idx) => {
                    step.addEventListener('dblclick', (e) => {
                        if (!playerOpen) return;
                        e.stopPropagation(); // don't also toggle read state
                        stopSpeech();
                        currentPara = idx;
                        if (isPlaying) {
                            speakParagraph(idx);
                        } else {
                            highlightPara(idx);
                            updateTrack();
                        }
                    });
                });

                // Stop TTS when page unloads (navigating away)
                window.addEventListener('beforeunload', () => speechSynthesis.cancel());

            })(); // end initListenPlayer

        });
    </script>
</body>
</html>
