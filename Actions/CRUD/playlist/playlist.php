<?php

declare(strict_types=1);

require 'Classes/AsideHome/Aside.php';
require 'Classes/AllAlbum/DisplayFilteteredAlbums.php'; 

require 'Classes/AllAlbum/RenderAlbumInterface.php'; 
require 'Classes/AllAlbum/GenericAlbum.php';
require 'Classes/AllAlbum/Album.php';

require_once('BD/getBd.php');

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

            <script>
                function togglePopup(){
                    let popup = document.querySelector('#popup-overlay');
                    popup.classList.toggle('open');
                }
            </script>

            <div id='popup-overlay' class=''>
                <div class='popup-content'>
                    <h2>voulez-vous vraiment supprimer ".$this->playlistProps['nomP']." ?</h2>
                    <svg href='javascript:void(0)' onclick='togglePopup()' class='popup-exit' xmlns='http://www.w3.org/2000/svg' width='48' height='48' viewBox='0 0 24 24' style='fill: rgba(0, 102, 255, 1);transform: ;msFilter:;'><path d='m16.192 6.344-4.243 4.242-4.242-4.242-1.414 1.414L10.535 12l-4.242 4.242 1.414 1.414 4.242-4.242 4.243 4.242 1.414-1.414L13.364 12l4.242-4.242z'></path></svg>
                    <div class='choices'>
                        <a class='genericButton' href='index.php?action=supprimerPlaylist&idP=".$_REQUEST['idP']."'>supprimer</a>
                        <a class='genericButton' href='index.php?action=playlist&idP=".$_REQUEST['idP']."'>annuler</a>
                    </div>
                </div>
            </div>

            <div class='header-props'>
                <div>
                    <a href='index.php?action=bibliotheque'>
                        <svg xmlns='http://www.w3.org/2000/svg' width='48' height='48' viewBox='0 0 24 24' style='fill: rgba(222, 238, 237, 1);transform: ;msFilter:;'><path d='M13.939 4.939 6.879 12l7.06 7.061 2.122-2.122L11.121 12l4.94-4.939z'></path></svg>
                    </a>
                    <h1>".$this->playlistProps['nomP']."</h1>
                </div>
                <div id='buttonsProps'>
                    <a class='buttons' href='index.php?action=home'>ajouter</a>
                    <a class='buttons' onclick='togglePopup()'>supprimer</a>
                </div>
            </div>";
            echo "
            <div id='playlist-props'>";
                $size = count($this->playlistData);
                if ($size > 1) echo "<h3><span>".$size." </span>albums</h3>";
                else echo "<h3><span>".$size." </span>album</h3>"; 
            echo "</div>";
            $albums = new DisplayFilteteredAlbums($this->playlistData);
            echo $albums->buildAlbums();
        echo "</main>";
        
        
    }
}