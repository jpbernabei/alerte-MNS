<?php 

require $_SERVER['DOCUMENT_ROOT'].'/includes/inc-db-connect.php'; 

// La fonction qui récupere toutes les chaînes existantes avec ses utilisateurs pour l'admin 

function getAllChaine(){
    $pdo = $GLOBALS['pdo']; 
    $sql = "SELECT * FROM chaine LEFT JOIN chaine_utilisateur ON chaine.id_chaine=chaine_utilisateur.id_chaine LEFT JOIN utilisateur ON chaine.id_chaine=utilisateur.id_utilisateur "; 
    return $pdo->query($sql)->fetchAll(); 
}

// Fonction qui recupere l'Id de la chaine 

function getChaineId(int $id)
{
    $pdo = $GLOBALS['pdo'];
    $sql = "SELECT * FROM chaine WHERE id_chaine = :id"; 
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $id]);
    return $stmt->fetch();
}

// Fonction pour 