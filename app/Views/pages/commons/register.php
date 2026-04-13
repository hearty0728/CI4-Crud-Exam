<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Create Account — HSE Portal</title>
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
            background: #fafaf9;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 32px 16px;
            color: #1c1917;
        }

        .register-wrap {
            width: 100%;
            max-width: 460px;
        }

        /* Top brand bar */
        .reg-brand {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 28px;
            justify-content: center;
        }
        .reg-brand-mark {
            width: 32px;
            height: 32px;
            background: #4f46e5;
            border-radius: 7px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 13px;
            font-weight: 700;
        }
        .reg-brand-name {
            font-size: 15px;
            font-weight: 600;
            color: #1c1917;
        }

        .reg-card {
            background: #fff;
            border: 1px solid #e2e0dd;
            border-radius: 16px;
            box-shadow: 0 4px 12px rgba(0,0,0,.06);
            overflow: hidden;
        }

        .reg-card-head {
            padding: 28px 32px 24px;
            border-bottom: 1px solid #e2e0dd;
        }
        .reg-card-head h1 {
            font-size: 20px;
            font-weight: 700;
            letter-spacing: -0.3px;
            color: #1c1917;
            margin-bottom: 4px;
        }
        .reg-card-head p {
            font-size: 13px;
            color: #a8a29e;
        }

        .reg-card-body { padding: 28px 32px; }

        /* Role selector */
        .role-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 8px;
            margin-bottom: 20px;
        }
        .role-card {
            position: relative;
            cursor: pointer;
        }
        .role-card input[type="radio"] {
            position: absolute;
            opacity: 0;
            width: 0;
            height: 0;
        }
        .role-label {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 12px;
            border: 1.5px solid #e2e0dd;
            border-radius: 8px;
            cursor: pointer;
            transition: all .15s;
            background: #fff;
        }
        .role-label:hover { border-color: #c7d2fe; background: #f5f3ff; }
        .role-card input:checked + .role-label {
            border-color: #4f46e5;
            background: #eef2ff;
            box-shadow: 0 0 0 3px rgba(79,70,229,.1);
        }
        .role-icon {
            width: 30px; height: 30px;
            border-radius: 6px;
            display: flex; align-items: center; justify-content: center;
            font-size: 14px; flex-shrink: 0;
            background: #f1f0ff; color: #4f46e5;
            transition: all .15s;
        }
        .role-card input:checked + .role-label .role-icon {
            background: #4f46e5; color: #fff;
        }
        .role-text-name { font-size: 12px; font-weight: 600; color: #1c1917; }
        .role-text-desc { font-size: 10px; color: #a8a29e; margin-top: 1px; }

        .field { margin-bottom: 16px; }
        .field-row { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; margin-bottom: 16px; }
        .field label {
            display: block;
            font-size: 12px;
            font-weight: 600;
            color: #57534e;
            margin-bottom: 6px;
        }
        .field input {
            width: 100%;
            height: 38px;
            padding: 0 12px;
            border: 1px solid #e2e0dd;
            border-radius: 7px;
            font-size: 13px;
            font-family: inherit;
            color: #1c1917;
            background: #fff;
            outline: none;
            transition: all .15s;
        }
        .field input:focus {
            border-color: #4f46e5;
            box-shadow: 0 0 0 3px rgba(79,70,229,.12);
        }
        .field input::placeholder { color: #a8a29e; }

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
            margin-top: 4px;
        }
        .btn-submit:hover { background: #4338ca; }

        .reg-card-foot {
            padding: 16px 32px;
            background: #fafaf9;
            border-top: 1px solid #e2e0dd;
            text-align: center;
            font-size: 13px;
            color: #a8a29e;
        }
        .reg-card-foot a {
            color: #4f46e5;
            font-weight: 600;
            text-decoration: none;
        }
        .reg-card-foot a:hover { text-decoration: underline; }

        .alert-box {
            display: flex;
            align-items: flex-start;
            gap: 8px;
            padding: 10px 12px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 500;
            margin-bottom: 16px;
            border: 1px solid;
        }
        .alert-error { background: #fef2f2; color: #dc2626; border-color: #fecaca; }
    </style>
</head>
<body>

<div class="register-wrap">
    <div class="reg-brand">
        <div class="reg-brand-mark">HSE</div>
        <span class="reg-brand-name">HSE Portal</span>
    </div>

    <div class="reg-card">
        <div class="reg-card-head">
            <h1>Create your account</h1>
            <p>Join HSE Portal — select your role and fill in your details.</p>
        </div>

        <div class="reg-card-body">
            <?php if (session()->getFlashdata('notif_error')): ?>
            <div class="alert-box alert-error">
                <i class="bi bi-exclamation-triangle-fill" style="flex-shrink:0;margin-top:1px;"></i>
                <span><?= session()->getFlashdata('notif_error') ?></span>
            </div>
            <?php endif; ?>

            <form action="<?= base_url('register') ?>" method="POST">
                <!-- Role Selector -->
                <div class="field">
                    <label>Select your role</label>
                    <div class="role-grid">
                        <?php
                        $roles = [
                            ['student',     'bi-mortarboard-fill', 'Student',     'Enrolled learner'],
                            ['teacher',     'bi-person-workspace', 'Teacher',     'Faculty member'],
                            ['coordinator', 'bi-diagram-3-fill',   'Coordinator', 'Program coordinator'],
                            ['admin',       'bi-shield-fill',      'Admin',       'System administrator'],
                        ];
                        $selectedRole = old('inputRole', 'student');
                        foreach ($roles as [$val, $icon, $name, $desc]):
                        ?>
                        <label class="role-card">
                            <input type="radio" name="inputRole" value="<?= $val ?>" <?= $selectedRole === $val ? 'checked' : '' ?> required>
                            <div class="role-label">
                                <div class="role-icon"><i class="bi <?= $icon ?>"></i></div>
                                <div>
                                    <div class="role-text-name"><?= $name ?></div>
                                    <div class="role-text-desc"><?= $desc ?></div>
                                </div>
                            </div>
                        </label>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="field">
                    <label>Full name</label>
                    <input type="text" name="inputFullname" placeholder="Juan dela Cruz" value="<?= old('inputFullname') ?>" required autocomplete="name">
                </div>
                <div class="field">
                    <label>Email address</label>
                    <input type="email" name="inputEmail" placeholder="you@school.edu" value="<?= old('inputEmail') ?>" required autocomplete="email">
                </div>
                <div class="field-row">
                    <div class="field" style="margin-bottom:0;">
                        <label>Password</label>
                        <input type="password" name="inputPassword" placeholder="Min. 6 characters" required>
                    </div>
                    <div class="field" style="margin-bottom:0;">
                        <label>Confirm password</label>
                        <input type="password" name="inputPassword2" placeholder="Repeat password" required>
                    </div>
                </div>
                <button type="submit" class="btn-submit">
                    <i class="bi bi-person-plus"></i> Create account
                </button>
            </form>
        </div>

        <div class="reg-card-foot">
            Already have an account? <a href="<?= base_url('/') ?>">Sign in</a>
        </div>
    </div>
</div>

</body>
</html>
