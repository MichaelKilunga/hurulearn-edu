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
            --indigo: #1e1b4b;
            --indigo-dark: #0b0a1e;
            --indigo-mid: #16143a;
            --blue: #3b82f6;
            --blue-light: #60a5fa;
            --amber: #f59e0b;
            --amber-light: #fcd34d;
            --white: #ffffff;
            --gray-100: #f1f5f9;
            --gray-300: #cbd5e1;
            --gray-400: #94a3b8;
            --gray-500: #64748b;
            --gray-600: #475569;
            --gray-700: #334155;
            --gray-800: #1e293b;
            --danger: #ef4444;
            --success: #10b981;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Inter', sans-serif;
            background: var(--indigo-dark);
            color: var(--gray-100);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            position: relative;
        }

        /* BACKGROUND DECORATIONS */
        .bg-glow {
            position: absolute;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(59, 130, 246, 0.15) 0%, transparent 70%);
            border-radius: 50%;
            z-index: 1;
            pointer-events: none;
        }
        .bg-glow-1 { top: -10%; left: -10%; }
        .bg-glow-2 { bottom: -10%; right: -10%; }
        .bg-glow-center {
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(245, 158, 11, 0.08) 0%, transparent 70%);
        }

        .dots-grid {
            position: absolute;
            inset: 0;
            background-image: radial-gradient(rgba(255, 255, 255, 0.02) 1px, transparent 1px);
            background-size: 30px 30px;
            z-index: 1;
            pointer-events: none;
        }

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
            background: rgba(255, 255, 255, 0.02);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.06);
            border-radius: 24px;
            padding: 2.5rem 2rem;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4), 
                        inset 0 1px 0 rgba(255, 255, 255, 0.1);
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
            background: linear-gradient(135deg, var(--amber), var(--blue));
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Space Grotesk', sans-serif;
            font-weight: 700;
            font-size: 1.6rem;
            color: #fff;
            box-shadow: 0 8px 24px rgba(245, 158, 11, 0.2);
            margin-bottom: 1rem;
        }
        .brand-title {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 1.5rem;
            font-weight: 700;
            color: #fff;
            letter-spacing: -0.02em;
        }
        .brand-subtitle {
            font-size: 0.82rem;
            color: var(--gray-500);
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
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.2);
            color: #fca5a5;
        }
        .alert-success {
            background: rgba(16, 185, 129, 0.1);
            border: 1px solid rgba(16, 185, 129, 0.2);
            color: #a7f3d0;
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
            color: var(--gray-400);
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
            color: var(--gray-500);
            pointer-events: none;
            transition: color 0.2s;
        }
        .form-input {
            width: 100%;
            padding: 0.85rem 1rem 0.85rem 2.6rem;
            background: rgba(255, 255, 255, 0.04);
            border: 1.5px solid rgba(255, 255, 255, 0.08);
            border-radius: 12px;
            color: #fff;
            font-size: 0.9rem;
            font-family: inherit;
            outline: none;
            transition: all 0.2s ease-in-out;
        }
        .form-input::placeholder {
            color: var(--gray-600);
        }
        .form-input:focus {
            background: rgba(255, 255, 255, 0.07);
            border-color: var(--amber);
            box-shadow: 0 0 15px rgba(245, 158, 11, 0.1);
        }
        .form-input:focus + .input-icon {
            color: var(--amber-light);
        }
        .form-group:focus-within .form-label {
            color: var(--amber-light);
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
            border: 1.5px solid rgba(255, 255, 255, 0.2);
            background: rgba(255, 255, 255, 0.04);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s;
        }
        .remember-me input:checked + .checkbox-custom {
            background: var(--amber);
            border-color: var(--amber);
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
            color: var(--gray-400);
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
            background: linear-gradient(135deg, var(--amber), #e67e22);
            border: none;
            cursor: pointer;
            box-shadow: 0 4px 15px rgba(245, 158, 11, 0.25);
            transition: all 0.2s ease-in-out;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }
        .btn-submit:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(245, 158, 11, 0.35);
        }
        .btn-submit:active {
            transform: translateY(1px);
        }

        /* FOOTER links */
        .login-footer {
            margin-top: 2rem;
            text-align: center;
        }
        .login-footer a {
            font-size: 0.8rem;
            color: var(--gray-500);
            text-decoration: none;
            transition: color 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
        }
        .login-footer a:hover {
            color: var(--gray-300);
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

            <div class="login-footer">
                <a href="/">← Return to Public Website</a>
            </div>

        </div>
    </div>

</body>
</html>
