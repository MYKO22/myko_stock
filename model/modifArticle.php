<?php
session_start();
include 'connexion.php';

if (
    !empty($_POST['nom_article']) &&
    !empty($_POST['id_categorie']) &&
    !empty($_POST['quantite']) &&
    !empty($_POST['prix_unitaire']) &&
    !empty($_POST['mise_en_ligne']) &&
    !empty($_POST['id'])
) {
    $sql = "UPDATE article 
            SET nom_article = ?, 
                id_categorie = ?, 
                quantite = ?, 
                prix_unitaire = ?, 
                mise_en_ligne = ? 
            WHERE id = ?";
    $req = $connexion->prepare($sql);

    $req->execute(array(
        $_POST['nom_article'],
        $_POST['id_categorie'],
        $_POST['quantite'],
        $_POST['prix_unitaire'],
        $_POST['mise_en_ligne'],
        $_POST['id']
    ));

    if ($req->rowCount() != 0) {
        $_SESSION['message'] = "Article modifié avec succès.";
        $_SESSION['message_type'] = "alert-success";
    } else {
        $_SESSION['message'] = "Aucune modification détectée.";
        $_SESSION['message_type'] = "alert-info";
    }
} else {
    $_SESSION['message'] = "Veuillez remplir tous les champs.";
    $_SESSION['message_type'] = "alert-warning";
}

header("Location: ../vue/article.php");
exit();