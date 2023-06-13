<?php
session_start();

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/style-login.css">
    <script src="https://kit.fontawesome.com/18cbf17047.js" crossorigin="anonymous"></script>
    <title>Document</title>
</head>

<body>


    <div class="container">
        <form action="/login-POST.php" method="post">
            <div class="title">
                <img class="logoLogin " src="/images/LOGO_ALERT_MNS_transparent.ico" alt="">
                <h1 >Alerte MNS</h1>
            </div>
            <div class="label">
                <label for="email" class="police ">Email</label>
                <input id="email" class="champ" type="email" name="email" placeholder="Saisir votre email">
                <?php if (isset($_SESSION['errors']['email'])) : ?>
                    <small class="text-errors"><?= $_SESSION['errors']['email'] ?></small>
                <?php endif; ?>
                <label for="password" class="police ">Password</label>
                <input id="password" class="champ" type="password" name="password" placeholder="Saisir votre mot de passe">
                <?php if (isset($_SESSION['errors']['password'])) : ?>
                    <small class="text-danger"><?= $_SESSION['errors']['password'] ?></small>
                <?php endif; ?>
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
    <script src="/assets/script/script.js"></script>
</body>

</html>