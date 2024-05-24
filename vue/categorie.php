<?php
include 'entet.php';
if(!empty($_GET['id'])){
    $categorieManager = new CategorieManager($conn);
    $categorie = $categorieManager->getCategorie($_GET['id']);
}
if(!isset($_SESSION['id'])){
    header("Location: ../login/login.php");
  }
?>

<div class="home-content">
    <div class="overvie-boxes">
        <div class="overview-boxes">
            <div class="box">
                <form action="<?= !empty($_GET['id']) ? "../model/modifCategorie.php" : "../model/ajoutCategorie.php"?> " method="post">
                    <label for="libelle_categorie">Categorie</label>
                    <input value= "<?= !empty($_GET['id']) ? $categorie['libelle_categorie'] : ""?>" type="text" name="libelle_categorie" id="libelle_categorie" placeholder="Veuillez saisire la categorie">
                    <input value= "<?= !empty($_GET['id']) ? $categorie['id'] : ""?>" type="hidden" name="id" id="id">

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
                        <th>Categorie</th>
                        <th>Action</th>
                    </tr>
                    <?php
                        $categorieManager = new CategorieManager($conn);
                        $categories = $categorieManager->getCategorie();

                        if(!empty($categories) && is_array($categories)){
                            foreach ($categories as $key => $value){
                                ?>
                                <tr>
                                    <td><?= $value['libelle_categorie']?></td>
                                    <td>
                                        <div style="display: flex; justify-content: center; align-items: center;">
                                            <a href="?id=<?= $value['id'] ?>"><i class='bx bxs-edit-alt'></i></a>
                                            <form action="../model/deleteCategorie.php" method="post">
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