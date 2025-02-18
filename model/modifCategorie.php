<?php
include 'conn.php';


if (!empty($_POST['libelle_categorie'])
    && !empty($_POST['id'])
){
    $sql = "UPDATE categorie_article SET libelle_categorie=? WHERE id=?";
    $req = $conn->prepare($sql);

    $req->execute(array(
        $_POST['libelle_categorie'],
        $_POST['id']
    ));

    if( $req->rowCount()!=0){
        $_SESSION['message']['text'] =  "categorie modifié avec succès";
        $_SESSION['message']['type'] =  "success";
    }else{
        $_SESSION['message']['text'] =  "Rien a été modifié";
        $_SESSION['message']['type'] =  "warning";
    }

}else{
    $_SESSION['message']['text'] =  "une information non saisie";
    $_SESSION['message']['type'] =  "danger";
}

header("Location: ../vue/Categorie.php");