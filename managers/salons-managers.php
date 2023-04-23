<?php

// Requete pour récupérer toutes les salons d'une chaines 

function getAllSalon(){
    $pdo = $GLOBALS['pdo']; 
    $sql = "SELECT *
    FROM salon
    LEFT JOIN chaine ON chaine.id_chaine=salon.id_chaine
    WHERE chaine.id_chaine= : id_chaine"; 
    return $pdo->query($sql)->fetchAll(); 
}

// Requete pour créer un salon d'une chaine 
// Requete pour désactiver un salon d'une chaine 
// Requete pour modifier un salon d'une chaine
