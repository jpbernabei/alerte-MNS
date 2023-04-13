<?php

// Pour ajouter une chaine 

require $_SERVER['DOCUMENT_ROOT'].'/managers.php';

// Traiter le formulaire si envoyé
if(isset($_POST['submit']))
{

    $res = insertChaine($_POST['chaine']);
    
    if($res)
    {
        header("Location: index.php"); exit;
    }
    else
    {
        echo "Un erreur est survenue...";
    }

}


$chaine = getAllChaine();


?>
<div class="container py-5">
    <h1>Ajouter une chaîne</h1>
    <div class="row mb-4">
        <div class="col-auto">
            <a href="chaine-index.php" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Revenir...
            </a>
        </div>
        
    </div>

    <div class="row">
        <div class="col col-md-6">
            <form action="/new.php" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="nom_chaine">Nom de la chaine</label>
                    <input type="text" class="form-control" name="chaine[nom_chaine]"/>
                </div>
                <div class="form-group">
                    <label for="date_creation_chaine">Date de création de la chaîne</label>
                    <input type="date" class="form-control" name="chaine[date_creation_chaine]"/>
                </div>
                <div class="form-group">
                    <label for="actif_chaine">actif/desactif</label>
                    <textarea class="form-control" name="chaine[actif_chaine]"></textarea>
                </div>

                <input type="submit" name="submit" value="Enregistrer" class="btn btn-primary">
            </form>
        </div>
    </div>
</div>

