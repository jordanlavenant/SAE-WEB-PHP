<!DOCTYPE html>

<html lang="fr">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="static/css/style.css">
        <link rel="icon" href="static/images/VisualStudioMusicLogo2.png" type="image/x-icon">
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
            } else if ($_REQUEST['action'] == "playlist") {
                require 'Actions/playlist.php';
                $playlist = new Playlist($_REQUEST['idP']);
                $playlist->buildPlaylist();
            } else if ($_REQUEST['action'] == "favoris") {
                require 'Actions/favoris.php';
                $favoris = new Favoris();
                $favoris->buildFavoris();
            } else if ($_REQUEST['action'] == "ajoutFavoris") {
                require 'Actions/ajoutFavoris.php';
            } else if ($_REQUEST['action'] == "ajoutPlaylist") {
                require 'Actions/ajoutPlaylist.php';
            } else {
                require 'Actions/home.php';
            }
        ?>
    </body>
</html>