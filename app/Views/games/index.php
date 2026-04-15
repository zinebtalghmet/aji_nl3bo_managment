<?php
require_once __DIR__ . '/vendor/autoload.php';
use App\Controllers\GameController;
$controller = new GameController();
$controller->index();

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <title>Aji Nl3bo</title>
</head>
<body>
        <h1>Liste des jeux </h1>
    <a href="/games/create">➕ Ajouter un jeu</a>
    <table>        
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
                    <td><?= $game['id']?></td>
                    <td><?= $game['name']?></td>
                    <td><?= $game['category']?></td>
                    <td><?= $game['duration']?></td>
                    <td><?= $game['difficulty']?></td>
                    <td><?= $game['status']?></td>

                    <td>
                        <a href="/games/show/<?= $game['id']?>"><i class="fa-solid fa-eye"></i></a>
                        <a href="/games/edit/<?= $game['id']?>"><i class="fa-solid fa-pen"></i></a>
                        <a href="/games/delete/<?= $game['id']?>"><i class="fa-solid fa-trash"></i></a>
            </td>
            </tr>
            <?php endforeach; ?>   
            </tbody>
            </table>
            </body>
            </html>                