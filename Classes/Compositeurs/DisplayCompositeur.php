<?php
declare(strict_types=1);

namespace Compositeur;

require_once("BD/getBd.php");

use AllAlbum\DisplayFilteteredAlbums;

class DisplayCompositeur {

    private array $artistData;

    function __construct($parent) {    
        $this->artistData = getAlbumWithParent($parent);
    }

    function render(): void {
        $displayAlbums = new DisplayFilteteredAlbums($this->artistData);
        echo "<h2>discographie compositeur</h2>";
        echo "<section class='discographie'>";
            $displayAlbums->buildAlbums();
        echo "</section>";
    }
}

