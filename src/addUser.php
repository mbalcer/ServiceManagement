<?php
if (!isset($_POST['btnAdd']))
    header("Location: index.php");

session_start();
require_once 'includes/DatabaseConnector.php';
require_once 'includes/User.php';

$password = "NewPass123";

$newUser = new User;
$addUser = $newUser->addNewUser($_POST['userName'], $_POST['email'], $password, $_POST['phone']);
$_SESSION['info'] = $addUser;

header("Location: manageUsers.php");