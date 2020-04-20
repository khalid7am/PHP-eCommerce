<?php

//récupérer les données depuis le fichier infos.txt
$fichier = __DIR__ . "/infos.txt";

//Vérifier si le fichier existe ou pas
if (!file_exists($fichier)) {   
    die("Fichier infos.txt n'existe pas!");
}

//récupérer les infos sous forme des lignes
$infos = file($fichier);

//Supprimer les espaces
$infos[0] = preg_replace('/\s+/', '', $infos[0]);
$infos[1] = preg_replace('/\s+/', '', $infos[1]);
$infos[2] = preg_replace('/\s+/', '', $infos[2]);
$infos[3] = preg_replace('/\s+/', '', $infos[3]);

$DATABASE_NAME = $infos[0];
$DATABASE_PASSWORD = $infos[1];
$DATABASE_USER = $infos[2];
$DATABASE_HOST = $infos[3];

try {
    $db = new PDO('mysql:host='.$DATABASE_HOST.';dbname='.$DATABASE_NAME.';charset=utf8mb4', $DATABASE_USER, $DATABASE_PASSWORD);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);  
} catch (PDOException $e) {
    echo "Connection failed : ". $e->getMessage();
}



?>