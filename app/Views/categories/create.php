<?php include __DIR__ . '/../includes/header.php'; ?>

<div class="auth-wrapper">
<div class="auth-container">

    <h2>➕ Ajouter une catégorie</h2>

    <form action="<?= BASE_URL ?>/categories/store" method="POST">
        <div class="form-group">
            <label class="form-label">Nom de la catégorie</label>
            <input type="text" name="name" class="form-input"
                   placeholder="Ex: Stratégie, Famille, Ambiance..." required>
        </div>
        <button type="submit" class="btn btn-primary btn-full">➕ Ajouter</button>
        <p class="auth-link"><a href="<?= BASE_URL ?>/dashboard/admin">Retour au dashboard</a></p>
    </form>

</div>
</div>

<?php include __DIR__ . '/../includes/footer.php'; ?>