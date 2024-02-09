<?php

require_once('BD/updateBd.php');
require_once('BD/getBd.php');

session_start();

$entryId = $_REQUEST['id'];
$idU = $_SESSION['idU'];
if (in_array($entryId, getAlbumWithId($entryId))){ //vaut tsans doute mieux utiliser getAlbumWithId
    echo "L'album existe";
    modifierAlbum($entryId,$_POST['title'],$_POST['by'],$_POST['parent'],$_POST['releaseYear'],$_POST['genre']);
}
else {
    echo "L'album n'existe pas";

}
header("Location: index.php?action=album&id=".$entryId);

?>