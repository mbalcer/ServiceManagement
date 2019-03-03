<?php
/**
 * Created by PhpStorm.
 * User: mateusz
 * Date: 03.03.19
 * Time: 20:13
 */

session_start();
require_once 'DatabaseConnector.php';
require_once 'Hardware.php';
require_once 'RepairStatus.php';

$hardwareID = $_POST['hardwareID'];

$objHardware = new Hardware;
$hardware = $objHardware->getHardware(intval($hardwareID));

if($hardware['status'] != $_POST['changeStatus'] || $hardware['price'] != $_POST['changePrice']) {
    $objStatus = new RepairStatus;
    $answerStatus = $objStatus->addChangeStatus($hardwareID, $hardware['status'], $_POST['changeStatus'], $_POST['comments']);

    $updatePrice = $objHardware->updateHardware('price', floatval($_POST['changePrice']), intval($hardwareID));
    $updateStatus = $objHardware->updateHardware('status', $_POST['changeStatus'], intval($hardwareID));

    if($answerStatus!="Error" && $updatePrice!="Error" && $updateStatus!="Error")
        $_SESSION['info'] = "The data update was successful";
    else
        $_SESSION['info'] = "Error during update";
}

header("Location: index.php");

?>