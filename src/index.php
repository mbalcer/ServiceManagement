<?php
    require_once 'DatabaseConnector.php';
    require_once 'User.php';
    session_start();
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

        <section class="customer-table">
            <table>
                <thead>
                <tr>
                    <td>ID</td>
                    <td>Client name</td>
                    <td>Phone</td>
                    <td>Email</td>
                    <td>Description</td>
                    <td>Status</td>
                    <td></td>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>1</td>
                    <td>Andrzej Kowalski</td>
                    <td>789456213</td>
                    <td>andkow@gmail.com</td>
                    <td>Wadliwa płyta główna</td>
                    <td class="status-red">PRZYJĘTO</td>
                    <td>
                        <form action="">
                            <button type="submit" class="btn-table btn-edit icon-pencil"></button>
                            <button type="submit" class="btn-table btn-delete icon-trash-empty"></button>
                        </form>
                    </td>
                </tr>


                <tr>
                    <td>1</td>
                    <td>Andrzej Kowalski</td>
                    <td>789456213</td>
                    <td>andkow@gmail.com</td>
                    <td>Wadliwa płyta główna</td>
                    <td class="status-yellow">W TRAKCIE</td>
                    <td>
                        <form action="">
                            <button type="submit" class="btn-table btn-edit icon-pencil"></button>
                            <button type="submit" class="btn-table btn-delete icon-trash-empty"></button>
                        </form>
                    </td>
                </tr>

                <tr>
                    <td>1</td>
                    <td>Andrzej Kowalski</td>
                    <td>789456213</td>
                    <td>andkow@gmail.com</td>
                    <td>Wadliwa płyta główna</td>
                    <td class="status-green">NAPRAWIONO</td>
                    <td>
                        <form action="">
                            <button type="submit" class="btn-table btn-edit icon-pencil"></button>
                            <button type="submit" class="btn-table btn-delete icon-trash-empty"></button>
                        </form>
                    </td>
                </tr>

                <tr>
                    <td>1</td>
                    <td>Andrzej Kowalski</td>
                    <td>789456213</td>
                    <td>andkow@gmail.com</td>
                    <td>Wadliwa płyta główna</td>
                    <td class="status-red">NIE NAPRAWIONO</td>
                    <td>
                        <form action="">
                            <button type="submit" class="btn-table btn-edit icon-pencil"></button>
                            <button type="submit" class="btn-table btn-delete icon-trash-empty"></button>
                        </form>
                    </td>
                </tr>
                </tbody>
            </table>


        </section>
    </main>
</body>
</html>