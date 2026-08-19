<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($page_title ?? 'Student Home'); ?></title>
    <style>
        :root {
            --bg: #e7edf5;
            --panel: #edf3fb;
            --panel-strong: #dde6f2;
            --shadow-dark: #b6c2d1;
            --shadow-light: #ffffff;
            --text: #1e293b;
            --muted: #64748b;
            --accent: #ff8a5b;
            --accent-strong: #ef6c42;
            --success: #4cc9a2;
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
        }

        .page-shell {
            width: min(1100px, 90vw);
            padding: 40px 24px;
        }

        .neo-card {
            background: var(--panel);
            border-radius: 28px;
            box-shadow: 12px 12px 24px var(--shadow-dark), -12px -12px 24px var(--shadow-light);
            padding: 32px;
            border: 1px solid rgba(255,255,255,0.4);
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 20px;
            margin-bottom: 28px;
        }

        .brand {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            font-size: 1.6rem;
            font-weight: 700;
            letter-spacing: 0.04em;
        }

        .brand-logo {
            width: 42px;
            height: 42px;
            object-fit: contain;
            flex: 0 0 auto;
        }

        .brand span {
            color: var(--accent-strong);
        }

        nav {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }

        nav a {
            text-decoration: none;
            color: var(--text);
            padding: 12px 18px;
            border-radius: 14px;
            background: var(--panel);
            box-shadow: 7px 7px 15px var(--shadow-dark), -7px -7px 15px var(--shadow-light);
            font-weight: 600;
            transition: 0.2s ease;
        }

        nav a:hover {
            transform: translateY(-1px);
            color: var(--accent-strong);
        }

        .hero {
            display: grid;
            grid-template-columns: 1.5fr 1fr;
            gap: 28px;
            align-items: center;
            margin-top: 26px;
        }

        .hero-copy {
            padding: 28px;
            border-radius: 24px;
            background: linear-gradient(135deg, var(--panel-strong), var(--panel));
            box-shadow: inset 4px 4px 12px rgba(255,255,255,0.6), inset -6px -6px 12px rgba(182,194,209,0.5);
            min-width: 0;
        }

        .eyebrow {
            display: inline-block;
            background: rgba(255,138,91,0.12);
            color: var(--accent-strong);
            border-radius: 999px;
            padding: 8px 14px;
            font-size: 0.72rem;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            font-weight: 700;
            margin-bottom: 16px;
        }

        h1 {
            font-size: clamp(2.2rem, 3vw, 3.5rem);
            margin: 0 0 18px;
            overflow-wrap: anywhere;
        }

        .lead {
            font-size: 1.05rem;
            color: var(--muted);
            line-height: 1.7;
            margin-bottom: 22px;
        }

        .protected-action {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 13px 17px;
            border-radius: 14px;
            background: var(--accent);
            color: #fff;
            text-decoration: none;
            font-weight: 700;
            box-shadow: 7px 7px 15px var(--shadow-dark), -7px -7px 15px var(--shadow-light);
            transition: transform 180ms ease, background 180ms ease, box-shadow 180ms ease;
        }

        .protected-action::before {
            content: "◆";
            font-size: 0.72rem;
        }

        .protected-action:hover {
            background: var(--accent-strong);
            transform: translateY(-2px);
            box-shadow: 9px 9px 18px var(--shadow-dark), -9px -9px 18px var(--shadow-light);
        }

        .protected-action:active {
            transform: translateY(1px);
            box-shadow: inset 4px 4px 8px rgba(171,80,45,0.45), inset -4px -4px 8px rgba(255,255,255,0.45);
        }

        .protection-status {
            display: block;
            margin-top: 14px;
            color: var(--muted);
            font-size: 0.8rem;
            font-weight: 700;
            letter-spacing: 0.04em;
        }

        .profile-box {
            padding: 24px;
            border-radius: 22px;
            background: linear-gradient(145deg, #edf3fb, #dfeaf7);
            box-shadow: 10px 10px 20px var(--shadow-dark), -10px -10px 20px var(--shadow-light);
            min-width: 0;
        }

        .avatar {
            width: 110px;
            height: 110px;
            border-radius: 50%;
            display: block;
            object-fit: cover;
            margin: 0 auto 18px;
            box-shadow: 0 0 0 10px rgba(239,108,66,0.12);
            border: 4px solid var(--panel);
        }

        .profile-box h2 {
            text-align: center;
            margin-bottom: 22px;
            overflow-wrap: anywhere;
        }

        .student-mini {
            display: grid;
            gap: 12px;
            color: var(--text);
            font-size: 0.96rem;
        }

        .student-mini div {
            display: flex;
            justify-content: space-between;
            gap: 12px;
            padding: 10px 12px;
            border-radius: 12px;
            background: rgba(255,255,255,0.25);
        }

        .student-mini span {
            min-width: 0;
            overflow-wrap: anywhere;
            text-align: right;
        }

        .student-mini strong {
            color: var(--muted);
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

        @media (max-width: 760px) {
            .hero {
                grid-template-columns: 1fr;
            }

            .topbar {
                justify-content: center;
                text-align: center;
            }

            nav {
                justify-content: center;
            }
        }

        @media (max-width: 480px) {
            body { padding: 18px 12px; }

            .page-shell { width: 100%; padding: 20px 0; }

            .neo-card { padding: 22px 16px; border-radius: 22px; }

            .topbar { margin-bottom: 18px; }

            nav a { padding: 11px 13px; font-size: 0.9rem; }

            .hero { gap: 20px; margin-top: 18px; }

            .hero-copy, .profile-box { padding: 20px 16px; }

            h1 { font-size: 2rem; }
        }
    </style>
</head>
<body>
    <div class="page-loader" aria-hidden="true">
        <div class="loader-ring" aria-label="Loading"></div>
    </div>

    <div class="page-shell">
        <div class="neo-card">
            <div class="topbar">
                <div class="brand">
                    <img class="brand-logo" src="<?= base_url('minsulogo.png'); ?>" alt="Mindoro State University logo">
                    <span>Student</span> Portal
                </div>
                <nav>
                    <a href="<?= site_url('student/profile'); ?>">Student Profile</a>
                    <a href="<?= site_url('student/logout'); ?>">Logout</a>
                </nav>
            </div>

            <div class="hero">
                <div class="hero-copy">
                    <div class="eyebrow">Student Information</div>
                    <h1>Welcome, <?= htmlspecialchars($viewer_name ?? 'Viewer'); ?></h1>
                    <p class="lead">
                        This Page contains the Information of the Student, For more info you can tap the Student Profile. TY!
                    </p>
                    <a class="protected-action" href="<?= site_url('student/profile'); ?>">Unlock Protected Profile</a>
                    <span class="protection-status">Middleware gate: active</span>
                </div>

                <div class="profile-box">
                    <img class="avatar" src="<?= base_url($student['profile_picture']); ?>" alt="<?= htmlspecialchars($student['name']); ?> profile picture">
                    <h2><?= htmlspecialchars($student['name']); ?></h2>
                    <div class="student-mini">
                        <div><strong>Student ID</strong><span><?= htmlspecialchars($student['student_id']); ?></span></div>
                        <div><strong>Course</strong><span><?= htmlspecialchars($student['course']); ?></span></div>
                        <div><strong>Year</strong><span><?= htmlspecialchars($student['year']); ?></span></div>
                        <div><strong>Section</strong><span><?= htmlspecialchars($student['section']); ?></span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('nav a').forEach(function (link) {
            link.addEventListener('click', function () {
                document.querySelector('.page-loader').classList.add('is-visible');
            });
        });
    </script>
</body>
</html>
