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
            <div class="button-parametre-admin-container">

              <!-- Il faut faire le modal ici -->
    <?php 
    require $_SERVER['DOCUMENT_ROOT'].'/managers/chaine-manager.php';
    $chaines = getAllChaine();
    ?>
    
<table>
    <thead>
        <tr>
            <th>Id</th>
            <th>Date</th>
            <th>Nom chaîne</th>
            <!-- <th>Les utilisateurs dans la chaîne</th> -->
            <th>Actif/Désactif</th>
            <th>Modifier les informations de la chaîne</th>
            <th>Ajouter un utilisateur</th>
            <th>Supprimer un utilisateur de la chaîne</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($chaines as $chaine): ?>
        <tr>
            <td><?= $chaine['id_chaine'] ?></td>
            <td><?= $chaine['date_creation_chaine'] ?></td>
            <td><?= $chaine['nom_chaine'] ?></td>
            <td><?= $chaine['actif_chaine'] ?></td>
      
            <td><a href="/admin/parametre-chaines/edit.php?id=<?= $chaine['id_chaine'] ?>">Modifier </a></td>
            <td><a href="/admin/parametre-chaines/addUser.php?id=<?= $chaine['id_chaine'] ?>">Ajouter des utilisateurs</a></td>
            <td><a href="/admin/parametre-chaines/delete.php?id=<?= $chaine['id_chaine'] ?>">Supprimer les utilisateurs de <?= $chaine['nom_chaine'] ?> </a></td>
         
        </tr>
        <?php endforeach; ?>
        <td><a href="/admin/parametre-chaines/new.php">Créer une chaîne</a></td>
    </tbody>
</table>
            </div>
        </main>
        
    </div>
</body>
</html>