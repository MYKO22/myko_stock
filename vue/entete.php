<?php
include_once '../model/function.php';
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">

  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
      <?php
      echo ucfirst(str_replace(".php", "", basename($_SERVER['PHP_SELF'])));
      ?>
    </title>
    <link rel="stylesheet" href="../public/css/style.css" />
    <!-- Boxicons CDN Link -->
    <link
      href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css"
      rel="stylesheet"
    />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  </head>

  <body>

    <div class="sidebar hidden-print">
      <div class="logo-details">
        <i class="bx bxl-medium-old"></i>  
        <span class="logo_name">M-STOCK</span>
      </div>
      <ul class="nav-links">
        <li>
          <a href="dashboard.php" class="<?php basename($_SERVER['PHP_SELF'])=="dashboard.php" ? "active" : "" ?> ">
            <i class="bx bx-grid-alt"></i>
            <span class="links_name">Dashboard</span>
          </a>
        </li>
        <li>
          <a href="vente.php" class="<?php basename($_SERVER['PHP_SELF'])=="vente.php" ? "active" : "" ?> ">
            <i class='bx  bx-shopping-bag'  ></i> 
            <span class="links_name">Vente</span>
          </a>
        </li>
        <li>
          <a href="client.php" class="<?php basename($_SERVER['PHP_SELF'])=="client.php" ? "active" : "" ?> ">
            <i class="bx bx-user"></i>
            <span class="links_name">Client</span>
          </a>
        </li>
        <li>
          <a href="article.php" class="<?php basename($_SERVER['PHP_SELF'])=="article.php" ? "active" : "" ?> ">
            <i class="bx bx-box"></i>
            <span class="links_name">Article(s)</span>
          </a>
        </li>

        <!--<li>
          <a href="fournisseur.php" class="<?php basename($_SERVER['PHP_SELF'])=="fournisseur.php" ? "active" : "" ?> ">
            <i class="bx bx-user"></i>
            <span class="links_name">Fournisseur</span>
          </a>
        </li>-->
        <li>
          <a href="commande.php" class="<?php basename($_SERVER['PHP_SELF'])=="commande.php" ? "active" : "" ?> ">
            <i class="bx bx-list-ul"></i>
            <span class="links_name">Commandes</span>
          </a>
        </li>
        <li>
          <a href="categorie.php" class="<?php basename($_SERVER['PHP_SELF'])=="categorie.php" ? "active" : "" ?> ">
            <i class="bx bx-category"></i>
            <span class="links_name">Catégorie</span>
          </a>
        </li>
        <!--<li>
          <a href="#" class="<?php basename($_SERVER['PHP_SELF'])=="stock.php" ? "active" : "" ?> ">
            <i class="bx bx-coin-stack"></i>
            <span class="links_name">Stock</span>
          </a>
        </li>
        <li>
          <a href="#" class="<?php basename($_SERVER['PHP_SELF'])=="toutes_commandes.php" ? "active" : "" ?> ">
            <i class="bx bx-book-alt"></i>
            <span class="links_name">Tout les commmandes</span>
          </a>
        </li>
        <li>
          <a href="#" class="<?php basename($_SERVER['PHP_SELF'])=="utilisateur.php" ? "active" : "" ?> ">
            <i class="bx bx-user"></i>
            <span class="links_name">Utilisateur</span>
          </a>
        </li>
        <li>
          <a href="#">
            <i class="bx bx-message" ></i>
            <span class="links_name">Messages</span>
          </a>
        </li>
        <li>
          <a href="#">
            <i class="bx bx-heart" ></i>
            <span class="links_name">Favrorites</span>
          </a>
        </li> -->
        <!--<li>
          <a href="#" class="<?php basename($_SERVER['PHP_SELF'])=="configuration.php" ? "active" : "" ?> ">
            <i class="bx bx-cog"></i>
            <span class="links_name">Configuration</span>
          </a>
        </li>
        
      </ul> -->
    </div>
    <section class="home-section">
      <nav class="hidden-print">
        <div class="sidebar-button">
          <i class="bx bx-menu sidebarBtn"></i>
          <span class="dashboard">
            <?php
            echo ucfirst(str_replace(".php", "", basename($_SERVER['PHP_SELF'])));
            ?>
          </span>
        </div> 
      </nav>
