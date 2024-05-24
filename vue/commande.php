<?php
include 'entet.php';
if(!empty($_GET['id'])){
    $commandeManager = new CommandeManager($conn);
    $commande = $commandeManager->getCommande($_GET['id']);
}
if(!isset($_SESSION['id'])){
    header("Location: ../login/login.php");
  }
?>

<div class="home-content">
    <div class="overvie-boxes">
        <div class="overview-boxes">
            <div class="box">
                <form action="<?= !empty($_GET['id']) ? "../model/modifcommande.php" : "../model/ajoutcommande.php"?> " method="post">
                    <input value= "<?= !empty($_GET['id']) ? $article['id'] : ""?>" type="hidden" name="id" id="id">


                    <label for="id_article">Article</label>
                    <select onchange="setPrix()" name="id_article" id="id_article">
                            <?php
                                $articleManager = new ArticleManager($conn);
                                $articles = $articleManager->getArticle();
                                if (!empty($articles) && is_array($articles)){
                                    foreach ($articles as $key => $value){
                                        ?>
                                        <option data-prix="<?= $value['prix_unitaire']?>" value="<?= $value['id']?>"><?= $value['nom_article']. " - ". $value['quantite']. " disponible"?></option>
                                        <?php
                                    }
                                }

                            ?>  
                    </select>

                    <label for="id_fournisseur">Fournisseur</label>
                    <select name="id_fournisseur" id="id_fournisseur">
                            <?php
                                $fournisseurManager = new FournisseurManager($conn);
                                $fournisseurs = $fournisseurManager->getFournisseur();

                                if (!empty($fournisseurs) && is_array($fournisseurs)){
                                    foreach ($fournisseurs as $key => $value){
                                        ?>
                                        <option value="<?= $value['id']?>"><?= $value['nom']. " - ". $value['prenom']?></option>
                                        <?php
                                    }
                                }

                            ?>  
                    </select>

                    <label for="quantite">Quantité</label>
                    <input onkeyup="setPrix()" value= "<?= !empty($_GET['id']) ? $article['quantite'] : ""?>" type="number" name="quantite" id="quantite" placeholder="Veuillez saisir la quantité">

                    <label for="prix">Prix</label>
                    <input value= "<?= !empty($_GET['id']) ? $article['prix'] : ""?>"type="number" name="prix" id="prix" placeholder="Veuillez saisir le prix">

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
                        <th>Article</th>
                        <th>Fournisseur</th>
                        <th>Quantité</th>
                        <th>Prix</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                    <?php
                        $commandeManager = new CommandeManager($conn);
                        $commandes = $commandeManager->getCommande();

                        if(!empty($commandes) && is_array($commandes)){
                            foreach ($commandes as $key => $value){
                                ?>
                                <tr>
                                    <td><?= $value['nom_article']?></td>
                                    <td><?= $value['nom']. " " .$value['prenom']?></td>
                                    <td><?= $value['quantite']?></td>
                                    <td><?= $value['prix']?></td>
                                    <td><?= date('d/m/Y H:i:s', strtotime($value['date_commande'])) ?></td>
                                    <td>
                                        <a href="recuCommande.php?id=<?= $value['id']?>"><i class='bx bx-receipt'></i></a>
                                        <a onclick="annuleCommande(<?= $value['id']?>, <?= $value['idArticle']?>, <?= $value['quantite']?>)" style="color: red;"><i class='bx bx-stop-circle'></i></a>
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
<script>
    function annuleCommande(idCommande, idArticle, quantite){
        if(confirm("Voulez-vous vraiment annuler cette Commande ?")){
            window.location.href= "../model/annuleCommande.php?idCommande="+idCommande+"&idArticle="+idArticle+"&quantite="+quantite
        }
    }
    function setPrix(){
        var article = document.querySelector('#id_article');
        var quantite = document.querySelector('#quantite');
        var prix = document.querySelector('#prix');

        var prixUnitaire = article.options[article.selectedIndex].getAttribute('data-prix');

        prix.value = Number(quantite.value) * Number(prixUnitaire);
    }
</script>