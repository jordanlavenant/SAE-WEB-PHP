<?php
declare(strict_types=1);

namespace Discographie;
use AllAlbum\DisplayFilteteredAlbums;

class Discographie {

    private array $artistData;

    function __construct(array $data) {    
        $this->artistData = $data;
    }

    function render(): void {
        $displayAlbums = new DisplayFilteteredAlbums($this->artistData);
        echo "<h2>discographie</h2>";
        echo "<section class='discographie'>";
            $displayAlbums->buildAlbums();
        echo "</section>";
    }
}

