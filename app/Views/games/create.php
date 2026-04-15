<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un jeu</title>
</head>
<body>
    <h1>Ajouter un jeu</h1>
    <form action= "/games/store" method = "POST">
        <label>Nom:</label>
        <input type="text" name="name" required><br><br>

        <label>Catégorie:</label>
        <select name="category_id" required>
            <option value = "">- Choisir une catégorie -</option>
            <?php foreach ($categories as $category): ?>
                <option value="<?=$category['id']?>">
                    <?= $category['name']?>
            </option>
            <?php endforeach; ?>        
            </select><br><br>

        <label>Durée (min):</label>
        <input type="number" name="duration" required><br><br>

        <label>Description:</label>
        <textarea name="description"></textarea><br><br>

        <label>Difficulté:</label>
        <select name="difficulty">
            <option value="facile">Facile</option>
            <option value="moyen">Moyen</option>
            <option value="difficile">Difficile</option>
            <option value="expert">Expert</option>
        </select><br><br>

        <label>Statut:</label>
        <select name="status" required>
            <option value="">-- Choisir un statut --</option>
            <option value="disponible">Disponible</option>
            <option value="en_cours">En cours</option>
            <option value="maintenance">Maintenance</option>
        </select><br><br>

        <button type="submit">Ajouter</button>
        <a href="/games">Annuler</a>
    </form>

    
</body>
</html>