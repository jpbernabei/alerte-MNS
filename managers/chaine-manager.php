<?php 

require $_SERVER['DOCUMENT_ROOT'].'/db-connect.php'; 

// La fonction qui récupere toutes les chaînes existantes avec ses utilisateurs pour l'admin 

function getAllChaine(){
    $pdo = $GLOBALS['pdo']; 
    $sql = "SELECT *
    FROM chaine 
    LEFT JOIN chaine_utilisateur ON chaine.id_chaine = chaine_utilisateur.id_chaine 
    LEFT JOIN utilisateur ON chaine_utilisateur.id_utilisateur = utilisateur.id_utilisateur "; 
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
// Fonction qui ajoute une chaine 

function insertChaine(array $data){
    $pdo = $GLOBALS['pdo'];
    $sql = "INSERT INTO chaine(nom_chaine, date_creation_chaine, actif_chaine) 
    VALUES (:nom_chaine, :date_creation_chaine, :actif_chaine)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute($data);
    // $stmt->execute([
    //     'nom_chaine'=>$data['nom_chaine'],
    //     'date_creation_chaine'=>$data['date_creation_chaine'],
    //     'actif_chaine'=>$data['actif_chaine'],
    // ]);

    // return $pdo->lastInsertId();
}

// Fonction qui ajoute un utilisateur par son prénom et son nom à une chaîne

function insertUtilisateur (array $data)
{
    $pdo = $GLOBALS['pdo'];
    $sql = "INSERT INTO utilisateur (nom_utilisateur, prenom_utilisateur) 
    VALUES (:nom_utilisateur, :prenom_utilisateur)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute($data);

    return $pdo->lastInsertId();
}

// Fonction pour mettre à jour un utilisateur dans une chaîne 

function updateUtilisateur(array $data)
{
    $pdo = $GLOBALS['pdo'];
    $sql = "UPDATE utilisateur
    SET nom_utilisateur = :nom_utilisateur
        prenom-utilisateur = :prenom_utilisateur
    WHERE id_utilisateur = :id_utilisateur";
    $stmt = $pdo->prepare($sql);
    $stmt->execute($data);

    return $stmt->rowCount();
}

// Fonction pour mettre à jour les chaines
function updateChaine(array $data)
{
    $pdo = $GLOBALS['pdo'];
    $sql = "UPDATE chaine, utilisateur
    SET nom_chaine = :nom_chaine
        date_creation = :date_creation
        actif_chaine = :actif_chaine
    WHERE id_chaine = :id_chaine";
    $stmt = $pdo->prepare($sql);
    $stmt->execute($data);

    return $stmt->rowCount();
}

// Algorithme qui permet de désactiver une chaîne par l'admin