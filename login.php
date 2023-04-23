<?php
session_start();

require $_SERVER['DOCUMENT_ROOT'].'/includes/inc-top.php';
?>

    <form action="/login-POST.php" method="post">
        <div class="card">
            <div class="container">
                <div class="title">
                    <img class="logoLogin " src="/images/LOGO_ALERT_MNS_transparent.ico" alt="">
                    <h1 class="police">Alerte MNS</h1>
                </div>
                <div class="label">
                    <label for="email" class="police ">Email</label>
                    <input id="email" class="champ" type="email" name="email" placeholder="Saisir votre email">
                    <?php if(isset($_SESSION['errors']['email'])):?>
                        <small class="text-errors"><?=$_SESSION['errors']['email']?></small>
                        <?php endif; ?>
                    <label for="password" class="police ">Password</label>
                    <input id="password" class="champ" type="password" name="password" placeholder="Saisir votre mot de passe">
                    <?php if(isset($_SESSION['errors']['password'])): ?>
                        <small class="text-danger"><?= $_SESSION['errors']['password'] ?></small>
                        <?php endif; ?>
                    <div class="forgotPassword">
                        <a  href="#">Mot de passe oublié?</a>
                    </div>
                    <div class="container-button">
                        <input class="police button" type="submit" value="connexion" name="submit">
                    </div>
                    
                </div>
                <div class="first-time">
                    <span class="sousText">Si c'est la première fois que vous vous connectez,&nbsp;</span><a  href="change-first-password.html"> cliquez-ici !</a>
                </div>
            </div>
        </div>
    </form>
    <script src="script.js"></script>
A
<?php include 'includes/inc-bottom.php'; ?>