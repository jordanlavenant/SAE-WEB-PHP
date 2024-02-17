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
        $theme = $_SESSION['theme'] ?? 'default';
        return sprintf(
            '<aside>
                <section class="header">
                    <a href="index.php?action=home"><img src="static/images/VisualStudioMusicLogo-%s.png" alt="logo"></a>
                    <ul class="menu">
                        <li><a href="index.php?action=home">explorer</a></li>
                        <li><a class="child" href="index.php?action=groupes">artistes x groupes</a></li>
                        <li><a class="child" href="index.php?action=compositeurs">compositeurs</a></li>
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
            $theme,
            $this->displayPlaylists->buildPlaylists()
        );
    }

}
