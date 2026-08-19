<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($page_title ?? 'Student Profile'); ?></title>
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
            --border: rgba(148,163,184,0.25);
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: Arial, Helvetica, sans-serif;
            background: var(--bg);
            color: var(--text);
            padding: 40px 18px;
        }

        .container {
            max-width: 980px;
            margin: 0 auto;
        }

        .neo-card {
            background: var(--panel);
            border-radius: 30px;
            box-shadow: 14px 14px 28px var(--shadow-dark), -14px -14px 28px var(--shadow-light);
            border: 1px solid var(--border);
            overflow: hidden;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 28px 32px;
            border-bottom: 1px solid rgba(148,163,184,0.18);
            flex-wrap: wrap;
            gap: 18px;
        }

        .brand {
            font-size: 1.5rem;
            font-weight: 700;
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
            transition: transform 180ms ease, color 180ms ease, box-shadow 180ms ease;
        }

        nav a:hover {
            color: var(--accent-strong);
            transform: translateY(-3px);
            box-shadow: 9px 9px 18px var(--shadow-dark), -9px -9px 18px var(--shadow-light);
        }

        nav a:active {
            transform: translateY(1px);
            box-shadow: inset 4px 4px 8px var(--shadow-dark), inset -4px -4px 8px var(--shadow-light);
        }

        .content {
            display: grid;
            grid-template-columns: 280px 1fr;
            gap: 28px;
            padding: 32px;
            min-width: 0;
        }

        .profile-aside {
            background: linear-gradient(145deg, #edf3fb, #dfeaf7);
            border-radius: 28px;
            padding: 24px 18px;
            box-shadow: inset 8px 8px 16px rgba(255,255,255,0.55), inset -10px -10px 18px rgba(182,194,209,0.55);
            text-align: center;
        }

        .avatar {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            margin: 0 auto 18px;
            display: block;
            object-fit: cover;
            box-shadow: 0 0 0 12px rgba(239,108,66,0.12);
            border: 5px solid var(--panel);
            transition: transform 220ms ease, box-shadow 220ms ease;
        }

        .avatar:hover {
            transform: scale(1.04) rotate(-2deg);
            box-shadow: 0 0 0 12px rgba(239,108,66,0.16), 0 14px 24px rgba(30,41,59,0.2);
        }

        .profile-title {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 12px;
        }

        .badge {
            display: inline-block;
            background: rgba(76,201,162,0.12);
            color: #1e8f69;
            border-radius: 999px;
            padding: 8px 12px;
            font-weight: 700;
            letter-spacing: 0.04em;
            font-size: 0.75rem;
            text-transform: uppercase;
        }

        .info-panel {
            padding: 22px;
            border-radius: 24px;
            background: linear-gradient(145deg, #edf3fb, #dde8f5);
            box-shadow: inset 8px 8px 16px rgba(255,255,255,0.5), inset -10px -10px 18px rgba(182,194,209,0.5);
            min-width: 0;
        }

        h1 {
            margin: 0 0 20px;
            font-size: clamp(2rem, 4vw, 2.6rem);
            letter-spacing: -0.04em;
            overflow-wrap: anywhere;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 16px;
        }

        .info-item {
            background: rgba(255,255,255,0.32);
            padding: 16px 18px;
            border-radius: 16px;
            box-shadow: inset 1px 1px 0 rgba(255,255,255,0.6);
        }

        .label {
            display: block;
            font-size: 0.72rem;
            color: var(--muted);
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            margin-bottom: 8px;
        }

        .value {
            font-size: 1rem;
            font-weight: 700;
            line-height: 1.5;
            overflow-wrap: anywhere;
        }

        .facebook-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 14px;
            border-radius: 12px;
            background: var(--accent);
            color: #fff;
            text-decoration: none;
            box-shadow: 6px 6px 12px var(--shadow-dark), -6px -6px 12px var(--shadow-light);
            transition: transform 180ms ease, background 180ms ease, box-shadow 180ms ease;
        }

        .facebook-link:hover {
            background: var(--accent-strong);
            transform: translateY(-2px);
            box-shadow: 8px 8px 16px var(--shadow-dark), -8px -8px 16px var(--shadow-light);
        }

        .facebook-link:active {
            transform: translateY(1px);
            box-shadow: inset 4px 4px 8px rgba(171,80,45,0.45), inset -4px -4px 8px rgba(255,255,255,0.45);
        }

        .skills {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 16px;
        }

        .skills span {
            background: rgba(255,138,91,0.12);
            color: var(--accent-strong);
            border-radius: 999px;
            padding: 8px 12px;
            font-size: 0.8rem;
            font-weight: 700;
        }

        @media (max-width: 760px) {
            .content {
                grid-template-columns: 1fr;
            }

            .info-grid {
                grid-template-columns: 1fr;
            }

            .header {
                justify-content: center;
                text-align: center;
            }
        }

        @media (max-width: 480px) {
            body { padding: 20px 12px; }

            .header { padding: 22px 18px; }

            nav a { padding: 11px 13px; font-size: 0.9rem; }

            .content { gap: 20px; padding: 20px 16px; }

            .profile-aside, .info-panel { padding: 20px 16px; }

            .info-grid { gap: 12px; }

            .info-item { padding: 14px; }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="neo-card">
            <div class="header">
                <div class="brand"><span>Student</span> Profile</div>
                <nav>
                    <a href="<?= site_url('student'); ?>">Home</a>
                    <a href="<?= site_url('student/logout'); ?>">Logout</a>
                </nav>
            </div>

            <div class="content">
                <aside class="profile-aside">
                    <img class="avatar" src="<?= base_url($student['profile_picture']); ?>" alt="<?= htmlspecialchars($student['name']); ?> profile picture">
                    <div class="profile-title"><?= htmlspecialchars($student['name']); ?></div>
                    <div class="badge">Verified Student</div>
                </aside>

                <section class="info-panel">
                    <h1>Student Information</h1>

                    <div class="info-grid">
                        <div class="info-item">
                            <span class="label">Student ID</span>
                            <div class="value"><?= htmlspecialchars($student['student_id']); ?></div>
                        </div>

                        <div class="info-item">
                            <span class="label">Name</span>
                            <div class="value"><?= htmlspecialchars($student['name']); ?></div>
                        </div>

                        <div class="info-item">
                            <span class="label">Course</span>
                            <div class="value"><?= htmlspecialchars($student['course']); ?></div>
                        </div>

                        <div class="info-item">
                            <span class="label">Year Level</span>
                            <div class="value"><?= htmlspecialchars($student['year']); ?></div>
                        </div>

                        <div class="info-item">
                            <span class="label">Section</span>
                            <div class="value"><?= htmlspecialchars($student['section']); ?></div>
                        </div>

                        <div class="info-item">
                            <span class="label">Email</span>
                            <div class="value"><?= htmlspecialchars($student['email']); ?></div>
                        </div>

                        <div class="info-item">
                            <span class="label">Address</span>
                            <div class="value"><?= htmlspecialchars($student['address']); ?></div>
                        </div>

                        <div class="info-item">
                            <span class="label">Contact</span>
                            <div class="value"><?= htmlspecialchars($student['contact']); ?></div>
                        </div>

                        <div class="info-item">
                            <span class="label">Facebook</span>
                            <div class="value">
                                <a class="facebook-link" href="<?= htmlspecialchars($student['facebook']); ?>" target="_blank" rel="noopener noreferrer">View Facebook Profile</a>
                            </div>
                        </div>
                    </div>

                    <div class="info-item" style="margin-top:16px;">
                        <span class="label">Student Athlete</span>
                        <div class="skills">
                            <?php foreach ($student['skills'] as $skill): ?>
                                <span><?= htmlspecialchars($skill); ?></span>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</body>
</html>
