<?php

declare(strict_types=1);

require 'Classes/AsideHome/Aside.php';
require 'BD/getBd.php';
session_start();
use AsideHome\Aside;

class Bibliotheque {

    function buildBibliotheque() {
        $idU = $_SESSION['idU'];
        $playlists = getPlaylistsU($idU);
        // print_r($playlists[0]);

        // Aside 
        $aside = new Aside();
        echo $aside->buildAside();

        echo "<main>
            <div class='header'>
                <a href='index.php?action=home'>
                    <svg xmlns='http://www.w3.org/2000/svg' width='48' height='48' viewBox='0 0 24 24' style='fill: rgba(222, 238, 237, 1);transform: ;msFilter:;'><path d='M13.939 4.939 6.879 12l7.06 7.061 2.122-2.122L11.121 12l4.94-4.939z'></path></svg>
                </a>
                <h1>bibliothèque</h1>
            </div>";
        echo "
            <form action='index.php?action=ajoutPlaylist' method='post'>
                <input type='text' id='nomP' name='nomP' required/>
                <input type='submit' value='Nouvelle Playlist'/>
            </form>";
        echo "<section class='playlist-container'>";
            foreach ($playlists as $p) {
                echo "
                <a class='playlist-content' href=index.php?action=playlist&idP=" . $p['idP'] . ">
                    <p>". $p['nomP'] ."</p>
                </a>
                <a href=index.php?action=supprimerPlaylist&idP=" . $p['idP'] . ">
                    <svg xmlns='http://www.w3.org/2000/svg' width='48' height='48' viewBox='0 0 24 24' style='fill: rgba(0, 102, 255, 1);transform: rotate(90deg);msFilter:progid:DXImageTransform.Microsoft.BasicImage(rotation=1);'><path d='M9.172 16.242 12 13.414l2.828 2.828 1.414-1.414L13.414 12l2.828-2.828-1.414-1.414L12 10.586 9.172 7.758 7.758 9.172 10.586 12l-2.828 2.828z></path><path d='M12 22c5.514 0 10-4.486 10-10S17.514 2 12 2 2 6.486 2 12s4.486 10 10 10zm0-18c4.411 0 8 3.589 8 8s-3.589 8-8 8-8-3.589-8-8 3.589-8 8-8z'></path></svg>
                </a>
                ";
            }
            echo "</section>";  
        echo "</main>";
    }
}