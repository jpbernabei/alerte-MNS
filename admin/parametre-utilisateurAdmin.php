<?php

require $_SERVER['DOCUMENT_ROOT'] . "/includes/inc-top-admin.php";
require $_SERVER['DOCUMENT_ROOT'] . "/managers/utilisateur-manager.php";

if (isset($_POST['submit'])) {
    $errors = [];
    // var_dump($_POST);die;
    $verifEmail = verifEmailEdit($_POST['utilisateur']);
    if ($verifEmail > 0) {
        $errors['email'] = "Cette adresse email est déjà utilisé.";
        header("Location: /admin/parametre-utilisateurAdmin.php");
        die;
    }

    $validEmail = $_POST['utilisateur']['email_utilisateur'];
    if (!(filter_var($validEmail, FILTER_VALIDATE_EMAIL)))
        //si la fonction filter_var retourne false on déclare une phrase d'erreur
        $errors['email'] = "Adresse Email non valide";

    //on vérifie si le champ n'est pas vide
    if (empty($_POST['utilisateur']['email_utilisateur']))
        $errors['email'] = "Adresse Email obligatoire";

    //on vérifie si le champ n'est pas vide
    if (empty($_POST['utilisateur']['nom_utilisateur']))
        $errors['nom'] = "Le nom est obligatoire.";

    //on vérifie si le champ n'est pas vide
    if (empty($_POST['utilisateur']['prenom_utilisateur']))
        $errors['prenom'] = "Le prénom est obligatoire.";

    if (count($errors) > 0) {
        $_SESSION['errors'] = $errors;
        $_SESSION['values'] = $_POST;
        header("Location: /admin/parametre-utilisateurAdmin.php");
        die;
    }

    $count = updateUserParamAdmin($_POST['utilisateur']);

    if ($count == 1) {

        header("Location: /admin/parametre-utilisateurAdmin.php");
        exit;
    }
}

if (isset($_SESSION['user']['id'])) {
    $user =  getUserById($_SESSION['user']['id']);
} else {

    header("Location: logout.php");
}


?>

<nav class="nav-chaine noMobile">
    <div>
       <a class="noMobile" href="/admin/index.php"><button class="button-chaines police">Accueil</button></a>
    </div>
    <div>
    <a class="noMobile" href="/admin/affiche-reunionsAdmin.php"><button class="button-chaines police">Réunion</button>
    </div>
    
    <div class="button-creation-container noMobile">
        <a href="/admin/creation-reunionAdmin.php"><button class="button-creation police"><i class="fa-solid fa-circle-plus" style="color: #ffffff;"></i>Créer une réunion</button></a>
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
            <form id="formEdit" class="formNewUser" action="/admin/parametre-utilisateurAdmin.php" method="POST">
                <input type="hidden" name="utilisateur[id_utilisateur]" value="<?= $user['id_utilisateur'] ?>">

                <div class="formForm">
                    <label>Email</label>
                    <input id="emailEdit" type="email" name="utilisateur[email_utilisateur]" value="<?= isset($_SESSION['values']['utilisateur']['email_utilisateur']) ? $_SESSION['values']['utilisateur']['email_utilisateur'] : $user['email_utilisateur'] ?>">
                    <?php if (isset($_SESSION['errors']['email'])) : ?>
                        <small><?= $_SESSION['errors']['email'] ?></small>
                    <?php endif; ?>
                    <div id="emailErrorEdit"></div>
                </div>

                <div class="formForm">

                    <label>Nom</label>
                    <input id="nameEdit" type="text" name="utilisateur[nom_utilisateur]" value="<?= isset($_SESSION['values']['utilisateur']['nom_utilisateur']) ? $_SESSION['values']['utilisateur']['nom_utilisateur'] : $user['nom_utilisateur'] ?>">
                    <?php if (isset($_SESSION['errors']['nom'])) : ?>
                        <small><?= $_SESSION['errors']['nom'] ?></small>
                    <?php endif; ?>
                    <div id="nameErrorEdit"></div>
                </div>

                <div class="formForm">
                    <label>Prenom</label>
                    <input id="prenomEdit" type="text" name="utilisateur[prenom_utilisateur]" value="<?= isset($_SESSION['values']['utilisateur']['prenom_utilisateur']) ? $_SESSION['values']['utilisateur']['prenom_utilisateur'] : $user['prenom_utilisateur'] ?>">
                    <?php if (isset($_SESSION['errors']['prenom'])) : ?>
                        <small><?= $_SESSION['errors']['prenom'] ?></small>
                    <?php endif; ?>
                    <div id="prenomErrorEdit"></div>
                </div>

                <div class="formForm">
                    <input type="submit" name="submit">
                </div>
            </form>
        </div>
        <?php unset($_SESSION['errors']);
        unset($_SESSION['values']); ?>
    </div>

</main>
<div class="side">

</div>
<script src="/assets/script/burgerMenu-script.js"></script>
<script src="/assets/script/utilisateurEdit-script.js"></script>
</body>

</html>