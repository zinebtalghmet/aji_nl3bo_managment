<?php require_once __DIR__ . '/../includes/header.php'; ?>

<div class="admin-container">

    <div class="page-header">
        <h2>🕹️ Démarrer une session</h2>
        <a href="/aji_nl3bo_managment/admin/sessions" class="btn btn-outline">
            ← Retour dashboard
        </a>
    </div>

    <?php if (!empty($errors)): ?>
        <div class="alert alert-error">
            <?php foreach ($errors as $error): ?>
                <p><?= htmlspecialchars($error) ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <form action="/aji_nl3bo_managment/admin/sessions" method="POST" class="session-form">

        <!-- RÉSERVATION -->
        <div class="form-group">
            <label for="reservation_id">📅 Réservation</label>
            <select name="reservation_id" id="reservation_id" required>
                <option value="">-- Choisir une réservation --</option>
                <?php foreach ($reservations as $r): ?>
                    <option value="<?= $r['id'] ?>"
                        <?= (($_POST['reservation_id'] ?? '') == $r['id']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($r['client_name']) ?> —
                        <?= $r['number_of_people'] ?> personnes —
                        <?= date('d/m/Y H:i', strtotime($r['reserved_at'])) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- JEU -->
        <div class="form-group">
            <label for="game_id">🎲 Jeu</label>
            <select name="game_id" id="game_id" required>
                <option value="">-- Choisir un jeu --</option>
                <?php foreach ($games as $g): ?>
                    <option value="<?= $g['id'] ?>"
                        <?= (($_POST['game_id'] ?? '') == $g['id']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($g['name']) ?> —
                        <?= $g['players_min'] ?>-<?= $g['players_max'] ?> joueurs
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- TABLE -->
        <div class="form-group">
            <label for="table_id">🍽️ Table</label>
            <select name="table_id" id="table_id" required>
                <option value="">-- Choisir une table --</option>
                <?php foreach ($tables as $t): ?>
                    <option value="<?= $t['id'] ?>"
                        <?= (($_POST['table_id'] ?? '') == $t['id']) ? 'selected' : '' ?>>
                        Table <?= htmlspecialchars($t['number']) ?> —
                        <?= $t['capacity'] ?> places
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <button type="submit" class="btn btn-primary btn-full">
            ▶️ Démarrer la session
        </button>

    </form>

</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>