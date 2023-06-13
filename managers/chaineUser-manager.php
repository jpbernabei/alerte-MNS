<?php 

require $_SERVER['DOCUMENT_ROOT'].'/includes/inc-db-connect.php'; 

// La fonction qui récupere toutes les chaînes existantes avec ses utilisateurs pour un utilisateur non-admin

function getChaineUser(int $id_utilisateur)
{
    $pdo = $GLOBALS['pdo'];
    $sql= "SELECT *
    FROM chaine
    WHERE id_utilisateur = $id_utilisateur";
   return $pdo->query($sql)->fetchAll();
}

// Fonction qui recupere les utilisateurs de la chaine

function getAllUser()
{
$pdo = $GLOBALS['pdo'];
$sql = 'SELECT * FROM utilisateur';
$query = $pdo->query($sql);
return $query->fetchAll();

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

// Fonction qui affiche les salons en fonction de l'ID de la chaine

