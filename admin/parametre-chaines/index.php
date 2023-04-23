<<<<<<< HEAD
<?php require $_SERVER['DOCUMENT_ROOT'] . "/includes/inc-top.php"; ?>


=======
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/style-parametre-admin.css">
    <script src="https://kit.fontawesome.com/18cbf17047.js" crossorigin="anonymous"></script>
    <title>Chaîne</title>
</head>
<body>
    <div class="container-grid">
        <header>
            <img class="logo" src="/images/LOGO_ALERT_MNS_transparent.ico" alt="">
            <a href=""><i class="fa-solid fa-user fa-xl" style="color: #ffffff;"></i></a>
            <div class="police name-user">Nom utilisateur</div>
            <div><div class="police name-chaine">nom de la chaine </div><div class="police name-salon">nom du salon</div></div>
            <input class="search" type="search">
            <a href=""><i class="fa-solid fa-users fa-xl" style="color: #ffffff;"></i></a>
            <a href=""><i class="fa-solid fa-right-from-bracket fa-xl" style="color: #ffffff;"></i></a>
        </header>
        <nav class="nav-chaine">
            <div>
                <a href=""><button class="button-chaines police"><i class="fa-solid fa-user" style="color: #ffffff ;" ></i>Utilisateurs</button></a>
            </div>
            <div >
                <a href=""><button class="button-chaines police"><i class="fa-solid fa-fire" style="color: #ffffff;"></i>Chaînes</button></a>
            </div>
            <div >
                <a href=""><button class="button-chaines police"><i class="fa-solid fa-sitemap" style="color: #ffffff;"></i>Salons</button></a>
            </div>
            <div >
                <a href=""><button class="button-chaines police"><i class="fa-solid fa-users " style="color: #ffffff;"></i>Réunions</button></a>
            </div>
            
            <div class="button-creation-container">
            
                <a href="../parametre-admin.php"><button class="button-creation police"><i class="fa-solid fa-arrow-rotate-left"></i>Accueil</button></a>
                        
            </div>
        </nav>
        <main>
>>>>>>> b121795433d7436cf06a0582e58fdbfd61cf8470
            <div class="button-parametre-admin-container">

                <!-- Il faut faire le modal ici -->
                <?php
                require $_SERVER['DOCUMENT_ROOT'] . '/managers/chaine-manager.php';
                $chaines = getAllChaine();
                ?>

                <table class="tablechaine">
                    <thead class="theadchaine">
                        <tr class="trchaine">
                            <th class="thchaine">Id</th>
                            <th class="thchaine">Date</th>
                            <th class="thchaine">Nom chaîne</th>
                            <!-- <th>Les utilisateurs dans la chaîne</th> -->
                            <th class="thchaine">Actif/Désactif</th>
                            <th class="thchaine">Modifier les informations de la chaîne</th>
                            <th class="thchaine">Ajouter un utilisateur</th>
                            <th class="thchaine">Supprimer un utilisateur de la chaîne</th>
                        </tr>
                    </thead>
                    <tbody class="tbodychaine">
                        <?php foreach ($chaines as $chaine) : ?>
                            <tr>
                                <td class="tdchaine"><?= $chaine['id_chaine'] ?></td>
                                <td class="tdchaine"><?= $chaine['date_creation_chaine'] ?></td>
                                <td class="tdchaine"><?= $chaine['nom_chaine'] ?></td>
                                <td class="tdchaine"><?= $chaine['actif_chaine'] ?></td>
                                <td class="tdchaine"><a href="/admin/parametre-chaines/edit.php?id=<?= $chaine['id_chaine'] ?>">Modifier </a></td>
                                <td class="tdchaine"><a href="/admin/parametre-chaines/addUser.php?id=<?= $chaine['id_chaine'] ?>">Ajouter des utilisateurs</a></td>
                                <td class="tdchaine"><a href="/admin/parametre-chaines/delete.php?id=<?= $chaine['id_chaine'] ?>">Supprimer les utilisateurs de <?= $chaine['nom_chaine'] ?> </a></td>

                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot class="tfootchaine">
                        <tr class="trfoot">
                            <td class="tdfoot"><a class="afoot" href="/admin/parametre-chaines/new.php">Créer une chaîne</a></td>
                    </tr>
                    </tfoot>
                </table>
                
            </div>

<?php require $_SERVER['DOCUMENT_ROOT'] . "/includes/inc-bottom.php"; ?>