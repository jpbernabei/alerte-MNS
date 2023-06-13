<?php require $_SERVER['DOCUMENT_ROOT'] . "/includes/inc-top.php";
require $_SERVER['DOCUMENT_ROOT'] . '/managers/salons-managers.php';
require $_SERVER['DOCUMENT_ROOT'] . '/managers/chaine-manager.php';

$chaines = getAllChaine();
?>



<nav class="nav-chaine">
            <div>
                <button class="button-chaines police">Messagerie</button>
            </div>
            <div >
                <button class="button-chaines police">MNS-Infos</button>
            </div>
            <div class="button-creation-container">
                <a href="/user/parametre-reunions/new.php"><button class="button-creation police"><i class="fa-solid fa-circle-plus"
                        style="color: #ffffff;"></i>Créer une réunion</button></a>
                <a href="/user/parametre-chaines/index.php"><button class="button-creation police"><i class="fa-solid fa-circle-plus"
                        style="color: #ffffff;"></i>Créer une chaine</button></a>
                       
            </div>
        </nav>
<main>
    <div class="container">
        <h1>Paramétre des salons</h1>
        <div class="buttonAjout">
            <a href="/user/parametre-salon"><button class="button-creation police"><i class="fa-solid fa-arrow-left" style="color: #ffffff;"></i>Retour</button></a>
        </div>
        <div class="container-table desigend-scrollbar">
            <table class="">
                <thead class="">
                    <tr class="">
                        <th class="">Id</th>
                        <th class="">Date</th>
                        <th class="">Nom des chaînes</th>
                        <th>Paramétre salon</th>
                    </tr>
                </thead>
                <tbody class="">
                    <?php foreach ($chaines as $chaine) : ?>
                        <tr>
                            <td class=""><?= $chaine['id_chaine'] ?></td>
                            <td class=""><?= $chaine['date_creation_chaine'] ?></td>
                            <td class=""><?= $chaine['nom_chaine'] ?></td>
                            <td class=""><a href="/admin/parametre-salons/AllSalons?id=<?= $chaine['id_chaine'] ?>">
                                    Paramétre salon 
                            <td class=""></td></a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
</main>