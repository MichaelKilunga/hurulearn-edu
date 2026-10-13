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
            --primary: #1b3f8b;
            --primary-dark: #0f295e;
            --secondary: #1e293b;
            --bg: #f8fafc;
            --card-bg: #ffffff;
            --text-main: #0f172a;
            --text-muted: #475569;
            --border-color: #cbd5e1;
            --success: #15803d;
        }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; background: var(--bg); color: var(--text-main); height: 100vh; display: flex; align-items: center; justify-content: center; overflow: hidden; text-align: center; padding: 1.5rem; }
        
        .bg-glow { display: none; }

        .card {
            background: var(--card-bg); border: 1px solid var(--border-color);
            border-radius: 24px; padding: 3rem 2rem; max-width: 480px; width: 100%;
            box-shadow: 0 10px 30px rgba(15, 23, 42, 0.05);
        }

        .icon { font-size: 3.5rem; margin-bottom: 1.5rem; display: inline-block; animation: float 3s ease-in-out infinite; }

        h1 { font-family: 'Space Grotesk', sans-serif; font-size: 1.8rem; margin-bottom: 0.8rem; color: var(--primary); font-weight: 700; }
        p { color: var(--text-muted); font-size: 0.95rem; line-height: 1.6; margin-bottom: 2rem; }

        .btn { display: inline-flex; align-items: center; justify-content: center; padding: .8rem 1.6rem; border-radius: 12px; font-weight: 600; text-decoration: none; cursor: pointer; transition: all .2s; border: none; font-size: .9rem; width: 100%; margin-bottom: 0.8rem; }
        .btn-primary { background: var(--primary); color: #fff; box-shadow: 0 4px 12px rgba(27, 63, 139, 0.25); }
        .btn-primary:hover { background: var(--primary-dark); transform: translateY(-2px); box-shadow: 0 6px 16px rgba(27, 63, 139, 0.35); }
        .btn-outline { background: #ffffff; border: 1.5px solid var(--primary); color: var(--primary); }
        .btn-outline:hover { background: #eff6ff; color: var(--primary-dark); border-color: var(--primary-dark); }

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
