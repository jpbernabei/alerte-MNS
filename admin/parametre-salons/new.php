<?php require $_SERVER['DOCUMENT_ROOT'] . "/includes/inc-top.php";

// Pour ajouter une chaine 
session_start();

require $_SERVER['DOCUMENT_ROOT'].'/managers/salons-managers.php';


// Traiter le formulaire si envoyé
if(isset($_POST['submit']))
{ 
    $salons = insertSalon($_POST['salon']);
    
    if($salons)
    {
        header("Location: /admin/parametre-salons/index.php"); exit;
    }
    else
    {
        echo "Une erreur est survenue lors de la création du salon";
    }
}

?>
<div class="container py-5">
    <h1>Ajouter un salon </h1>
    <div class="row mb-4">
        <div class="col-auto">
            <a href="/admin/parametre-salons/index.php" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Revenir à la page précédente
            </a>
        </div>
        
    </div>

    <div class="row">
        <div class="col col-md-6">
            <form action="/admin/parametre-salons/new.php" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="nom_salon">Nom du salon</label>
                    <input type="text" class="form-control" name="salon[nom_salon]" >
                </div>
                    <input type="hidden" class="form-control" name="salon[date_creation_salon]" value="<?=date('Y-m-d')?>"/>
                    <input type="hidden" name="salon[id_chaine]" value="<?=$_GET['id'] ?>">
       
                <div class="form-group">
                    <label for="actif_salon">actif/desactif</label>
                    <input id="actifSalon" type="checkbox" value="1" name="salon[actif_salon]">
                    <input id="noActifSalon" type="hidden" value="0" name="salon[actif_salon]">
                </div>
                <input type="submit" onclick='verificationActifChaine()' name="submit" value="Enregistrer" class="btn btn-primary">
            </form>
        </div>
    </div>
</div>
<script src="/assets/script/salons-script.js"></script>

<?php require $_SERVER['DOCUMENT_ROOT'] . "/includes/inc-bottom.php"; ?>