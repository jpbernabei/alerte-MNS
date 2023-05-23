<?php

require $_SERVER['DOCUMENT_ROOT']. '/includes/inc-db-connect.php';
require $_SERVER['DOCUMENT_ROOT'] . "/managers/utilisateur-manager.php";
require $_SERVER['DOCUMENT_ROOT'] . "/includes/inc-top-admin.php";

if (!empty($_POST['isActive'])) {
    $isActive = isset($_POST['actif_utilisateur']) ? 1 : 0;

    $sql = "UPDATE utilisateur SET actif_utilisateur = :actif_utilisateur WHERE id_utilisateur = :id_utilisateur";
    $query = $pdo->prepare($sql);
    $active = $query->execute([
        'actif_utilisateur' => $isActive,
        'id_utilisateur' => $_POST['id_utilisateur']
    ]);
}

$utilisateurs = getAllUser();

?>

        <nav class="nav-chaine">
            <div>
                <button class="button-chaines police"><i class="fa-solid fa-user" style="color: #ffffff ;"></i>Utilisateurs</button>
            </div>
            <div>
                <button class="button-chaines police"><i class="fa-solid fa-fire" style="color: #ffffff;"></i>Chaînes</button>
            </div>
            <div>
                <button class="button-chaines police"><i class="fa-solid fa-sitemap" style="color: #ffffff;"></i>Salons</button>
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
                <h1>Liste des Utilisateurs</h1>
                
                <div class="buttonAjout">
                <a href="/admin/parametre-admin.php"><button class="button-creation police"><i class="fa-solid fa-arrow-left" style="color: #ffffff;"></i>Retour</button></a>
                <a href="/admin/parametre-utilisateurs/new.php"><button class="button-creation police"><i class="fa-solid fa-circle-plus"
                        style="color: #ffffff;"></i>Utilisateur
                    </button></a></div>
                
                
                    <div class="container-table desigend-scrollbar ">
                        <table>
                            <thead >
                                <th>ID</th>
                                <th>Email</th>
                                <th>Nom</th>
                                <th>Prénom</th>
                                <th></th>
                                <th>Activer/Désactiver</th>
                                <th></th>
                            </thead>
                            <tbody>

                                <?php foreach ($utilisateurs as $utilisateur) : ?>
                                    <tr>
                                        <td><?= $utilisateur['id_utilisateur'] ?></td>
                                        <td><?= $utilisateur['email_utilisateur'] ?></td>
                                        <td><?= $utilisateur['nom_utilisateur'] ?></td>
                                        <td><?= $utilisateur['prenom_utilisateur'] ?></td>
                                        <td><a class="button-a" href="/admin/parametre-utilisateurs/edit.php?id=<?= $utilisateur['id_utilisateur'] ?>">Modifier</a></td>
                                        <td>
                                            <form action="/admin/parametre-utilisateurs/index.php" method="post">
                                            <label class="toggle">
                                                <input type="hidden" name="id_utilisateur" value="<?= $utilisateur['id_utilisateur'] ?>">
                                                <input class="toggle-checkbox" type="checkbox" <?= $utilisateur['actif_utilisateur'] == 1 ? 'checked' : ''?> name="actif_utilisateur">
                                              
                                                <div class="toggle-switch"></div>
                                                <span class="toggle-label"></span>
                                            </label>
                                        </td>
                                        <td>  <input class="button-lien" type="submit" name="isActive" value="valider"></td></form> 
                                    </tr>
                                <?php
                                endforeach;  ?>
                            </tbody>
                            
                        </table>


                    </div>

                

            </div>
        </main>
            <script src="/assets/script/utilisateur-script.js"></script>
</body>

</html>