<?php
//Gets customer ID from the url
$data = $_GET['id'];
require_once 'connection.php';
$query = "SELECT * FROM appointments WHERE id = '$data'";
$result = mysqli_query($db, $query);
//Check if form is submitted
if(isset($_POST['submit'])) {
    require_once 'connection.php';
    $fullName = $_POST['fullName'];
    $email = $_POST['email'];
    $phoneNumber = $_POST['phoneNumber'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $treatment = $_POST['treatment'];
    $comments = $_POST['comments'];
    require_once 'form_validation.php';

    if(empty($error)) {
        $query = "UPDATE 
                    appointments
                  SET 
                    fullName = '$fullName', 
                    email = '$email', 
                    phoneNumber = '$phoneNumber', 
                    date = '$date', 
                    time = '$time', 
                    treatment = '$treatment', 
                    comments = '$comments' 
                    WHERE id = '$data'";
        if(mysqli_query($db, $query)) {
            mysqli_close($db);
            header("Location: dashboard.php");
            exit();
        } else {
            $error['database'] = "ERROR: Something went wrong... "
                . mysqli_error($db);
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Afspraak wijzigen</title>
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
            <div class="navbar-item is-flex is-justify-content-right">
                <a href="register.php" class="navbar-item">
                    Log in / Registeren
                </a>
            </div>

        </div>

</nav>
<br>

<?php if (!empty($errors)): ?>
    <section class="content">
        <ul class="notification is-danger">
            <?php foreach ($errors as $error): ?>
                <li><?= $error; ?></li>
            <?php endforeach; ?>
        </ul>
    </section>
<?php endif; ?>

<div class="buttons">
<div class="back_btn ml-auto mr-6">
    <a href="dashboard.php" class="button">Terug</a>
</div>
</div>


    <form action="" method="post" class="m-auto " enctype="multipart/form-data">
        <label for="fullName" class="label">Naam :</label>
        <input class="input" type="text" name="fullName" id="fullName" placeholder="Volledige naam" value="<?= $fullName ?? '' ?>">
        <span class="has-text-danger"><?php if (isset($error['fullName'])) {
                echo $error['fullName'];
            } ?> </span>

        <label for="email" class="label">Emai :</label>
        <input class="input" type="text" name="email" id="email" placeholder="" value="<?= $email  ?? '' ?>">
        <span class="has-text-danger"><?php if (isset($error['email'])) {
                echo $error['email'];
            } ?> </span>

        <label for="phoneNumber" class="label">Telefoonnummer :</label>
        <input class="input" type="text" name="phoneNumber" id="phoneNumber" placeholder="" value="<?= $phoneNumber  ?? '' ?>">
        <span class="has-text-danger"><?php if (isset($error['phoneNumber'])) {
                echo $error['phoneNumber'];
            } ?> </span>

        <label for="date" class="label">Datum :</label>
        <input class="input" type="date" id="date" name="date" value="<?= $date ?? ''?>">
        <span class="has-text-danger"><?php if (isset($error['date'])) {
                echo $error['date'];
            } ?> </span>

        <label for="time" class="label">Tijd :</label>
        <input class="input" type="time" id="time" name="time"value="<?= $time ?? ''?>">
        <span class="has-text-danger"><?php if (isset($error['time'])) {
                echo $error['time'];
            } ?> </span>

        <label for="treatment" class="label">Behandeling :</label>
        <select class="select" id="treatment" name="treatment" value="<?= $treatment ?? ''?>">
            <option value="knip">Knippen</option>
            <option value="knipfohn">Knippen + Föhnen</option>
            <option value="knipkids">Knippen Kids</option>
            <option value="uitverf">Uitgroei verven</option>
            <option value="uitpuntverf">Uitgroei + puntjes verven</option>
            <option value="highlights">Highlights (Lang haar)</option>
        </select>



        <label for="comments" class="label">Opmerkingen :</label>
        <textarea class="textarea" name="comments" id="comments" placeholder="Eventuele opmerkingen" value="<?= $comments ?? ''?>">
        </textarea>


        <br>
        <div class="buttons">
        <div class="submit_btn mr-3" >
            <button class="button is-half" name='submit' type="submit">Afspraak aanpassen</button>
        </div>
            <div class="submit_btn  ml-auto">
                <a href="dashboard.php" class="button is-fullwidth">Terug</a>
        </div>
    </form>

<footer class="has-text-centered m-auto p-3" id="footer">
    <p>
        Reservering systeem door <a href="https://github.com/colorants">Viggo van der Ven</a>.
        Deze website is gemaakt voor Lia's Hairsalon.
    </p>

</footer>
</body>
</html>