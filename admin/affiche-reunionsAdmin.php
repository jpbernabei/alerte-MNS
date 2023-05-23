<?php

require $_SERVER['DOCUMENT_ROOT'] . "/managers/chaine-manager.php";
require $_SERVER['DOCUMENT_ROOT'] . "/managers/reunion-manager.php";
require $_SERVER['DOCUMENT_ROOT'] . "/includes/inc-top-admin.php";

$reunions = getReunionByIdUser($_SESSION['user']['id']);
$chaines = getAllChaine();
?>

<nav class="nav-chaine">
            <div>
                <button class="button-chaines police">Messagerie</button>
            </div>
                <button class="button-chaines police">MNS-Infos</button>
            <div class="desigend-scrollbar">
               
                <?php foreach ($chaines as $chaine) : ?>

                    <button class="button-new-chaines" id="<?= $chaine['id_chaine'] ?>"><?= $chaine['nom_chaine'] ?></button>

                <?php endforeach; ?>

                <div class="button-creation-container">
                <button class="button-creation police"><i class="fa-solid fa-circle-plus" style="color: #ffffff;"></i>Créer une réunion</button>
                <button class="button-creation police"><i class="fa-solid fa-circle-plus" style="color: #ffffff;"></i>Créer une chaine</button>
                <div class="icone-parametre"><a class="icone-parametre" href="/admin/parametre-admin.php"><i class="fa-solid fa-gear fa-lg" style="color: #ffffff;"></i></a>

                </div>
            </div>

        </nav>
        

        <main>
        <div class="containerAffichageReunion">
            <h1>Réunions de prévu:</h1>
            <div class="container-table desigend-scrollbar ">
            <?php foreach ($reunions as $reunion): ?>
                <h2 class="contenuReunion">Nom:</h2>
                <p ><?=$reunion['nom_reunion'] ?></p>
                <h2 class="contenuReunion">Sujet:</h2>
                <p ><?=$reunion['sujet_reunion'] ?></p>
                <h2 class="contenuReunion">Date prévu:</h2>
                <p ><?=$reunion['date_prevu_reunion'] ?></p>
                <h2 class="contenuReunion">Heure prévu:</h2>
                <p ><?=$reunion['heure_prevu_reunion'] ?></p>
                <br>
                <hr>
                <br>
                <?php endforeach; ?>
            </div>
        </div>
        </main>
        <div class="side">

        </div>
    </div>
<script src="/assets/script/json-salon.js"></script>
</body>

</html>