<?php
session_start();
include 'connexion.php';
include_once "function.php";

if (
    !empty($_POST['id_article']) &&
    !empty($_POST['id_fournisseur']) &&
    !empty($_POST['quantite']) &&
    !empty($_POST['prix']) // ✅ correspond au champ du formulaire
) {
            // ✅ Insertion dans la table vente
            $sql = "INSERT INTO commande (id_article, id_fournisseur, quantite, prix)
                    VALUES (?, ?, ?, ?)";
            $req = $connexion->prepare($sql);

            $req->execute([
                $_POST['id_article'],
                $_POST['id_fournisseur'], // ✅ correction ici
                $_POST['quantite'],
                $_POST['prix'], // ✅ correction ici
            ]);

            if ($req->rowCount() != 0) {
                // ✅ Mise à jour du stock
                $sql = "UPDATE article SET quantite = quantite - ? WHERE id = ?";
                $req = $connexion->prepare($sql);

                $req->execute([
                    $_POST['quantite'],
                    $_POST['id_article'],
                ]);

                if ($req->rowCount() != 0) {
                    $_SESSION['message'] = "commande effectuée avec succès.";
                    $_SESSION['message_type'] = "alert-success";
                } else {
                    $_SESSION['message'] = "Stock non mis à jour.";
                    $_SESSION['message_type'] = "alert-danger";
                }
            } else {
                $_SESSION['message'] = "Erreur lors de l'enregistrement de la commande.";
                $_SESSION['message_type'] = "alert-danger";
    }
    
} else {
    $_SESSION['message'] = "Veuillez remplir tous les champs.";
    $_SESSION['message_type'] = "alert-warning";
}

// ✅ Redirection vers la page vente
header("Location: ../vue/commande.php");
exit();