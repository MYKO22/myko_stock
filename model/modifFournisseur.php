<?php
session_start();
include 'connexion.php';

if (
    !empty($_POST['nom']) &&
    !empty($_POST['prenom']) &&
    !empty($_POST['telephone']) &&
    !empty($_POST['adresse']) &&
    !empty($_POST['id'])
) {
    $sql = "UPDATE fournisseur 
            SET nom = ?, 
                prenom = ?,  
                telephone = ?, 
                adresse = ?
            WHERE id = ?";
    
    $req = $connexion->prepare($sql);
    $req->execute([
        $_POST['nom'],
        $_POST['prenom'],
        $_POST['telephone'],
        $_POST['adresse'],
        $_POST['id']
    ]);

    if ($req->rowCount() != 0) {
        $_SESSION['message'] = "Fournisseur modifié avec succès.";
        $_SESSION['message_type'] = "alert-success";
    } else {
        $_SESSION['message'] = "Aucune modification détectée.";
        $_SESSION['message_type'] = "alert-info";
    }
} else {
    $_SESSION['message'] = "Veuillez remplir tous les champs.";
    $_SESSION['message_type'] = "alert-warning";
}

header("Location: ../vue/fournisseur.php");
exit();