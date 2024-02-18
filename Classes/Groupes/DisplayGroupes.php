<?php
declare(strict_types=1);

namespace Groupes;

require_once('BD/getBd.php');

use AllAlbum\DisplayFilteteredAlbums;

class DisplayGroupes {

    private array $artists;

    function __construct(array $data) {
        $this->artists = getAllBy();    
    }

    function render(): void {
        echo "
        <div class='header'>
            <a href='index.php?action=home'>
                <svg xmlns='http://www.w3.org/2000/svg' width='48' height='48' viewBox='0 0 24 24' style='fill: rgba(222, 238, 237, 1);transform: ;msFilter:;'><path d='M13.939 4.939 6.879 12l7.06 7.061 2.122-2.122L11.121 12l4.94-4.939z'></path></svg>
            </a>
            <h1>artistes x groupes</h1>
        </div>
        <div id='groupe-props'>";
                $size = count(getAllBy());
                if ($size == 1) echo "<h3>cette base contient <span>1</span> groupe</h3>";
                else if ($size > 1) echo "<h3>cette base contient <span>".$size."</span> groupes</h3>";
                else echo "<h3>vous cette base ne contient pas de groupe</h3>";
            echo "</div>
        <section class='groupes'>";
            foreach($this->artists as $artist) {
                echo "
                <a class='groupe' href='index.php?action=groupe&by=".$artist['by']."'>
                    <p>".$artist['by']."</p>";
                    $size = count(getAlbumWithBy($artist['by']));
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
