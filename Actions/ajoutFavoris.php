<?php

require_once('BD/insertBd.php');
require_once('BD/deleteBd.php');
require_once('BD/getBd.php');
session_start();
$entryId = $_REQUEST['id'];
$idU = $_SESSION['idU'];
if (in_array($entryId, getFavoriU($idU))){
    retirerFavori($idU, $entryId);
} else {
    ajouterFavori($idU, $entryId);
}

header("Location: index.php?action=album&id=".$entryId);