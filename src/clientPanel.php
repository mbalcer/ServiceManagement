<?php
/**
 * Created by PhpStorm.
 * User: mateusz
 * Date: 06.03.19
 * Time: 19:50
 */

session_start();

if(!isset($_SESSION['clientEmail']))
    header("Location: index.php");

require_once 'DatabaseConnector.php';
require_once 'User.php';
require_once 'Hardware.php';
require_once 'RepairStatus.php';

$client = new User;
$clientData = $client->getUser($_SESSION['clientEmail']);

$hardware = new Hardware;
$hardwareData = $hardware->getHardwareForClientPanel($clientData['ID']);

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
            <ul>
                <h3>Client data: </h3>
                <li>
                    <span class="list-title">Client Name: </span>
                    <?php echo $clientData['clientName']; ?>
                </li>
                <li>
                    <span class="list-title">Phone: </span>
                    <?php echo $clientData['phone']; ?>
                </li>
                <li>
                    <span class="list-title">Email: </span>
                    <?php echo $clientData['email']; ?>
                </li>
            </ul>
    </section>
    <?php foreach ($hardwareData as $repair) { ?>
        <section class="list-data">
            <ul>
                <h3>Repair no. <span style="color: #A8DBA8;"><?php echo $repair['ID']; ?></span></h3>
                <li>
                    <span class="list-title">Description: </span>
                    <?php echo $repair['description']; ?>
                </li>
                <li>
                    <span class="list-title">Status: </span>
                    <span
                        class="<?php echo RepairStatus::checkStatus($repair['status']); ?>"><?php echo $repair['status']; ?></span>
                </li>
                <li>
                    <span class="list-title">Price: </span>
                    <?php echo $repair['price'] ?>
                </li>
            </ul>

            <?php
                $objRepair = new RepairStatus;
                $data = $objRepair->getStatusHistory($repair['ID']);
                if($data == "No status change information")
                    echo '<div class="no-change-info">'.$data.'</div>';
                else {
            ?>
                    <section class="status-table">
                        <table>
                            <thead>
                            <tr>
                                <td>Previous Status</td>
                                <td>Next Status</td>
                                <td>Date</td>
                                <td>Comments</td>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                                foreach ($data as $table) {
                                    echo "<tr><td class='".$objRepair->checkStatus($table['prevStatus'])."'> " . $table['prevStatus'] . "</td>" .
                                        "<td class='".$objRepair->checkStatus($table['nextStatus'])."'>" . $table['nextStatus'] . "</td>" .
                                        "<td>" . $table['date'] . "</td>" .
                                        "<td>" . $table['comments'] . "</td></tr>";
                                }
                            ?>
                            </tbody>
                        </table>
                    </section>
            <?php
                }
            ?>
        </section>
        <?php
    }
    ?>
</main>
</body>
</html>
