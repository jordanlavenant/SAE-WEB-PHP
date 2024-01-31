<?php

declare(strict_types=1);

namespace AsideHome;

class Aside {

    function __construct() {}

    function buildAside() {
        return sprintf(
            '<aside>
                <ul class="menu">
                    <li><a href="index.php?action=home">accueil</a></li>
                    <li><a href="">bibliothèque</a></li>
                    <li><a href="">favoris</a></li>
                </ul>
                <a href="index.php?action=login">se déconnecter</a>
            </aside>',
        );
    }

}