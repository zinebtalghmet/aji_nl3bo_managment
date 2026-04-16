<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier la catégorie</title>
</head>
<body>
    <h1>Modifier la catégorie</h1>

    <form action="<?= BASE_URL ?>/categories/update/<?= $category['id'] ?>" method="POST">
        <label>Nom:</label>
        <input type="text" name="name" value="<?= $category['name'] ?>" required><br><br>

        <button type="submit">Enregistrer</button>
        <a href="<?= BASE_URL ?>/categories">Annuler</a>
    </form>
</body>
</html>
