<?php
session_start();
include 'connexion.php';

if (!empty($_POST['id']) && !empty($_POST['libelle_categorie'])) {
    $sql = "UPDATE categorie SET libelle_categorie = ? WHERE id = ?";
    $req = $connexion->prepare($sql);
    $success = $req->execute([
        $_POST['libelle_categorie'],
        $_POST['id']
    ]);

    if ($success) {
        $_SESSION['message'] = "Catégorie modifiée avec succès.";
        $_SESSION['message_type'] = "success";
    } else {
        $_SESSION['message'] = "Erreur lors de la modification.";
        $_SESSION['message_type'] = "danger";
    }
} else {
    $_SESSION['message'] = "Champs requis manquants.";
    $_SESSION['message_type'] = "warning";
}

header("Location: ../vue/categorie.php");
exit();
