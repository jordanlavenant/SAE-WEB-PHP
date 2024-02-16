<?php
declare(strict_types=1);
require_once("BD/getBd.php");
require_once("BD/insertBd.php");

class Dataloader {

    private $path;

    function __construct(string $path) {
        $this->path = $path;
    }

    function getData() {
        $file = fopen($this->path, 'r');
        $data = array();
        $album = array();

        while (($line = fgets($file)) !== false) {
            $element = explode(':', $line, 2);
            if ($element[0] == "- by") {
                if (!empty($album)) {
                    $data[] = $album;
                    $album = array();
                }
            }
            $cle = substr($element[0],2);

            // Transformer les strings en array pour les genres
            if ($cle == "genre") {
                $string = substr(trim($element[1]),1,-1);
                $arrayGenre = explode(",", $string);
                $album[$cle] = $arrayGenre;
            // Transformer les ids en string en intergers
            } else if ($cle == "entryId") {
                $album[$cle] = intval($element[1]);
            // Transformer les releaseYear en string en intergers
            } else if ($cle == "releaseYear") {
                $album[$cle] = intval($element[1]);
            } else if ($cle == "img") {
                $album[$cle] = substr($element[1],1,-2);
            } else {
                $album[$cle] = substr($element[1],1,-1);
            }
        }
        fclose($file);
        return $data;
    }

    function getDataBd(){
        return getAlbums();
    }

    function insererData(){
        $data = $this->getData();
        foreach ($data as $donnee){
            $by = $donnee['by'];
            $entryId = $donnee['entryId'];
            $genre = $donnee['genre'];
            $img_path = $donnee['img'];
            $img_content = file_get_contents($img_path);
            $img = base64_encode($img_content);
            $parent = $donnee['parent'];
            $releaseYear = $donnee['releaseYear'];
            $title = $donnee['title'];
            insererAlbum($by, $entryId, $genre, $img, $parent, $releaseYear, $title);
        }
    }
}