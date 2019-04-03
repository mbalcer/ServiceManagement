<?php

session_start();
if (isset($_SESSION['adminLogin']))
    unset($_SESSION['adminLogin']);
else if(isset($_SESSION['clientEmail']))
    unset($_SESSION['clientEmail']);

header("Location: index.php");