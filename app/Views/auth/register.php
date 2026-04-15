<?php include __DIR__ . '/../includes/header.php'; ?>

<div class="auth-wrapper">
    <div class="auth-container">
        <h2>📝 Créer un compte</h2>
        <form method="POST" action="register">
           <div class="form-group">
                <input type="text" name="name" placeholder="Nom complet" required>
            </div>
            <div class="form-group">
                <input type="email" name="email" placeholder="Email" required>
            </div>
            <div class="form-group">
                <input type="password" name="password" placeholder="Mot de passe" required>
            </div>
            <div class="form-group">
                <input type="password" name="password_confirm" placeholder="Confirmer mot de passe" required>
            </div>
            <button type="submit">S'inscrire</button>
        </form>
        <p class="auth-link">Déjà inscrit ? <a href="/login">Se connecter</a></p>
    </div>
</div>

<?php include __DIR__ . '/../includes/footer.php'; ?>