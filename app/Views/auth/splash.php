<?php
// Rediriger si déjà connecté
if (isset($_SESSION['user_id'])) {
    $role = $_SESSION['user_role'];
    header('Location: /dashboard/' . $role);
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aji L3bo Café</title>
    <link rel="stylesheet" href="/public/css/style.css">
</head>
<body class="splash-body">

    <div class="splash-container">

        <div class="splash-logo">
            <h1 class="splash-title">🎲 Aji L3bo</h1>
            <p class="splash-subtitle">Café de jeux de société — Casablanca</p>
        </div>

        <div class="splash-buttons">
            <a href="/login" class="btn btn-primary btn-full">Se connecter</a>
            <a href="/register" class="btn btn-outline btn-full">Créer un compte</a>
        </div>

        <p class="splash-footer">
            Réservez votre table, choisissez votre jeu, jouez !
        </p>

    </div>

</body>
</html>