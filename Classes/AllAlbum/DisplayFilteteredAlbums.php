<?php

declare(strict_types=1);

namespace AllAlbum;

class DisplayFilteteredAlbums {

    private array $data_objects;

    function __construct(array $data_objects) {
        $this->data_objects = $data_objects;
    }

    function buildAlbums() {
        echo "
        <table>
            <thead>
                <tr>
                    <th>titre</th>
                    <th>artiste / groupe</th>
                    <th>compositeur</th>
                    <th>année</th>
                </tr>
            </thead>
            <tbody>";
                foreach($this->data_objects as $album) {
                    echo $album->renderCompact();
                }
            echo "
            </tbody>
       </table>";
    }
}