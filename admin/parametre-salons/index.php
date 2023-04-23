<?php require $_SERVER['DOCUMENT_ROOT'] . "/includes/inc-top.php"; ?>


<div class="button-parametre-admin-container">
    <?php
    require $_SERVER['DOCUMENT_ROOT'] . '/managers/salons-managers.php';
    
    $salons = getAllSalon();
    ?>

    <table class="">
        <thead class="">
            <tr class="">
                <th class="">Id</th>
                <th class="">Date</th>
                <th class="">Nom des salons</th>
                <th class="">Actif/Désactif</th>
             

            </tr>
        </thead>
        <tbody class="">
            <?php foreach ($salons as $salon) : ?>
                <tr>
                    <td class=""><?= $salon['id_salon'] ?></td>
                    <td class=""><?= $salon['date_creation_salon'] ?></td>
                    <td class=""><?= $salon['nom_salon'] ?></td>
                    <td class=""><?= $salon['actif_salon'] ?></td>
                    <td class=""><a href="/admin/parametre-chaines/edit.php?id=<?= $chaine['id_chaine'] ?>">Modifier un salon</a></td>

                </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot class="">
            <tr class="">
                <td class=""><a class="afoot" href="/admin/parametre-chaines/new.php">Créer des salons</a></td>
            </tr>
        </tfoot>
    </table>

</div>

<?php require $_SERVER['DOCUMENT_ROOT'] . "/includes/inc-bottom.php"; ?>