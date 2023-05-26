<?php 

require $_SERVER['DOCUMENT_ROOT'].'/includes/inc-db-connect.php'; 

// La fonction qui récupere toutes les chaînes existantes avec ses utilisateurs pour l'admin 

function getAllChaine()
{
    $pdo = $GLOBALS['pdo']; 
    $sql = "SELECT *
    FROM chaine"; 
    return $pdo->query($sql)->fetchAll(); 
}

// Fonction qui recupere les utilisateurs d'une chaine

function getUtilisateur(int $idChaine){
    $pdo = $GLOBALS['pdo']; 
        $sql = "SELECT utilisateur.nom_utilisateur, utilisateur.prenom_utilisateur
        FROM chaine_utilisateur 
        LEFT JOIN utilisateur ON chaine_utilisateur.id_utilisateur = utilisateur.id_utilisateur
        WHERE chaine_utilisateur.id_chaine=:id_chaine"; 
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['id_chaine'=>$idChaine]);
        $UserInChaine =$stmt->fetchAll();
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

function insertChaine(array $data, array $utilisateurs)
{
    // Protection contre les injections SQL

    $data['nom_chaine'] = htmlspecialchars($data['nom_chaine']);

    $pdo = $GLOBALS['pdo'];
    $sql = "INSERT INTO chaine(nom_chaine, date_creation_chaine, actif_chaine, id_utilisateur) 
    VALUES (:nom_chaine, :date_creation_chaine, :actif_chaine, :id_utilisateur)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute($data);
    
    $id_chaine=$pdo->lastInsertId();

    $id_createur= $_SESSION['user']['id'];

    // Requete pour créer automatiquement un salon lors de la creation d'une chaine
    
    $sql = "INSERT INTO salon (date_creation_salon,nom_salon,actif_salon,id_chaine)  
    VALUES (:date_creation_salon,:nom_salon ,:actif_salon,:id_chaine )";
    $stmt = $pdo->prepare($sql);
    $stmt->execute
           ([
                'date_creation_salon'=> 'date_creation_salon',
               'nom_salon' => 'Général',
               'actif_salon'=>'actif_salon',
               'id_chaine' => $id_chaine
           ]);
    
           // Requete pour inserer des utilisateurs 

    $sql = "INSERT INTO chaine_utilisateur (id_utilisateur,id_chaine) 
    VALUES (:id_utilisateur,:id_chaine)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute
           ([
               'id_utilisateur' => $id_createur,
               'id_chaine' => $id_chaine
           ]);

    if(count($utilisateurs) > 0)
    {
       foreach ($utilisateurs as $id_utilisateur)
       {
           $sql = "INSERT INTO chaine_utilisateur (id_utilisateur,id_chaine) 
           VALUES (:id_utilisateur,:id_chaine)";
           $stmt = $pdo->prepare($sql);
           $stmt->execute
           ([
               'id_utilisateur' => $id_utilisateur,
               'id_chaine' => $id_chaine
           ]);
       }
   }
    
    return $id_chaine;
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
    // Contre les injections 

    $data['nom_chaine'] = htmlspecialchars($data['nom_chaine']);

    $pdo=$GLOBALS['pdo'];
    $sql="UPDATE chaine
    SET nom_chaine=:nom_chaine
    WHERE id_chaine=:id_chaine";
    $stmt =$pdo->prepare($sql);
    $stmt->execute($data);
    return $stmt->rowCount();
}


function insertUserChaine(array $utilisateurs)
{
    $pdo = $GLOBALS['pdo'];

            $sql = "INSERT INTO chaine_utilisateur (id_utilisateur, id_chaine) 
            VALUES(:id_utilisateur, :id_chaine)"; 
            $stmt = $pdo->prepare($sql);
            $stmt->execute($utilisateurs);
}
// A l'intérieur de la chaine, supprimer les utilisateurs 

function deleteUserChaine (int $id) 
{
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
    $sql = "SELECT utilisateur.nom_utilisateur, utilisateur.prenom_utilisateur, utilisateur.id_utilisateur
    FROM chaine_utilisateur
    JOIN utilisateur ON chaine_utilisateur.id_utilisateur = utilisateur.id_utilisateur
    WHERE id_chaine = :id_chaine";
    $stmt =$pdo->prepare($sql);
    $stmt->execute(['id_chaine'=>$idChaine]);
    return $stmt->fetchAll();
}

// Fonction les utilisateurs qui ne sont pas dans la chaine 

function getUserNotInChaine(int $id)
{
    $pdo = $GLOBALS['pdo'];
    $sql = "SELECT utilisateur.nom_utilisateur, utilisateur.prenom_utilisateur, utilisateur.id_utilisateur
    FROM utilisateur
    WHERE NOT EXISTS (
      SELECT *
      FROM chaine_utilisateur
      WHERE chaine_utilisateur.id_utilisateur = utilisateur.id_utilisateur
      AND chaine_utilisateur.id_chaine = :id_chaine
    )";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id_chaine' => $id]);
    return $stmt->fetchAll();
}

// Fonction qui retire un utilisateur d'une chaine 

function deleteUserInChaine(int $id, int $idchaine)
{
    $pdo = $GLOBALS['pdo'];
    $sql = "DELETE FROM chaine_utilisateur WHERE id_utilisateur = :id AND id_chaine=$idchaine";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $id]);

    return $stmt->rowCount();
}


