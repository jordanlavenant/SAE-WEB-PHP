<?php
declare(strict_types=1);

namespace Compositeur;

require_once("BD/getBd.php");

require 'Classes/AllAlbum/DisplayFilteteredAlbums.php';
require 'Classes/AllAlbum/RenderAlbumInterface.php';
require 'Classes/AllAlbum/GenericAlbum.php';
require 'Classes/AllAlbum/Album.php';

use AllAlbum\RenderAlbumInterface;
use AllAlbum\DisplayFilteteredAlbums;
use AllAlbum\GenericAlbum;
use AllAlbum\Album;

class DisplayCompositeur {

    private array $artistData;

    function __construct(string $parent) {    
        $this->artistData = getAlbumWithParent($parent);
        // Transformer les données en objet Album
        $this->artistData = array_map(function($content) {
            return new Album(
                $content['by'],
                $content['entryId'],
                $content['genre'] == null ? array() : $content['genre'],
                $content['img'] == "null" ? "default.jpg" : $content['img'],
                $content['parent'],
                $content['releaseYear'],
                $content['title']
            );
        }, $this->artistData);
    }

    function render(): void {
        $displayAlbums = new DisplayFilteteredAlbums($this->artistData);
        echo "<section class='compositeur-album'>
            <div id='compositeur-props'>";
                $size = count($this->artistData);
                if ($size > 1) echo "<h3>ce compositeur a contribué à <span>".$size." </span>albums</h3>";
                else echo "<h3>ce compositeur a contribué à <span>".$size." </span>album</h3>"; 
            echo "</div>";
            $displayAlbums->buildAlbums();
        echo "</section>";
    }
}

