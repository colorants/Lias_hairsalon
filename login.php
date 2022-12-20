<?php
session_start();
require_once 'connection.php';
$login = false;
// Is user logged in?

if (isset($_POST['submit'])) {

    // Get form data
    $email = mysqli_escape_string($db, $_POST['email']);
    $password = ($_POST['password']);

    // Server-side validation
    $errors = [];
    if ($_POST['email'] == '') {
        $error['email'] = 'Gelieve het emailadres in te vullen';
    }
    if ($_POST['password'] == '') {
        $error['password'] = 'Gelieve het wachtwoord in te vullen';
    }

    // If data valid
    if (empty($error)) {
        // SELECT the user from the database, based on the email address.
        $query = "SELECT * FROM users WHERE email = '$email'";
        $result = mysqli_query($db, $query);
        // check if the user exists
        if (mysqli_num_rows($result) == 1) {
            // Get user data from result
            $user = mysqli_fetch_assoc($result);
            // Check if the provided password matches the stored password in the database
            if (password_verify($password, $user['password'])) {
                $login = true;


                // Store the user in the session
                $_SESSION ['loggedInUser'] = [
                    'id' => $user['id'],
                    'name' => $user['name'],
                    'email' => $user['email'],
                ];
                // Redirect to secure page
                header("Location: dashboard.php");
                // Credentials not valid
            }
            else {
                    //error incorrect log in
                    $error['loginFailed'] = 'De gegevens komen niet overeen';
                    // User doesn't exist
                }
            }
            else {
                    //error incorrect log in
                    $error['loginFailed'] = 'De gegevens komen niet overeen';

        }
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
    <title>Log in</title>
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
        <?php if ($login) { ?>
            <p>Je bent ingelogd!</p>
            <p><a href="Uitloggen">Uitloggen</a> / <a href="../programmeren/week6/exercises/secure.php">Naar dashboard</a></p>
        <?php } else { ?>

        <section class="hero is-primary is-fullheight">
            <div class="hero-body">
                <div class="container">
                    <div class="columns is-centered">
                        <div class="column is-5-tablet is-4-desktop is-3-widescreen">
                            <form action="" class="box">
                                <div class="field">
                                    <div class="control has-icons-left">
                                        <input class="input" id="email" type="text" name="email" value="<?= $email ?? '' ?>" />
                                        <span class="icon is-small is-left"><i class="fas fa-envelope"></i></span>
                                    </div>
                                    <p class="help is-danger">
                                        <?= $errors['email'] ?? '' ?>
                                    </p>
                                </div>
                                <div class="field">
                                    <div class="control has-icons-left">
                                        <input class="input" id="password" type="password" name="password"/>
                                        <span class="icon is-small is-left"><i class="fas fa-lock"></i></span>

                                        <?php if(isset($errors['loginFailed'])) { ?>
                                            <div class="notification is-danger">
                                                <button class="delete"></button>
                                                <?=$errors['loginFailed']?>
                                            </div>
                                        <?php } ?>

                                    </div>
                                    <p class="help is-danger">
                                        <?= $errors['password'] ?? '' ?>
                                    </p>
                                </div>

                                <div class="field">
                                    <label for="" class="checkbox">
                                        <input type="checkbox">
                                        Remember me
                                    </label>
                                </div>
                                <div class="field">
                                    <button class="" type="submit">
                                        Login
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </section>
</body>
</html>




