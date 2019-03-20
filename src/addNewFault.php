<?php

session_start();
require_once 'includes/DatabaseConnector.php';
require_once 'includes/User.php';
require_once 'includes/Hardware.php';
require_once 'includes/Email.php';

$passwordUser = bin2hex(openssl_random_pseudo_bytes(4));

$client = new User;
$info = $client->addNewUser($_POST['clientName'], $_POST['email'], $passwordUser, $_POST['phone']);
$result = $client->getUser($_POST['email']);

if($info!="I can't add new user") {
    $clientID = $result['ID'];

    $hardware = new Hardware;
    $_SESSION['info'] = $hardware->addHardware($clientID, $_POST['description']);
}

$email = new Email;
if($info=='Added new user') {
    $_SESSION['info'] .= "<br>".$info."<br> Password user is: " . $passwordUser;
    $_SESSION['info'] .= "<br> <a href='includes/PDF.php' onclick=\"this.target='_blank'\" class='btn-pdf'>PDF</a>";
    $email->sendWelcomeEmail($result['clientName'], $passwordUser, $result['email'], $result['ID']);
}
else if($info=='The user already exists') {
    $_SESSION['info'] .= "<br>".$info;
    $email->sendEmail($result['clientName'], $result['email'], $result['ID']);
}

$_SESSION['email'] = $_POST['email'];
$_SESSION['password'] = $passwordUser;

header("Location: adminPanel.php");
?>