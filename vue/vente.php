<?php  
session_start();
include 'entete.php';

if (!empty($_GET['id'])) {
    $article = getVente($_GET['id']);
}
?>

<div class="home-content">
  <div class="overview-boxes">
    <!-- FORMULAIRE DE VENTE -->
    <div class="box">
      <form action="<?= !empty($_GET['id']) ? "../model/modifVente.php" : "../model/ajoutVente.php" ?>" method="post">
        <input value="<?= !empty($_GET['id']) ? $article['id'] : "" ?>" type="hidden" name="id">

        <label for="id_article">Article</label>
        <select onchange="setPrix()" name="id_article" id="id_article">
          <?php
            $articles = getArticle();
            if (!empty($articles)) {
              foreach ($articles as $value) {
                $selected = (!empty($_GET['id']) && $value['id'] == $article['id_article']) ? "selected" : "";
                echo "<option data-prix='{$value['prix_unitaire']}' value='{$value['id']}' $selected>
                      {$value['nom_article']} - {$value['quantite']} disponible
                    </option>";
              }
            }
          ?>
        </select>

        <label for="id_client">Client</label>
        <select name="id_client" id="id_client">
          <?php
            $clients = getClient();
            if (!empty($clients)) {
              foreach ($clients as $value) {
                $selected = (!empty($_GET['id']) && $value['id'] == $article['id_client']) ? "selected" : "";
                echo "<option value='{$value['id']}' $selected>{$value['nom']} {$value['prenom']}</option>";
              }
            }
          ?>
        </select>

        <label for="quantite">Quantité</label>
        <input onkeyup="setPrix()" value="<?= !empty($_GET['id']) ? $article['quantite'] : "" ?>" type="number" id="quantite" name="quantite" placeholder="Saisissez la quantité" required>

        <label for="prix">Prix</label>
        <input value="<?= !empty($_GET['id']) ? $article['prix'] : "" ?>" type="number" step="0.01" id="prix" name="prix" placeholder="Saisissez le prix total" required>

        <button type="submit">Validez</button>

        <?php if (!empty($_SESSION['message'])): ?>
          <div class="alert <?= $_SESSION['message_type'] ?>">
            <?= $_SESSION['message'] ?>
            <?php unset($_SESSION['message'], $_SESSION['message_type']); ?>
          </div>
        <?php endif; ?>
      </form>
    </div>

    <!-- TABLEAU DES VENTES -->
    <div class="box scrollable-table">
      <div class="responsive-table-wrapper">
        <table class="ntable">
          <thead>
            <tr>
              <th>Article</th>
              <th>Client</th>
              <th>Quantité</th>
              <th>Prix</th>
              <th>Date</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
              $ventes = getVente();
              if (!empty($ventes)) {
                foreach ($ventes as $value) {
            ?>
              <tr>
                <td data-label="Article"><?= $value['nom_article'] ?></td>
                <td data-label="Client"><?= $value['nom'] . " " . $value['prenom'] ?></td>
                <td data-label="Quantité"><?= $value['quantite'] ?></td>
                <td data-label="Prix"><?= $value['prix'] ?></td>
                <td data-label="Date"><?= date('d/m/Y H:i:s', strtotime($value['date_vente'])) ?></td>
                <td data-label="Action">
                  <a href="recuVente.php?id=<?= $value['id'] ?>"><i class='bx bx-receipt'></i></a>
                  <a onclick="annuleVente(<?= $value['id'] ?>, <?= $value['id_article'] ?>, <?= $value['quantite'] ?>)" style="color: red;"><i class='bx bx-stop-circle'></i></a>
                </td>
              </tr>
            <?php }} ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<?php include 'pied.php'; ?>

<script>
  function annuleVente(idVente, idArticle, quantite) {
    if (confirm("Êtes-vous sûr de vouloir annuler cette vente ?")) {
      window.location.href = "../model/annuleVente.php?idVente=" + idVente + "&idArticle=" + idArticle + "&quantite=" + quantite;
    }
  }

  function setPrix() {
    const article = document.querySelector('#id_article');
    const quantite = document.querySelector('#quantite');
    const prix = document.querySelector('#prix');

    if (article && quantite && prix) {
      const prixUnitaire = article.options[article.selectedIndex].getAttribute('data-prix');
      prix.value = (Number(quantite.value) * Number(prixUnitaire)).toFixed(2);
    }
  }

  // Appel initial si article pré-sélectionné
  window.onload = setPrix;
</script>
