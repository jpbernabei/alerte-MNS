<?php require $_SERVER['DOCUMENT_ROOT'] . "/includes/inc-top-admin.php"; 


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

<nav class="nav-chaine">
            <div>
            <a href="/admin/parametre-utilisateurs/index.php"><button class="button-chaines police"><i class="fa-solid fa-user" style="color: #ffffff ;" ></i>Utilisateurs</button></a>
            </div>
            <div>
                <button class="button-chaines police"><i class="fa-solid fa-fire" style="color: #ffffff;"></i>Chaînes</button>
            </div>
            <div>
                <button class="button-chaines police"><i class="fa-solid fa-sitemap" style="color: #ffffff;"></i>Salons</button>
            </div>
            <div>
                <button class="button-chaines police"><i class="fa-solid fa-users " style="color: #ffffff;"></i>Réunions</button>
            </div>

            <div class="button-creation-container">

                <a href="../index.php"><button class="button-creation police"><i class="fa-solid fa-arrow-rotate-left"></i>Accueil</button></a>
            </div>
        </nav>

<main>
<div class="container py-5">
    <h1>Modifier les informations du salon</h1>
    <div class="container">
            <div class="buttonAjout">
            <a href="/admin/parametre-salons/AllSalons.php?id=<?= $salon['id_chaine']?>"><button class="button-creation police"><i class="fa-solid fa-arrow-left" style="color: #ffffff;"></i>Retour</button></a>   
        </div>
            <form action="/admin/parametre-salons/edit.php?id=<?= $_GET['id']?>" method="post">
                <input type="hidden" name="salon[id_salon]" value="<?= $salon['id_salon'] ?>">

                    <label for="nom">Nom du salon</label>
                    <input type="text" class="form-control" name="salon[nom_salon]" value="<?=$salon['nom_salon']?>">
                <div>
                <input type="submit" onclick='verificationActifSalon()' name="submit" value="submit">
                </div>
            </form>
     
    
</div>
<script src="/assets/script/salons-script.js"></script>
</main>
<?php require $_SERVER['DOCUMENT_ROOT'] . "/includes/inc-bottom.php"; ?>