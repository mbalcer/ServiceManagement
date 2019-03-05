<!doctype html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Service Management</title>
    <link rel="stylesheet" href="css/loginPanel.css">
    <link rel="stylesheet" href="css/fontello.css">
</head>
<body>
    <header>
        Service Management
    </header>
    <main>
        <form action="login.php" method="post">
            <div class="field">
                <label for="email">Email</label>
                <input type="text" name="email" class="field-input">
            </div>
            <div class="field">
                <label for="password">Password</label>
                <input type="password" name="password" class="field-input">
            </div>
            <div class="field">
                <input type="submit" value="Login" name="login" class="btn-main">
            </div>
        </form>
    </main>
</body>
</html>