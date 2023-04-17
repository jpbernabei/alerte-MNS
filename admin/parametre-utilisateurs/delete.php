<?php
require $_SERVER['DOCUMENT_ROOT'] . "/managers/utilisateur-manager.php";

if(!empty($_POST['id_utilisateur']))
{
    $count = deleteUser($_POST['id_utilisateur']);
    if($count == 1)
    {
        header("Location: /admin/parametre-utilisateurs/index.php"); exit;
    }
    else
    {
        echo "Une erreur s'est produite lors de la suppression...";
    }
}
else
{
    header("Location: /admin/parametre-utilisateurs/index.php"); exit;
}