<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer une Réservation</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/public/css/style.css">
</head>
<body>

<?php include __DIR__ . '/../includes/header.php'; ?>

<main>
    <div class="dashboard-container">

        <!-- Header -->
        <div class="dashboard-header">
            <h1 class="dashboard-title">➕ Nouvelle Réservation</h1>
            <p class="dashboard-subtitle">Remplissez les informations pour créer une réservation.</p>
        </div>

        <!-- Formulaire -->
        <div class="card" style="max-width: 600px;">
            <div class="card-header">
                <span class="card-title">📋 Informations de réservation</span>
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
                        <input type="text" name="client_name" class="form-input"
                               placeholder="Ex : Mohammed Amine" required
                               value="<?= htmlspecialchars($_POST['client_name'] ?? '') ?>">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Téléphone</label>
                        <input type="text" name="client_phone" class="form-input"
                               placeholder="Ex : 0612345678" required
                               value="<?= htmlspecialchars($_POST['client_phone'] ?? '') ?>">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Nombre de personnes</label>
                        <input type="number" name="number_of_people" class="form-input"
                               min="1" placeholder="Ex : 4" required
                               value="<?= htmlspecialchars($_POST['number_of_people'] ?? '') ?>">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Table</label>
                        <select name="table_id" class="form-input" required>
                            <option value="">-- Sélectionner une table --</option>
                            <?php foreach ($tables as $table): ?>
                                <option value="<?= $table['id'] ?>"
                                    <?= (isset($_POST['table_id']) && $_POST['table_id'] == $table['id']) ? 'selected' : '' ?>>
                                    Table <?= htmlspecialchars($table['number']) ?>
                                    (Capacité : <?= htmlspecialchars($table['capacity']) ?> pers.)
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Date et Heure</label>
                        <input type="datetime-local" name="reserved_at" class="form-input" required
                               value="<?= htmlspecialchars($_POST['reserved_at'] ?? '') ?>">
                    </div>

                    <div style="display: flex; gap: 12px; margin-top: 8px;">
                        <button type="submit" class="btn btn-primary" style="flex: 1; justify-content: center;">
                            ✅ Confirmer la réservation
                        </button>
                        <a href="<?= BASE_URL ?>/dashboard/client" class="btn btn-ghost">
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