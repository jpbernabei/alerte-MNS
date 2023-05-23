<?php
// session_start();
require $_SERVER['DOCUMENT_ROOT'] . '/includes/inc-db-connect.php';
require $_SERVER['DOCUMENT_ROOT'] . "/managers/utilisateur-manager.php";
require $_SERVER['DOCUMENT_ROOT'] . "/includes/inc-top-admin.php";

if (isset($_POST['submitForm'])) {
    $count = updateUser($_POST['utilisateur']);

    if ($count == 1) {

        header("Location: /admin/parametre-utilisateurs/index.php");
        exit;
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

<nav class="nav-chaine">
    <div>
        <a href="/admin/parametre-utilisateurs/index.php"><button class="button-chaines police"><i class="fa-solid fa-user" style="color: #ffffff ;"></i>Utilisateurs</button></a>
    </div>
    <div>
        <button class="button-chaines police"><i class="fa-solid fa-fire" style="color: #ffffff;"></i>Chaînes</button>
    </div>
    <div>
        <button class="button-chaines police"><i class="fa-solid fa-sitemap" style="color: #ffffff;"></i>Salons</button>
    </div>
    <div>
        <a href="/admin/parametre-reunions/index.php"><button class="button-chaines police"><i class="fa-solid fa-users " style="color: #ffffff;"></i>Réunions</button></a>
    </div>

    <div class="button-creation-container">

        <a href="../index.php"><button class="button-creation police"><i class="fa-solid fa-arrow-rotate-left"></i>Accueil</button></a>


    </div>
</nav>
<main>
    <div class="container">

        <h1>Modifier l'utilisateur</h1>

        <div class="buttonAjout">
            <a href="/admin/parametre-utilisateurs/index.php"><button class="button-creation police"><i class="fa-solid fa-arrow-left" style="color: #ffffff;"></i>Retour</button></a>
        </div>
        <div class="container-form">

            <form id="formEdit" class="formNewUser" action="/admin/parametre-utilisateurs/edit.php?id=<?= $_GET['id'] ?>" method="POST">
                <input type="hidden" name="utilisateur[id_utilisateur]" value="<?= $user['id_utilisateur'] ?>">


                <label>Email</label>
                <input id="emailEdit" type="email" name="utilisateur[email_utilisateur]" value="<?= $user['email_utilisateur'] ?>" required >
                    <div id="emailErrorEdit" ></div>

                <label>Nom</label>
                <input id="nameEdit" type="text" name="utilisateur[nom_utilisateur]" value="<?= $user['nom_utilisateur'] ?>">
                <div id="nameErrorEdit" ></div>

                <label>Prenom</label>
                <input id="prenomEdit" type="text" name="utilisateur[prenom_utilisateur]" value="<?= $user['prenom_utilisateur'] ?>">
                <div id="prenomErrorEdit" ></div>
<!-- 
                <label>numéro d'adresse</label>
                <input type="text" name="utilisateur[num_adresse_utilisateur]" value="<?= $user['num_adresse_utilisateur'] ?>">

                <label>rue</label>
                <input type="text" name="utilisateur[rue_adresse_utilisateur]" value="<?= $user['rue_adresse_utilisateur'] ?>">

                <label>Code postal</label>
                <input type="text" name="utilisateur[code_postal_utilisateur]" value="<?= $user['code_postal_utilisateur'] ?>">

                <label>Ville</label>
                <input type="text" name="utilisateur[ville_adresse_utilisateur]" value="<?= $user['ville_adresse_utilisateur'] ?>"> -->


                <input type="submit" onclick='verificationActifUser()' name="submitForm">
            </form>
        </div>
    </div>
</main>

</div>
<script src="/assets/script/utilisateurEdit-script.js"></script>
</body>

</html>