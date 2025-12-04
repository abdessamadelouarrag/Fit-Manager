<?php
include "connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if ($_POST["form"] == "cours") {

        $name_cours = $_POST["name_cours"];
        $categorie_cours = $_POST["categorie_cours"];
        $date_cours = $_POST["date_cours"];
        $houre_cours = $_POST["houre_cours"];
        $duree_cours = $_POST["duree_cours"];
        $max_places = $_POST["max_places"];


        $sql = "INSERT INTO cours (nom, categorie, date_cours, heure, duree, nombre_max_de_participants) VALUES ('$name_cours', '$categorie_cours', '$date_cours', '$houre_cours', '$duree_cours', '$max_places')";

        if (mysqli_query($conn, $sql)) {
            header("Location: index.php");
            exit();
        } else {
            echo "Error:" . mysqli_error($conn);
        }
    }


    if ($_POST["form"] == "equipement") {

        $nom_equipement = $_POST["nom_equipement"];
        $type_equipement = $_POST["type_equipement"];
        $quantite_equipement = $_POST["quantite_equipement"];
        $etat_equipement = $_POST["etat_equipement"];

        $sql_eq = "INSERT INTO equipement (nom, type, quantite_disponible, etat) VALUES ('$nom_equipement', '$type_equipement', '$quantite_equipement', '$etat_equipement')";

        if (mysqli_query($conn, $sql_eq)) {
            header("Location: index.php");
            exit();
        } else {
            echo "Error:" . mysqli_error($conn);
        }
    }
}

$sql2 = "SELECT * FROM cours";
$result = mysqli_query($conn, $sql2);
$data = mysqli_fetch_all($result, MYSQLI_ASSOC);

$sql3 = "SELECT * FROM equipement";
$resutlt3 = mysqli_query($conn, $sql3);
$data3 = mysqli_fetch_all($resutlt3, MYSQLI_ASSOC);

//patie delet cours f table
if (isset($_GET['del_id'])) {
    $delet_cours = intval($_GET['del_id']);
    $sqldelet = "DELETE FROM cours WHERE id_cours = $delet_cours";

    if (mysqli_query($conn, $sqldelet)) {
        header("Location: index.php?succes=1");
        exit();
    } else {
        echo "Error:" . mysqli_error($conn);
    }
}
//partie delet equipement in table
if (isset($_GET['deleq_id'])) {
    $delet_equipement = intval($_GET['deleq_id']);
    $sqldelet_equipement = "DELETE FROM equipement WHERE id_equipement= $delet_equipement";

    if (mysqli_query($conn, $sqldelet_equipement)) {
        header("Location: index.php?succes=1");
        exit();
    } else {
        echo "Error:" . mysqli_error($conn);
    }
}
?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Dashboard Salle de Sport</title>
    <link rel="icon" type="image/jpeg" href="/images/gym.jpeg" />
    <link rel="stylesheet" href="/styles/style.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

<body>

    <div class="welcome-banner option-a">
        <h2>Bienvenue, Administrateur !</h2>
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
            <div class="stat-card">
                <h3>Capacité Totale</h3>
                <div class="stat-number">0</div>
            </div>
        </div>

        <!-- Add Course Form -->
        <div class="card part-cours" style="display: none;">
            <h3>Ajouter un cours</h3>
            <form action="" method="POST">
                <input type="hidden" name="form" value="cours">
                <input type="text" name="name_cours" placeholder="Nom du cours" required>
                <select name="categorie_cours" required>
                    <option value="">--Catégorie--</option>
                    <option>Yoga</option>
                    <option>Musculation</option>
                    <option>Cardio</option>
                </select>
                <div class="two-grid">
                    <input type="date" name="date_cours" required>
                    <input type="time" name="houre_cours" required>
                </div>
                <div class="two-grid">
                    <input type="number" name="duree_cours" placeholder="Durée" required>
                    <input type="number" name="max_places" placeholder="Places max" required>
                </div>
                <button>Ajouter</button>
            </form>
        </div>

        <!-- Add Equipment Form -->
        <div class="card part-equipement" style="display: none">
            <h3>Ajouter un équipement</h3>
            <form action="" method="POST">
                <input type="hidden" name="form" value="equipement">
                <input type="text" name="nom_equipement" placeholder="Nom de l'équipement" required>
                <input type="text" name="type_equipement" placeholder="Type (ex : Haltères)" required>
                <div class="two-grid">
                    <input type="number" name="quantite_equipement" placeholder="Quantité" required>
                    <select name="etat_equipement" required>
                        <option value="">--État--</option>
                        <option>Bon</option>
                        <option>Moyen</option>
                        <option>À remplacer</option>
                    </select>
                </div>
                <button>Ajouter</button>
            </form>
        </div>

        <!-- Courses Table -->
        <div class="card list-cours" style="display: none;">
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
                                    <a href='#' id='btn-mdf' onclick= 'return checkedit()'>Modifier</a>
                                    <a href='index.php?del_id={$row['id_cours']}' id='btn-delet' onclick='checkdelet(event)'>Supprimer</a>
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
                                    <a href='#' id='btn-mdf'>Modifier</a>
                                    <a href='index.php?deleq_id={$row['id_equipement']}' id='btn-delet' onclick='checkdelet(event)'>Supprimer</a>
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