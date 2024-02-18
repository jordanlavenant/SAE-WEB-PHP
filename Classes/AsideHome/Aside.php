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
        echo '
        <aside>
            <section class="header">
                <a href="index.php?action=home"><img src="static/images/VisualStudioMusicLogo-'.$theme.'.png" alt="logo"></a>
                <ul class="menu">';
                    if ($_REQUEST['action'] == 'home') {
                        echo '<li><a class="current" href="index.php?action=home">explorer</a></li>';
                    } else {
                        echo '<li><a href="index.php?action=home">explorer</a></li>';
                    }
                    if ($_REQUEST['action'] == 'groupes' || $_REQUEST['action'] == 'groupe') {
                        echo '<li><a class="child current" href="index.php?action=groupes">artistes x groupes</a></li>';
                    } else {
                        echo '<li><a class="child" href="index.php?action=groupes">artistes x groupes</a></li>';
                    }
                    if ($_REQUEST['action'] == 'compositeurs' || $_REQUEST['action'] == 'compositeur') {
                        echo '<li><a class="child current" href="index.php?action=compositeurs">compositeurs</a></li>';
                    } else {
                        echo '<li><a class="child" href="index.php?action=compositeurs">compositeurs</a></li>';
                    }
                    if ($_REQUEST['action'] == 'bibliotheque' || $_REQUEST['action'] == 'playlist') {
                        echo '<li><a class="current" href="index.php?action=bibliotheque">bibliothèque</a></li>';
                    } else {
                        echo '<li><a href="index.php?action=bibliotheque">bibliothèque</a></li>';
                    }
                    if ($_REQUEST['action'] == 'favoris') {
                        echo '<li><a class="current" href="index.php?action=favoris">favoris</a></li>';
                    } else {
                        echo '<li><a href="index.php?action=favoris">favoris</a></li>';
                    }
                    if ($_REQUEST['action'] == 'import') {
                        echo '<li><a class="current" href="index.php?action=import">importer</a></li>';
                    } else {
                        echo '<li><a href="index.php?action=import">importer</a></li>';
                    }
                    if ($_REQUEST['action'] == 'genres') {
                        echo '<li><a class="current" href="index.php?action=genres">genres</a></li>';
                    } else {
                        echo '<li><a href="index.php?action=genres">genres</a></li>';
                    }
                    if ($_REQUEST['action'] == 'configuration') {
                        echo '<li><a class="current" href="index.php?action=configuration">configuration</a></li>';
                    } else {
                        echo '<li><a href="index.php?action=configuration">configuration</a></li>';
                    }
                echo '
                </ul>

                <ul class="playlists-aside">';
                    $this->displayPlaylists->buildPlaylists();
                echo '
                </ul>
            </section>
            <a id="disconnect" href="index.php?action=login"><svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" style="fill:'.$_SESSION['hexa'].';transform: ;msFilter:;"><path d="M19.002 3h-14c-1.103 0-2 .897-2 2v4h2V5h14v14h-14v-4h-2v4c0 1.103.897 2 2 2h14c1.103 0 2-.897 2-2V5c0-1.103-.898-2-2-2z"></path><path d="m11 16 5-4-5-4v3.001H3v2h8z"></path></svg></a>
        </aside>';
    }
}
