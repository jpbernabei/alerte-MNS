<?php require $_SERVER['DOCUMENT_ROOT'] . "/includes/inc-top.php"; ?>


            <div class="button-parametre-admin-container">

                <!-- Il faut faire le modal ici -->
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
                            <!-- <th>Les utilisateurs dans la chaîne</th> -->
                            <th class="thchaine">Actif/Désactif</th>
                            <th class="thchaine">Modifier les informations de la chaîne</th>
                            <th class="thchaine">Ajouter un utilisateur</th>
                            <th class="thchaine">Supprimer un utilisateur de la chaîne</th>
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
                                <td class="tdchaine"><a href="/admin/parametre-chaines/delete.php?id=<?= $chaine['id_chaine'] ?>">Supprimer les utilisateurs de <?= $chaine['nom_chaine'] ?> </a></td>

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

<?php require $_SERVER['DOCUMENT_ROOT'] . "/includes/inc-bottom.php"; ?>