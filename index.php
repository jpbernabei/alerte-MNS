<?php
require $_SERVER['DOCUMENT_ROOT'] . "/managers/chaine-manager.php";
require $_SERVER['DOCUMENT_ROOT'] . "/managers/reunion-manager.php";
require $_SERVER['DOCUMENT_ROOT'] . '/managers/salons-managers.php';
require $_SERVER['DOCUMENT_ROOT'] . '/includes/inc-top.php';

$reunions = getReunionByIdUser($_SESSION['user']['id']);
$chaines = getChaineUtilisateur($_SESSION['user']['id']);
$salons = getAllSalon9();

?>
        <nav class="nav-chaine">
            <!--Créer les salons en FETCH automatiquement-->
            <div class="desigend-scrollbar chaine-index">
               
               <?php foreach ($chaines as $chaine) : ?>

                   <button class="button-new-chaines" id="<?= $chaine['id_chaine'] ?>"><?= $chaine['nom_chaine'] ?></button>

               <?php endforeach; ?>
            <div class="button-creation-container">
                <a href="/user/parametre-reunions/new.php"><button class="button-creation police"><i class="fa-solid fa-circle-plus"
                        style="color: #ffffff;"></i>Créer une réunion</button></a>
                <a href="/user/parametre-chaines/index.php"><button class="button-creation police"><i class="fa-solid fa-circle-plus"
                        style="color: #ffffff;"></i>Créer une chaine</button></a>
            </div>
            </div>
            
        </nav>
        <div class="scroller nav-salon   ">
            <nav class="navSalonMobile" id="mesSalons">
                <!-- Affichage de salon en automatique-->
            </nav>
        </div>
        <main id="messageSalon">
        <!--Afficher les messages de chaque salon en fonction de l'ID du salon automatiquement-->
        <!-- <div id="result-search" class="container-search" (pour l'affichage de la barre de recherche)>

        </div> -->
        </main>

        <div class="side" id="side">

        </div>


</div>
<script src="/assets/script/json-salon.js"></script>
<script src="/assets/script/burgerMenu-script.js"></script>
</body>

</html>