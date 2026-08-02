<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- SEO META --}}
    <title>HuruLearn – School Study Portal & AI Tutor</title>
    <meta name="description" content="Welcome to the school's digital learning hub. Access curriculum topics, syllabus resources, and get instant guidance from your AI study assistant.">
    <meta name="robots" content="index, follow">

    {{-- PWA / Icons --}}
    <link rel="manifest" href="/manifest.json">
    <link rel="icon" href="/logo.svg" type="image/svg+xml">
    <link rel="apple-touch-icon" href="/logo.svg">
    <meta name="theme-color" content="#ffffff">

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --bg-primary: #f8fafc;
            --bg-card: #ffffff;
            --text-primary: #0f172a;
            --text-secondary: #475569;
            --border-light: #e2e8f0;
            --indigo: #4f46e5;
            --indigo-light: #e0e7ff;
            --blue: #2563eb;
            --blue-light: #eff6ff;
            --amber: #d97706;
            --amber-light: #fef3c7;
            --teal: #0f766e;
            --teal-light: #f0fdfa;
            --white: #ffffff;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }
        html { scroll-behavior: smooth; }
        body { 
            font-family: 'Inter', sans-serif; 
            background: var(--bg-primary); 
            color: var(--text-primary); 
            overflow-x: hidden;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* GLOW BACKGROUNDS (Soft & human-friendly) */
        .bg-glow-container {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: -1;
            pointer-events: none;
        }
        .glow-orb-1 {
            position: absolute;
            top: -10%;
            right: 5%;
            width: 50vw;
            height: 50vw;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(59, 130, 246, 0.08) 0%, transparent 70%);
            filter: blur(60px);
        }
        .glow-orb-2 {
            position: absolute;
            bottom: 20%;
            left: -10%;
            width: 40vw;
            height: 40vw;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(245, 158, 11, 0.06) 0%, transparent 70%);
            filter: blur(50px);
        }
        .grid-overlay {
            position: absolute;
            inset: 0;
            background-image: linear-gradient(rgba(15, 23, 42, 0.01) 1px, transparent 1px),
                              linear-gradient(90deg, rgba(15, 23, 42, 0.01) 1px, transparent 1px);
            background-size: 50px 50px;
            z-index: -1;
        }

        /* NAVIGATION */
        #navbar {
            position: sticky; top: 0; z-index: 999;
            padding: 1.2rem 2.5rem;
            display: flex; align-items: center; justify-content: space-between;
            backdrop-filter: blur(16px); background: rgba(255, 255, 255, 0.9);
            border-bottom: 1px solid var(--border-light);
            transition: all .3s;
        }
        .nav-logo { display: flex; align-items: center; gap: .7rem; text-decoration: none; }
        .nav-logo-icon {
            width: 38px; height: 38px; border-radius: 10px;
            background: linear-gradient(135deg, #f59e0b, #3b82f6);
            display: flex; align-items: center; justify-content: center;
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.15);
        }
        .nav-logo-text { font-family: 'Space Grotesk', sans-serif; font-weight: 700; font-size: 1.4rem; color: var(--text-primary); }
        .nav-links { display: flex; align-items: center; gap: 2rem; list-style: none; }
        .nav-links a { color: var(--text-secondary); text-decoration: none; font-size: .9rem; font-weight: 500; transition: color .2s; }
        .nav-links a:hover { color: var(--blue); }
        .nav-cta {
            padding: .6rem 1.4rem; border-radius: 8px;
            background: linear-gradient(135deg, var(--blue), #1d4ed8);
            color: #white !important; font-weight: 600 !important; font-size: .9rem !important;
            transition: transform .2s, box-shadow .2s;
            box-shadow: 0 4px 15px rgba(37, 99, 235, 0.2);
            border: none;
            cursor: pointer;
        }
        .nav-cta:hover { transform: translateY(-2px); box-shadow: 0 8px 25px rgba(37, 99, 235, 0.35); }
        
        .hamburger { display: none; flex-direction: column; gap: 5px; cursor: pointer; }
        .hamburger span { width: 24px; height: 2px; background: var(--text-primary); border-radius: 2px; display: block; }

        /* HERO & MAIN LAYOUT */
        .hero {
            padding: 5rem 2rem 3rem;
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1.15fr 0.85fr;
            gap: 4rem;
            align-items: center;
            position: relative;
        }
        
        .hero-badge {
            display: inline-flex; align-items: center; gap: .5rem;
            background: var(--blue-light); border: 1px solid rgba(37, 99, 235, 0.15);
            border-radius: 50px; padding: .4rem 1rem; font-size: .8rem; font-weight: 600;
            color: var(--blue); margin-bottom: 1.5rem;
        }
        .hero-badge span { width: 8px; height: 8px; border-radius: 50%; background: var(--teal); display: inline-block; animation: pulse 2s infinite; }

        .hero h1 {
            font-family: 'Space Grotesk', sans-serif;
            font-size: clamp(2.2rem, 4.5vw, 3.5rem); font-weight: 700; line-height: 1.15;
            margin-bottom: 1.5rem;
            letter-spacing: -0.02em;
            color: var(--text-primary);
        }
        .hero h1 .highlight { 
            background: linear-gradient(135deg, var(--blue), var(--indigo)); 
            -webkit-background-clip: text; 
            -webkit-text-fill-color: transparent; 
            background-clip: text; 
        }
        .hero-desc { font-size: 1.1rem; line-height: 1.7; color: var(--text-secondary); margin-bottom: 2.5rem; }

        /* SMS BANNER ON HERO */
        .sms-badge-banner {
            display: flex;
            align-items: flex-start;
            gap: 1rem;
            background: var(--amber-light);
            border: 1px solid rgba(217, 119, 6, 0.2);
            border-radius: 16px;
            padding: 1.2rem;
            margin-bottom: 2.5rem;
            box-shadow: 0 4px 12px rgba(217, 119, 6, 0.05);
            animation: fadeSlideUp 0.8s 0.1s ease both;
        }
        .sms-badge-icon {
            font-size: 1.8rem;
            line-height: 1;
            padding: 0.4rem;
            background: rgba(217, 119, 6, 0.1);
            border-radius: 10px;
        }
        .sms-badge-details h3 {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 1rem;
            font-weight: 700;
            color: #92400e;
            margin-bottom: 0.2rem;
        }
        .sms-badge-details p {
            font-size: 0.88rem;
            color: #b45309;
            line-height: 1.5;
        }
        .sms-badge-details strong {
            color: var(--text-primary);
            background: rgba(255,255,255,0.6);
            padding: 0.1rem 0.4rem;
            border-radius: 4px;
            font-family: monospace;
            font-size: 0.95rem;
        }

        /* MOCKUP DESIGN (LIGHT MODE) */
        .mockup-container {
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
        }
        .dashboard-mockup {
            width: 100%;
            max-width: 440px;
            background: var(--bg-card);
            border: 1px solid var(--border-light);
            border-radius: 24px;
            padding: 1.5rem;
            backdrop-filter: blur(12px);
            box-shadow: 0 20px 40px rgba(15, 23, 42, 0.06), 0 1px 3px rgba(15, 23, 42, 0.02);
            animation: float 6s ease-in-out infinite;
        }
        .mockup-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            border-bottom: 1px solid var(--border-light);
            padding-bottom: 0.8rem;
        }
        .mockup-dots { display: flex; gap: 6px; }
        .mockup-dots span { width: 8px; height: 8px; border-radius: 50%; display: block; }
        .mockup-dots span:nth-child(1) { background: #ef4444; }
        .mockup-dots span:nth-child(2) { background: #f59e0b; }
        .mockup-dots span:nth-child(3) { background: #10b981; }
        .mockup-title { font-size: 0.75rem; font-weight: 600; color: var(--text-secondary); font-family: 'Space Grotesk', sans-serif; }

        /* Course Progress Mockup */
        .mockup-card {
            background: var(--bg-primary);
            border: 1px solid var(--border-light);
            border-radius: 12px;
            padding: 1rem;
            margin-bottom: 1rem;
        }
        .mockup-card-title { font-size: 0.85rem; font-weight: 600; margin-bottom: 0.5rem; display: flex; justify-content: space-between; }
        .mockup-card-meta { font-size: 0.7rem; color: var(--teal); font-weight: 700; }
        .progress-bar-container { background: rgba(15, 23, 42, 0.06); height: 6px; border-radius: 10px; overflow: hidden; }
        .progress-bar-fill { background: linear-gradient(90deg, var(--blue), var(--teal)); height: 100%; border-radius: 10px; width: 68%; }

        /* Chat Mockup */
        .mockup-chat {
            display: flex;
            flex-direction: column;
            gap: 0.6rem;
            background: #f1f5f9;
            border-radius: 14px;
            padding: 0.8rem;
            border: 1px solid var(--border-light);
        }
        .chat-bubble { font-size: 0.75rem; line-height: 1.4; padding: 0.5rem 0.8rem; border-radius: 10px; max-width: 85%; }
        .chat-student { background: var(--blue); color: #fff; align-self: flex-end; border-bottom-right-radius: 2px; }
        .chat-ai { background: var(--white); border: 1px solid var(--border-light); color: var(--text-primary); align-self: flex-start; border-bottom-left-radius: 2px; }

        /* PORTAL ENTRIES GRID */
        .portal-grid {
            max-width: 1200px;
            margin: 0 auto;
            padding: 3rem 2rem 5rem;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 2rem;
            width: 100%;
        }
        .portal-card {
            background: var(--bg-card);
            border: 1px solid var(--border-light);
            border-radius: 24px;
            padding: 2.2rem;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            position: relative;
            overflow: hidden;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.03), 0 8px 10px -6px rgba(0, 0, 0, 0.02);
        }
        .portal-card::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(37, 99, 235, 0.02), transparent);
            opacity: 0;
            transition: opacity 0.3s;
        }
        .portal-card:hover {
            transform: translateY(-6px);
            border-color: rgba(37, 99, 235, 0.2);
            box-shadow: 0 20px 30px rgba(15, 23, 42, 0.05), 0 1px 3px rgba(15, 23, 42, 0.02);
        }
        .portal-card:hover::before { opacity: 1; }

        .portal-icon {
            width: 54px; height: 54px; border-radius: 14px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.6rem; margin-bottom: 1.5rem;
            transition: transform 0.3s;
        }
        .portal-card:hover .portal-icon {
            transform: scale(1.1) rotate(2deg);
        }
        .icon-blue { background: var(--blue-light); border: 1px solid rgba(37, 99, 235, 0.15); color: var(--blue); }
        .icon-teal { background: var(--teal-light); border: 1px solid rgba(15, 118, 110, 0.15); color: var(--teal); }
        .icon-amber { background: var(--amber-light); border: 1px solid rgba(217, 119, 6, 0.15); color: var(--amber); }

        .portal-card h2 {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 1.4rem; font-weight: 700; margin-bottom: 0.8rem;
            color: var(--text-primary);
        }
        .portal-card p {
            color: var(--text-secondary); font-size: 0.92rem; line-height: 1.6;
            margin-bottom: 2rem; flex-grow: 1;
        }
        .portal-btn {
            width: 100%;
            padding: 0.85rem;
            border-radius: 12px;
            font-weight: 600;
            font-size: 0.95rem;
            cursor: pointer;
            text-decoration: none;
            text-align: center;
            display: inline-block;
            transition: all 0.2s;
        }
        .btn-fill-blue { background: linear-gradient(135deg, var(--blue), #1d4ed8); color: #fff; border: none; box-shadow: 0 4px 12px rgba(37, 99, 235, 0.2); }
        .btn-fill-blue:hover { box-shadow: 0 8px 20px rgba(37, 99, 235, 0.3); }
        .btn-fill-teal { background: linear-gradient(135deg, var(--teal), #0d9488); color: #fff; border: none; box-shadow: 0 4px 12px rgba(15, 118, 110, 0.2); }
        .btn-fill-teal:hover { box-shadow: 0 8px 20px rgba(15, 118, 110, 0.3); }
        .btn-fill-amber { background: linear-gradient(135deg, var(--amber), #d97706); color: #white; color: #fff; border: none; box-shadow: 0 4px 12px rgba(217, 119, 6, 0.2); }
        .btn-fill-amber:hover { box-shadow: 0 8px 20px rgba(217, 119, 6, 0.3); }

        /* LATEST COMMUNITY FEED WIDGET */
        .community-feed {
            max-width: 1200px;
            margin: 0 auto 5rem;
            padding: 0 2rem;
            width: 100%;
        }
        .feed-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            margin-bottom: 2rem;
            border-bottom: 1px solid var(--border-light);
            padding-bottom: 1rem;
        }
        .feed-title { font-family: 'Space Grotesk', sans-serif; font-size: 1.5rem; font-weight: 700; color: var(--text-primary); }
        .feed-link { color: var(--blue); text-decoration: none; font-size: 0.9rem; font-weight: 600; transition: color 0.2s; }
        .feed-link:hover { color: var(--text-primary); }
        
        .feed-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 1.5rem;
        }
        .feed-card {
            background: var(--bg-card);
            border: 1px solid var(--border-light);
            border-radius: 16px;
            padding: 1.5rem;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            transition: all 0.25s;
            box-shadow: 0 4px 12px rgba(15, 23, 42, 0.02);
        }
        .feed-card:hover {
            border-color: rgba(37, 99, 235, 0.15);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(15, 23, 42, 0.04);
        }
        .feed-content {
            font-size: 0.88rem;
            line-height: 1.6;
            color: var(--text-secondary);
            margin-bottom: 1.2rem;
            font-style: italic;
        }
        .feed-user {
            display: flex;
            align-items: center;
            gap: 0.6rem;
        }
        .feed-avatar {
            width: 28px; height: 28px; border-radius: 50%;
            background: linear-gradient(135deg, var(--teal), var(--blue));
            display: flex; align-items: center; justify-content: center;
            font-weight: 700; font-size: 0.7rem; color: #fff;
        }
        .feed-meta-info { display: flex; flex-direction: column; }
        .feed-username { font-size: 0.8rem; font-weight: 600; color: var(--text-primary); }
        .feed-time { font-size: 0.65rem; color: var(--text-secondary); }

        /* FOOTER */
        footer {
            margin-top: auto;
            background: var(--white);
            border-top: 1px solid var(--border-light);
            padding: 2.5rem 2rem;
        }
        .footer-inner {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1.5rem;
        }
        .footer-brand { display: flex; align-items: center; gap: .6rem; }
        .footer-brand-icon {
            width: 32px; height: 32px; border-radius: 8px;
            background: linear-gradient(135deg, #f59e0b, #3b82f6);
            display: flex; align-items: center; justify-content: center;
            font-weight: 800; font-size: 0.85rem;
        }
        .footer-brand-text { font-family: 'Space Grotesk', sans-serif; font-weight: 700; font-size: 1.1rem; color: var(--text-primary); }
        .footer-info { font-size: 0.8rem; color: var(--text-secondary); }
        .footer-links { display: flex; gap: 1.5rem; }
        .footer-links a { color: var(--text-secondary); text-decoration: none; font-size: 0.85rem; transition: color 0.2s; }
        .footer-links a:hover { color: var(--blue); }
        .footer-copy { color: var(--text-secondary); font-size: 0.8rem; width: 100%; text-align: center; margin-top: 1.5rem; border-top: 1px solid var(--border-light); padding-top: 1.2rem; }

        /* ANIMATIONS */
        @keyframes fadeSlideUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
        @keyframes pulse { 0%, 100% { opacity: 1; } 50% { opacity: .4; } }
        @keyframes float { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(-10px); } }

        /* RESPONSIVE DESIGN */
        @media (max-width: 768px) {
            #navbar { padding: 1rem 1.5rem; }
            .hero { grid-template-columns: 1fr; text-align: center; gap: 2.5rem; padding-top: 3rem; }
            .hero-badge { margin: 0 auto 1rem; }
            .sms-badge-banner { text-align: left; }
            .mockup-container { order: -1; }
            .nav-links { 
                display: none; 
                flex-direction: column;
                position: absolute;
                top: 100%; left: 0; width: 100%;
                background: rgba(255, 255, 255, 0.98);
                padding: 1.5rem;
                gap: 1.2rem;
                border-bottom: 1px solid var(--border-light);
                box-shadow: 0 10px 15px rgba(0,0,0,0.05);
            }
            .nav-links.active { display: flex; }
            .hamburger { display: flex; }
            .portal-grid { padding: 1.5rem 1.5rem 3rem; }
            .footer-inner { flex-direction: column; text-align: center; }
            .footer-links { justify-content: center; }
        }
    </style>
</head>
<body>

    <div class="bg-glow-container">
        <div class="glow-orb-1"></div>
        <div class="glow-orb-2"></div>
        <div class="grid-overlay"></div>
    </div>

    {{-- NAVIGATION --}}
    <nav id="navbar" aria-label="Primary navigation">
        <a href="/" class="nav-logo" aria-label="HuruLearn home">
            <div class="nav-logo-icon">
                <img src="/logo.svg" alt="HuruLearn logo" width="24" height="24" style="width: 24px; height: 24px;">
            </div>
            <span class="nav-logo-text">{{ \App\Models\SystemSetting::where('key', 'bot_name')->first()?->value ?? 'HuruLearn' }}</span>
        </a>
        <ul class="nav-links" role="list">
            <li><a href="/">Home</a></li>
            <li><a href="{{ route('curriculum.index') }}">Syllabus</a></li>
            <li><a href="{{ route('chat.index') }}">AI Tutor</a></li>
            <li><a href="{{ route('community.index') }}">Community</a></li>
            <li><a href="{{ route('admin.login') }}" class="nav-cta">Staff Login</a></li>
        </ul>
        <div class="hamburger" id="hamburger" aria-label="Toggle menu" role="button" tabindex="0" aria-expanded="false">
            <span></span><span></span><span></span>
        </div>
    </nav>

    {{-- HERO SECTION --}}
    <main id="main-content">
        <section class="hero" aria-labelledby="hero-heading">
            <div style="animation: fadeSlideUp 0.8s ease both;">
                <div class="hero-badge">
                    <span></span> Dedicated School Study Portal
                </div>
                <h1 id="hero-heading">Empowering Students with <span class="highlight">Interactive AI</span> learning</h1>
                <p class="hero-desc">
                    Access school syllabus notes, track your learning topics, and study dynamically with your personal offline-first AI study coach. Designed exclusively for your academic growth.
                </p>

                {{-- SMS SHORTCODE ANNOUNCEMENT --}}
                <div class="sms-badge-banner">
                    <div class="sms-badge-icon">📱</div>
                    <div class="sms-badge-details">
                        <h3>Soma Bila Mtandao (Offline SMS Learning)</h3>
                        <p>Tuma neno <strong>HURU</strong> likifuatiwa na swali lako kwenda namba <strong>15054</strong> kutoka simu yoyote. Mfano: <code>HURU eleza photosynthesis</code></p>
                    </div>
                </div>

                <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
                    <a href="{{ route('curriculum.index') }}" class="nav-cta" style="padding: 0.9rem 2rem; font-size: 1rem;">Explore Syllabus →</a>
                    <a href="{{ route('chat.index') }}" class="nav-cta" style="padding: 0.9rem 2rem; font-size: 1rem; background: var(--blue-light); color: var(--blue) !important; border: 1px solid rgba(37, 99, 235, 0.15); box-shadow: none;">Interactive Chat</a>
                </div>
            </div>
            <div class="mockup-container" style="animation: fadeSlideUp 0.8s 0.2s ease both;">
                <div class="dashboard-mockup">
                    <div class="mockup-header">
                        <div class="mockup-dots"><span></span><span></span><span></span></div>
                        <div class="mockup-title">CURRICULUM MODULES</div>
                    </div>
                    <div class="mockup-card">
                        <div class="mockup-card-title">
                            <span>Form 4 Biology</span>
                            <span class="mockup-card-meta">68% Done</span>
                        </div>
                        <div class="progress-bar-container">
                            <div class="progress-bar-fill"></div>
                        </div>
                    </div>
                    <div class="mockup-chat">
                        <div class="chat-bubble chat-student">What is the formula of Photosynthesis?</div>
                        <div class="chat-bubble chat-ai">Photosynthesis formula is:<br>6CO₂ + 6H₂O → C₆H₁₂O₆ + 6O₂</div>
                    </div>
                </div>
            </div>
        </section>

        {{-- PORTAL ACCESS SECTION --}}
        <section class="portal-grid" aria-label="Portal Entry Points">
            {{-- Card 1 --}}
            <div class="portal-card" style="animation: fadeSlideUp 0.8s 0.3s ease both;">
                <div>
                    <div class="portal-icon icon-blue">💬</div>
                    <h2>Study AI Chat</h2>
                    <p>Ask syllabus questions, clear your doubts, and receive instant explanations and quick follow-up quizzes tailored to your understanding.</p>
                </div>
                <a href="{{ route('chat.index') }}" class="portal-btn btn-fill-blue">Start AI Tutoring</a>
            </div>

            {{-- Card 2 --}}
            <div class="portal-card" style="animation: fadeSlideUp 0.8s 0.4s ease both;">
                <div>
                    <div class="portal-icon icon-teal">📚</div>
                    <h2>Syllabus & Topics</h2>
                    <p>Browse official curriculum notes categorized by form level and subject. Read summaries, verify lesson topics, and study structured outlines.</p>
                </div>
                <a href="{{ route('curriculum.index') }}" class="portal-btn btn-fill-teal">Browse Curriculum</a>
            </div>

            {{-- Card 3 --}}
            <div class="portal-card" style="animation: fadeSlideUp 0.8s 0.5s ease both;">
                <div>
                    <div class="portal-icon icon-amber">👥</div>
                    <h2>Student Community</h2>
                    <p>Connect with other students in the school. Share notes, discuss study topics, post general advice, and collaborate on assignments.</p>
                </div>
                <a href="{{ route('community.index') }}" class="portal-btn btn-fill-amber">Join Community</a>
            </div>
        </section>

        {{-- DYNAMIC LATEST DISCUSSIONS WIDGET --}}
        @if(count($communityPosts) > 0)
        <section class="community-feed" aria-label="Latest Discussions">
            <div class="feed-header">
                <h2 class="feed-title">Latest Student Discussions</h2>
                <a href="{{ route('community.index') }}" class="feed-link">View All Forums →</a>
            </div>
            <div class="feed-grid">
                @foreach($communityPosts as $post)
                <div class="feed-card">
                    <p class="feed-content">"{{ Str::limit($post->content, 110) }}"</p>
                    <div class="feed-user">
                        <div class="feed-avatar">
                            {{ strtoupper(substr($post->user->name ?? $post->user->phone_number ?? 'S', 0, 1)) }}
                        </div>
                        <div class="feed-meta-info">
                            <span class="feed-username">{{ $post->user->name ?? 'Student' }}</span>
                            <span class="feed-time">{{ $post->created_at->diffForHumans() }}</span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </section>
        @endif
    </main>

    {{-- FOOTER --}}
    <footer aria-label="Site footer">
        <div class="footer-inner">
            <div class="footer-brand">
                <div class="footer-brand-icon">
                    <img src="/logo.svg" alt="HuruLearn logo" width="20" height="20" style="width: 20px; height: 20px;">
                </div>
                <span class="footer-brand-text">{{ \App\Models\SystemSetting::where('key', 'bot_name')->first()?->value ?? 'HuruLearn' }}</span>
                <span class="footer-info">| Local School Server Instance</span>
            </div>
            <nav class="footer-links" aria-label="Footer navigation">
                <a href="{{ route('curriculum.index') }}">Syllabus</a>
                <a href="{{ route('chat.index') }}">AI Tutor</a>
                <a href="{{ route('community.index') }}">Community Hub</a>
                <a href="{{ route('admin.login') }}">Admin Login</a>
            </nav>
            <div class="footer-copy">
                &copy; {{ date('Y') }} {{ \App\Models\SystemSetting::where('key', 'bot_name')->first()?->value ?? 'HuruLearn' }}. Designed for local school deployment.
            </div>
        </div>
    </footer>

    <script>
        // Mobile navigation hamburger toggle
        const hamburger = document.getElementById('hamburger');
        const navLinks = document.querySelector('.nav-links');
        if (hamburger && navLinks) {
            hamburger.addEventListener('click', () => {
                navLinks.classList.toggle('active');
                hamburger.setAttribute('aria-expanded', navLinks.classList.contains('active'));
            });
            
            // Close menu on link click
            navLinks.querySelectorAll('a').forEach(link => {
                link.addEventListener('click', () => {
                    navLinks.classList.remove('active');
                    hamburger.setAttribute('aria-expanded', 'false');
                });
            });
        }
    </script>
</body>
</html>
