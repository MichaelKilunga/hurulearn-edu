<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- ═══════════════════════════════════════════════════════
         PRIMARY SEO META
    ═══════════════════════════════════════════════════════ --}}
    <title>Chat with HuruLearn AI – Instant Education for Africa</title>
    <meta name="description" content="HuruLearn delivers curriculum-aligned AI tutoring through basic SMS and Web. No internet? Use SMS. Have data? Use our Web Chat. Serving students across Africa.">
    <meta name="keywords" content="SMS education Africa, AI tutoring Tanzania, offline learning, curriculum-aligned SMS, HuruLearn, Huru Digital, educational technology Africa, Kiswahili education, no internet learning, SDG 4 education">
    <meta name="author" content="Huru Digital Co. Ltd.">
    <meta name="robots" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1">
    <meta name="googlebot" content="index, follow">

    {{-- Canonical URL --}}
    <link rel="canonical" href="https://hurulearn.hurudigital.co.tz/chat">

    {{-- Alternate languages --}}
    <link rel="alternate" hreflang="en" href="https://hurulearn.hurudigital.co.tz/chat">
    <link rel="alternate" hreflang="sw" href="https://hurulearn.hurudigital.co.tz/chat">
    <link rel="alternate" hreflang="x-default" href="https://hurulearn.hurudigital.co.tz/chat">

    {{-- ═══════════════════════════════════════════════════════
         OPEN GRAPH (Facebook, LinkedIn, WhatsApp …)
    ═══════════════════════════════════════════════════════ --}}
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="HuruLearn">
    <meta property="og:title" content="Chat with HuruLearn AI – Instant Education">
    <meta property="og:description" content="Curriculum-aligned AI tutoring delivered via any device. No internet? Use SMS. Have data? Use our Web Chat.">
    <meta property="og:url" content="https://hurulearn.hurudigital.co.tz/chat">
    <meta property="og:image" content="https://hurulearn.hurudigital.co.tz/og-image.svg">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="HuruLearn — AI SMS Education Platform for Africa">
    <meta property="og:locale" content="en_TZ">
    <meta property="og:locale:alternate" content="sw_TZ">

    {{-- ═══════════════════════════════════════════════════════
         TWITTER / X CARD
    ═══════════════════════════════════════════════════════ --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@HuruLearnTZ">
    <meta name="twitter:creator" content="@HuruDigitalCoLtd">
    <meta name="twitter:title" content="Chat with HuruLearn AI – Instant Education">
    <meta name="twitter:description" content="Curriculum-aligned AI tutoring via basic SMS and Web. No internet? Use SMS. Have data? Use Web Chat.">
    <meta name="twitter:image" content="https://hurulearn.hurudigital.co.tz/og-image.svg">
    <meta name="twitter:image:alt" content="HuruLearn SMS Education Platform">

    {{-- ═══════════════════════════════════════════════════════
         GEO / REGIONAL META
    ═══════════════════════════════════════════════════════ --}}
    <meta name="geo.region" content="TZ">
    <meta name="geo.placename" content="Tanzania">
    <meta name="geo.position" content="-6.369028;34.888822">
    <meta name="ICBM" content="-6.369028, 34.888822">

    {{-- ═══════════════════════════════════════════════════════
         PWA / MANIFEST
    ═══════════════════════════════════════════════════════ --}}
    <link rel="manifest" href="/manifest.json">
    <link rel="icon" href="/logo.svg" type="image/svg+xml">
    <link rel="apple-touch-icon" href="/logo.svg">
    <meta name="theme-color" content="#1e1b4b">

    {{-- ═══════════════════════════════════════════════════════
         FONTS & PERFORMANCE
    ═══════════════════════════════════════════════════════ --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
        :root {
            --primary: #3b82f6;
            --secondary: #1e1b4b;
            --accent: #f59e0b;
            --bg: #0f0d2e;
            --card-bg: rgba(255, 255, 255, 0.05);
            --text: #ffffff;
            --text-muted: #9ca3af;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg);
            color: var(--text);
            height: 100vh;
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .chat-container {
            width: 100%;
            height: 100%;
            max-width: 600px;
            display: flex;
            flex-direction: column;
            position: relative;
        }

        .screen {
            display: none;
            width: 100%;
            height: 100%;
            transition: opacity 0.3s ease;
        }

        .screen.active {
            display: flex;
            flex-direction: column;
        }

        /* Auth Screen */
        #auth-screen {
            justify-content: center;
            padding: 2rem;
        }

        .auth-card {
            background: var(--card-bg);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 24px;
            padding: 3rem 2rem;
            backdrop-filter: blur(20px);
            text-align: center;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
        }

        .auth-header h1 {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 2rem;
            margin: 1.5rem 0 0.5rem;
            background: linear-gradient(135deg, #fff, var(--text-muted));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .auth-header p {
            color: var(--text-muted);
            font-size: 0.95rem;
            margin-bottom: 2.5rem;
            line-height: 1.6;
        }

        .logo {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, var(--accent), var(--primary));
            color: white;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 900;
            font-size: 1.4rem;
            margin: 0 auto;
            box-shadow: 0 10px 20px rgba(59, 130, 246, 0.3);
        }

        .input-group {
            text-align: left;
            margin-bottom: 1.8rem;
        }

        .input-group label {
            display: block;
            font-size: 0.85rem;
            margin-bottom: 0.6rem;
            color: var(--text-muted);
            font-weight: 500;
        }

        .input-group input {
            width: 100%;
            padding: 1rem 1.2rem;
            border-radius: 12px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            background: rgba(255, 255, 255, 0.05);
            color: white;
            font-size: 1rem;
            outline: none;
            transition: all 0.2s;
        }

        .input-group input:focus {
            border-color: var(--primary);
            background: rgba(255, 255, 255, 0.08);
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
        }

        .btn-primary {
            width: 100%;
            padding: 1.1rem;
            border-radius: 12px;
            border: none;
            background: linear-gradient(135deg, var(--accent), #e67e22);
            color: white;
            font-weight: 700;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.2s;
            box-shadow: 0 10px 15px -3px rgba(245, 158, 11, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 20px 25px -5px rgba(245, 158, 11, 0.4);
        }

        /* Chat Screen */
        #chat-screen {
            background: rgba(15,13,46,0.5);
        }

        .chat-header {
            padding: 1.2rem 1.5rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.07);
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: rgba(15, 13, 46, 0.8);
            backdrop-filter: blur(16px);
            z-index: 10;
        }

        .header-info {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .header-info .logo {
            width: 40px;
            height: 40px;
            font-size: 0.9rem;
            border-radius: 10px;
        }

        .header-info h2 {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 1.1rem;
            margin: 0;
            font-weight: 700;
        }

        .status {
            font-size: 0.75rem;
            color: #10b981;
            display: flex;
            align-items: center;
            gap: 4px;
        }
        .status::before {
            content: '';
            width: 6px;
            height: 6px;
            background: #10b981;
            border-radius: 50%;
            display: inline-block;
        }

        .btn-logout {
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.1);
            color: var(--text-muted);
            padding: 0.5rem 1rem;
            border-radius: 8px;
            font-size: 0.8rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
        }

        .btn-logout:hover {
            background: rgba(239, 68, 68, 0.1);
            border-color: rgba(239, 68, 68, 0.2);
            color: #ef4444;
        }

        .btn-community {
            background: rgba(20, 184, 166, 0.1);
            border: 1px solid rgba(20, 184, 166, 0.25);
            color: #2dd4bf;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            font-size: 0.8rem;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
        }

        .btn-community:hover {
            background: rgba(20, 184, 166, 0.2);
            border-color: #2dd4bf;
            color: #5eead4;
        }

        .chat-messages {
            flex: 1;
            padding: 2rem 1.5rem;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            gap: 1.2rem;
            scroll-behavior: smooth;
        }

        /* Custom Scrollbar */
        .chat-messages::-webkit-scrollbar { width: 6px; }
        .chat-messages::-webkit-scrollbar-track { background: transparent; }
        .chat-messages::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.1); border-radius: 10px; }

        .message {
            max-width: 85%;
            padding: 1rem 1.2rem;
            border-radius: 18px;
            font-size: 0.95rem;
            line-height: 1.5;
            position: relative;
            animation: fadeIn 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .message.inbound {
            background: rgba(255, 255, 255, 0.07);
            align-self: flex-start;
            border-bottom-left-radius: 4px;
            color: #e5e7eb;
        }

        .message.outbound {
            background: linear-gradient(135deg, var(--primary), #1d4ed8);
            color: white;
            align-self: flex-end;
            border-bottom-right-radius: 4px;
            box-shadow: 0 4px 15px rgba(59, 130, 246, 0.2);
        }

        .chat-input-area {
            padding: 1.2rem 1.5rem;
            display: flex;
            gap: 1rem;
            background: rgba(15, 13, 46, 0.9);
            border-top: 1px solid rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(16px);
        }

        .chat-input-area input {
            flex: 1;
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 30px;
            padding: 0.9rem 1.5rem;
            color: white;
            font-size: 1rem;
            outline: none;
            transition: all 0.2s;
        }

        .chat-input-area input:focus {
            border-color: var(--primary);
            background: rgba(255, 255, 255, 0.08);
        }

        .btn-send {
            background: linear-gradient(135deg, var(--primary), #2563eb);
            color: white;
            border: none;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s;
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
        }

        .btn-send:hover {
            transform: scale(1.05) rotate(-10deg);
            box-shadow: 0 6px 20px rgba(59, 130, 246, 0.4);
        }

        .typing-indicator {
            padding: 0.5rem 1.5rem;
            display: flex;
            gap: 5px;
            align-self: flex-start;
        }

        .typing-indicator span {
            width: 7px;
            height: 7px;
            background: var(--primary);
            border-radius: 50%;
            opacity: 0.4;
            animation: typing 1.2s infinite ease-in-out;
        }

        .typing-indicator span:nth-child(2) { animation-delay: 0.2s; }
        .typing-indicator span:nth-child(3) { animation-delay: 0.4s; }

        .filter-bar {
        padding: 0.8rem 1.5rem;
        background: rgba(15, 13, 46, 0.4);
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
    }

    .filter-group {
        display: flex;
        gap: 0.5rem;
        align-items: center;
    }

    .filter-group input {
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 8px;
        padding: 0.5rem 0.8rem;
        color: white;
        font-size: 0.85rem;
        outline: none;
    }

    #keyword-search { flex: 1; }
    #date-filter { width: 140px; color-scheme: dark; }

    .btn-filter {
        background: var(--primary);
        color: white;
        border: none;
        padding: 0.5rem 1rem;
        border-radius: 8px;
        font-size: 0.85rem;
        font-weight: 600;
        cursor: pointer;
        transition: opacity 0.2s;
    }

    .btn-reset {
        background: rgba(255, 255, 255, 0.1);
        color: var(--text-muted);
    }

    .search-status {
        margin-top: 0.5rem;
        font-size: 0.75rem;
        color: var(--accent);
        font-weight: 500;
    }

    .hidden { display: none !important; }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(12px) scale(0.95); }
            to { opacity: 1; transform: translateY(0) scale(1); }
        }

        @keyframes typing {
            0%, 100% { transform: translateY(0); opacity: 0.4; }
            50% { transform: translateY(-5px); opacity: 1; }
        }

        /* ── Audio Feature Styles ────────────────────────────── */

        /* Microphone Button */
        .btn-mic {
            background: rgba(255, 255, 255, 0.07);
            border: 1px solid rgba(255, 255, 255, 0.12);
            color: var(--text-muted);
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 1.2rem;
            flex-shrink: 0;
            transition: all 0.25s ease;
            position: relative;
        }
        .btn-mic:hover {
            background: rgba(59, 130, 246, 0.15);
            border-color: rgba(59, 130, 246, 0.4);
            color: var(--primary);
            transform: scale(1.05);
        }
        .btn-mic.recording {
            background: rgba(239, 68, 68, 0.15);
            border-color: rgba(239, 68, 68, 0.5);
            color: #ef4444;
            animation: mic-pulse 1.2s infinite ease-in-out;
        }
        .btn-mic.unsupported {
            display: none;
        }

        @keyframes mic-pulse {
            0%, 100% { box-shadow: 0 0 0 0 rgba(239, 68, 68, 0.4); }
            50%       { box-shadow: 0 0 0 10px rgba(239, 68, 68, 0); }
        }

        /* Auto-Read Toggle Button */
        .btn-auto-read {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: var(--text-muted);
            padding: 0.5rem 0.9rem;
            border-radius: 8px;
            font-size: 0.78rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            white-space: nowrap;
        }
        .btn-auto-read:hover {
            background: rgba(167, 139, 250, 0.1);
            border-color: rgba(167, 139, 250, 0.3);
            color: #a78bfa;
        }
        .btn-auto-read.active {
            background: rgba(167, 139, 250, 0.15);
            border-color: rgba(167, 139, 250, 0.5);
            color: #c4b5fd;
        }

        /* Read-Aloud Button on AI message bubbles */
        .message-wrapper {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            gap: 4px;
            max-width: 85%;
        }
        .message-wrapper.outbound-wrapper {
            align-self: flex-end;
            align-items: flex-end;
        }
        .message-wrapper .message {
            max-width: 100%;
        }
        .btn-read-aloud {
            background: transparent;
            border: none;
            color: rgba(156, 163, 175, 0.6);
            font-size: 0.75rem;
            cursor: pointer;
            padding: 2px 6px;
            border-radius: 6px;
            display: flex;
            align-items: center;
            gap: 4px;
            transition: all 0.2s;
            line-height: 1;
        }
        .btn-read-aloud:hover {
            color: #a78bfa;
            background: rgba(167, 139, 250, 0.1);
        }
        .btn-read-aloud.speaking {
            color: #a78bfa;
        }
        .btn-read-aloud .wave {
            display: inline-flex;
            gap: 2px;
            align-items: flex-end;
            height: 12px;
        }
        .btn-read-aloud .wave span {
            display: inline-block;
            width: 2px;
            background: #a78bfa;
            border-radius: 2px;
            animation: wave-bar 0.8s infinite ease-in-out;
        }
        .btn-read-aloud .wave span:nth-child(1) { height: 5px; animation-delay: 0s; }
        .btn-read-aloud .wave span:nth-child(2) { height: 10px; animation-delay: 0.15s; }
        .btn-read-aloud .wave span:nth-child(3) { height: 7px; animation-delay: 0.3s; }
        .btn-read-aloud .wave span:nth-child(4) { height: 10px; animation-delay: 0.45s; }
        .btn-read-aloud .wave span:nth-child(5) { height: 5px; animation-delay: 0.6s; }

        @keyframes wave-bar {
            0%, 100% { transform: scaleY(0.4); opacity: 0.6; }
            50%       { transform: scaleY(1); opacity: 1; }
        }

        /* Mic status banner */
        #mic-status-banner {
            padding: 0.5rem 1.5rem;
            background: rgba(239, 68, 68, 0.1);
            border-top: 1px solid rgba(239, 68, 68, 0.2);
            font-size: 0.8rem;
            color: #fca5a5;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            animation: fadeIn 0.3s ease;
        }
        #mic-status-banner .pulse-dot {
            width: 8px;
            height: 8px;
            background: #ef4444;
            border-radius: 50%;
            animation: mic-pulse 1s infinite;
            flex-shrink: 0;
        }

        /* Mobile Adjustments */
        @media (max-width: 600px) {
            .chat-container { max-width: 100%; border-radius: 0; }
            .auth-card { border-radius: 0; height: 100%; display: flex; flex-direction: column; justify-content: center; border: none; }
        }
</style>
</head>
<body>

<div class="chat-container">
    <div id="auth-screen" class="screen active">
        <div class="auth-card">
            <div class="auth-header">
                <div class="logo">HL</div>
                <h1>HuruLearn AI</h1>
                <p>Register with your phone number to start asking questions directly to our AI tutor.</p>
            </div>
            @if(session('error'))
                <div class="auth-error-alert" style="background: rgba(239, 68, 68, 0.15); border: 1px solid rgba(239, 68, 68, 0.3); padding: 0.75rem; border-radius: 12px; color: #fca5a5; margin-bottom: 1.5rem; font-size: .85rem; font-weight: 500; text-align: center;">
                    {{ session('error') }}
                </div>
            @endif
            <form id="login-form">
                @csrf
                <div class="input-group">
                    <label for="phone_number">Phone Number</label>
                    <input type="text" id="phone_number" name="phone_number" placeholder="+255 7XX XXX XXX" required>
                </div>
                    <button type="submit" id="login-btn" class="btn-primary">Start Chatting ✦</button>
            </form>
            <div style="margin-top: 1.5rem; pt-4; border-top: 1px solid rgba(255,255,255,0.05);">
                <a href="{{ route('welcome') }}" style="color: var(--text-muted); text-decoration: none; font-size: 0.85rem; font-weight: 500; display: inline-flex; align-items: center; gap: 5px; transition: color 0.2s;" onmouseover="this.style.color='var(--accent)'" onmouseout="this.style.color='var(--text-muted)'">
                    <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
                    Return to Homepage
                </a>
            </div>
        </div>
    </div>

    <div id="chat-screen" class="screen">
        <div class="chat-header">
            <div class="header-info">
                <div class="logo">HL</div>
                <div>
                    <h2>HuruLearn AI</h2>
                    <span class="status">Online & Ready</span>
                </div>
            </div>
            <div style="display: flex; gap: 0.75rem; align-items: center; flex-wrap: wrap;">
                <button id="auto-read-toggle" class="btn-auto-read" title="Auto-read AI responses aloud">🔊 Auto</button>
                <a href="{{ route('community.index') }}" class="btn-community">🌱 Community</a>
                <button id="logout-btn" class="btn-logout">Logout</button>
            </div>
        </div>
        <!-- Weekly Learning Progress Stats Card -->
        <div id="stats-banner" style="background: rgba(245,158,11,0.08); border-bottom: 1px solid rgba(245,158,11,0.2); padding: 0.8rem 1.5rem; font-size: 0.85rem; display: flex; justify-content: space-between; align-items: center; border-top: 1px solid rgba(255,255,255,0.03);">
            <div style="display: flex; align-items: center; gap: 0.5rem; color: var(--accent);">
                <span>📊</span>
                <strong>Your Progress this week:</strong>
                <span id="stats-summary-text">Loading weekly study stats...</span>
            </div>
            <a href="{{ route('curriculum.index') }}" style="color: var(--blue-light); text-decoration: none; font-weight: 600; font-size: 0.8rem; display: flex; align-items: center; gap: 4px;">
                Browse Syllabus
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
            </a>
        </div>
        <div class="filter-bar">
            <div class="filter-group">
                <input type="text" id="keyword-search" placeholder="Search keywords..." aria-label="Search keywords">
                <input type="date" id="date-filter" aria-label="Filter by date">
                <button id="apply-filters" class="btn-filter">Search</button>
                <button id="reset-filters" class="btn-filter btn-reset hidden">Reset</button>
            </div>
            <div id="search-status" class="search-status hidden">
                Showing search results...
            </div>
        </div>
        <div id="chat-messages" class="chat-messages">
            <!-- Messages go here -->
        </div>
        <div id="typing-indicator" class="typing-indicator hidden">
            <span></span><span></span><span></span>
        </div>
        {{-- Mic recording status banner --}}
        <div id="mic-status-banner" style="display:none;">
            <span class="pulse-dot"></span>
            <span id="mic-status-text">Listening... Speak your question</span>
        </div>
        <form id="chat-form" class="chat-input-area">
            @csrf
            <button type="button" id="mic-btn" class="btn-mic" title="Speak your question">🎤</button>
            <input type="text" id="message-input" placeholder="Ask a question or tap 🎤 to speak..." autocomplete="off">
            <button type="submit" id="send-btn" class="btn-send">
                <svg viewBox="0 0 24 24" width="24" height="24" style="transform: rotate(45deg);"><path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z" fill="currentColor"></path></svg>
            </button>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const authScreen = document.getElementById('auth-screen');
        const chatScreen = document.getElementById('chat-screen');
        const loginForm = document.getElementById('login-form');
        const chatForm = document.getElementById('chat-form');
        const chatMessages = document.getElementById('chat-messages');
        const messageInput = document.getElementById('message-input');
        const typingIndicator = document.getElementById('typing-indicator');
        const logoutBtn = document.getElementById('logout-btn');
        const keywordSearch = document.getElementById('keyword-search');
        const dateFilter = document.getElementById('date-filter');
        const applyFiltersBtn = document.getElementById('apply-filters');
        const resetFiltersBtn = document.getElementById('reset-filters');
        const searchStatus = document.getElementById('search-status');

        // Check for existing session
        async function loadMessages(filters = {}) {
            try {
                const params = new URLSearchParams(filters).toString();
                const res = await fetch(`/chat/messages?${params}`, { headers: { 'X-Requested-With': 'XMLHttpRequest' } });
                const data = await res.json();
                if (data.status === 'success') {
                    const urlParams = new URLSearchParams(window.location.search);
                    const redirectUrl = urlParams.get('redirect');
                    if (redirectUrl) {
                        window.location.href = redirectUrl;
                        return;
                    }
                    showChat(data.messages, !!params);
                }
            } catch (err) { console.error('Failed to load messages', err); }
        }
        loadMessages();

        applyFiltersBtn.addEventListener('click', () => {
            const keyword = keywordSearch.value.trim();
            const date = dateFilter.value;
            if (keyword || date) {
                resetFiltersBtn.classList.remove('hidden');
                searchStatus.classList.remove('hidden');
                loadMessages({ keyword, date });
            }
        });

        resetFiltersBtn.addEventListener('click', () => {
            keywordSearch.value = '';
            dateFilter.value = '';
            resetFiltersBtn.classList.add('hidden');
            searchStatus.classList.add('hidden');
            loadMessages();
        });

        loginForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            const btn = document.getElementById('login-btn');
            btn.innerHTML = 'Signing in...';
            btn.disabled = true;

            const formData = new FormData(loginForm);
            try {
                const res = await fetch('/chat/login', {
                    method: 'POST',
                    body: formData,
                    headers: { 'X-Requested-With': 'XMLHttpRequest' }
                });
                const data = await res.json();
                if (data.status === 'success') {
                    const urlParams = new URLSearchParams(window.location.search);
                    const redirectUrl = urlParams.get('redirect');
                    if (redirectUrl) {
                        window.location.href = redirectUrl;
                        return;
                    }
                    const msgRes = await fetch('/chat/messages', { headers: { 'X-Requested-With': 'XMLHttpRequest' } });
                    const msgData = await msgRes.json();
                    showChat(msgData.messages);
                } else {
                    alert('Error: ' + data.message);
                }
            } catch (err) {
                alert('Connection error. Please try again.');
            } finally {
                btn.innerHTML = 'Start Chatting ✦';
                btn.disabled = false;
            }
        });

        chatForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            const msg = messageInput.value.trim();
            if (!msg) return;

            // Optimistic Update
            addMessageToUi({ content: msg, direction: 'inbound' });
            messageInput.value = '';

            typingIndicator.classList.remove('hidden');
            scrollToBottom();

            try {
                const res = await fetch('/chat/send', {
                    method: 'POST',
                    body: JSON.stringify({ message: msg }),
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });
                const data = await res.json();
                typingIndicator.classList.add('hidden');

                if (data.status === 'success') {
                    addMessageToUi(data.ai_message);
                } else {
                    addMessageToUi({ content: '⚠️ ' + data.message, direction: 'outbound' });
                }
            } catch (err) {
                typingIndicator.classList.add('hidden');
                addMessageToUi({ content: '❌ Sorry, something went wrong on our end.', direction: 'outbound' });
            }
            scrollToBottom();
        });

        logoutBtn.addEventListener('click', async () => {
            if (!confirm('Are you sure you want to logout?')) return;
            await fetch('/chat/logout', { 
                method: 'POST', 
                headers: { 
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });
            window.location.href = '/';
        });

        async function loadWeeklyStats() {
            try {
                const res = await fetch('/chat/stats', { headers: { 'X-Requested-With': 'XMLHttpRequest' } });
                const data = await res.json();
                if (data.status === 'success') {
                    const bannerText = document.getElementById('stats-summary-text');
                    if (data.session_count === 0) {
                        bannerText.innerHTML = "No study sessions completed yet. Start asking questions to learn!";
                    } else {
                        const subs = Object.keys(data.subjects);
                        const subjectsList = subs.length === 0 ? 'General Studies' : subs.join(', ');
                        bannerText.innerHTML = `Completed <strong>${data.session_count} sessions</strong> (${data.message_count} messages) in <strong>${subjectsList}</strong>.`;
                    }
                }
            } catch (err) { console.error('Failed to load stats', err); }
        }

        function showChat(messages = [], isSearchResult = false) {
            loadWeeklyStats();
            authScreen.classList.remove('active');
            chatScreen.classList.add('active');
            chatMessages.innerHTML = '';
            
            if (messages.length === 0) {
                if (isSearchResult) {
                    const div = document.createElement('div');
                    div.style.textAlign = 'center';
                    div.style.padding = '2rem';
                    div.style.color = 'var(--text-muted)';
                    div.textContent = 'No past chats found matching your filters.';
                    chatMessages.appendChild(div);
                } else {
                    addMessageToUi({ content: 'Habari! I am your AI tutor. How can I help you learn today?', direction: 'outbound' });
                }
            } else {
                messages.forEach(addMessageToUi);
            }
            scrollToBottom();
        }

        function addMessageToUi(msg) {
            const isAi = msg.direction === 'outbound';

            // Create wrapper for layout (message + optional read-aloud button)
            const wrapper = document.createElement('div');
            wrapper.className = `message-wrapper ${isAi ? 'outbound-wrapper' : ''}`;

            const div = document.createElement('div');
            div.className = `message ${isAi ? 'outbound' : 'inbound'}`;
            // Simple newline to <br> conversion
            div.innerHTML = msg.content.replace(/\n/g, '<br>');
            wrapper.appendChild(div);

            // Add "Read Aloud" button only for AI (outbound) messages
            if (isAi) {
                const readBtn = document.createElement('button');
                readBtn.className = 'btn-read-aloud';
                readBtn.title = 'Read aloud';
                readBtn.innerHTML = `<svg width="12" height="12" viewBox="0 0 24 24" fill="currentColor"><path d="M3 9v6h4l5 5V4L7 9H3zm13.5 3c0-1.77-1.02-3.29-2.5-4.03v8.05c1.48-.73 2.5-2.25 2.5-4.02zM14 3.23v2.06c2.89.86 5 3.54 5 6.71s-2.11 5.85-5 6.71v2.06c4.01-.91 7-4.49 7-8.77s-2.99-7.86-7-8.77z"/></svg> Read`;
                readBtn.addEventListener('click', () => {
                    const textContent = msg.content.replace(/<br>/g, '\n');
                    if (readBtn.classList.contains('speaking')) {
                        audioEngine.stop();
                    } else {
                        audioEngine.speak(textContent, readBtn);
                    }
                });
                wrapper.appendChild(readBtn);

                // Auto-read if toggle is active
                if (autoReadEnabled) {
                    setTimeout(() => audioEngine.speak(msg.content, readBtn), 300);
                }
            }

            chatMessages.appendChild(wrapper);
        }

        function scrollToBottom() {
            chatMessages.scrollTop = chatMessages.scrollHeight;
        }

        // ══════════════════════════════════════════════════════════
        //  AUDIO ENGINE  —  Speech Recognition (STT) + Synthesis (TTS)
        // ══════════════════════════════════════════════════════════

        // ── Voice Intelligence Engine ────────────────────────────────
        // Score-based language detection + natural voice selection
        // Optimised for Tanzanian students (Swahili & English)
        const VoiceIntelligence = {
            _voices: [],

            init() {
                const load = () => { this._voices = speechSynthesis.getVoices(); };
                this._voices = speechSynthesis.getVoices();
                speechSynthesis.onvoiceschanged = load;
            },

            /**
             * Score-based language detection.
             * hintLang: 'sw-TZ' | 'en-US' | 'auto'
             * 'auto' mode is Tanzania-first: defaults to Swahili unless English clearly dominates.
             */
            detectLang(text, hintLang) {
                const words = text.toLowerCase()
                    .replace(/[^a-z\s]/g, ' ')
                    .split(/\s+/)
                    .filter(w => w.length > 1);

                if (!words.length) return 'sw-TZ';

                const swSet = new Set([
                    'na','ya','wa','kwa','ni','la','za','cha','mwa','pa','au','tu',
                    'sana','zaidi','kidogo','vizuri','haraka','hapa','pale','sasa',
                    'bado','tena','hata','pia','kabisa','kweli','kwanza',
                    'hii','hizi','huo','hizo','hao','yote','zote','wake','wao',
                    'yake','yao','huyu','hawa','hiyo','hili','haya','hilo',
                    'iko','ipo','imo','yupo','wako','wapo','wamo','liko','lipo',
                    'habari','asante','tafadhali','samahani','karibu','ndiyo',
                    'hapana','sawa','nzuri','kwaheri','pole','hongera',
                    'mwanafunzi','wanafunzi','mwalimu','walimu','shule','darasa',
                    'kitabu','vitabu','somo','masomo','mtihani','swali','maswali',
                    'jibu','majibu','elimu','lugha','kiswahili','hesabu','historia',
                    'sayansi','kanuni','mada','sehemu','ubao','kalamu','faida',
                    'kuhusu','jinsi','kwamba','lakini','ingawa','baada','kabla',
                    'wakati','pamoja','badala','kama','bila','ikiwa','japo',
                    'mimi','wewe','yeye','sisi','nyinyi',
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
                    return (enRatio > swRatio * 2.2 && enRatio > 0.12) ? 'en-US' : 'sw-TZ';
                }
                if (hintLang === 'en-US') {
                    return (swRatio > enRatio * 1.5 && swRatio > 0.06) ? 'sw-TZ' : 'en-US';
                }
                // auto / Tanzania-first
                return (enRatio > swRatio * 1.8 && enRatio > 0.10) ? 'en-US' : 'sw-TZ';
            },

            /**
             * Most natural voice for language.
             * Google online > Neural/Natural > any matching locale > fallback.
             * Swahili with no sw voice falls back to en-GB.
             */
            pickVoice(lang) {
                const voices  = this._voices.length ? this._voices : speechSynthesis.getVoices();
                const code    = lang.slice(0, 2);
                const natural = v => !v.localService
                    || v.name.includes('Google')
                    || v.name.includes('Neural')
                    || v.name.includes('Natural')
                    || v.name.includes('Online');

                if (code === 'sw') {
                    return voices.find(v => v.name.includes('Google') && v.lang.startsWith('sw'))
                        || voices.find(v => v.lang.startsWith('sw'))
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

            /** Swahili slightly slower for syllable clarity. */
            getRate(lang) {
                return lang.startsWith('sw') ? 0.88 : 0.92;
            },
        };
        VoiceIntelligence.init();

        let autoReadEnabled = false;

        // ── Text-to-Speech (TTS) ─────────────────────────────────
        const audioEngine = {
            utterance: null,
            activeBtn: null,

            speak(text, btn) {
                // Cancel any ongoing speech first
                this.stop();

                // Strip HTML tags for clean reading
                const clean = text.replace(/<[^>]*>/g, ' ').replace(/\s+/g, ' ').trim();

                const utter = new SpeechSynthesisUtterance(clean);

                // Tanzania-first: auto-detect Swahili vs English by word frequency
                utter.lang  = VoiceIntelligence.detectLang(clean, 'auto');
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

                utter.onend = () => this._resetBtn(btn);
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
            // Hide mic button gracefully on unsupported browsers
            if (micBtn) micBtn.classList.add('unsupported');
        } else {
            let recognition = null;
            let isRecording = false;

            function buildRecognition() {
                const rec = new SpeechRecognitionAPI();
                rec.continuous = false;
                rec.interimResults = true;

                // Match recognition language to current TTS guess
                // Default to Swahili since the app targets Tanzania
                rec.lang = 'sw-TZ';

                rec.onstart = () => {
                    isRecording = true;
                    micBtn.classList.add('recording');
                    micBtn.title = 'Stop recording';
                    micBtn.textContent = '⏹';
                    micStatusBanner.style.display = 'flex';
                    micStatusText.textContent = 'Listening... Speak your question';
                    // Stop any active TTS while recording
                    audioEngine.stop();
                };

                rec.onresult = (event) => {
                    let interimTranscript = '';
                    let finalTranscript = '';
                    for (let i = event.resultIndex; i < event.results.length; i++) {
                        const transcript = event.results[i][0].transcript;
                        if (event.results[i].isFinal) {
                            finalTranscript += transcript;
                        } else {
                            interimTranscript += transcript;
                        }
                    }
                    // Show interim results in the input as preview
                    messageInput.value = finalTranscript || interimTranscript;
                    if (interimTranscript) {
                        micStatusText.textContent = `Hearing: "${interimTranscript}"`;
                    }
                };

                rec.onspeechend = () => {
                    rec.stop();
                };

                rec.onend = () => {
                    isRecording = false;
                    micBtn.classList.remove('recording');
                    micBtn.title = 'Speak your question';
                    micBtn.textContent = '🎤';
                    micStatusBanner.style.display = 'none';

                    // If we got text, auto-focus the input so user can review + send
                    if (messageInput.value.trim()) {
                        messageInput.focus();
                        micStatusText.textContent = 'Listening... Speak your question';
                    }
                };

                rec.onerror = (event) => {
                    isRecording = false;
                    micBtn.classList.remove('recording');
                    micBtn.title = 'Speak your question';
                    micBtn.textContent = '🎤';

                    let msg = 'Could not hear you. Please try again.';
                    if (event.error === 'not-allowed') msg = 'Microphone access denied. Please allow microphone in your browser settings.';
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
                    try {
                        recognition.start();
                    } catch (err) {
                        console.error('SpeechRecognition start error:', err);
                    }
                }
            });
        }

    });
</script>
</body>
</html>
