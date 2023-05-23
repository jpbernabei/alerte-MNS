<?php

require $_SERVER['DOCUMENT_ROOT'] . "/includes/inc-top-admin.php";
require $_SERVER['DOCUMENT_ROOT'] . "/managers/chaine-manager.php";
require $_SERVER['DOCUMENT_ROOT'] . "/managers/utilisateur-manager.php";

# 1. ---------------------Verification pour la modification de la chaine--------------------------------
if (isset($_POST['submit'])) {
    $count = updateChaine($_POST['chaine']);
    if ($count == 1) {
        echo ('Modifier réussi');
    } else {
        echo ("Une erreur s'est produit");
    }
}

// Verification de retirer un utilisateur et d'ajouter un utilisateur 
if (isset($_POST['retirer'])) 
{
    if (!empty($_POST['id_utilisateur'])) {
        $retirerUser = deleteUserInChaine($_POST['id_utilisateur'], $_POST['id_chaine']);
        if ($retirerUser == 1) {
            header("Location: /admin/parametre-chaines/edit.php?id=");
            exit;
        } else {
            echo "Une erreur s'est produite lors de la suppression...";
        }
    } else {
        header("Location: /admin/parametre-chaines/edit.php");
        exit;
    }
}


if (isset($_POST['ajouter'])) {
    $addUserChaine = insertUserChaine($_POST['chaine_utilisateur']);
    if (!$addUserChaine) {
        header("Location: /admin/parametre-chaines/edit.php");
    }
}

// Vérification du paramètre de l'id de la chaine pour modifier 

if (empty($_GET['id'])) {
    header("Location: /admin/parametre-chaines/index.php");
    die;
}
// Pour voir les personnes qui sont dans la chaine

$utilisateurs = getUserChaine($_GET['id']);

// On vérifie si les chaines sont bien présent en BDD

$chaine = getChaineId($_GET['id']);
if (!$chaine) {
    header("Location: /admin/parametre-chaines/index.php");
    die;
}



# 3. ---------------------Les utilisateurs qui ne sont pas dans la chaine-------------------------------------
$utilisateurNotInChaines = getUserNotInChaine($_GET['id']);
# 3. ---------------------Verification retirer un utilisateur dans une chaine-------------------------------------
?>

<!--Affichage de la modification des informations de la chaine-->

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
                    
                    <!-- Pour faire apparaitre les utilisateurs qui sont dans la chaine
            Faire une fonction qui recupere les utilisateurs d'une chaine et après met dans la boucle-->

                    <input type="submit" onclick='verificationActifChaine()' name="submit">
                </form>
            </div>
        </div>
        <script src="/assets/script/chaines-script.js"></script>
    

    <!--Affichage Pour insérer un utilisateur dans une chaine -->

    

        <div>
            <h2>Retirer des utilisateurs</h2>
            
                <div>

                    <table>
                        <thead>

                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Retirer</th>

                        </thead>
                        <tbody>
                            <?php foreach ($utilisateurs as $utilisateur) : ?>
                                <tr>

                                    <td><?= $utilisateur['nom_utilisateur'] ?></td>
                                    <td><?= $utilisateur['prenom_utilisateur'] ?></td>
                                    <td><form action="/admin/parametre-chaines/edit.php" method="post">
                                        
                                        <input type="hidden" name="id_utilisateur" value="<?= $utilisateur['id_utilisateur'] ?>">
                                        <input type="hidden" name="id_chaine" value="<?= $_GET['id'] ?>">
                                        <input type="submit" name="retirer" value="retirer" >
                                    </form>
                                </td>
                                </tr>
                            <?php
                            endforeach;  ?>
                        </tbody>
                    </table>
                    <!--Affichage Pour retirer un utilisateur dans une chaine -->
                    <div>
                        <h2>Ajouter un utilisateur d'une chaine</h2>
                        <table>
                            <thead>
                                <th>Nom</th>
                                <th>Prénom</th>
                                <th>Ajouter</th>

                            </thead>
                            <tbody>
                                <?php foreach ($utilisateurNotInChaines as $utilisateurNotInChaine) : ?>
                                    <tr>

                                        <td><?= $utilisateurNotInChaine['nom_utilisateur'] ?></td>
                                        <td><?= $utilisateurNotInChaine['prenom_utilisateur'] ?></td>
                                        <td>
                                            <form action="/admin/parametre-chaines/edit.php" method="post">
                                                <label>
                                                <input type="hidden" name="chaine_utilisateur[id_chaine]" value=<?= $_GET['id'] ?>>
                                                <input type="hidden" name="chaine_utilisateur[id_utilisateur]" value=<?= $utilisateurNotInChaine['id_utilisateur'] ?>>
                                                <input type="submit" name="ajouter" value="ajouter" class="btn btn-primary">
                                                </label>
                                            </form>
                                        </td>
                                    </tr>
                                <?php
                                endforeach;  ?>
                            </tbody>
                        </table>


                    </div>
                </div>

        </div>
        </div>
</main>