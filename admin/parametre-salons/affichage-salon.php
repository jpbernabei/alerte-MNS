<?php

require $_SERVER['DOCUMENT_ROOT'].'/includes/inc-db-connect.php'; 
require $_SERVER['DOCUMENT_ROOT'].'/managers/salons-managers.php';
require $_SERVER['DOCUMENT_ROOT'].'/managers/chaine-manager.php';


// Permet de specifier qu'on manipule un fichier en json 
header('Content-Type: application/json; charset=UTF-8"');

//---------------------------Récuperer l'ID de la chaine----------------------------------------------------

    $idChaine = $_REQUEST['id_chaine']; // tableau des ID des chaines 
    $pdo = $GLOBALS['pdo'];
    $sql = "SELECT salon.nom_salon, nom_chaine
    FROM chaine
    LEFT JOIN salon ON chaine.id_chaine=salon.id_chaine
    WHERE chaine.id_chaine=:id_chaine AND salon.id_chaine= chaine.id_chaine";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(["id_chaine" => $idChaine]);
    $salons = $stmt->fetchAll();

echo json_encode($salons);

//---------------------------Récuperer l'ID des salons pour afficher les messages----------------------------------------------------

$idSalon = $_REQUEST['id_salon']; // tableau des ID des chaines 
$pdo = $GLOBALS['pdo'];
$sql = "SELECT salon.nom_salon, nom_chaine
FROM chaine
LEFT JOIN salon ON chaine.id_chaine=salon.id_chaine
WHERE chaine.id_chaine=:id_chaine AND salon.id_chaine= chaine.id_chaine";
$stmt = $pdo->prepare($sql);
$stmt->execute(["id_chaine" => $idSalon]);
$message = $stmt->fetchAll();

echo json_encode($message);


?>

