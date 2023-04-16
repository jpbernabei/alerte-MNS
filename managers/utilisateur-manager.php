<?php
require $_SERVER['DOCUMENT_ROOT'] . '/includes/inc-db-connect.php';

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
    SET email_utilisateur = :email_utilisateur, nom_utilisateur = :nom_utilisateur, prenom_utilisateur = :prenom_utilisateur, num_adresse_utilisateur = :num_adresse_utilisateur, rue_adresse_utilisateur = :rue_adresse_utilisateur, code_postal_utilisateur = :code_postal_utilisateur, ville_adresse_utilisateur = :ville_adresse_utilisateur, actif_utilisateur = :actif_utilisateur
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