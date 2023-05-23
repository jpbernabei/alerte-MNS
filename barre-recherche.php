<?php
require $_SERVER['DOCUMENT_ROOT'] . '/includes/inc-db-connect.php';
require $_SERVER['DOCUMENT_ROOT'] . "/managers/utilisateur-manager.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
 
<input type="text" id='search-user' value="" placeholder="Rechercher">
<div>
    <div id="result-search"></div>
</div>


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
</body>
</html>