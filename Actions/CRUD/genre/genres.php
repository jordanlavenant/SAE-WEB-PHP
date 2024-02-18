<?php
declare(strict_types=1);

require_once('BD/getBd.php');
require_once('BD/deleteBd.php');
require_once('BD/updateBd.php');
require_once('BD/insertBd.php');

require 'Classes/AsideHome/Aside.php';

use AsideHome\Aside;

class Genres {

    function buildGenres(): void {

        $aside = new Aside();
        echo $aside->buildAside();

        echo "

        <script>
            function togglePopupDelete(idGenre){
                let popup = document.querySelector('#popup-overlay-delete');
                popup.classList.toggle('open');
                let submit = document.querySelector('#confirm');
                submit.href = 'index.php?action=supprimerGenre&genre=' + idGenre;
            }  

            function togglePopupEdit(idGenre,genre) {
                let popup = document.querySelector('#popup-overlay-edit');
                popup.classList.toggle('open');
                let form = document.querySelector('.editGenreForm');
                form.action = 'index.php?action=modifierGenre&genre=' + idGenre;
                let input = document.querySelector('#genre');
                input.value = genre;
            }
        </script>

        <div id='popup-overlay-edit' class=''>
            <div class='popup-content'>
                <h2>modifier le genre</h2>
                <form class='editGenreForm' action='' method='post'>
                    <input type='text' id='genre' name='newGenre' value='' required>
                    <div class='choices'>
                        <input type='submit' value='modifier'>
                        <a class='genericButton' onclick='togglePopupEdit()'>annuler</a>
                    </div>
                </form>
            </div>
        </div>

        <div id='popup-overlay-delete' class=''>
            <div class='popup-content'>
                <h2>voulez-vous vraiment supprimer ce genre ?</h2>

                <svg href='javascript:void(0)' onclick='togglePopupDelete()' class='popup-exit' xmlns='http://www.w3.org/2000/svg' width='48' height='48' viewBox='0 0 24 24' style='fill:" . $_SESSION['hexa'] . " ;transform: ;msFilter:;'><path d='m16.192 6.344-4.243 4.242-4.242-4.242-1.414 1.414L10.535 12l-4.242 4.242 1.414 1.414 4.242-4.242 4.243 4.242 1.414-1.414L13.364 12l4.242-4.242z'></path></svg>
                <div class='choices'>
                    <a id='confirm' class='genericButton' href=''>confirmer</a>
                    <a class='genericButton' onclick='togglePopupDelete()'>annuler</a>
                </div>
            </div>
        </div>

        <main>
            <div class='header-props'>
                <div>
                    <a href='index.php?action=home'>
                        <svg xmlns='http://www.w3.org/2000/svg' width='48' height='48' viewBox='0 0 24 24' style='fill: rgba(222, 238, 237, 1);transform: ;msFilter:;'><path d='M13.939 4.939 6.879 12l7.06 7.061 2.122-2.122L11.121 12l4.94-4.939z'></path></svg>
                    </a>
                    <h1>genres</h1>
                </div>
                <form action='index.php?action=ajouterGenre' method='post'>
                    <input type='text' id='genre' name='genre' placeholder='genre' required>
                    <input type='submit' value='ajouter'>
                </form>
            </div>
            <section class='genre-list'>";
            foreach(getAllGenres() as $genre) {
                echo "
                <div class='genre'>
                    <p>".$genre[1]."</p>
                    <div>
                        <a onclick='togglePopupEdit(".$genre[0].",`".$genre[1]."`)'>modifier</a>
                        <a onclick='togglePopupDelete(".$genre[0].")'>supprimer</a>
                    </div>
                </div>";
            }
            echo "
            </section>
        </main>";
        
    }
}