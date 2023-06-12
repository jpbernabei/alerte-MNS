<?php
session_start();

if(isset($_GET['user'])){
    $user = (string) trim($_GET['user']);

    $pdo = $GLOBALS['pdo'];
    $stmt = $pdo->prepare("SELECT * FROM utilisateur
    WHERE nom_utilisateur LIKE ? LIMIT 10");
    $stmt->execute(["%$user%"]);
    $result = $stmt->fetchAll();

    foreach($result as $r){
    ?>
    <div><?=$r['nom_utilisateur'] . " " . $r['prenom_utilisateur'] ?></div>
    <?php
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/style.css">
    <script src="https://kit.fontawesome.com/18cbf17047.js" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>
    <div class="container">
        <header>
            <img class="logo noMobile" src="/images/LOGO_ALERT_MNS_transparent.ico" alt="">
            <a href="/parametre-utilisateur.php"><i class="fa-solid fa-user fa-xl" style="color: #ffffff;"></i></a>
            <div class="police name-user noMobile"><?=$_SESSION['user']['firstname'] ?> <?=$_SESSION['user']['name'] ?></div>
            <div><div class="police name-chaine noMobile">nom de la chaine </div><div class="police name-salon noMobile">nom du salon</div></div>
            <div><input type="text" id='search-user' value="" placeholder="Rechercher"></div>

    

            <a href="/affiche-reunion.php"><i class="fa-solid fa-users fa-xl" style="color: #ffffff;"></i></a>
            <a href="/logout.php"><i class="fa-solid fa-right-from-bracket fa-xl" style="color: #ffffff;"></i></a>
        </header>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
<script
  src="https://code.jquery.com/jquery-3.7.0.js"
  integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM="
  crossorigin="anonymous"></script>
<script
  src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"
  integrity="sha256-xLD7nhI62fcsEZK2/v8LsBcb4lG7dgULkuXoXB/j91c="
  crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js" 
  integrity="sha512-2rNj2KJ+D8s1ceNasTIex6z4HWyOnEYLVC3FigGOmyQCZc2eBXKgOxQmo3oKLHyfcj53uz4QMsRCWNbLd32Q1g==" 
  crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script> 
    $(document).ready(function(){
        // l'evenement se produit quand la touche du clavier est relaché (keyup)
        $('#search-user').keyup(function(){
            $("#result-search").html('');
           let utilisateur = $(this).val();

           if(utilisateur != ""){
            $.ajax({
                type: 'GET',
                url: 'fonctions/recherche_utilisateur.php',
                data: 'user=' + encodeURIComponent(utilisateur),
                success: function(data){
                    if(data != ""){
                    $("#result-search").append(data);
                    }else{
                        document.getElementById('result-search').innerHTML = "<div>Aucun utilisateur</div>"
                    }
                }
            });
        }
        });
    });

</script>