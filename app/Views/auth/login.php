<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion — Aji L3bo</title>
    <link rel="stylesheet" href="/public/css/style.css">
</head>
<body class="auth-body">

<div class="auth-container">
    <div class="auth-card">

        <div class="auth-header">
            <a href="/splash" class="back-link">← Retour</a>
            <h2>Connexion</h2>
            <p>Bienvenue sur Aji L3bo !</p>
        </div>

        <?php if (!empty($errors)): ?>
            <div class="alert alert-error">
                <?php foreach ($errors as $error): ?>
                    <p><?= htmlspecialchars($error) ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <form action="/login" method="POST" class="auth-form">

            <div class="form-group">
                <label for="email">Email</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    value="<?= htmlspecialchars($_POST['email'] ?? '') ?>"
                    placeholder="votre@email.com"
                    required
                    autofocus
                >
            </div>

            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="••••••••"
                    required
                >
            </div>

            <button type="submit" class="btn btn-primary btn-full">
                Se connecter
            </button>

        </form>

        <p class="auth-link">
            Pas encore de compte ?
            <a href="/register">Créer un compte</a>
        </p>

    </div>
</div>

</body>
</html>