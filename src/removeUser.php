<?php

if (!isset($_POST['id']))
    header("Location: index.php");

session_start();
require_once 'includes/DatabaseConnector.php';
require_once 'includes/User.php';
require_once 'includes/Hardware.php';
require_once 'includes/RepairStatus.php';

$userID = $_POST['id'];

$objHardware = new Hardware;
$objUser = new User;
$objRepairStatus = new RepairStatus;

$allUserHardware = $objHardware->getHardwareForClientPanel($userID);

foreach ($allUserHardware as $item) {
    $objRepairStatus->removeStatusHistory($item['ID']);
    $objHardware->removeHardware($item['ID']);
}

$result = $objUser->removeUser($userID);
$_SESSION['info'] = $result;

header("Location: manageUsers.php");