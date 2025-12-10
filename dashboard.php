<?php
session_start();

include "connect.php";
include "delete.php";
include "edit.php";

$userlogin = $_SESSION["username"];
$user_id = $_SESSION["id_user"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if ($_POST["form"] == "cours") {

        $name_cours = $_POST["name_cours"];
        $categorie_cours = $_POST["categorie_cours"];
        $date_cours = $_POST["date_cours"];
        $houre_cours = $_POST["houre_cours"];
        $duree_cours = $_POST["duree_cours"];
        $max_places = $_POST["max_places"];

        //part put values in input for edit

        if (isset($_GET['edit_id'])) {

            $editid = $_GET['edit_id'];

            $sql = "UPDATE cours SET nom='$name_cours', categorie='$categorie_cours', date_cours='$date_cours', heure='$houre_cours', duree='$duree_cours', nombre_max_de_participants='$max_places' WHERE id_cours=$editid AND id_user = '$user_id'";

            if (mysqli_query($conn, $sql)) {
                header("Location: dashboard.php?updated=1");
                exit();
            } else {
                echo 'Error: ' . mysqli_error($conn);
            }
        } else {
            $sql = "INSERT INTO cours (nom, categorie, date_cours, heure, duree, nombre_max_de_participants, id_user) VALUES ('$name_cours', '$categorie_cours', '$date_cours', '$houre_cours', '$duree_cours', '$max_places', '$user_id')";

            if (mysqli_query($conn, $sql)) {
                header("Location: dashboard.php");
                exit();
            } else {
                echo "Error:" . mysqli_error($conn);
            }
        }
    }


    if ($_POST["form"] == "equipement") {

        $nom_equipement = $_POST["nom_equipement"];
        $type_equipement = $_POST["type_equipement"];
        $quantite_equipement = $_POST["quantite_equipement"];
        $etat_equipement = $_POST["etat_equipement"];

        if (isset($_GET["edit_id"])) {
            $editeq = $_GET["edit_id"];

            $sqledit = "UPDATE equipement SET nom='$nom_equipement' ,type='$type_equipement',quantite_disponible='$quantite_equipement' ,etat='$etat_equipement' WHERE id_equipement=$editeq AND id_user ='$user_id'";

            if (mysqli_query($conn, $sqledit)) {
                header("Location:dashboard.php");
                exit();
            } else {
                echo "ERROR:" . mysqli_error($conn);
            }
        } else {
            $sql_eq = "INSERT INTO equipement (nom, type, quantite_disponible, etat, id_user) VALUES ('$nom_equipement', '$type_equipement', '$quantite_equipement', '$etat_equipement', '$user_id')";

            if (mysqli_query($conn, $sql_eq)) {
                header("Location: dashboard.php");
                exit();
            } else {
                echo "Error:" . mysqli_error($conn);
            }
        }
    }
}

$sql2 = "SELECT * FROM cours WHERE id_user = '$user_id'";
$result = mysqli_query($conn, $sql2);
$data = mysqli_fetch_all($result, MYSQLI_ASSOC);

$sql3 = "SELECT * FROM equipement";
$resutlt3 = mysqli_query($conn, $sql3);
$data3 = mysqli_fetch_all($resutlt3, MYSQLI_ASSOC);

//part count type cours
$totalYoga = "SELECT * FROM cours WHERE categorie = 'Yoga' AND id_user = '$user_id'";
$resultotal = mysqli_query($conn, $totalYoga);
$datayoga = mysqli_fetch_all($resultotal);

$totalMusculation = "SELECT * FROM cours WHERE categorie = 'Musculation' AND id_user = '$user_id'";
$resultotalmus = mysqli_query($conn, $totalMusculation);
$datamusculation = mysqli_fetch_all($resultotalmus);

$totalMusculation = "SELECT * FROM cours WHERE categorie = 'Cardio' AND id_user = '$user_id'";
$resultotalcardio = mysqli_query($conn, $totalMusculation);
$datacardio = mysqli_fetch_all($resultotalcardio);

//count type equipement
$totalHalteres = "SELECT * FROM equipement WHERE type = 'Haltères' AND id_user = '$user_id'";
$resulthalt = mysqli_query($conn, $totalHalteres);
$datahalteres = mysqli_fetch_all($resulthalt);

$totaltapis = "SELECT * FROM equipement WHERE type = 'Tapis de course' AND id_user = '$user_id'";
$resulttapis = mysqli_query($conn, $totaltapis);
$datatapis = mysqli_fetch_all($resulttapis);

$totalballon = "SELECT * FROM equipement WHERE type = 'Ballons' AND id_user = '$user_id'";
$resultballon = mysqli_query($conn, $totalballon);
$databallon = mysqli_fetch_all($resultballon);

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Dashboard Salle de Sport</title>
    <link rel="icon" type="image/jpeg" href="/images/Solvd Inc_ · Walnut Creek, California.jpeg" />
    <link rel="stylesheet" href="/styles/style.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

<body>
    <div class="profile-logout">
                <a href="login.php" class="btn-logout" title="Déconnexion">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                        <polyline points="16 17 21 12 16 7"></polyline>
                        <line x1="21" y1="12" x2="9" y2="12"></line>
                    </svg>
                </a>
            </div>
    <div class="welcome-banner option-a">
        <h2>Bienvenue, <span class="userlogin"><?=$userlogin?></span></h2>
        <p class="greeting-message">Gérez l'énergie, les cours et l'équipement de votre salle de sport.</p>
        <div class="action-prompt">Prêt à commencer ?</div>
    </div>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <div class="header-buttons">
                <a href="" class="btn-dashboard">Dashboard</a>
                <a href="" class="btn-ajouter-cours">Ajouter un cours</a>
                <a href="" class="btn-ajouter-equipement">Ajouter un équipement</a>
            </div>
            <h1 class="text-dashboard">Dashboard Salle de Sport</h1>
        </div>


        <!-- Stats Grid -->
        <div class="stats-grid">
            <div class="stat-card">
                <h3>Total Cours</h3>
                <div class="stat-number"><?= count($data); ?></div>
            </div>
            <div class="stat-card">
                <h3>Total Équipements</h3>
                <div class="stat-number"><?= count($data3); ?></div>
            </div>
        </div>
        <div id="part-type-cours">
            <div class="stats-grid">
                <div class="stat-card">
                    <h1 class="title">Cours Par Type</h1>
                    <div class="types-container">
                        <div class="type-box yoga">
                            <h3 style="color: #1a1f2e">Yoga</h3>
                            <div class="stat-number"><?= count($datayoga) ?></div>
                        </div>
                        <div class="type-box musculation">
                            <h3 style="color: #1a1f2e">Musculation</h3>
                            <div class="stat-number"><?= count($datamusculation) ?></div>
                        </div>
                        <div class="type-box cardio">
                            <h3 style="color: #1a1f2e">Cardio</h3>
                            <div class="stat-number" style="color: #1a1f2e;"><?= count($datacardio) ?></div>
                        </div>
                    </div>
                </div>

                <div class="stat-card">
                    <h1 class="title">Equipement Par Type</h1>
                    <div class="types-container">
                        <div class="type-box yoga">
                            <h3 style="color: #1a1f2e">Haltères</h3>
                            <div class="stat-number"><?= count($datahalteres) ?></div>
                        </div>
                        <div class="type-box musculation">
                            <h3 style="color: #1a1f2e">Tapis</h3>
                            <div class="stat-number"><?= count($datatapis) ?></div>
                        </div>
                        <div class="type-box cardio">
                            <h3 style="color: #1a1f2e">Ballons</h3>
                            <div class="stat-number"><?= count($databallon) ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Add Course Form -->
        <div class="card part-cours" style="display: none;" id="section-cours">
            <h3>Ajouter un cours</h3>
            <form action="" method="POST">
                <input type="hidden" name="form" value="cours">
                <input type="text" name="name_cours" placeholder="Nom du cours" value="<?= $name_cours ?>" required>
                <select name="categorie_cours" required>
                    <option value="">--Catégorie--</option>
                    <option <?= ($catg_cours == "Yoga") ? 'selected' : '' ?>>Yoga</option>
                    <option <?= ($catg_cours == "Musculation") ? 'selected' : '' ?>>Musculation</option>
                    <option <?= ($catg_cours == "Cardio") ? 'selected' : '' ?>>Cardio</option>
                </select>
                <div class="two-grid">
                    <input type="date" name="date_cours" value="<?= $date_cours ?>" required>
                    <input type="time" name="houre_cours" value="<?= $heure_cours ?>" required>
                </div>
                <div class="two-grid">
                    <input type="number" name="duree_cours" placeholder="Durée" value="<?= $duree ?>" required>
                    <input type="number" name="max_places" placeholder="Places max" value="<?= $nb_max ?>" required>
                </div>
                <button>Ajouter</button>
            </form>
        </div>

        <!-- Add Equipment Form -->
        <div class="card part-equipement" style="display: none">
            <h3>Ajouter un équipement</h3>
            <form action="" method="POST" id="formequipement">
                <input type="hidden" name="form" value="equipement">
                <input type="text" name="nom_equipement" placeholder="Nom de l'équipement" value="<?= $name_equipementd ?>" required>
                <select type="text" name="type_equipement" required>
                    <option value="">--Type--</option>
                    <option <?= ($type_equipementd == "Haltères") ? 'selected' : '' ?>>Haltères</option>
                    <option <?= ($type_equipementd == "Tapis de course") ? 'selected' : '' ?>>Tapis de course</option>
                    <option <?= ($type_equipementd == "Ballons") ? 'selected' : '' ?>>Ballons</option>
                </select>
                <div class="two-grid">
                    <input type="number" name="quantite_equipement" placeholder="Quantité" value="<?= $quantite_equipementd ?>" required>
                    <select name="etat_equipement" required>
                        <option value="">--État--</option>
                        <option <?= ($etat_equipementd == "Bon") ? 'selected' : '' ?>>Bon</option>
                        <option <?= ($etat_equipementd == "Moyen") ? 'selected' : '' ?>>Moyen</option>
                        <option <?= ($etat_equipementd == "À remplacer") ? 'selected' : '' ?>>À remplacer</option>
                    </select>
                </div>
                <button>Ajouter</button>
            </form>
        </div>

        <!-- Courses Table -->
        <div class="card list-cours" style="display: none;" id="list-cours">
            <h3>Liste des cours</h3>
            <div class="table-container">
                <table class="table-cours">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Catégorie</th>
                            <th>Date</th>
                            <th>Heure</th>
                            <th>Durée</th>
                            <th>Places</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($data as $row) {
                            echo "<tr>
                            <td data-label='Nom'>" . $row["nom"] . "</td>
                            <td data-label='Catégorie'>" . $row["categorie"] . "</td>
                            <td data-label='Date'>" . $row["date_cours"] . "</td>
                            <td data-label='Heure'>" . $row["heure"] . "</td>
                            <td data-label='Durée'>" . $row["duree"] . "</td>
                            <td data-label='Places'>" . $row["nombre_max_de_participants"] . "</td>
                            <td data-label='Actions'>
                                <div class='action-buttons'>
                                    <a href='?edit_id={$row['id_cours']}' id='btn-mdf' onclick='checkedit(event)'>Modifier</a>
                                    <a href='?del_id={$row['id_cours']}' id='btn-delet' onclick='checkdelet(event)'>Supprimer</a>
                                </div>
                            </td>
                        </tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Equipment Table -->
        <div class="card list-equipement" style="display: none;">
            <h3>Liste des équipements</h3>
            <div class="table-container">
                <table class="table-cours">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Type</th>
                            <th>Quantité Disponible</th>
                            <th>État</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($data3 as $row) {
                            echo "<tr>
                            <td data-label='Nom'>" . $row["nom"] . "</td>
                            <td data-label='Type'>" . $row["type"] . "</td>
                            <td data-label='Quantité Disponible'>" . $row["quantite_disponible"] . "</td>
                            <td data-label='État'>" . $row["etat"] . "</td>
                            <td data-label='Action'>
                                <div class='action-buttons'>
                                    <a href='dashboard.php?edit_id={$row['id_equipement']}' id='btn-mdf'>Modifier</a>
                                    <a href='dashboard.php?deleq_id={$row['id_equipement']}' id='btn-delet' onclick='checkdelet(event)'>Supprimer</a>
                                </div>
                            </td>
                        </tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="allscript.js"></script>
</body>

</html>