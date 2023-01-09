<?php
if(isset($_POST['submit'])) {
    /** @var mysqli $db */
    require_once "connection.php";

    // Get form data
    $name = mysqli_escape_string($db, $_POST['name']);
    $email = mysqli_escape_string($db, $_POST['email']);
    $password = ($_POST['password']);
    // Server-side validation
    $errors = [];
    if (!isset($_POST['name']) || $_POST['name'] == '') {
        $error['password'] = 'Gelieve uw naam in te vullen';
    }
    if (!isset($_POST['email']) || $_POST['email'] == '' ) {
        $error['email'] = 'Gelieve een emailadres in te vullen';
        }

    if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) ) {
        $error['email'] = 'Gelieve een geldig email adres in te vullen';
    }

    if (!isset($_POST['password']) || $_POST['password'] == '') {
        $error['password'] = 'Gelieve een wachtwoord in te vullen';
    }
    // If data valid
    if (empty($error)) {
        // create a secure password, with the PHP function password_hash()
        $password = password_hash($password, PASSWORD_DEFAULT);
        // store the new user in the database.
        $query = "INSERT INTO users (name, email, password) 
                  VALUES ('$name','$email','$password')";
        // If query succeeded
        if (mysqli_query($db, $query)) {
            mysqli_close($db);

            // Redirect to login page
            header("Location: login.php");
            // Exit the code
            exit();
        }
    } else {
        $error['database'] = "ERROR: Something went wrong... "
            . mysqli_error($db);
    }

}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">


    <title>Registreren</title>
</head>
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
<body>

<h1 class="has-text-centered-desktop m-5">Registreer hier</h1>

                <form class="is-flex is-flex-direction-column m-auto" action="" method="post">
                    <label class="label" for="name">Naam</label>
                    <input class="input" type="text" name="name" id="name" placeholder="Naam" value=<?php if(isset($_POST['name'])) {
                        echo $_POST['name'];
                    }?>>
                    <span class="has-text-danger p-1 "><?php if (isset($error['name'])) {
                            echo $error['name'];
                        } ?> </span>
                    <!-- Email -->
                    <label class="label" for="email">Email</label>
                    <input class="input" type="text" name="email" id="password" placeholder="Email" value=<?php if(isset($_POST['email'])) {
                        echo $_POST['email'];
                    }?>>
                    <span class="has-text-danger p-1 is-size-6"><?php if (isset($error['email'])) {
                            echo $error['email'];
                        } ?> </span>
                    <!-- Password -->
                                <label class="label" for="password">Wachtwoord</label>
                                <input class="input" type="password" name="password" id="password" placeholder="Wachtwoord" value=<?php if(isset($_POST['password'])) {
                                    echo $_POST['password'];
                                }?>>
                                <span class="has-text-danger p-1 is-size-6"><?php if (isset($error['email'])) {
                                        echo $error['password'];
                        } ?> </span>
                    <!-- Submit -->
                    <div class="buttons">
                        <div class="submit_btn">
                            <button class="button is-full" name='submit' type="submit">Klaar</button>
                        </div>
                </form>
            </section>

    </div>
</section>
</body>
</html>
