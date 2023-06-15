<?php

require $_SERVER['DOCUMENT_ROOT'] . "/managers/chaine-manager.php";
require $_SERVER['DOCUMENT_ROOT'] . "/managers/reunion-manager.php";
require $_SERVER['DOCUMENT_ROOT'] . "/includes/inc-top.php";

$reunions = getReunionByIdUser($_SESSION['user']['id']);

?>

<nav class="nav-chaine">
            <div>
                <button class="button-chaines police">Messagerie</button>
            </div>
            <div>
                <button class="button-chaines police">MNS-Infos</button>
            </div>
               

                <div class="button-creation-container">
                <button class="button-creation police"><i class="fa-solid fa-circle-plus" style="color: #ffffff;"></i>Créer une réunion</button>
                <button class="button-creation police"><i class="fa-solid fa-circle-plus" style="color: #ffffff;"></i>Créer une chaine</button>

               
            </div>

        </nav>
        <nav class="nav-salon" id="mesSalons">
 
        </nav>

        <main>
        <div class="containerAffichageReunion">
            <h1>Réunions prévues:</h1>
            <div class="container-table desigend-scrollbar ">
            <?php foreach ($reunions as $reunion): ?>
                <h2 class="contenuReunion">Nom:</h2>
                <p ><?=$reunion['nom_reunion'] ?></p>
                <h2 class="contenuReunion">Sujet:</h2>
                <p ><?=$reunion['sujet_reunion'] ?></p>
                <h2 class="contenuReunion">Date prévue:</h2>
                <p ><?=$reunion['date_prevu_reunion'] ?></p>
                <h2 class="contenuReunion">Heure prévue:</h2>
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

</body>

</html>