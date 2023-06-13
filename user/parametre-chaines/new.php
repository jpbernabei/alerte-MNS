<?php

// session_start();
require $_SERVER['DOCUMENT_ROOT'] . "/includes/inc-top.php";
require $_SERVER['DOCUMENT_ROOT'] . '/managers/chaineUser-manager.php';
// require $_SERVER['DOCUMENT_ROOT'] . "/managers/utilisateur-manager.php";


// Traiter le formulaire si envoyé
if (isset($_POST['submit'])) 
{
    $chaine = insertChaine($_POST['chaine'], $_POST['utilisateur'], $_SESSION['user']['id']);

    if ($chaine) {
        header("Location: /user/parametre-chaines/index.php");
        exit;
    } else {
        echo "Un erreur est survenue...";
    }
}
$utilisateurs = getAllUser();



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
        <a href="/user/parametre-chaines/index.php"><button class="button-creation police"><i class="fa-solid fa-circle-plus" style="color: #ffffff;"></i>Créer une chaine</button></a>

    </div>
</nav>
<main>
    <div class="container">
        <h1>Ajouter une chaîne</h1>

        <div class="buttonAjout">
            <a href="/user/parametre-chaines/index.php"><button class="button-creation police"><i class="fa-solid fa-arrow-left" style="color: #ffffff;"></i>Retour</button></a>
        </div>

        <div class="container-table desigend-scrollbar">

            <form action="/user/parametre-chaines/new.php" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="nom_chaine">Nom de la chaine</label>
                    <input type="text" class="form-control" name="chaine[nom_chaine]">
                </div>
                <input type="hidden" class="form-control" name="chaine[date_creation_chaine]" value="<?= date('Y-m-d') ?>" />
                <input type="hidden" name="chaine[id_utilisateur]" value="<?= $_SESSION['user']['id'] ?>">

                <?php foreach ($utilisateurs as $utilisateur) : ?>
                    <p>
                        <?php if ($utilisateur['id_utilisateur'] != $_SESSION['user']['id']) : ?>
                            <label>
                                <input type="checkbox" name="utilisateur[]" value="<?= $utilisateur["id_utilisateur"] ?>">
                                <?= $utilisateur['prenom_utilisateur'] ?> <?= $utilisateur['nom_utilisateur'] ?>
                            </label>
                        <?php endif ?>
                    </p>
                <?php endforeach ?>

                <input type="hidden" value="<?= date('Y-m-d') ?>" name="salon[date_creation_salon]">
                <input type="hidden" value="Général" name="salon[nom_salon]">
                <input type="hidden" value="1" name="salon[actif_salon]">
                <input type="hidden" value="salon[id_chaine]" name="salon[id_chaine]">

                <input type="submit" onclick='verificationActifChaine()' name="submit" value="Enregistrer" class="btn btn-primary">
            </form>

        </div>
    </div>
    <script src="/assets/script/chaines-script.js"></script>
</main>