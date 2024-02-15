<?php
declare(strict_type=1);

namespace EditAlbum;

require_once('BD/getBd.php');

class FormEdit {

    private Object $singleData;

    function __construct(Object $data) {    
        $this->singleData = $data;
    }

    function render(): string {
        return sprintf("
        
            <script>
                function togglePopup(){
                    let popup = document.querySelector('#popup-overlay');
                    popup.classList.toggle('open');
                }                
            </script>

            <div id='popup-overlay' class=''>
                <div class='popup-content'>
                    <h2>voulez-vous vraiment modifier les informations de cet album ?</h2>

                    <svg href='javascript:void(0)' onclick='togglePopup()' class='popup-exit' xmlns='http://www.w3.org/2000/svg' width='48' height='48' viewBox='0 0 24 24' style='fill: rgba(0, 102, 255, 1);transform: ;msFilter:;'><path d='m16.192 6.344-4.243 4.242-4.242-4.242-1.414 1.414L10.535 12l-4.242 4.242 1.414 1.414 4.242-4.242 4.243 4.242 1.414-1.414L13.364 12l4.242-4.242z'></path></svg>
                    <div class='choices'>
                        <input type='submit' form='myform' value=Confirmer>
                        <a class='genericButton' onclick='togglePopup()'>Annuler</a>
                    </div>
                </div>
            </div>



        
            <div class='header'>
                <a href='index.php?action=album&id=%s'>
                    <svg xmlns='http://www.w3.org/2000/svg' width='48' height='48' viewBox='0 0 24 24' style='fill: rgba(222, 238, 237, 1);transform: ;msFilter:;'><path d='M13.939 4.939 6.879 12l7.06 7.061 2.122-2.122L11.121 12l4.94-4.939z'></path></svg>
                </a>
                <h1>détail</h1>
            </div>
            
            <form class= 'myform' id='myform'  action='index.php?action=modifierAlbum&id=%s' method='post'>
                <section class='album-container'>
                    <div class='content'>
                        <div class='left-part'>
                            <img src='%s' alt='%s'>
                            <div class='album-info'>
                                <label for='title'>titre</label>
                                <input type='text' name='title' value='%s'>
                                <label for='by'>interprété par</label>
                                <input type='text' name='by' value='%s'>
                                <label for='parent'>compositeur</label>
                                <input type='text' name='parent' value='%s'>
                                <label for='releaseYear'>date de sortie</label>
                                <input type='text' name='releaseYear' value='%s'>
                                <label for='genre'>genre</label>
                                <input type='text' name='genre' value='%s'>
                            </div>
                        </div>
                        <div class='buttons'>
                            <a class='genericButton' onclick='togglePopup()'>Modifier l'album</a>
                        </div>
                    </div>
                </section>
            </form>
        </main>",
            $this->singleData->getEntryId(),
            $this->singleData->getEntryId(),
            $this->singleData->getImg(),
            $this->singleData->getTitle(),
            $this->singleData->getTitle(),
            $this->singleData->getNomGroupe(),
            $this->singleData->getParent(),
            $this->singleData->getReleaseYear(),
            $this->singleData->getGenreString(),
            $this->singleData->getEntryId(),
        );
    }
}