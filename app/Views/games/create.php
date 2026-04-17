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
            <h1 class="dashboard-title" style="margin-top: 12px;">➕ Ajouter un jeu</h1>
        </div>

        <!-- FORMULAIRE -->
        <div style="
            background: white;
            border-radius: var(--radius-xl);
            border: 1px solid var(--border);
            box-shadow: var(--shadow-md);
            padding: 32px;
        ">
            <form action="<?= BASE_URL ?>/games/store" method="POST">

                <!-- NOM -->
                <div style="margin-bottom: 20px;">
                    <label style="display:block; font-size:13px; font-weight:600; color:var(--text-secondary); margin-bottom:6px; text-transform:uppercase; letter-spacing:0.5px;">
                        Nom du jeu
                    </label>
                    <input
                        type="text"
                        name="name"
                        placeholder="Ex: UNO, Catan, Codenames..."
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
                            transition: border-color 0.2s;
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
                        onfocus="this.style.borderColor='var(--primary)'"
                        onblur="this.style.borderColor='var(--border)'"
                    >
                        <option value="">— Choisir une catégorie —</option>
                        <?php foreach ($categories as $category): ?>
                            <option value="<?= $category['id'] ?>">
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
                        placeholder="Ex: 30"
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
                        placeholder="Décrivez le jeu..."
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
                    ></textarea>
                </div>

                <!-- DIFFICULTE + STATUT sur 2 colonnes -->
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 28px;">

                    <div>
                        <label style="display:block; font-size:13px; font-weight:600; color:var(--text-secondary); margin-bottom:6px; text-transform:uppercase; letter-spacing:0.5px;">
                            Difficulté
                        </label>
                        <select
                            name="difficulty"
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
                            <option value="facile">😊 Facile</option>
                            <option value="moyen">🎯 Moyen</option>
                            <option value="difficile">🔥 Difficile</option>
                            <option value="expert">💀 Expert</option>
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
                            <option value="">— Statut —</option>
                            <option value="disponible">🟢 Disponible</option>
                            <option value="en_cours">🔴 En cours</option>
                            <option value="maintenance">🔧 Maintenance</option>
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
                        background: var(--primary);
                        color: white;
                        border: none;
                        border-radius: var(--radius-md);
                        font-size: 14px;
                        font-weight: 600;
                        cursor: pointer;
                        transition: background 0.2s;
                    "
                    onmouseover="this.style.background='var(--primary-hover)'"
                    onmouseout="this.style.background='var(--primary)'">
                        ➕ Ajouter le jeu
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../includes/footer.php'; ?>