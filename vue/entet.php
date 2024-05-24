<?php
include_once '../model/function.php';
?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="UTF-8" />
    <title>APP_Gestion 
      <?php
        echo ucfirst(str_replace('.php', '', basename($_SERVER['PHP_SELF'])));
      ?>
    </title>
    <link href="../public/css/style.css" rel="stylesheet"/>
    <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  </head>
  <body>
    <div class="sidebar hidden-print">
      <div class="logo-details">
        <i class="bx bxl-dropbox"></i>
        <span class="logo_name">APP_Gestion</span>
      </div>
      <ul class="nav-links">
        <li>
          <a href="dashboard.php" class="<?php echo  basename($_SERVER['PHP_SELF']) == "dashboard.php" ? "active" : ""?>">
            <i class="bx bxs-dashboard"></i>
            <span class="links_name">Dashboard</span>
          </a>
        </li>
        <li>
          <a href="vente.php" class="<?php echo  basename($_SERVER['PHP_SELF']) == "vente.php" ? "active" : ""?>">
          <i class='bx bx-shopping-bag'></i>
            <span class="links_name">Vente</span>
          </a>
        </li>
        <li>
          <a href="client.php" class="<?php echo  basename($_SERVER['PHP_SELF']) == "client.php" ? "active" : ""?>">
            <i class="bx bx-user"></i>
            <span class="links_name">Client</span>
          </a>
        </li>
        
        <li>
          <a href="article.php" class="<?php echo  basename($_SERVER['PHP_SELF']) == "article.php" ? "active" : ""?>">
            <i class="bx bx-box"></i>
            <span class="links_name">Article</span>
          </a>
        </li>
        <li>
          <a href="categorie.php" class="<?php echo  basename($_SERVER['PHP_SELF']) == "categorie.php" ? "active" : ""?>">
            <i class='bx bx-category-alt' ></i>
            <span class="links_name">Categorie</span>
          </a>
        </li>
        <li>
          <a href="fournisseur.php" class="<?php echo  basename($_SERVER['PHP_SELF']) == "fournisseur.php" ? "active" : ""?>">
            <i class="bx bx-user"></i>
            <span class="links_name">Fournisseur</span>
          </a>
        </li>
        <li>
          <a href="commande.php" class="<?php echo  basename($_SERVER['PHP_SELF']) == "commande.php" ? "active" : ""?>">
            <i class="bx bx-list-ul"></i>
            <span class="links_name">Commandes</span>
          </a>
        </li>
        <li>
          <a href="setting.php" class="<?php echo  basename($_SERVER['PHP_SELF']) == "setting.php" ? "active" : ""?>">
            <i class='bx bx-cog'></i>
            <span class="links_name">Setting</span>
          </a>
        </li>
        <li class="log_out">
          <form method="post">
            <i class="bx bx-log-out" style="margin-right: -20px;" ></i>
            <button style="background: #00194c; border: none; cursor:pointer;" type="submit" name="submit" class="links_name">Déconnexion</button>
            <?php
              if(isset($_POST['submit'])){  
                    session_destroy();
                    header("Location: ../login/login.php");
                  }
            ?>
          </form>
        </li>
      </ul>
    </div>
    <section class="home-section">
      <nav class="hidden-print">
        <div class="sidebar-button">
          <i class="bx bx-menu sidebarBtn"></i>
          <span class="dashboard">
            <?php
              echo ucfirst(str_replace('.php', '', basename($_SERVER['PHP_SELF'])));
            ?>    
          </span>
        </div>
        <div class="profile-details" style="background-color: #f0f0f0; padding: 10px; border: 1px solid #ccc; border-radius: 5px; margin: 10px 0;">
          <span class="admin_name" style="font-weight: bold; font-size: 18px; padding-left: 20px; text-transform: uppercase;"><?php echo $_SESSION['username'] ?></span>
        </div>
      </nav>
  </body>
</html>
<?php