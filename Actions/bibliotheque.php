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
        echo "<form action='index.php?action=ajoutPlaylist' method='post'>";
        echo "<input type='text' id='nomP' name='nomP' required>";
        echo "<input type='submit' value='Nouvelle Playlist'>";
        echo "</form>";
        foreach ($playlists as $p) {
            echo "<h2>" . $p[0] . "</h2>";
    
        }
        echo "</main>";
    }
}