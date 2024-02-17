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

                let originalImagePath = '" . $this->singleData->getImg() . "';
                let newImagePath = '';

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
                    else if (select.id === 'genre') {
                        input.classList.toggle('visible');
                        input.name = input.name === 'genre-input' ? 'genre' : 'genre-input';
                    }
                    else {
                        input.classList.toggle('visible');
                        input.name = input.name === 'parent-input' ? 'parent' : 'parent-input';
                    }
                }

                function chargeImage(event) {
                    let input = event.target;
                    let newAlbumImage = document.getElementById('album-image');
                    let deleteButton = document.getElementById('delete-button');
                    let hiddenImagePath = document.getElementById('hidden-image-path');
                
                    deleteButton.style.display = 'block';
                
                    let reader = new FileReader();
                
                    reader.onload = function(){
                        newImagePath = reader.result;
                        newAlbumImage.src = newImagePath;
                
                        let fileName = input.files[0].name;
                        console.log('File Name:', fileName);
                        let fileNameExtension = input.files[0].extension;
                        let fileNameWithExtension = fileName + '.' + fileNameExtension;
    
                        hiddenImagePath.value = fileNameWithExtension;
                
                        let fileExtension = fileNameWithExtension.split('.').pop().toLowerCase();
                    };
                
                    reader.readAsDataURL(input.files[0]);
                }    

                function deleteImage() {
                    let newAlbumImage = document.getElementById('album-image');
                    let deleteButton = document.getElementById('delete-button');
                    let hiddenImagePath = document.getElementById('hidden-image-path');
                    let loadedImage = document.getElementById('image');

                    loadedImage.value = '';
                    newImagePath = '';
                    newAlbumImage.src = originalImagePath;
                    deleteButton.style.display = 'none';
                
                    hiddenImagePath.value = originalImagePath;
                }
            </script>

            <div id='popup-overlay' class=''>
                <div class='popup-content'>
                    <h2>voulez-vous vraiment modifier les informations de cet album ?</h2>

                    <svg href='javascript:void(0)' onclick='togglePopup()' class='popup-exit' xmlns='http://www.w3.org/2000/svg' width='48' height='48' viewBox='0 0 24 24' style='fill:".$_SESSION['hexa'].";transform: ;msFilter:;'><path d='m16.192 6.344-4.243 4.242-4.242-4.242-1.414 1.414L10.535 12l-4.242 4.242 1.414 1.414 4.242-4.242 4.243 4.242 1.414-1.414L13.364 12l4.242-4.242z'></path></svg>
                    <div class='choices'>
                        <input type='submit' form='myform' value=confirmer>
                        <a class='genericButton' onclick='togglePopup()'>Annuler</a>
                    </div>
                </div>
            </div>

            <div class='header'>
                <a href='index.php?action=album&id=".$this->singleData->getEntryId()."'>
                    <svg xmlns='http://www.w3.org/2000/svg' width='48' height='48' viewBox='0 0 24 24' style='fill: rgba(222, 238, 237, 1);transform: ;msFilter:;'><path d='M13.939 4.939 6.879 12l7.06 7.061 2.122-2.122L11.121 12l4.94-4.939z'></path></svg>
                </a>
                <h1>modifier l'album</h1>
            </div>
            
            <form class= 'editAlbumForm' id='myform' action='index.php?action=modifierAlbum&id=".$this->singleData->getEntryId()."' method='post' enctype='multipart/form-data'>
                <input type='hidden' id='hidden-image-path' name='hiddenImagePath' value='".$this->singleData->getImg()."'>
                <div class='content'>
                    <div class='left-part'>                            
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
                        
                        <div>
                            <label for='genre'>genre</label>
                            <p onclick='toggleEntry(this)'>manuel</p>
                        </div>
                        <select name='genre' id='genre'>";
                            foreach(getAllGenres() as $genre) {
                                if ($genre[0] == $this->singleData->getGenre()[0]) 
                                    echo "<option value='".$genre[0]."' selected>".$genre[0]."</option>";
                                else 
                                    echo "<option value='".$genre[0]."'>".$genre[0]."</option>";
                            }
                            echo "
                        </select>
                        <input id='genre-input' type='text' name='genre-input' value='".$this->singleData->getGenre()[0]."'>
                        
                        
                        <div>
                            <label id='label-file' for='image'>choisissez une image</label>
                            <input type='file' name='image' id='image' accept='image/*' onchange='chargeImage(event)'>
                            <button id='delete-button' style='display: none;' type='button' onclick='deleteImage()'>supprimer</button>
                        </div>
                    </div>
                    <div class='right-part'>
                        <img id='album-image' src='".$this->singleData->getImg()."' alt='".$this->singleData->getTitle()."'>
                        <a class='genericButton' onclick='togglePopup()'>modifier</a>
                    </div>
                </div>
            </form>
        </main>";
    }
}
