<?php

require_once('BD/insertBd.php');
require_once('BD/getBd.php');
session_start();

$by = $_POST['by'];
$title = $_POST['title'];
$parent = $_POST['parent'];

if($_POST['img'] != "") {
    $img = $_POST['img'];
} else {
    $img = "null";
}

$releaseYear = $_POST['releaseYear'];

insererAlbum($by, getLastEntryId() + 1, array(), $img, $parent, $releaseYear, $title);

header("Location: index.php?action=import");