<?php
session_start();

require $_SERVER['DOCUMENT_ROOT']. '/includes/inc-db-connect.php';

if(!empty($_POST['submit']))
{
    $errors = [];

    if(empty($_POST['email']))
        $errors['email'] = "Saississez votre email.";
    
    if(empty($_POST['password']))
        $errors['password'] = "Saississez votre mot de passe.";

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
        //si il existe, alors on compare les mots de passes
        //password_verify vérifie qu'un mot de passe correspond à un hachage
        if(password_verify($password, $user['mot_de_passe_utilisateur']))
        {
            //si mdp ok alors on identifie l'utilisateur en SESSION
            session_start();

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
                header("Location: /index.php");
            }
        }
        else{ // si mdp pas ok, on redirige vers la page login
            $_SESSION['errors'] = "Identifiants invalide.";
            header("Location: /login.php"); die;
        }
    }

else  // 3. S'il n'existe pas, on redirige vers la page de login
{
    $_SESSION['errors'] = "Identifiants invalides.";
    header("Location: /login.php"); die;
}




}
else
{
header("Location: /login.php"); die;
}
