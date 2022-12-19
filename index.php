<?php

/**@var $appointments */
//Requests the 'appointments' data//
require_once 'connection.php';

$query = "SELECT * FROM appointments";

$result = mysqli_query($db, $query)
or die('Error ' . mysqli_error($db) . ' with query ' . $query);
//Makes a new array//
$appointments = [];

//loop through the data
while ($row = mysqli_fetch_assoc($result)) {
    $appointments[] = $row;
}
//close the connection
mysqli_close($db);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Lia's Hairsalon</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">

</head>
<body>

<section class="hero has-text-centered-desktop">
    <div class="hero-body ">
        <p class="title">
            Lia's Hairsalon
        </p>
        <p class="subtitle">
            Dokter Diamantlaan 40 - Hoek van Holland
        </p>
    </div>
</section>

<nav class="m-auto is-flex" role="navigation" aria-label="main navigation">
    <div id="navbar" class="navbar-menu">
        <div class="navbar-start is-center m-auto">
            <div class="navbar-item">
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
        <main class="column is-narrow ">

            <h1 class="is-size-3 m-4">Welkom</h1>
            <p class="m-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi
                ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa
                qui officia deserunt mollit anim id est laborum.</p>
            <h2 class="is-size-4 m-4">Locatie & Openingstijden</h2>
            <div class="columns m-4">
                <div class="column">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                    labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi
                    ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                    cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa
                    qui officia deserunt mollit anim id est laborum. </div>
                <div class="column">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                    labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi
                    ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                    cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa
                    qui officia deserunt mollit anim id est laborum. </div>
                <div class="column">
                        <div class="google-maps">
                            <iframe width="700" height="500" id="gmap_canvas"
                                    src="https://maps.google.com/maps?q=dokter%20diamantlaan%2040&t=&z=13&ie=UTF8&iwloc=&output=embed">

                            </iframe>
                            <style>.google-maps {
                                    overflow: hidden;
                                    background: none !important;
                                    height: 40vh; !important;
                                    width: 10vw !important
                                    border-radius: 5px; !important;
                                    border-color: black; !important;

                                }</style>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <footer class="has-text-centered m-auto p-3" id="footer">
            <p>
                Reservering systeem door <a href="https://github.com/colorants">Viggo van der Ven</a>.
                Deze website is gemaakt voor Lia's Hairsalon.
            </p>

        </footer>
    </div>
</div>
</body>


</html>
