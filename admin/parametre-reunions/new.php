<?php
require $_SERVER['DOCUMENT_ROOT'] . "/managers/reunion-manager.php";
require $_SERVER['DOCUMENT_ROOT'] . "/managers/utilisateur-manager.php";
require $_SERVER['DOCUMENT_ROOT'] . "/includes/inc-top-admin.php";


//on vérifie si le formulaire est envoyé
if (isset($_POST['envoie'])) {
    //on déclare une variable de type tableau où l'on mettra les messages d'erreurs
    $errors = [];
// on vérifie si les champs sont vides, s' ils le sont on créé une phrase d'erreur dans un tableau
    if(empty($_POST['reunion']['nom_reunion']))
    $errors['nom_reunion'] = 'La réunion doit avoir un nom.' ;

    if(empty($_POST['reunion']['sujet_reunion']))
    $errors['sujet_reunion'] = 'La réunion doit avoir un sujet.' ;

    if(empty($_POST['reunion']['date_prevu_reunion']))
    $errors['date_prevu_reunion'] = 'La réunion doit avoir une date prévue.' ;

    if(empty($_POST['reunion']['heure_prevu_reunion']))
    $errors['heure_prevu_reunion'] = 'La réunion doit avoir une heure prévue.' ;

    if(empty($_POST['utilisateur']))
    $errors['utilisateur'] = 'La réunion doit avoir un participant.' ;
//on vérifie s'il y a une erreur.S'il y a une erreur on la met dans le tableau $_SESSION['errors']
//on met la valeur des champs dans le tableau $_SESSION['values']
    if(count($errors) > 0)
{
    $_SESSION['errors'] = $errors;
    $_SESSION['values'] = $_POST;

    header("Location: /admin/parametre-reunions/new.php"); die;}

    //s'il est envoyé on appel la fonction insertReunion et on stock l'id de la reunion ajouté dans une varible
    $id = insertReunion($_POST['reunion'], $_POST['utilisateur'], $_SESSION['user']['id']);


    //s'il y a bien un id on redirige vers l'index
    if ($id) {
        unset($_SESSION['errors']);
        unset($_SESSION['values']);
        header("Location: /admin/parametre-reunions/index.php");
        exit;
    } else {
        header("Location: /404.php");die;
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
        <div class="container-formNewReunion desigend-scrollbar">

            <!-- formulaire pour la creation d'une reunion -->
            <form id="form" class="formNewUser" action="/admin/parametre-reunions/new.php" method="POST">

                <div class="formForm">
                <label for="nomReunion">Nom de la réunion :</label>
                <input id="nomReunion" type="text" name="reunion[nom_reunion]">
                <small id="nomReunionError"></small>
                <?php if(isset($_SESSION['errors']['nom_reunion'])): ?>
                    <small><?= $_SESSION['errors']['nom_reunion'] ?></small>
                    <?php endif; ?>
                </div>

                <input type="hidden" name="reunion[id_utilisateur]" value="<?= $_SESSION['user']['id'] ?>">

                <div class="formForm">
                <label for="sujetReunion">Sujet :</label>
                <textarea id="sujetReunion" name="reunion[sujet_reunion]" cols="30" rows="10"></textarea>
                <small id="sujetReunionError"></small>
                <?php if(isset($_SESSION['errors']['sujet_reunion'])): ?>
                    <small><?= $_SESSION['errors']['sujet_reunion'] ?></small>
                    <?php endif; ?>
                </div>

                <input type="hidden" name="reunion[date_creation_reunion]" value="<?= date("Y-m-d") ?>">

                <div class="formForm">
                <label for="dateReunion">Date :</label>
                <input id="dateReunion" type="date" name="reunion[date_prevu_reunion]">
                <small id="dateReunionError"></small>
                <?php if(isset($_SESSION['errors']['date_prevu_reunion'])): ?>
                    <small><?= $_SESSION['errors']['date_prevu_reunion'] ?></small>
                    <?php endif; ?>
                </div>

                <div class="formForm">
                <label for="heureReunion">Heure :</label>
                <input id="heureReunion" type="time" name="reunion[heure_prevu_reunion]">
                <small id="heureReunionError"></small>
                <?php if(isset($_SESSION['errors']['heure_prevu_reunion'])): ?>
                    <small><?= $_SESSION['errors']['heure_prevu_reunion'] ?></small>
                    <?php endif; ?>
                </div>

                <div class="formForm">
                <label for="">Invités :</label>
                <?php if(isset($_SESSION['errors']['utilisateur'])): ?>
                    <small><?= $_SESSION['errors']['utilisateur'] ?></small>
                    <?php endif; ?>
                </div>
                <!-- on récupere les utilisateurs avec foreach et on les met dans un select -->
                <div class="formForm">
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
                </div>

                    <input id="actifReunion" type="hidden" value="1" name="reunion[actif_reunion]">
                <!-- toggle switch pour actif reunion -->
                <!-- <label class="toggle">Actif :
                    <input id="actifReunion" class="toggle-checkbox" type="checkbox" value="1" name="reunion[actif_reunion]">
                    <div class="toggle-switch"></div>
                    <span class="toggle-label"></span>
                </label>
                <input id="noActifReunion" type="hidden" value="0" name="reunion[actif_reunion]"> -->

                <input type="hidden" value="<?= $_SESSION['user']['id'] ?>" name="<?= $_SESSION['user']['id'] ?>">


                <!-- verficationActifUser est une fonction JS pour donner une valeur booleen à la checkbox: 0 si elle n'est pas coché, 1 si elle l'est -->
                <div class="formForm">
                <input type="submit" onclick='verificationActifReunion()' name="envoie">
            </div>
            </form>
        </div>
        <?php unset($_SESSION['errors']);?>
    </div>
</main>

</div>
<script src="/assets/script/reunion-script.js"></script>
</body>

</html>