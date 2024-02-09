<?php

require_once('BD/insertBd.php');
session_start();

$idP = $_REQUEST['idP'];
$entryId = $_REQUEST['entryId'];

removePlaylist($entryId,$idP);

header("Location: index.php?action=album&id=".$entryId."");