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
            font-size: 1.6rem;
            font-weight: 700;
            letter-spacing: 0.04em;
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
            background: linear-gradient(145deg, var(--accent), var(--accent-strong));
            display: grid;
            place-items: center;
            font-size: 2.4rem;
            color: white;
            font-weight: 700;
            margin: 0 auto 18px;
            box-shadow: 0 0 0 10px rgba(239,108,66,0.12);
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
    <div class="page-shell">
        <div class="neo-card">
            <div class="topbar">
                <div class="brand"><span>Student</span> Portal</div>
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
                </div>

                <div class="profile-box">
                    <div class="avatar">BM</div>
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
</body>
</html>
