<?php
session_start();

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
    <script src="https://kit.fontawesome.com/18cbf17047.js" crossorigin="anonymous"></script>
    <title>Document</title>
</head>

<body>
    <div class="container">
        <header>
            <img class="logo" src="/images/LOGO_ALERT_MNS_transparent.ico" alt="">
            <a href=""><i class="fa-solid fa-user fa-xl" style="color: #ffffff;"></i></a>
            <div class="police name-user"><?= $_SESSION['user']['firstname'] ?> <?= $_SESSION['user']['name'] ?></div>
            <div>
                <div class="police name-chaine">nom de la chaine </div>
                <div class="police name-salon">nom du salon</div>
            </div>
            <input class="search" type="search">
            <a href=""><i class="fa-solid fa-users fa-xl" style="color: #ffffff;"></i></a>
            <a href="../logout.php"><i class="fa-solid fa-right-from-bracket fa-xl" style="color: #ffffff;"></i></a>
        </header>
        <nav class="nav-chaine">
            <div>
                <button class="button-chaines police">Messagerie</button>
            </div>
                <button class="button-chaines police">MNS-Infos</button>
            <div class="desigend-scrollbar">
                <?php
                require $_SERVER['DOCUMENT_ROOT'] . '/managers/chaine-manager.php';
                    $chaines = getAllChaine();
                    ?>

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
        <nav class="nav-salon">
            <!-- Ici l'apparition des salons de chaque chaine lors d'une clique à faire en JS -->
       
            <!-- <?php foreach ($salons as $salon) : ?>
                    <button class="button-new-salons"><?= $chaine['nom_salon'] ?></button>
            <?php endforeach; ?> -->
        
        </nav>


        <main>

        </main>
        <div class="side">

        </div>
    </div>

</body>

</html>