<?php
declare(strict_types=1);

class Dataloader {

    private $path;

    function __construct(string $path) {
        $this->path = $path;
    }

    function getData() {

        $album = array();
        $data = array();

        $file = fopen($this->path, "r");         
        while (($line = fgets($file)) !== false) {
            $parts = explode(":", $line,2);
            if ($parts[0] == '- by') {
                if (!empty($album)) {
                    $data[] = $album;
                    $album = array();
                }
            }
            $album[] = $parts[1];
        }
        fclose($file);
        return $data;
    }
}