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
                    <td class=""><a href="/admin/parametre-salons/edit.php?id=<?= $salon['id_salon'] ?>">Modifier </a></td>
                    <td class=""><a href="/admin/parametre-salons/delete.php?id=<?= $salon['id_salon'] ?>">Supprimer les utilisateurs de <?= $salon['nom_salon'] ?> </a></td>
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
</main>

<?php require $_SERVER['DOCUMENT_ROOT'] . "/includes/inc-bottom.php"; ?>