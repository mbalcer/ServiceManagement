<?php

session_start();
require_once 'DatabaseConnector.php';
require_once 'User.php';
require_once 'Hardware.php';

$passwordUser = "newpass123"; //TODO create a password generator

$client = new User;
$info = $client->addNewUser($_POST['clientName'], $_POST['email'], $passwordUser, $_POST['phone']);
if($info!="I can't add new user") {
    $clientID = $client->getUserID($_POST['email']);

    $hardware = new Hardware;
    $info = $hardware->addHardware($clientID, $_POST['description']);
}

$_SESSION['info'] = $info;
header("Location: index.php");
?>