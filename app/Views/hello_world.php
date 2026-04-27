<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hello <?= esc($name) ?></title>
    <meta name="description" content="A simple hello world page">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <div style="text-align: center; margin-top: 100px;">
        <h1>Hello <?= esc($name) ?>!</h1>
        <p>This is a simple hello world page created with CodeIgniter 4.</p>
        <p style="margin-top: 8px;"><a href="<?= site_url('logout') ?>">Log out</a></p>

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

        <div style="margin-top: 30px; max-width: 360px; margin-left: auto; margin-right: auto; text-align: left;">
            <h2 style="text-align: center;">Add a name</h2>
            <form method="post" action="<?= site_url('hello/add') ?>" style="display: flex; flex-direction: column; gap: 10px;">
                <?= csrf_field() ?>
                <input type="hidden" name="redirect" value="1">
                <input type="hidden" name="return_segment" value="<?= esc($name) ?>">
                <label>
                    First name<br>
                    <input type="text" name="first_name" value="<?= esc(old('first_name', '')) ?>" required style="width: 100%; box-sizing: border-box; padding: 8px;">
                </label>
                <label>
                    Last name<br>
                    <input type="text" name="last_name" value="<?= esc(old('last_name', '')) ?>" required style="width: 100%; box-sizing: border-box; padding: 8px;">
                </label>
                <label>
                    Email<br>
                    <input type="email" name="email" value="<?= esc(old('email', '')) ?>" required maxlength="100" style="width: 100%; box-sizing: border-box; padding: 8px;">
                </label>
                <label>
                    Password<br>
                    <input type="password" name="password" value="" required autocomplete="new-password" maxlength="255" style="width: 100%; box-sizing: border-box; padding: 8px;">
                </label>
                <button type="submit" style="padding: 8px 16px; align-self: center;">Add</button>
            </form>
        </div>
        
        <div style="margin-top: 30px;">
            <h2>List of Names from Database</h2>
            <table style="margin: 0 auto; border-collapse: collapse;">
                <thead>
                    <tr>
                        <th style="padding: 10px; border: 1px solid #ddd;">First Name</th>
                        <th style="padding: 10px; border: 1px solid #ddd;">Last Name</th>
                        <th style="padding: 10px; border: 1px solid #ddd;">Email</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($names as $row): ?>
                    <tr>
                        <td style="padding: 10px; border: 1px solid #ddd;"><?= esc($row['first_name']) ?></td>
                        <td style="padding: 10px; border: 1px solid #ddd;"><?= esc($row['last_name']) ?></td>
                        <td style="padding: 10px; border: 1px solid #ddd;"><?= esc($row['email'] ?? '') ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
