<?php
session_start();
include 'connexion.php';

if (
    !empty($_POST['nom']) &&
    !empty($_POST['prenom']) &&
    !empty($_POST['telephone']) &&
    !empty($_POST['adresse'])
) {
    $sql = "INSERT INTO client (nom, prenom, telephone, adresse) VALUES (?, ?, ?, ?)";
    $req = $connexion->prepare($sql);

    $req->execute([
        $_POST['nom'],
        $_POST['prenom'],
        $_POST['telephone'],
        $_POST['adresse']
    ]);

    if ($req->rowCount() != 0) {
        $_SESSION['message'] = "✅ Client ajouté avec succès.";
        $_SESSION['message_type'] = "alert-success";
    } else {
        $_SESSION['message'] = "❌ Aucun client ajouté.";
        $_SESSION['message_type'] = "alert-danger";
    }
} else {
    $_SESSION['message'] = "⚠ Veuillez remplir tous les champs.";
    $_SESSION['message_type'] = "alert-warning";
}

header("Location: ../vue/client.php");
exit();