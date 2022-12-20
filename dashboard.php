<?php
session_start();

if(!isset($_SESSION['loggedInUser'])) {
    header("Location: login.php");
exit();
}


/**@var $appointments */
//makes connection
require_once 'connection.php';


//selects all appointments from the database
$query = "SELECT * FROM appointments";
//executes the query
$result = mysqli_query($db, $query)
or die('Error ' . mysqli_error($db) . ' with query ' . $query);
//makes a new array
$appointments = [];
//loops through the data
while ($row = mysqli_fetch_assoc($result)) {
    $appointments[] = $row;
}
//close the connection
mysqli_close($db);

?>

<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">

</head>
<body>

<section class="hero has-text-centered-desktop ">
    <div class="hero-body ">
        <p class="title">
            Lia's Hairsalon
        </p>
        <p class="subtitle">
            Dokter Diamantlaan 40 - Hoek van Holland
        </p>
    </div>
</section>

<nav class="m-auto is-flex " role="navigation" aria-label="main navigation">
    <div id="navbar" class="navbar-menu">
        <div class="navbar-start is-center m-auto">
            <div class="navbar-item has-text-white">
                <a href="index.php" class="navbar-item is-justify-content-space-between">
                    Home
                </a>
            </div>
            <div class="navbar-item">
                <a href="form.php" class="navbar-item">
                    Afspraak maken
                </a>
            </div>
            <div class="navbar-item">
                <a href="info.php" class="navbar-item">
                    Mogelijkheden
                </a>
            </div>
            <div class="navbar-item">
                <a href="dashboard.php" class="navbar-item">
                    Dashboard
                </a>
            </div>
        </div>

</nav>
<br>

<div class="buttons">
    <div class="submit_btn ml-auto mr-4" >
        <button class="button is-half" name='submit' type="submit"><a href="create.php">Afspraak aanmaken</a></button>
    </div>
    </div>

<table class="table m-auto mt-4">
    <thead>

    <tr>
        <th>#</th>
        <th>Naam</th>
        <th>Email</th>
        <th>Telefoonnummer</th>
        <th>Datum</th>
        <th>Tijd</th>
        <th>Behandeling</th>
        <th>Verwijderen</th>
        <th>Opmerkingen</th>
        <th>Details</th>
        <th>Bewerken</th>
    </tr>
    </thead>

    <tbody>
    <?php foreach ($appointments as $data) { ?>
        <tr class="m-3">
            <td><?= $data['id'] ?></td>
            <td><?= $data['fullName'] ?></td>
            <td><?= $data['email'] ?></td>
            <td><?= $data['phoneNumber'] ?></td>
            <td><?= $data['date'] ?></td>
            <td><?= $data['time'] ?></td>
            <td><?= $data['treatment'] ?></td>
            <td>
                <button class="button is-danger" onclick="return confirm('Weet je zeker dat je deze afspraak wilt verwijderen')" > <a href="delete.php?id=<?= $data['id']?>"
                                          class="has-text-black ">Verwijderen</a></button>
            </td>
            <td>
                <button class="button"><a href="comments.php?id=<?= $data['id']?>"
                                          class="has-text-black">Opmerking</a></button>
            </td>
            <td>
                <button class="button"><a href="details.php?id=<?= $data['id']?>"
                                          class="has-text-black">Details</a></button>
            </td>
            <td>
                <button class="button is-info"><a href="edit.php?id=<?= $data['id']?>"
                                          class="has-text-black">Bewerken</a></button>
            </td>

        </tr>
    <?php } ?>
    </tbody>
</table>
<footer class="has-text-centered m-auto p-3" id="footer">
    <p>
        Reservering systeem door <a href="https://github.com/colorants">Viggo van der Ven</a>.
        Deze website is gemaakt voor Lia's Hairsalon.
    </p>

</footer>
</body>

</html>