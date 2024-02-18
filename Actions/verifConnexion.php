<?php 

require_once('BD/getBd.php');
require_once('Classes/Themes/UpdateTheme.php');

if (isset($_POST['email']) && isset($_POST['password'])) {
    if (!verifLogin($_POST['email'], $_POST['password'])) {
        $_SESSION['erreur'] = "email ou mot de passe incorrect";
        header('Location: index.php?action=login');
        exit();
    } else {
        $_SESSION['idU'] = getIdUser($_POST['email']);
        $_SESSION['nomU'] = getNomUser($_POST['email']);
        $_SESSION['prenomU'] = getPrenomUser($_POST['email']);
        $_SESSION['theme'] = getThemeUser($_SESSION['idU'])['theme'];
        $_SESSION['hexa'] = getThemeHexa($_SESSION['theme']);
        header('Location: index.php?action=home');
    }
}