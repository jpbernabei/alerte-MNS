<?php
session_start();

require $_SERVER['DOCUMENT_ROOT'] . '/includes/inc-db-connect.php';

if(isset($_GET['user'])){
    $user = (string) trim($_GET['user']);

    $pdo = $GLOBALS['pdo'];
    $stmt = $pdo->prepare("SELECT * FROM utilisateur
    JOIN role ON utilisateur.id_role = role.id_role
    WHERE nom_utilisateur LIKE ? LIMIT 10");
    $stmt->execute(["%$user%"]);
    $result = $stmt->fetchAll();

    foreach($result as $r){
    ?>
    <div><?=$r['nom_utilisateur'] . " " . $r['prenom_utilisateur'] . " " . $r['email_utilisateur'] . " " . $r['libelle_role'] ?></div>
    
    <?php
    }
}
?>