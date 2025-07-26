<?php
session_start();
include 'entete.php';

if (!empty($_GET['id'])) {
    $categorie = getCategorie($_GET['id']);
}
?>

<div class="home-content">
    <div class="overview-boxes">
        <div class="box">
            <form action="<?= !empty($_GET['id']) ? "../model/modifCategorie.php" : "../model/ajoutCategorie.php" ?>" method="post">
                <label for="libelle_categorie">Libelle</label>
                <input value="<?= !empty($categorie) && is_array($categorie) ? $categorie['libelle_categorie'] : "" ?>" type="text" id="libelle_categorie" name="libelle_categorie" placeholder="Saisissez le nom">
                <input value="<?= !empty($categorie) && is_array($categorie) ? $categorie['id'] : "" ?>" type="hidden" id="id" name="id">
                <button type="submit">Validez</button>
                <?php 
                if (!empty($_SESSION['message'])) {
                    echo "<div class='alert {$_SESSION['message_type']}'>{$_SESSION['message']}</div>";
                    unset($_SESSION['message']);
                    unset($_SESSION['message_type']);
                }
                ?>
            </form>

        </div>

        <div class="box">
            <table class="ntable">
                <tr>
                    <th>Libelle</th>
                    <th>Action</th>
                </tr>
                <?php
                $categories = getCategorie();

                if (!empty($categories) && is_array($categories)) {
                    foreach ($categories as $value) {
                ?>
                <tr>
                    <td><?= $value['libelle_categorie'] ?></td>
                    <td><a href="?id=<?= $value['id'] ?>"><i class='bx bx-edit-alt'></i></a></td>
                </tr>
                <?php
                    }
                }
                ?>
            </table>
        </div>
    </div>
</div>

<?php include 'pied.php'; ?>