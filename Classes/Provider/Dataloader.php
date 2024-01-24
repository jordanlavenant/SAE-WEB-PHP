<?php
declare(strict_types=1);

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
                $string = substr($element[1],2,-3);
                $arrayGenre = explode(",", $string);
                $album[$cle] = $arrayGenre;
            // Transformer les ids en string en intergers
            } else if ($cle == "entryId") {
                $album[$cle] = intval($element[1]);
            } else {
                $album[$cle] = substr($element[1],1,-2);
            }
        }
        fclose($file);
        return $data;
    }
}