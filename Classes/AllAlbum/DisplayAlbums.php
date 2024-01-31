<?php

declare(strict_types=1);

namespace AllAlbum;

class DisplayAlbums {

    private array $data_objects;

    function __construct(array $data_objects) {
        $this->data_objects = $data_objects;
    }

    function buildAlbums() {
        echo "<div class='albums'>";
        foreach($this->data_objects as $album) {
            echo $album->renderCard();
        }
        echo "</div>";
    }
}