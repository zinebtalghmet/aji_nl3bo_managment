<?php include __DIR__ . '/../includes/header.php'; ?>

<div class="auth-wrapper">
    <div class="auth-container">

        <h2>🔐 Connexion</h2>

        <?php if (!empty($errors)) : ?>
            <?php foreach ($errors as $e) : ?>
                <div class="alert-error">⚠️ <?= htmlspecialchars($e) ?></div>
            <?php endforeach; ?>
        <?php endif; ?>

        <form method="POST" action="/aji_nl3bo_managment/login">

            <div class="form-group">
                <input
                    type="email"
                    name="email"
                    placeholder="Adresse email"
                    value="<?= htmlspecialchars($_POST['email'] ?? '') ?>"
                    required
                    autocomplete="email"
                >
            </div>

            <div class="form-group">
                <input
                    type="password"
                    name="password"
                    placeholder="Mot de passe"
                    required
                    autocomplete="current-password"
                >
            </div>

            <button type="submit">Se connecter</button>

        </form>

        <p class="auth-link">
            Pas encore de compte ?
            <a href="/aji_nl3bo_managment/register">S'inscrire</a>
        </p>

    </div>
</div>

<?php include __DIR__ . '/../includes/footer.php'; ?>