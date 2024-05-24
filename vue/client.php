<?php
include 'entet.php';
if(!empty($_GET['id'])){
    $clientManager = new ClientManager($conn);
    $client = $clientManager->getClient($_GET['id']);
}
?>

<div class="home-content">
    <div class="overvie-boxes">
        <div class="overview-boxes">
            <div class="box">
                <form action="<?= !empty($_GET['id']) ? "../model/modifclient.php" : "../model/ajoutclient.php"?> " method="post">
                    <label for="nom">Nom</label>
                    <input value= "<?= !empty($_GET['id']) ? $client['nom'] : ""?>" type="text" name="nom" id="nom" placeholder="Veuillez saisire le nom">
                    <input value= "<?= !empty($_GET['id']) ? $client['id'] : ""?>" type="hidden" name="id" id="id">

                    <label for="prenom">Prénom</label>
                    <input value= "<?= !empty($_GET['id']) ? $client['prenom'] : ""?>" type="text" name="prenom" id="prenom" placeholder="Veuillez saisire le prenom">

                    <label for="telephone">N° de téléphone</label>
                    <input value= "<?= !empty($_GET['id']) ? $client['telephone'] : ""?>" type="text" name="telephone" id="telephone" placeholder="Veuillez saisir le N° de téléphone">

                    <label for="adresse">Adresse</label>
                    <input value= "<?= !empty($_GET['id']) ? $client['adresse'] : ""?>" type="text" name="adresse" id="adresse" placeholder="Veuillez saisir l'adresse">

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
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Téléphone</th>
                        <th>Adresse</th>
                        <th>Action</th>
                    </tr>
                    <?php
                        $clientManager = new ClientManager($conn);
                        $clients = $clientManager->getClient();

                        if(!empty($clients) && is_array($clients)){
                            foreach ($clients as $key => $value){
                                ?>
                                <tr>
                                    <td><?= $value['nom']?></td>
                                    <td><?= $value['prenom']?></td>
                                    <td><?= $value['telephone']?></td>
                                    <td><?= $value['adresse']?></td>
                                    <td>
                                        <div style="display: flex; justify-content: center; align-items: center;">
                                            <a href="?id=<?= $value['id'] ?>"><i class='bx bxs-edit-alt'></i></a>
                                            <form action="../model/deleteClient.php" method="post">
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