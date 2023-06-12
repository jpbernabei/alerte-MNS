<?php
// session_start();
require $_SERVER['DOCUMENT_ROOT'] . '/includes/inc-db-connect.php';
require $_SERVER['DOCUMENT_ROOT'] . "/managers/utilisateur-manager.php";
require $_SERVER['DOCUMENT_ROOT'] . "/includes/inc-top-admin.php";

if (isset($_POST['submitForm'])) {
// var_dump($_POST);die;
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

//on vérifie si il y a une erreur.Si il y a une erreur on la met dans le tableau $_SESSION['errors']
//on met la valeur des champs dans le tableau $_SESSION['values']

if(count($errors) > 0)
{
    $_SESSION['errors'] = $errors;
    $_SESSION['values'] = $_POST;
    header("Location: /admin/parametre-utilisateurs/edit.php?id=".$_GET['id']); die;

    // var_dump($_POST);die;
    //on redirige l'utilisateur sur la page et on arrete le traitement du formulaire
    
}
$data = array(
    'email_utilisateur' => $_POST['utilisateur']['email_utilisateur'],
    'id_utilisateur' => $_POST['utilisateur']['id_utilisateur']
);
  //appel de la fonction qui vérifi si l'email est deja en base de donné
  $verifEmail = verifEmailEdit($data);
if($verifEmail>0){
    $_SESSION['errors']['email'] = "Cette adresse email est déjà utilisé.";
        header("Location: /admin/parametre-utilisateurs/edit.php?id=". $data['id_utilisateur'] );die;
}

    //si il est envoyé on appel la fonction insertUser et on stock l'id de l'utilisateur ajouté dans une varible
    $isAdmin = isset($_POST['is_admin_utilisateur']) ? 1 : 0;
    // var_dump($isAdmin);die;
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

        <h1>Modifier l'utilisateur</h1>

        <div class="buttonAjout">
            <a href="/admin/parametre-utilisateurs/index.php"><button class="button-creation police"><i class="fa-solid fa-arrow-left" style="color: #ffffff;"></i>Retour</button></a>
        </div>
        <div class="container-form">

            <form id="formEdit" class="formNewUser" action="/admin/parametre-utilisateurs/edit.php?id=<?= $_GET['id'] ?>" method="POST">
                <input type="hidden" name="utilisateur[id_utilisateur]" value="<?= $user['id_utilisateur'] ?>">


                <label>Email</label>
                <input id="emailEdit" type="email" name="utilisateur[email_utilisateur]" value="<?= isset($_SESSION['values']['utilisateur']['email_utilisateur']) ? $_SESSION['values']['utilisateur']['email_utilisateur'] : $user['email_utilisateur'] ?>" required >
                <?php if(isset($_SESSION['errors']['email'])): ?>
                    <small><?= $_SESSION['errors']['email'] ?></small>
                    <?php endif; ?>
                    <div id="emailErrorEdit" ></div>

                <label>Nom</label>
                <input id="nameEdit" type="text" name="utilisateur[nom_utilisateur]" 
                value="<?= isset($_SESSION['values']['utilisateur']['nom_utilisateur']) ? $_SESSION['values']['utilisateur']['nom_utilisateur'] : $user['nom_utilisateur'] ?>">
                <?php if(isset($_SESSION['errors']['nom'])): ?>
                    <small><?= $_SESSION['errors']['nom'] ?></small>
                    <?php endif; ?>
                <div id="nameErrorEdit" ></div>

                <label>Prenom</label>
                <input id="prenomEdit" type="text" name="utilisateur[prenom_utilisateur]" 
                value="<?= isset($_SESSION['values']['utilisateur']['prenom_utilisateur']) ? $_SESSION['values']['utilisateur']['prenom_utilisateur'] : $user['prenom_utilisateur'] ?>">
                <?php if(isset($_SESSION['errors']['prenom'])): ?>
                    <small><?= $_SESSION['errors']['prenom'] ?></small>
                    <?php endif; ?>
                <div id="prenomErrorEdit" ></div>
                
                <div class="formForm">
                <label class="toggle">Administrateur
                    <input id="actifAdmin" class="toggle-checkbox" type="checkbox"  <?= $user['is_admin_utilisateur'] == 1 ? 'checked' : ''?>  name="is_admin_utilisateur">
                    <div class="toggle-switch"></div>
                    <span class="toggle-label"></span>
                </label>
            </div>
                <!-- <input id="noActifAdmin" type="hidden"  name="utilisateur[is_admin_utilisateur]"> -->

                <!-- <label>numéro d'adresse</label>
                <input type="text" name="utilisateur[num_adresse_utilisateur]" value="<?= $user['num_adresse_utilisateur'] ?>">

                <label>rue</label>
                <input type="text" name="utilisateur[rue_adresse_utilisateur]" value="<?= $user['rue_adresse_utilisateur'] ?>">

                <label>Code postal</label>
                <input type="text" name="utilisateur[code_postal_utilisateur]" value="<?= $user['code_postal_utilisateur'] ?>">

                <label>Ville</label>
                <input type="text" name="utilisateur[ville_adresse_utilisateur]" value="<?= $user['ville_adresse_utilisateur'] ?>">  -->


                <input type="submit"  name="submitForm">
            </form>
        </div>
        <?php unset($_SESSION['errors']);
        unset($_SESSION['values']); ?>
    </div>
</main>

</div>
<script src="/assets/script/utilisateurEdit-script.js"></script>
</body>

</html>