<?php
/**
 * Created by PhpStorm.
 * User: mateusz
 * Date: 01.03.19
 * Time: 10:58
 */

session_start();
require_once 'includes/DatabaseConnector.php';
require_once 'includes/Hardware.php';

$objHardware = new Hardware;
$objRepairStatus = new RepairStatus;

$objRepairStatus->removeStatusHistory($_POST['hardwareID']);
$answer = $objHardware->removeHardware($_POST['hardwareID']);

$_SESSION['info'] = $answer;

header("Location: adminPanel.php");

?>