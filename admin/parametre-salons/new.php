<?php require $_SERVER['DOCUMENT_ROOT'] . "/includes/inc-top-admin.php";

// Pour ajouter une chaine 
require $_SERVER['DOCUMENT_ROOT'].'/managers/salons-managers.php';
require $_SERVER['DOCUMENT_ROOT'].'/managers/chaine-manager.php';

$salon = getChaineId($_GET['id']);
// On verifie si le salon est bien présent en BDD 
if (!$salon) {
    header("Location: /admin/parametre-salons/index.php");
    die;
}

// Traiter le formulaire si envoyé
if(isset($_POST['submit']))
{ 
    // On initialise la variable erreur comme un tableau vide
    $errors=[];

    if(empty($_POST['salon']['nom_salon']))
    $errors['nom_salon']='le champs ne doit pas etre vide';

    if(count($errors) > 0)
    {
        $_SESSION['errors'] = $errors;
        header("Location: /admin/parametre-salons/new.php?id=".$_GET['id']);
        die;
    }
    
    $salons = insertSalon($_POST['salon']);
    if($salons)
    {
        unset($_SESSION['values']);
        unset($_SESSION['errors']);
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
            <a href="/admin/parametre-salons/AllSalons?id=<?=$salon['id_chaine']?>"><button class="button-creation police"><i class="fa-solid fa-arrow-left" style="color: #ffffff;"></i>Retour</button></a>
        </div>
        <div class="container-table desigend-scrollbar">
            <form action="/admin/parametre-salons/new.php?id=<?=$_GET['id']?>" method="POST" enctype="multipart/form-data" id="form">
                <div class="form-group">
                    <label for="nom_salon" id="salon">Nom du salon</label>
                    <input type="text" class="form-control" name="salon[nom_salon]" >
                    <?php if (isset($_SESSION['errors']['nom_salon'])) : ?>
                        <p><small><?= $_SESSION['errors']['nom_salon'] ?></small></p>
                    <?php endif; ?>
                </div>
                    <input type="hidden" class="form-control" name="salon[date_creation_salon]" value="<?=date('Y-m-d')?>"/>
                    <input type="hidden" name="salon[id_chaine]" value="<?= $_GET['id'] ?>">
                    <input type="submit" onclick='verificationActifChaine()' name="submit" value="Enregistrer" class="btn btn-primary">
            </form>
        </div>
        <?php unset($_SESSION['errors']);?>
</div>
<script src="/assets/script/salons-script.js"></script>
</main>
<?php require $_SERVER['DOCUMENT_ROOT'] . "/includes/inc-bottom.php"; ?>