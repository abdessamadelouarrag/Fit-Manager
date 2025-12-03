<?php
include "connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if($_POST["form"] == "cours"){

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


    if($_POST["form"] == "equipement"){

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
    <link rel="icon" type="image/jpeg" href="/gym.jpeg" />
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

        :root {
            --bg-primary: #0a0e1a;
            --bg-secondary: #111827;
            --bg-card: #1a1f2e;
            --bg-hover: #252b3d;
            --accent-primary: #3b82f6;
            --accent-secondary: #8b5cf6;
            --accent-success: #10b981;
            --accent-danger: #ef4444;
            --accent-warning: #f59e0b;
            --text-primary: #f9fafb;
            --text-secondary: #9ca3af;
            --text-muted: #6b7280;
            --border: #1f2937;
            --shadow: rgba(0, 0, 0, 0.5);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            scrollbar-width: thin;
            scrollbar-color: var(--accent-primary) var(--bg-secondary);
        }

        *::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        *::-webkit-scrollbar-track {
            background: var(--bg-secondary);
        }

        *::-webkit-scrollbar-thumb {
            background: var(--accent-primary);
            border-radius: 4px;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg-primary);
            color: var(--text-primary);
            line-height: 1.6;
            padding: 24px;
            min-height: 100vh;
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
        }

        /* Header */
        .header {
            margin-bottom: 32px;
        }

        .header h1 {
            font-size: 32px;
            font-weight: 700;
            background: linear-gradient(135deg, var(--accent-primary), var(--accent-secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 8px;
        }

        .header p {
            color: var(--text-secondary);
            font-size: 14px;
        }

        /* Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 24px;
            margin-bottom: 32px;
        }

        .stat-card {
            background: linear-gradient(135deg, var(--bg-card) 0%, var(--bg-secondary) 100%);
            padding: 24px;
            border-radius: 16px;
            border: 1px solid var(--border);
            position: relative;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, var(--accent-primary), var(--accent-secondary));
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 24px var(--shadow);
        }

        .stat-card h3 {
            font-size: 14px;
            font-weight: 500;
            color: var(--text-secondary);
            margin-bottom: 12px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .stat-number {
            font-size: 48px;
            font-weight: 700;
            background: linear-gradient(135deg, var(--accent-primary), var(--accent-secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            line-height: 1;
        }

        /* Cards */
        .card {
            background: var(--bg-card);
            border-radius: 16px;
            border: 1px solid var(--border);
            padding: 28px;
            margin-bottom: 24px;
            box-shadow: 0 4px 12px var(--shadow);
        }

        .card h3 {
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .card h3::before {
            content: '';
            width: 4px;
            height: 24px;
            background: linear-gradient(180deg, var(--accent-primary), var(--accent-secondary));
            border-radius: 2px;
        }

        /* Forms */
        form {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        label {
            font-size: 14px;
            font-weight: 500;
            color: var(--text-secondary);
            margin-bottom: -8px;
        }

        input, select {
            padding: 14px 16px;
            border: 1px solid var(--border);
            border-radius: 10px;
            background: var(--bg-secondary);
            color: var(--text-primary);
            font-size: 14px;
            font-family: 'Inter', sans-serif;
            transition: all 0.3s ease;
            outline: none;
        }

        input:focus, select:focus {
            border-color: var(--accent-primary);
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        input::placeholder {
            color: var(--text-muted);
        }

        .two-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        button[type="submit"], button {
            padding: 14px 24px;
            border: none;
            border-radius: 10px;
            background: linear-gradient(135deg, var(--accent-primary), var(--accent-secondary));
            color: white;
            font-weight: 600;
            font-size: 15px;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 8px;
        }

        button:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 16px rgba(59, 130, 246, 0.4);
        }

        button:active {
            transform: translateY(0);
        }

        /* Table */
        .table-container {
            overflow-x: auto;
            border-radius: 12px;
            background: var(--bg-secondary);
        }

        .table-cours {
            width: 100%;
            border-collapse: collapse;
        }

        .table-cours thead {
            background: var(--bg-secondary);
            border-bottom: 2px solid var(--border);
        }

        .table-cours th {
            padding: 16px;
            text-align: left;
            font-size: 13px;
            font-weight: 600;
            color: var(--text-secondary);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .table-cours tbody tr {
            border-bottom: 1px solid var(--border);
            transition: background 0.2s ease;
        }

        .table-cours tbody tr:hover {
            background: var(--bg-hover);
        }

        .table-cours td {
            padding: 16px;
            color: var(--text-primary);
            font-size: 14px;
        }

        /* Action Buttons */
        .action-buttons {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        #btn-mdf, #btn-delet {
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        #btn-mdf {
            background: rgba(16, 185, 129, 0.1);
            color: var(--accent-success);
            border: 1px solid rgba(16, 185, 129, 0.2);
        }

        #btn-mdf:hover {
            background: var(--accent-success);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
        }

        #btn-delet {
            background: rgba(239, 68, 68, 0.1);
            color: var(--accent-danger);
            border: 1px solid rgba(239, 68, 68, 0.2);
        }

        #btn-delet:hover {
            background: var(--accent-danger);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
        }

        /* Badge */
        .badge {
            padding: 4px 12px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
            display: inline-block;
        }

        .badge-success {
            background: rgba(16, 185, 129, 0.1);
            color: var(--accent-success);
        }

        .badge-warning {
            background: rgba(245, 158, 11, 0.1);
            color: var(--accent-warning);
        }

        .badge-danger {
            background: rgba(239, 68, 68, 0.1);
            color: var(--accent-danger);
        }

        /* Responsive */
        @media(max-width: 768px) {
            body {
                padding: 16px;
            }

            .header h1 {
                font-size: 24px;
            }

            .stats-grid {
                grid-template-columns: 1fr;
                gap: 16px;
            }

            .stat-number {
                font-size: 36px;
            }

            .two-grid {
                grid-template-columns: 1fr;
            }

            .table-cours thead {
                display: none;
            }

            .table-cours tbody tr {
                display: block;
                margin-bottom: 16px;
                border-radius: 12px;
                border: 1px solid var(--border);
                background: var(--bg-secondary);
            }

            .table-cours td {
                display: flex;
                justify-content: space-between;
                padding: 12px 16px;
                border-bottom: 1px solid var(--border);
            }

            .table-cours td:last-child {
                border-bottom: none;
            }

            .table-cours td::before {
                content: attr(data-label);
                font-weight: 600;
                color: var(--text-secondary);
                font-size: 12px;
                text-transform: uppercase;
            }

            .action-buttons {
                width: 100%;
                flex-direction: column;
            }

            #btn-mdf, #btn-delet {
                flex: 1;
                justify-content: center;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>Dashboard Salle de Sport</h1>
            <p>Gérez vos cours et équipements en toute simplicité</p>
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
        <div class="card">
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
        <div class="card">
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
        <div class="card">
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
                                    <a href='#' id='btn-mdf'>Modifier</a>
                                    <a href='index.php?del_id={$row['id_cours']}' id='btn-delet'>Supprimer</a>
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
        <div class="card">
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
                                    <a href='index.php?deleq_id={$row['id_equipement']}' id='btn-delet'>Supprimer</a>
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
</body>

</html>



/*in use case add validation delete et edit*/;