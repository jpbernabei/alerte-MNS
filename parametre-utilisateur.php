<?php

require $_SERVER['DOCUMENT_ROOT'] . "/includes/inc-top.php";
require $_SERVER['DOCUMENT_ROOT'] . "/managers/utilisateur-manager.php";

if (isset($_POST['submit'])) {
    $count = updateUser($_POST['utilisateur']);

    if ($count == 1) {

        header("Location: /parametre-utilisateur.php");
        exit;
    } else {
        echo ("UNE ERREUR C'EST PRODUITE");
    }
}

if (isset($_SESSION['user']['id'])) {
    $user =  getUserById($_SESSION['user']['id']);
} else {

    header("Location: logout.php");
}


?>
<div class="paramUtilisateurMobile">
    <nav class="nav-chaine navParamUtilisateur">
        <div>
            <button class="button-chaines police">Messagerie</button>
        </div>
        <div>
            <button class="button-chaines police">MNS-Infos</button>
        </div>
        <div class="button-creation-container">
            <a href="/user/parametre-reunions/new.php"><button class="button-creation police"><i class="fa-solid fa-circle-plus" style="color: #ffffff;"></i>Créer une réunion</button></a>
            <button class="button-creation police"><i class="fa-solid fa-circle-plus" style="color: #ffffff;"></i>Créer une chaine</button>
            <div class="icone-parametre"><a class="icone-parametre" href="./admin/parametre-admin.html"><i class="fa-solid fa-gear fa-lg" style="color: #ffffff;"></i></a></div>
        </div>
        </div>
    </nav>
    <nav class="nav-salon navParamUtilisateur">
    </nav>
    <main class="mainParamUser">
        <div class="containerParamUser">

            <h1 class="h1-ParamUser">Paramètres utilisateur</h1>

            <div class="buttonAjout ">
                <a class="buttonParamuser" href="/index.php"><button class="button-creation police"><i class="fa-solid fa-arrow-left" style="color: #ffffff;"></i>Retour</button></a>

                <a class="buttonParamuser" href="/edit-password.php"><button class="button-creation police"><i class="fa-solid fa-lock-keyhole" style="color: #ffffff;"></i>Modification du mot de passe</button></a>
            </div>

            <div class="container-form">
                <form class="formNewUser" action="/parametre-utilisateur.php" method="POST">
                    <input type="hidden" name="utilisateur[id_utilisateur]" value="<?= $user['id_utilisateur'] ?>">

                    <label>Email</label>
                    <input type="email" name="utilisateur[email_utilisateur]" value="<?= $user['email_utilisateur'] ?>">

                    <label>Nom</label>
                    <input type="text" name="utilisateur[nom_utilisateur]" value="<?= $user['nom_utilisateur'] ?>">

                    <label>Prenom</label>
                    <input type="text" name="utilisateur[prenom_utilisateur]" value="<?= $user['prenom_utilisateur'] ?>">

                    <input type="submit" name="submit">
                </form>
            </div>
        </div>

    </main>
    <div class="side">

    
    </div>
</div>
</div>
<script src="/assets/script/burgerMenu-script.js"></script>
</body>

</html>