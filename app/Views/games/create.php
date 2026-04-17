<?php include __DIR__ . '/../includes/header.php'; ?>

<div class="auth-wrapper">
    <div class="auth-container">
        <h2>Ajouter un jeu</h2>

        <form action="<?= BASE_URL ?>/games/store" method="POST">
            <div class="form-group">
                <label class="form-label">Nom du jeu</label>
                <input type="text" name="name" class="form-input" placeholder="Ex: FIFA 2026" required>
            </div>

            <div class="form-group">
                <label class="form-label">Catégorie</label>
                <select name="category_id" class="form-input" required>
                    <option value="">-- Choisir une catégorie --</option>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label class="form-label">Durée (minutes)</label>
                <input type="number" name="duration" class="form-input" placeholder="Ex: 30" required>
            </div>

            <div class="form-group">
                <label class="form-label">Description</label>
                <textarea name="description" class="form-input" rows="3" placeholder="Description du jeu..."></textarea>
            </div>

            <div class="form-group">
                <label class="form-label">Difficulté</label>
                <select name="difficulty" class="form-input" required>
                    <option value="">-- Choisir --</option>
                    <option value="facile">Facile</option>
                    <option value="moyen">Moyen</option>
                    <option value="difficile">Difficile</option>
                    <option value="expert">Expert</option>
                </select>
            </div>

            <div class="form-group">
                <label class="form-label">Statut</label>
                <select name="status" class="form-input" required>
                    <option value="">-- Choisir --</option>
                    <option value="disponible">Disponible</option>
                    <option value="en_cours">En cours</option>
                    <option value="maintenance">Maintenance</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary" style="width:100%; justify-content:center;">Ajouter le jeu</button>

            <p class="auth-link">
                <a href="<?= BASE_URL ?>/dashboard/admin">Retour au dashboard</a>
            </p>
        </form>
    </div>
</div>

<?php include __DIR__ . '/../includes/footer.php'; ?>
