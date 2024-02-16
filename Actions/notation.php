<?php

require_once('BD/insertBd.php');
require_once('BD/updateBd.php');
require_once('BD/getBd.php');

session_start();

$idU = $_SESSION['idU'];
$entryId = $_REQUEST['albumId'];
$note = $_REQUEST['note'];

if (getNoteAlbum($idU, $entryId) != null) modifierNoteAlbum($idU, $entryId, $note);
else insererNoteAlbum($idU, $entryId, $note);

header("Location: index.php?action=album&id=".$entryId."");