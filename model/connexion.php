<?php
// Fichier connexion.php — uniquement la connexion, sans session_start()

$nom_serveur = "localhost";
$nom_base_de_donnees = "myko_stock_manager";
$utilisateur = "root";
$mot_de_passe = "";

try {
    $connexion = new PDO(
        "mysql:host=$nom_serveur;dbname=$nom_base_de_donnees;charset=utf8",
        $utilisateur,
        $mot_de_passe,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]
    );
} catch (PDOException $e) {
    die("❌ Échec de la connexion à la base de données : " . $e->getMessage());
}