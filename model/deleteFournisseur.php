<?php
include 'conn.php';

if (!empty($_POST['id'])){

    $articleId = $_POST['id'];

    $sqlVente = "DELETE FROM commande WHERE id_fournisseur = ?";
    $reqVente = $conn->prepare($sqlVente);
    $reqVente->execute(array($articleId));

    $sqlFournisseur = "DELETE FROM fournisseur WHERE id=?";
    $reqFournisseur = $conn->prepare($sqlFournisseur);
    $reqFournisseur->execute(array($articleId));

    if ($reqFournisseur->rowCount() > 0) {
        $_SESSION['message']['text'] =  "Fournisseur supprimé avec succès.";
        $_SESSION['message']['type'] =  "success";
    }else{
        $_SESSION['message']['text'] =  "Échec de la suppression du fournisseur.";
        $_SESSION['message']['type'] =  "danger";
    }
}
header('Location: ../vue/fournisseur.php');