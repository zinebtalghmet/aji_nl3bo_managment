<?php include __DIR__ . '/../includes/header.php'; ?>

<div class="auth-wrapper">
    <div class="auth-container">
        <h2>🔐 Connexion</h2>
        <div class="log-form">
            <?php if (!empty($errors)) : ?>
                <?php foreach($errors as $e): ?>
                    <div class="alert-error" style="color:red;"><?= htmlspecialchars($e) ?></div>
                <?php endforeach; ?>
            <?php endif; ?>

            <form method="POST" action="login">
                <div class="form-group">
                    <input type="email" name="email" placeholder="Email" required>
                </div>
                <div class="form-group">
                    <input type="password" name="password" placeholder="Mot de passe" required>
                </div>
                <button type="submit">Se connecter</button>
            </form>
            <p class="auth-link">Pas de compte ? <a href="register">S'inscrire</a></p>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../includes/footer.php'; ?>