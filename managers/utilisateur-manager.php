<?php
require $_SERVER['DOCUMENT_ROOT'] . '/includes/inc-db-connect.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/fonctions/valid-data.php';

//fonction qui permet de sécuriser les données envoyées par l'utilisateur

function verifUser(array $data){

    $pdo = $GLOBALS['pdo'];
    $sql = "SELECT * FROM utilisateur WHERE email_utilisateur = :email_utilisateur";
    $query = $pdo->prepare($sql);
    $res = $query->execute([
        'email_utilisateur' => $data['email_utilisateur']
    ]);

    if($query->rowCount() > 0)
    {
        
        $_SESSION['errors']['email_utilisateur'] = "Cette adresse email est déjà utilisé.";
        header("Location: /admin/parametre-utilisateurs/new.php");die;
    }
    return $res;
}

// fonction qui verifie si l'adresse email existe déjà pour update
// (elle laisse si l'adresse est celle de l'utilisateur qu'on modifie)
function verifEmailEdit(array $data){

    $pdo = $GLOBALS['pdo'];
    $sql = "SELECT * 
    FROM utilisateur WHERE email_utilisateur = :email_utilisateur AND id_utilisateur <> :id_utilisateur";
    $query = $pdo->prepare($sql);
    $res = $query->execute([
        'email_utilisateur' => $data['email_utilisateur'],
        'id_utilisateur' => $data['id_utilisateur']]);

    $res = $query->rowCount();
    return $res;
    // if($query->rowCount() > 0)
    // {
        
    //     $_SESSION['errors']['email'] = "Cette adresse email est déjà utilisé.";
    //     header("Location: /admin/parametre-utilisateurs/edit.php?id=". $data['id_utilisateur'] );
    //     return $_SESSION['errors']['email'] ;die;
    // }
    
}
//fonction qui permet d'ajouter un utilisateur
function insertUser(array $data){

    $data['email_utilisateur'] = valid_data($data['email_utilisateur']);
    $data['mot_de_passe_utilisateur'] = valid_data($data['mot_de_passe_utilisateur']);
    $data['prenom_utilisateur'] = valid_data($data['prenom_utilisateur']);
    $data['nom_utilisateur'] = valid_data($data['nom_utilisateur']);
    
    $pdo = $GLOBALS['pdo'];

        // On vérifie que l'utilisateur n'existe pas
        $sql = "SELECT * FROM utilisateur WHERE email_utilisateur = :email";
        $query = $pdo->prepare($sql);
        $res = $query->execute([
            'email' => $data['email_utilisateur']
        ]);
    
        if($query->rowCount() > 0)
        {
            
            $errors['errors']['email_utilisateur'] = "Cette adresse email est déjà utilisé.";
            // header("Location: /admin/parametre-utilisateurs/new.php");
        }
        $isActive = isset($_POST['actif_utilisateur']) ? 1 : 0;
    $sql = "INSERT INTO utilisateur(email_utilisateur, mot_de_passe_utilisateur, nom_utilisateur, prenom_utilisateur, date_creation_compte_utilisateur,is_admin_utilisateur, actif_utilisateur, id_role) 
    VALUES (:email_utilisateur,:mot_de_passe_utilisateur,:nom_utilisateur,:prenom_utilisateur,:date_creation_compte_utilisateur,:is_admin_utilisateur,:actif_utilisateur,:id_role)";
    $data['mot_de_passe_utilisateur']= password_hash($data['mot_de_passe_utilisateur'], PASSWORD_DEFAULT);
    $stmt = $pdo->prepare($sql);
    $stmt->execute($data);
    $id_user= $pdo->lastInsertId();
    return $id_user;

    if($res)
    {
        header("Location: /"); exit;
    }
    else
    {
        $_SESSION['errors'] = "Un erreur est survenue.";
        die;
    }
}

function getAllUser()
{
$pdo = $GLOBALS['pdo'];
$sql = 'SELECT * FROM utilisateur';
$query = $pdo->query($sql);
return $query->fetchAll();

}

function updateUser(array $data ,int $isAdmin)
{
    $pdo = $GLOBALS['pdo'];
    $sql = "UPDATE utilisateur
    SET email_utilisateur = :email_utilisateur, nom_utilisateur = :nom_utilisateur, prenom_utilisateur = :prenom_utilisateur, is_admin_utilisateur = :is_admin_utilisateur
    WHERE id_utilisateur = :id_utilisateur";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'id_utilisateur'=> $data['id_utilisateur'],
        'email_utilisateur' => $data['email_utilisateur'],
        'nom_utilisateur' => $data['nom_utilisateur'],
        'prenom_utilisateur' => $data['prenom_utilisateur'],
        'is_admin_utilisateur' => $isAdmin
    ]);
    
    return $stmt->rowCount();
    
}

function updateUserParamAdmin($data )
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

function uploadImageFile(string $inputFileName)
{
    $urlImage = NULL;

    if(!empty($_FILES[$inputFileName]) && $_FILES[$inputFileName]['error'] == 0)
    {
        // On vérifie le poids de l'image
        if($_FILES[$inputFileName]['size'] < 1000000)
        {

            // On vérifie que le fichier est bien une image
            $authorizedTypes = ["image/png","image/jpg","image/gif","image/jpeg"];
            $fileType = mime_content_type($_FILES[$inputFileName]['tmp_name']);

            if(in_array($fileType, $authorizedTypes))
            {

                $fileName = str_replace(' ','-', basename($_FILES[$inputFileName]['name']));
                $tmpFile = $_FILES[$inputFileName]['tmp_name'];

                if(move_uploaded_file($tmpFile, "../../uploads/" . $fileName))
                {
                    $urlImage = "/uploads/" . $fileName;
                }
                // else
                // {
                //     echo "KO"; die;
                // }

            }
            // else
            // {
            //     echo "Fichier non autorisé !"; die;
            // }

        }
    }

    return $urlImage;
}


