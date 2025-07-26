<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'connexion.php';

if (
    !empty($_POST['nom']) &&
    !empty($_POST['prenom']) &&
    !empty($_POST['telephone']) &&
    !empty($_POST['adresse'])
) {
    try {
        $sql = "INSERT INTO fournisseur (nom, prenom, telephone, adresse) VALUES (?, ?, ?, ?)";
        $req = $connexion->prepare($sql);

        $req->execute([
            $_POST['nom'],
            $_POST['prenom'],
            $_POST['telephone'],
            $_POST['adresse']
        ]);

        $_SESSION['message'] = "✅ Fournisseur ajouté avec succès.";
        $_SESSION['message_type'] = "alert-success";
    } catch (PDOException $e) {
        $_SESSION['message'] = "❌ Erreur lors de l'ajout : " . $e->getMessage();
        $_SESSION['message_type'] = "alert-danger";
    }
} else {
    $_SESSION['message'] = "⚠ Veuillez remplir tous les champs.";
    $_SESSION['message_type'] = "alert-warning";
}

header("Location: ../vue/fournisseur.php");
exit();