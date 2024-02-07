<?php

require_once('BD/insertBd.php');
session_start();

$idP = $_POST['idP'];
$entryId = $_POST['entryId'];

ajouerALaPlaylist($idP, $entryId);

header("Location: index.php?action=bibliotheque");