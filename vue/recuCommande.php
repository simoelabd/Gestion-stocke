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

            <button class="hidden-print" id="btnPrint" style="position: relative; left: 45%;"> <i class='bx bx-printer'></i> Imprimer</button>

        <div class="page">
            <div class="cote-a-cote">
                <h2><i class="bx bxl-dropbox"></i> APP_Gestion</h2>
                <div>
                    <p>Reçu Commande N° #: <?= $commande['id']?></p>
                    <p>Date: <?= date('d/m/Y H:i:s', strtotime($commande['date_commande'])) ?></p>
                </div>
            </div>
            <div class="cote-a-cote" style="width: 50%;">
                <p>Nom : </p>
                <p><?= $commande['nom']. " " .$commande['prenom']?></p>
            </div>
            <div class="cote-a-cote" style="width: 50%;">
                <p>Telephone : </p>
                <p><?= $commande['telephone']?></p>
            </div>
            <div class="cote-a-cote" style="width: 50%;">
                <p>Adresse : </p>
                <p><?= $commande['adresse']?></p>
            </div>

            <br>
            <br>

            <table class="mtable">
                <tr>
                    <th>Designation</th>
                    <th>Quantité</th>
                    <th>Prix unitaire</th>
                    <th>Prix total</th>
                </tr>
                <tr>
                    <td><?= $commande['nom_article']?></td>
                    <td><?= $commande['quantite']?></td>
                    <td><?= $commande['prix_unitaire']?></td>
                    <td><?= $commande['prix']?></td>
                </tr>
            </table>
        </div>
    </div>
<?php
include 'pied.php';
?>
<script>
    
    var btnPrint = document.querySelector('#btnPrint');
    btnPrint.addEventListener("click", () => {
        window.print();
    });


    function setPrix(){
        var article = document.querySelector('#id_article');
        var quantite = document.querySelector('#quantite');
        var prix = document.querySelector('#prix');

        var prixUnitaire = article.options[article.selectedIndex].getAttribute('data-prix');

        prix.value = Number(quantite.value) * Number(prixUnitaire);
    }
</script>