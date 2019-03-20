<?php

session_start();
require_once 'includes/DatabaseConnector.php';
require_once 'includes/User.php';
require_once 'includes/Hardware.php';
require_once 'includes/Email.php';

$passwordUser = bin2hex(openssl_random_pseudo_bytes(4));

$client = new User;
$info = $client->addNewUser($_POST['clientName'], $_POST['email'], $passwordUser, $_POST['phone']);
if($info!="I can't add new user") {
    $result = $client->getUser($_POST['email']);
    $clientID = $result['ID'];

    $hardware = new Hardware;
    $info = $hardware->addHardware($clientID, $_POST['description']);
}

$_SESSION['info'] = $info."<br> Password user is: ".$passwordUser;

$email = new Email;
$email->sendEmail($_POST['name'], $passwordUser, $_POST['email']);

$_SESSION['info'] .= "<br> <a href='includes/PDF.php' class='btn-pdf'>PDF</a>";

$_SESSION['email'] = $_POST['email'];
$_SESSION['password'] = $passwordUser;

header("Location: adminPanel.php"); // TODO redirect to ...
?>