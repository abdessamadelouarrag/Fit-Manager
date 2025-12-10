<?php

$user_id = $_SESSION["id_user"];
//part edit cours

$name_cours = "";
$catg_cours = "";
$date_cours = "";
$heure_cours = "";
$duree = "";
$nb_max = "";

if (isset($_GET['edit_id'])) {
    $edit_cours = $_GET['edit_id'];
    $selectcours = mysqli_query($conn, "SELECT * FROM cours WHERE id_cours = $edit_cours AND id_user = $user_id");
    $datacours = mysqli_fetch_assoc($selectcours);

    if ($datacours) {
        $name_cours = $datacours['nom'];
        $catg_cours = $datacours['categorie'];
        $date_cours = $datacours['date_cours'];
        $heure_cours = $datacours['heure'];
        $duree = $datacours['duree'];
        $nb_max = $datacours['nombre_max_de_participants'];
    }
}
$name_equipementd = "";
$type_equipementd = "";
$quantite_equipementd = "";
$etat_equipementd = "";

if (isset($_GET['edit_id'])) {
    $edit_equipement = $_GET['edit_id'];
    $selectequipement = mysqli_query($conn, "SELECT * FROM equipement WHERE id_equipement = $edit_equipement AND id_user = $user_id");
    $dataequipement = mysqli_fetch_assoc($selectequipement);

    if($dataequipement){
        $name_equipementd = $dataequipement['nom'];
        $type_equipementd = $dataequipement['type'];
        $quantite_equipementd = $dataequipement['quantite_disponible'];
        $etat_equipementd = $dataequipement['etat'];
    }
}

?>