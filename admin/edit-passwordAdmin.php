<?php
require $_SERVER['DOCUMENT_ROOT'] . "/includes/inc-top-admin.php";
require $_SERVER['DOCUMENT_ROOT'] . "/includes/inc-db-connect.php";

if (!empty($_POST['submit'])) {
    $errors = [];

    if (empty($_POST['email']))
        $errors['email'] = "Saississez votre email.";

    if (empty($_POST['password1']))
        $errors['password1'] = "Saississez votre mot de passe.";

    if (empty($_POST['password2']))
        $errors['password2'] = "Saississez votre mot de passe.";

    if (empty($_POST['password3']))
        $errors['password3'] = "Saississez votre mot de passe.";

    if ($_POST['password2'] != $_POST['password3']) {
        $errors['password4']  = "Votre mot de passe doit etre identique";
    }

    if (count($errors) > 0) {
        $_SESSION['errors'] = $errors;
        $_SESSION['values'] = $_POST;
        header("Location: /admin/edit-passwordAdmin.php");
        die;
    }

    // on cherche l'utilisateur en base de donnée avec son email
    $email = htmlspecialchars($_POST['email']);
    $password1 = htmlspecialchars($_POST['password1']);

    $pdo = $GLOBALS['pdo'];
    $sql = "SELECT * FROM utilisateur WHERE email_utilisateur = '" . $email . "'";

    $result = $pdo->query($sql);
    $user = $result->fetch(PDO::FETCH_ASSOC);

    //on test si l'utilisateur existe
    if ($user) {
        //si il existe, alors on compare les mots de passes
        //password_verify vérifie qu'un mot de passe correspond à un hachage
        if (password_verify($password1, $user['mot_de_passe_utilisateur'])) {
            $pdo = $GLOBALS['pdo'];
            $sql = "UPDATE utilisateur
            SET mot_de_passe_utilisateur = :password3
            WHERE id_utilisateur = :id_utilisateur";
            $_POST['password3'] = password_hash($_POST['password3'], PASSWORD_DEFAULT);
            $query = $pdo->prepare($sql);
            $res = $query->execute([
                'password3' => $_POST['password3'],
                'id_utilisateur' => $_POST['id_utilisateur']
            ]);
        } else { // si mdp pas ok, on redirige vers la page login
            $_SESSION['errors'] = "Identifiants invalide.";
            header("Location: /admin/edit-passwordAdmin.php");
            die;
        }
    } else  // 3. S'il n'existe pas, on redirige vers la page de login
    {
        $_SESSION['errors'] = "Identifiants invalides.";
        header("Location: /admin/edit-passwordAdmin.php");
        die;
    }
}
// else
// {
// header("Location: /edit-password.php"); die;
// }


?>

<nav class="nav-chaine noMobile">
    <div>
       <a class="noMobile" href="/admin/index.php"><button class="button-chaines police">Accueil</button></a>
    </div>
    <div>
    <a class="noMobile" href="/admin/affiche-reunionsAdmin.php"><button class="button-chaines police">Réunion</button>
    </div>
    
    <div class="button-creation-container noMobile">
        <a href="/admin/creation-reunionAdmin.php"><button class="button-creation police"><i class="fa-solid fa-circle-plus" style="color: #ffffff;"></i>Créer une réunion</button></a>
        <button class="button-creation police"><i class="fa-solid fa-circle-plus" style="color: #ffffff;"></i>Créer une chaine</button>
        <div class="icone-parametre"><a class="icone-parametre" href="./parametre-admin.php"><i class="fa-solid fa-gear fa-lg" style="color: #ffffff;"></i></a>

        </div>
</nav>

<main>
    <div class="container">
        <h1>Modification du mot de passe</h1>
        <div class="buttonAjout">
            <a href="/admin/parametre-utilisateurAdmin.php"><button class="button-creation police"><i class="fa-solid fa-arrow-left" style="color: #ffffff;"></i>Retour</button></a>
        </div>
        <div class="container-form ">
            <form id="form" class="formNewUser desigend-scrollbar " action="/admin/edit-passwordAdmin.php" method="post">

            <div class="formForm">
                <input type="hidden" name="id_utilisateur" value="<?= $_SESSION['user']['id'] ?>">
                <label for="">Email</label>
                <input id="emailEdit" type="email" name="email">
                <?php if (isset($_SESSION['errors']['email'])) : ?>
                    <small><?= $_SESSION['errors']['email'] ?></small>
                <?php endif; ?>
                <small id="emailErrorEdit"></small>
            </div>

            <div class="formForm">
                <label for="">Ancien mot de passe</label>
                <input id="oldPassword" type="password" name="password1">
                <?php if (isset($_SESSION['errors']['password1'])) : ?>
                    <small class="text-errors"><?= $_SESSION['errors']['password1'] ?></small>
                <?php endif; ?>
                <small id="oldPasswordError"></small>
            </div>

            <div class="formForm">
                <label for="">Nouveau mot de passe</label>
                <input id="newPassword1" type="password" name="password2">
                <?php if (isset($_SESSION['errors']['password2'])) : ?>
                    <small class="text-errors"><?= $_SESSION['errors']['password2'] ?></small>
                <?php endif; ?>
                <small id="newPassword1Error"></small>
            </div>

            <div class="formForm">

                <label for="">Confirmer le nouveau mot de passe</label>
                <input id="newPassword2" type="password" name="password3">
                <?php if (isset($_SESSION['errors']['password3'])) : ?>
                    <small class="text-errors"><?= $_SESSION['errors']['password3'] ?></small>
                <?php endif; ?>
                <small id="newPassword2Error">
                </small>
            </div>

            <div class="formForm">
                <input type="submit" name="submit" value="modifier">
            </div>
            </form>
        </div>
        <?php unset($_SESSION['errors']);
        unset($_SESSION['values']); ?>
    </div>
</main>
<div class="side">

</div>
<script src="/assets/script/burgerMenu-script.js"></script>
<script src="/assets/script/editPassword-script.js"></script>
</body>

</html>