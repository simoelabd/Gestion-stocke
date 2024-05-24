<?php
session_start();

$nam_serveur = "localhost";
$nam_base = "gestion_stock";
$utilisateur = "root";
$password = "";

try{
    $conn = new PDO("mysql:host=$nam_serveur;dbname=$nam_base", $utilisateur, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    return $conn;
}catch(Exception $e){
    echo "Connection failed: " .$e->getMessage();
    die();
}