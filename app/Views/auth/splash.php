<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aji Nl3bo Cafe</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/aji_nl3bo_managment/public/css/style.css">
    <style>
        .splash-body {
            margin: 0;
            padding: 0;
            min-height: 100vh;
            background: linear-gradient(160deg, #0f1c35 0%, #0b1120 60%, #0d1a2e 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Outfit', sans-serif;
        }

        .splash-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            gap: 0;
        }

        .splash-logo {
            font-size: 90px;
            line-height: 1;
            margin-bottom: 32px;
            animation: splash-float 2s ease-in-out infinite alternate;
            filter: drop-shadow(0 8px 24px rgba(79, 70, 229, 0.3));
        }

        @keyframes splash-float {
            from { transform: translateY(0px); }
            to   { transform: translateY(-12px); }
        }

        .splash-title {
            font-family: 'Outfit', sans-serif;
            font-size: 36px;
            font-weight: 700;
            color: #f8fafc;
            letter-spacing: -0.5px;
            margin: 0 0 10px 0;
        }

        .splash-subtitle {
            font-family: 'Outfit', sans-serif;
            font-size: 13px;
            color: #475569;
            letter-spacing: 3px;
            text-transform: uppercase;
            margin: 0 0 28px 0;
        }

        .splash-loader {
            width: 220px;
            height: 3px;
            background: rgba(255, 255, 255, 0.08);
            border-radius: 999px;
            overflow: hidden;
        }

        .splash-loader-bar {
            height: 100%;
            width: 0%;
            background: linear-gradient(90deg, #4f46e5, #10b981);
            border-radius: 999px;
            animation: splash-loading 2s ease forwards;
        }

        @keyframes splash-loading {
            from { width: 0%; }
            to   { width: 100%; }
        }
    </style>
</head>
<body class="splash-body">

<div class="splash-container">
    <div class="splash-logo">🎲</div>
    <h1 class="splash-title">Aji Nl3bo Cafe</h1>
    <p class="splash-subtitle">Expo</p>
    <div class="splash-loader">
        <div class="splash-loader-bar"></div>
    </div>
</div>

<script>
    setTimeout(() => {
        <?php if (isset($_SESSION['user_id'])) : ?>
            window.location.href = "<?= $_SESSION['user_role'] === 'admin' ? 'dashboard/admin' : 'dashboard/client' ?>";
        <?php else : ?>
            window.location.href = "login";
        <?php endif; ?>
    }, 2000);
</script>

</body>
</html>