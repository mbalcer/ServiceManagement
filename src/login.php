<?php
/**
 * Created by PhpStorm.
 * User: mateusz
 * Date: 05.03.19
 * Time: 19:57
 */

require_once 'DatabaseConnector.php';
require_once 'User.php';
session_start();

if(isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $user = new User;
    $result = $user->getUser($email);

    if($email==$result['email'] && crypt($result['password'], $password)) {
        if($result['role']=='client') {
            $_SESSION['clientEmail'] = $result['email'];
            header("Location: clientPanel.php");
        } else if($result['role']=='admin') {
            $_SESSION['adminLogin'] = true;
            header("Location: adminPanel.php");
        }
    }

} else
    header("Location: index.php");

?>