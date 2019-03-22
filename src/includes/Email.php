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
    private $headlines;
    private $title;
    private $content;
    private $linkToWebsite;

    public function __construct() {
        $this->headlines = "Reply-to: Service Management<contact@mbalcer.cba.pl>".PHP_EOL;
        $this->headlines .= "From: Service Management <contact@mbalcer.cba.pl>".PHP_EOL;
        $this->headlines .= "MIME-Version: 1.0".PHP_EOL;
        $this->headlines .= "Content-type: text/html; charset=UTF-8".PHP_EOL;

        $this->title = "Service Management - ";
        $this->linkToWebsite = "http://mbalcer.cba.pl/ServiceManagment";
    }

    public function sendWelcomeEmail($name, $password, $email, $id) {
        $this->title .= "A repair request adopted";

        $this->content = "Hello ".$name." <br><br> Your equipment repair request no. ".$id." has been accepted <br>".
            "You can follow the repair status by logging in to the website. <a href='$this->linkToWebsite'>Link</a><br><br>".
            "Your login data is: <br> ".
            "Email: ".$email."<br>".
            "Password: ".$password."<br>".
            "<br> Greetings <br> Admin Service Management";


        if(!(mail($email, $this->title, $this->content, $this->headlines)))
            $_SESSION['info'] .= "<br>Email has not been sent";
    }

    public function sendEmail($name, $email, $id) {
        $this->title .= "A repair request adopted";

        $this->content = "Hello ".$name." <br><br> Your equipment repair request no. ".$id." has been accepted <br>".
            "You can follow the repair status by logging in to the website. <a href='$this->linkToWebsite'>Link</a><br><br>".
            "If you don't remember the password to your account, generate a new password by clicking the <a href='".$this->linkToWebsite."/forgotPassword.php'>link</a><br><br>".
            "Greetings <br> Admin Service Management";

        if(!(mail($email, $this->title, $this->content, $this->headlines)))
            $_SESSION['info'] .= "<br>Email has not been sent";
    }

    public function sendNewPassword($email, $password) {
        $this->title .= "New password to client panel";

        $this->content = "Hello. <br> ".
            "Your new login data to client panel is: <br>".
            "Email: ".$email."<br>".
            "Password: ".$password."<br>".
            "<br> Greetings <br> Admin Service Management";

        if(!(mail($email, $this->title, $this->content, $this->headlines)))
            return "Email has not been sent";
    }
}

?>