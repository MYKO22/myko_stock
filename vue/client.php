<?php 
session_start();
include 'entete.php';

if (!empty($_GET['id'])) {
    $client = getClient($_GET['id']);
}
?>

<div class="home-content">
    <div class="overview-boxes">
        <div class="box">
            <form action="<?= !empty($_GET['id']) ? '../model/modifClient.php' : '../model/ajoutClient.php' ?>" method="post">
                <label for="nom">Nom</label>
                <input type="text" id="nom" name="nom" placeholder="Saisissez le nom" 
                       value="<?= !empty($client) ? $client['nom'] : '' ?>" required>

                <input type="hidden" name="id" value="<?= !empty($client) ? $client['id'] : '' ?>">

                <label for="prenom">Prénom</label>
                <input type="text" id="prenom" name="prenom" placeholder="Saisissez le prénom" 
                       value="<?= !empty($client) ? $client['prenom'] : '' ?>" required>

                <label for="telephone">Téléphone</label>
                <input type="text" id="telephone" name="telephone" placeholder="Saisissez le numéro de téléphone" 
                       value="<?= !empty($client) ? $client['telephone'] : '' ?>" required>

                <label for="adresse">Adresse</label>
                <input type="text" id="adresse" name="adresse" placeholder="Saisissez l'adresse" 
                       value="<?= !empty($client) ? $client['adresse'] : '' ?>" required>

                <button type="submit">Validez</button>

                <?php if (!empty($_SESSION['message'])): ?>
                    <div class="alert <?= $_SESSION['message_type'] ?>">
                        <?= $_SESSION['message'] ?>
                    </div>
                    <?php
                        unset($_SESSION['message']);
                        unset($_SESSION['message_type']);
                    ?>
                <?php endif; ?>
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
                    $clients = getClient();

                    if (!empty($clients) && is_array($clients)) {
                        foreach ($clients as $value):
                    ?>
                    <tr>
                        <td><?= htmlspecialchars($value['nom']) ?></td>
                        <td><?= htmlspecialchars($value['prenom']) ?></td>
                        <td><?= htmlspecialchars($value['telephone']) ?></td>
                        <td><?= htmlspecialchars($value['adresse']) ?></td>
                        <td>
                            <a href="?id=<?= $value['id'] ?>"><i class='bx bx-edit-alt'></i></a>
                            <!-- Tu peux ajouter ici un bouton de suppression plus tard -->
                        </td>
                    </tr>
                    <?php
                        endforeach;
                    } else {
                        echo "<tr><td colspan='5'>Aucun client trouvé.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</section>

<?php include 'pied.php'; ?>