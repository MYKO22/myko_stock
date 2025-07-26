<?php 
include 'connexion.php';

function getArticle($id = null, $searchDATA = array ())
{
    $connexion = $GLOBALS['connexion'];

    $sql = "SELECT a.id, a.nom_article, c.libelle_categorie, a.quantite, a.prix_unitaire, a.mise_en_ligne, a.id_categorie
            FROM article AS a
            JOIN categorie_article AS c 
            ON a.id_categorie = c.id";

    if (!empty($id)) {
        $sql .= " WHERE a.id = ?";
        $req = $connexion->prepare($sql);
        $req->execute([$id]);
        return $req->fetch();
    } elseif (!empty($searchDATA)) {
        $search = "";
        extract($searchDATA);
        if (!empty($nom_article)) $search .= " AND a.nom_article LIKE '%$nom_article%'";
        if (!empty($id_categorie)) $search .= " AND a.id_categorie = $id_categorie";
        if (!empty($quantite)) $search .= " AND a.quantite = $quantite";
        if (!empty($prix_unitaire)) $search .= " AND a.prix_unitaire = $prix_unitaire";
        if (!empty($mise_en_ligne)) $search .= " AND DATE(a.mise_en_ligne) ='$mise_en_ligne'";

            $sql = "SELECT a.id, a.nom_article, c.libelle_categorie, a.quantite, a.prix_unitaire, a.mise_en_ligne, a.id_categorie
            FROM article AS a JOIN categorie_article AS c 
            ON a.id_categorie = c.id $search";

            $req = $connexion->prepare($sql);

            $req->execute();

            return $req->fetchAll();
    } else {
        $req = $connexion->prepare($sql);
        $req->execute();
        return $req->fetchAll();
    }
}



function getClient($id = null) {
    $connexion = $GLOBALS['connexion'];

    if (!empty($id)) {
        $sql = "SELECT * FROM client WHERE id = ?";

        $req = $connexion->prepare($sql);

        $req->execute([$id]);

        return $req->fetch();
    } else {
        $sql = "SELECT * FROM client";

        $req = $connexion->prepare($sql);

        $req->execute();

        return $req->fetchAll();
    }
}

// 🔹 Fonction pour récupérer une ou plusieurs ventes avec jointures complètes
function getVente($id = null)
{
    $connexion = $GLOBALS['connexion'];

    if (!empty($id)) {
        $sql = "SELECT v.id, v.id_article, v.id_client, a.nom_article, a.prix_unitaire, a.quantite AS stock_disponible,
                       c.nom, c.prenom, c.telephone, c.adresse, v.quantite, v.prix, v.date_vente,
                       a.id AS idArticle
                FROM vente v
                INNER JOIN article a ON v.id_article = a.id
                INNER JOIN client c ON v.id_client = c.id
                WHERE v.id = ? AND etat = ?";

        $req = $connexion->prepare($sql);
        $req->execute(array($id, 1));
        return $req->fetch();
    } else {
        $sql = "SELECT v.id, v.id_article, v.id_client, a.nom_article, a.prix_unitaire, a.quantite AS stock_disponible,
                       c.nom, c.prenom, c.telephone, c.adresse, v.quantite, v.prix, v.date_vente,
                       a.id AS idArticle
                FROM vente v
                INNER JOIN article a ON v.id_article = a.id
                INNER JOIN client c ON v.id_client = c.id
                WHERE etat = ?";

        $req = $connexion->prepare($sql);
        $req->execute(array(1));
        return $req->fetchAll();
    }
}

function getFournisseur($id = null) {
    $connexion = $GLOBALS['connexion'];

    if (!empty($id)) {
        $sql = "SELECT * FROM fournisseur WHERE id = ?";

        $req = $connexion->prepare($sql);

        $req->execute([$id]);

        return $req->fetch();
    } else {
        $sql = "SELECT * FROM fournisseur";

        $req = $connexion->prepare($sql);

        $req->execute();

        return $req->fetchAll();
    }
}

// 🔹 Fonction pour récupérer une ou plusieurs commandes avec jointures complètes
function getCommande($id = null)
{
    $connexion = $GLOBALS['connexion'];

    if (!empty($id)) {
        $sql = "SELECT co.id, co.id_article, co.id_fournisseur, a.nom_article, a.prix_unitaire, a.quantite AS stock_disponible,
                       f.nom, f.prenom, f.telephone, f.adresse, co.quantite, co.prix, co.date_commande,
                       a.id AS idArticle
                FROM commande co
                INNER JOIN article a ON co.id_article = a.id
                INNER JOIN fournisseur f ON co.id_fournisseur = f.id
                WHERE co.id = ?";

        $req = $connexion->prepare($sql);
        $req->execute([$id]);
        return $req->fetch();
    } else {
        $sql = "SELECT co.id, co.id_article, co.id_fournisseur, a.nom_article, a.prix_unitaire, a.quantite AS stock_disponible,
                       f.nom, f.prenom, f.telephone, f.adresse, co.quantite, co.prix, co.date_commande,
                       a.id AS idArticle
                FROM commande co
                INNER JOIN article a ON co.id_article = a.id
                INNER JOIN fournisseur f ON co.id_fournisseur = f.id";

        $req = $connexion->prepare($sql);
        $req->execute();
        return $req->fetchAll();
    }
}

function getAllCommande()
{
    $sql = "SELECT COUNT(*) AS nbre FROM commande";

    $req = $GLOBALS['connexion']->prepare($sql);

    $req->execute();

    return $req->fetch();
}

function getAllVente()
{
    $sql = "SELECT COUNT(*) AS nbre FROM vente";

    $req = $GLOBALS['connexion']->prepare($sql);

    $req->execute();

    return $req->fetch();
}

function getAllArticle()
{
    $sql = "SELECT COUNT(*) AS nbre FROM article";

    $req = $GLOBALS['connexion']->prepare($sql);

    $req->execute();

    return $req->fetch();
}

function getAllRecette()
{
    $sql = "SELECT SUM(prix) AS prix FROM vente";

    $req = $GLOBALS['connexion']->prepare($sql);

    $req->execute();

    return $req->fetch();
}

function getLastVente()
{
    $connexion = $GLOBALS['connexion'];

    $sql = "SELECT nom_article, nom, prenom, v.quantite, prix, date_vente, v.id, a.id AS idArticle
        FROM client AS c, vente AS v, article AS a WHERE v.id_article=a.id AND v.id_client=c.id AND etat=?
        ORDER BY date_vente DESC LIMIT 10";

    $req = $connexion->prepare($sql);

    $req->execute(array(1));

    return $req->fetchAll();
}

function getMostVente()
{
    $connexion = $GLOBALS['connexion'];

    $sql = "SELECT a.nom_article AS nom_article, SUM(v.prix) AS total_vente
            FROM vente AS v
            JOIN article AS a ON v.id_article = a.id
            JOIN client AS c ON v.id_client = c.id
            WHERE v.etat = ?
            GROUP BY v.id_article
            ORDER BY total_vente DESC
            LIMIT 10";

    $req = $connexion->prepare($sql);
    $req->execute([1]);

    return $req->fetchAll(PDO::FETCH_ASSOC);
}

function getCategorie($id = null) {
    $connexion = $GLOBALS['connexion'];

    if (!empty($id)) {
        $sql = "SELECT * FROM categorie_article WHERE id = ?";

        $req = $connexion->prepare($sql);

        $req->execute([$id]);

        return $req->fetch();
    } else {
        $sql = "SELECT * FROM categorie_article";

        $req = $connexion->prepare($sql);

        $req->execute();

        return $req->fetchAll();
    }
}