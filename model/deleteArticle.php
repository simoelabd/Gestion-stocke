<?php
include 'conn.php';

if (!empty($_POST['id'])) {
    $articleId = $_POST['id'];

    $sqlCommande = "DELETE FROM commande WHERE id_article = ?";
    $reqCommande = $conn->prepare($sqlCommande);
    $reqCommande->execute(array($articleId));

    $sqlVente = "DELETE FROM vente WHERE id_article = ?";
    $reqVente = $conn->prepare($sqlVente);
    $reqVente->execute(array($articleId));

    $sqlArticle = "DELETE FROM article WHERE id=?";
    $reqArticle = $conn->prepare($sqlArticle);
    $reqArticle->execute(array($articleId));

    if ($reqArticle->rowCount() > 0) {
        $_SESSION['message']['text'] =  "Article supprimé avec succès.";
        $_SESSION['message']['type'] =  "success";
    } else {
        $_SESSION['message']['text'] =  "Échec de la suppression de l'article.";
        $_SESSION['message']['type'] =  "danger";
    }
}

header('Location: ../vue/article.php');