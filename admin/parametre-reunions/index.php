<?php


include '../../includes/inc-db-connect.php';
require $_SERVER['DOCUMENT_ROOT'] . "/managers/reunion-manager.php";
require $_SERVER['DOCUMENT_ROOT'] . "/includes/inc-top-admin.php";

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
        <div>
                <h1>Liste des Réunions</h1>
                <div class="">
                    
                    <a href="/admin/parametre-reunions/new.php">
                        Créer une réunion
                    </a>

                </div>
            <div>
                <table>
                    <thead>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Sujet</th>
                        <th>Date de création</th>
                        <th>Date prévu</th>
                        <th>Heure prévu</th>
                        <th></th>
                        <th>Activé/Désactivé</th>
                        <th>Id créateur de la réunion</th>
                        <th>suprimer</th>
                    </thead>
                    <tbody>

                        <?php foreach ($reunions as $reunion) : ?>
                            <tr>
                                <td><?= $reunion['id_reunion'] ?></td>
                                <td><?= $reunion['nom_reunion'] ?></td>
                                <td><?= $reunion['sujet_reunion'] ?></td>
                                <td><?= $reunion['date_creation_reunion'] ?></td>
                                <td><?= $reunion['date_prevu_reunion'] ?></td>
                                <td><?= $reunion['heure_prevu_reunion'] ?></td>
                                <td><a href="/admin/parametre-reunions/edit.php?id=<?= $reunion['id_reunion'] ?>">Modifier</a></td>
                                <td> <label class="toggle">
                                        <input id="actifUser" class="toggle-checkbox" type="checkbox" value="<?= $reunion['actif_reunion'] ?>" name="reunion[actif_reunion]">
                                        <div class="toggle-switch"></div>
                                        <span class="toggle-label"></span>
                                    </label>
                                    <input id="noActifUser" type="hidden" value="0" name="reunion[actif_reunion]">
                                </td>
                                <td><?= $reunion['id_utilisateur'] ?></td>
                                <td>
                                    <form action="/admin/parametre-reunion/delete.php" method="post" onsubmit="return confirm('Voulez-vous vraiment supprimer cette réunion ?')">
                                        <input type="hidden" name="id_reunion" value="<?= $reunion['id_reunion'] ?>">
                                        <input type="submit" value="Supprimer">
                                    </form>
                                </td>
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