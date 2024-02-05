<?php
declare(strict_types=1);

namespace Discographie;
use AllAlbum\DisplayFilteteredAlbums;

class Discographie {

    private array $artistData;

    function __construct(array $data) {    
        $this->artistData = $data;
    }

    function render(): string {
        $displayAlbums = new DisplayFilteteredAlbums($this->artistData);
        return $displayAlbums->buildAlbums();
    }
}

