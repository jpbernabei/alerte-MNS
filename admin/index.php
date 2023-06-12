<?php
session_start();
require $_SERVER['DOCUMENT_ROOT'] . '/managers/chaine-manager.php';
require $_SERVER['DOCUMENT_ROOT'] . '/managers/salons-managers.php';
$chaines = getAllChaine();
$salons = getAllSalon9();
// $userChaines = getUtilisateur($_GET['id']);
if ($_SESSION['user']['is_admin_utilisateur'] == 0) {
    header("Location: /logout.php");
    die;
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/../assets/css/style.css">
    <!-- <link rel="stylesheet" href="/assets/css/test.css"> -->


    <script src="https://kit.fontawesome.com/18cbf17047.js" crossorigin="anonymous"></script>
    <title>Accueil</title>
    <!-- <link rel="icon" class="logo" href="/images/LOGO_ALERT_MNS_transparent.ico"> -->
</head>

<body>
    <div class="container">
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
            <div class="police name-user noMobile"><?= $_SESSION['user']['firstname'] ?> <?= $_SESSION['user']['name'] ?></div>
            <div id="titre">

                <!-- <div id="titreSalons">
                    <p class="salon"></p>
                </div> -->
            </div>
            <input class="search noMobile" type="search">
            <a class="noMobile" href="/admin/affiche-reunionsAdmin.php"><i class="fa-solid fa-users fa-xl" style="color: #ffffff;"></i></a>
            <a class="noMobile" href="../logout.php"><i class="fa-solid fa-right-from-bracket fa-xl" style="color: #ffffff;"></i></a>
        </header>
        <nav class="nav-chaine">
            <a href="#" id="openBtnChaine" class=" notLaptop">
                <span class="burger-icon">
                    <button class="BtnChaineMobile">Chaînes</button>
                </span>
            </a>
            <div class="desigend-scrollbar chaine-index">
                <div class="notLaptop">
                    <div id="sidenavChaine" class="sidenavchaine">
                        <a id="closeBtnChaine" href="#" class="close">x</a>
                        <?php foreach ($chaines as $chaine) : ?>

                            <button class="button-new-chaines" id="<?= $chaine['id_chaine'] ?>"><?= $chaine['nom_chaine'] ?></button>

                        <?php endforeach; ?>
                    </div>


                </div>
                <?php foreach ($chaines as $chaine) : ?>

                    <button class="button-new-chaines noMobile" id="<?= $chaine['id_chaine'] ?>"><?= $chaine['nom_chaine'] ?></button><button class="button-mobile-salon notLaptop"><a href="/admin/mobile-salon.php"><?= $chaine['nom_chaine'] ?></a></button>

                <?php endforeach; ?>

                <div class="button-creation-container noMobile">
                    <button class="button-creation police "><i class="fa-solid fa-circle-plus" style="color: #ffffff;"></i>Créer une réunion</button>
                    <button class="button-creation police"><i class="fa-solid fa-circle-plus" style="color: #ffffff;"></i>Créer une chaine</button>
                    <div class="icone-parametre"><a class="icone-parametre" href="/admin/parametre-admin.php"><i class="fa-solid fa-gear fa-lg" style="color: #ffffff;"></i></a>

                    </div>
                </div>

        </nav>
        <div class="desigend-scrollbar nav-salon">
            <nav class="navSalonMobile" id="mesSalons">
                <!-- Affichage de salon en automatique-->
            </nav>
        </div>

        <main id="messageSalon">
            <!--Affichage des messages lors d'un clique d'un salon en fonction de son ID-->
        </main>
        <div class="desigend-scrollbar noMobile">
            <div id="side">

            </div>
            <!-- Affichage les utilisateurs qui sont connectés-->
        </div>
    </div>
    <script src="/assets/script/burgerMenu-script.js"></script>
    <script src="/assets/script/json-salon.js"></script>

</body>

</html>