<?php

require $_SERVER['DOCUMENT_ROOT'].'/includes/inc-top.php'; 

?>
        <nav class="nav-chaine">
            <!--Créer les salons en FETCH automatiquement-->
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
        <nav class="nav-salon">
            <!--Afficher les messages toutes les chaines automatiquement-->
        </nav>
        <main>
        <!--Afficher les messages de chaque salon en fonction de l'ID du salon automatiquement-->
        <div id="result-search" class="container-search">
        </div>

        </main>
        <div class="side">

        </div>
    </div>
    
    
</body>
</html>