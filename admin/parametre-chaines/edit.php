<?php

require $_SERVER['DOCUMENT_ROOT']. "/includes/inc-db-connect.php"; 


// Vérification du paramètre
if (empty($_GET['id'])) {
    header("Location: /index.php");
    die;
}

// Traiter le formulaire si envoyé
if (!empty($_POST['submit'])) {

    $chaine = updateChaine($_POST);

    if ($chaine) {
        echo "Livre modifiée avec succès !";
    } else {
        echo "Un erreur est survenue...";
    }
}


// Récupération des informations de la chaine à modifier
$chaine = getChaineId($_GET['id']);

// On vérifie si l'article est bien présent en BDD
if (!$chaine) {
    header("Location: /index.php");
    die;
}

?>
<div class="container py-5">
    <h1>Modifier les informations de la chaîne</h1>
    <div class="row mb-4">
        <div class="col-auto">
            <a href="/livre/index.php" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> revenir ..........
            </a>
        </div>

    </div>

    <div class="row">
        <div class="col col-md-6">
            <form action="/edit.php?id=<?= $chaine['id_chaine'] ?>" method="POST">
                <input type="hidden" name="chaine[id_chaine]" value="<?= $chaine['nom_chaine'] ?>">
                <div class="form-group">
                    <label for="titre">Nom de la chaine</label>
                    <input type="text" class="form-control" name="nom_chaine" value="<?= $chaine['nom_chaine'] ?>" />
                </div>
                <div class="form-group">
                    <label for="titre">Date de création de la chaîne</label>
                    <input type="text" class="form-control" name="date_creation_chaine" value="<?= $chaine['date_creation_chaine'] ?>" />
                </div>
                <div class="form-group">
                    <label for="titre">Actif du chaine</label>
                    <input type="text" class="form-control" name="actif_chaine" value="<?= $chaine['actif_chaine'] ?>" />
                </div>
                <input type="submit" name="submit" value="Enregistrer" class="btn btn-primary">
            </form>
        </div>
     
    </div>
</div>