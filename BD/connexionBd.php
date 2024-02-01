<?php
function getConnexion(){
    $dbPath = 'BD/bd.sqlite';
    $file_db = new PDO('sqlite:' . $dbPath);
    $file_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $file_db;
}