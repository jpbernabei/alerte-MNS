<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style-parametre-admin.css">
    <script src="https://kit.fontawesome.com/18cbf17047.js" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>
    <div class="container-grid">
        <header>
            <img class="logo" src="/images/LOGO_ALERT_MNS_transparent.ico" alt="">
            <a href=""><i class="fa-solid fa-user fa-xl" style="color: #ffffff;"></i></a>
            <div class="police name-user">Nom utilisateur</div>
            <div><div class="police name-chaine">nom de la chaine </div><div class="police name-salon">nom du salon</div></div>
            <input class="search" type="search">
            <a href=""><i class="fa-solid fa-users fa-xl" style="color: #ffffff;"></i></a>
            <a href="../logout.php"><i class="fa-solid fa-right-from-bracket fa-xl" style="color: #ffffff;"></i></a>
        </header>
        <nav class="nav-chaine">
            <div>
                <button class="button-chaines police">Utilisateurs</button>
            </div>
            <div >
                <button class="button-chaines police">Chaînes</button>
            </div>
            <div >
                <button class="button-chaines police">Salons</button>
            </div>
            <div >
                <button class="button-chaines police">Réunions</button>
            </div>
            
            <div class="button-creation-container">
                <button class="button-creation police"><i class="fa-solid fa-circle-plus"
                        style="color: #ffffff;"></i>Créer une réunion</button>
                <button class="button-creation police"><i class="fa-solid fa-circle-plus"
                        style="color: #ffffff;"></i>Créer une chaine</button>
                        <div class="icone-parametre"><a class="icone-parametre" href=""><i class="fa-solid fa-gear fa-lg" style="color: #ffffff;"></i></a>
                
            </div>
        </nav>
        <nav class="nav-salon">
        </nav>
        <main>
            <div class="button-parametre-admin-container">
                <a href="interface-parametre-utilisateur.html"><button class="button-parametre-admin police">Utilisateurs</button></a>
                <button class="button-parametre-admin police">Chaînes</button>
                <button class="button-parametre-admin police">Salons</button>
                <button class="button-parametre-admin police">Réunions</button>
            </div>
        </main>
        <div class="side">

        </div>
    </div>
</body>
</html>