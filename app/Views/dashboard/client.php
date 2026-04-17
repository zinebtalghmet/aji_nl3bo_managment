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

    

        <!-- Actions rapides -->
        <div class="card" style="margin-bottom: 32px;">
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
                
            </div>
        </div>

        <!-- ===== LISTE DES JEUX ===== -->
        <div style="margin-bottom: 16px; display:flex; justify-content:space-between; align-items:center;">
            <div>
                <h2 style="font-size:20px; font-weight:700; color:var(--text-primary);">🎲 Jeux disponibles au café</h2>
                <p style="font-size:13px; color:var(--text-secondary); margin-top:4px;">
                    Découvrez notre catalogue et réservez votre table
                </p>
            </div>
            <!-- Filtre catégorie -->
            <form method="GET" style="display:flex; align-items:center; gap:8px;">
                <label style="font-size:13px; color:var(--text-secondary);">Filtrer :</label>
                <select name="category" onchange="this.form.submit()" style="
                    padding: 7px 14px;
                    border-radius: var(--radius-md);
                    border: 1px solid var(--border);
                    background: white;
                    font-size: 13px;
                    cursor: pointer;
                ">
                    <option value="">Toutes les catégories</option>
                    <?php
                    $cats = array_unique(array_column($games ?? [], 'category'));
                    foreach ($cats as $cat): ?>
                        <option value="<?= htmlspecialchars($cat) ?>"
                            <?= (($_GET['category'] ?? '') === $cat) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($cat) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </form>
        </div>

        <?php
        $filtered = $games ?? [];
        if (!empty($_GET['category'])) {
            $filtered = array_filter($filtered, fn($g) => $g['category'] === $_GET['category']);
        }
        ?>

        <?php if (empty($filtered)): ?>
            <div style="text-align:center; padding:60px 20px; color:var(--text-muted);">
                <p style="font-size:48px;">🎲</p>
                <p style="font-size:16px; margin-top:12px;">Aucun jeu disponible pour le moment.</p>
            </div>
        <?php else: ?>
            <div style="
                display: grid;
                grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
                gap: 20px;
                margin-bottom: 40px;
            ">
                <?php foreach ($filtered as $game): ?>
                <div style="
                    background: white;
                    border-radius: var(--radius-xl);
                    border: 1px solid var(--border);
                    box-shadow: var(--shadow-sm);
                    overflow: hidden;
                    transition: box-shadow 0.2s, transform 0.2s;
                "
                onmouseover="this.style.boxShadow='var(--shadow-lg)';this.style.transform='translateY(-3px)'"
                onmouseout="this.style.boxShadow='var(--shadow-sm)';this.style.transform='translateY(0)'">

                    <!-- BADGE CATEGORIE -->
                    <div style="background: linear-gradient(135deg, #4f46e5, #7c3aed); padding: 10px 16px;">
                        <span style="color:white; font-size:12px; font-weight:600;">
                            <?= htmlspecialchars($game['category'] ?? 'Sans catégorie') ?>
                        </span>
                    </div>

                    <!-- CONTENU -->
                    <div style="padding: 16px 18px;">
                        <h3 style="font-size:16px; font-weight:700; color:var(--text-primary); margin-bottom:8px;">
                            <?= htmlspecialchars($game['name']) ?>
                        </h3>

                        <div style="
                            background: var(--bg-content);
                            border: 1px solid var(--border);
                            border-radius: var(--radius-md);
                            padding: 10px 12px;
                            margin-bottom: 12px;
                            min-height: 60px;
                        ">
                            <p style="font-size:13px; color:var(--text-secondary); line-height:1.5;">
                                <?= htmlspecialchars($game['description'] ?? 'Aucune description.') ?>
                            </p>
                        </div>

                        <!-- BADGES infos -->
                        <div style="display:flex; gap:6px; flex-wrap:wrap; margin-bottom:14px;">
                            <span style="font-size:11px; padding:3px 9px; background:#ede9fe; color:#5b21b6; border-radius:999px; font-weight:500;">
                                ⏱ <?= $game['duration'] ?> min
                            </span>
                            <span style="font-size:11px; padding:3px 9px; background:#dbeafe; color:#1e40af; border-radius:999px; font-weight:500;">
                                🎯 <?= htmlspecialchars($game['difficulty']) ?>
                            </span>
                            <?php if ($game['status'] === 'disponible'): ?>
                                <span style="font-size:11px; padding:3px 9px; background:#d1fae5; color:#065f46; border-radius:999px; font-weight:500;">
                                    🟢 Disponible
                                </span>
                            <?php else: ?>
                                <span style="font-size:11px; padding:3px 9px; background:#fee2e2; color:#991b1b; border-radius:999px; font-weight:500;">
                                    🔴 En cours
                                </span>
                            <?php endif; ?>
                        </div>

                        <!-- BOUTON détail -->
                        <a href="<?= BASE_URL ?>/games/show/<?= $game['id'] ?>" style="
                            display: block;
                            text-align: center;
                            padding: 9px 0;
                            background: var(--primary);
                            color: white;
                            border-radius: var(--radius-md);
                            text-decoration: none;
                            font-size: 13px;
                            font-weight: 600;
                            transition: background 0.2s;
                        "
                        onmouseover="this.style.background='var(--primary-hover)'"
                        onmouseout="this.style.background='var(--primary)'">
                            👁 Voir les détails
                        </a>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

    </div>
</main>

<?php include __DIR__ . '/../includes/footer.php'; ?>