<?php 
require $_SERVER['DOCUMENT_ROOT'] . "/includes/inc-top-admin.php";

?>
        <nav class="nav-chaine">
            <div>
                <a href="/admin/parametre-utilisateurs/index.php"><button class="button-chaines police"><i class="fa-solid fa-user" style="color: #ffffff ;" ></i>Utilisateurs</button></a>
            </div>
            <div >
                <a href="/admin/parametre-chaines/index.php"><button class="button-chaines police"><i class="fa-solid fa-fire" style="color: #ffffff;"></i>Chaînes</button></a>
            </div>
            <div >
                <a href="/admin/parametre-salons/index.php"><button class="button-chaines police"><i class="fa-solid fa-sitemap" style="color: #ffffff;"></i>Salons</button></a>
            </div>
            <div >
                <a href="/admin/parametre-reunions/index.php"><button class="button-chaines police"><i class="fa-solid fa-users " style="color: #ffffff;"></i>Réunions</button></a>
            </div>
            
            <div class="button-creation-container">
            
                <a href="./index.php"><button class="button-creation police"><i class="fa-solid fa-arrow-rotate-left"></i>Accueil</button></a>
                        
                
            </div>
        </nav>
        <main>
            <div class="button-parametre-admin-container">
                <a href="/admin/parametre-utilisateurs/index.php"><button class="button-parametre-admin police"><i class="fa-solid fa-user fa-2xl" style="color: #ffffff ;" ></i>Utilisateurs</button></a>
                <a href="/admin/parametre-chaines/index.php"><button class="button-parametre-admin police"><i class="fa-solid fa-fire fa-2xl" style="color: #ffffff;"></i>Chaînes</button></a>
                <a href="/admin/parametre-salons/index.php"><button class="button-parametre-admin police"><i class="fa-solid fa-sitemap fa-2xl" style="color: #ffffff;"></i>Salons</button></a>
                <a href="/admin/parametre-reunions/index.php"><button class="button-parametre-admin police"><i class="fa-solid fa-users fa-2xl " style="color: #ffffff;"></i>Réunions</button></a>
            </div>
        </main>
        
    </div>
</body>
</html>