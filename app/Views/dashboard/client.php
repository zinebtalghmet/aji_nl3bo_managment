<?php include __DIR__ . '/../includes/header.php'; ?>

<main>
    <div class="dashboard-container">

        <!-- Header -->
        <div class="dashboard-header">
            <h1 class="dashboard-title">🏠 Dashboard Client</h1>
            <p class="dashboard-subtitle">
                Bienvenue, <strong><?= htmlspecialchars($_SESSION['user_name']) ?></strong> 👋
            </p>
        </div>

        <!-- Stat Cards -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-title">Mes Réservations</div>
                <div class="stat-value"><?= $totalReservations ?? 0 ?></div>
            </div>
            <div class="stat-card">
                <div class="stat-title">Confirmées</div>
                <div class="stat-value"><?= $confirmedCount ?? 0 ?></div>
            </div>
            <div class="stat-card">
                <div class="stat-title">En Attente</div>
                <div class="stat-value"><?= $pendingCount ?? 0 ?></div>
            </div>
            <div class="stat-card">
                <div class="stat-title">Annulées</div>
                <div class="stat-value"><?= $cancelledCount ?? 0 ?></div>
            </div>
        </div>

        <!-- Actions rapides -->
        <div class="card">
            <div class="card-header">
                <span class="card-title">⚡ Actions rapides</span>
            </div>
            <div style="padding: 24px; display: flex; gap: 12px; flex-wrap: wrap;">
                <a href="<?= BASE_URL ?>/reservations" class="btn btn-primary">
                    📅 Voir mes réservations
                </a>
                <a href="<?= BASE_URL ?>/reservations/create" class="btn btn-ghost">
                    ➕ Nouvelle réservation
                </a>
                <a href="<?= BASE_URL ?>/logout" class="btn btn-danger">
                    🔓 Déconnexion
                </a>
            </div>
        </div>

    </div>
</main>

<?php include __DIR__ . '/../includes/footer.php'; ?>