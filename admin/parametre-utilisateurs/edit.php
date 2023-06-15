<?php
require $_SERVER['DOCUMENT_ROOT'] . '/includes/inc-db-connect.php';
require $_SERVER['DOCUMENT_ROOT'] . "/managers/utilisateur-manager.php";
require $_SERVER['DOCUMENT_ROOT'] . "/includes/inc-top-admin.php";

// on vérifie si le formulaire est envoyé
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
    header("Location: /admin/parametre-utilisateurs/edit.php?id=".$_GET['id']); die;
    //on redirige l'utilisateur sur la page et on arrete le traitement du formulaire
    
}
$data = array(
    'email_utilisateur' => $_POST['utilisateur']['email_utilisateur'],
    'id_utilisateur' => $_POST['utilisateur']['id_utilisateur']
);
  //appel de la fonction qui vérifie si l'email est déjà en base de donnée
  $verifEmail = verifEmailEdit($data);
if($verifEmail>0){
    $_SESSION['errors']['email'] = "Cette adresse email est déjà utilisé.";
        header("Location: /admin/parametre-utilisateurs/edit.php?id=". $data['id_utilisateur'] );die;
}

    //s'il est envoyé on appelle la fonction insertUser et on stock l'id de l'utilisateur ajouté dans une variable
    $isAdmin = isset($_POST['is_admin_utilisateur']) ? 1 : 0;
  
    $count = updateUser($_POST['utilisateur'],$isAdmin);
    if ($count == 1) {
        unset($_SESSION['errors']);
        unset($_SESSION['values']);

        header("Location: /admin/parametre-utilisateurs/index.php");
        exit;
    } else {
        $_SESSION['errors']['error'] = "Un erreur est survenue...";
    }
}
  

// On vérifie le paramètre id dans l'url
if (empty($_GET['id'])) {
    header("Location: /admin/parametre-utilisateurs/index.php");
    exit;
}

$user = getUserById($_GET['id']);

if (!$user) // $user == null
{
    header("Location: /admin/parametre-utilisateurs/index.php");
    exit;
}

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

        <a href="../index.php"><button class="button-creation police"><i class="fa-solid fa-arrow-rotate-left"></i>Accueil</button></a>


    </div>
</nav>
<main>
    <div class="container">

        <h1>Modifier l'utilisateur</h1>

        <div class="buttonAjout">
            <a href="/admin/parametre-utilisateurs/index.php"><button class="button-creation police"><i class="fa-solid fa-arrow-left" style="color: #ffffff;"></i>Retour</button></a>
        </div>
        <div class="container-form">
    <!-- formulaire pour modifier un utilisateur -->
            <form id="formEdit" class="formNewUser" action="/admin/parametre-utilisateurs/edit.php?id=<?= $_GET['id'] ?>" method="POST">
            <!-- on récupere son id -->
                <input type="hidden" name="utilisateur[id_utilisateur]" value="<?= $user['id_utilisateur'] ?>">
                <!-- on met des id pour les champs du formulaire pour le JS -->
                <label>Email</label>
                <!-- on fait une condition ternaire, si $_session[value]['utilisateur']['email_utilisateur'] existe, alors ce sera la valeur du champ, sinon ce sera l'email de l'utilisateur -->
                <input id="emailEdit" type="email" name="utilisateur[email_utilisateur]" value="<?= isset($_SESSION['values']['utilisateur']['email_utilisateur']) ? $_SESSION['values']['utilisateur']['email_utilisateur'] : $user['email_utilisateur'] ?>" required >
                <!-- s'il y a une erreur, alors on retourne la phrase de l'erreur -->
                <?php if(isset($_SESSION['errors']['email'])): ?>
                    <small><?= $_SESSION['errors']['email'] ?></small>
                    <?php endif; ?>
                    <small id="emailErrorEdit"> </small>

                <label>Nom</label>
                <!-- on fait une condition ternaire, si $_SESSION['values']['utilisateur']['nom_utilisateur'] existe, alors ce sera la valeur du champ, sinon ce sera le nom de l'utilisateur -->
                <input id="nameEdit" type="text" name="utilisateur[nom_utilisateur]" 
                value="<?= isset($_SESSION['values']['utilisateur']['nom_utilisateur']) ? $_SESSION['values']['utilisateur']['nom_utilisateur'] : $user['nom_utilisateur'] ?>">
                <!-- s'il y a une erreur, alors on retourne la phrase de l'erreur -->
                <?php if(isset($_SESSION['errors']['nom'])): ?>
                    <small><?= $_SESSION['errors']['nom'] ?></small>
                    <?php endif; ?>
                    <small id="nameErrorEdit"> </small>
                

                <label>Prénom</label>
                <!-- on fait une condition ternaire, si $_SESSION['values']['utilisateur']['prenom_utilisateur'] existe, alors ce sera la valeur du champ, sinon ce sera le prénom de l'utilisateur -->
                <input id="prenomEdit" type="text" name="utilisateur[prenom_utilisateur]" 
                value="<?= isset($_SESSION['values']['utilisateur']['prenom_utilisateur']) ? $_SESSION['values']['utilisateur']['prenom_utilisateur'] : $user['prenom_utilisateur'] ?>">
                <!-- s'il y a une erreur, alors on retourne la phrase de l'erreur -->
                <?php if(isset($_SESSION['errors']['prenom'])): ?>
                    <small><?= $_SESSION['errors']['prenom'] ?></small>
                    <?php endif; ?>
                    <small id="prenomErrorEdit"> </small>
                
                <div class="formForm">
                <label class="toggle">Administrateur
                    <input id="actifAdmin" class="toggle-checkbox" type="checkbox"  <?= $user['is_admin_utilisateur'] == 1 ? 'checked' : ''?>  name="is_admin_utilisateur">
                    <div class="toggle-switch"></div>
                    <span class="toggle-label"></span>
                </label>
            </div>
                
                <input type="submit"  name="submitForm">
            </form>
        </div>
        <!-- on suprime les tableaux errors à chaque envoi du formulaire -->
        <?php unset($_SESSION['errors']); ?>
    </div>
</main>

</div>
<script src="/assets/script/utilisateurEdit-script.js"></script>
</body>

</html>