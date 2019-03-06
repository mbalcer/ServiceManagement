<?php

session_start();
require_once 'DatabaseConnector.php';
require_once 'User.php';
require_once 'Hardware.php';

$passwordUser = "newpass123"; //TODO create a password generator

$client = new User;
$info = $client->addNewUser($_POST['clientName'], $_POST['email'], $passwordUser, $_POST['phone']);
if($info!="I can't add new user") {
    $result = $client->getUser($_POST['email']);
    $clientID = $result['ID'];

    $hardware = new Hardware;
    $info = $hardware->addHardware($clientID, $_POST['description']);
}

$_SESSION['info'] = $info;

//TODO send email to client with data to account
//TODO generate pdf to print with data to account

header("Location: adminPanel.php"); // TODO redirect to ...
?>