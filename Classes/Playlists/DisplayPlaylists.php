<?php

declare(strict_types=1);

namespace Playlists;

require_once("BD/getBd.php");

class DisplayPlaylists {

    private array $playlists;
    private int $entryId;

    function __construct(int $idU, int $entryId) {
        $this->playlists = getPlaylistsU($idU);
        $this->entryId = $entryId;
    }

    function buildPlaylists(): string {
        $html = "<div class='playlists-list'>";
        foreach ($this->playlists as $p) {
            if (inPlaylist($this->entryId, $p['idP'])) {
                $html .= "<a class='playlist' style='background-color: #0066ff;' href='index.php?action=retirerAlbumPlaylist&idP=".$p['idP']."&entryId=".$this->entryId."'>";
            } else {
                $html .= "<a class='playlist' style='background-color: transparent;' href='index.php?action=ajoutAlbumPlaylist&idP=".$p['idP']."&entryId=".$this->entryId."'>";
            }
                $html .= "<p>".$p['nomP']."</p>";
            $html .= "</a>";
        }
        $html .= "</div>";

        return $html;
    }
}