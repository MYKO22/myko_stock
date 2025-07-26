<?php 
session_start();
include 'entete.php';

if (!empty($_GET['id'])) {
    $article = getCommande($_GET['id']);
}
?>

<div class="home-content">
    <div class="overview-boxes">
        <div class="box">
            <form action="<?= !empty($_GET['id']) ? "../model/modifCommande.php" : "../model/ajoutCommande.php" ?>" method="post">
                <input value="<?= !empty($_GET['id']) ? $article['id'] : "" ?>" type="hidden" name="id">
                
                <label for="id_article">Article</label>
                <select onchange="setPrix()" name="id_article" id="id_article">
                    <?php
                        $articles = getArticle();
                        foreach ($articles as $value): ?>
                            <option data-prix="<?= $value['prix_unitaire'] ?>" value="<?= $value['id'] ?>">
                                <?= $value['nom_article'] . " - " . $value['quantite'] . " dispo" ?>
                            </option>
                    <?php endforeach; ?>
                </select>

                <label for="id_fournisseur">Fournisseur</label>
                <select name="id_fournisseur" id="id_fournisseur">
                    <?php
                        $fournisseurs = getFournisseur();
                        foreach ($fournisseurs as $value): ?>
                            <option value="<?= $value['id'] ?>">
                                <?= $value['nom'] . " " . $value['prenom'] ?>
                            </option>
                    <?php endforeach; ?>
                </select>

                <label for="quantite">Quantité</label>
                <input onkeyup="setPrix()" value="<?= !empty($_GET['id']) ? $article['quantite'] : "" ?>" type="text" id="quantite" name="quantite" placeholder="Saisissez la quantité">

                <label for="prix">Prix</label>
                <input value="<?= !empty($_GET['id']) ? $article['prix'] : "" ?>" type="text" id="prix" name="prix" placeholder="">

                <button type="submit">Validez</button>

                <?php if (!empty($_SESSION['message'])): ?>
                    <div class="alert <?= $_SESSION['message_type'] ?>">
                        <?= $_SESSION['message'] ?>
                    </div>
                    <?php unset($_SESSION['message'], $_SESSION['message_type']); ?>
                <?php endif; ?>
            </form>
        </div>

        <div class="box">
            <table class="ntable">
                <tr>
                    <th>Article</th>
                    <th>Fournisseur</th>
                    <th>Quantité</th>
                    <th>Prix</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
                <?php
                $commandes = getCommande();
                foreach ($commandes as $value): ?>
                    <tr>
                        <td><?= $value['nom_article'] ?></td>
                        <td><?= $value['nom'] . " " . $value['prenom'] ?></td>
                        <td><?= $value['quantite'] ?></td>
                        <td><?= $value['prix'] ?></td>
                        <td><?= date('d/m/Y H:i:s', strtotime($value['date_commande'])) ?></td>
                        <td>
                            <a href="recuCommande.php?id=<?= $value['id'] ?>"><i class='bx bx-receipt'></i></a>
                            <a onclick="annuleCommande(<?= $value['id'] ?>, <?= $value['id_article'] ?>, <?= $value['quantite'] ?>)" style="color: red;">
                                <i class='bx bx-stop-circle'></i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</div>
</section>

<?php include 'pied.php'; ?>

<script>
function annuleCommande(id, idArticle, quantite) {
    if (confirm("Annuler cette commande ?")) {
        window.location.href = "../model/annuleCommande.php?idCommande=" + id + "&idArticle=" + idArticle + "&quantite=" + quantite;
    }
}

function setPrix() {
    let article = document.querySelector('#id_article');
    let quantite = document.querySelector('#quantite');
    let prix = document.querySelector('#prix');

    if (article && quantite && prix) {
        let prixUnitaire = article.options[article.selectedIndex].getAttribute('data-prix');
        prix.value = Number(prixUnitaire) * Number(quantite.value);
    }
}
</script>