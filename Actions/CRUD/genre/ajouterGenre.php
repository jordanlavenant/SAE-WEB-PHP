<?php

    require_once('BD/insertBd.php');

    $genre = $_POST['genre'];

    insererGenre($genre);

    header("Location: index.php?action=genres");