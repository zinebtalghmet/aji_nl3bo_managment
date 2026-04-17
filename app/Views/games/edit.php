<?php include __DIR__ . '/../includes/header.php'; ?>

<div class="dashboard-container">

    <div style="max-width: 650px; margin: 0 auto;">

        <!-- HEADER -->
        <div style="margin-bottom: 24px;">
            <a href="<?= BASE_URL ?>/games" style="
                color: var(--text-secondary);
                text-decoration: none;
                font-size: 14px;
                font-weight: 500;
            ">← Retour aux jeux</a>
            <h1 class="dashboard-title" style="margin-top: 12px;">✏️ Modifier — <?= htmlspecialchars($game['name']) ?></h1>
        </div>

        <!-- FORMULAIRE -->
        <div style="
            background: white;
            border-radius: var(--radius-xl);
            border: 1px solid var(--border);
            box-shadow: var(--shadow-md);
            padding: 32px;
        ">
            <form action="<?= BASE_URL ?>/games/update/<?= $game['id'] ?>" method="POST">

                <!-- NOM -->
                <div style="margin-bottom: 20px;">
                    <label style="display:block; font-size:13px; font-weight:600; color:var(--text-secondary); margin-bottom:6px; text-transform:uppercase; letter-spacing:0.5px;">
                        Nom du jeu
                    </label>
                    <input
                        type="text"
                        name="name"
                        value="<?= htmlspecialchars($game['name']) ?>"
                        required
                        style="
                            width: 100%;
                            padding: 10px 14px;
                            border: 1px solid var(--border);
                            border-radius: var(--radius-md);
                            font-size: 14px;
                            color: var(--text-primary);
                            outline: none;
                            box-sizing: border-box;
                        "
                        onfocus="this.style.borderColor='var(--primary)'"
                        onblur="this.style.borderColor='var(--border)'"
                    >
                </div>

                <!-- CATEGORIE -->
                <div style="margin-bottom: 20px;">
                    <label style="display:block; font-size:13px; font-weight:600; color:var(--text-secondary); margin-bottom:6px; text-transform:uppercase; letter-spacing:0.5px;">
                        Catégorie
                    </label>
                    <select
                        name="category_id"
                        required
                        style="
                            width: 100%;
                            padding: 10px 14px;
                            border: 1px solid var(--border);
                            border-radius: var(--radius-md);
                            font-size: 14px;
                            color: var(--text-primary);
                            background: white;
                            outline: none;
                            box-sizing: border-box;
                        "
                    >
                        <option value="">— Choisir —</option>
                        <?php foreach ($categories as $category): ?>
                            <option value="<?= $category['id'] ?>"
                                <?= $category['id'] == $game['category_id'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($category['name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- DUREE -->
                <div style="margin-bottom: 20px;">
                    <label style="display:block; font-size:13px; font-weight:600; color:var(--text-secondary); margin-bottom:6px; text-transform:uppercase; letter-spacing:0.5px;">
                        Durée (minutes)
                    </label>
                    <input
                        type="number"
                        name="duration"
                        value="<?= $game['duration'] ?>"
                        min="1"
                        required
                        style="
                            width: 100%;
                            padding: 10px 14px;
                            border: 1px solid var(--border);
                            border-radius: var(--radius-md);
                            font-size: 14px;
                            color: var(--text-primary);
                            outline: none;
                            box-sizing: border-box;
                        "
                        onfocus="this.style.borderColor='var(--primary)'"
                        onblur="this.style.borderColor='var(--border)'"
                    >
                </div>

                <!-- DESCRIPTION -->
                <div style="margin-bottom: 20px;">
                    <label style="display:block; font-size:13px; font-weight:600; color:var(--text-secondary); margin-bottom:6px; text-transform:uppercase; letter-spacing:0.5px;">
                        Description
                    </label>
                    <textarea
                        name="description"
                        rows="4"
                        style="
                            width: 100%;
                            padding: 10px 14px;
                            border: 1px solid var(--border);
                            border-radius: var(--radius-md);
                            font-size: 14px;
                            color: var(--text-primary);
                            outline: none;
                            box-sizing: border-box;
                            resize: vertical;
                            font-family: inherit;
                        "
                        onfocus="this.style.borderColor='var(--primary)'"
                        onblur="this.style.borderColor='var(--border)'"
                    ><?= htmlspecialchars($game['description'] ?? '') ?></textarea>
                </div>

                <!-- DIFFICULTE + STATUT -->
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 28px;">

                    <div>
                        <label style="display:block; font-size:13px; font-weight:600; color:var(--text-secondary); margin-bottom:6px; text-transform:uppercase; letter-spacing:0.5px;">
                            Difficulté
                        </label>
                        <select
                            name="difficulty"
                            required
                            style="
                                width: 100%;
                                padding: 10px 14px;
                                border: 1px solid var(--border);
                                border-radius: var(--radius-md);
                                font-size: 14px;
                                color: var(--text-primary);
                                background: white;
                                outline: none;
                                box-sizing: border-box;
                            "
                        >
                            <option value="facile"    <?= $game['difficulty'] == 'facile'    ? 'selected' : '' ?>>😊 Facile</option>
                            <option value="moyen"     <?= $game['difficulty'] == 'moyen'     ? 'selected' : '' ?>>🎯 Moyen</option>
                            <option value="difficile" <?= $game['difficulty'] == 'difficile' ? 'selected' : '' ?>>🔥 Difficile</option>
                            <option value="expert"    <?= $game['difficulty'] == 'expert'    ? 'selected' : '' ?>>💀 Expert</option>
                        </select>
                    </div>

                    <div>
                        <label style="display:block; font-size:13px; font-weight:600; color:var(--text-secondary); margin-bottom:6px; text-transform:uppercase; letter-spacing:0.5px;">
                            Statut
                        </label>
                        <select
                            name="status"
                            required
                            style="
                                width: 100%;
                                padding: 10px 14px;
                                border: 1px solid var(--border);
                                border-radius: var(--radius-md);
                                font-size: 14px;
                                color: var(--text-primary);
                                background: white;
                                outline: none;
                                box-sizing: border-box;
                            "
                        >
                            <option value="disponible"  <?= $game['status'] == 'disponible'  ? 'selected' : '' ?>>🟢 Disponible</option>
                            <option value="en_cours"    <?= $game['status'] == 'en_cours'    ? 'selected' : '' ?>>🔴 En cours</option>
                            <option value="maintenance" <?= $game['status'] == 'maintenance' ? 'selected' : '' ?>>🔧 Maintenance</option>
                        </select>
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
                    ">Annuler</a>

                    <button type="submit" style="
                        padding: 10px 24px;
                        background: #f59e0b;
                        color: white;
                        border: none;
                        border-radius: var(--radius-md);
                        font-size: 14px;
                        font-weight: 600;
                        cursor: pointer;
                        transition: background 0.2s;
                    "
                    onmouseover="this.style.background='#d97706'"
                    onmouseout="this.style.background='#f59e0b'">
                        ✏️ Enregistrer
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../includes/footer.php'; ?>