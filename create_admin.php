<?php

// ---- AUTOLOADING COMPOSER ----
require_once __DIR__ . '/vendor/autoload.php';

use Database\Database;

// ================================
// CONFIGURATION DU COMPTE ADMIN
// ================================
$name     = 'Admin';
$email    = 'admin@ajil3bo.com';
$password = 'admin123'; // ← changer après première connexion

$hashed_password = password_hash($password, PASSWORD_BCRYPT);

try {
    $db = Database::getInstance()->getConnexion();

    // Vérifier si admin existe déjà
    $check = $db->prepare('SELECT id FROM users WHERE email = :email');
    $check->execute([':email' => $email]);

    if ($check->fetch()) {
        echo "
        <div style='
            font-family: sans-serif;
            max-width: 480px;
            margin: 60px auto;
            padding: 32px;
            border-radius: 18px;
            background: #fef3c7;
            border: 1px solid #fcd34d;
            color: #92400e;
        '>
            <h2>⚠️ Admin déjà existant</h2><br>
            <b>Email :</b> $email<br><br>
            <small>Ce compte admin existe déjà en base de données.</small>
        </div>";
        exit;
    }

    // Insérer l'admin
    $stmt = $db->prepare(
        'INSERT INTO users (name, email, password, role)
         VALUES (:name, :email, :password, "admin")'
    );

    $stmt->execute([
        ':name'     => $name,
        ':email'    => $email,
        ':password' => $hashed_password,
    ]);

    echo "
    <div style='
        font-family: sans-serif;
        max-width: 480px;
        margin: 60px auto;
        padding: 32px;
        border-radius: 18px;
        background: #d1fae5;
        border: 1px solid #a7f3d0;
        color: #065f46;
    '>
        <h2>✅ Compte admin créé avec succès !</h2><br>
        <b>Nom :</b> $name<br>
        <b>Email :</b> $email<br>
        <b>Mot de passe :</b> $password<br>
        <b>Rôle :</b> admin<br><br>
        <small style='color:#dc2626'>
            ⚠️ IMPORTANT : Supprimez ce fichier après utilisation !
        </small><br><br>
        <a href='/aji_nl3bo_managment/login' style='
            background: #4f46e5;
            color: #fff;
            padding: 10px 20px;
            border-radius: 10px;
            text-decoration: none;
            font-weight: 600;
        '>🔐 Aller à la page de connexion</a>
    </div>";

} catch (PDOException $e) {
    echo "
    <div style='
        font-family: sans-serif;
        max-width: 480px;
        margin: 60px auto;
        padding: 32px;
        border-radius: 18px;
        background: #fee2e2;
        border: 1px solid #fecaca;
        color: #991b1b;
    '>
        <h2>❌ Erreur</h2><br>
        " . $e->getMessage() . "
    </div>";
}
?>