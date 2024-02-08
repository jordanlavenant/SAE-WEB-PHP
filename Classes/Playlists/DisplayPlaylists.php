<?php

declare(strict_types=1);

namespace Playlists;

require_once("BD/getBd.php");

class DisplayPlaylists {

    private array $playlists;

    function __construct(int $idU) {
        $this->playlists = getPlaylistsU($idU);
    }

    function buildPlaylists() {
        foreach($this->playlists as $p) {
            print_r($p);
        }
    }
}