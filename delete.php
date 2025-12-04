<?php
//patie delet cours f table
if (isset($_GET['del_id'])) {
    $delet_cours = $_GET['del_id'];
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
    $delet_equipement = $_GET['deleq_id'];
    $sqldelet_equipement = "DELETE FROM equipement WHERE id_equipement= $delet_equipement";

    if (mysqli_query($conn, $sqldelet_equipement)) {
        header("Location: index.php?succes=1");
        exit();
    } else {
        echo "Error:" . mysqli_error($conn);
    }
}
?>