<?php
require $_SERVER['DOCUMENT_ROOT'] . '/includes/inc-top.php';
require $_SERVER['DOCUMENT_ROOT'] . "/managers/reunion-manager.php";
require $_SERVER['DOCUMENT_ROOT'] . "/managers/utilisateur-manager.php";


//on vérifie si le formulaire est envoyé
if (isset($_POST['submit'])) {

    //si il est envoyé on appel la fonction insertReunion et on stock l'id de la reunion ajouté dans une varible
    $id = insertReunion($_POST['reunion'], $_POST['utilisateur'], $_SESSION['user']['id']);


    //si il y a bien un id on redirige vers l'index
    if ($id) {
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
        <button class="button-chaines police">Messagerie</button>
    </div>
    <div>
        <button class="button-chaines police">MNS-Infos</button>
    </div>
    <div class="button-creation-container">
        <button class="button-creation police"><i class="fa-solid fa-circle-plus" style="color: #ffffff;"></i>Créer une réunion</button>
        <button class="button-creation police"><i class="fa-solid fa-circle-plus" style="color: #ffffff;"></i>Créer une chaine</button>
        <div class="icone-parametre"><a class="icone-parametre" href="./admin/parametre-admin.html"><i class="fa-solid fa-gear fa-lg" style="color: #ffffff;"></i></a>

        </div>
</nav>
<nav class="nav-salon">

</nav>
<main>
    <div class="container-reunion">
        <h1>creer une réunion :</h1>
        <!-- formulaire pour l'ajout d'utilisateur -->
        <div class="container-formReunion desigend-scrollbar">
        <form class="formNewUser" action="/user/parametre-reunions/new.php" method="POST">
            <label for="reunion[nom_reunion]">Nom de la réunion</label>
            <input type="text" name="reunion[nom_reunion]">

            <input type="hidden" name="reunion[id_utilisateur]" value="<?= $_SESSION['user']['id'] ?>">
            <label for="reunion[sujet_reunion]">Sujet de la réunion</label>
            <textarea name="reunion[sujet_reunion]" cols="30" rows="10"></textarea>

            <input type="hidden" name="reunion[date_creation_reunion]" value="<?= date("Y-m-d") ?>">

            <label for="">Date de la réunion</label>
            <input type="date" name="reunion[date_prevu_reunion]">

            <label for="">Heure de la réunion</label>
            <input type="time" name="reunion[heure_prevu_reunion]">

            <label for="">Invités</label>
            <!-- on récupere les utilisateur avec foreach et on les mets dans un select -->
            <div>
            <?php foreach ($utilisateurs as $utilisateur) : ?>
                <p>
                    <label>
                        <input type="checkbox" name="utilisateur[]" value="<?= $utilisateur["id_utilisateur"] ?>">
                        <?= $utilisateur['nom_utilisateur'] ?>
                    </label>
                </p>
            <?php endforeach ?>
            </div>

            <input type="hidden" value="<?= $_SESSION['user']['id'] ?>" name="">

            <input type="submit"  name="submit">
        </form>
    </div>
    </div>
</main>
<div class="side">

</div>
</div>
</body>

</html>