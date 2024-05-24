<?php
include 'conn.php';

if(!empty($_GET['idCommande']) &&
    !empty($_GET['idArticle']) &&
    !empty($_GET['quantite'])
){
    $sql = "DELETE FROM commande WHERE id=?";
    $req = $conn->prepare($sql);
    $req->execute(array($_GET['idCommande']));

    if( $req->rowCount()!=0){
        $sql = "UPDATE article SET quantite=quantite-? WHERE id=?";
        $req = $conn->prepare($sql);
        $req->execute(array($_GET['quantite'], $_GET['idArticle']));
    }
}
header('Location: ../vue/commande.php');