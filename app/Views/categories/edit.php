<?php include __DIR__ . '/../includes/header.php'; ?>

<div class="dashboard-container">
    <div style="max-width: 500px; margin: 0 auto;">

        <div style="margin-bottom: 24px;">
            <a href="<?= BASE_URL ?>/categories" style="
                color: var(--text-secondary);
                text-decoration: none;
                font-size: 14px;
                font-weight: 500;
            ">← Retour aux catégories</a>
            <h1 class="dashboard-title" style="margin-top: 12px;">✏️ Modifier — <?= htmlspecialchars($category['name']) ?></h1>
        </div>

        <div style="
            background: white;
            border-radius: var(--radius-xl);
            border: 1px solid var(--border);
            box-shadow: var(--shadow-md);
            padding: 32px;
        ">
            <form action="<?= BASE_URL ?>/categories/update/<?= $category['id'] ?>" method="POST">

                <div style="margin-bottom: 24px;">
                    <label style="display:block; font-size:13px; font-weight:600; color:var(--text-secondary); margin-bottom:6px; text-transform:uppercase; letter-spacing:0.5px;">
                        Nom de la catégorie
                    </label>
                    <input
                        type="text"
                        name="name"
                        value="<?= htmlspecialchars($category['name']) ?>"
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

                <div style="display: flex; gap: 12px; justify-content: flex-end;">
                    <a href="<?= BASE_URL ?>/categories" style="
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