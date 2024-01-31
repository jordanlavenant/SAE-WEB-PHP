<?php

declare(strict_types=1);

namespace AllAlbum;

class DisplayFilteteredAlbums {

    private array $data_objects;

    function __construct(array $data_objects) {
        $this->data_objects = $data_objects;
    }

    function buildAlbums() {
        echo "<table>";
            echo "<thead>";
                echo "<tr>";
                    echo "<th>titre</th>";
                    echo "<th>artiste</th>";
                    echo "<th>album</th>";
                    echo "<th>année</th>";   
                echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
                foreach($this->data_objects as $album) {
                    echo $album->renderCompact();
                }
            echo "</tbody>";
        echo "</table>";
    }
}