<?php
session_start();
require $_SERVER['DOCUMENT_ROOT'] . "/managers/chaine-manager.php";


if(isset($_POST['submit'])){
    $count = updateChaine1($_POST['chaine']);
    if($count == 1){
        echo ('Modifier réussi');
    }else {
        echo ("Une erreur s'est produit");
    }
}
// Vérification du paramètre de l'id choisie pour modifier 

if (empty($_GET['id'])) {
    header("Location: /admin/parametre-chaines/index.php");
    die;

}

// On vérifie si les chaines sont bien présent en BDD
$chaine = getChaineId($_GET['id']);
if(!$chaine){
    header("Location: /admin/parametre-chaines/index.php");
    die;
}

?>
<div class="container py-5">
    <h1>Modifier les informations de la chaîne</h1>
    <div class="row mb-4">
        <div class="col-auto">
            <a href="/admin/parametre-chaines/index.php" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> revenir ..........
            </a>
        </div>

    </div>

    <div class="row">
        <div class="col col-md-6">
            <form action="/admin/parametre-chaines/edit.php?id=<?= $_GET['id'] ?>" method="POST">
                <input type="hidden" name="chaine[id_chaine]" value="<?= $chaine['id_chaine'] ?>">
                <div class="form-group">
                    <label for="titre">Nom de la chaine</label>
                    <input type="text" class="form-control" name="chaine[nom_chaine]" value="<?= $chaine['nom_chaine'] ?>" />
                </div>
                <div class="form-group">
                    <label for="titre">Actif du chaine</label>
                    <!-- Pour le bouton actif\desactif-->
                <input id="actifChaine" type="checkbox" value="<?= $chaine['actif_chaine'] ?>" name="chaine[actif_chaine]">
                <input id="noActifChaine" type="hidden" value="0" name="chaine[actif_chaine]">
                </div>
                <!-- Pour faire apparaitre les utilisateurs qui sont dans la chaine
            Faire une fonction qui recupere les utilisateurs d'une chaine et après met dans la boucle-->

        <input type="submit" onclick='verificationActifChaine()' name="submit">
            </form>
        </div>

    </div>
    <script src="/assets/script/chaines-script.js"></script>
</div>