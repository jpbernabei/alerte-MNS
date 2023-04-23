<?php
session_start();
require $_SERVER['DOCUMENT_ROOT'] . "/managers/chaine-manager.php";


if(isset($_GET['id']))
{ 

    // ------------La deuxieme étape est de récuperer les utilisateurs lié à cette chaine 
    $utilisateurs = getUserChaine($_GET['id']);


} else{
    header("Location: /admin/parametre-chaines/index.php");
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
    <title>Les utilisateurs de la chaîne</title>
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
                <h1>Voir des utilisateurs</h1>
                <main>
                    <div>
                        <form action="delete.php" method="POST">
                        <table>
                            <thead>
                                <th>Prénom</th>
                                <th>Nom</th>
                            </thead>
                            <tbody>
                                <?php foreach($utilisateurs as  $utilisateur) : ?>
                                    <tr>
                                        <td><?= $utilisateur['nom_utilisateur'] ?></td>
                                        <td><?= $utilisateur['prenom_utilisateur'] ?></td>
                                    </tr>
                                <?php endforeach;  ?>
                            </tbody>
                        </table>
                        
                        </form>
                    </div>
                </main>
            </div>   
</body>
</html>