<?php

session_start();
require_once 'includes/DatabaseConnector.php';
require_once 'includes/User.php';
require_once 'includes/Email.php';

if(isset($_POST['generatePassword'])) {
    $client = new User;
    $result = $client->getUser($_POST['email']);
    if($result!="Error") {
        $passwordUser = bin2hex(openssl_random_pseudo_bytes(4));
        $email = new Email;
        $resultEmail = $email->sendNewPassword($result['email'], $passwordUser);

        if($resultEmail!='Email has not been sent') {
            $resultUpdate = $client->updatePassword($result['email'], $passwordUser);
            if($resultUpdate!='Error')
                $_SESSION['info'] = "The new password has been sent to the email provided";
        }
        else
            $_SESSION['info'] = $resultEmail;
    } else
        $_SESSION['info'] = "There isn't client with the given email in the database";
}

?>

<!doctype html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Service Management</title>
    <link rel="stylesheet" href="css/loginPanel.css">
    <link rel="stylesheet" href="css/fontello.css">
</head>
<body>
<header>
    Service Management
</header>
<main>
    <form action="forgotPassword.php" method="post">
        <div class="field">
            <label for="email">Email</label>
            <input type="text" name="email" class="field-input">
        </div>
        <div class="field">
            <input type="submit" value="Generate new password" name="generatePassword" class="btn-main">
        </div>
        <?php
        if(isset($_SESSION['info'])) {
            echo '<div class="info">' . $_SESSION['info'] . '</div>';
            unset($_SESSION['info']);
        }
        ?>
    </form>
</main>
</body>
</html>