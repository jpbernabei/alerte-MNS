<?php require $_SERVER['DOCUMENT_ROOT'] . "/includes/inc-top.php"; 
session_start();

require $_SERVER['DOCUMENT_ROOT'].'/managers/salons-managers.php';

// verification si c'est soumis

if(isset($_POST['submit']))
{
    $count = updateSalon($_POST['salon']); 
    if($count == 1)
    {
        echo('Modifier de ce salon réussi');
    }
    else
    {
        echo('Une erreur s\'est produit lors de la modification de ce salon');
    }
}

// Vérification du parametre de l'ID choisie pour modifier 

if(empty($_GET['id']))
{
    header("Location: /admin/parametre-salons/index.php");
    die;
}

// On verifie si le salon est bien présent en BDD 

$salon = getSalonId($_GET['id']);

if(!$salon)
{
    header("Location: /admin/parametre-salons/index.php");
    die; 
}

?> 


<div class="container py-5">
    <h1>Modifier les informations du salon</h1>
    <div class="row mb-4">
        <div class="col-auto">
            <a href="/admin/parametre-salons/index.php" class="btn btn-secondary"> 
                <i class="bi bi-arrow-left">Cliquez pour revenir vers la page précédente</i>
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col col-md-6">
            <form action="/admin/parametre-salons/edit.php?id=<?= $_GET['id']?>" method="post">
                <input type="hidden" name="salon[id_salon]" value="<?= $salon['id_salon'] ?>">

                <div class="form-group">
                    <label for="nom">Nom du salon</label>
                    <input type="text" class="form-control" value="<?=$salon['nom_salon']?>">
                </div>

                <div class="for-group">
                    <label for="actif">Actif salon</label>
                    <input id="actifSalon" type="checkbox" value="<?= $salon['actif_salon'] ?>" name="salon[actif_salon]">
                    <input id="noActifsalon" type="hidden" value="0" name="salon[actif_salon]">
                </div>
            </form>
        </div>
    </div>
</div>
<script src="/assets/script/salons-script.js"></script>

<?php require $_SERVER['DOCUMENT_ROOT'] . "/includes/inc-bottom.php"; ?>