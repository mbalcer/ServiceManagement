<?php
/**
 * Created by PhpStorm.
 * User: mateusz
 * Date: 19.03.19
 * Time: 19:45
 */

session_start();

class Email
{
    public function sendEmail($name, $password, $email) {

	    $headlines = "Reply-to: Service Management<contact@mbalcer.cba.pl>".PHP_EOL;
        $headlines .= "From: Service Management <contact@mbalcer.cba.pl>".PHP_EOL;
        $headlines .= "MIME-Version: 1.0".PHP_EOL;
        $headlines .= "Content-type: text/html; charset=UTF-8".PHP_EOL;

        $title = "Service Management - A repair request adopted";

        $content = "Hello ".$name." <br><br> Your equipment repair request has been accepted <br>".
            "You can follow the repair status by logging in to the website. <a href='http://mbalcer.cba.pl/ServiceManagement'>Link</a><br><br>".
            "Your login data is: <br> ".
            "Email: ".$email."<br>".
            "Password: ".$password."<br>".
            "<br> Greetings <br> Admin Service Management";


        if(!(mail($email, $title, $content, $headlines)))
            $_SESSION['info'] .= "<br>Email has not been sent";

    }
}

?>