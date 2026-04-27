<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= esc($title ?? 'Login') ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <div style="text-align: center; margin-top: 80px;">
        <h1>Login</h1>

        <?php
        $flashMessage = session()->getFlashdata('message');
        $flashError   = session()->getFlashdata('error');
        ?>
        <?php if ($flashMessage !== null): ?>
            <p style="color: #0a0;"><?= esc($flashMessage) ?></p>
        <?php endif; ?>
        <?php if ($flashError !== null): ?>
            <p style="color: #a00;"><?= esc($flashError) ?></p>
        <?php endif; ?>

        <form method="post" action="<?= site_url('login') ?>" style="max-width: 360px; margin: 24px auto; text-align: left; display: flex; flex-direction: column; gap: 10px;">
            <?= csrf_field() ?>
            <label>
                Email<br>
                <input type="email" name="email" value="<?= esc(old('email', '')) ?>" required maxlength="100" style="width: 100%; box-sizing: border-box; padding: 8px;">
            </label>
            <label>
                Password<br>
                <input type="password" name="password" value="" required autocomplete="current-password" maxlength="255" style="width: 100%; box-sizing: border-box; padding: 8px;">
            </label>
            <button type="submit" style="padding: 8px 16px; align-self: center;">Sign in</button>
        </form>
    </div>
</body>
</html>
