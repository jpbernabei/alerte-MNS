<?php
require $_SERVER['DOCUMENT_ROOT'] . '/includes/inc-db-connect.php';
require $_SERVER['DOCUMENT_ROOT'] . "/managers/utilisateur-manager.php";
require $_SERVER['DOCUMENT_ROOT'] . "/includes/inc-top-admin.php";

//on vérifie si le formulaire est envoyé
if (isset($_POST['submitForm'])) {
    //si il est envoyé on appel la fonction insertUser et on stock l'id de l'utilisateur ajouté dans une varible
    $id = insertUser($_POST['utilisateur']);

    //si il y a bien un id on redirige vers l'index
    if ($id) {
        header("Location: /admin/parametre-utilisateurs/index.php");
        exit;
    } else {
        echo "Un erreur est survenue...";
    }
}

$roles = getAllRoles();

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
    <a href="/admin/parametre-reunions/index.php">  <button class="button-chaines police"><i class="fa-solid fa-users " style="color: #ffffff;"></i>Réunions</button></a>
    </div>

    <div class="button-creation-container">

        <a href="../index.php"><button class="button-creation police"><i class="fa-solid fa-arrow-rotate-left"></i>Accueil</button></a>


    </div>
</nav>

    <main>
        <div class="container">
            <h1>Ajouter un utilisateur</h1>
            <div class="buttonAjout">
                <a href="/admin/parametre-utilisateurs/index.php"><button class="button-creation police"><i class="fa-solid fa-arrow-left" style="color: #ffffff;"></i>Retour</button></a></div>
            <div class="container-form desigend-scrollbar">

            <!-- formulaire pour l'ajout d'utilisateur -->
            <form id="form" class="formNewUser" action="/admin/parametre-utilisateurs/new.php" method="POST">
            
                <label for="utilisateur[email_utilisateur]">Email</label>
                <input id="email" type="email"  name="utilisateur[email_utilisateur]" required >
                <div id="emailError" ></div>

                <label for="utilisateur[mot_de_passe_utilisateur]">Mot de passe</label>
                <input id="password" type="password" name="utilisateur[mot_de_passe_utilisateur]" required>
                <div id="passwordError"></div>

                <label for="">Nom</label>
                <input id="nom" type="text" name="utilisateur[nom_utilisateur]" required>
                <div id="nameError" ></div>

                <label for="">Prénom</label>
                <input id="prenom" type="text" name="utilisateur[prenom_utilisateur]" required>
                <div id="prenomError"></div>

                <label for="">Rôle</label>
                <!-- on récupere les roles avec foreach et on les mets dans un select -->
                <select name="utilisateur[id_role]" id="">
                    <?php foreach ($roles as $role) : ?>
                        <option value="<?= $role['id_role'] ?>"><?= $role['libelle_role'] ?></option>
                    <?php endforeach ?>
                </select>

                <!-- toggle switch pour actif utilisateur -->
                <label class="toggle">Utilisateur actif
                    <input id="actifUser" class="toggle-checkbox" type="checkbox" value="1" >
                    <div class="toggle-switch"></div>
                    <span class="toggle-label"></span>
                </label>
                <input id="noActifUser" type="hidden" value="1" name="utilisateur[actif_utilisateur]">

                <label class="toggle">Administrateur
                    <input id="actifAdmin" class="toggle-checkbox" type="checkbox" value="1" name="utilisateur[is_admin_utilisateur]">
                    <div class="toggle-switch"></div>
                    <span class="toggle-label"></span>
                </label>
                <input id="noActifAdmin" type="hidden" value="0" name="utilisateur[is_admin_utilisateur]">

                
                <input type="hidden" name="utilisateur[date_creation_compte_utilisateur]" value="<?= date("Y-m-d") ?>">
                <!-- verficationActifUser est une fonction JS pour donner une valeur booleen à la checkbox: 0 si elle n'est pas coché, 1 si elle l'est -->
                <input id="envoie"  type="submit" onclick='verificationActifUser(),verificationActifAdmin()' name="submitForm">
            </form>
        </div>
    </main>
</div>
<script src="/assets/script/utilisateur-script.js"></script>
</body>

</html>