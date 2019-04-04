<?php
if(!isset($_POST['formUpdate']))
    header("Location: index.php");

session_start();
require_once 'includes/DatabaseConnector.php';
require_once 'includes/User.php';

$email = $_POST['email'];
$objUser = new User;
$user = $objUser->getUser($email);
$errorNumber = 0;

if($_POST['name'] != '' && $user['clientName'] != $_POST['name']) {
    $updateUser = $objUser->updateUser('clientName', $_POST['name'], $email);
    if ($updateUser == 'Error')
        $errorNumber++;
} else if($_POST['phone'] != '' && $user['phone'] != $_POST['phone']) {
    $updateUser = $objUser->updateUser('phone', $_POST['phone'], $email);
    if ($updateUser == 'Error')
        $errorNumber++;
} else if($_POST['changeRole'] != $user['role']) {
    $updateUser = $objUser->updateUser('role', $_POST['changeRole'], $email);
    if ($updateUser == 'Error')
        $errorNumber++;
} else if($_POST['newpassword'] != '' && strlen($_POST['newpassword']) > 6) {
    $updatePassword = $objUser->updatePassword($email, $_POST['newpassword']);
    if ($updatePassword == 'Error')
        $errorNumber++;
}

if ($errorNumber==0)
    $_SESSION['info'] = "The data update was successful";
else
    $_SESSION['info'] = 'Error during update';

header("Location: manageUsers.php");