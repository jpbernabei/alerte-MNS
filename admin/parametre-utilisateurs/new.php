<?php
require $_SERVER['DOCUMENT_ROOT'] . '/includes/inc-db-connect.php';

 function insertUser(array $data){
    $pdo = $GLOBALS['pdo'];
    $sql = "INSERT INTO utilisateur(email_utilisateur, mot_de_passe_utilisateur, nom_utilisateur, prenom_utilisateur, num_adresse_utilisateur, rue_adresse_utilisateur, code_postal_utilisateur, ville_adresse_utilisateur, date_creation_utilisateur, actif_utilisateur, id_role ) 
    VALUES (:email_utilisateur,:mot_de_passe_utilisateur,:nom_utilisateur,:prenom_utilisateur,:num_adresse_utilisateur,:rue_adresse_utilisateur,:code_postal_utilisateur,:ville_adresse_utilisateur,:date_creation_utilisateur,:actif_utilisateur,:id_role";
    $stmt = $pdo->prepare($sql);
    $stmt->execute($data);
}

function getAllRoles(){
    $pdo = $GLOBALS['pdo'];
    $sql = "SELECT * FROM role ";
    return $pdo->query($sql)->fetchAll();
}

//on vérifie si le formulaire est envoyé
if(!empty($_POST['submit']))
{
    $id = insertUser($_POST['utilisateur']);

    if($id)
    {
        header("Location: /admin/paremetre-utilisateurs/index.php"); exit;
    }
    else
    {
        echo "Un erreur est survenue...";
    }

}

$roles = getAllRoles();

?>

<form action="/admin/parametre-utilisateurs/new.php" method="POST">
    <label for="utilisateur[email_utilisateur]">Email</label>
    <input type="email" name="utilisateur[email_utilisateur]" required>

    <label for="utilisateur[mot_de_passe_utilisateur]">Mot de passe</label>
    <input type="password" name="utilisateur[mot_de_passe_utilisateur]" required>

    <label for="">Nom</label>
    <input type="text" name="utilisateur['nom_utilisateur']">

    <label for="">Prénom</label>
    <input type="text" name="utilisateur['prenom_utilisateur']">

    <label for="">Numéro de la rue</label>
    <input type="text" name="utilisateur['num_adresse_utilisateur']">

    <label for="">Nom de la rue</label>
    <input type="text" name="utilisateur['rue_adresse_utilisateur']">

    <label for="">Code postal</label>
    <input type="text" name="utilisateur['code_postal_utilisateur']">

    <label for="">Ville</label>
    <input type="text" name="utilisateur['ville_adresse_utilisateur']">

    
    <label for="">Rôle</label>
    
    <select name="utilisateur['id_role']" id="">
    <?php foreach($roles as $role): ?>
        <option value="<?= $role['id_role'] ?>"><?= $role['libelle_role'] ?></option>

     <?php endforeach ?>
    </select>
    

    <label for="">Actif</label>
    <input type="checkbox" name="utilisateur['actif_utilisateur']">


</form>
