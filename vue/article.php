<?php
include 'entet.php';
if(!empty($_GET['id'])){
    $articleManager = new ArticleManager($conn);
    $article = $articleManager->getArticle($_GET['id']);
}
if(!isset($_SESSION['id'])){
  header("Location: ../login/login.php");
}
?>

<div class="home-content">
    <div class="overvie-boxes">
        <div class="overview-boxes">
            <div class="box">
                <form action="<?= !empty($_GET['id']) ? "../model/modifArticle.php" : "../model/ajoutArticle.php"?> " method="post">
                    <label for="nom_article">Nom de l'article</label>
                    <input value= "<?= !empty($_GET['id']) ? $article['nom_article'] : ""?>" type="text" name="nom_article" id="nom_article" placeholder="Veuillez saisire le nom">
                    <input value= "<?= !empty($_GET['id']) ? $article['id'] : ""?>" type="hidden" name="id" id="id">


                    <label for="id_categorie">Catégorie</label>
                    <select name="id_categorie" id="id_categorie">
                            <?php
                                $categorieManager = new CategorieManager($conn);
                                $categories = $categorieManager->getCategorie();
                                if(!empty($categories) && is_array($categories)){
                                    foreach($categories as $key => $value){
                                    ?>
                                        <option <?= !empty($_GET['id']) && $article['id_categorie']== $value['id'] ? "selected" : ""?> value="<?= $value['id']?>"><?= $value['libelle_categorie']?></option>
                                    <?php  
                                    }
                                }
                            ?>
                    </select>

                    <label for="quantite">Quantité</label>
                    <input value= "<?= !empty($_GET['id']) ? $article['quantite'] : ""?>" type="number" name="quantite" id="quantite" placeholder="Veuillez saisir la quantité">

                    <label for="prix_unitaire">Prix unitaire</label>
                    <input value= "<?= !empty($_GET['id']) ? $article['prix_unitaire'] : ""?>"type="number" name="prix_unitaire" id="prix_unitaire" placeholder="Veuillez saisir le prix">

                    <label for="date_expiration">Date d'expiration</label>
                    <input value= "<?= !empty($_GET['id']) ? $article['date_expiration'] : ""?>"type="datetime-local" name="date_expiration" id="date_expiration">

                    <label for="date_fabrication">Date de fabrication</label>
                    <input value= "<?= !empty($_GET['id']) ? $article['date_fabrication'] : ""?>"type="datetime-local" name="date_fabrication" id="date_fabrication">

                    <button type="submit">Valider</button>

                    <?php
                    if(!empty($_SESSION['message']['text'])){
                    ?>
                        <div class="alert <?=$_SESSION['message']['type']?>">
                            <?=$_SESSION['message']['text']?>
                        </div>
                        <?php
                    }
                    ?>

                </form>
            </div>
            <div class="box">
              <table class="mtable">
                    <tr>
                        <th>Nom article</th>
                        <th>Catégorie</th>
                        <th>Quantité</th>
                        <th>Prix unitaire</th>
                        <th>Date expiration</th>
                        <th>Date fabrication</th>
                        <th>Action</th>
                    </tr>
                    <?php
                        $articleManager = new ArticleManager($conn);
                        $articles = $articleManager->getArticle();

                        if(!empty($articles) && is_array($articles)){
                            foreach ($articles as $key => $value){
                                ?>
                                <tr>
                                    <td><?= $value['nom_article']?></td>
                                    <td><?= $value['libelle_categorie']?></td>
                                    <td><?= $value['quantite']?></td>
                                    <td><?= $value['prix_unitaire']?></td>
                                    <td><?= date('d/m/Y H:i:s', strtotime($value['date_expiration'])) ?></td>
                                    <td><?= date('d/m/Y H:i:s', strtotime($value['date_fabrication'])) ?></td>
                                    <td>
                                        <div style="display: flex; justify-content: center; align-items: center;">
                                            <a href="?id=<?= $value['id'] ?>"><i class='bx bxs-edit-alt'></i></a>
                                            <form action="../model/deleteArticle.php" method="post">
                                                <input type="hidden" name="id" value="<?= $value['id'] ?>">
                                                    <button type="submit" style="color: red; background: none; border: none; cursor: pointer; font-size: 1rem; width: 20px; height: 20px;"><i class='bx bx-stop-circle'></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                    ?>
              </table>
            </div>  
        </div>
    </div>
</div>

<?php
include 'pied.php';
?>