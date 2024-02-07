<?php

require_once('BD/insertBd.php');
session_start();

$nomP = $_POST['nomP'];
$idU = $_SESSION['idU'];

nouvellePlaylist($nomP, $idU);

header("Location: index.php?action=bibliotheque");