<?php
session_start();

include '../../includes/inc-db-connect.php';
require $_SERVER['DOCUMENT_ROOT'] . "/managers/utilisateur-manager.php";
require $_SERVER['DOCUMENT_ROOT'] . "/managers/chaine-manager.php";

$utilisateurs = getAllUser();


if (isset($_POST['submit'])) {

    $id = insertUserChaine($_POST['chaine_utilisateur']);

    if ($id) {
      
        header("Location: /admin/parametre-chaines/index.php"); exit;
        echo ("reussi");

    } else 
    
    {
        echo ("Une erreur est survenu lors de l'ajout des utilisateurs");
    }
}


?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/style-parametre-admin.css">
    <script src="https://kit.fontawesome.com/18cbf17047.js" crossorigin="anonymous"></script>
    <title>Ajouter un utilisateur dans une chaîne</title>
</head>

<body>
    <div class="container-grid">
        <header>
            <img class="logo" src="/images/LOGO_ALERT_MNS_transparent.ico" alt="">
            <a href=""><i class="fa-solid fa-user fa-xl" style="color: #ffffff;"></i></a>
            <div class="police name-user">Nom utilisateur</div>
            <div>
                <div class="police name-chaine">nom de la chaine </div>
                <div class="police name-salon">nom du salon</div>
            </div>
            <input class="search" type="search">
            <a href=""><i class="fa-solid fa-users fa-xl" style="color: #ffffff;"></i></a>
            <a href="../../logout.php"><i class="fa-solid fa-right-from-bracket fa-xl" style="color: #ffffff;"></i></a>
        </header>
        <nav class="nav-chaine">
            <div>
                <button class="button-chaines police"><i class="fa-solid fa-user" style="color: #ffffff ;"></i>Utilisateurs</button>
            </div>
            <div>
                <button class="button-chaines police"><i class="fa-solid fa-fire" style="color: #ffffff;"></i>Chaînes</button>
            </div>
            <div>
                <button class="button-chaines police"><i class="fa-solid fa-sitemap" style="color: #ffffff;"></i>Salons</button>
            </div>
            <div>
                <button class="button-chaines police"><i class="fa-solid fa-users " style="color: #ffffff;"></i>Réunions</button>
            </div>

            <div class="button-creation-container">

                <a href="/admin/parametre-admin.php"><button class="button-creation police"><i class="fa-solid fa-arrow-rotate-left"></i>Accueil</button></a>
            </div>
        </nav>
        <main>

            <div>
                <h1>Ajout des utilisateurs</h1>
                <main>
                    <div>
                        <form action="/admin/parametre-chaines/addUser.php" method="post">
                        <table>
                            <thead>
                                <th>ID</th>
                                <th>Email</th>
                                <th>Nom</th>
                                <th>Prénom</th>
                                <th>Ajouter</th>
                                <th>Supprimer</th>
                            </thead>
                            <tbody>
                                <?php foreach ($utilisateurs as $utilisateur) : ?>
                                    <tr>
                                        <td><?= $utilisateur['id_utilisateur'] ?></td>
                                        <td><?= $utilisateur['email_utilisateur'] ?></td>
                                        <td><?= $utilisateur['nom_utilisateur'] ?></td>
                                        <td><?= $utilisateur['prenom_utilisateur'] ?></td>
                                        <td>   
                                        <label>
                                            <input type="checkbox" name="chaine_utilisateur[id_utilisateur]" value="<?= $utilisateur["id_utilisateur"] ?>">
                                        </label>
                                        </td>
                                        <input type="hidden" name="chaine_utilisateur[id_chaine]" value="<?=$_GET['id']?>">
                                    </tr>
                                <?php
                                endforeach;  ?>
                            </tbody>
                        </table>
                        <input type="submit"  name="submit" value="Enregistrer" class="btn btn-primary">
                        </form>
                    </div>
                </main>
            </div>  
</body>
</html>