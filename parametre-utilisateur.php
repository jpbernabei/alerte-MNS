<?php

require $_SERVER['DOCUMENT_ROOT'] . "/includes/inc-top.php";
require $_SERVER['DOCUMENT_ROOT'] . "/managers/utilisateur-manager.php";

if (isset($_POST['submit'])) {
    $errors = [];
    // var_dump($_POST);die;
    $verifEmail = verifEmailEdit($_POST['utilisateur']);
    if ($verifEmail > 0) {
        $errors['email'] = "Cette adresse email est déjà utilisée.";
        header("Location: /parametre-utilisateur.php");
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
        header("Location: /parametre-utilisateur.php");
        die;
    }

    $count = updateUserParamAdmin($_POST['utilisateur']);

    if ($count == 1) {

        header("Location: /parametre-utilisateur.php");
        exit;
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
        <a href="/index.php"><button class="button-chaines police">Accueil</button></a>
    </div>
    <div>
        <a href="/affiche-reunion.php"><button class="button-chaines police">Réunion</button></a>
    </div>
        <div class="button-creation-container">
            <a href="/user/parametre-reunions/new.php"><button class="button-creation police"><i class="fa-solid fa-circle-plus" style="color: #ffffff;"></i>Créer une réunion</button></a>
            <button class="button-creation police"><i class="fa-solid fa-circle-plus" style="color: #ffffff;"></i>Créer une chaine</button>
           
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
                <form id="formEdit" class="formNewUser" action="/parametre-utilisateur.php" method="POST">
                    <input type="hidden" name="utilisateur[id_utilisateur]" value="<?= $user['id_utilisateur'] ?>">

                    <label>Email</label>
                    <input id="emailEdit" type="email" name="utilisateur[email_utilisateur]" value="<?= $user['email_utilisateur'] ?>">
                    <?php if (isset($_SESSION['errors']['email'])) : ?>
                        <small><?= $_SESSION['errors']['email'] ?></small>
                    <?php endif; ?>
                    <small id="emailErrorEdit"> </small>

                    <label>Nom</label>
                    <input id="nameEdit" type="text" name="utilisateur[nom_utilisateur]" value="<?= isset($_SESSION['values']['utilisateur']['nom_utilisateur']) ? $_SESSION['values']['utilisateur']['nom_utilisateur'] : $user['nom_utilisateur'] ?>">
                    <?php if (isset($_SESSION['errors']['nom'])) : ?>
                        <small><?= $_SESSION['errors']['nom'] ?></small>
                    <?php endif; ?>
                    <small id="nameErrorEdit"> </small>

                    <label>Prénom</label>
                    <input id="prenomEdit" type="text" name="utilisateur[prenom_utilisateur]" value="<?= isset($_SESSION['values']['utilisateur']['prenom_utilisateur']) ? $_SESSION['values']['utilisateur']['prenom_utilisateur'] : $user['prenom_utilisateur'] ?>">
                    <?php if (isset($_SESSION['errors']['prenom'])) : ?>
                        <small><?= $_SESSION['errors']['prenom'] ?></small>
                    <?php endif; ?>
                    <small id="prenomErrorEdit"> </small>

                    <input type="submit" name="submit">
                </form>
            </div>
            <?php unset($_SESSION['errors']);
        unset($_SESSION['values']); ?>
        </div>

    </main>
    <div class="side">

    
    </div>
</div>
</div>
<script src="/assets/script/burgerMenu-script.js"></script>
<script src="/assets/script/utilisateurEdit-script.js"></script>
</body>

</html>