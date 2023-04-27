<?php

require $_SERVER['DOCUMENT_ROOT'].'/includes/inc-db-connect.php'; 
require $_SERVER['DOCUMENT_ROOT'].'/managers/salons-managers.php';

//----------------------------------------------------------------
// Traitement de la requete 

if($_GET['salon']== "nom_salon")
{
    $salons = getSalonIdChaine($_POST['salon']);
} else{
    echo "Vous ne pouvez pas ou il n'y'a pas des salons dans cette chaine";
}

// Récuperer la requete qui selectionne  les salons en fontion de l'ID de la chaine 


// $salons= json_encode($salons);

?>

<!-- ----------------------------------------------------------------

file_put_contents('data.json', $salons);

$decoding= json_decode($salons, JSON_OBJECT_AS_ARRAY);

echo $decoding->nom_salon; -->
