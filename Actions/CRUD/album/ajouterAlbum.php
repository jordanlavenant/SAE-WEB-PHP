<?php

require_once('BD/insertBd.php');
require_once('BD/getBd.php');
session_start();

$by = $_POST['by'];
$title = $_POST['title'];
$parent = $_POST['parent'];
$releaseYear = $_POST['releaseYear'];

if (isset($_FILES["img"]) && $_FILES["img"]["error"] == UPLOAD_ERR_OK) {
    $image_name = $_FILES["img"]["name"];
    $image_temp = $_FILES["img"]["tmp_name"];
    $target_path = "data/images/" . $image_name;

    move_uploaded_file($image_temp, $target_path);
    insererAlbum($by, getLastEntryId() + 1, array(), $image_name, $parent, $releaseYear, $title);
} else {
    insererAlbum($by, getLastEntryId() + 1, array(), "null", $parent, $releaseYear, $title);
}

header("Location: index.php?action=import");        