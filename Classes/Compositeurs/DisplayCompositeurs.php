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
        // foreach($this->artists as $artist) {
        //     array_push($this->artistData, getAlbumByArtist($artist));
        // }
    }

    function render(): void {
        echo "
        <div class='header'>
            <a href='index.php?action=home'>
                <svg xmlns='http://www.w3.org/2000/svg' width='48' height='48' viewBox='0 0 24 24' style='fill: rgba(222, 238, 237, 1);transform: ;msFilter:;'><path d='M13.939 4.939 6.879 12l7.06 7.061 2.122-2.122L11.121 12l4.94-4.939z'></path></svg>
            </a>
            <h1>compositeurs</h1>
        </div>
        <section class='compositeurs'>
            
        </section>
        ";
        
    }
}