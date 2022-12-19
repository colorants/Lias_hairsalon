<?php
/** @var $db */
require_once "connection.php";

$data = $_GET['id'];

//Get the record from the database result
$query = "SELECT * FROM appointments WHERE id = " . $data;
$result = mysqli_query($db, $query);

//Transform the row in the DB table to a PHP array
$data = mysqli_fetch_assoc($result);

//Close connection
mysqli_close($db);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Details : <?= $data['fullName'] ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
</head>
<body class="">
<div class="container m-auto is-centered">
    <h1 class="title m-4 "><?= $data['fullName'] ?></h1>
    <section class="content is-center">
        <div class="card">
            <div class="card-content">
                <div class="content">
                    <ul>

                        <li>Naam: <?= $data['fullName'] ?> </li>
                        <li>Datum: <?= $data ['date'] ?></li>
                        <li>Behandeling: <?= $data['treatment'] ?></li>
                    </ul>
                </div>
            </div>
        </div>
        <a class="button is-fullwidth" href="dashboard.php"> « Terug naar de afspraken</a>
    </section>
</div>
<footer class="has-text-centered" id="footer">
    <p>
        <strong>Reservering systeem</strong> door <a href="https://github.com/colorants">Viggo van der Ven</a>.
        Deze website is gemaakt voor Lia's Hairsalon.
    </p>

</footer>
</body>
</html>
