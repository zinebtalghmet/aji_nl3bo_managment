<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <title>Dashboard Client</title>
</head>
<body>
    <h1>Bienvenue <?= htmlspecialchars($_SESSION['user_name']) ?></h1>
    <a href="<?= BASE_URL ?>/logout">Déconnexion</a>

    <hr>

    <h2>Catégories</h2>
    <ul>
        <?php foreach ($categories as $category): ?>
            <li><?= htmlspecialchars($category['name']) ?></li>
        <?php endforeach; ?>
    </ul>

    <hr>

    <h2>Nos Jeux 🎮</h2>
    <table border="1" cellpadding="10">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Catégorie</th>
                <th>Durée</th>
                <th>Difficulté</th>
                <th>Statut</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($games as $game): ?>
                <tr>
                    <td><?= htmlspecialchars($game['name']) ?></td>
                    <td><?= htmlspecialchars($game['category'] ?? 'Aucune') ?></td>
                    <td><?= $game['duration'] ?> min</td>
                    <td><?= htmlspecialchars($game['difficulty']) ?></td>
                    <td><?= htmlspecialchars($game['status']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
