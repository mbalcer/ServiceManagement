<?php
/**
 * Created by PhpStorm.
 * User: mateusz
 * Date: 27.02.19
 * Time: 19:37
 */


class User extends DatabaseConnector
{
    public function addNewUser($clientName, $email, $password, $phone) {
        $query = "SELECT email FROM USERS WHERE email='$email'";
        $isUser = $this->dbConnect()->query($query);
        if($isUser->rowCount()==0) {
            $passHash = password_hash($password, PASSWORD_DEFAULT);
            $addUser = $this->dbConnect()->exec("INSERT INTO USERS(clientName, email, password, phone, role) VALUES ('$clientName', '$email', '$passHash', '$phone', 'client')");
            if($addUser)
                return "Added new user";
            else
                return "I can't add new user";
        }
        else {
            return "The user already exists";
        }
    }

    public function getUserID($email) {
        $query = "SELECT ID FROm USERS WHERE email='$email'";
        $isUser = $this->dbConnect()->query($query);
        if($isUser->rowCount()==1) {
            $result = $isUser->fetch();
            return $result['ID'];
        }
        else {
            return "Error"; // there is no user with this email
        }
    }
}