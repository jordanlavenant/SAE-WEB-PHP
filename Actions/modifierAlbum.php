<?php

    require_once('BD/updateBd.php');
    require_once('BD/getBd.php');

    $entryId = $_REQUEST['id'];

    // print_r($_FILES);

    if (isset($_FILES["image"]) && $_FILES["image"]["error"] == UPLOAD_ERR_OK) {
        $image_name = $_FILES["image"]["name"];
        $image_temp = $_FILES["image"]["tmp_name"];
        // Déplacer le fichier téléchargé vers le dossier spécifié
        $target_path = "data/images/" . $image_name;
        // echo $target_path;

        move_uploaded_file($image_temp, $target_path);
        modifierAlbumImg($entryId, $_POST['title'], $_POST['by'], $_POST['parent'], $_POST['releaseYear'], $_POST['genre'], $image_name);
    } else {
        echo "no image uploaded";
        modifierAlbumWithoutImg($entryId, $_POST['title'], $_POST['by'], $_POST['parent'], $_POST['releaseYear'], $_POST['genre']);
    }

    header("Location: index.php?action=album&id=".$entryId);
