<?php
include 'conn.php';

if (!empty($_POST['id'])){

    $articleId = $_POST['id'];

    $sqlVente = "DELETE FROM vente WHERE id_client = ?";
    $reqVente = $conn->prepare($sqlVente);
    $reqVente->execute(array($articleId));

    $sqlClient = "DELETE FROM client WHERE id=?";
    $reqClient = $conn->prepare($sqlClient);
    $reqClient->execute(array($articleId));

    if ($reqClient->rowCount() > 0) {
        $_SESSION['message']['text'] =  "Client supprimé avec succès.";
        $_SESSION['message']['type'] =  "success";
    }else{
        $_SESSION['message']['text'] =  "Échec de la suppression du client.";
        $_SESSION['message']['type'] =  "danger";
    }
}
header('Location: ../vue/client.php');