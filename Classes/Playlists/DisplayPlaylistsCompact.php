<?php

declare(strict_types=1);

namespace Playlists;

require_once("BD/getBd.php");

class DisplayPlaylistsCompact {

    private array $playlists;

    function __construct(int $idU) {
        $this->playlists = getPlaylistsU($idU);
    }

    function buildPlaylists(): string {
        $html = "";
        foreach ($this->playlists as $p) {
            $html .= "<li><a href='index.php?action=playlist&idP=".$p['idP']."'>".$p['nomP']."</a></li>";
        }
        return $html;        
    }
}