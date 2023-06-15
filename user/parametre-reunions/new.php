<?php
require $_SERVER['DOCUMENT_ROOT'] . '/includes/inc-top.php';
require $_SERVER['DOCUMENT_ROOT'] . "/managers/reunion-manager.php";
require $_SERVER['DOCUMENT_ROOT'] . "/managers/utilisateur-manager.php";


//on vérifie si le formulaire est envoyé
if (isset($_POST['envoie'])) {
    // var_dump($_POST);die;
    $errors = [];

    if(empty($_POST['reunion']['nom_reunion']))
    $errors['nom_reunion'] = 'La réunion doit avoir un nom.' ;

    if(empty($_POST['reunion']['sujet_reunion']))
    $errors['sujet_reunion'] = 'La réunion doit avoir un sujet.' ;

    if(empty($_POST['reunion']['date_prevu_reunion']))
    $errors['date_prevu_reunion'] = 'La réunion doit avoir une date de prévu.' ;

    if(empty($_POST['reunion']['heure_prevu_reunion']))
    $errors['heure_prevu_reunion'] = 'La réunion doit avoir une heure de prévu.' ;

    if(empty($_POST['utilisateur']))
    $errors['utilisateur'] = 'La réunion doit avoir un participant.' ;

    if(count($errors) > 0)
{
    $_SESSION['errors'] = $errors;
    $_SESSION['values'] = $_POST;

    header("Location: /user/parametre-reunions/new.php"); die;}

    //s'il est envoyé on appelle la fonction insertReunion et on stocke l'id de la reunion ajoutée dans une variable
    $id = insertReunion($_POST['reunion'], $_POST['utilisateur'], $_SESSION['user']['id']);


    //s'il y a bien un id on redirige vers l'index
    if ($id) {
        unset($_SESSION['errors']);
        unset($_SESSION['values']);
        header("Location: /index.php");
        exit;
    } else {
        echo "Un erreur est survenue...";
    }
}


$utilisateurs = getAllUser();

?>
<nav class="nav-chaine">
    <div>
        <a href="/index.php"><button class="button-chaines police">Accueil</button></a>
    </div>
    <div>
        <a href="/affiche-reunion.php"><button class="button-chaines police">Réunion</button></a>
    </div>
    <div class="button-creation-container">
        <button class="button-creation police"><i class="fa-solid fa-circle-plus" style="color: #ffffff;"></i>Créer une réunion</button>
        <button class="button-creation police"><i class="fa-solid fa-circle-plus" style="color: #ffffff;"></i>Créer une chaine</button>

        </div>
</nav>
<nav class="nav-salon">

</nav>
<main>
    <div class="container-reunion">
        <h1>Créer une réunion </h1>
        <!-- formulaire pour l'ajout d'utilisateur -->
        <div class="container-formReunion desigend-scrollbar">
        <form id="form" class="formNewUser" action="/user/parametre-reunions/new.php" method="POST">

            <label for="nomReunion">Nom de la réunion</label>
            <input id="nomReunion" type="text" name="reunion[nom_reunion]">
            <small id="nomReunionError"></small>
            <?php if(isset($_SESSION['errors']['nom_reunion'])): ?>
                    <small><?= $_SESSION['errors']['nom_reunion'] ?></small>
                    <?php endif; ?>
                

            <input type="hidden" name="reunion[id_utilisateur]" value="<?= $_SESSION['user']['id'] ?>">

            <label for="sujetReunion">Sujet</label>
            <textarea id="sujetReunion" name="reunion[sujet_reunion]" cols="30" rows="10"></textarea>
            <small id="sujetReunionError"></small>
                <?php if(isset($_SESSION['errors']['sujet_reunion'])): ?>
                    <small><?= $_SESSION['errors']['sujet_reunion'] ?></small>
                    <?php endif; ?>
                

            <input type="hidden" name="reunion[date_creation_reunion]" value="<?= date("Y-m-d") ?>">

            <label for="dateReunion">Date </label>
            <input id="dateReunion" type="date" name="reunion[date_prevu_reunion]">
            <small id="dateReunionError"></small>
            <?php if(isset($_SESSION['errors']['date_prevu_reunion'])): ?>
                    <small><?= $_SESSION['errors']['date_prevu_reunion'] ?></small>
                    <?php endif; ?>

            <label for="heureReunion">Heure </label>
            <input id="heureReunion" type="time" name="reunion[heure_prevu_reunion]">
            <small id="heureReunionError"></small>
            <?php if(isset($_SESSION['errors']['heure_prevu_reunion'])): ?>
                    <small><?= $_SESSION['errors']['heure_prevu_reunion'] ?></small>
                    <?php endif; ?>

            <label for="">Invités</label>
            <?php if(isset($_SESSION['errors']['utilisateur'])): ?>
                    <small><?= $_SESSION['errors']['utilisateur'] ?></small>
                    <?php endif; ?>
    
            <!-- on récupere les utilisateurs avec foreach et on les met dans un select -->
            <div>
            <?php foreach ($utilisateurs as $utilisateur) : ?>
                <p>
                <?php if ($utilisateur["id_utilisateur"] != $_SESSION['user']['id']) : ?>
                    <label>
                        <input type="checkbox" name="utilisateur[]" value="<?= $utilisateur["id_utilisateur"] ?>">
                        <?= $utilisateur["prenom_utilisateur"] ?> <?= $utilisateur['nom_utilisateur'] ?>
                        <?php endif; ?>
                    </label>
                </p>
            <?php endforeach ?>
            </div>
            <input id="actifReunion" type="hidden" value="1" name="reunion[actif_reunion]">
            <input type="hidden" value="<?= $_SESSION['user']['id'] ?>" name="<?= $_SESSION['user']['id'] ?>">

            <input type="submit"  name="envoie">
        </form>
    </div>
    <?php unset($_SESSION['errors']);?>
    </div>
</main>
<div class="side">

</div>
</div>
<script src="/assets/script/reunion-script.js"></script>
</body>

</html>