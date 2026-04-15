<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Aji L3bo Cafe</title>
    <link rel="stylesheet" href="/public/css/style.css">
</head>
<body class="splash-body">
    <div class="splash-container">
        <div class="splash-logo">🎲</div>
        <h1 class="splash-title">Aji L3bo Cafe</h1>
        <div class="splash-loader"><div class="splash-loader-bar"></div></div>
    </div>
    <script>
    setTimeout(() => {
        <?php if (isset($_SESSION['user_id'])) : ?>
            // On enlève le / pour rester dans le sous-dossier du projet
            window.location.href = "<?= $_SESSION['user_role'] === 'admin' ? 'dashboard/admin' : 'dashboard/client' ?>";
        <?php else : ?>
            window.location.href = "login"; // "login" au lieu de "/login"
        <?php endif; ?>
    }, 2000);
</script>
</body>
</html>