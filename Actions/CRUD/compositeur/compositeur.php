<?php
declare(strict_types=1);

require_once('BD/getBd.php');


require 'Classes/AsideHome/Aside.php';
require 'Classes/Compositeurs/DisplayCompositeur.php';

use AsideHome\Aside;
use Compositeur\DisplayCompositeur;

class Compositeur {

    private string $artist;
    private array $artistData;

    function __construct(string $artist) {
        $this->artist = $artist;
    }

    function buildCompositeur(): void {

        $aside = new Aside();
        echo $aside->buildAside();

        echo "
        <main>
            <div class='header'>
                <a href='index.php?action=compositeurs'>
                    <svg xmlns='http://www.w3.org/2000/svg' width='48' height='48' viewBox='0 0 24 24' style='fill: rgba(222, 238, 237, 1);transform: ;msFilter:;'><path d='M13.939 4.939 6.879 12l7.06 7.061 2.122-2.122L11.121 12l4.94-4.939z'></path></svg>
                </a>
                <h1>".$this->artist."</h1>
            </div>";
            $displayCompositeur = new DisplayCompositeur($this->artist);
            $displayCompositeur->render();
        echo "
        </main>";
        
    }
}