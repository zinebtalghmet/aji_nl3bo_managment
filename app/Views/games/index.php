<?php include __DIR__ . '/../includes/header.php'; ?>

<div class="dashboard-container">

    <!-- HEADER -->
    <div class="dashboard-header" style="display:flex; justify-content:space-between; align-items:center;">
        <div>
            <h1 class="dashboard-title">🎲 Catalogue des jeux</h1>
            <p class="dashboard-subtitle">Découvrez tous les jeux disponibles au café</p>
        </div>
        <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin'): ?>
            <a href="<?= BASE_URL ?>/games/create" style="
                background: var(--primary);
                color: white;
                padding: 10px 20px;
                border-radius: var(--radius-md);
                text-decoration: none;
                font-weight: 600;
                font-size: 14px;
                display: flex;
                align-items: center;
                gap: 8px;
            ">+ Ajouter un jeu</a>
        <?php endif; ?>
    </div>

    <!-- FILTRE PAR CATEGORIE -->
    <div class="admin-section" style="margin-bottom: 24px;">
        <form method="GET" action="<?= BASE_URL ?>/games" style="display:flex; align-items:center; gap:12px;">
            <label style="font-size:14px; font-weight:500; color:var(--text-secondary);">
                Filtrer par thématique :
            </label>
            <select name="category" onchange="this.form.submit()" style="
                padding: 8px 16px;
                border-radius: var(--radius-md);
                border: 1px solid var(--border);
                background: white;
                font-size: 14px;
                color: var(--text-primary);
                cursor: pointer;
                outline: none;
            ">
                <option value="">Toutes les catégories</option>
                <?php
                $categories = array_unique(array_column($games, 'category'));
                foreach ($categories as $cat): ?>
                    <option value="<?= htmlspecialchars($cat) ?>"
                        <?= (($_GET['category'] ?? '') === $cat) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($cat) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </form>
    </div>

    <!-- GRILLE DES JEUX -->
    <?php if (empty($games)): ?>
        <div style="text-align:center; padding: 60px 20px; color: var(--text-muted);">
            <p style="font-size: 48px;">🎲</p>
            <p style="font-size: 16px; margin-top: 12px;">Aucun jeu disponible pour le moment.</p>
        </div>

    <?php else: ?>
        <div style="
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 24px;
        ">
            <?php
            // Filtrer par catégorie si sélectionnée
            $filtered = $games;
            if (!empty($_GET['category'])) {
                $filtered = array_filter($games, fn($g) => $g['category'] === $_GET['category']);
            }
            foreach ($filtered as $game):
            ?>
            <div style="
                background: white;
                border-radius: var(--radius-xl);
                border: 1px solid var(--border);
                box-shadow: var(--shadow-sm);
                overflow: hidden;
                transition: box-shadow 0.2s ease, transform 0.2s ease;
            "
            onmouseover="this.style.boxShadow='var(--shadow-lg)';this.style.transform='translateY(-3px)'"
            onmouseout="this.style.boxShadow='var(--shadow-sm)';this.style.transform='translateY(0)'">

                <!-- BADGE CATEGORIE -->
                <div style="
                    background: linear-gradient(135deg, #4f46e5, #7c3aed);
                    padding: 10px 16px;
                ">
                    <span style="
                        color: white;
                        font-size: 13px;
                        font-weight: 600;
                        letter-spacing: 0.3px;
                    "><?= htmlspecialchars($game['category'] ?? 'Sans catégorie') ?></span>
                </div>

                <!-- CONTENU -->
                <div style="padding: 18px 20px;">

                    <!-- NOM -->
                    <h3 style="
                        font-size: 17px;
                        font-weight: 700;
                        color: var(--text-primary);
                        margin-bottom: 10px;
                    "><?= htmlspecialchars($game['name']) ?></h3>

                    <!-- DESCRIPTION -->
                    <div style="
                        background: var(--bg-content);
                        border: 1px solid var(--border);
                        border-radius: var(--radius-md);
                        padding: 12px;
                        margin-bottom: 14px;
                        min-height: 70px;
                    ">
                        <p style="
                            font-size: 13px;
                            color: var(--text-secondary);
                            line-height: 1.6;
                        "><?= htmlspecialchars($game['description'] ?? 'Aucune description disponible.') ?></p>
                    </div>

                    <!-- INFOS -->
                    <div style="display:flex; gap:8px; flex-wrap:wrap; margin-bottom: 16px;">
                        <span style="
                            font-size: 12px;
                            padding: 3px 10px;
                            background: #ede9fe;
                            color: #5b21b6;
                            border-radius: 999px;
                            font-weight: 500;
                        ">⏱ <?= $game['duration'] ?> min</span>

                        <span style="
                            font-size: 12px;
                            padding: 3px 10px;
                            background: #dbeafe;
                            color: #1e40af;
                            border-radius: 999px;
                            font-weight: 500;
                        ">🎯 <?= htmlspecialchars($game['difficulty']) ?></span>

                        <?php if ($game['status'] === 'disponible'): ?>
                            <span style="
                                font-size: 12px;
                                padding: 3px 10px;
                                background: #d1fae5;
                                color: #065f46;
                                border-radius: 999px;
                                font-weight: 500;
                            ">🟢 Disponible</span>
                        <?php else: ?>
                            <span style="
                                font-size: 12px;
                                padding: 3px 10px;
                                background: #fee2e2;
                                color: #991b1b;
                                border-radius: 999px;
                                font-weight: 500;
                            ">🔴 En cours</span>
                        <?php endif; ?>
                    </div>

                    <!-- BOUTONS -->
                    <div style="display:flex; gap:8px;">

                        <!-- VOIR DETAILS — pour tout le monde -->
                        <a href="<?= BASE_URL ?>/games/show/<?= $game['id'] ?>" style="
                            flex: 1;
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

                        <!-- MODIFIER + SUPPRIMER — admin seulement -->
                        <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin'): ?>
                            <a href="<?= BASE_URL ?>/games/edit/<?= $game['id'] ?>" style="
                                padding: 9px 14px;
                                background: #f59e0b;
                                color: white;
                                border-radius: var(--radius-md);
                                text-decoration: none;
                                font-size: 13px;
                                font-weight: 600;
                                transition: background 0.2s;
                            "
                            onmouseover="this.style.background='#d97706'"
                            onmouseout="this.style.background='#f59e0b'">✏️</a>

                            <a href="<?= BASE_URL ?>/games/destroy/<?= $game['id'] ?>"
                               onclick="return confirm('Supprimer ce jeu ?')"
                               style="
                                padding: 9px 14px;
                                background: var(--danger);
                                color: white;
                                border-radius: var(--radius-md);
                                text-decoration: none;
                                font-size: 13px;
                                font-weight: 600;
                                transition: background 0.2s;
                            "
                            onmouseover="this.style.background='var(--danger-hover)'"
                            onmouseout="this.style.background='var(--danger)'">🗑️</a>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

</div>

<?php include __DIR__ . '/../includes/footer.php'; ?>