<!DOCTYPE html>

<html lang="fr">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="static/css/style.css">
        <title>Spotiut'O</title>
    </head>
    <body>
        <?php

            if ($_REQUEST['action'] == null || $_REQUEST['action'] == "login") {
                require 'Actions/login.php';
                $login = new Login();
                $login->buildLogin();
            } else if ($_REQUEST['action'] == "register") {
                require 'Actions/register.php';
                $register = new Register();
                $register->buildRegister();
            } else {
                require 'Actions/home.php';
            }
        ?>
    </body>
</html>