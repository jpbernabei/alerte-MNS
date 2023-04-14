<?php

require $_SERVER['DOCUMENT_ROOT']. "/managers/chaine-manager.php"; 

// Vérification du paramètre
if (empty($_GET['id'])) {
    header("Location: /admin/parametre-chaines/index.php");
    die;
}

// Traiter le formulaire si envoyé
if (!empty($_POST['submit'])) {
    
    $chaine = updateChaine($_POST);
    
    if ($chaine) {
        echo "Chaîne modifiée avec succès !";
    } else {
        echo "Un erreur est survenue...";
    }
}


// Récupération des informations de la chaine à modifier
$chaine = getChaineId($_GET['id']);

// On vérifie si les chaines sont bien présent en BDD
if (!$chaine) {
    header("Location: /admin/parametre-chaines/index.php");
    die;
}

// Pour récuperer les utilisateurs dans une chaine

$chaines = getUtilisateurChaine($_POST);

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
            <form action="/admin/parametre-chaines/edit.php?id=<?= $chaine['id_chaine'] ?>" method="POST">
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

                <!-- Pour faire apparaitre les utilisateurs qui sont dans la chaine
            Faire une fonction qui recupere les utilisateurs d'une chaine et après met dans la boucle-->
                
                <?php foreach($chaines as $chaine): ?>
        <tr>
            <td><?= $chaine['nom_utilisateur'] ?></td>
            <td><?= $chaine['prenom_utilisateur'] ?></td>
        </tr>
        <?php endforeach; ?>
                <input type="submit" name="submit" value="Enregistre les modifications" class="btn btn-primary">
            </form>
        </div>
     
    </div>
</div>