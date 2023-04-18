<?php

require $_SERVER['DOCUMENT_ROOT'] . '/includes/inc-db-connect.php';

function getAllReunion()
{
    $pdo = $GLOBALS['pdo'];	
    $sql = "SELECT * FROM reunion";
    return $pdo->query($sql)->fetchAll();
}


function getReunionById(int $id)
{
    $pdo = $GLOBALS['pdo'];
    $sql = "SELECT * FROM reunion WHERE id_reunion = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $id]);
    return $stmt->fetch();
}

function insertReunion(array $data, array $utilisateurs)
{
    $pdo = $GLOBALS['pdo'];
    $sql = "INSERT INTO reunion (nom_reunion, sujet_reunion,date_creation_reunion, date_prevu_reunion, heure_prevu_reunion,actif_reunion, id_utilisateur)
    VALUES(:nom_reunion,:sujet_reunion,:date_creation_reunion,:date_prevu_reunion,:heure_prevu_reunion,:actif_reunion,:id_utilisateur)";
     $stmt = $pdo->prepare($sql);
     $stmt->execute($data);

     $id_reunion = $pdo->lastInsertId();

     if(count($utilisateurs) > 0)
     {
        foreach ($utilisateurs as $id_utilisateur)
        {
            
            $sql = "INSERT INTO reunion_utilisateur (id_utilisateur,id_reunion) 
            VALUES (:id_utilisateur,:id_reunion)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute
            ([
                'id_utilisateur' => $id_utilisateur,
                'id_reunion' => $id_reunion
            ]);
        }
    }
     

     return $id_reunion;
}

function updateReunion(array $data)
{
    $pdo = $GLOBALS['pdo'];
    $sql = "UPDATE reunion
    SET nom_reunion = :nom_reunion, sujet_reunion = :sujet_reunion , date_prevu_reunion = :date_prevu_reunion , actif_reunion = :actif_reunion
    WHERE id_reunion = :id_reunion";
    $stmt = $pdo->prepare($sql);
    $stmt->execute($data);

    return $stmt->rowCount();

}