<?php
include 'conn.php';


if (!empty($_POST['nom']) 
    && !empty($_POST['prenom']) 
    && !empty($_POST['telephone']) 
    && !empty($_POST['adresse'])
    && !empty($_POST['id'])
){
    $sql = "UPDATE fournisseur SET nom=?, prenom=?, telephone=?, adresse=? WHERE id=?";
    $req = $conn->prepare($sql);

    $req->execute(array(
        $_POST['nom'],
        $_POST['prenom'],
        $_POST['telephone'],
        $_POST['adresse'],
        $_POST['id']
    ));

    if( $req->rowCount()!=0){
        $_SESSION['message']['text'] =  "Fournisseur modifié avec succès";
        $_SESSION['message']['type'] =  "success";
    }else{
        $_SESSION['message']['text'] =  "Rien a été modifié";
        $_SESSION['message']['type'] =  "warning";
    }

}else{
    $_SESSION['message']['text'] =  "une information non saisie";
    $_SESSION['message']['type'] =  "danger";
}

header("Location: ../vue/fournisseur.php");