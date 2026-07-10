<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Offline Mode – HuruLearn</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --indigo: #1e1b4b;
            --indigo-dark: #0f0d2e;
            --blue: #3b82f6;
            --amber: #f59e0b;
            --white: #ffffff;
            --gray-400: #9ca3af;
        }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; background: var(--indigo-dark); color: var(--white); height: 100vh; display: flex; align-items: center; justify-content: center; overflow: hidden; text-align: center; padding: 1.5rem; }
        
        .bg-glow {
            position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            background: radial-gradient(circle at 50% 50%, rgba(59,130,246,0.12) 0%, transparent 60%);
            z-index: -1;
        }

        .card {
            background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.08);
            border-radius: 24px; padding: 3rem 2rem; max-width: 480px; width: 100%;
            backdrop-filter: blur(16px); box-shadow: 0 20px 50px rgba(0,0,0,0.4);
        }

        .icon { font-size: 3.5rem; margin-bottom: 1.5rem; display: inline-block; animation: float 3s ease-in-out infinite; }

        h1 { font-family: 'Space Grotesk', sans-serif; font-size: 1.8rem; margin-bottom: 0.8rem; }
        p { color: var(--gray-400); font-size: 0.95rem; line-height: 1.6; margin-bottom: 2rem; }

        .btn { display: inline-flex; align-items: center; justify-content: center; padding: .8rem 1.6rem; border-radius: 12px; font-weight: 600; text-decoration: none; cursor: pointer; transition: all .2s; border: none; font-size: .9rem; width: 100%; margin-bottom: 0.8rem; }
        .btn-primary { background: linear-gradient(135deg, var(--amber), #e67e22); color: #fff; box-shadow: 0 4px 15px rgba(245,158,11,0.3); }
        .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 8px 25px rgba(245,158,11,0.45); }
        .btn-outline { background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.15); color: #fff; }
        .btn-outline:hover { background: rgba(255,255,255,0.1); border-color: var(--blue); }

        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-8px); }
        }
    </style>
</head>
<body>
    <div class="bg-glow"></div>
    <div class="card">
        <span class="icon">📶❌</span>
        <h1>HuruLearn Offline Room</h1>
        <p>You are currently offline. But don't worry! Any study pages or curriculum topics you have read before are saved on your device and are fully accessible offline.</p>
        
        <a href="/curriculum" class="btn btn-primary">📖 Browse Offline Syllabus</a>
        <a href="/" class="btn btn-outline">🏠 Go to Homepage</a>
    </div>
</body>
</html>
