<?php require $_SERVER['DOCUMENT_ROOT'] . "/includes/inc-top.php"; ?>

<div class="button-parametre-admin-container">
    <?php require $_SERVER['DOCUMENT_ROOT'] . '/managers/salons-managers.php';

    $salons = getAllSalon($_GET['id']);

    ?>
    <table class="">
        <thead class="">
            <tr class="">
                <th class="">Id</th>
                <th class="">Date</th>
                <th class="">Nom des salons</th>
                <th class="">Actif/Désactif</th>
                <th>Modifier les informations du salon</th>
                <th>Supprimer les utilisateurs de ce salon</th>
            </tr>
        </thead>
        <tbody class="">
            <?php foreach ($salons as $salon) : ?>
                <tr>
                    <td class=""><?= $salon['id_salon'] ?></td>
                    <td class=""><?= $salon['date_creation_salon'] ?></td>
                    <td class=""><?= $salon['nom_salon'] ?></td>
                    <td class=""><?= $salon['actif_salon'] ?></td>
                    <td class=""><a href="/admin/parametre-salon/edit.php?id=<?= $salon['id_salon'] ?>">Modifier </a></td>
                    <td class=""><a href="/admin/parametre-salon/delete.php?id=<?= $salon['id_salon'] ?>">Supprimer les utilisateurs de <?= $salon['nom_salon'] ?> </a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot class="">
            <tr class="">
                <td class=""><a href="/admin/parametre-salons/new.php?id=<?= $_GET['id']?>">Créer des salons</a></td>
            </tr>
        </tfoot>
    </table>

</div>

<?php require $_SERVER['DOCUMENT_ROOT'] . "/includes/inc-bottom.php"; ?>