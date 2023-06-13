<?php 
require $_SERVER['DOCUMENT_ROOT'] . "/includes/inc-top-admin.php"; 
require $_SERVER['DOCUMENT_ROOT'] . '/managers/chaine-manager.php';

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


$chaines = getAllChaine();

?>


<nav class="nav-chaine">
    <div>
        <a href="/admin/parametre-utilisateurs/index.php"><button class="button-chaines police"><i class="fa-solid fa-user" style="color: #ffffff ;"></i>Utilisateurs</button></a>
    </div>
    <div>
        <a href="/admin/parametre-chaines/index.php"><button class="button-chaines police"><i class="fa-solid fa-fire" style="color: #ffffff;"></i>Chaînes</button></a>
    </div>
    <div>
        <a href="/admin/parametre-salons/index.php"><button class="button-chaines police"><i class="fa-solid fa-sitemap" style="color: #ffffff;"></i>Salons</button></a>
    </div>
    <div>
        <a href="/admin/parametre-reunions/index.php"><button class="button-chaines police"><i class="fa-solid fa-users " style="color: #ffffff;"></i>Réunions</button></a>
    </div>

    <div class="button-creation-container">

        <a href="../index.php"><button class="button-creation police"><i class="fa-solid fa-arrow-rotate-left"></i>Accueil</button></a>


    </div>
</nav>
<main>
    <div class="container">
        <h1>Paramétre des chaînes</h1>
        <div class="buttonAjout">
            <a href="/admin/parametre-admin.php"><button class="button-creation police"><i class="fa-solid fa-arrow-left" style="color: #ffffff;"></i>Retour</button></a>
            <a href="/admin/parametre-chaines/new.php"><button class="button-creation police"><i class="fa-solid fa-circle-plus" style="color: #ffffff;"></i>Chaîne
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
                        <th class="thchaine">Activer/Désactiver</th>
                    </tr>
                </thead>
                <tbody class="tbodychaine">
                    <?php foreach ($chaines as $chaine) : ?>
                        <tr>
                            <td class="tdchaine"><?= $chaine['id_chaine'] ?></td>
                            <td class="tdchaine"><?= $chaine['date_creation_chaine'] ?></td>
                            <td class="tdchaine"><?= $chaine['nom_chaine'] ?></td>
                            
                            <td class="tdchaine"><a href="/admin/parametre-chaines/edit.php?id=<?= $chaine['id_chaine'] ?>">Modifier </a></td>
                           
                            <td>
                                            <form action="/admin/parametre-chaines/index.php" method="post">
                                            <label class="toggle">
                                                <input type="hidden" name="id_chaine" value="<?= $chaine['id_chaine'] ?>">
                                                <input class="toggle-checkbox" type="checkbox" <?= $chaine['actif_chaine'] == 1 ? 'checked' : ''?> name="actif_chaine">

                                                <div class="toggle-switch"></div>
                                                <span class="toggle-label"></span>
                                            </label>

                                        </td>
                                        <td>  <input class="button-lien" type="submit" name="isActive" value="valider">
                                    </td>
                                    </form>

                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>
</body>

</html>