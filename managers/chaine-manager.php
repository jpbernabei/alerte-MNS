<?php 

require $_SERVER['DOCUMENT_ROOT'].'/includes/inc-db-connect.php'; 

// La fonction qui récupere toutes les chaînes existantes avec ses utilisateurs pour l'admin 

function getAllChaine(){
    $pdo = $GLOBALS['pdo']; 
    $sql = "SELECT *
    FROM chaine"; 
    return $pdo->query($sql)->fetchAll(); 
}

// Fonction qui recupere les utilisateurs d'une chaine

function getUtilisateur(array $data){
    $pdo = $GLOBALS['pdo']; 
    $sql = "SELECT utilisateur.nom_utilisateur, utilisateur.prenom_utilisateur
    FROM chaine
    LEFT JOIN chaine_utilisateur ON chaine.id_chaine = chaine_utilisateur.id_chaine 
    LEFT JOIN utilisateur ON chaine_utilisateur.id_utilisateur = utilisateur.id_utilisateur 
    WHERE  chaine.id_utilisateur=utilisateur.id_utilisateur"; 
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
    $sql = "INSERT INTO chaine(nom_chaine, date_creation_chaine, actif_chaine, id_utilisateur) 
    VALUES (:nom_chaine, :date_creation_chaine, :actif_chaine, :id_utilisateur)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute($data);
    $id_chaine=$pdo->lastInsertId();
    return $id_chaine;
}

// Fonction qui ajoute un utilisateur par son prénom et son nom à une chaîne

function insertUtilisateur (array $data)
{
    $pdo = $GLOBALS['pdo'];
    $sql = "INSERT INTO utilisateur (id_utilisateur, nom_utilisateur, prenom_utilisateur) 
    VALUES (:id_utilisateur, :nom_utilisateur, :prenom_utilisateur)";
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
    $sql = "UPDATE chaine
    LEFT JOIN chaine_utilisateur ON chaine.id_chaine = chaine_utilisateur.id_chaine 
    LEFT JOIN utilisateur ON chaine_utilisateur.id_utilisateur = utilisateur.id_utilisateur
    SET (nom_chaine = :nom_chaine
        actif_chaine = :actif_chaine
        nom_utilisateur = :nom_utilisateur
        prenom_utilisateur = :prenom_utilisateur)
    WHERE id_chaine = :id_chaine";
    $stmt = $pdo->prepare($sql);
    $stmt->execute($data);

    return $stmt->rowCount();
}

function updateChaine1(array $data){
    $pdo=$GLOBALS['pdo'];
    $sql="UPDATE chaine
    SET nom_chaine=:nom_chaine,
        actif_chaine=:actif_chaine
    WHERE id_chaine=:id_chaine";
    $stmt =$pdo->prepare($sql);
    $stmt->execute($data);
    return $stmt->rowCount();
}
// Fonction qui permet d'insérer dans une chaine un utilisateur

// function insertUserChaine(array $data)
// {
//     $pdo = $GLOBALS['pdo'];
    
//     if(count($data)){

//         foreach($data as $data)
//         {
//             $sql = "INSERT INTO chaine_utilisateur (id_utilisateur,id_chaine) 
//             VALUES(:id_utilisateur,:id_chaine)"; 
//             $stmt = $pdo->prepare($sql);
//             $stmt->execute($data);
//         }
//     }
   
//     return $stmt->rowCount();
// }


function insertUserChaine(array $utilisateurs)
{
    $pdo = $GLOBALS['pdo'];

     if(count($utilisateurs) > 0)
     {
        foreach ($utilisateurs as $utilisateur)
        {
            $sql = "INSERT INTO chaine_utilisateur (id_utilisateur) 
            VALUES(:id_utilisateur)"; 
            $stmt = $pdo->prepare($sql);
            $stmt->execute
            ([
                'id_utilisateur' => $utilisateur
            ]);
        }
    }
     return $stmt->rowCount();
}
// A l'intérieur de la chaine, supprimer les utilisateurs 

function deleteUserChaine (int $id) {
    $pdo = $GLOBALS['pdo'];
    $sql = "DELETE FROM chaine_utilisateur
            WHERE id_utilisateur=:id_utilisateur";
     $stmt =$pdo->prepare($sql);
     $stmt->execute(['id'=>$id]);

     return $stmt->rowCount(); 
}

// Voir les utilisateurs d'une chaine 

function getUserChaine(int $idChaine)
{
    $pdo = $GLOBALS['pdo'];
    $sql = "SELECT utilisateur.nom_utilisateur, utilisateur.prenom_utilisateur
    FROM chaine_utilisateur
    JOIN utilisateur ON chaine_utilisateur.id_utilisateur = utilisateur.id_utilisateur
    WHERE id_chaine = $idChaine";
    $stmt =$pdo->prepare($sql);
    $stmt->execute(['id_chaine'=>$idChaine]);
    return $stmt->fetchAll();
}


