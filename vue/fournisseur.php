<?php 
session_start();
include 'entete.php';

if (!empty($_GET['id'])) {
    $fournisseur = getFournisseur($_GET['id']);
}
?>

<div class="home-content">
    <div class="overview-boxes">
        <div class="box">
            <?php if (!empty($_SESSION['message'])): ?>
                <div class="alert <?= $_SESSION['message_type'] ?>">
                    <?= $_SESSION['message'] ?>
                </div>
                <?php unset($_SESSION['message'], $_SESSION['message_type']); ?>
            <?php endif; ?>

            <form action="<?= !empty($_GET['id']) ? '../model/modifFournisseur.php' : '../model/ajoutFournisseur.php' ?>" method="post">
                <label for="nom">Nom</label>
                <input type="text" id="nom" name="nom" placeholder="Saisissez le nom" 
                       value="<?= !empty($fournisseur) ? $fournisseur['nom'] : '' ?>" required>

                <input type="hidden" name="id" value="<?= !empty($fournisseur) ? $fournisseur['id'] : '' ?>">

                <label for="prenom">Prénom</label>
                <input type="text" id="prenom" name="prenom" placeholder="Saisissez le prénom" 
                       value="<?= !empty($fournisseur) ? $fournisseur['prenom'] : '' ?>" required>

                <label for="telephone">Téléphone</label>
                <input type="text" id="telephone" name="telephone" placeholder="Saisissez le numéro de téléphone" 
                       value="<?= !empty($fournisseur) ? $fournisseur['telephone'] : '' ?>" required>

                <label for="adresse">Adresse</label>
                <input type="text" id="adresse" name="adresse" placeholder="Saisissez l'adresse" 
                       value="<?= !empty($fournisseur) ? $fournisseur['adresse'] : '' ?>" required>

                <button type="submit">Validez</button>
            </form>
        </div>

        <div class="box">
            <table class="ntable">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Téléphone</th>
                        <th>Adresse</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $fournisseurs = getFournisseur();

                    if (!empty($fournisseurs) && is_array($fournisseurs)) {
                        foreach ($fournisseurs as $value):
                    ?>
                    <tr>
                        <td><?= htmlspecialchars($value['nom']) ?></td>
                        <td><?= htmlspecialchars($value['prenom']) ?></td>
                        <td><?= htmlspecialchars($value['telephone']) ?></td>
                        <td><?= htmlspecialchars($value['adresse']) ?></td>
                        <td>
                            <a href="?id=<?= $value['id'] ?>"><i class='bx bx-edit-alt'></i></a>
                        </td>
                    </tr>
                    <?php
                        endforeach;
                    } else {
                        echo "<tr><td colspan='5'>Aucun fournisseur trouvé.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</section>

<?php include 'pied.php'; ?>