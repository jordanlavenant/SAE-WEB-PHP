<?php

require_once('BD/deleteBd.php');

$id = $_REQUEST['id'];
supprimerAlbum($id);

header("Location: index.php?action=bibliotheque");