<?php
session_start();
var_dump($_SESSION['user']);
require $_SERVER['DOCUMENT_ROOT'] . "/managers/reunion-manager.php";
require $_SERVER['DOCUMENT_ROOT'] . "/managers/utilisateur-manager.php";


//on vérifie si le formulaire est envoyé
if(isset($_POST['submit']))
{

    //si il est envoyé on appel la fonction insertReunion et on stock l'id de la reunion ajouté dans une varible
    $id = insertReunion($_POST['reunion'],$_POST['utilisateur'],$_SESSION['user']['id'] );


    //si il y a bien un id on redirige vers l'index
    if($id)
    {
        header("Location: /admin/parametre-reunions/index.php"); exit;
    }
    else
    {
        echo "Un erreur est survenue...";
    }

}

$utilisateurs = getAllUser();

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/../assets/css/style-parametre-admin.css">
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
            <a href="/logout.php"><i class="fa-solid fa-right-from-bracket fa-xl" style="color: #ffffff;"></i></a>
        </header>
        <nav class="nav-chaine">
            <div>
                <a href="/admin/parametre-utilisateurs/index.php"><button class="button-chaines police"><i class="fa-solid fa-user" style="color: #ffffff ;" ></i>Utilisateurs</button></a>
            </div>
            <div >
                <a href="/admin/parametre-chaines/index.php"><button class="button-chaines police"><i class="fa-solid fa-fire" style="color: #ffffff;"></i>Chaînes</button></a>
            </div>
            <div >
                <a href="/admin/parametre-salons/index.php"><button class="button-chaines police"><i class="fa-solid fa-sitemap" style="color: #ffffff;"></i>Salons</button></a>
            </div>
            <div >
                <a href="/admin/parametre-reunions/index.php"><button class="button-chaines police"><i class="fa-solid fa-users " style="color: #ffffff;"></i>Réunions</button></a>
            </div>
            
            <div class="button-creation-container">
            
                <a href="./index.php"><button class="button-creation police"><i class="fa-solid fa-arrow-rotate-left"></i>Accueil</button></a>
                        
            </div>
        </nav>
        <main>
        <div>
    <!-- formulaire pour l'ajout d'utilisateur -->
<form class="formNewUser" action="/admin/parametre-reunions/new.php" method="POST">
    <label for="reunion[nom_reunion]">Nom de la réunion</label>
    <input type="text" name="reunion[nom_reunion]" >

    <input type="hidden" name="reunion[id_utilisateur]" value="<?=$_SESSION['user']['id']?>">
    <label for="reunion[sujet_reunion]">Sujet de la réunion</label>
    <textarea name="reunion[sujet_reunion]" cols="30" rows="10"></textarea>

    <input type="hidden" name="reunion[date_creation_reunion]" value="<?=date("Y-m-d")?>">

    <label for="">Date de la réunion</label>
    <input type="date" name="reunion[date_prevu_reunion]">

    <label for="">Heure de la réunion</label>
    <input type="time" name="reunion[heure_prevu_reunion]">

    <label for="">Invités</label>
    <!-- on récupere les utilisateur avec foreach et on les mets dans un select -->
    
    <?php foreach($utilisateurs as $utilisateur): ?>
        <p>
        <label>
            <input type="checkbox" name="utilisateur[]" value="<?= $utilisateur["id_utilisateur"] ?>">
            <?= $utilisateur['nom_utilisateur'] ?>
        </label>
    </p>
     <?php endforeach ?>
    
    
<!-- toggle switch pour actif reunion -->
    <label class="toggle">
    <input id="actifReunion" class="toggle-checkbox" type="checkbox" value="1" name="reunion[actif_reunion]">
    <div class="toggle-switch"></div>
    <span class="toggle-label"></span>
    </label>
    <input id="noActifReunion" type="hidden" value="0" name="reunion[actif_reunion]" >

    <input type="hidden" value="<?=$_SESSION['user']['id'] ?>" name="">
    
    
    <!-- verficationActifUser est une fonction JS pour donner une valeur booleen à la checkbox: 0 si elle n'est pas coché, 1 si elle l'est -->
        <input  type="submit" onclick='verificationActifReunion()'  name="submit">
</form>
</div>
        </main>
        
    </div>
    <script src="/assets/script/reunion-script.js" ></script>
</body>
</html>