<?php include __DIR__ . '/../includes/header.php'; ?>

<h1>🏠 Dashboard Client</h1>

<p>Bienvenue <?= htmlspecialchars($_SESSION['user_name']) ?> 👋</p>

<hr>

<h3>Actions rapides</h3>

<ul>
    <li>
        <a href="<?= BASE_URL ?>/reservations">
            📅 Voir mes réservations
        </a>
    </li>

    <li>
        <a href="<?= BASE_URL ?>/reservations/create">
            ➕ Créer une réservation
        </a>
    </li>

    <li>
        <a href="<?= BASE_URL ?>/logout">
            🔓 Déconnexion
        </a>
    </li>
</ul>

<?php include __DIR__ . '/../includes/footer.php'; ?>