<?php include __DIR__ . '/../includes/header.php'; ?>

<div class="auth-wrapper">
    <div class="auth-container">

        <h2>📝 Créer un compte</h2>

        <?php if (!empty($errors)) : ?>
            <div class="errors">
                <?php foreach ($errors as $error) : ?>
                    <p>⚠️ <?= htmlspecialchars($error) ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="/aji_nl3bo_managment/register">

            <div class="form-group">
                <input
                    type="text"
                    name="name"
                    placeholder="Nom complet"
                    value="<?= htmlspecialchars($_POST['name'] ?? '') ?>"
                    required
                    autocomplete="name"
                >
            </div>

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
                    placeholder="Mot de passe (min. 6 caractères)"
                    required
                    autocomplete="new-password"
                >
            </div>

            <div class="form-group">
                <input
                    type="password"
                    name="password_confirm"
                    placeholder="Confirmer le mot de passe"
                    required
                    autocomplete="new-password"
                >
            </div>

            <button type="submit">Créer mon compte</button>

        </form>

        <p class="auth-link">
            Déjà inscrit ?
            <a href="/aji_nl3bo_managment/login">Se connecter</a>
        </p>

    </div>
</div>

<?php include __DIR__ . '/../includes/footer.php'; ?>