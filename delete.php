<?php

if (isset($_GET['id'])){
    require_once "connection.php";

    $id = $_GET['id'];
// Deletes the appointment with the id that is given in the url
    $query = "DELETE FROM appointments WHERE id = '$id'";

    //if the query is successful, redirect to the dashboard
    if (mysqli_query($db, $query)) {
        mysqli_close($db);
        header("Location: dashboard.php");
        exit();
    } else {
        $error['database'] = "ERROR: Could not connect... "
            . mysqli_error($db);
    }
}
?>

