<?php
session_start();

if(!isset($_SESSION['adminLogin']) || !$_SESSION['adminLogin'])
    header("Location: index.php");

require_once 'includes/DatabaseConnector.php';
require_once 'includes/User.php';
require_once 'includes/Hardware.php';

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
            <form action="addNewFault.php" method="post">
                <div class="form-group">
                    <label for="clientName">Client name:
                    <input type="text" name="clientName"></label>
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
                    <label for="description">Description:
                    <input type="text" name="description"></label>
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

        <section class="sort-table">
            <div class="form-group">
                <input type="text" name="search" id="search" placeholder="Search">
            </div>
            <div class="sort-group">
                <a href="sort.php?sort=all" class="btn-pdf">All</a>
            </div>
            <div class="sort-group">
                <a href="sort.php?sort=in-service" class="btn-pdf">In service</a>
            </div>
            <div class="sort-group">
                <a href="sort.php?sort=to-received" class="btn-pdf">To received</a>
            </div>
            <div class="sort-group">
                <a href="sort.php?sort=to-repair" class="btn-pdf">To repair</a>
            </div>
            <div class="sort-group">
                <a href="sort.php?sort=received" class="btn-pdf">Received</a>
            </div>
        </section>

        <section class="customer-table">
            <table id="table">
                <thead>
                <tr>
                    <td>ID</td>
                    <td>Client name</td>
                    <td>Phone</td>
                    <td>Email</td>
                    <td>Description</td>
                    <td>Status</td>
                    <td>Price</td>
                    <td class="action-in-row"></td>
                </tr>
                </thead>
                <tbody>
                    <?php
                        $resultPerPage = 5;

                        $objHardware = new Hardware;
                        if(!isset($_SESSION['sort-query']))
                            $_SESSION['sort-query'] = "SELECT HARDWARE.ID as hardwareID, clientName, email, phone, description, status, price FROM HARDWARE 
                            INNER JOIN USERS ON USERS.ID=HARDWARE.clientID ORDER BY hardwareID";
                        echo $objHardware->getHardwareTable($_SESSION['sort-query']);

                        $numberOfResult = $objHardware->getHowManyRows($_SESSION['sort-query']);
                        unset($_SESSION['sort-query']);
                    ?>
                </tbody>
            </table>
        </section>
        <section class="pages">
            <?php
                $numberOfPages = ceil($numberOfResult/$resultPerPage);

                for($i = 1; $i <= $numberOfPages; $i++) {
                    echo '<a href="adminPanel.php?page='.$i.'" class="page">'.$i.'</a>';
                }
            ?>
        </section>
    </main>

    <footer>
        @Copyright Mateusz Balcer
    </footer>
</body>
</html>