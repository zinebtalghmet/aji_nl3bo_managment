<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aji L3bo Cafe</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/public/css/style.css">
</head>
<body>
<header>
    <nav>
        <a href="/splash" class="logo">🎲 Aji L3bo Cafe</a>
        <ul>
            <?php if (isset($_SESSION['user_id'])) : ?>
                <li><a href="<?= $_SESSION['user_role'] === 'admin' ? '/dashboard/admin' : '/dashboard/client' ?>">🏠 Dashboard</a></li>
                <li><a href="/logout">🔓 Déconnexion (<?= htmlspecialchars($_SESSION['user_name']) ?>)</a></li>
            <?php else : ?>
                <li><a href="login">🔐 Connexion</a></li>
                <li><a href="register">📝 Inscription</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>
<main>