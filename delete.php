<?php

$user_id = $_SESSION["id_user"];

//patie delet cours f table
if (isset($_GET['del_id'])) {
    $delet_cours = $_GET['del_id'];
    $sqldelet = "DELETE FROM cours WHERE id_cours = $delet_cours AND id_user = $user_id";

    if (mysqli_query($conn, $sqldelet)) {
        header("Location: dashboard.php?succes=1");
        exit();
    } else {
        echo "Error:" . mysqli_error($conn);
    }
}
//partie delet equipement in table
if (isset($_GET['deleq_id'])) {
    $delet_equipement = $_GET['deleq_id'];
    $sqldelet_equipement = "DELETE FROM equipement WHERE id_equipement= $delet_equipement AND id_user = $user_id";

    if (mysqli_query($conn, $sqldelet_equipement)) {
        header("Location: dashboard.php?succes=1");
        exit();
    } else {
        echo "Error:" . mysqli_error($conn);
    }
}
?>