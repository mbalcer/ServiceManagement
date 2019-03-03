<?php
require_once 'DatabaseConnector.php';
require_once 'Hardware.php';
session_start();

$objHardware = new Hardware;
$result = $objHardware->getHardware(intval($_POST['id']));
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
        <form action="updateRow.php" method="post">
            <ul>
                <li>
                    <span class="list-title">ID: </span>
                    <?php echo $result['hardwareID']; ?>
                    <input type="hidden" name="hardwareID" value="<?php echo $result['hardwareID']; ?>">
                </li>
                <li>
                    <span class="list-title">Client Name: </span>
                    <?php echo $result['clientName']; ?>
                </li>
                <li>
                    <span class="list-title">Phone: </span>
                    <?php echo $result['phone']; ?>
                </li>
                <li>
                    <span class="list-title">Email: </span>
                    <?php echo $result['email']; ?>
                </li>
                <li>
                    <span class="list-title">Description: </span>
                    <?php echo $result['description']; ?>
                </li>
                <li>
                    <span class="list-title">Status: </span>
                    <span class="<?php echo $objHardware->checkStatus($result['status']); ?>"><?php echo $result['status']; ?></span>
                    <select name="changeStatus" class="select-status" >
                        <option value="Adopted" <?php if($result['status']=="Adopted") echo "selected"; ?>>Adopted</option>
                        <option value="During repair" <?php if($result['status']=="During repair") echo "selected"; ?>>During repair</option>
                        <option value="Repaired" <?php if($result['status']=="Repaired") echo "selected"; ?>>Repaired</option>
                        <option value="Not repaired" <?php if($result['status']=="Not repaired") echo "selected"; ?>>Not repaired</option>
                        <option value="Received" <?php if($result['status']=="Received") echo "selected"; ?>>Received</option>
                    </select>
                </li>
                <li>
                    <span class="list-title">Price: </span>
                    <?php echo $result['price'] ?>
                    <div class="form-group">
                        <input type="text" name="changePrice">
                    </div>
                </li>
                <li>
                    <span class="list-title">Comments: </span>
                    <div class="form-group">
                        <input type="text" name="comments">
                    </div>
                </li>
                <li>
                    <a href="index.php" class="btn-main btn-in-update"><- Back</a>
                    <input type="submit" class="btn-main btn-in-update" name="formUpdate" value="Change">
                </li>
            </ul>

        </form>
    </section>
</main>
</body>
</html>