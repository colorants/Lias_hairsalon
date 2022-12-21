<?php
require_once 'secure.php';
/** @var $db */
require_once "connection.php";


//Gets the id from the url
$data = $_GET['id'];

//Finds the appointment with the id that is given in the url
$query = "SELECT * FROM appointments WHERE id = " . $data;
$result = mysqli_query($db, $query);

//Transforms the row in the DB table to a PHP array
$data = mysqli_fetch_assoc($result);

//Close connection
mysqli_close($db);

?>


<!doctype html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <title> Opmerking : <?= $data['fullName'] ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
</head>
<body>
<div class="container m-auto is-centered">
    <h1 class="title m-4"><?= $data['fullName'] ?></h1>
    <section class="content is-center">
        <div class="card">
            <div class="card-content">
                <div class="content">
                    <ul>
                        <li>Opmerking : <?= $data['comments'] ?></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="buttons">
        <div class="back_btn m-3 ml-auto">
            <a href="dashboard.php" class="button is-fullwidth">Terug</a>
        </div>
    </section>
</div>
</body>


</html>

