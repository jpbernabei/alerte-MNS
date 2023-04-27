<?php
require $_SERVER['DOCUMENT_ROOT'] . "/managers/reunion-manager.php";
require $_SERVER['DOCUMENT_ROOT'] . "/managers/utilisateur-manager.php";
require $_SERVER['DOCUMENT_ROOT'] . "/includes/inc-top-admin.php";

// Verification de l'envoie du formulaire updateReunion:
if (isset($_POST['submit'])) {
    $count = updateReunion($_POST['reunion']);

    if ($count == 1) {
        header("Location: admin/parametre-reunions/index.php");
        exit;
    }
}
// Verification de l'envoie du formulaire deleteUserReunion:
if (isset($_POST['retirer'])){
// verification de l'envoie de l'id_utilisateur à retirer 
    if (!empty($_POST['id_utilisateur'])) {
        $countRetirerUser = deleteUserReunion($_POST['id_utilisateur'],$_POST['id_reunion']);
        if ($countRetirerUser == 1) {
            header("Location: /admin/parametre-reunions/edit.php?id=");
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
        header("Location: /admin/parametre-reunions/edit.php");
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
                <button class="button-chaines police"><i class="fa-solid fa-user" style="color: #ffffff ;"></i>Utilisateurs</button>
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

            <div>
                <h1>Modification de réunion</h1>

                <main>
                    <div>
                        <!-- formulaire pour l'ajout d'utilisateur -->
                        <form class="formNewUser" action="/admin/parametre-reunions/edit/new.php" method="POST">

                            <input type="hidden" name="reunion[id_reunion]" value="<?= $reunion['id_reunion'] ?>">

                            <label for="reunion[nom_reunion]">Nom de la réunion</label>
                            <input type="text" name="reunion[nom_reunion]" value="<?= $reunion['nom_reunion'] ?>">

                            <label for="reunion[sujet_reunion]">Sujet de la réunion</label>
                            <textarea name="reunion[sujet_reunion]" value="<?= $reunion['sujet_reunion'] ?>" cols="30" rows="10"><?= $reunion['sujet_reunion'] ?></textarea>

                            <label for="">Date de la réunion</label>
                            <input type="date" name="reunion[date_prevu_reunion]" value="<?= $reunion['date_prevu_reunion'] ?>">

                            <label for="">Heure de la réunion</label>
                            <input type="time" name="reunion[heure_prevu_reunion]" value="<?= $reunion['heure_prevu_reunion'] ?>">



                


                            <!-- toggle switch pour actif reunion -->
                            <label class="toggle"> Réunion Actif
                                <input id="actifReunion" class="toggle-checkbox" type="checkbox" value="<?= $reunion['actif_reunion'] ?>" name="reunion[actif_reunion]">
                                <div class="toggle-switch"></div>
                                <span class="toggle-label"></span>
                            </label>
                            <input id="noActifReunion" type="hidden" value="" name="reunion[actif_reunion]">

                            <!-- verficationActifUser est une fonction JS pour donner une valeur booleen à la checkbox: 0 si elle n'est pas coché, 1 si elle l'est -->
                            <input type="submit" onclick='verificationActifReunion()' name="submit">
                        </form>
                    </div>
                    
                    <div>

                        <table>
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
                                            <form action="/admin/parametre-reunions/edit.php" method="POST">
                                                <input type="hidden" name="id_utilisateur" value=<?= $utilisateurReunion['id_utilisateur'] ?>>
                                                <input type="hidden" name="id_reunion" value=<?= $_GET['id'] ?>>
                                                <input type="submit" value="Retirer" name="retirer">
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>

                    </div>
                    <div>

                        <table>
                            <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th>Prénom</th>
                                    <th>Retirer de la réunion</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($utilisateurs as $utilisateur) : ?>
                                    <tr>

                                        <td><?= $utilisateur['nom_utilisateur'] ?></td>
                                        <td><?= $utilisateur['prenom_utilisateur'] ?></td>
                                        <td>
                                            <form action="/admin/parametre-reunions/edit.php" method="POST">
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
                </main>

    </div>
<script src="/assets/script/reunion-script.js"></script>
</body>

</html>