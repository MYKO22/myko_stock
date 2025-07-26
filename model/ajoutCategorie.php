<?php
session_start();
include 'connexion.php';

if (
    !empty($_POST['libelle_categorie'])
) {
    $sql = "INSERT INTO categorie_article (libelle_categorie) VALUES(?)";
    $req = $connexion->prepare($sql);

    $req->execute(array(
        $_POST['libelle_categorie'],
    ));

    if ($req->rowCount() != 0) {
        $_SESSION['message'] = "Catégorie ajouté.";
        $_SESSION['message_type'] = "alert-success";
    } else {
        $_SESSION['message'] = "Erreur lors de l'ajout de la catégorie.";
        $_SESSION['message_type'] = "alert-danger";
    }
} else {
    $_SESSION['message'] = "Veuillez remplir tous les champs.";
    $_SESSION['message_type'] = "alert-warning";
}

header("Location: ../vue/categorie.php");
exit();