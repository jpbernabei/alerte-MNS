<?php

require $_SERVER['DOCUMENT_ROOT'].'/includes/inc-db-connect.php'; 
require $_SERVER['DOCUMENT_ROOT'].'/managers/salons-managers.php';


// Permet de specifier qu'on manipule un fichier en json 
header('Content-Type: application/json; charset=UTF-8"');

//---------------------------Récuperer l'ID de la chaine 

$chaineId = $_REQUEST['id_chaine']; // tableau des ID des chaines 

// Pour séparer les données du tableau en explode 

$idExplode = explode("-", $chaineId); 

// ----------------------La requete Sql 

    $pdo = $GLOBALS['pdo'];
    $sql = "SELECT salon.nom_salon
    FROM chaine
    LEFT JOIN salon ON chaine.id_chaine=salon.id_chaine
    WHERE chaine.id_chaine=$id AND salon.id_chaine= chaine.id_chaine";
    $stmt = $pdo->prepare($sql);
    $stmt->execute($id);

    return $stmt->rowCount();

// Permet de specifier qu'on manipule un fichier en json 
header('Content-Type: application/json; charset=UTF-8"');

echo json_encode($stmt);



?>

<!-- ----------------------------------------------------------------

file_put_contents('data.json', $salons);

$decoding= json_decode($salons, JSON_OBJECT_AS_ARRAY);

echo $decoding->nom_salon; -->
