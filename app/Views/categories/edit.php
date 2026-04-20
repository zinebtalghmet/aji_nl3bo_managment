<?php include __DIR__ . '/../includes/header.php'; ?>

<div class="auth-wrapper">
<div class="auth-container">

    <h2>✏️ Modifier — <?= htmlspecialchars($category['name']) ?></h2>

    <form action="<?= BASE_URL ?>/categories/update/<?= $category['id'] ?>" method="POST">
        <div class="form-group">
            <label class="form-label">Nom de la catégorie</label>
            <input type="text" name="name" class="form-input"
                   value="<?= htmlspecialchars($category['name']) ?>" required>
        </div>
        <button type="submit" class="btn btn-warning btn-full">✏️ Enregistrer</button>
        <p class="auth-link"><a href="<?= BASE_URL ?>/categories">Annuler</a></p>
    </form>

</div>
</div>

<?php include __DIR__ . '/../includes/footer.php'; ?>