<?php

session_start();
require_once 'DatabaseConnector.php';
require_once 'User.php';

$passwordUser = "newpass123";

$client = new User;

$_SESSION['info'] = $client->addNewUser($_POST['clientName'], $_POST['email'], $passwordUser, $_POST['phone']);

header("Location: index.php");
?>