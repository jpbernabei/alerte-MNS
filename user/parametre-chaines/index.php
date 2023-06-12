<?php

require $_SERVER['DOCUMENT_ROOT'].'/includes/inc-top.php'; 
require $_SERVER['DOCUMENT_ROOT'] . '/managers/chaineUser-manager.php';

if (!empty($_POST['isActive'])) 
{
    $isActive = isset($_POST['actif_chaine']) ? 1 : 0;

    $sql = "UPDATE chaine 
            SET actif_chaine = :actif_chaine 
            WHERE id_chaine = :id_chaine";
    $query = $pdo->prepare($sql);
    $active = $query->execute([
        'actif_chaine' => $isActive,
        'id_chaine' => $_POST['id_chaine']
    ]);
}


$chaines = getChaineUser($_SESSION['user']['id']);

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
        <!-- <nav class="nav-salon">
            Pour afficher les salons 
        </nav> -->
        <main>

        <!-- <div id="result-search" class="container-search">
        </div> -->
       
        
        <div class="buttonAjout">
            <a href="/index.php"><button class="button-creation police"><i class="fa-solid fa-arrow-left" style="color: #ffffff;"></i>Retour</button></a>
            <h1>Paramétre des chaînes</h1>
            <a href="/user/parametre-chaines/new.php"><button class="button-creation police"><i class="fa-solid fa-circle-plus" style="color: #ffffff;"></i>Chaîne
                </button></a>
        </div>

        <div class="container-table desigend-scrollbar">
            <table class="tablechaine">
                <thead class="theadchaine">
                    <tr class="trchaine">
                        <th class="thchaine">Id</th>
                        <th class="thchaine">Date</th>
                        <th class="thchaine">Nom chaîne</th>
                        <th class="thchaine">Modifier</th>
                        <th class="thchaine">Créer des salons</th>
                       
                    </tr>
                </thead>
                <tbody class="tbodychaine">
                    <?php foreach ($chaines as $chaine) : ?>
                        <tr>
                            <td class="tdchaine"><?= $chaine['id_chaine'] ?></td>
                            <td class="tdchaine"><?= $chaine['date_creation_chaine'] ?></td>
                            <td class="tdchaine"><?= $chaine['nom_chaine'] ?></td>
                            
                            <td class="tdchaine"><a href="/user/parametre-chaines/edit.php?id=<?= $chaine['id_chaine'] ?>">Modifier </a></td>
                            <td class="tdchaine"><a href="/user/parametre-salon/index.php">Salon</a></td>
                           
                            <td>
                                    <form action="/user/parametre-chaines/index.php" method="post">
                                        </td>
                                        <!-- <td>  <input class="button-lien" type="submit" name="isActive" value="valider">
                                    </td> -->
                                    </form>

                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
  
        </main>
        <!-- <div class="side">
            Pour afficher les utilisateurs
        </div> -->
    </div>
    
    
</body>
</html>