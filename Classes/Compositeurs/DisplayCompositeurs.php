<?php
declare(strict_types=1);

namespace Compositeurs;

require_once('BD/getBd.php');

use AllAlbum\DisplayFilteteredAlbums;

class DisplayCompositeurs {

    private array $artistData;

    function __construct(array $data) {
        $this->artists = getAllArtist();    
        $this->artistData = array();
        foreach($this->artists as $artist) {
            array_push($this->artistData, getAlbumByArtist($artist));
        }
    }

    function render(): void {
        $displayArtists = new DisplayFilteteredAlbums($this->artistData);
        echo "<h2>discographie compositeur</h2>";
        echo "<section class='discographie'>";
            $displayAlbums->buildAlbums();
        echo "</section>";
    }
}

