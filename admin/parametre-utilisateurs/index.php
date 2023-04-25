<?php

include '../../includes/inc-db-connect.php';
require $_SERVER['DOCUMENT_ROOT'] . "/managers/utilisateur-manager.php";
require $_SERVER['DOCUMENT_ROOT'] . "/includes/inc-top-admin.php";

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

            <div>
                <h1>Liste des Utilisateurs</h1>
                <div class="">
                    <span>Ajouter un utilisateur</span>
                    <a href="/admin/parametre-utilisateurs/new.php">
                        Nouvelle utilisateur
                    </a>

                </div>
                <main>
                    <div>
                        <table>
                            <thead>
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
                                        <td><a href="/admin/parametre-utilisateurs/edit.php?id=<?= $utilisateur['id_utilisateur'] ?>">Modifier</a></td>
                                        <td> <label class="toggle">
                                                <input id="actifUser" class="toggle-checkbox" type="checkbox" value="<?= $utilisateur['actif_utilisateur'] ?>" name="utilisateur[actif_utilisateur]">
                                                <div class="toggle-switch"></div>
                                                <span class="toggle-label"></span>
                                            </label>
                                            <input id="noActifUser" type="hidden" value="0" name="utilisateur[actif_utilisateur]">
                                        </td>
                                        <td>
                                            <form action="/admin/parametre-utilisateurs/delete.php" method="post" onsubmit="return confirm('Voulez-vous vraiment supprimer ctte utilisateur ?')">
                                                <input type="hidden" name="id_utilisateur" value="<?= $utilisateur['id_utilisateur'] ?>">
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
            <script src="/assets/script/utilisateur-script.js"></script>
</body>

</html>