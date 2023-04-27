<?php
require $_SERVER['DOCUMENT_ROOT'].'/includes/inc-db-connect.php'; 

// Requete pour récupérer toutes les chaines 

function getAllChaine(){
    $pdo = $GLOBALS['pdo']; 
    $sql = "SELECT *
    FROM chaine"; 
    return $pdo->query($sql)->fetchAll(); 
}
// Requete pour récuperer les salons avec ID de la chaine

function getAllSalon(int $id){
    $pdo = $GLOBALS['pdo']; 
    $sql = "SELECT id_salon, nom_salon, actif_salon, date_creation_salon
    FROM salon
    LEFT JOIN chaine ON chaine.id_chaine=salon.id_chaine
    WHERE chaine.id_chaine=$id"; 
    
    return $pdo->query($sql)->fetchAll();     
}


// Récuperer l'ID du salon 
// Requete pour créer un salon d'une chaine 

function insertSalon(array $data){
    $pdo = $GLOBALS['pdo'];
    $sql = "INSERT INTO salon(nom_salon, date_creation_salon, actif_salon, id_chaine) 
    VALUES (:nom_salon, :date_creation_salon, :actif_salon, :id_chaine)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute($data);
    $id_salon=$pdo->lastInsertId();
    return $id_salon;
}
// Requete pour modifier un salon d'une chaine

function updateSalon(array $data)
{
    $pdo = $GLOBALS['pdo'];
    $sql = "UPDATE salon
            SET nom_salon=:nom_salon
                date_cration_salon=:date_creation_salon
            WHERE id_chaine=:id_chaine";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute($data);

    return $stmt->rowCount(); 
}

// requete pour récuperer l'ID du salon à modifier 
// On passe dans le parametre l'ID qu'on veut récuperer dnas l'URL pour modifier spécifiquement ce salon avec son ID unique

function getSalonId(int $id)
{
    $pdo = $GLOBALS['pdo'];
    $sql = "SELECT * 
            FROM salon
            WHERE id_salon=:id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id'=> $id]);

    return $stmt-> fetch();
}

// la fonction pour récuperer les salons en fonction de l'ID des chaines 

function getSalonIdChaine(int $id)
{
    $pdo = $GLOBALS['pdo'];
    $sql = "SELECT salon.nom_salon
    FROM chaine
    INNER JOIN salon ON salon.id_chaine=chaine.id_chaine
    WHERE chaine.id_chaine=$id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute($id);

    return $stmt->rowCount(); 
} 

