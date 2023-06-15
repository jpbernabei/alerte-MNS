<?php
session_start();

require $_SERVER['DOCUMENT_ROOT']. '/includes/inc-db-connect.php';

if(!empty($_POST['submit']))
{
    $errors = [];

    if(empty($_POST['email']))
        $errors['email'] = "Saisissez votre email.";
    
    if(empty($_POST['password']))
        $errors['password'] = "Saisissez votre mot de passe.";

    if(count($errors) > 0)
    {
        $_SESSION['errors'] = $errors;
        $_SESSION['values'] = $_POST;
        header("Location: /login.php"); die;
    }

    // on cherche l'utilisateur en base de donnée avec son email
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);

    $sql = "SELECT * , role.libelle_role FROM utilisateur
    JOIN role ON utilisateur.id_role = role.id_role WHERE email_utilisateur = '" . $email . "'";

    $result = $pdo->query($sql);
    $user = $result->fetch(PDO::FETCH_ASSOC);

    //on test si l'utilisateur existe
    if($user)
    {
        //s'il existe, alors on compare les mots de passe
        //password_verify vérifie qu'un mot de passe correspond à un hachage
        if(password_verify($password, $user['mot_de_passe_utilisateur']))
        {
            //si mdp ok alors on identifie l'utilisateur en SESSION
            session_start();
            // on créé une variable de session et on stocke son ID, son nom, son prénom, s'il est admin et son role
            $_SESSION['user'] = [
                'id' => $user['id_utilisateur'],
                'name'=> $user['nom_utilisateur'],
                'firstname'=> $user['prenom_utilisateur'],
                'is_admin_utilisateur'=> $user['is_admin_utilisateur'],
                'role_utilisateur'=> $user['libelle_role']
            ];
            if($user['is_admin_utilisateur'] == 1)
            {
            // on redirige vers l'interface admin
            header("Location: /admin/index.php");
            }else{
                // sinon vers l'interface utilisateur
                header("Location: /index.php");
            }
        }
        else{ // si mdp pas correct, on redirige vers la page login avec un message d'erreur
            $_SESSION['errors']['error'] = "Identifiant invalide";
            header("Location: /login.php"); die;
        }
    }

else  //S'il n'existe pas, on redirige vers la page de login avec un message d'erreur
{
    $_SESSION['errors']['error'] = "Identifiant invalide";
    header("Location: /login.php"); die;
}


}
else
{
header("Location: /login.php"); die; 
unset($_SESSION['errors']);
}