<?php
/**
 * Created by PhpStorm.
 * User: mateusz
 * Date: 05.03.19
 * Time: 19:57
 */

require_once 'includes/DatabaseConnector.php';
require_once 'includes/User.php';
session_start();

if(isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $user = new User;
    $result = $user->getUser($email);

    if($email==$result['email'] && password_verify($password, $result['password'])) {
        if($result['role']=='client') {
            $_SESSION['clientEmail'] = $result['email'];
            header("Location: clientPanel.php");
        } else if($result['role']=='admin') {
            $_SESSION['adminLogin'] = true;
            header("Location: adminPanel.php");
        }
    } else {
        $_SESSION['info'] = "Incorrect login or password";
        header("Location: index.php");
    }

} else
    header("Location: index.php");

?>