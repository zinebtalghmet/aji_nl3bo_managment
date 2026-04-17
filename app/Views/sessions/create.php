<?php require_once __DIR__ . '/../includes/header.php'; ?>

<div class="auth-wrapper">
    <div class="auth-container">
        <h2>🕹️ Démarrer une session</h2>

        <?php if (!empty($errors)): ?>
            <div class="alert-error">
                <?php foreach ($errors as $error): ?>
                    <p><?= htmlspecialchars($error) ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <form action="<?= BASE_URL ?>/admin/sessions" method="POST">

            <div class="form-group">
                <label class="form-label">👤 Client</label>
                <select name="user_id" class="form-input" required>
                    <option value="">-- Choisir un client --</option>
                    <?php foreach ($users as $u): ?>
                        <option value="<?= $u['id'] ?>">
                            <?= htmlspecialchars($u['name']) ?> — <?= htmlspecialchars($u['email']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label class="form-label">🎲 Jeu</label>
                <select name="game_id" class="form-input" required>
                    <option value="">-- Choisir un jeu --</option>
                    <?php foreach ($games as $g): ?>
                        <option value="<?= $g['id'] ?>">
                            <?= htmlspecialchars($g['name']) ?> — <?= $g['duration'] ?> min
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label class="form-label">🍽️ Table</label>
                <select name="table_id" class="form-input" required>
                    <option value="">-- Choisir une table --</option>
                    <?php foreach ($tables as $t): ?>
                        <option value="<?= $t['id'] ?>">
                            Table <?= $t['id'] ?> — <?= $t['capacity'] ?> places
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center;">
                ▶️ Démarrer la session
            </button>

            <p class="auth-link">
                <a href="<?= BASE_URL ?>/admin/sessions">← Retour aux sessions</a>
            </p>
        </form>
    </div>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
