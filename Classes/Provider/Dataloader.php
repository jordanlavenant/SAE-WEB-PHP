<?php
declare(strict_types=1);

require_once 'vendor/autoload.php';

class Dataloader {

    private $path;

    function __construct(string $path) {
        $this->path = $path;
    }

    function getData() {
        $ymlContent = file_get_contents($this->path);
        $data = Symfony\Component\Yaml\Yaml::parse($ymlContent);
        return $data;
    }
}