<?php
// Pour ajouter une chaine 
// session_start();
require $_SERVER['DOCUMENT_ROOT'] . "/includes/inc-top-admin.php";
require $_SERVER['DOCUMENT_ROOT'] . '/managers/chaine-manager.php';
require $_SERVER['DOCUMENT_ROOT'] . "/managers/utilisateur-manager.php";


// Traiter le formulaire si envoyé
if (isset($_POST['submit'])) {

$errors = [];

    if(empty($_POST['chaine']['nom_chaine']))
    $errors['nom_chaine'] = "le champ ne doit pas etre vide";
    
    if(count($errors) > 0)
    {
        $_SESSION['errors'] = $errors;
        header("Location: /admin/parametre-chaines/new.php");
        die;
    }


    $chaine = insertChaine($_POST['chaine'], $_POST['utilisateur'], $_SESSION['user']['id']);

    if ($chaine) {
        unset($_SESSION['errors']);
        unset($_SESSION['values']);
        header("Location: /admin/parametre-chaines/index.php");
        exit;
    } else {
        echo "Une erreur s'est produite lors de la suppression."; 
    }
}
$utilisateurs = getAllUser();



?>


<nav class="nav-chaine">
    <div>
        <a href="/admin/parametre-utilisateurs/index.php"><button class="button-chaines police"><i class="fa-solid fa-user" style="color: #ffffff ;"></i>Utilisateurs</button></a>
    </div>
    <div>
        <a href="/admin/parametre-chaines/index.php"><button class="button-chaines police"><i class="fa-solid fa-fire" style="color: #ffffff;"></i>Chaînes</button></a>
    </div>
    <div>
        <a href="/admin/parametre-salons/index.php"><button class="button-chaines police"><i class="fa-solid fa-sitemap" style="color: #ffffff;"></i>Salons</button></a>
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
        <h1>Ajouter une chaîne</h1>

        <div class="buttonAjout">
            <a href="/admin/index.php"><button class="button-creation police"><i class="fa-solid fa-arrow-left" style="color: #ffffff;"></i>Retour</button></a>
        </div>



        <div class="container-table desigend-scrollbar">

            <form action="/admin/parametre-chaines/new.php" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="nom_chaine">Nom de la chaine</label>
                    <input type="text" class="form-control" name="chaine[nom_chaine]">
                    <?php if (isset($_SESSION['errors']['nom_chaine'])) : ?>
                        <p><small><?= $_SESSION['errors']['nom_chaine'] ?></small></p>
                    <?php endif; ?>
                </div>
                <input type="hidden" class="form-control" name="chaine[date_creation_chaine]" value="<?= date('Y-m-d') ?>" />
                <input type="hidden" name="chaine[id_utilisateur]" value="<?= $_SESSION['user']['id'] ?>">

                    <label class="toggle">Chaîne actif
                        <input id="actifChaine" class="toggle-checkbox" type="checkbox" value="1" name="chaine[actif_chaine]">
                        <div class="toggle-switch"></div>
                        <span class="toggle-label"></span>
                    </label>
                    <input id="noActifChaine" type="hidden" value="0" name="chaine[actif_chaine]">
               
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
        <?php unset($_SESSION['errors']);?>
    </div>
    <script src="/assets/script/chaines-script.js"></script>
</main>