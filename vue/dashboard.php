<?php
// Inclure l'en-tête si nécessaire
// include 'config.php';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Ma Bibliothèque</title>
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="sidebar">
        <div class="logo-details">
            <i class='bx bxl-c-plus-plus'></i>
            <span class="logo_name">Ma bibliothèque</span>
        </div>
        <ul class="nav-links">
            <li data-tooltip="Dashboard">
                <a href="index.php" class="active">
                    <i class='bx bx-grid-alt'></i>
                    <span class="links_name">Dashboard</span>
                </a>
            </li>
            <li data-tooltip="Commandes">
                <a href="commandes.php">
                    <i class='bx bx-cart-alt'></i>
                    <span class="links_name">Commandes</span>
                </a>
            </li>
            <li data-tooltip="Ventes">
                <a href="ventes.php">
                    <i class='bx bxs-cart-add'></i>
                    <span class="links_name">Ventes</span>
                </a>
            </li>
            <li data-tooltip="Articles">
                <a href="articles.php">
                    <i class='bx bx-box'></i>
                    <span class="links_name">Articles</span>
                </a>
            </li>
            <li data-tooltip="Clients">
                <a href="clients.php">
                    <i class='bx bx-user'></i>
                    <span class="links_name">Clients</span>
                </a>
            </li>
            <li data-tooltip="Rapports">
                <a href="rapports.php">
                    <i class='bx bx-pie-chart-alt-2'></i>
                    <span class="links_name">Rapports</span>
                </a>
            </li>
            <li data-tooltip="Paramètres">
                <a href="parametres.php">
                    <i class='bx bx-cog'></i>
                    <span class="links_name">Paramètres</span>
                </a>
            </li>
            <li class="log_out" data-tooltip="Déconnexion">
                <a href="logout.php">
                    <i class='bx bx-log-out'></i>
                    <span class="links_name">Déconnexion</span>
                </a>
            </li>
        </ul>
    </div>

    <section class="home-section">
        <nav>
            <div class="sidebar-button">
                <i class='bx bx-menu'></i>
                <span class="dashboard">Dashboard</span>
            </div>
            <div class="search-box">
                <input type="text" placeholder="Rechercher...">
                <i class='bx bx-search'></i>
            </div>
            <div class="profile-details">
                <img src="https://via.placeholder.com/40" alt="Profile">
                <span class="admin_name"><?php echo isset($_SESSION['user_name']) ? $_SESSION['user_name'] : 'Admin'; ?></span>
                <i class='bx bx-chevron-down'></i>
            </div>
        </nav>

        <div class="home-content">
            <div class="overview-boxes">
                <div class="box">
                    <div class="right-side">
                        <div class="box-topic">Commandes</div>
                        <div class="number"><?php echo isset($commandes_count) ? $commandes_count : getAllCommande()['nbre']; ?></div>
                        <div class="indicator">
                            <i class="bx bx-up-arrow-alt"></i>
                            <span class="text">Depuis hier</span>
                        </div>
                    </div>
                    <i class="bx bx-cart-alt cart"></i>
                </div>
                <div class="box">
                    <div class="right-side">
                        <div class="box-topic">Ventes</div>
                        <div class="number"><?php echo isset($ventes_count) ? $ventes_count : getAllVente()['nbre']; ?></div>
                        <div class="indicator">
                            <i class="bx bx-up-arrow-alt"></i>
                            <span class="text">Depuis hier</span>
                        </div>
                    </div>
                    <i class="bx bxs-cart-add cart two"></i>
                </div>
                <div class="box">
                    <div class="right-side">
                        <div class="box-topic">Articles</div>
                        <div class="number"><?php echo isset($articles_count) ? $articles_count : getAllArticle()['nbre']; ?></div>
                        <div class="indicator">
                            <i class="bx bx-up-arrow-alt"></i>
                            <span class="text">Cette semaine</span>
                        </div>
                    </div>
                    <i class="bx bx-cart cart three"></i>
                </div>
                <div class="box">
                    <div class="right-side">
                        <div class="box-topic">Recettes</div>
                        <div class="number"><?php echo isset($recettes_total) ? $recettes_total . '€' : getAllRecette()['prix'] . '€'; ?></div>
                        <div class="indicator">
                            <i class="bx bx-down-arrow-alt down"></i>
                            <span class="text">Aujourd'hui</span>
                        </div>
                    </div>
                    <i class="bx bxs-cart-download cart four"></i>
                </div>
            </div>

            <div class="sales-boxes">
                <div class="recent-sales box">
                    <div class="title">Ventes récentes</div>
                    <?php 
                    $ventes = isset($recent_ventes) ? $recent_ventes : getLastVente();
                    ?>
                    <div class="sales-details">
                        <ul class="details">
                            <li class="topic">Date</li>
                            <?php 
                            foreach ($ventes as $key => $value) { 
                                ?>
                                <li><a href="#"><?php echo date('d M Y', strtotime($value['date_vente'])); ?></a></li>
                                <?php
                            }
                            ?>
                        </ul>
                        <ul class="details">
                            <li class="topic">Clients</li>
                            <?php 
                            foreach ($ventes as $key => $value) { 
                                ?>
                                <li><a href="#"><?php echo $value['nom'] . " " . $value['prenom']; ?></a></li>
                                <?php
                            }
                            ?>
                        </ul>
                        <ul class="details">
                            <li class="topic">Article</li>
                            <?php 
                            foreach ($ventes as $key => $value) { 
                                ?>
                                <li><a href="#"><?php echo $value['nom_article']; ?></a></li>
                                <?php
                            }
                            ?>
                        </ul>
                        <ul class="details">
                            <li class="topic">Prix</li>
                            <?php 
                            foreach ($ventes as $key => $value) { 
                                ?>
                                <li><a href="#"><?php echo $value['prix'] . "€"; ?></a></li>
                                <?php
                            }
                            ?>
                        </ul>
                    </div>
                    <div class="button">
                        <a href="ventes.php">Voir tout</a>
                    </div>
                </div>
                <div class="top-sales box">
                    <div class="title">Articles les plus vendus</div>
                    <ul class="top-sales-details">
                        <?php 
                        $articles = isset($top_articles) ? $top_articles : getMostVente();
                        foreach ($articles as $key => $value) {
                            ?>
                            <li>
                                <a href="#">
                                    <span class="product"><?php echo $value['nom_article']; ?></span>
                                </a>
                                <span class="price"><?php echo $value['total_vente'] . "€"; ?></span>
                            </li>
                            <?php
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </section>

<?php
// Inclure le pied de page si nécessaire
// include 'footer.php';
?>
</body>
</html>