<?php
// 
    // require_once('BD/updateBd.php');
    // require_once('BD/getBd.php');

    // session_start();

    // $entryId = $_REQUEST['id'];
    // $idU = $_SESSION['idU'];
    // if (in_array($entryId, getAlbumWithId($entryId))){ //vaut tsans doute mieux utiliser getAlbumWithId
    //     echo "L'album existe";
    //     modifierAlbum($entryId,$_POST['title'],$_POST['by'],$_POST['parent'],$_POST['releaseYear'],$_POST['genre']);
    // }
    // else {
    //     echo "L'album n'existe pas";

    // }

require_once('BD/updateBd.php');
require_once('BD/getBd.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérifier si le fichier a été correctement téléchargé
    if (isset($_FILES["image"]) && $_FILES["image"]["error"] == UPLOAD_ERR_OK) {
        $image_name = $_FILES["image"]["name"];
        $image_temp = $_FILES["image"]["tmp_name"];
        
        // Déplacer le fichier téléchargé vers le dossier spécifié
        $target_path = "data/images/" . $image_name;
        move_uploaded_file($image_temp, $target_path);
    }
    modifierAlbum($entryId, $_POST['title'], $_POST['by'], $_POST['parent'], $_POST['releaseYear'], $_POST['genre'], $image_name);
}

header("Location: index.php?action=album&id=".$entryId);
