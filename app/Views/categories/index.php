<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <title>Catégories</title>
</head>
<body>
    <h1>Liste des catégories</h1>
    <a href="<?= BASE_URL ?>/categories/create">Ajouter une catégorie</a>

    <table border="1" cellpadding="10">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($categories as $category): ?>
                <tr>
                    <td><?= $category['id'] ?></td>
                    <td><?= $category['name'] ?></td>
                    <td>
                        <a href="<?= BASE_URL ?>/categories/edit/<?= $category['id'] ?>"><i class="fa-solid fa-pen"></i></a>
                        <a href="<?= BASE_URL ?>/categories/destroy/<?= $category['id'] ?>"><i class="fa-solid fa-trash"></i></a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
