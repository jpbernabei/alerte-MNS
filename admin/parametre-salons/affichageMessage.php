<?php

require $_SERVER['DOCUMENT_ROOT'].'/includes/inc-db-connect.php'; 
require $_SERVER['DOCUMENT_ROOT'].'/managers/salons-managers.php';
require $_SERVER['DOCUMENT_ROOT'].'/managers/chaine-manager.php';


// Permet de specifier qu'on manipule un fichier en json 
header('Content-Type: application/json; charset=UTF-8"');

//---------------------------Récuperer l'ID de la chaine----------------------------------------------------

    $resultat = [];

    $idSalon = $_REQUEST['id_salon']; // tableau des ID des chaines 
    $pdo = $GLOBALS['pdo'];
    $sql = "SELECT *
    FROM message 
    WHERE message.id_salon=:id_salon ";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(["id_salon" => $idSalon]);
    $messages = $stmt->fetchAll();

    echo json_encode($messages);




?>

