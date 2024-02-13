<?php
declare(strict_types=1);

namespace Favoris;

require 'Classes/AllAlbum/DisplayFilteteredAlbums.php';
use AllAlbum\DisplayFilteteredAlbums;

class DisplayFavoris {

    private array $favoritesData;

    function __construct(array $data) {    
        $this->favoritesData = $data;
    }

    function render(): void {
        $displayAlbums = new DisplayFilteteredAlbums($this->favoritesData);
        echo "<section class='favoris'>";
            $displayAlbums->buildAlbums();
        echo "</section>";
    }
}

