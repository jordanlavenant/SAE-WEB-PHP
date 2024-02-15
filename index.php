<?php
    error_reporting(E_ERROR | E_PARSE);
    session_start();

    $_SESSION['theme'] = $_SESSION['theme'] ?? "bleu";
?>


<!DOCTYPE html>

<html lang="fr">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="static/css/style.css">
        <link rel="icon" href="static/images/VisualStudioMusicLogo2.png" type="image/x-icon">
        <title>Visual Studio Music</title>
    </head>
    <body class='theme-<?php echo $_SESSION['theme']; ?>'>

        <?php

            error_reporting(E_ERROR | E_PARSE);
            session_start();

            if (!isset($_SESSION['idU'])
                    && $_REQUEST['action'] != 'login'
                    && $_REQUEST['action'] != 'register'
                    && $_REQUEST['action'] != 'verifConnexion') {
                header('Location: index.php?action=login');
            }
                    
            switch ($_REQUEST['action']) {
                case null:
                    require 'Actions/login.php';
                    $login = new Login();
                    $login->buildLogin();
                    break;
                case "login":
                    require 'Actions/login.php';
                    $login = new Login();
                    $login->buildLogin();
                    break;
                case "register":
                    require 'Actions/register.php';
                    $register = new Register();
                    $register->buildRegister();
                    break;
                case "verifConnexion":
                    require 'Actions/verifConnexion.php';
                    break;
                case "bibliotheque":
                    require 'Actions/bibliotheque.php';
                    $bibliotheque = new Bibliotheque();
                    $bibliotheque->buildBibliotheque();
                    break;
                case "playlist":
                    require 'Actions/playlist.php';
                    $playlist = new Playlist($_REQUEST['idP']);
                    $playlist->buildPlaylist();
                    break;
                case "favoris":
                    require 'Actions/favoris.php';
                    $favoris = new Favoris();
                    $favoris->buildFavoris();
                    break;
                case "ajoutFavoris":
                    require 'Actions/ajoutFavoris.php';
                    break;
                case "ajoutPlaylist":
                    require 'Actions/ajoutPlaylist.php';
                    break;
                case "supprimerPlaylist":
                    require 'Actions/supprimerPlaylist.php';
                    break;
                case "ajoutAlbumPlaylist":
                    require 'Actions/ajoutAlbumPlaylist.php';
                    break;
                case "retirerAlbumPlaylist":
                    require 'Actions/retirerAlbumPlaylist.php';
                    break;
                case "modifierAlbum":
                    require 'Actions/modifierAlbum.php';
                    break;
                case "import":
                    require 'Actions/importData.php';
                    $import = new ImportData();
                    $import->buildImportData();
                    break;
                case "ajouterAlbum":
                    require 'Actions/ajouterAlbum.php';
                    break;
                case "supprimerAlbum":
                    require 'Actions/supprimerAlbum.php';
                    break;
                case "import":
                    require 'Actions/importData.php';
                    $import = new ImportData();
                    $import->buildImportData();
                    break;
                case "ajouterAlbum":
                    require 'Actions/ajouterAlbum.php';
                    break;
                case "configuration":
                    require 'Actions/configuration.php';
                    $configuration = new Configuration();
                    $configuration->buildPlaylist();
                    break;
                default:
                    require 'Actions/home.php';
            }
        ?>
    </body>
</html>