<?php
declare(strict_types=1);

namespace Compositeur;

require_once("BD/getBd.php");

require 'Classes/AllAlbum/DisplayFilteteredAlbums.php';
require 'Classes/AllAlbum/RenderAlbumInterface.php';
require 'Classes/AllAlbum/GenericAlbum.php';
require 'Classes/AllAlbum/Album.php';

use AllAlbum\RenderAlbumInterface;
use AllAlbum\DisplayFilteteredAlbums;
use AllAlbum\GenericAlbum;
use AllAlbum\Album;

class DisplayCompositeur {

    private array $artistData;
    private string $parent;

    function __construct(string $parent) {    
        $this->parent = $parent;
        $this->artistData = getAlbumWithParent($parent);
        // Transformer les données en objet Album
        $this->artistData = array_map(function($content) {
            return new Album(
                $content['by'],
                $content['entryId'],
                $content['genre'] == null ? array() : $content['genre'],
                $content['img'] == "null" ? "default.jpg" : $content['img'],
                $content['parent'],
                $content['releaseYear'],
                $content['title']
            );
        }, $this->artistData);
    }

    function render(): void {
        $displayAlbums = new DisplayFilteteredAlbums($this->artistData);
        echo "
            <script>
                function togglePopupDelete(){
                    let popup = document.querySelector('#popup-overlay-delete');
                    popup.classList.toggle('open');
                }  

                function togglePopupEdit() {
                    let popup = document.querySelector('#popup-overlay-edit');
                    popup.classList.toggle('open');
        
                    let compositeurName = document.getElementById('compositeur-name');
                    let currentName = '" . $this->parent . "';  
                    compositeurName.value = currentName;
                }

                function updateCompositeurName() {
                    let compositeurName = document.getElementById('compositeur-name').value;
       
                    window.location.href = 'index.php?action=modifierCompositeur&parent=' + encodeURIComponent(compositeurName);
                }
            </script>

            <div id='popup-overlay-edit' class=''>
                <div class='popup-content'>
                    <h2>Modifier le nom du compositeur </h2>
                    <form class='editCompositeurForm' action='index.php?action=modifierCompositeur&parent=" . $this->parent . "' method='post'>
                        <input type='hidden' name='by' value='" . $this->parent . "'>
                        <input type='text' id='compositeur-name' name='name' value='" . $this->parent . "' required>
                        <div class='choices'>
                            <input type='submit' value='modifier'>
                            <a class='genericButton' onclick='togglePopupEdit()'>annuler</a>
                        </div>
                    </form>
                </div>
            </div>

            <div id='popup-overlay-delete' class=''>
                <div class='popup-content'>
                    <h2>voulez-vous vraiment supprimer ce compositeur, ainsi que tous les albums qui lui sont associés ?</h2>

                    <svg href='javascript:void(0)' onclick='togglePopupDelete()' class='popup-exit' xmlns='http://www.w3.org/2000/svg' width='48' height='48' viewBox='0 0 24 24' style='fill:" . $_SESSION['hexa'] . " ;transform: ;msFilter:;'><path d='m16.192 6.344-4.243 4.242-4.242-4.242-1.414 1.414L10.535 12l-4.242 4.242 1.414 1.414 4.242-4.242 4.243 4.242 1.414-1.414L13.364 12l4.242-4.242z'></path></svg>
                    <div class='choices'>
                        <a class='genericButton' href='index.php?action=supprimerCompositeur&parent=" . $this->parent .  "'>Confirmer</a>
                        <a class='genericButton' onclick='togglePopupDelete()'>Annuler</a>
                    </div>
                </div>
            </div>
        </script>
        
        <section class='compositeur-album'>
            <div class='tools'>
                <a onclick='togglePopupEdit()'>
                    <p>modifier</p>
                    <svg xmlns='http://www.w3.org/2000/svg' width='48' height='48' viewBox='0 0 24 24' style='fill:" . $_SESSION['hexa'] . " ;transform: ;msFilter:;'><path d='M19.045 7.401c.378-.378.586-.88.586-1.414s-.208-1.036-.586-1.414l-1.586-1.586c-.378-.378-.88-.586-1.414-.586s-1.036.208-1.413.585L4 13.585V18h4.413L19.045 7.401zm-3-3 1.587 1.585-1.59 1.584-1.586-1.585 1.589-1.584zM6 16v-1.585l7.04-7.018 1.586 1.586L7.587 16H6zm-2 4h16v2H4z'></path></svg>
                </a> 
                <a onclick='togglePopupDelete()'>
                    <p>supprimer</p>
                    <svg xmlns='http://www.w3.org/2000/svg' width='48' height='48' viewBox='0 0 24 24' style='fill:" . $_SESSION['hexa'] . " ;transform: ;msFilter:;'><path d='M5 20a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V8h2V6h-4V4a2 2 0 0 0-2-2H9a2 2 0 0 0-2 2v2H3v2h2zM9 4h6v2H9zM8 8h9v12H7V8z'></path><path d='M9 10h2v8H9zm4 0h2v8h-2z'></path></svg>
                </a>
            </div>
            
            <div id='compositeur-props'>";
                $size = count($this->artistData);
                if ($size > 1) echo "<h3>Ce compositeur a contribué à <span>".$size." </span>albums</h3>";
                else echo "<h3>Ce compositeur a contribué à <span>".$size." </span>album</h3>"; 
            echo "</div>";
            $displayAlbums->buildAlbums();
        echo "</section>";
    }
}
