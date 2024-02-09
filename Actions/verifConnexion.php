<?php 

require_once('BD/getBd.php');

if (isset($_POST['email']) && isset($_POST['password'])) {
    if (!verifLogin($_POST['email'], $_POST['password'])) {
        header('Location: index.php?action=login');
        exit();
    } else {
        $_SESSION['idU'] = getIdUser($_POST['email']);
        $_SESSION['nomU'] = getNomUser($_POST['email']);
        header('Location: index.php?action=home');
    }
}