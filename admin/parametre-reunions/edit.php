<?php
require $_SERVER['DOCUMENT_ROOT'] . "/managers/reunion-manager.php";
require $_SERVER['DOCUMENT_ROOT'] . "/managers/utilisateur-manager.php";
require $_SERVER['DOCUMENT_ROOT'] . "/includes/inc-top-admin.php";

// Verification de l'envoie du formulaire updateReunion:
if (isset($_POST['submit'])) {

    $errors = [];

    if (empty($_POST['reunion']['nom_reunion']))
        $errors['nom_reunion'] = 'La réunion doit avoir un nom.';

    if (empty($_POST['reunion']['sujet_reunion']))
        $errors['sujet_reunion'] = 'La réunion doit avoir un sujet.';

    if (empty($_POST['reunion']['date_prevu_reunion']))
        $errors['date_prevu_reunion'] = 'La réunion doit avoir une date de prévu.';

    if (empty($_POST['reunion']['heure_prevu_reunion']))
        $errors['heure_prevu_reunion'] = 'La réunion doit avoir une heure de prévu.';


    if (count($errors) > 0) {
        $_SESSION['errors'] = $errors;
        $_SESSION['values'] = $_POST;

        header("Location: /admin/parametre-reunions/edit.php?id=" . $_GET['id']);
        die;
    }

    $count = updateReunion($_POST['reunion']);

    if ($count == 1) {
        header("Location: /admin/parametre-reunions/edit.php");
        exit;
    }
}
// Verification de l'envoie du formulaire deleteUserReunion:
if (isset($_POST['retirer'])) {
    // verification de l'envoie de l'id_utilisateur à retirer 
    if (!empty($_POST['id_utilisateur'])) {
        $countRetirerUser = deleteUserReunion($_POST['id_utilisateur'], $_POST['id_reunion']);
        if ($countRetirerUser == 1) {
            header("Location: /admin/parametre-reunions/edit.php?id=" . $_GET['id']);
            exit;
        } else {
            echo "Une erreur s'est produite lors de la suppression...";
        }
    } else {
        header("Location: /admin/parametre-reunions/edit.php");
        exit;
    }
}
// Verification de l'envoie du formulaire insertuserReunion:
if (isset($_POST['ajouter'])) {
    $idNewUserReunion = insertUserReunion($_POST['reunion_utilisateur']);
    if (!$idNewUserReunion) {
        header("Location: /admin/parametre-reunions/edit.php?id=" . $_GET['id']);
    }
}
// verification de la récupération de l'id de la réunion
if (empty($_GET['id'])) {
    header("Location: /admin/parametre-reunions/index.php");
    exit;
}

$reunion = getReunionById($_GET['id']);

$utilisateurReunions = getUserReunion($_GET['id']);
if (!$reunion) {
    header("Location: /parametre-reunion");
    exit;
}

$utilisateurs = getUserNotInReunion($_GET['id']);


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
        <a href="/admin/parametre-reunions/index.php"><button class="button-chaines police"><i class="fa-solid fa-users " style="color: #ffffff;"></i>Réunions</button></a>
    </div>

    <div class="button-creation-container">

        <a href="../index.php"><button class="button-creation police"><i class="fa-solid fa-arrow-rotate-left"></i>Accueil</button></a>


    </div>
</nav>
<main>

    <div class="container">
        <h1>Modification de réunion</h1>
        <div class="buttonAjout">
            <a href="/admin/parametre-reunions/index.php"><button class="button-creation police"><i class="fa-solid fa-arrow-left" style="color: #ffffff;"></i>Retour</button></a>
        </div>
        <div class="flexFormTab desigend-scrollbar">

            <div class="container-formEditReunion ">
                <!-- formulaire pour l'ajout d'utilisateur -->
                <form id="form" class="formNewUser" action="/admin/parametre-reunions/edit.php?id=<?= $_GET['id'] ?>" method="POST">

                    <input type="hidden" name="reunion[id_reunion]" value="<?= $_GET['id'] ?>">

                    <div class="formForm">
                        <label for="reunion[nom_reunion]">Nom de la réunion</label>
                        <input id="nomReunion" type="text" name="reunion[nom_reunion]" value="<?= $reunion['nom_reunion'] ?>">
                        <small id="nomReunionError"></small>
                        <?php if (isset($_SESSION['errors']['nom_reunion'])) : ?>
                            <small><?= $_SESSION['errors']['nom_reunion'] ?></small>

                            <!-- <small id="nomReunionError"></small> -->
                        <?php endif; ?>
                    </div>

                    <div class="formForm">
                        <label for="reunion[sujet_reunion]">Sujet de la réunion</label>
                        <textarea id="sujetReunion" name="reunion[sujet_reunion]" value="<?= $reunion['sujet_reunion'] ?>" cols="30" rows="10"><?= $reunion['sujet_reunion'] ?></textarea>
                        <small id="sujetReunionError"></small>
                        <?php if (isset($_SESSION['errors']['sujet_reunion'])) : ?>
                            <small><?= $_SESSION['errors']['sujet_reunion'] ?></small>

                        <?php endif; ?>
                    </div>

                    <div class="formForm">
                        <label for="">Date de la réunion</label>
                        <input id="dateReunion" type="date" name="reunion[date_prevu_reunion]" value="<?= $reunion['date_prevu_reunion'] ?>">
                        <small id="dateReunionError"></small>
                        <?php if (isset($_SESSION['errors']['date_prevu_reunion'])) : ?>
                            <small><?= $_SESSION['errors']['date_prevu_reunion'] ?></small>
                        <?php endif; ?>
                    </div>

                    <div class="formForm">
                        <label for="">Heure de la réunion</label>
                        <input id="heureReunion" type="time" name="reunion[heure_prevu_reunion]" value="<?= $reunion['heure_prevu_reunion'] ?>">
                        <small id="heureReunionError"></small>
                        <?php if (isset($_SESSION['errors']['heure_prevu_reunion'])) : ?>
                            <small><?= $_SESSION['errors']['heure_prevu_reunion'] ?></small>
                        <?php endif; ?>
                    </div>

                    <div class="formForm">
                        <!-- verficationActifUser est une fonction JS pour donner une valeur booleen à la checkbox: 0 si elle n'est pas coché, 1 si elle l'est -->
                        <input type="submit" onclick='verificationActifReunion()' name="submit">
                    </div>
                </form>
            </div>
            <?php unset($_SESSION['errors']); ?>


            <table class="container-tableEditReunion">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Retirer de la réunion</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($utilisateurReunions as $utilisateurReunion) : ?>
                        <tr>

                            <td><?= $utilisateurReunion['nom_utilisateur'] ?></td>
                            <td><?= $utilisateurReunion['prenom_utilisateur'] ?></td>
                            <td>
                                <form action="/admin/parametre-reunions/edit.php?id=<?= $_GET['id'] ?>" method="POST">
                                    <input type="hidden" name="id_utilisateur" value=<?= $utilisateurReunion['id_utilisateur'] ?>>
                                    <input type="hidden" name="id_reunion" value=<?= $_GET['id'] ?>>
                                    <input type="submit" value="Retirer" name="retirer">
                                </form>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>




            <table class="container-tableEditReunion">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Ajouter à la réunion</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($utilisateurs as $utilisateur) : ?>
                        <tr>

                            <td><?= $utilisateur['nom_utilisateur'] ?></td>
                            <td><?= $utilisateur['prenom_utilisateur'] ?></td>
                            <td>
                                <form action="/admin/parametre-reunions/edit.php?id=<?= $_GET['id'] ?>" method="POST">
                                    <input type="hidden" name="reunion_utilisateur[id_reunion]" value=<?= $_GET['id'] ?>>
                                    <input type="hidden" name="reunion_utilisateur[id_utilisateur]" value=<?= $utilisateur['id_utilisateur'] ?>>
                                    <input type="submit" value="Ajouter" name="ajouter">
                                </form>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>

        </div>
    </div>
    </div>
</main>


<script src="/assets/script/reunion-script.js"></script>
</body>

</html>