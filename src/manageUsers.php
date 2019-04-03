<?php
session_start();

if(!isset($_SESSION['adminLogin']) || !$_SESSION['adminLogin'])
    header("Location: index.php");

require_once 'includes/DatabaseConnector.php';
require_once 'includes/User.php';

?>

<!doctype html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Service Management</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/fontello.css">
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/search.js"></script>
</head>
<body>
<header>
    Service Management
</header>
<main>
    <section class="add-fault">

        <form action="addUser.php" method="post">
            <div class="form-group">
                <label for="clientName">User name:
                    <input type="text" name="userName"></label>
            </div>

            <div class="form-group">
                <label for="phone">Phone:
                    <input type="text" name="phone"></label>
            </div>

            <div class="form-group">
                <label for="email">Email:
                    <input type="text" name="email"></label>
            </div>

            <div class="form-group">
                <input type="submit" name="btnAdd" value="Add" class="btn-main">
            </div>
        </form>
        <?php
        if(isset($_SESSION['info'])) {
            echo '<div class="info">' . $_SESSION['info'] . '</div>';
            unset($_SESSION['info']);
        }
        ?>
    </section>

    <div class="form-group" style="width: auto;">
        <a href="adminPanel.php" class="btn-main btn-in-update">Back</a>
    </div>
    <div class="form-group">
        <input type="text" name="search" id="search" placeholder="Search">
    </div>

    <section class="customer-table">
        <table id="table">
            <thead>
            <tr>
                <td>ID</td>
                <td>Name</td>
                <td>Phone</td>
                <td>Email</td>
                <td>Role</td>
                <td class="action-in-row"></td>
            </tr>
            </thead>
            <tbody>
            <?php
                $user = new User;
                echo $user->getUserTable();
            ?>
            </tbody>
        </table>


    </section>
</main>

<footer>
    @Copyright Mateusz Balcer
</footer>
</body>
</html>