<?php include __DIR__ . '/../includes/header.php'; ?>

<main>
    <div class="dashboard-container">

        <!-- Header -->
        <div class="dashboard-header">
            <h1 class="dashboard-title">📅 Liste des Réservations</h1>
            <p class="dashboard-subtitle">Gérez toutes vos réservations en un coup d'œil.</p>
        </div>

       

        <div class="card">
            <div class="card-header">
                <span class="card-title">📋 Réservations</span>
            </div>

            <?php if (!empty($reservations)) : ?>
            <table class="data-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Client</th>
                        <th>Téléphone</th>
                        <th>Table</th>
                        <th>Date & Heure</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($reservations as $reservation): ?>
                    <tr>
                        <td><?= htmlspecialchars($reservation['id']) ?></td>
                        <td><strong><?= htmlspecialchars($reservation['client_name']) ?></strong></td>
                        <td><?= htmlspecialchars($reservation['client_phone']) ?></td>
                        <td>
                            Table <?= htmlspecialchars($reservation['table_number']) ?>
                            <span class="badge badge-gray"><?= htmlspecialchars($reservation['capacity']) ?> pers.</span>
                        </td>
                        <td><?= htmlspecialchars($reservation['reserved_at']) ?></td>
                        <td>
                            <?php
                                $status = $reservation['status'];
                                $badgeClass = match($status) {
                                    'confirmed' => 'badge-green',
                                    'pending'   => 'badge-pending',
                                    'cancelled' => 'badge-gray',
                                    default     => 'badge-pending',
                                };
                                $statusLabel = match($status) {
                                    'confirmed' => '✅ Confirmée',
                                    'pending'   => '⏳ En attente',
                                    'cancelled' => '❌ Annulée',
                                    default     => $status,
                                };
                            ?>
                            <span class="badge <?= $badgeClass ?>"><?= $statusLabel ?></span>
                        </td>
                        <td style="display: flex; gap: 8px; align-items: center;">
                            <a href="<?= BASE_URL ?>/reservations/edit/<?= $reservation['id'] ?>"
                               class="btn btn-ghost" style="padding: 6px 12px; font-size: 12px;">
                                ✏️ Modifier
                            </a>
                            <a href="<?= BASE_URL ?>/reservations/delete/<?= $reservation['id'] ?>"
                               class="btn btn-danger" style="padding: 6px 12px; font-size: 12px;"
                               onclick="return confirm('Annuler cette réservation ?')">
                                🗑️ Annuler
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <?php else : ?>
            <div class="empty-state">
                <div class="empty-icon">📭</div>
                <div class="empty-title">Aucune réservation trouvée</div>
                
            </div>
            <?php endif; ?>
        </div>

    </div>
</main>

<?php include __DIR__ . '/../includes/footer.php'; ?>