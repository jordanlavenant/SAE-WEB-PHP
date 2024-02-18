<?php

require_once('BD/insertBd.php');
require_once('BD/updateBd.php');
require_once('BD/getBd.php');
require_once('BD/deleteBd.php');

session_start();

$idU = $_SESSION['idU'];
$entryId = $_REQUEST['albumId'];
$note = $_REQUEST['note'];
$oldNnote = getNoteAlbum($idU, $entryId);

if ($oldNnote != null) {
    if ($oldNnote['note'] != $note) modifierNoteAlbum($idU, $entryId, $note);
    else supprimerNoteAlbum($idU, $entryId);
}
else insererNoteAlbum($idU, $entryId, $note);

header("Location: index.php?action=album&id=".$entryId."");