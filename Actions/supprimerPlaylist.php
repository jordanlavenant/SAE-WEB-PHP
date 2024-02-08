<?php

require_once('BD/deleteBd.php');

$idP = $_REQUEST['idP'];
supprimerPlaylist($idP);

header("Location: index.php?action=bibliotheque");