<?php
session_start();
require $_SERVER['DOCUMENT_ROOT'] . '/managers/chaine-manager.php';
require $_SERVER['DOCUMENT_ROOT'] . '/managers/salons-managers.php';
<<<<<<< HEAD
=======

>>>>>>> c1474fb2b4ce51b1f36eb39ad47f8f67c3175f23
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
    <link rel="stylesheet" href="/assets/css/test.css">
<<<<<<< HEAD
    
=======


>>>>>>> c1474fb2b4ce51b1f36eb39ad47f8f67c3175f23
    <script src="https://kit.fontawesome.com/18cbf17047.js" crossorigin="anonymous"></script>
    <title>Accueil</title>
</head>

<body>
    <div class="container">
        <header>
            <img class="logo" src="/images/LOGO_ALERT_MNS_transparent.ico" alt="">
            <a href="/admin/parametre-utilisateurAdmin.php"><i class="fa-solid fa-user fa-xl" style="color: #ffffff;"></i></a>
            <div class="police name-user"><?= $_SESSION['user']['firstname'] ?> <?= $_SESSION['user']['name'] ?></div>
            <div id="titre">
                <div id="titre">

                </div>
                <!-- <div id="titreSalons">
                    <p class="salon"></p>
                </div> -->
            </div>
            <input class="search" type="search">
            <a href="/admin/affiche-reunionsAdmin.php"><i class="fa-solid fa-users fa-xl" style="color: #ffffff;"></i></a>
            <a href="../logout.php"><i class="fa-solid fa-right-from-bracket fa-xl" style="color: #ffffff;"></i></a>
        </header>
        <nav class="nav-chaine">

            <div class="desigend-scrollbar">
                <?php foreach ($chaines as $chaine) : ?>

                    <button class="button-new-chaines" id="<?= $chaine['id_chaine'] ?>"><?= $chaine['nom_chaine'] ?></button>

                <?php endforeach; ?>

                <div class="button-creation-container">
                    <button class="button-creation police"><i class="fa-solid fa-circle-plus" style="color: #ffffff;"></i>Créer une réunion</button>
                    <button class="button-creation police"><i class="fa-solid fa-circle-plus" style="color: #ffffff;"></i>Créer une chaine</button>
                    <div class="icone-parametre"><a class="icone-parametre" href="/admin/parametre-admin.php"><i class="fa-solid fa-gear fa-lg" style="color: #ffffff;"></i></a>

                    </div>
                </div>

        </nav>
        <nav class="nav-salon" id="mesSalons">
            <!-- Affichage de salon en automatique-->
        </nav>


        <main>

        </main>
        <div class="desigend-scrollbar" id="side">
            <!-- Affichage les utilisateurs qui sont connectés-->
        </div>
    </div>
    <script src="/assets/script/json-salon.js"></script>
    
</body>

</html>