<?php

declare(strict_types=1);

require 'Classes/AsideHome/Aside.php';
require 'Classes/Favoris/DisplayFavoris.php'; 

require 'Classes/AllAlbum/RenderAlbumInterface.php'; 
require 'Classes/AllAlbum/GenericAlbum.php';
require 'Classes/AllAlbum/Album.php';

require_once('BD/getBd.php');

use AsideHome\Aside;
use Favoris\DisplayFavoris;
use AllAlbum\RenderAlbumInterface;
use AllAlbum\GenericAlbum;
use AllAlbum\Album;

class Favoris {

    private array $favorites;
    private array $favoritesData;

    public function __construct() {
        $this->favorites = getFavoriU($_SESSION['idU']);
        $this->favoritesData = array();
        foreach($this->favorites as $entry) {
            $currAlbum = getAlbumWithId($entry);
            array_push($this->favoritesData, new Album(
                $currAlbum['by'],
                $currAlbum['entryId'],
                array(),
                $currAlbum['img'] == "null" ? "default.jpg" : $currAlbum['img'],
                $currAlbum['parent'],
                $currAlbum['releaseYear'],
                $currAlbum['title']
            ));
        }
    }

    function buildFavoris() { 

        // Aside 
        $aside = new Aside();
        echo $aside->buildAside();

        echo "<main>
            <div class='header-props'>
                <div>
                    <a href='index.php?action=home'>
                        <svg xmlns='http://www.w3.org/2000/svg' width='48' height='48' viewBox='0 0 24 24' style='fill: rgba(222, 238, 237, 1);transform: ;msFilter:;'><path d='M13.939 4.939 6.879 12l7.06 7.061 2.122-2.122L11.121 12l4.94-4.939z'></path></svg>
                    </a>
                    <h1>favoris</h1>
                </div>
                <a href='index.php?action=home' class='genericButton'>ajouter</a>
            </div>";
            echo "<div id='favoris-props'>";
                $size = count($this->favoritesData);
                if ($size == 1) echo "<h3><span>1</span> favori</h3>";
                else if ($size > 1) echo "<h3><span>".$size."</span> favoris</h3>";
                else echo "<h3>pas de favoris</h3>";
            echo "</div>";
            $displayFavoris = new DisplayFavoris($this->favoritesData);
            echo $displayFavoris->render();
        echo "</main>";
    }
}