<?php
declare(strict_types=1);

namespace Discographie;
use AllAlbum\DisplayFilteteredAlbums;

class Discographie {

    private Object $artistData;

    function __construct(Object $data) {    
        $this->artistData = $data;
    }

    function render(): string {
        
    }
}

