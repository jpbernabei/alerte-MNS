<?php
include '../../includes/inc-db-connect.php';

$dbh = $GLOBALS['dbh'];
$sql = 'SELECT * FROM utilisateur';
$query = $dbh->query($sql);
$utilisateurs=$query->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../style-parametre-admin.css">
    <script src="https://kit.fontawesome.com/18cbf17047.js" crossorigin="anonymous"></script>
    <title>Document</title>
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
            <a href="../logout.php"><i class="fa-solid fa-right-from-bracket fa-xl" style="color: #ffffff;"></i></a>
        </header>
        <nav class="nav-chaine">
            <div>
                <button class="button-chaines police">Messagerie</button>
            </div>
            <div >
                <button class="button-chaines police">MNS-Infos</button>
            </div>
            <div class="button-creation-container">
                <button class="button-creation police"><i class="fa-solid fa-circle-plus"
                        style="color: #ffffff;"></i>Créer une réunion</button>
                <button class="button-creation police"><i class="fa-solid fa-circle-plus"
                        style="color: #ffffff;"></i>Créer une chaine</button>
                        <div class="icone-parametre"><a class="icone-parametre" href=""><i class="fa-solid fa-gear fa-lg" style="color: #ffffff;"></i></a>
                
            </div>
        </nav>
        <main>
            <div >
                <h1>Liste des Utilisateurs</h1>
                <div class="">
        <span>Ajouter un utilisateur</span>
        <a href="#" >
             Nouvelle utilisateur
        </a>
        
        </div>
        <main>
            <div>
                <table>
                    <thead>
                        <th>ID</th>
                        <th>Email</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th></th>
                        <th>Activer/Désactiver</th>
                    </thead>
                    <tbody>
                        <?php foreach($utilisateurs as $utilisateur) {?>

                        <td><?=$utilisateur['id_utilisateur'] ?></td>
                        <td><?=$utilisateur['email_utilisateur'] ?></td>
                        <td><?=$utilisateur['nom_utilisateur'] ?></td>
                        <td><?=$utilisateur['prenom_utilisateur'] ?></td>
                        <td><a href="">modifier</a></td>
                        <td></td>
                    </tbody>
                </table>


            </div>
            <?php } ?>
        </main>
       
    </div>
</body>
</html>