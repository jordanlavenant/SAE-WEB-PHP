<?php

declare(strict_types=1);

namespace AsideHome;

class Aside {

    function __construct() {}

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
                    </ul>
                </section>
                <a href="index.php?action=login">se déconnecter</a>
            </aside>',
        );
    }

}