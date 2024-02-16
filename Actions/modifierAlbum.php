<?php

    require_once('BD/updateBd.php');
    require_once('BD/getBd.php');

    session_start();

    $entryId = $_REQUEST['id'];
    $idU = $_SESSION['idU'];

    if (in_array($entryId, getAlbumWithId($entryId))) {
        echo "L'album existe";

        if (isset($_FILES['imageUpload'])) {
            $image = $_FILES['imageUpload'];
            $imgName = basename($image['name']);
            $imgPath = 'static/folder/' . $imgName;

            if (move_uploaded_file($image['tmp_name'], $imgPath)) {
                echo "Upload réussi";
            } else {
                echo "Erreur lors de l'upload de l'image";
            }
        } else {
            $imgName = pathinfo($_POST['hiddenImagePath'], PATHINFO_FILENAME);
            $imgPath = $_POST['hiddenImagePath'];
        }

        modifierAlbum($entryId, $_POST['title'], $_POST['by'], $_POST['parent'], $_POST['releaseYear'], $_POST['genre'], $imgName);
    } else {
        echo "L'album n'existe pas";
    }

    header("Location: index.php?action=album&id=" . $entryId);
?>