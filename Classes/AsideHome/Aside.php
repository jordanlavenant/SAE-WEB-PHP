<?php

declare(strict_types=1);

namespace AsideHome;

require 'Classes/Playlists/DisplayPlaylistsCompact.php';
use Playlists\DisplayPlaylistsCompact;

class Aside {

    private Object $displayPlaylists;

    function __construct() {
        $this->displayPlaylists = new DisplayPlaylistsCompact($_SESSION['idU']);
    }

    function buildAside() {
        return sprintf(
            '<aside>
                <section class="header">
                    <a href="index.php?action=home"><img src="static/images/VisualStudioMusicLogo2.png" alt="logo"></a>
                    <ul class="menu">
                        <li><a href="index.php?action=home">accueil</a></li>
                        <li><a href="index.php?action=bibliotheque">bibliothèque</a></li>
                        <li><a href="index.php?action=favoris">favoris</a></li>
                        <li><a href="index.php?action=import">importer</a></li>
                        <li><a href="index.php?action=configuration">configuration</a></li>
                    </ul>

                    <ul class="playlists-aside">
                        %s
                    </ul>
                </section>
                <a href="index.php?action=login">se déconnecter</a>
            </aside>',
            $this->displayPlaylists->buildPlaylists(),
        );
    }

}