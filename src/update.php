<?php

if (!isset($_POST['userEmail']) && !isset($_POST['hardwareID']))
    header("Location: index.php");

require_once 'includes/DatabaseConnector.php';
require_once 'includes/Hardware.php';
require_once 'includes/RepairStatus.php';
require_once 'includes/User.php';
session_start();

if (isset($_POST['userEmail'])) {
    $objUser = new User;
    $result = $objUser->getUser($_POST['userEmail']);
    $id = $result['ID'];
}
else if(isset($_POST['hardwareID'])) {
    $objHardware = new Hardware;
    $result = $objHardware->getHardware(intval($_POST['hardwareID']));
    $id = $result['hardwareID'];
}

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
</head>
<body>
<header>
    Service Management
</header>
<main>
    <section class="list-data">
        <form action="<?php echo (isset($_POST['hardwareID']))?'updateRow.php':'updateUser.php' ?>" method="post">
            <ul>
                <li>
                    <span class="list-title">ID: </span>
                    <?php echo $id ?>
                    <input type="hidden" name="ID" value="<?php echo $id ?>">
                </li>
                <li>
                    <span class="list-title">Name: </span>
                    <?php echo $result['clientName'];
                        if (isset($_POST['userEmail'])) {
                    ?>
                            <div class="form-group form-update">
                                <input type="text" name="name">
                            </div>
                    <?php
                        }
                    ?>
                </li>
                <li>
                    <span class="list-title">Phone: </span>
                    <?php echo $result['phone'];
                        if (isset($_POST['userEmail'])) {
                    ?>
                        <div class="form-group form-update">
                            <input type="text" name="phone">
                        </div>
                    <?php
                        }
                    ?>
                </li>
                <li>
                    <span class="list-title">Email: </span>
                    <?php echo $result['email']; ?>
                    <input type="hidden" name="email" value="<?php echo $result['email']; ?>">
                </li>
                <?php
                    if (isset($_POST['hardwareID'])) {
                ?>
                        <li>
                            <span class="list-title">Description: </span>
                            <?php echo $result['description']; ?>
                        </li>
                        <li>
                            <span class="list-title">Status: </span>
                            <span class="<?php echo RepairStatus::checkStatus($result['status']); ?>"><?php echo $result['status']; ?></span>
                            <select name="changeRole" class="select-status">
                                <?php
                                $objStatus = new RepairStatus;
                                $statusArr = $objStatus->getStatusArr();
                                foreach ($statusArr as $item) {
                                    $selected = ($result['status'] == $item) ? 'selected' : '';
                                    echo '<option value="' . $item . '" ' . $selected . '> ' . $item . '</option>';
                                }
                                ?>
                            </select>
                        </li>
                        <li>
                            <span class="list-title">Price: </span>
                            <?php echo $result['price'] ?>
                            <div class="form-group form-update">
                                <input type="text" name="changePrice">
                            </div>
                        </li>
                        <li>
                            <span class="list-title">Comments: </span>
                            <div class="form-group form-update">
                                <input type="text" name="comments">
                            </div>
                        </li>
                <?php
                    } else if(isset($_POST['userEmail'])) {
                ?>
                        <li>
                            <span class="list-title">Role: </span>
                            <?php echo $result['role'] ?>
                            <select name="changeRole" id="changeRole" class="select-status">
                                <option value="admin">Admin</option>
                                <option value="client">Client</option>
                            </select>
                        </li>
                        <li>
                            <span class="list-title">New password: </span>
                            <div class="form-group form-update">
                                <input type="password" name="newpassword">
                            </div>
                        </li>
                <?php
                    }
                ?>
                <li>
                    <a href="adminPanel.php" class="btn-main btn-in-update">Back</a>
                    <input type="submit" class="btn-main btn-in-update" name="formUpdate" value="Change">
                </li>
            </ul>

        </form>
    </section>
</main>
</body>
</html>