<?php
require $_SERVER['DOCUMENT_ROOT'] . '/includes/inc-db-connect.php';

//fonction qui permet de sécuriser les donnés envoyé par l'utilisateur
function valid_donnees($donnees){
    $donnees = trim($donnees);
    $donnees = stripslashes($donnees);
    $donnees = htmlspecialchars($donnees);
    return $donnees;
}
//fonction qui permet d'ajouter un utilisateur
function insertUser(array $data){
    $data['email_utilisateur'] = valid_donnees($data['email_utilisateur']);
    $data['mot_de_passe_utilisateur'] = valid_donnees($data['mot_de_passe_utilisateur']);
    $data['prenom_utilisateur'] = valid_donnees($data['prenom_utilisateur']);
    $data['nom_utilisateur'] = valid_donnees($data['nom_utilisateur']);
    $pdo = $GLOBALS['pdo'];
    $sql = "INSERT INTO utilisateur(email_utilisateur, mot_de_passe_utilisateur, nom_utilisateur, prenom_utilisateur, date_creation_compte_utilisateur,is_admin_utilisateur, actif_utilisateur, id_role) 
    VALUES (:email_utilisateur,:mot_de_passe_utilisateur,:nom_utilisateur,:prenom_utilisateur,:date_creation_compte_utilisateur,:is_admin_utilisateur,:actif_utilisateur,:id_role)";
    $data['mot_de_passe_utilisateur']= password_hash($data['mot_de_passe_utilisateur'], PASSWORD_DEFAULT);
    $stmt = $pdo->prepare($sql);
    $stmt->execute($data);
    $id_user= $pdo->lastInsertId();
    return $id_user;
}

function getAllUser()
{
$pdo = $GLOBALS['pdo'];
$sql = 'SELECT * FROM utilisateur';
$query = $pdo->query($sql);
return $query->fetchAll();

}

function updateUser(array $data)
{
    $pdo = $GLOBALS['pdo'];
    $sql = "UPDATE utilisateur
    SET email_utilisateur = :email_utilisateur, nom_utilisateur = :nom_utilisateur, prenom_utilisateur = :prenom_utilisateur
    WHERE id_utilisateur = :id_utilisateur";
    $stmt = $pdo->prepare($sql);
    $stmt->execute($data);
    
    return $stmt->rowCount();
    
}

function getUserById(int $id)
{
    $pdo = $GLOBALS['pdo'];
    $sql = "SELECT * FROM utilisateur WHERE id_utilisateur = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id'=> $id]);
    return $stmt->fetch();
}

function deleteUser(int $id)
{
    $pdo = $GLOBALS['pdo'];
    $sql = "DELETE FROM utilisateur WHERE id_utilisateur = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $id]);

    return $stmt->rowCount();
}

//fonction qui permet de récupérer les rôles
function getAllRoles(){
    $pdo = $GLOBALS['pdo'];
    $sql = "SELECT * FROM role ";
    return $pdo->query($sql)->fetchAll();
}

function updateUserParametre(array $data)
{
    $pdo = $GLOBALS['pdo'];
    $sql = "UPDATE utilisateur
    SET email_utilisateur = :email_utilisateur, nom_utilisateur = :nom_utilisateur, prenom_utilisateur = :prenom_utilisateur, num_adresse_utilisateur = :num_adresse_utilisateur, rue_adresse_utilisateur = :rue_adresse_utilisateur, code_postal_utilisateur = :code_postal_utilisateur, ville_adresse_utilisateur = :ville_adresse_utilisateur
    WHERE id_utilisateur = :id_utilisateur";
    $stmt = $pdo->prepare($sql);
    $stmt->execute($data);
    
    return $stmt->rowCount();
    
}

// SELECT nom_utilisateur,nom_chaine FROM `utilisateur` JOIN chaine_utilisateur ON utilisateur.id_utilisateur = chaine_utilisateur.id_utilisateur JOIN chaine ON chaine_utilisateur.id_chaine = chaine.id_chaine;