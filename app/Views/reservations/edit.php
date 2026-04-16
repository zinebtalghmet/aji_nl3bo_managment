<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier une Réservation</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/public/css/style.css">
</head>
<body>

<?php include __DIR__ . '/../includes/header.php'; ?>

<main>
    <div class="dashboard-container">

        <!-- Header -->
        <div class="dashboard-header">
            <h1 class="dashboard-title">✏️ Modifier la Réservation</h1>
            <p class="dashboard-subtitle">Modifiez les informations de la réservation #<?= htmlspecialchars($reservation['id']) ?>.</p>
        </div>

        <!-- Formulaire -->
        <div class="card" style="max-width: 600px;">
            <div class="card-header">
                <span class="card-title">📋 Informations</span>
                <?php
                    $status = $reservation['status'];
                    $badgeClass = match($status) {
                        'confirmed' => 'badge-green',
                        'pending'   => 'badge-pending',
                        'cancelled' => 'badge-gray',
                        default     => 'badge-gray',
                    };
                ?>
                <span class="badge <?= $badgeClass ?>">
                    <?= htmlspecialchars($reservation['status']) ?>
                </span>
            </div>
            <div style="padding: 28px;">

                <?php if (!empty($errors)): ?>
                <div class="errors">
                    <?php foreach ($errors as $error): ?>
                        <p>⚠️ <?= htmlspecialchars($error) ?></p>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>

                <form method="POST">

                    <div class="form-group">
                        <label class="form-label">Nom du client</label>
                        <input type="text" name="client_name" class="form-input" required
                               value="<?= htmlspecialchars($reservation['client_name']) ?>">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Téléphone</label>
                        <input type="text" name="client_phone" class="form-input" required
                               value="<?= htmlspecialchars($reservation['client_phone']) ?>">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Date et Heure</label>
                        <input type="datetime-local" name="reserved_at" class="form-input" required
                               value="<?= date('Y-m-d\TH:i', strtotime($reservation['reserved_at'])) ?>">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Statut</label>
                        <select name="status" class="form-input">
                            <option value="pending"
                                <?= $reservation['status'] === 'pending' ? 'selected' : '' ?>>
                                ⏳ En attente
                            </option>
                            <option value="confirmed"
                                <?= $reservation['status'] === 'confirmed' ? 'selected' : '' ?>>
                                ✅ Confirmée
                            </option>
                            <option value="cancelled"
                                <?= $reservation['status'] === 'cancelled' ? 'selected' : '' ?>>
                                ❌ Annulée
                            </option>
                        </select>
                    </div>

                    <div style="display: flex; gap: 12px; margin-top: 8px;">
                        <button type="submit" class="btn btn-primary" style="flex: 1; justify-content: center;">
                            💾 Mettre à jour
                        </button>
                        <a href="<?= BASE_URL ?>/reservations" class="btn btn-ghost">
                            ← Retour
                        </a>
                    </div>

                </form>
            </div>
        </div>

    </div>
</main>

<?php include __DIR__ . '/../includes/footer.php'; ?>
</body>
</html>