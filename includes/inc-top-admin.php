<?php
session_start();

if (!isset($_SESSION['user'])){
    header("Location: /login.php"); die;
 }
 
if($_SESSION['user']['is_admin_utilisateur'] == 0)
{
    header("Location: /logout.php");die;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/style-parametre-admin.css">
    <script src="https://kit.fontawesome.com/18cbf17047.js" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>
    <div class="container-grid">
        <header>
        <div class="notLaptop">
                <div id="mySidenav" class="sidenav">
                    <a id="closeBtn" href="#" class="close">×</a>
                    <ul>
                        <li><a href="/admin/index.php">Accueil</a></li>
                        <li><a href="/admin/parametre-utilisateurAdmin.php">Paramètre</a></li>
                        <li><a href="/admin/affiche-reunionsAdmin.php">Réunions</a></li>
                        <li><a href="#">Créer une réunion</a></li>
                        <li><a href="#">Créer une chaîne</a></li>
                        <li><a href="/logout.php">Déconnexion</a></li>
                    </ul>
                </div>

                <a href="#" id="openBtn">
                    <span class="burger-icon">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>
                </a>
            </div>
            <img class="logo noMobile" src="/images/LOGO_ALERT_MNS_transparent.ico" alt="">
            <a class="noMobile" href="/admin/parametre-utilisateurAdmin.php"><i class="fa-solid fa-user fa-xl" style="color: #ffffff;"></i></a>
            <div class="police name-user noMobile"><?=$_SESSION['user']['firstname'] ?> <?=$_SESSION['user']['name'] ?></div>
            <div class="police name-user noMobile">Statut : <?= $_SESSION['user']['role_utilisateur'] ?></div>
            <div></div>
            <a class="noMobile" href="/admin/affiche-reunionsAdmin.php"><i class="fa-solid fa-users fa-xl" style="color: #ffffff;"></i></a>
            <a class="noMobile" href="/logout.php"><i class="fa-solid fa-right-from-bracket fa-xl" style="color: #ffffff;"></i></a>
        </header>