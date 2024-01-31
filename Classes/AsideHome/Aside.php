<?php

declare(strict_types=1);

namespace AsideHome;

class Aside {

    function __construct() {}

    function buildAside() {
        return sprintf(
            '<aside>
                <ul class="menu">
                    <li>%s</li>
                    <li><a href="">accueil</a></li>
                    <li><a href="">bibliothèque</a></li>
                    <li><a href="">favoris</a></li>
                </ul>
                <a href="">se déconnecter</a>
            </aside>',
            $_SESSION['idU']
        );
    }

}