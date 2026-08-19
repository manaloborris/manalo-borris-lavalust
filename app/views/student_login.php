<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($page_title ?? 'Student Login'); ?></title>
    <style>
        :root {
            --bg: #e7edf5;
            --panel: #edf3fb;
            --shadow-dark: #b6c2d1;
            --shadow-light: #ffffff;
            --text: #1e293b;
            --muted: #64748b;
            --accent: #ff8a5b;
            --accent-strong: #ef6c42;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: Arial, Helvetica, sans-serif;
            background: var(--bg);
            color: var(--text);
            display: grid;
            place-items: center;
            padding: 24px;
        }

        .login-card {
            width: min(460px, 100%);
            padding: 38px;
            border-radius: 30px;
            background: var(--panel);
            box-shadow: 14px 14px 28px var(--shadow-dark), -14px -14px 28px var(--shadow-light);
            text-align: center;
        }

        .brand {
            font-size: 1.6rem;
            font-weight: 700;
            margin-bottom: 34px;
        }

        .brand span { color: var(--accent-strong); }

        .avatar {
            width: 92px;
            height: 92px;
            margin: 0 auto 24px;
            border-radius: 50%;
            display: grid;
            place-items: center;
            background: linear-gradient(145deg, var(--accent), var(--accent-strong));
            color: #fff;
            font-size: 2rem;
            font-weight: 700;
            box-shadow: 0 0 0 10px rgba(239,108,66,0.12);
        }

        h1 { margin: 0 0 10px; font-size: 2rem; }

        .subtitle {
            margin: 0 0 28px;
            color: var(--muted);
            line-height: 1.6;
        }

        label {
            display: block;
            margin-bottom: 9px;
            text-align: left;
            color: var(--muted);
            font-size: 0.82rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.06em;
        }

        input {
            width: 100%;
            padding: 15px 16px;
            border: 0;
            border-radius: 14px;
            background: var(--panel);
            color: var(--text);
            font: inherit;
            box-shadow: inset 5px 5px 10px var(--shadow-dark), inset -5px -5px 10px var(--shadow-light);
            outline: none;
        }

        input:focus { box-shadow: inset 3px 3px 7px var(--shadow-dark), inset -3px -3px 7px var(--shadow-light), 0 0 0 3px rgba(239,108,66,0.2); }

        button {
            width: 100%;
            margin-top: 22px;
            padding: 15px 18px;
            border: 0;
            border-radius: 14px;
            background: var(--accent);
            color: #fff;
            font: inherit;
            font-weight: 700;
            cursor: pointer;
            box-shadow: 7px 7px 15px var(--shadow-dark), -7px -7px 15px var(--shadow-light);
        }

        button:hover { background: var(--accent-strong); }

        .error {
            margin: 0 0 18px;
            color: #c2410c;
            font-weight: 700;
        }

        .page-loader {
            position: fixed;
            inset: 0;
            z-index: 10;
            display: grid;
            place-items: center;
            background: rgba(231,237,245,0.86);
            opacity: 0;
            pointer-events: none;
            transition: opacity 180ms ease;
        }

        .page-loader.is-visible { opacity: 1; pointer-events: auto; }

        .loader-ring {
            width: 46px;
            height: 46px;
            border: 4px solid rgba(239,108,66,0.2);
            border-top-color: var(--accent-strong);
            border-radius: 50%;
            animation: spin 520ms linear infinite;
        }

        @keyframes spin { to { transform: rotate(360deg); } }

        @media (prefers-reduced-motion: reduce) {
            .page-loader, .loader-ring { transition: none; animation: none; }
        }

        @media (max-width: 480px) {
            body { padding: 16px 12px; }

            .login-card { padding: 28px 20px; border-radius: 24px; }

            .brand { margin-bottom: 26px; }

            .avatar { width: 78px; height: 78px; margin-bottom: 20px; font-size: 1.7rem; }

            h1 { font-size: 1.7rem; }

            .subtitle { margin-bottom: 24px; }

            input, button { padding: 14px; }
        }
    </style>
</head>
<body>
    <div class="page-loader" aria-hidden="true">
        <div class="loader-ring" aria-label="Loading"></div>
    </div>

    <main class="login-card">
        <div class="brand"><span>Student</span> Portal</div>
        <div class="avatar">SP</div>
        <h1>Viewer Access</h1>
        <p class="subtitle">Enter your name to view the Borris profile.</p>

        <?php if (!empty($error)): ?>
            <p class="error"><?= htmlspecialchars($error); ?></p>
        <?php endif; ?>

        <form id="login-form" method="post" action="<?= site_url('student/login'); ?>">
            <label for="name">Viewer Name</label>
            <input id="name" name="name" type="text" placeholder="Enter your name" required autofocus>
            <button type="submit">View Borris Profile</button>
        </form>
    </main>

    <script>
        document.getElementById('login-form').addEventListener('submit', function () {
            document.querySelector('.page-loader').classList.add('is-visible');
        });
    </script>
</body>
</html>
