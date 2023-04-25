<?php
session_start();
require $_SERVER['DOCUMENT_ROOT'] . "/managers/chaine-manager.php";
require $_SERVER['DOCUMENT_ROOT'] . "/managers/utilisateur-manager.php";

# 1. ---------------------Verification pour la modification de la chaine--------------------------------
if (isset($_POST['submit'])) {
    $count = updateChaine1($_POST['chaine']);
    if ($count == 1) {
        echo ('Modifier réussi');
    } else {
        echo ("Une erreur s'est produit");
    }
}
// Vérification du paramètre de l'id choisie pour modifier 

if (empty($_GET['id'])) {
    header("Location: /admin/parametre-chaines/index.php");
    die;
}

// On vérifie si les chaines sont bien présent en BDD
$chaine = getChaineId($_GET['id']);
if (!$chaine) {
    header("Location: /admin/parametre-chaines/index.php");
    die;
}


# 2. ---------------------Verification pour ajouter un utilisateur dans une chaine--------------------------------

$utilisateurs = getAllUser();


if (isset($_POST['submit'])) {

    $id = insertUserChaine($_POST['chaine_utilisateur']);

    if ($id) {

        header("Location: /admin/parametre-chaines/index.php");
        exit;
        echo ("reussi");
    } else {
        echo ("Une erreur est survenu lors de l'ajout des utilisateurs");
    }
}
# 3. ---------------------Verification retirer un utilisateur dans une chaine-------------------------------------
?>

<!--Affichage de la modification des informations de la chaine-->

<div class="container py-5">
    <h1>Modifier les informations de la chaîne</h1>
    <div class="row mb-4">
        <div class="col-auto">
            <a href="/admin/parametre-chaines/index.php" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> revenir ..........
            </a>
        </div>

    </div>

    <div class="row">
        <div class="col col-md-6">
            <form action="/admin/parametre-chaines/edit.php?id=<?= $_GET['id'] ?>" method="POST">
                <input type="hidden" name="chaine[id_chaine]" value="<?= $chaine['id_chaine'] ?>">
                <div class="form-group">
                    <label for="titre">Nom de la chaine</label>
                    <input type="text" class="form-control" name="chaine[nom_chaine]" value="<?= $chaine['nom_chaine'] ?>" />
                </div>
                <div class="form-group">
                    <label for="titre">Actif du chaine</label>
                    <!-- Pour le bouton actif\desactif-->
                    <input id="actifChaine" type="checkbox" value="<?= $chaine['actif_chaine'] ?>" name="chaine[actif_chaine]">
                    <input id="noActifChaine" type="hidden" value="0" name="chaine[actif_chaine]">
                </div>
                <!-- Pour faire apparaitre les utilisateurs qui sont dans la chaine
            Faire une fonction qui recupere les utilisateurs d'une chaine et après met dans la boucle-->

                <input type="submit" onclick='verificationActifChaine()' name="submit">
            </form>
        </div>
    </div>
    <script src="/assets/script/chaines-script.js"></script>
</div>

<!--Affichage Pour insérer un utilisateur dans une chaine et retirer en meme temps-->

<div class="container-grid">
    <header>
        <img class="logo" src="/images/LOGO_ALERT_MNS_transparent.ico" alt="">
        <a href=""><i class="fa-solid fa-user fa-xl" style="color: #ffffff;"></i></a>
        <div class="police name-user">Nom utilisateur</div>
        <div>
            <div class="police name-chaine">nom de la chaine </div>
            <div class="police name-salon">nom du salon</div>
        </div>
        <input class="search" type="search">
        <a href=""><i class="fa-solid fa-users fa-xl" style="color: #ffffff;"></i></a>
        <a href="../../logout.php"><i class="fa-solid fa-right-from-bracket fa-xl" style="color: #ffffff;"></i></a>
    </header>
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
            <button class="button-chaines police"><i class="fa-solid fa-users " style="color: #ffffff;"></i>Réunions</button>
        </div>

        <div class="button-creation-container">

            <a href="/admin/parametre-admin.php"><button class="button-creation police"><i class="fa-solid fa-arrow-rotate-left"></i>Accueil</button></a>
        </div>
    </nav>
    <main>

        <div>
            <h1>Ajout des utilisateurs</h1>
            <main>
                <div>
                    <form action="/admin/parametre-chaines/addUser.php" method="post">
                        <table>
                            <thead>
                                <th>ID</th>
                                <th>Email</th>
                                <th>Nom</th>
                                <th>Prénom</th>
                                <th>Ajouter</th>
                                <th>Supprimer</th>
                            </thead>
                            <tbody>
                                <?php foreach ($utilisateurs as $utilisateur) : ?>
                                    <tr>
                                        <td><?= $utilisateur['id_utilisateur'] ?></td>
                                        <td><?= $utilisateur['email_utilisateur'] ?></td>
                                        <td><?= $utilisateur['nom_utilisateur'] ?></td>
                                        <td><?= $utilisateur['prenom_utilisateur'] ?></td>
                                        <td>
                                            <label>
                                                <input type="checkbox" name="chaine_utilisateur[id_utilisateur]" value="<?= $utilisateur["id_utilisateur"] ?>">
                                            </label>
                                        </td>
                                        <input type="hidden" name="chaine_utilisateur[id_chaine]" value="<?= $_GET['id'] ?>">
                                    </tr>
                                <?php
                                endforeach;  ?>
                            </tbody>
                        </table>
                        <input type="submit" name="submit" value="Enregistrer" class="btn btn-primary">
                    </form>
                </div>
            </main>
        </div>