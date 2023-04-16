<?php
// session_start();
require $_SERVER['DOCUMENT_ROOT'] . '/includes/inc-db-connect.php';
require $_SERVER['DOCUMENT_ROOT'] . "/managers/utilisateur-manager.php";

if (isset($_POST['submit'])) {
    $count = updateUser($_POST['utilisateur']);

    if ($count == 1) {
        
        header("Location: /admin/parametre-utilisateurs/index.php"); exit;
    } else {
        echo ("UNE ERREUR C'EST PRODUITE");
    }
}

// On vérifie le paramètre id dans l'url
if (empty($_GET['id'])) {
    header("Location: /admin/parametre-utilisateurs/index.php");
    exit;
}

$user = getUserById($_GET['id']);

if (!$user) // $user == null
{
    header("Location: /admin/parametre-utilisateurs/index.php");
    exit;
}

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
            <a href="/admin/parametre-utilisateurs/index.php"><button class="button-chaines police"><i class="fa-solid fa-user" style="color: #ffffff ;" ></i>Utilisateurs</button></a>
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

                <a href="../index.php"><button class="button-creation police"><i class="fa-solid fa-arrow-rotate-left"></i>Accueil</button></a>


            </div>
        </nav>
        <main>
            <form class="formNewUser" action="/admin/parametre-utilisateurs/edit.php?id=<?= $_GET['id'] ?>" method="POST">
                <input type="hidden" name="utilisateur[id_utilisateur]" value="<?= $user['id_utilisateur'] ?>">

                <label>Email</label>
                <input type="email" name="utilisateur[email_utilisateur]" value="<?= $user['email_utilisateur'] ?>">

                <label>Nom</label>
                <input type="text" name="utilisateur[nom_utilisateur]" value="<?= $user['nom_utilisateur'] ?>">

                <label>Prenom</label>
                <input type="text" name="utilisateur[prenom_utilisateur]" value="<?= $user['prenom_utilisateur'] ?>">

                <label>numéro d'adresse</label>
                <input type="text" name="utilisateur[num_adresse_utilisateur]" value="<?= $user['num_adresse_utilisateur'] ?>">

                <label>rue</label>
                <input type="text" name="utilisateur[rue_adresse_utilisateur]" value="<?= $user['rue_adresse_utilisateur'] ?>">

                <label>Code postal</label>
                <input type="text" name="utilisateur[code_postal_utilisateur]" value="<?= $user['code_postal_utilisateur'] ?>">

                <label>Ville</label>
                <input type="text" name="utilisateur[ville_adresse_utilisateur]" value="<?= $user['ville_adresse_utilisateur'] ?>">

                <label for="">Actif</label>
                <input id="actifUser" type="checkbox" value="<?= $user['actif_utilisateur'] ?>" name="utilisateur[actif_utilisateur]">
                <input id="noActifUser" type="hidden" value="0" name="utilisateur[actif_utilisateur]">



                <input type="submit" onclick='verificationActifUser()' name="submit">
            </form>
        </main>

    </div>
    <script src="/assets/script/utilisateur-script.js"></script>
</body>

</html>