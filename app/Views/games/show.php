<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Détails du jeu</title>
</head>
<body>
    <h1>Détails du jeu 🎮</h1>
    <p><strong>Nom:</strong> <?= $game['name'] ?></p>
    <p><strong>Catégorie:</strong> <?= $game['category'] ?? 'Aucune' ?></p>
    <p><strong>Durée:</strong> <?= $game['duration'] ?> min</p>
    <p><strong>Description:</strong> <?= $game['description'] ?? 'Aucune' ?></p>
    <p><strong>Difficulté:</strong> <?= $game['difficulty'] ?></p>
    <p><strong>Statut:</strong> <?= $game['status'] ?></p>

    <a href="<?= BASE_URL ?>/games/edit/<?= $game['id'] ?>"> Modifier</a>
    <a href="<?= BASE_URL ?>/games">⬅️ Retour</a>
</body>
</html>
