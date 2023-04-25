<?php require $_SERVER['DOCUMENT_ROOT'] . "/includes/inc-top.php"; ?>


<div class="button-parametre-admin-container">
    <?php
    require $_SERVER['DOCUMENT_ROOT'] . '/managers/salons-managers.php';
    
    $chaines = getAllChaine();
    ?>

    <table class="">
        <thead class="">
            <tr class="">
                <th class="">Id</th>
                <th class="">Date</th>
                <th class="">Nom des salons</th>
                <th class="">Actif/Désactif</th>
                <th>Voir tous les salons </th>
             

            </tr>
        </thead>
        <tbody class="">
            <?php foreach ($chaines as $chaine) : ?>
                <tr>
                    <td class=""><?= $chaine['id_chaine'] ?></td>
                    <td class=""><?= $chaine['date_creation_chaine'] ?></td>
                    <td class=""><?= $chaine['nom_chaine'] ?></td>
                    <td class=""><?= $chaine['actif_chaine'] ?></td>
                    <td class=""><a href="/admin/parametre-salons/AllSalons?id=<?= $chaine['id_chaine'] ?>">
                    Voir tous les salons de<td class=""><?= $chaine['nom_chaine'] ?></td></a></td>

                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</div>

<?php require $_SERVER['DOCUMENT_ROOT'] . "/includes/inc-bottom.php"; ?>