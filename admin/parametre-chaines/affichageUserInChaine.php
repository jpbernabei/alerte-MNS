<?php

require $_SERVER['DOCUMENT_ROOT'].'/includes/inc-db-connect.php'; 
require $_SERVER['DOCUMENT_ROOT'].'/managers/salons-managers.php';
require $_SERVER['DOCUMENT_ROOT'].'/managers/chaine-manager.php';


// Permet de specifier qu'on manipule un fichier en json 
header('Content-Type: application/json; charset=UTF-8"');

//---------------------------Récuperer l'ID de la chaine----------------------------------------------------

    $idChaine = $_REQUEST['id_chaine']; // tableau des ID des chaines 
   
        $pdo = $GLOBALS['pdo']; 
        $sql = "SELECT utilisateur.nom_utilisateur, utilisateur.prenom_utilisateur
        FROM chaine_utilisateur 
        LEFT JOIN utilisateur ON chaine_utilisateur.id_utilisateur = utilisateur.id_utilisateur
        WHERE chaine_utilisateur.id_chaine=:id_chaine"; 
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['id_chaine'=>$idChaine]);
        $UserInChaine =$stmt->fetchAll();
        
echo json_encode($UserInChaine);


?>

