<?php
include 'conn.php';

if (!empty($_POST['nom_article']) 
    && !empty($_POST['id_categorie']) 
    && !empty($_POST['quantite']) 
    && !empty($_POST['prix_unitaire']) 
    && !empty($_POST['date_expiration']) 
    && !empty($_POST['date_fabrication'])
){
    $sql = "INSERT INTO article(nom_article, id_categorie, quantite, prix_unitaire, date_expiration, date_fabrication)
    VALUES (?, ?, ?, ?, ?, ?)";
    $req = $conn->prepare($sql);

    $req->execute(array(
        $_POST['nom_article'],
        $_POST['id_categorie'],
        $_POST['quantite'],
        $_POST['prix_unitaire'],
        $_POST['date_expiration'],
        $_POST['date_fabrication']
    ));

    if( $req->rowCount()!=0){
        $_SESSION['message']['text'] =  "article ajouté avec succès";
        $_SESSION['message']['type'] =  "success";
    }else{
        $_SESSION['message']['text'] =  "Une erreur s'est produite lors de l'ajout de l'article";
        $_SESSION['message']['type'] =  "danger";
    }

}else{
    $_SESSION['message']['text'] =  "une information non saisie";
    $_SESSION['message']['type'] =  "danger";
}

header("Location: ../vue/article.php");