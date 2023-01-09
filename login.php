<?php
session_start();

$login = false;
// Is user logged in?


if (isset($_POST['submit'])) {
    /** @var mysqli $db */
    require_once "connection.php";

// Get form data
    $email = mysqli_escape_string($db, $_POST['email']);
    $password = $_POST['password'];
    // Server-side validation
    $errors = [];
    if ($email == '') {
        $errors['email'] = 'Gelieve uw emailadres in te vullen';
    }
    if ($password == '') {
        $errors['password'] = 'Gelieve uw wachtwoord in te vullen';
    }

    // If data valid
    if (empty($errors)) {
        // SELECT the user from the database, based on the email address.
        $sql = "SELECT * FROM users WHERE `email` = '$email';";
        $result = mysqli_query($db, $sql);

        // check if the user exists
        if (mysqli_num_rows($result) == 1) {
            // get user data
            $login_data = mysqli_fetch_assoc($result);

            if (password_verify($password, $login_data['password'])) {
                $login = true;
                // Check if the provided password matches the stored password in the database
                // Store the user in the session
                echo ("succes");
                $_SESSION['loggedInUser'] = [
                    'id' => $login_data['id'],
                    'name' => $login_data['name'],
                    'email' => $login_data['email']
                ];
                // Redirect to secure page
                header( 'Location: dashboard.php');
            } else {
                // Credentials not valid
                $errors['error'] = "Inlog onsuccesvol.";
            }
            //error incorrect log in
        } else {
            // User doesn't exist
            $errors['error'] = "Inlog onsuccesvol.";
        }
    } else {
        //error incorrect log in
        $errors['error'] = "Inlog onsuccesvol.";
    }
    mysqli_close($db);
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
    <title>Log in</title>
</head>
<body>
<section class="section">
    <div class="container content">
        <h2 class="title">Log in</h2>



            <section class="columns">
                <form class="column is-6" action="" method="post">

                    <div class="field is-horizontal">
                        <div class="field-label is-normal">
                            <label class="label" for="email">Email</label>
                        </div>
                        <div class="field-body">
                            <div class="field">
                                <div class="control has-icons-left">
                                    <input class="input" id="email" type="text" name="email"
                                           value="<?= $email ?? '' ?>"/>
                                    <span class="icon is-small is-left"><i class="fas fa-envelope"></i></span>
                                </div>
                                <p class="help is-danger">
                                    <?= $errors['email'] ?? '' ?>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="field is-horizontal">
                        <div class="field-label is-normal">
                            <label class="label" for="password">Password</label>
                        </div>
                        <div class="field-body">
                            <div class="field">
                                <div class="control has-icons-left">
                                    <input class="input" id="password" type="password" name="password"/>
                                    <span class="icon is-small is-left"><i class="fas fa-lock"></i></span>

                                    <?php if (isset($errors['loginFailed'])) { ?>
                                        <div class="notification is-danger">
                                            <button class="delete"></button>
                                            <?= $errors['loginFailed'] ?>
                                        </div>
                                    <?php } ?>

                                </div>
                                <p class="help is-danger">
                                    <?= $errors['password'] ?? '' ?>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="field is-horizontal">
                        <div class="field-label is-normal"></div>
                        <div class="field-body">
                            <button class="button is-link is-fullwidth" type="submit" name="submit">Log in With Email
                            </button>
                        </div>
                    </div>
                    <p class="help is-danger">
                        <?= $errors['error'] ?? '' ?>
                    </p>
                </form>
            </section>


    </div>
</section>
</body>
</html>
