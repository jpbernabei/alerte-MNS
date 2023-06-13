<?php


include '../../includes/inc-db-connect.php';
require $_SERVER['DOCUMENT_ROOT'] . "/managers/reunion-manager.php";
require $_SERVER['DOCUMENT_ROOT'] . "/includes/inc-top-admin.php";
// on vérifie l'envoie du formulaire
if (!empty($_POST['isActive'])) {
     // formulaire pour acitiver/désactiver une réunion
    // on vérifi si le champ est checked, si il est checked, on met 1 dans la variable, sinon on met 0
    // (car quand une chekbox est checked elle renvoi ON,si elle n'est pas checked, elle ne renvoie rien)

    $isActive = isset($_POST['actif_reunion']) ? 1 : 0;

    $sql = "UPDATE reunion SET actif_reunion = :actif_reunion WHERE id_reunion = :id_reunion";
    $query = $pdo->prepare($sql);
    $active = $query->execute([
        'actif_reunion' => $isActive,
        'id_reunion' => $_POST['id_reunion']
    ]);
}
// appel de la fonction qui selectionne toutes les réunions actifs
$reunions = getAllReunionActif();

?>
        <nav class="nav-chaine">
            <div>
                <a href="/admin/parametre-utilisateurs/index.php"><button class="button-chaines police"><i class="fa-solid fa-user" style="color: #ffffff ;"></i>Utilisateurs</button></a>
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

                <a href="/admin/index.php"><button class="button-creation police"><i class="fa-solid fa-arrow-rotate-left"></i>Accueil</button></a>


            </div>
        </nav>
        <main>
        <div class="container">
                <h1>Liste des Réunions</h1>
                <div class="buttonAjout">
                <a href="/admin/parametre-admin.php"><button class="button-creation police"><i class="fa-solid fa-arrow-left" style="color: #ffffff;"></i>Retour</button></a>
                <a class="direction-right" href="/admin/parametre-reunions/new.php"><button class="button-creation police"><i class="fa-solid fa-circle-plus"
                        style="color: #ffffff;"></i>Réunion
                    </button></a></div>
                    <!-- tableau avec les réunions et leurs informations -->
            <div class="container-table desigend-scrollbar ">
                <table>
                    <thead>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Sujet</th>
                        <th>Date de création</th>
                        <th>Date prévu</th>
                        <th>Heure prévu</th>
                        <th>Id créateur de la réunion</th>
                        <th></th>
                        <th>Activé/Désactivé</th>
                        
                        <th></th>
                    
                    </thead>
                    <tbody>
                        <!-- on récupere chaque réunions et leurs informations -->
                        <?php foreach ($reunions as $reunion) : ?>
                            <tr>
                                <td><?= $reunion['id_reunion'] ?></td>
                                <td><?= $reunion['nom_reunion'] ?></td>
                                <td><?= $reunion['sujet_reunion'] ?></td>
                                <td><?= $reunion['date_creation_reunion'] ?></td>
                                <td><?= $reunion['date_prevu_reunion'] ?></td>
                                <td><?= $reunion['heure_prevu_reunion'] ?></td>
                                <td><?= $reunion['id_utilisateur'] ?></td>
                                <td><a class="button-a"  href="/admin/parametre-reunions/edit.php?id=<?= $reunion['id_reunion'] ?>">Modifier</a></td>
                                <!-- formulaire sous forme de toogle switch pour activer ou désactiver une réunion -->
                                <td> <label class="toggle">
                                    <form action="/admin/parametre-reunions/index.php" method="POST">
                                        <!-- on récupere l'id de la réunion -->
                                    <input type="hidden" name="id_reunion" value="<?= $reunion['id_reunion'] ?>">
                                    <!-- on récupere la donnée dans la colonne actif_reunion, avec une condition ternaire, si la donnée est 1, alors la checkbox est checké, sinon elle ne l'est pas -->
                                        <input  class="toggle-checkbox" type="checkbox" <?= $reunion['actif_reunion'] == 1 ? 'checked' : ''?> name="actif_reunion">
                                        <div class="toggle-switch"></div>
                                        <span class="toggle-label"></span>
                                    </label>                              
                                </td>
                                <td><input type="submit" value="Valider" name="isActive"></td></form>
                                
                            </tr>
                        <?php
                        endforeach;  ?>
                    </tbody>
                </table>


            </div>
        </main>

    </div>
</body>

</html>