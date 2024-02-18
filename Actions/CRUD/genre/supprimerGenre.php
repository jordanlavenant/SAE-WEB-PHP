<?php

    require_once('BD/deleteBd.php');

    $genre = $_REQUEST['genre'];

    echo $genre;

    supprimerGenreAlbum($genre);
    supprimerGenre($genre);

    header("Location: index.php?action=genres");
