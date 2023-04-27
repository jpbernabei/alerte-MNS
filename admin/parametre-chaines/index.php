
<?php require $_SERVER['DOCUMENT_ROOT'] . "/includes/inc-top-admin.php"; ?>


<nav class="nav-chaine">
            <div>
            <a href="/admin/parametre-utilisateurs/index.php"><button class="button-chaines police"><i class="fa-solid fa-user" style="color: #ffffff ;" ></i>Utilisateurs</button></a>
            </div>
            <div>
                <button class="button-chaines police"><i class="fa-solid fa-fire" style="color: #ffffff;"></i>Chaînes</button>
            </div>
            <div>
                <button class="button-chaines police"><i class="fa-solid fa-sitemap" style="color: #ffffff;"></i>Salons</button>
            </div>
            <div>
                <button class="button-chaines police"><i class="fa-solid fa-users " style="color: #ffffff;"></i>Réunions</button>
            </div>

            <div class="button-creation-container">

                <a href="../index.php"><button class="button-creation police"><i class="fa-solid fa-arrow-rotate-left"></i>Accueil</button></a>


            </div>
        </nav>
<main>

            <div class="button-parametre-admin-container">
                <?php
                require $_SERVER['DOCUMENT_ROOT'] . '/managers/chaine-manager.php';
                $chaines = getAllChaine();
                ?>

                <table class="tablechaine">
                    <thead class="theadchaine">
                        <tr class="trchaine">
                            <th class="thchaine">Id</th>
                            <th class="thchaine">Date</th>
                            <th class="thchaine">Nom chaîne</th>
                            <th class="thchaine">Actif/Désactif</th>
                            <th class="thchaine">Modifier les informations de la chaîne</th>
                            <th class="thchaine">Ajouter un utilisateur</th>
                            <th class="thchaine">retirer des utilisateurs de la chaîne</th>
                        </tr>
                    </thead>
                    <tbody class="tbodychaine">
                        <?php foreach ($chaines as $chaine) : ?>
                            <tr>
                                <td class="tdchaine"><?= $chaine['id_chaine'] ?></td>
                                <td class="tdchaine"><?= $chaine['date_creation_chaine'] ?></td>
                                <td class="tdchaine"><?= $chaine['nom_chaine'] ?></td>
                                <td class="tdchaine"><?= $chaine['actif_chaine'] ?></td>
                                <td class="tdchaine"><a href="/admin/parametre-chaines/edit.php?id=<?= $chaine['id_chaine'] ?>">Modifier </a></td>
                                <td class="tdchaine"><a href="/admin/parametre-chaines/addUser.php?id=<?= $chaine['id_chaine'] ?>">Ajouter des utilisateurs</a></td>
                                <td class="tdchaine"><a href="/admin/parametre-chaines/delete.php?id=<?= $chaine['id_chaine'] ?>">Retirer les utilisateurs de <?= $chaine['nom_chaine'] ?> </a></td>

                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot class="tfootchaine">
                        <tr class="trfoot">
                            <td class="tdfoot"><a class="afoot" href="/admin/parametre-chaines/new.php">Créer une chaîne</a></td>
                    </tr>
                    </tfoot>
                </table>
            </div>
</body>
</html>