<?php
require $_SERVER['DOCUMENT_ROOT'] . '/includes/inc-db-connect.php';

//fonction qui permet d'ajouter un utilisateur
 function insertUser(array $data){
    $pdo = $GLOBALS['pdo'];
    $sql = "INSERT INTO utilisateur(email_utilisateur, mot_de_passe_utilisateur, nom_utilisateur, prenom_utilisateur, num_adresse_utilisateur, rue_adresse_utilisateur, code_postal_utilisateur, ville_adresse_utilisateur, date_creation_compte_utilisateur, actif_utilisateur, id_role) 
    VALUES (:email_utilisateur,:mot_de_passe_utilisateur,:nom_utilisateur,:prenom_utilisateur,:num_adresse_utilisateur,:rue_adresse_utilisateur,:code_postal_utilisateur,:ville_adresse_utilisateur,:date_creation_compte_utilisateur,:actif_utilisateur,:id_role)";

    $stmt = $pdo->prepare($sql);
    $stmt->execute($data);
    $id_user= $pdo->lastInsertId();
    return $id_user;
}

//fonction qui permet de récupérer les rôles
function getAllRoles(){
    $pdo = $GLOBALS['pdo'];
    $sql = "SELECT * FROM role ";
    return $pdo->query($sql)->fetchAll();
}

//on vérifie si le formulaire est envoyé
if(isset($_POST['submit']))
{
    //si il est envoyé on appel la fonction insertUser et on stock l'id de l'utilisateur ajouté dans une varible
    $id = insertUser($_POST['utilisateur']);

    //si il y a bien un id on redirige vers l'index
    if($id)
    {
        header("Location: /admin/parametre-utilisateurs/index.php"); exit;
    }
    else
    {
        echo "Un erreur est survenue...";
    }

}

$roles = getAllRoles();

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/style-parametre-admin.css">
    <script src="https://kit.fontawesome.com/18cbf17047.js" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>
    <div class="container-grid">
        <header>
            <img class="logo" src="/images/LOGO_ALERT_MNS_transparent.ico" alt="">
            <a href=""><i class="fa-solid fa-user fa-xl" style="color: #ffffff;"></i></a>
            <div class="police name-user">Nom utilisateur</div>
            <div><div class="police name-chaine">nom de la chaine </div><div class="police name-salon">nom du salon</div></div>
            <input class="search" type="search">
            <a href=""><i class="fa-solid fa-users fa-xl" style="color: #ffffff;"></i></a>
            <a href="../../logout.php"><i class="fa-solid fa-right-from-bracket fa-xl" style="color: #ffffff;"></i></a>
        </header>
        <nav class="nav-chaine">
            <div>
            <a href="/admin/parametre-utilisateurs/index.php"><button class="button-chaines police"><i class="fa-solid fa-user" style="color: #ffffff ;" ></i>Utilisateurs</button></a>
            </div>
            <div >
                <button class="button-chaines police"><i class="fa-solid fa-fire" style="color: #ffffff;"></i>Chaînes</button>
            </div>
            <div >
                <button class="button-chaines police"><i class="fa-solid fa-sitemap" style="color: #ffffff;"></i>Salons</button>
            </div>
            <div >
                <button class="button-chaines police"><i class="fa-solid fa-users " style="color: #ffffff;"></i>Réunions</button>
            </div>
            
            <div class="button-creation-container">
            
                <a href="../index.php"><button class="button-creation police"><i class="fa-solid fa-arrow-rotate-left"></i>Accueil</button></a>
                        
                
            </div>
        </nav>
        <main>
<div >
    <!-- formulaire pour l'ajout d'utilisateur -->
<form class="formNewUser" action="/admin/parametre-utilisateurs/new.php" method="POST">
    <label for="utilisateur[email_utilisateur]">Email</label>
    <input type="email" name="utilisateur[email_utilisateur]" required>

    <label for="utilisateur[mot_de_passe_utilisateur]">Mot de passe</label>
    <input type="password" name="utilisateur[mot_de_passe_utilisateur]" required>

    <label for="">Nom</label>
    <input type="text" name="utilisateur[nom_utilisateur]">

    <label for="">Prénom</label>
    <input type="text" name="utilisateur[prenom_utilisateur]">

    <label for="">Numéro de la rue</label>
    <input type="text" name="utilisateur[num_adresse_utilisateur]">

    <label for="">Nom de la rue</label>
    <input type="text" name="utilisateur[rue_adresse_utilisateur]">

    <label for="">Code postal</label>
    <input type="text" name="utilisateur[code_postal_utilisateur]">

    <label for="">Ville</label>
    <input type="text" name="utilisateur[ville_adresse_utilisateur]">

    
    <label for="">Rôle</label>
    <!-- on récupere les roles avec foreach et on les mets dans un select -->
    <select name="utilisateur[id_role]" id="">
    <?php foreach($roles as $role): ?>
        <option value="<?= $role['id_role'] ?>"><?= $role['libelle_role'] ?></option>
     <?php endforeach ?>
    </select>
    

    <label for="">Actif</label>
    <input id="actifUser" type="checkbox" value="1" name="utilisateur[actif_utilisateur]">
    <input id="noActifUser" type="hidden" value="0" name="utilisateur[actif_utilisateur]"  >

    <input type="hidden" name="utilisateur[date_creation_compte_utilisateur]" value="<?=date("Y-m-d")?>">
    <!-- verficationActifUser est une fonction JS pour donner une valeur booleen à la checkbox: 0 si elle n'est pas coché, 1 si elle l'est -->
        <input  type="submit" onclick='verificationActifUser()'  name="submit">
</form>
</div>
        </main>
        <script src="/assets/script/utilisateur-script.js"></script>
    </body>
</html>