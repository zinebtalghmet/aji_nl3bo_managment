<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une catégorie</title>
</head>
<body>
    <h1>Ajouter une catégorie</h1>

    <form action="<?= BASE_URL ?>/categories/store" method="POST">
        <label>Nom:</label>
        <input type="text" name="name" required><br><br>

        <button type="submit">Ajouter</button>
        <a href="<?= BASE_URL ?>/categories">Annuler</a>
    </form>
</body>
</html>
