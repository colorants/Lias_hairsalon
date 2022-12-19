<?php
//Check if form is submitted
if(isset($_POST['submit'])) {
    require_once 'form_validation.php';
    require_once 'connection.php';
    if(empty($error)) {
        $fullName = ($_POST['fullName']);
        $email = ($_POST['email']);
        $phoneNumber = ($_POST['phoneNumber']);
        $date = ($_POST['date']);
        $time = ($_POST['time']);
        $treatment = ($_POST['treatment']);
        $comments = ($_POST['comments']);

        $query = "INSERT INTO appointments (fullName, email, phoneNumber, date, time, treatment, comments) 
                  VALUES ('$fullName','$email','$phoneNumber','$date', '$time', '$treatment','$comments')";
        if(mysqli_query($db, $query)) {
            mysqli_close($db);
            header("Location: succesful.html");
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
    <title>Afspraak maken</title>
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

<h1 class="has-text-centered-desktop m-5">Plan hier uw afspraak</h1>

<?php if (!empty($errors)): ?>
    <section class="content">
        <ul class="notification is-danger">
            <?php foreach ($errors as $error): ?>
                <li><?= $error; ?></li>
            <?php endforeach; ?>
        </ul>
    </section>
<?php endif; ?>

<div class="container">
    <form action="" method="post" class="ml-auto" enctype="multipart/form-data">
        <label for="fullName" class="label">Vul hier uw naam in :</label>
        <input class="input has-icons-left" type="text" name="fullName" id="fullName" placeholder="Volledige naam" value="<?php if(isset($_POST['fullName'])) {
            echo $_POST['fullName'];
        }?>">
        <span class="has-text-danger"><?php if (isset($error['fullName'])) {
                echo $error['fullName'];
            } ?> </span>

        <label for="email" class="label">Vul hier uw email in :</label>
        <input class="input" type="text" name="email" id="email" placeholder="" value=<?php if(isset($_POST['email'])) {
            echo $_POST['email'];
        }?>>
        <span class="has-text-danger"><?php if (isset($error['email'])) {
                echo $error['email'];
            } ?> </span>

        <label for="phoneNumber" class="label">Vul hier uw telefoonnummer in :</label>
        <input class="input" type="text" name="phoneNumber" id="phoneNumber" placeholder="" value="<?php if(isset($_POST['phoneNumber'])) {
            echo $_POST['phoneNumber'];
        }?>">
        <span class="has-text-danger"><?php if (isset($error['phoneNumber'])) {
                echo $error['phoneNumber'];
            } ?> </span>

        <label for="date" class="label">Kies uw datum :</label>
        <input class="input" type="date" id="date" name="date" value="<?php if(isset($_POST['date'])) {
            echo $_POST['date'];
        }?>">
        <span class="has-text-danger"><?php if (isset($error['date'])) {
                echo $error['date'];
            } ?> </span>

        <label for="time" class="label">Kies uw tijd :</label>
        <input class="input" type="time" id="time" name="time"value="<?php if(isset($_POST['time'])) {
            echo $_POST['time'];
        }?>">
        <span class="has-text-danger"><?php if (isset($error['time'])) {
                echo $error['time'];
            } ?> </span>


        <label for="treatment" class="label">Kies uw behandeling :</label>
        <select class="select" id="treatment" name="treatment"  >
            <option value="knip">Knippen</option>
            <option value="knipfohn">Knippen + Föhnen</option>
            <option value="knipkids">Knippen Kids</option>
            <option value="uitverf">Uitgroei verven</option>
            <option value="uitpuntverf">Uitgroei + puntjes verven</option>
            <option value="highlights">Highlights (Lang haar)</option>
        </select>


        <label for="comments" class="label">Opmerkingen :</label>
        <textarea class="textarea" name="comments" id="comments" placeholder="Eventuele opmerkingen"></textarea>


        <br>
        <div class="buttons">
            <div class="submit_btn mr-3" >
                <button class="button is-half" name='submit' type="submit">Afspraak maken</button>
            </div>
            <div class="back_btn ml-auto" onclick="history.back()">
                <a class="button is-fullwidth">Terug</a>
            </div>
    </form>

</div>
<footer class="has-text-centered is-flex-align-items-flex-end mt-3 p-3">
    <p>
        Reservering systeem door <a href="https://github.com/colorants">Viggo van der Ven</a>. Deze
        website is gemaakt voor Lia's Hairsalon.
    </p>
</footer>
</body>
</html>