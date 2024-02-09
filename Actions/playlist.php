<?php

declare(strict_types=1);

require 'Classes/AsideHome/Aside.php';
require 'Classes/AllAlbum/DisplayFilteteredAlbums.php'; 

require 'Classes/AllAlbum/RenderAlbumInterface.php'; 
require 'Classes/AllAlbum/GenericAlbum.php';
require 'Classes/AllAlbum/Album.php';

require 'BD/getBd.php';

use AsideHome\Aside;
use AllAlbum\DisplayFilteteredAlbums;
use AllAlbum\RenderAlbumInterface;
use AllAlbum\GenericAlbum;
use AllAlbum\Album;

if (!accessPlaylist($_SESSION['idU'],$_REQUEST['idP'])) {
    header('Location: index.php?action=bibliotheque');
    exit();
}

class Playlist {

    private array $playlistProps;
    private array $playlistData;

    function __construct($idP) {
        $this->playlistProps = getPlaylistProps($idP);
        $this->playlistData = array();
        foreach(getEntriesPlaylist($idP) as $entry) {
            $currAlbum = getAlbumWithId($entry['entryId']);
            print_r($currAlbum['genre']);
            array_push($this->playlistData, new Album(
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

    function buildPlaylist() { 

        // Aside 
        $aside = new Aside();
        echo $aside->buildAside();

        echo "<main>
            <div class='header'>
                <a href='index.php?action=bibliotheque'>
                    <svg xmlns='http://www.w3.org/2000/svg' width='48' height='48' viewBox='0 0 24 24' style='fill: rgba(222, 238, 237, 1);transform: ;msFilter:;'><path d='M13.939 4.939 6.879 12l7.06 7.061 2.122-2.122L11.121 12l4.94-4.939z'></path></svg>
                </a>
                <h1>".$this->playlistProps['nomP']."</h1>
            </div>";
            echo "
            <div id='playlist-props'>";
            $size = count($this->playlistData);
            if ($size > 1) echo "<h3>cette playlist contient <span>".$size." </span>albums</h3>";
            else echo "<h3>cette playlist contient <span>".$size." </span>album</h3>"; 
            echo "</div>";
            $albums = new DisplayFilteteredAlbums($this->playlistData);
            echo $albums->buildAlbums();
        echo "</main>";
        
        
    }
}