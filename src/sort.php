<?php
/**
 * Created by PhpStorm.
 * User: mateusz
 * Date: 22.03.19
 * Time: 19:16
 */

session_start();

if(!isset($_GET['sort']))
    header("Location: index.php");

if($_GET['sort'] == 'all')
    $_SESSION['sort-query'] = "SELECT HARDWARE.ID as hardwareID, clientName, email, phone, description, status, price FROM HARDWARE 
                            INNER JOIN USERS ON USERS.ID=HARDWARE.clientID";
else if($_GET['sort'] == 'in-service')
    $_SESSION['sort-query'] = "SELECT HARDWARE.ID as hardwareID, clientName, email, phone, description, status, price FROM HARDWARE 
                            INNER JOIN USERS ON USERS.ID=HARDWARE.clientID WHERE status='Adopted' OR status='During reapir' OR status='Repaired' OR status='Not repaired'";
else if($_GET['sort'] == 'to-received')
    $_SESSION['sort-query'] = "SELECT HARDWARE.ID as hardwareID, clientName, email, phone, description, status, price FROM HARDWARE 
                            INNER JOIN USERS ON USERS.ID=HARDWARE.clientID WHERE status='Repaired' OR status='Not repaired'";
else if($_GET['sort'] == 'to repair')
    $_SESSION['sort-query'] = "SELECT HARDWARE.ID as hardwareID, clientName, email, phone, description, status, price FROM HARDWARE 
                            INNER JOIN USERS ON USERS.ID=HARDWARE.clientID WHERE status='Adopted' OR status='During repair'";
else if($_GET['sort'] == 'received')
    $_SESSION['sort-query'] = "SELECT HARDWARE.ID as hardwareID, clientName, email, phone, description, status, price FROM HARDWARE 
                            INNER JOIN USERS ON USERS.ID=HARDWARE.clientID WHERE status='Received'";



header("Location: adminPanel.php");

?>