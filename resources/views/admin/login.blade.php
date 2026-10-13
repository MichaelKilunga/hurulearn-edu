<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login &mdash; HuruLearn Admin</title>
    <meta name="robots" content="noindex, nofollow">
    <link rel="icon" href="/logo.svg" type="image/svg+xml">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #1b3f8b; /* Navy Blue */
            --primary-dark: #0f295e;
            --blue: #1d4ed8;
            --blue-light: #3b82f6;
            --amber: #eab308;
            --amber-light: #fef08a;
            --white: #ffffff;
            --bg: #f8fafc;
            --card-bg: #ffffff;
            --text-main: #0f172a;
            --text-muted: #475569;
            --border-color: #cbd5e1;
            --danger: #ef4444;
            --success: #15803d;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg);
            color: var(--text-main);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            position: relative;
        }

        /* BACKGROUND DECORATIONS */
        .bg-glow { display: none; }
        .dots-grid { display: none; }

        /* LOGIN CONTAINER */
        .login-container {
            width: 100%;
            max-width: 420px;
            padding: 1.5rem;
            position: relative;
            z-index: 10;
            animation: floatUp 0.8s ease-out;
        }

        @keyframes floatUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* LOGIN CARD */
        .login-card {
            background: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 24px;
            padding: 2.5rem 2rem;
            box-shadow: 0 20px 40px rgba(15, 23, 42, 0.05);
        }

        /* BRANDING */
        .brand {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            margin-bottom: 2.2rem;
        }
        .brand-logo {
            width: 56px;
            height: 56px;
            background: var(--primary);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Space Grotesk', sans-serif;
            font-weight: 700;
            font-size: 1.6rem;
            color: #fff;
            box-shadow: 0 8px 24px rgba(27, 63, 139, 0.15);
            margin-bottom: 1rem;
        }
        .brand-title {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary);
            letter-spacing: -0.02em;
        }
        .brand-subtitle {
            font-size: 0.82rem;
            color: var(--text-muted);
            margin-top: 0.25rem;
            font-weight: 500;
        }

        /* ALERTS */
        .alert {
            padding: 0.85rem 1rem;
            border-radius: 12px;
            font-size: 0.8rem;
            font-weight: 500;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.6rem;
            animation: fadeIn 0.3s ease-out;
        }
        .alert-error {
            background: #fee2e2;
            border: 1px solid #fca5a5;
            color: #ef4444;
        }
        .alert-success {
            background: #dcfce7;
            border: 1px solid #bbf7d0;
            color: #15803d;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-5px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* FORMS */
        .form-group {
            position: relative;
            margin-bottom: 1.5rem;
        }
        .form-label {
            display: block;
            font-size: 0.78rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: var(--text-muted);
            margin-bottom: 0.5rem;
            transition: color 0.2s;
        }
        .input-wrapper {
            position: relative;
        }
        .input-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            font-size: 1rem;
            color: var(--text-muted);
            pointer-events: none;
            transition: color 0.2s;
        }
        .form-input {
            width: 100%;
            padding: 0.85rem 1rem 0.85rem 2.6rem;
            background: #ffffff;
            border: 1.5px solid var(--border-color);
            border-radius: 12px;
            color: var(--text-main);
            font-size: 0.9rem;
            font-family: inherit;
            outline: none;
            transition: all 0.2s ease-in-out;
        }
        .form-input::placeholder {
            color: var(--text-muted);
            opacity: 0.6;
        }
        .form-input:focus {
            background: #ffffff;
            border-color: var(--primary);
            box-shadow: 0 0 10px rgba(27, 63, 139, 0.1);
        }
        .form-input:focus + .input-icon {
            color: var(--primary);
        }
        .form-group:focus-within .form-label {
            color: var(--primary);
        }

        /* CHECKBOX / REMEMBER */
        .form-options {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.8rem;
        }
        .remember-me {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            cursor: pointer;
            user-select: none;
        }
        .remember-me input {
            display: none;
        }
        .checkbox-custom {
            width: 18px;
            height: 18px;
            border-radius: 6px;
            border: 1.5px solid var(--border-color);
            background: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s;
        }
        .remember-me input:checked + .checkbox-custom {
            background: var(--primary);
            border-color: var(--primary);
        }
        .checkbox-custom::after {
            content: '✓';
            font-size: 0.7rem;
            color: #fff;
            font-weight: bold;
            display: none;
        }
        .remember-me input:checked + .checkbox-custom::after {
            display: block;
        }
        .remember-text {
            font-size: 0.82rem;
            color: var(--text-muted);
            font-weight: 500;
        }

        /* BUTTONS */
        .btn-submit {
            width: 100%;
            padding: 0.9rem 1.5rem;
            border-radius: 12px;
            font-family: inherit;
            font-size: 0.92rem;
            font-weight: 700;
            color: #fff;
            background: var(--primary);
            border: none;
            cursor: pointer;
            box-shadow: 0 4px 12px rgba(27, 63, 139, 0.2);
            transition: all 0.2s ease-in-out;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }
        .btn-submit:hover {
            background: var(--primary-dark);
            transform: translateY(-1px);
            box-shadow: 0 6px 16px rgba(27, 63, 139, 0.3);
        }
        .btn-submit:active {
            transform: translateY(1px);
        }

        /* FOOTER links */
        .login-footer {
            margin-top: 1.5rem;
            text-align: center;
        }
        .login-footer a {
            font-size: 0.8rem;
            color: var(--text-muted);
            text-decoration: none;
            transition: color 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
        }
        .login-footer a:hover {
            color: var(--primary);
        }
    </style>
</head>
<body>

    <!-- BG EFFECTS -->
    <div class="bg-glow bg-glow-1"></div>
    <div class="bg-glow bg-glow-2"></div>
    <div class="bg-glow bg-glow-center"></div>
    <div class="dots-grid"></div>

    <div class="login-container">
        <div class="login-card">
            
            <div class="brand">
                <div class="brand-logo">
                    <img src="/logo.svg" alt="H" style="width: 32px; height: 32px;">
                </div>
                <h1 class="brand-title">HuruLearn</h1>
                <p class="brand-subtitle">Administrator Portal Login</p>
            </div>

            <!-- SUCCESS & ERROR MESSAGES -->
            @if(session('success'))
                <div class="alert alert-success">
                    <span>✓</span>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-error">
                    <span>✕</span>
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-error">
                    <span>✕</span>
                    <span>{{ $errors->first() }}</span>
                </div>
            @endif

            <form action="{{ route('admin.login.submit') }}" method="POST">
                @csrf

                <!-- EMAIL FIELD -->
                <div class="form-group">
                    <label for="email" class="form-label">Email Address</label>
                    <div class="input-wrapper">
                        <span class="input-icon">✉</span>
                        <input 
                            type="email" 
                            name="email" 
                            id="email" 
                            class="form-input" 
                            placeholder="admin@example.com" 
                            value="{{ old('email') }}" 
                            required 
                            autofocus
                        >
                    </div>
                </div>

                <!-- PASSWORD FIELD -->
                <div class="form-group" style="margin-bottom: 1.2rem;">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-wrapper">
                        <span class="input-icon">🔒</span>
                        <input 
                            type="password" 
                            name="password" 
                            id="password" 
                            class="form-input" 
                            placeholder="••••••••" 
                            required
                        >
                    </div>
                </div>

                <!-- OPTIONS -->
                <div class="form-options">
                    <label class="remember-me">
                        <input type="checkbox" name="remember" id="remember">
                        <div class="checkbox-custom"></div>
                        <span class="remember-text">Remember me</span>
                    </label>
                </div>

                <!-- SUBMIT BUTTON -->
                <button type="submit" class="btn-submit">
                    <span>Sign In</span>
                    <span>→</span>
                </button>

            </form>

            <!-- SMS Offline Access Info -->
            <div class="sms-access-banner" style="margin-top: 1.5rem; padding: 0.85rem; background: #eff6ff; border: 1.5px solid #bfdbfe; border-radius: 12px; font-size: 0.8rem; text-align: center; color: #1e3a8a;">
                📢 <strong>Offline SMS Access:</strong> Send keyword <strong>HURU</strong> to <strong>15054</strong> for offline learning and support.
            </div>

            <div class="login-footer">
                <a href="/">← Return to Public Website</a>
            </div>

        </div>
    </div>

</body>
</html>
