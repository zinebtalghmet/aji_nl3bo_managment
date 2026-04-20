<?php include __DIR__ . '/../includes/header.php'; ?>

<div class="dashboard-container">

    <div class="dashboard-header">
        <div>
            <h1 class="dashboard-title">🏷️ Catégories</h1>
            <p class="dashboard-subtitle">Gérez les catégories de jeux</p>
        </div>
        <a href="<?= BASE_URL ?>/categories/create" class="btn btn-primary">+ Nouvelle catégorie</a>
    </div>

    <div class="card">
        <div class="card-header"><span class="card-title">Liste des catégories</span></div>
        <?php if (!empty($categories)): ?>
        <table class="data-table">
            <thead><tr><th>#</th><th>Nom</th><th>Actions</th></tr></thead>
            <tbody>
            <?php foreach ($categories as $cat): ?>
                <tr>
                    <td><?= $cat['id'] ?></td>
                    <td><span class="badge badge-purple"><?= htmlspecialchars($cat['name']) ?></span></td>
                    <td style="display:flex;gap:8px;">
                        <a href="<?= BASE_URL ?>/categories/edit/<?= $cat['id'] ?>"    class="btn btn-ghost btn-sm">✏️ Modifier</a>
                        <a href="<?= BASE_URL ?>/categories/destroy/<?= $cat['id'] ?>" class="btn btn-danger btn-sm"
                           onclick="return confirm('Supprimer ?')">🗑️ Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <?php else: ?>
            <div class="empty-state">
                <div class="empty-icon">📂</div>
                <div class="empty-title">Aucune catégorie</div>
                <a href="<?= BASE_URL ?>/categories/create" class="btn btn-primary" style="margin-top:16px;">Créer une catégorie</a>
            </div>
        <?php endif; ?>
    </div>

</div>

<?php include __DIR__ . '/../includes/footer.php'; ?>