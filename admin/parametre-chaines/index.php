<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/index-chaine.css">
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
            
                <a href="./index.php"><button class="button-creation police"><i class="fa-solid fa-arrow-rotate-left"></i>Accueil</button></a>
                        
                
            </div>
        </nav>
        <main>
            <div class="button-parametre-admin-container">

              <!-- Il faut faire le modal ici -->
    <?php 
    require $_SERVER['DOCUMENT_ROOT'].'/managers.php';
    $chaines = getAllChaine();
    ?>
    
<table>
    <thead>
        <tr>
            <th>Id</th>
            <th>Date</th>
            <th>Nom chaîne</th>
            <th>Les utilisateurs dans la chaîne</th>
            <th>Actif/Désactive</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($chaines as $chaine): ?>
        <tr>
            <td><?= $chaine['id_chaine'] ?></td>
            <td><?= $chaine['date_creation_chaine'] ?></td>
            <td><?= $chaine['nom_chaine'] ?></td>
            <td><?= $chaine['nom_utilisateur'] ?></td>
            <td><?= $chaine['prenom_utilisateur'] ?></td>
            <td><?= $chaine['actif_chaine'] ?></td>
            
            <td><a href="/edit.php?id=<?= $chaine['id_chaine'] ?>">Modifier les informations de la chaîne</a></td>
            
            <td>
                <form action="/new.php" method="post" onsubmit="return confirm('Voulez-vous vraiment modifier cette chaîne ?')">
                    <input type="hidden" name="id_chaine" value="<?= $chaine['id_chaine'] ?>">
                    <input type="submit" value="Modifier" >
                </form>
            <td>
                <form action="/delete.php" method="post" onsubmit="return confirm('Voulez-vous vraiment désactiver cette chaîne ?')">
                    <input type="hidden" name="id_chaine" value="<?= $chaine['id_chaine'] ?>">
                    <input type="submit" value="Supprimer" >
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
        <td><a href="new.php">Créer une chaîne</a></td>
    </tbody>
</table>
            </div>
        </main>
        
    </div>
</body>
</html>