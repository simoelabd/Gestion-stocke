<?php
include 'conn.php';
include_once 'function.php';

if (!empty($_POST['id_article']) 
    && !empty($_POST['id_client']) 
    && !empty($_POST['quantite']) 
    && !empty($_POST['prix'])
){
    $articleManager = new ArticleManager($conn);
    $article = $articleManager->getArticle($_POST['id_article']);
    if (!empty($article) && is_array($article)){
        if ($_POST['quantite']>$article['quantite']){
            $_SESSION['message']['text'] =  "La quantité à vendre n'est pas disponible";
            $_SESSION['message']['type'] =  "danger";
        }else{
            $sql = "INSERT INTO vente(id_article, id_client, quantite, prix)
            VALUES (?, ?, ?, ?)";
            $req = $conn->prepare($sql);
        
            $req->execute(array(
                $_POST['id_article'],
                $_POST['id_client'],
                $_POST['quantite'],
                $_POST['prix']
            ));
        
            if($req->rowCount()!=0){

                $sql = "UPDATE article SET quantite=quantite-? WHERE id=?";
                $req = $conn->prepare($sql);
        
                $req->execute(array(
                    $_POST['quantite'],
                    $_POST['id_article'],
                ));

                if ($req->rowCount()!=0){
                    $_SESSION['message']['text'] =  "Vente effectué avec succès";
                    $_SESSION['message']['type'] =  "success";
                }else{
                    $_SESSION['message']['text'] =  "Impossible de faire cette vente";
                    $_SESSION['message']['type'] =  "danger";
                }
            }else{
                $_SESSION['message']['text'] =  "Une erreur s'est produite lors de l'acréation du vente";
                $_SESSION['message']['type'] =  "danger";
            }
        }
    }
}else{
    $_SESSION['message']['text'] =  "une information non saisie";
    $_SESSION['message']['type'] =  "danger";
}

header("Location: ../vue/vente.php");