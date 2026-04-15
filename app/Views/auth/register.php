<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription — Aji L3bo</title>
    <link rel="stylesheet" href="/public/css/style.css">
</head>
<body class="auth-body">

<div class="auth-container">
    <div class="auth-card">

        <div class="auth-header">
            <a href="/splash" class="back-link">← Retour</a>
            <h2>Créer un compte</h2>
            <p>Rejoignez Aji L3bo Café !</p>
        </div>

        <?php if (!empty($errors)): ?>
            <div class="alert alert-error">
                <?php foreach ($errors as $error): ?>
                    <p><?= htmlspecialchars($error) ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <form action="/register" method="POST" class="auth-form">

            <div class="form-group">
                <label for="name">Nom complet</label>
                <input
                    type="text"
                    id="name"
                    name="name"
                    value="<?= htmlspecialchars($_POST['name'] ?? '') ?>"
                    placeholder="Hassan Alami"
                    required
                    autofocus
                >
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    value="<?= htmlspecialchars($_POST['email'] ?? '') ?>"
                    placeholder="votre@email.com"
                    required
                >
            </div>

            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="minimum 6 caractères"
                    required
                >
            </div>

            <div class="form-group">
                <label for="password_confirm">Confirmer le mot de passe</label>
                <input
                    type="password"
                    id="password_confirm"
                    name="password_confirm"
                    placeholder="••••••••"
                    required
                >
            </div>

            <button type="submit" class="btn btn-primary btn-full">
                Créer mon compte
            </button>

        </form>

        <p class="auth-link">
            Déjà un compte ?
            <a href="/login">Se connecter</a>
        </p>

    </div>
</div>

</body>
</html>