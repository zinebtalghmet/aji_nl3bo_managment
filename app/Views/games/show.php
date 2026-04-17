<?php include __DIR__ . '/../includes/header.php'; ?>

<div class="dashboard-container">

    <!-- RETOUR -->
    <div style="margin-bottom: 20px;">
        <a href="<?= BASE_URL ?>/games" style="
            color: var(--text-secondary);
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        ">← Retour aux jeux</a>
    </div>

    <div style="
        background: white;
        border-radius: var(--radius-xl);
        border: 1px solid var(--border);
        box-shadow: var(--shadow-md);
        overflow: hidden;
        max-width: 700px;
        margin: 0 auto;
    ">
        <!-- HEADER CARTE -->
        <div style="
            background: linear-gradient(135deg, #4f46e5, #7c3aed);
            padding: 24px 28px;
        ">
            <span style="
                color: rgba(255,255,255,0.8);
                font-size: 13px;
                font-weight: 500;
            "><?= htmlspecialchars($game['category'] ?? 'Sans catégorie') ?></span>
            <h1 style="
                color: white;
                font-size: 26px;
                font-weight: 700;
                margin-top: 6px;
            ">🎲 <?= htmlspecialchars($game['name']) ?></h1>
        </div>

        <!-- CORPS -->
        <div style="padding: 28px;">

            <!-- STATUT -->
            <div style="margin-bottom: 24px;">
                <?php if ($game['status'] === 'disponible'): ?>
                    <span style="
                        background: #d1fae5; color: #065f46;
                        padding: 6px 16px; border-radius: 999px;
                        font-size: 13px; font-weight: 600;
                    ">🟢 Disponible</span>
                <?php else: ?>
                    <span style="
                        background: #fee2e2; color: #991b1b;
                        padding: 6px 16px; border-radius: 999px;
                        font-size: 13px; font-weight: 600;
                    ">🔴 En cours d'utilisation</span>
                <?php endif; ?>
            </div>

            <!-- DESCRIPTION -->
            <div style="margin-bottom: 24px;">
                <p style="font-size: 12px; font-weight: 600; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 8px;">Description</p>
                <div style="
                    background: var(--bg-content);
                    border: 1px solid var(--border);
                    border-radius: var(--radius-md);
                    padding: 16px;
                ">
                    <p style="font-size: 15px; color: var(--text-secondary); line-height: 1.7;">
                        <?= htmlspecialchars($game['description'] ?? 'Aucune description disponible.') ?>
                    </p>
                </div>
            </div>

            <!-- INFOS EN GRILLE -->
            <div style="
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 16px;
                margin-bottom: 28px;
            ">
                <div style="background: var(--bg-content); border: 1px solid var(--border); border-radius: var(--radius-md); padding: 16px;">
                    <p style="font-size: 12px; color: var(--text-muted); font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 6px;">Durée</p>
                    <p style="font-size: 20px; font-weight: 700; color: var(--text-primary);">⏱ <?= $game['duration'] ?> min</p>
                </div>

                <div style="background: var(--bg-content); border: 1px solid var(--border); border-radius: var(--radius-md); padding: 16px;">
                    <p style="font-size: 12px; color: var(--text-muted); font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 6px;">Difficulté</p>
                    <p style="font-size: 20px; font-weight: 700; color: var(--text-primary);">🎯 <?= htmlspecialchars($game['difficulty']) ?></p>
                </div>
            </div>

            <!-- BOUTONS -->
            <div style="display: flex; gap: 12px; justify-content: flex-end;">
                <a href="<?= BASE_URL ?>/games" style="
                    padding: 10px 20px;
                    border: 1px solid var(--border);
                    border-radius: var(--radius-md);
                    text-decoration: none;
                    color: var(--text-secondary);
                    font-size: 14px;
                    font-weight: 500;
                ">← Retour</a>

                <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin'): ?>
                    <a href="<?= BASE_URL ?>/games/edit/<?= $game['id'] ?>" style="
                        padding: 10px 20px;
                        background: #f59e0b;
                        color: white;
                        border-radius: var(--radius-md);
                        text-decoration: none;
                        font-size: 14px;
                        font-weight: 600;
                    ">✏️ Modifier</a>
                <?php endif; ?>
            </div>

        </div>
    </div>

</div>

<?php include __DIR__ . '/../includes/footer.php'; ?>