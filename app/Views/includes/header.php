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
    <title>Aji L3bo Cafe</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="/aji_nl3bo_managment/public/css/style.css">
</head>
<body>

<header>
    <nav>

        <!-- LOGO -->
        <a href="/aji_nl3bo_managment/splash" class="logo">
            🎲 Aji L3bo Cafe
        </a>

        <!-- LIENS -->
        <ul>
            <?php if (isset($_SESSION['user_id'])) : ?>

                <?php if ($_SESSION['user_role'] === 'admin') : ?>
                    <li><a href="/aji_nl3bo_managment/dashboard/admin" class="admin-link">⚙️ Dashboard Admin</a></li>
                <?php else : ?>
                    <li><a href="/aji_nl3bo_managment/dashboard/client">🏠 Dashboard</a></li>
                <?php endif; ?>

                <li>
                    <a href="/aji_nl3bo_managment/logout">
                        🔓 Déconnexion (<?= htmlspecialchars($_SESSION['user_name']) ?>)
                    </a>
                </li>

            <?php else : ?>
                <li><a href="/aji_nl3bo_managment/login">🔐 Connexion</a></li>
                <li><a href="/aji_nl3bo_managment/register">📝 Inscription</a></li>
            <?php endif; ?>
        </ul>

    </nav>
</header>

<main>
