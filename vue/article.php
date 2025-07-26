<?php
session_start();
include 'entete.php';

if (!empty($_GET['id'])) {
    $article = getArticle($_GET['id']);
}
?>

<div class="home-content">
  <div class="overview-boxes">
    <!-- FORMULAIRE -->
    <div class="box">
      <form action="<?= !empty($_GET['id']) ? "../model/modifArticle.php" : "../model/ajoutArticle.php" ?>" method="post" enctype="multipart/form-data">
        <input value="<?= !empty($article) ? $article['id'] : "" ?>" type="hidden" name="id" />

        <label for="nom_article">Nom de l'article</label>
        <input type="text" name="nom_article" id="nom_article" placeholder="Saisissez le nom" value="<?= !empty($article) ? $article['nom_article'] : "" ?>" />

        <label for="id_categorie">Catégorie</label>
        <select name="id_categorie" id="id_categorie">
          <option value="">-- Choisir une catégorie --</option>
          <?php
          $categories = getCategorie();
          foreach ($categories as $cat) {
            $selected = !empty($article) && $article['id_categorie'] == $cat['id'] ? "selected" : "";
            echo "<option value='{$cat['id']}' $selected>{$cat['libelle_categorie']}</option>";
          }
          ?>
        </select>

        <label for="quantite">Quantité</label>
        <input type="number" name="quantite" id="quantite" placeholder="Saisissez la quantité" value="<?= !empty($article) ? $article['quantite'] : "" ?>" />

        <label for="prix_unitaire">Prix unitaire</label>
        <input type="text" name="prix_unitaire" id="prix_unitaire" placeholder="Saisissez le prix unitaire" value="<?= !empty($article) ? $article['prix_unitaire'] : "" ?>" />

        <label for="mise_en_ligne">Mise en ligne</label>
        <input type="datetime-local" name="mise_en_ligne" id="mise_en_ligne" value="<?= !empty($article) ? date('Y-m-d\TH:i', strtotime($article['mise_en_ligne'])) : "" ?>" />

        <label for="image">Image</label>
        <input type="file" name="image" id="image" />

        <button type="submit">Validez</button>

        <?php if (!empty($_SESSION['message'])): ?>
          <div class="alert <?= $_SESSION['message_type'] ?>">
            <?= $_SESSION['message'] ?>
          </div>
          <?php unset($_SESSION['message'], $_SESSION['message_type']); ?>
        <?php endif; ?>
      </form>
    </div>

    <!-- TABLEAU -->
    <div class="box" style="overflow-x: auto;">
      <table class="ntable">
        <thead>
          <tr>
            <th>Nom de l'article</th>
            <th>Catégorie</th>
            <th>Quantité</th>
            <th>Prix unitaire</th>
            <th>Mise en ligne</th>
            <th>Image</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $articles = getArticle();
          if (!empty($articles)) {
            foreach ($articles as $a) {
              echo "<tr>";
              echo "<td>{$a['nom_article']}</td>";
              echo "<td>{$a['libelle_categorie']}</td>";
              echo "<td>{$a['quantite']}</td>";
              echo "<td>{$a['prix_unitaire']}</td>";
              echo "<td>" . date('d/m/Y H:i', strtotime($a['mise_en_ligne'])) . "</td>";
              echo "<td><img src='../uploads/{$a['image']}' width='50' height='50' style='object-fit: cover; border-radius: 5px;'></td>";
              echo "<td><a href='?id={$a['id']}'><i class='bx bx-edit'></i></a></td>";
              echo "</tr>";
            }
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<?php include 'pied.php'; ?>
