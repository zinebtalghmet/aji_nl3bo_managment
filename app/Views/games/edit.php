<?php include __DIR__ . '/../includes/header.php'; ?>

<div class="auth-wrapper">
<div class="auth-container" style="max-width:560px;">

    <h2>✏️ Modifier — <?= htmlspecialchars($game['name']) ?></h2>

    <form action="<?= BASE_URL ?>/games/update/<?= $game['id'] ?>" method="POST">
        <div class="form-group">
            <label class="form-label">Nom du jeu</label>
            <input type="text" name="name" class="form-input" value="<?= htmlspecialchars($game['name']) ?>" required>
        </div>
        <div class="form-group">
            <label class="form-label">Catégorie</label>
            <select name="category_id" class="form-input" required>
                <option value="">— Choisir —</option>
                <?php foreach ($categories as $cat): ?>
                    <option value="<?= $cat['id'] ?>" <?= $cat['id'] == $game['category_id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($cat['name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label class="form-label">Durée (minutes)</label>
            <input type="number" name="duration" class="form-input" value="<?= $game['duration'] ?>" min="1" required>
        </div>
        <div class="form-group">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-input"><?= htmlspecialchars($game['description'] ?? '') ?></textarea>
        </div>
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
            <div class="form-group">
                <label class="form-label">Difficulté</label>
                <select name="difficulty" class="form-input" required>
                    <option value="facile"    <?= $game['difficulty']=='facile'    ? 'selected':'' ?>>😊 Facile</option>
                    <option value="moyen"     <?= $game['difficulty']=='moyen'     ? 'selected':'' ?>>🎯 Moyen</option>
                    <option value="difficile" <?= $game['difficulty']=='difficile' ? 'selected':'' ?>>🔥 Difficile</option>
                    <option value="expert"    <?= $game['difficulty']=='expert'    ? 'selected':'' ?>>💀 Expert</option>
                </select>
            </div>
            <div class="form-group">
                <label class="form-label">Statut</label>
                <select name="status" class="form-input" required>
                    <option value="disponible"  <?= $game['status']=='disponible'  ? 'selected':'' ?>>🟢 Disponible</option>
                    <option value="en_cours"    <?= $game['status']=='en_cours'    ? 'selected':'' ?>>🔴 En cours</option>
                    <option value="maintenance" <?= $game['status']=='maintenance' ? 'selected':'' ?>>🔧 Maintenance</option>
                </select>
            </div>
        </div>
        <button type="submit" class="btn btn-warning btn-full">✏️ Enregistrer</button>
        <p class="auth-link"><a href="<?= BASE_URL ?>/games">Annuler</a></p>
    </form>

</div>
</div>

<?php include __DIR__ . '/../includes/footer.php'; ?>