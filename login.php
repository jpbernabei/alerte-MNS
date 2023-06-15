<?php
session_start();
// pour éviter que l'utilisateur Back sur la page de login une fois qu'il est connecté
// on vérifie si l'utilisateur est déjà connecté
if (isset($_SESSION['user'])) {
    if ($_SESSION['user']['is_admin_utilisateur'] == 1) {
        // on redirige l'utilisateur vers l'interface admin ou utilisateur 
        header("Location: /admin/index.php");
    } else {

        header("Location: /index.php");
    }
    exit; 
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/style-login.css">
    <script src="https://kit.fontawesome.com/18cbf17047.js" crossorigin="anonymous"></script>
    <title>Connexion</title>
</head>

<body>
    <div class="container">
        <!-- formulaire pour la connexion qui se trouve dans le fichier login-POST.php -->
        <form id="form" action="/login-POST.php" method="post">
            <div class="title">
                <img class="logoLogin " src="/images/LOGO_ALERT_MNS_transparent.ico" alt="">
                <h1 >Alerte MNS</h1>
            </div>
            <div class="label">
                <label for="email" class="police ">Email</label>
                <input id="email" class="champ" type="email" name="email" placeholder="Saisissez votre email"
                value="<?= isset($_SESSION['values']['email']) ? $_SESSION['values']['email'] : '' ?> " >

                <label for="password" class="police ">Password</label>
                <input id="password" class="champ" type="password" name="password" placeholder="Saisissez votre mot de passe"
                value="<?= isset($_SESSION['values']['password']) ? $_SESSION['values']['password'] : '' ?>" >
          
                <small id="error"><?= isset($_SESSION['errors']['error']) ? $_SESSION['errors']['error'] : '' ?></small>

                


                <div class="forgotPassword">
                    <!-- <a href="#">Mot de passe oublié?</a> -->
                </div>
                <div class="container-button">
                    <input class="police button" type="submit" value="connexion" name="submit">
                </div>

            </div>
            <div class="first-time">
                <!-- <span class="sousText">Si c'est la première fois que vous vous connectez,&nbsp;</span><a href="change-first-password.html"> cliquez-ici !</a> -->
            </div>
        </form>
    </div>
    <?php unset($_SESSION['errors']);
        ?>
    <script src="/assets/script/script.js"></script>
</body>

</html>