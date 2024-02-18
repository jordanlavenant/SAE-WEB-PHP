<?php

    require_once('BD/deleteBd.php');
    require_once('BD/insertBd.php');

    $entryId = $_REQUEST['id'];
    $genres = $_POST['genre'];

    supprimerGenres($entryId);

    foreach ($genres as $genre){
        insererGenresAlbum($entryId,$genre);
    }

    header("Location: index.php?action=edit&id=".$entryId);
