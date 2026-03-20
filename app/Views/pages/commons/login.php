<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign In — HSE Portal</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" crossorigin="anonymous">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Inter', -apple-system, sans-serif;
            font-feature-settings: 'cv02','cv03','cv04','cv11';
            -webkit-font-smoothing: antialiased;
            min-height: 100vh;
            display: flex;
            background: #fafaf9;
            color: #1c1917;
        }

        /* ── LEFT PANEL ── */
        .panel-left {
            width: 480px;
            flex-shrink: 0;
            background: #1c1917;
            display: flex;
            flex-direction: column;
            padding: 48px;
            position: relative;
            overflow: hidden;
        }

        /* Dot grid pattern */
        .panel-left::before {
            content: '';
            position: absolute;
            inset: 0;
            background-image: radial-gradient(circle, rgba(255,255,255,.08) 1px, transparent 1px);
            background-size: 28px 28px;
            pointer-events: none;
        }

        /* Accent glow */
        .panel-left::after {
            content: '';
            position: absolute;
            bottom: -80px;
            left: -80px;
            width: 360px;
            height: 360px;
            background: radial-gradient(circle, rgba(79,70,229,.35) 0%, transparent 70%);
            pointer-events: none;
        }

        .left-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            position: relative;
            z-index: 1;
        }
        .left-brand-mark {
            width: 36px;
            height: 36px;
            background: #4f46e5;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 15px;
            font-weight: 700;
        }
        .left-brand-name {
            font-size: 16px;
            font-weight: 600;
            color: #fff;
            letter-spacing: -0.2px;
        }

        .left-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
            z-index: 1;
        }
        .left-content h2 {
            font-size: 32px;
            font-weight: 700;
            color: #fff;
            letter-spacing: -0.5px;
            line-height: 1.2;
            margin-bottom: 16px;
        }
        .left-content h2 span {
            color: #818cf8;
        }
        .left-content p {
            font-size: 14px;
            color: #a8a29e;
            line-height: 1.7;
            max-width: 320px;
        }

        .feature-list {
            margin-top: 40px;
            display: flex;
            flex-direction: column;
            gap: 14px;
        }
        .feature-item {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .feature-icon {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            background: rgba(79,70,229,.2);
            border: 1px solid rgba(79,70,229,.3);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #818cf8;
            font-size: 14px;
            flex-shrink: 0;
        }
        .feature-text {
            font-size: 13px;
            color: #d4d2cf;
            font-weight: 500;
        }

        .left-footer {
            position: relative;
            z-index: 1;
            font-size: 12px;
            color: #57534e;
        }

        /* ── RIGHT PANEL ── */
        .panel-right {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 48px;
        }

        .auth-form-wrap {
            width: 100%;
            max-width: 380px;
        }

        .auth-eyebrow {
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: #4f46e5;
            margin-bottom: 12px;
        }
        .auth-heading {
            font-size: 26px;
            font-weight: 700;
            letter-spacing: -0.4px;
            color: #1c1917;
            margin-bottom: 6px;
        }
        .auth-sub {
            font-size: 13px;
            color: #a8a29e;
            margin-bottom: 32px;
        }

        .field { margin-bottom: 18px; }
        .field label {
            display: block;
            font-size: 12px;
            font-weight: 600;
            color: #57534e;
            margin-bottom: 6px;
        }
        .input-wrap { position: relative; }
        .input-wrap input {
            width: 100%;
            height: 40px;
            padding: 0 40px 0 12px;
            border: 1px solid #e2e0dd;
            border-radius: 8px;
            font-size: 13px;
            font-family: inherit;
            color: #1c1917;
            background: #fff;
            outline: none;
            transition: all .15s;
        }
        .input-wrap input:focus {
            border-color: #4f46e5;
            box-shadow: 0 0 0 3px rgba(79,70,229,.12);
        }
        .input-wrap input::placeholder { color: #a8a29e; }
        .input-wrap .eye-btn {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #a8a29e;
            cursor: pointer;
            font-size: 14px;
            padding: 0;
            line-height: 1;
            transition: color .15s;
        }
        .input-wrap .eye-btn:hover { color: #57534e; }

        .btn-submit {
            width: 100%;
            height: 40px;
            background: #4f46e5;
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            font-family: inherit;
            cursor: pointer;
            transition: background .15s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            margin-top: 8px;
        }
        .btn-submit:hover { background: #4338ca; }

        .auth-footer-link {
            text-align: center;
            margin-top: 24px;
            font-size: 13px;
            color: #a8a29e;
        }
        .auth-footer-link a {
            color: #4f46e5;
            font-weight: 600;
            text-decoration: none;
        }
        .auth-footer-link a:hover { text-decoration: underline; }

        .alert-box {
            display: flex;
            align-items: flex-start;
            gap: 8px;
            padding: 10px 12px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 500;
            margin-bottom: 20px;
            border: 1px solid;
        }
        .alert-error   { background: #fef2f2; color: #dc2626; border-color: #fecaca; }
        .alert-success { background: #f0fdf4; color: #16a34a; border-color: #bbf7d0; }

        @media (max-width: 768px) {
            .panel-left { display: none; }
        }
    </style>
</head>
<body>

<div class="panel-left">
    <div class="left-brand">
        <div class="left-brand-mark">HSE</div>
        <span class="left-brand-name">HSE Portal</span>
    </div>

    <div class="left-content">
        <h2>Manage your school<br>with <span>confidence.</span></h2>
        <p>A unified platform for administrators, teachers, coordinators, and students to collaborate and track academic progress.</p>

        <div class="feature-list">
            <div class="feature-item">
                <div class="feature-icon"><i class="bi bi-shield-check"></i></div>
                <span class="feature-text">Role-based access control</span>
            </div>
            <div class="feature-item">
                <div class="feature-icon"><i class="bi bi-people"></i></div>
                <span class="feature-text">Student & staff management</span>
            </div>
            <div class="feature-item">
                <div class="feature-icon"><i class="bi bi-bar-chart-line"></i></div>
                <span class="feature-text">Real-time analytics & reports</span>
            </div>
        </div>
    </div>

    <div class="left-footer">© <?= date('Y') ?> HSE Portal. All rights reserved.</div>
</div>

<div class="panel-right">
    <div class="auth-form-wrap">
        <div class="auth-eyebrow">Welcome back</div>
        <h1 class="auth-heading">Sign in to HSE Portal</h1>
        <p class="auth-sub">Enter your credentials to access your account.</p>

        <?php if (session()->getFlashdata('notif_error')): ?>
        <div class="alert-box alert-error">
            <i class="bi bi-exclamation-triangle-fill" style="flex-shrink:0;margin-top:1px;"></i>
            <span><?= session()->getFlashdata('notif_error') ?></span>
        </div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('notif_success')): ?>
        <div class="alert-box alert-success">
            <i class="bi bi-check-circle-fill" style="flex-shrink:0;margin-top:1px;"></i>
            <span><?= session()->getFlashdata('notif_success') ?></span>
        </div>
        <?php endif; ?>

        <form action="<?= base_url('login') ?>" method="POST">
            <div class="field">
                <label for="inputEmail">Email address</label>
                <div class="input-wrap">
                    <input type="email" id="inputEmail" name="inputEmail" placeholder="you@school.edu" required autocomplete="email">
                </div>
            </div>
            <div class="field">
                <label for="inputPassword">Password</label>
                <div class="input-wrap">
                    <input type="password" id="inputPassword" name="inputPassword" placeholder="Enter your password" required autocomplete="current-password">
                    <button type="button" class="eye-btn" onclick="togglePwd()">
                        <i class="bi bi-eye" id="eyeIco"></i>
                    </button>
                </div>
            </div>
            <button type="submit" class="btn-submit">
                Sign in <i class="bi bi-arrow-right"></i>
            </button>
        </form>

        <div class="auth-footer-link">
            Don't have an account? <a href="<?= base_url('register') ?>">Create one</a>
        </div>
    </div>
</div>

<script>
function togglePwd() {
    const p = document.getElementById('inputPassword'), i = document.getElementById('eyeIco');
    p.type = p.type === 'password' ? 'text' : 'password';
    i.className = p.type === 'password' ? 'bi bi-eye' : 'bi bi-eye-slash';
}
</script>
</body>
</html>
