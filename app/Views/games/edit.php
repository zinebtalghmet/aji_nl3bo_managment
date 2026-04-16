<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier le jeu</title>
</head>
<body>
    <h1>Modifier le jeu ✏️</h1>

    <form action="<?= BASE_URL ?>/games/update/<?= $game['id'] ?>" method="POST">
        <label>Nom:</label>
        <input type="text" name="name" value="<?= $game['name'] ?>" required><br><br>

        <label>Catégorie:</label>
        <select name="category_id" required>
            <option value="">-- Choisir --</option>
            <?php foreach ($categories as $category): ?>
                <option value="<?= $category['id'] ?>"
                    <?= $category['id'] == $game['category_id'] ? 'selected' : '' ?>>
                    <?= $category['name'] ?>
                </option>
            <?php endforeach; ?>
        </select><br><br>

        <label>Durée (min):</label>
        <input type="number" name="duration" value="<?= $game['duration'] ?>" required><br><br>

        <label>Description:</label>
        <textarea name="description"><?= $game['description'] ?></textarea><br><br>

        <label>Difficulté:</label>
        <select name="difficulty" required>
            <option value="facile" <?= $game['difficulty'] == 'facile' ? 'selected' : '' ?>>Facile</option>
            <option value="moyen" <?= $game['difficulty'] == 'moyen' ? 'selected' : '' ?>>Moyen</option>
            <option value="difficile" <?= $game['difficulty'] == 'difficile' ? 'selected' : '' ?>>Difficile</option>
            <option value="expert" <?= $game['difficulty'] == 'expert' ? 'selected' : '' ?>>Expert</option>
        </select><br><br>

        <label>Statut:</label>
        <select name="status" required>
            <option value="disponible" <?= $game['status'] == 'disponible' ? 'selected' : '' ?>>Disponible</option>
            <option value="en_cours" <?= $game['status'] == 'en_cours' ? 'selected' : '' ?>>En cours</option>
            <option value="maintenance" <?= $game['status'] == 'maintenance' ? 'selected' : '' ?>>Maintenance</option>
        </select><br><br>

        <button type="submit">Enregistrer</button>
        <a href="<?= BASE_URL ?>/games">Annuler</a>
    </form>
</body>
</html>
