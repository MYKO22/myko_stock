<?php
session_start();
include 'connexion.php';

if (
    !empty($_POST['nom_article']) &&
    !empty($_POST['id_categorie']) &&
    !empty($_POST['quantite']) &&
    !empty($_POST['prix_unitaire']) &&
    !empty($_POST['mise_en_ligne']) &&
    !empty($_FILES['image']['name'])
) {
    $name = basename($_FILES['image']['name']);
    $tmp_name = $_FILES['image']['tmp_name'];

    $folder = "../public/img";
    $destination = "$folder/$name";

    // Créer le dossier s’il n’existe pas
    if (!is_dir($folder)) {
        mkdir($folder, 0777, true);
    }

    if (move_uploaded_file($tmp_name, $destination)) {
        $sql = "INSERT INTO article 
                (nom_article, id_categorie, quantite, prix_unitaire, mise_en_ligne, image) 
                VALUES (?, ?, ?, ?, ?, ?)";

        $req = $connexion->prepare($sql);

        $req->execute([
            $_POST['nom_article'],
            $_POST['id_categorie'],
            $_POST['quantite'],
            $_POST['prix_unitaire'],
            $_POST['mise_en_ligne'],
            $destination
        ]);

        if ($req->rowCount() > 0) {
            $_SESSION['message'] = "Article ajouté avec succès.";
            $_SESSION['message_type'] = "alert-success";
        } else {
            $_SESSION['message'] = "Erreur lors de l'ajout de l'article.";
            $_SESSION['message_type'] = "alert-danger";
        }
    } else {
        $_SESSION['message'] = "Erreur produite lors de l'importation de l'image.";
        $_SESSION['message_type'] = "alert-warning";
    }

} else {
    $_SESSION['message'] = "Veuillez remplir tous les champs.";
    $_SESSION['message_type'] = "alert-warning";
}

header("Location: ../vue/article.php");
exit();
