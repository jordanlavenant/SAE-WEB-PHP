<?php
declare(strict_types=1);

namespace Discographie;
use AllAlbum\DisplayFilteteredAlbums;

class DiscographieGroupe {

    private array $groupeData;

    function __construct(array $data) {    
        $this->groupeData = $data;
    }

    function render(): void {
        $displayAlbums = new DisplayFilteteredAlbums($this->groupeData);
        echo "<h2>discographie du groupe</h2>";
        echo "<section class='discographie'>";
            $displayAlbums->buildAlbums();
        echo "</section>";
    }
}

