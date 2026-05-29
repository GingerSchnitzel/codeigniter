<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= esc($title ?? 'Login') ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(135deg, #0f172a, #1e293b);
        }

        .login-container {
            width: 100%;
            max-width: 400px;
            background: white;
            padding: 40px;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.25);
        }

        .login-title {
            text-align: center;
            margin-bottom: 30px;
            color: #0f172a;
            font-size: 32px;
            font-weight: bold;
        }

        .subtitle {
            text-align: center;
            color: #64748b;
            margin-bottom: 30px;
            font-size: 14px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #334155;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 12px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            font-size: 15px;
            transition: 0.2s;
        }

        input:focus {
            outline: none;
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37,99,235,0.15);
        }

        .login-btn {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 8px;
            background: #2563eb;
            color: white;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.2s;
        }

        .login-btn:hover {
            background: #1d4ed8;
        }

        .error-message {
            background: #fee2e2;
            color: #b91c1c;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            text-align: center;
        }

        .success-message {
            background: #dcfce7;
            color: #166534;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            text-align: center;
        }

        .footer-text {
            margin-top: 25px;
            text-align: center;
            font-size: 13px;
            color: #94a3b8;
        }
    </style>
</head>
<body>

<div class="login-container">

    <div class="login-title">
        eCabCardio
    </div>

    <div class="subtitle">
        Medical Management System
    </div>

    <?php
    $flashMessage = session()->getFlashdata('message');
    $flashError   = session()->getFlashdata('error');
    ?>

    <?php if ($flashMessage !== null): ?>
        <div class="success-message">
            <?= esc($flashMessage) ?>
        </div>
    <?php endif; ?>

    <?php if ($flashError !== null): ?>
        <div class="error-message">
            <?= esc($flashError) ?>
        </div>
    <?php endif; ?>

    <form method="post" action="<?= site_url('authenticate') ?>">

        <?= csrf_field() ?>

        <div class="form-group">
            <label>Username</label>

            <input
                type="text"
                name="username"
                value="<?= esc(old('username', '')) ?>"
                required
                maxlength="100"
                autocomplete="username"
            >
        </div>

        <div class="form-group">
            <label>Password</label>

            <input
                type="password"
                name="password"
                required
                maxlength="255"
                autocomplete="current-password"
            >
        </div>

        <button type="submit" class="login-btn">
            Sign In
        </button>

    </form>

    <div class="footer-text">
        eCabCardio © 2026
    </div>

</div>

</body>
</html>