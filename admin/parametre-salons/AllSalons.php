<?php
require $_SERVER['DOCUMENT_ROOT'] . "/includes/inc-top-admin.php";
require $_SERVER['DOCUMENT_ROOT'] . '/managers/salons-managers.php';



if (!empty($_POST['isActive'])) {
    $isActive = isset($_POST['actif_salon']) ? 1 : 0;

    $sql = "UPDATE salon 
            SET actif_salon = :actif_salon 
            WHERE id_salon = :id_salon";
    $query = $pdo->prepare($sql);
    $active = $query->execute([
        'actif_salon' => $isActive,
        'id_salon' => $_POST['id_salon']
    ]);
}

$salons = getAllSalon($_GET['id']);
?>


<nav class="nav-chaine">
    <div>
        <a href="/admin/parametre-utilisateurs/index.php"><button class="button-chaines police"><i class="fa-solid fa-user" style="color: #ffffff ;"></i>Utilisateurs</button></a>
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
    <div class="container">
        <div class="buttonAjout">
            <a href="/admin/parametre-admin.php"><button class="button-creation police"><i class="fa-solid fa-arrow-left" style="color: #ffffff;"></i>Retour</button></a>
            <a href="/admin/parametre-salons/new.php?id=<?= $_GET['id'] ?>"><button class="button-creation police"><i class="fa-solid fa-circle-plus" style="color: #ffffff;"></i>Salon
                </button></a>
        </div>
        <div class="container-table desigend-scrollbar">

            <table class="">
                <thead class="">
                    <tr class="">
                        <th class="">Id</th>
                        <th class="">Date</th>
                        <th class="">Nom des salons</th>
                        <th class="">Actif/Désactif</th>
                        <th>Modifier les informations du salon</th>

                    </tr>
                </thead>
                <tbody class="">
                    <?php foreach ($salons as $salon) : ?>
                        <tr>
                            <td class=""><?= $salon['id_salon'] ?></td>
                            <td class=""><?= $salon['date_creation_salon'] ?></td>
                            <td class=""><?= $salon['nom_salon'] ?></td>
                            <td class=""><a href="/admin/parametre-salons/edit.php?id=<?= $salon['id_salon'] ?>">Modifier </a></td>

                            <td>
                                <form action="/admin/parametre-salons/index.php" method="post">
                                    <label class="toggle">
                                        <input type="hidden" name="id_salon" value="<?= $salon['id_salon'] ?>">
                                        <input class="toggle-checkbox" type="checkbox" <?= $salon['actif_salon'] == 1 ? 'checked' : '' ?> name="actif_salon">

                                        <div class="toggle-switch"></div>
                                        <span class="toggle-label"></span>
                                    </label>

                            </td>
                            <td> <input class="button-lien" type="submit" name="isActive" value="valider">
                            </td>
                            </form>
                        </tr>
                    <?php endforeach; ?>
                </tbody>

            </table>
        </div>
    </div>
</main>

<?php require $_SERVER['DOCUMENT_ROOT'] . "/includes/inc-bottom.php"; ?>