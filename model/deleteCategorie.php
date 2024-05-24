<?php
include 'conn.php';

if (!empty($_POST['id'])) {
    $categoryId = $_POST['id'];
    
    $sqlDeleteCategory = "DELETE FROM categorie_article WHERE id=?";
    $reqDeleteCategory = $conn->prepare($sqlDeleteCategory);
    $reqDeleteCategory->execute(array($categoryId));

    if ($reqDeleteCategory->rowCount() > 0) {
        $_SESSION['message']['text'] =  "Catégorie supprimée avec succès.";
        $_SESSION['message']['type'] =  "success";
    } else {
        $_SESSION['message']['text'] =  "Échec de la suppression de la catégorie.";
        $_SESSION['message']['type'] =  "danger";
    }
}

header('Location: ../vue/categorie.php');