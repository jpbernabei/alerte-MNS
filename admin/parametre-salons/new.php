<?php require $_SERVER['DOCUMENT_ROOT'] . "/includes/inc-top-admin.php";

// Pour ajouter une chaine 


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

<nav class="nav-chaine">
            <div>
            <a href="/admin/parametre-utilisateurs/index.php"><button class="button-chaines police"><i class="fa-solid fa-user" style="color: #ffffff ;" ></i>Utilisateurs</button></a>
            </div>
            <div>
                <a href="/admin/parametre-chaines/index.php"><button class="button-chaines police"><i class="fa-solid fa-fire" style="color: #ffffff;"></i>Chaînes</button></a>
            </div>
            <div>
                <a href="/admin/parametre-salons/index.php"><button class="button-chaines police"><i class="fa-solid fa-sitemap" style="color: #ffffff;"></i>Salons</button></a>
            </div>
            <div>
                <a href="/admin/parametre-reunions/index.php"><button class="button-chaines police"><i class="fa-solid fa-users " style="color: #ffffff;"></i>Réunions</button></a>
            </div>

            <div class="button-creation-container">

                <a href="../index.php"><button class="button-creation police"><i class="fa-solid fa-arrow-rotate-left"></i>Accueil</button></a>
            </div>
        </nav>

        <main>
<div class="container">
    <h1>Ajouter un salon </h1>
    <div class="buttonAjout">
            <a href="/admin/parametre-salons/index.php"><button class="button-creation police"><i class="fa-solid fa-arrow-left" style="color: #ffffff;"></i>Retour</button></a>
        </div>

   
        <div class="container-table desigend-scrollbar">
            <form action="/admin/parametre-salons/new.php" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="nom_salon">Nom du salon</label>
                    <input type="text" class="form-control" name="salon[nom_salon]" >
                </div>
                    <input type="hidden" class="form-control" name="salon[date_creation_salon]" value="<?=date('Y-m-d')?>"/>
                    <input type="hidden" name="salon[id_chaine]" value="<?=$_GET['id'] ?>">
       
                <!-- <div class="form-group">
                    <label for="actif_salon">actif/desactif</label>
                    <input id="actifSalon" type="checkbox" value="1" name="salon[actif_salon]">
                    <input id="noActifSalon" type="hidden" value="0" name="salon[actif_salon]">
                </div> -->
                <input type="submit" onclick='verificationActifChaine()' name="submit" value="Enregistrer" class="btn btn-primary">
            </form>
        </div>
  
</div>
<script src="/assets/script/salons-script.js"></script>
</main>
<?php require $_SERVER['DOCUMENT_ROOT'] . "/includes/inc-bottom.php"; ?>