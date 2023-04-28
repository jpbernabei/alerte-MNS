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
    require $_SERVER['DOCUMENT_ROOT'] . '/managers/salons-managers.php';
    require $_SERVER['DOCUMENT_ROOT'] . '/managers/chaine-manager.php';
    
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

</main>