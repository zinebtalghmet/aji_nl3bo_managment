<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <title>Dashboard Admin</title>
</head>
<body>
    <h1>Dashboard Admin - <?= htmlspecialchars($_SESSION['user_name']) ?></h1>
    <a href="<?= BASE_URL ?>/logout">Déconnexion</a>
    <span> | </span>
    <a href="<?= BASE_URL ?>/games/create">➕ Ajouter un jeu</a>
    <span> | </span>
    <a href="<?= BASE_URL ?>/categories/create">➕ Ajouter une catégorie</a>

    <hr>

    <h2>Catégories</h2>
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
                    <td><?= htmlspecialchars($category['name']) ?></td>
                    <td>
                        <a href="<?= BASE_URL ?>/categories/edit/<?= $category['id'] ?>"><i class="fa-solid fa-pen"></i></a>
                        <a href="<?= BASE_URL ?>/categories/destroy/<?= $category['id'] ?>"><i class="fa-solid fa-trash"></i></a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <hr>

    <h2>Jeux 🎮</h2>
    <table border="1" cellpadding="10">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Catégorie</th>
                <th>Durée</th>
                <th>Difficulté</th>
                <th>Statut</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($games as $game): ?>
                <tr>
                    <td><?= $game['id'] ?></td>
                    <td><?= htmlspecialchars($game['name']) ?></td>
                    <td><?= htmlspecialchars($game['category'] ?? 'Aucune') ?></td>
                    <td><?= $game['duration'] ?> min</td>
                    <td><?= htmlspecialchars($game['difficulty']) ?></td>
                    <td><?= htmlspecialchars($game['status']) ?></td>
                    <td>
                        <a href="<?= BASE_URL ?>/games/show/<?= $game['id'] ?>"><i class="fa-solid fa-eye"></i></a>
                        <a href="<?= BASE_URL ?>/games/edit/<?= $game['id'] ?>"><i class="fa-solid fa-pen"></i></a>
                        <a href="<?= BASE_URL ?>/games/destroy/<?= $game['id'] ?>"><i class="fa-solid fa-trash"></i></a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
