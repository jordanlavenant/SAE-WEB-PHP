<?php

declare(strict_types=1);

require 'Classes/AsideHome/Aside.php';
require_once('BD/getBd.php');
session_start();

use AsideHome\Aside;

class Groupes {

    function buildGroupes() {
        $groupes = getAllGroupe();

        // Aside 
        $aside = new Aside();
        echo $aside->buildAside();

        echo "<main>
            <div class='header-props'>
                <div>
                    <a href='index.php?action=home'>
                        <svg xmlns='http://www.w3.org/2000/svg' width='48' height='48' viewBox='0 0 24 24' style='fill: rgba(222, 238, 237, 1);transform: ;msFilter:;'><path d='M13.939 4.939 6.879 12l7.06 7.061 2.122-2.122L11.121 12l4.94-4.939z'></path></svg>
                    </a>
                    <h1>groupes</h1>
                </div>
            </div>";
            
        echo "</main>";
    }
}