<!DOCTYPE html>

<html lang="fr">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="static/css/style.css">
        <link rel="icon" href="static/images/VisualStudioMusicLogo.png" type="image/x-icon">
        <title>Visual Studio Music</title>
    </head>
    <body>
        <?php

            error_reporting(E_ERROR | E_PARSE);
            session_start();


            if ($_REQUEST['action'] == null || $_REQUEST['action'] == "login") {
                require 'Actions/login.php';
                $login = new Login();
                $login->buildLogin();
            } else if ($_REQUEST['action'] == "register") {
                require 'Actions/register.php';
                $register = new Register();
                $register->buildRegister();
            } else if ($_REQUEST['action'] == "bibliotheque") {
                require 'Actions/bibliotheque.php';
                $bibliotheque = new Bibliotheque();
                $bibliotheque->buildBibliotheque();
            } else {
                require 'Actions/home.php';
            }
        ?>
    </body>
</html>