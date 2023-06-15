<?php
require $_SERVER['DOCUMENT_ROOT'] . '/includes/inc-db-connect.php';
require $_SERVER['DOCUMENT_ROOT'] . "/managers/utilisateur-manager.php";
require $_SERVER['DOCUMENT_ROOT'] . "/includes/inc-top-admin.php";

//on vérifie si le formulaire est envoyé
if (isset($_POST['submitForm'])) {

//on déclare une variable de type tableau où l'on mettra les messages d'erreurs
    $errors = [];

//on met l'email dans une variable
$validEmail = $_POST['utilisateur']['email_utilisateur'];
//on vérifie la conformité de l'email
if(!(filter_var($validEmail,FILTER_VALIDATE_EMAIL)))
//si la fonction filter_var retourne false on déclare une phrase d'erreur
    $errors['email'] = "Adresse Email non valide";

//on vérifie si le champ n'est pas vide
if(empty($_POST['utilisateur']['email_utilisateur']))
    $errors['email'] = "Adresse Email obligatoire";

//on vérifie si le champ n'est pas vide
if(empty($_POST['utilisateur']['mot_de_passe_utilisateur']))
    $errors['password'] = "Le mot de passe est obligatoire.";

// on met le mot de passe dans une variable et on l'utilise avec la fonction valid_password (dans le fichier fonction)
// pour vérifier la conformité du MDP
$validPassword= $_POST['utilisateur']['mot_de_passe_utilisateur'];
if(!(valid_password($validPassword)))
$errors['password'] = "Le mot de passe doit faire minimum 8 caractères, dont une majuscule et un chiffre.";

//on vérifie si le champ n'est pas vide
if(empty($_POST['utilisateur']['nom_utilisateur']))
$errors['nom'] = "Le nom est obligatoire.";

//on vérifie si le champ n'est pas vide
if(empty($_POST['utilisateur']['prenom_utilisateur']))
    $errors['prenom'] = "Le prénom est obligatoire.";

//on vérifie s'il y a une erreur.S'il y a une erreur on la met dans le tableau $_SESSION['errors']
//on met la valeur des champs dans le tableau $_SESSION['values']
if(count($errors) > 0)
{
    $_SESSION['errors'] = $errors;
    $_SESSION['values'] = $_POST;

    //on redirige l'utilisateur sur la page et on arrete le traitement du formulaire
    header("Location: /admin/parametre-utilisateurs/new.php"); die;
}
    //appel de la fonction qui vérifie si l'email est déjà en base de donnée
    verifUser($_POST['utilisateur']);

    //s'il est envoyé on appelle la fonction insertUser et on stock l'id de l'utilisateur ajouté dans une varible
    $id = insertUser($_POST['utilisateur']);

    //s'il y a bien un id on redirige vers l'index
    if ($id) {
        unset($_SESSION['errors']);
        unset($_SESSION['values']);
        header("Location: /admin/parametre-utilisateurs/index.php");
        exit;
    } else {
       $_SESSION['errors']['error'] = "Un erreur est survenue...";
    }
}
//on récupere les rôles en BDD
$roles = getAllRoles();

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
    <a href="/admin/parametre-reunions/index.php">  <button class="button-chaines police"><i class="fa-solid fa-users " style="color: #ffffff;"></i>Réunions</button></a>
    </div>

    <div class="button-creation-container">

        <a href="../index.php"><button class="button-creation police"><i class="fa-solid fa-arrow-rotate-left"></i>Accueil</button></a>


    </div>
</nav>

    <main>
        <div class="container">
<!-- s'il y a eu une erreur lors du traitement du formulaire on affiche la phrase d'erreur -->
        <?php if(isset($_SESSION['errors']['error'])): ?>
            <small><?= $_SESSION['errors']['error'] ?></small>
            <?php endif; ?>

            <h1>Ajouter un utilisateur</h1>
            <div class="buttonAjout">
                <a href="/admin/parametre-utilisateurs/index.php"><button class="button-creation police"><i class="fa-solid fa-arrow-left" style="color: #ffffff;"></i>Retour</button></a></div>
            <div class="container-form desigend-scrollbar">

            <!-- formulaire pour l'ajout d'utilisateur -->
            <form id="form" class="formNewUser" action="/admin/parametre-utilisateurs/new.php" method="POST">
            
            <div class="formForm">
                <label for="email">Email</label>
                <!-- si l'utilisateur fait une erreur on stock et affiche ce qu'il a tapé dans le champ
            et on affiche le message d'erreur correspondant -->
                <input id="email" type="email"  name="utilisateur[email_utilisateur]"
                value="<?= isset($_SESSION['values']['utilisateur']['email_utilisateur']) ? $_SESSION['values']['utilisateur']['email_utilisateur'] : '' ?>">
                <?php if(isset($_SESSION['errors']['email'])): ?>
                    <small><?= $_SESSION['errors']['email'] ?></small>
                    <?php endif; ?>
                <?php if (isset($_SESSION['errors']['email_utilisateur'])) : ?>
                    <small><?= $_SESSION['errors']['email_utilisateur'] ?></small>
                    <?php endif; ?>
                    <!-- si l'utilisateur fait une erreur on le traite avec la fonction JS et on affiche le message d'erreur  -->
                <div class="messageErreur" id="emailError" ></div>
            </div>

                <div class="formForm">
                <label for="password">Mot de passe</label>
                <input id="password" type="password" name="utilisateur[mot_de_passe_utilisateur]" 
                value="<?= isset($_SESSION['values']['utilisateur']['mot_de_passe_utilisateur']) ? $_SESSION['values']['utilisateur']['mot_de_passe_utilisateur'] : '' ?>">
                <?php if(isset($_SESSION['errors']['password'])): ?>
                    <small><?= $_SESSION['errors']['password'] ?></small>
                    <?php endif; ?>
                <div class="messageErreur" id="passwordError"></div>
            </div>

                    <div class="formForm">
                <label for="">Nom</label>
                <input id="nom" type="text" name="utilisateur[nom_utilisateur]" 
                value="<?= isset($_SESSION['values']['utilisateur']['nom_utilisateur']) ? $_SESSION['values']['utilisateur']['nom_utilisateur'] : '' ?>">
                <?php if(isset($_SESSION['errors']['nom'])): ?>
                    <small><?= $_SESSION['errors']['nom'] ?></small>
                    <?php endif; ?>
                <div class="messageErreur" id="nameError" ></div>
            </div>

            <div class="formForm">
                <label for="">Prénom</label>
                <input id="prenom" type="text" name="utilisateur[prenom_utilisateur]" 
                value="<?= isset($_SESSION['values']['utilisateur']['prenom_utilisateur']) ? $_SESSION['values']['utilisateur']['prenom_utilisateur'] : '' ?>">
                <?php if(isset($_SESSION['errors']['prenom'])): ?>
                    <small><?= $_SESSION['errors']['prenom'] ?></small>
                    <?php endif; ?>
                <div class="messageErreur" id="prenomError"></div>
            </div>

            <div class="formForm">
                <label for="">Rôle</label>
                <!-- on récupère les roles avec foreach et on les met dans un select -->
                <div class="select-style">
                <select name="utilisateur[id_role]" id="">
                    <?php foreach ($roles as $role) : ?>
                        <option value="<?= $role['id_role'] ?>"><?= $role['libelle_role'] ?></option>
                    <?php endforeach ?>
                </select>
            </div>
                </div>

                <div class="formForm">
                <!-- toggle switch pour actif utilisateur -->
                <label class="toggle">Utilisateur actif
                    <input id="actifUser" class="toggle-checkbox" type="checkbox" value="1" >
                    <div class="toggle-switch"></div>
                    <span class="toggle-label"></span>
                </label>
            </div>

                <input id="noActifUser" type="hidden" value="1" name="utilisateur[actif_utilisateur]">
                <!-- toggle switch pour actif administrateur -->
                <div class="formForm">
                <label class="toggle">Administrateur
                    <input id="actifAdmin" class="toggle-checkbox" type="checkbox" value="1" >
                    <div class="toggle-switch"></div>
                    <span class="toggle-label"></span>
                </label>
            </div>
                <input id="noActifAdmin" type="hidden" value="1" name="utilisateur[is_admin_utilisateur]">

                
                <input type="hidden" name="utilisateur[date_creation_compte_utilisateur]" value="<?= date("Y-m-d") ?>">
                <!-- verficationActifUser est une fonction JS pour donner une valeur booleen à la checkbox: 0 si elle n'est pas coché, 1 si elle l'est -->

                <div class="formForm">
                <input id="envoie"  type="submit" onclick='verificationActifUser(),verificationActifAdmin()' name="submitForm">
                </div>
            </form>
        </div>
        <!-- on supprime les erreurs à chaque validation du formulaire -->
        <?php unset($_SESSION['errors']);
        unset($_SESSION['values']); ?>
    </main>
</div>
<script src="/assets/script/utilisateur-script.js"></script>
</body>

</html>