<?php
declare(strict_types=1);

namespace EditAlbum;

require_once('BD/getBd.php');

class FormEdit {

    private Object $singleData;

    function __construct(Object $data) {    
        $this->singleData = $data;
    }

    function render() {
        echo " 
            <script>
                function togglePopup(){
                    let popup = document.querySelector('#popup-overlay');
                    popup.classList.toggle('open');
                }     
                
                function toggleEntry(button){
                    button.textContent = button.textContent === 'manuel' ? 'liste' : 'manuel';
                    let parent = button.parentElement;
                    let select = parent.nextElementSibling;
                    let input = select.nextElementSibling;
                    select.classList.toggle('hidden');
                    if (select.id === 'by') {
                        input.classList.toggle('visible');
                        input.name = input.name === 'by-input' ? 'by' : 'by-input';
                    }
                    else {
                        input.classList.toggle('visible');
                        input.name = input.name === 'parent-input' ? 'parent' : 'parent-input';
                    }
                }
            </script>

            <div id='popup-overlay' class=''>
                <div class='popup-content'>
                    <h2>voulez-vous vraiment modifier les informations de cet album ?</h2>

                    <svg href='javascript:void(0)' onclick='togglePopup()' class='popup-exit' xmlns='http://www.w3.org/2000/svg' width='48' height='48' viewBox='0 0 24 24' style='fill:".$_SESSION['hexa'].";transform: ;msFilter:;'><path d='m16.192 6.344-4.243 4.242-4.242-4.242-1.414 1.414L10.535 12l-4.242 4.242 1.414 1.414 4.242-4.242 4.243 4.242 1.414-1.414L13.364 12l4.242-4.242z'></path></svg>
                    <div class='choices'>
                        <input type='submit' form='myform' value=Confirmer>
                        <a class='genericButton' onclick='togglePopup()'>Annuler</a>
                    </div>
                </div>
            </div>

            <div class='header'>
                <a href='index.php?action=album&id=".$this->singleData->getEntryId()."'>
                    <svg xmlns='http://www.w3.org/2000/svg' width='48' height='48' viewBox='0 0 24 24' style='fill: rgba(222, 238, 237, 1);transform: ;msFilter:;'><path d='M13.939 4.939 6.879 12l7.06 7.061 2.122-2.122L11.121 12l4.94-4.939z'></path></svg>
                </a>
                <h1>détail</h1>
            </div>
            
            <form class= 'myform' id='myform' action='index.php?action=modifierAlbum&id=".$this->singleData->getEntryId()."' method='post'>
                <section class='album-container'>
                    <div class='content'>
                        <div class='left-part'>
                            <div class='album-info'>
                                <label for='title'>titre</label>
                                <input type='text' name='title' value='".$this->singleData->getTitle()."'>

                                <div>
                                    <label for='by'>interprété par</label>
                                    <p onclick='toggleEntry(this)'>manuel</p>
                                </div>
                                <select name='by' id='by'>";
                                    foreach(getAllGroupe() as $groupe) {
                                        if ($groupe[0] == $this->singleData->getNomGroupe())
                                            echo "<option value='".$groupe[0]."' selected>".$groupe[0]."</option>";
                                        else
                                            echo "<option value='".$groupe[0]."'>".$groupe[0]."</option>";
                                    }
                                    echo "
                                </select>
                                <input id='by-input' type='text' name='by-input' value='".$this->singleData->getParent()."'>

                                <div>
                                    <label for='parent'>compositeur</label>
                                    <p onclick='toggleEntry(this)'>manuel</p>
                                </div>
                                <select name='parent' id='parent'>";
                                    foreach(getAllArtist() as $compositeur) {
                                        if ($compositeur[0] == $this->singleData->getParent()) {
                                            echo "<option value='".$compositeur[0]."' selected>".$compositeur[0]."</option>";
                                        }
                                        else {
                                            echo "<option value='".$compositeur[0]."'>".$compositeur[0]."</option>";
                                        }
                                    }
                                    echo "
                                </select>
                                <input id='parent-input' type='text' name='parent-input' value='".$this->singleData->getParent()."'>

                                <label for='releaseYear'>date de sortie</label>
                                <input type='text' name='releaseYear' value='".$this->singleData->getReleaseYear()."'>
                                <label for='genre'>genre</label>
                                <input type='text' name='genre' value='".$this->singleData->getGenreString()."'>
                            </div>
                        </div>
                        <div class='right-part'>
                            <img src='".$this->singleData->getImg()."' alt='".$this->singleData->getTitle()."'>
                            <a class='genericButton' onclick='togglePopup()'>modifier l'album</a>
                        </div>
                    </div>
                </section>
            </form>
        </main>";
    }
}
