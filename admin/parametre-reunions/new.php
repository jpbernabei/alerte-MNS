<?php
require $_SERVER['DOCUMENT_ROOT'] . "/managers/reunion-manager.php";
require $_SERVER['DOCUMENT_ROOT'] . "/managers/utilisateur-manager.php";
require $_SERVER['DOCUMENT_ROOT'] . "/includes/inc-top-admin.php";


//on vérifie si le formulaire est envoyé
if (isset($_POST['submit'])) {

    //si il est envoyé on appel la fonction insertReunion et on stock l'id de la reunion ajouté dans une varible
    $id = insertReunion($_POST['reunion'], $_POST['utilisateur'], $_SESSION['user']['id']);


    //si il y a bien un id on redirige vers l'index
    if ($id) {
        header("Location: /admin/parametre-reunions/index.php");
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
        <a href="/admin/parametre-chaines/index.php"><button class="button-chaines police"><i class="fa-solid fa-fire" style="color: #ffffff;"></i>Chaînes</button></a>
    </div>
    <div>
        <a href="/admin/parametre-salons/index.php"><button class="button-chaines police"><i class="fa-solid fa-sitemap" style="color: #ffffff;"></i>Salons</button></a>
    </div>
    <div>
        <a href="/admin/parametre-reunions/index.php"><button class="button-chaines police"><i class="fa-solid fa-users " style="color: #ffffff;"></i>Réunions</button></a>
    </div>

    <div class="button-creation-container">

        <a href="./index.php"><button class="button-creation police"><i class="fa-solid fa-arrow-rotate-left"></i>Accueil</button></a>

    </div>
</nav>
<main>
    <div class="container">
        <h1>Créer une réunion</h1>
        <div class="buttonAjout">
            <a href="/admin/parametre-reunions/index.php"><button class="button-creation police"><i class="fa-solid fa-arrow-left" style="color: #ffffff;"></i>Retour</button></a>
        </div>
        <div class="container-form desigend-scrollbar">

            <!-- formulaire pour la creation d'une reunion -->
            <form class="formNewUser" action="/admin/parametre-reunions/new.php" method="POST">
                <label for="reunion[nom_reunion]">Nom de la réunion :</label>
                <input type="text" name="reunion[nom_reunion]">

                <input type="hidden" name="reunion[id_utilisateur]" value="<?= $_SESSION['user']['id'] ?>">
                <label for="reunion[sujet_reunion]">Sujet de la réunion :</label>
                <textarea name="reunion[sujet_reunion]" cols="30" rows="10"></textarea>

                <input type="hidden" name="reunion[date_creation_reunion]" value="<?= date("Y-m-d") ?>">

                <label for="">Date de la réunion :</label>
                <input type="date" name="reunion[date_prevu_reunion]">

                <label for="">Heure de la réunion :</label>
                <input type="time" name="reunion[heure_prevu_reunion]">

                <label for="">Invités :</label>
                <!-- on récupere les utilisateur avec foreach et on les mets dans un select -->
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


                <!-- toggle switch pour actif reunion -->
                <label class="toggle">Actif :
                    <input id="actifReunion" class="toggle-checkbox" type="checkbox" value="1" name="reunion[actif_reunion]">
                    <div class="toggle-switch"></div>
                    <span class="toggle-label"></span>
                </label>
                <input id="noActifReunion" type="hidden" value="0" name="reunion[actif_reunion]">

                <input type="hidden" value="<?= $_SESSION['user']['id'] ?>" name="">


                <!-- verficationActifUser est une fonction JS pour donner une valeur booleen à la checkbox: 0 si elle n'est pas coché, 1 si elle l'est -->
                <input type="submit" onclick='verificationActifReunion()' name="submit">
            </form>
        </div>
    </div>
</main>

</div>
<script src="/assets/script/reunion-script.js"></script>
</body>

</html>