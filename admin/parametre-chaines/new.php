<?php
// Pour ajouter une chaine 
// session_start();
require $_SERVER['DOCUMENT_ROOT'] . "/includes/inc-top-admin.php";
require $_SERVER['DOCUMENT_ROOT'] . '/managers/chaine-manager.php';
require $_SERVER['DOCUMENT_ROOT'] . "/managers/utilisateur-manager.php";


// Traiter le formulaire si envoyé
if (isset($_POST['submit'])) {
    $chaine = insertChaine($_POST['chaine'], $_POST['utilisateur'], $_SESSION['user']['id']);

    if ($chaine) {
        header("Location: /admin/parametre-chaines/index.php");
        exit;
    } else {
        echo "Un erreur est survenue...";
    }
}
$utilisateurs = getAllUser();



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
        <button class="button-chaines police"><i class="fa-solid fa-users " style="color: #ffffff;"></i>Réunions</button>
    </div>

    <div class="button-creation-container">

        <a href="../index.php"><button class="button-creation police"><i class="fa-solid fa-arrow-rotate-left"></i>Accueil</button></a>


    </div>
</nav>
<main>
    <div class="container py-5">
        <h1>Ajouter une chaîne</h1>
        <div class="row mb-4">
            <div class="col-auto">
                <a href="chaine-index.php" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Revenir...
                </a>
            </div>

        </div>

        <div class="row">
            <div class="col col-md-6">
                <form action="/admin/parametre-chaines/new.php" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="nom_chaine">Nom de la chaine</label>
                        <input type="text" class="form-control" name="chaine[nom_chaine]">
                    </div>
                    <input type="hidden" class="form-control" name="chaine[date_creation_chaine]" value="<?= date('Y-m-d') ?>" />
                    <input type="hidden" name="chaine[id_utilisateur]" value="<?= $_SESSION['user']['id'] ?>">
                    <div class="form-group">
                        <label for="actif_chaine">actif/desactif</label>
                        <input id="actifChaine" type="checkbox" value="1" name="chaine[actif_chaine]">
                        <input id="noActifChaine" type="hidden" value="0" name="chaine[actif_chaine]">
                    </div>
                    <?php foreach ($utilisateurs as $utilisateur) : ?>
                        <p>
                            <label>
                                <input type="checkbox" name="utilisateur[]" value="<?= $utilisateur["id_utilisateur"] ?>">
                                <?= $utilisateur['nom_utilisateur'] ?>
                            </label>
                        </p>
                    <?php endforeach ?>
                    <input type="submit" onclick='verificationActifChaine()' name="submit" value="Enregistrer" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>
    <script src="/assets/script/chaines-script.js"></script>
</main>