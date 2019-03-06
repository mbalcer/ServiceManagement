<?php
/**
 * Created by PhpStorm.
 * User: mateusz
 * Date: 01.03.19
 * Time: 10:58
 */

session_start();
require_once 'DatabaseConnector.php';
require_once 'Hardware.php';

$objHardware = new Hardware;
$answer = $objHardware->removeHardware($_POST['id']);

$_SESSION['info'] = $answer;

header("Location: adminPanel.php");

?>