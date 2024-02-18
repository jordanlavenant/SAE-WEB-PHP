<?php

    require_once('BD/updateBd.php');

    $idG = $_REQUEST['genre'];
    $newGenre = $_POST['newGenre'];

    echo $idG;
    echo $newGenre;

    modifierGenre($idG, $newGenre);

    header("Location: index.php?action=genres");
