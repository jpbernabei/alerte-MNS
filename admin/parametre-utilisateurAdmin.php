<?php

require $_SERVER['DOCUMENT_ROOT'] . "/includes/inc-top-admin.php";
require $_SERVER['DOCUMENT_ROOT'] . "/managers/utilisateur-manager.php";

if (isset($_POST['submit'])) {
    $count = updateUser($_POST['utilisateur']);

    if ($count == 1) {

        header("Location: /parametre-utilisateurAdmin.php");
        exit;
    } 
}

if (isset($_SESSION['user']['id'])) {
    $user =  getUserById($_SESSION['user']['id']);
} else {

    header("Location: logout.php");
}


?>

<nav class="nav-chaine">
    <div>
        <button class="button-chaines police">Messagerie</button>
    </div>
    <div>
        <button class="button-chaines police">MNS-Infos</button>
    </div>
    <div class="button-creation-container">
        <a href="/user/parametre-reunions/new.php"><button class="button-creation police"><i class="fa-solid fa-circle-plus" style="color: #ffffff;"></i>Créer une réunion</button></a>
        <button class="button-creation police"><i class="fa-solid fa-circle-plus" style="color: #ffffff;"></i>Créer une chaine</button>
        <div class="icone-parametre"><a class="icone-parametre" href="./parametre-admin.php"><i class="fa-solid fa-gear fa-lg" style="color: #ffffff;"></i></a>

        </div>
</nav>

<main>
    <div class="container">

        <h1>Paramètres utilisateur</h1>

        <div class="buttonAjout">
            <a href="/admin/index.php"><button class="button-creation police"><i class="fa-solid fa-arrow-left" style="color: #ffffff;"></i>Retour</button></a>
            <a href="/admin/edit-passwordAdmin.php"><button class="button-creation police">Mot de passe</button></a>
        </div>
        
            <div class="container-form">
                <form class="formNewUser" action="/admin/parametre-utilisateurAdmin.php" method="POST">
                    <input type="hidden" name="utilisateur[id_utilisateur]" value="<?= $user['id_utilisateur'] ?>">

                    <label>Email</label>
                    <input type="email" name="utilisateur[email_utilisateur]" value="<?= $user['email_utilisateur'] ?>">

                    <label>Nom</label>
                    <input type="text" name="utilisateur[nom_utilisateur]" value="<?= $user['nom_utilisateur'] ?>">

                    <label>Prenom</label>
                    <input type="text" name="utilisateur[prenom_utilisateur]" value="<?= $user['prenom_utilisateur'] ?>">

                    <a href="/admin/edit-passwordAdmin.php">Modification du mot de passe</a>

                    <input type="submit" name="submit">
                </form>
            </div>
        
    </div>

</main>
<div class="side">

</div>


</body>

</html>