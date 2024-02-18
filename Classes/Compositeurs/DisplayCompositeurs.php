<?php
declare(strict_types=1);

namespace Compositeurs;

require_once('BD/getBd.php');

use AllAlbum\DisplayFilteteredAlbums;

class DisplayCompositeurs {

    private array $artists;

    function __construct(array $data) {
        $this->artists = getAllArtist();    
    }

    function render(): void {
        echo "
        <div class='header'>
            <a href='index.php?action=home'>
                <svg xmlns='http://www.w3.org/2000/svg' width='48' height='48' viewBox='0 0 24 24' style='fill: rgba(222, 238, 237, 1);transform: ;msFilter:;'><path d='M13.939 4.939 6.879 12l7.06 7.061 2.122-2.122L11.121 12l4.94-4.939z'></path></svg>
            </a>
            <h1>compositeurs</h1>
        </div>
        <div id='compositeur-props'>";
                $size = count(getAllArtist());
                if ($size == 1) echo "<h3>cette base contient <span>1</span> compositeur</h3>";
                else if ($size > 1) echo "<h3>cette base contient <span>".$size."</span> compositeurs</h3>";
                else echo "<h3>vous cette base ne contient pas de compositeur</h3>";
            echo "</div>
        <section class='compositeurs'>";
            foreach($this->artists as $artist) {
                echo "
                <a class='compositeur' href='index.php?action=compositeur&parent=".$artist['parent']."'>
                    <p>".$artist['parent']."</p>";
                    $size = count(getAlbumWithParent($artist['parent']));
                    if ($size > 1) {
                        echo "<p id='countProps'>".$size." albums</p>";
                    } else {
                        echo "<p id='countProps'>".$size." album</p>";
                    }
                echo "</a>";
            }
        echo "</section>";
        
    }
}
