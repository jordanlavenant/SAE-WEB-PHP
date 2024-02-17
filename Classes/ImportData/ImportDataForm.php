<?php 
declare(strict_types=1);

namespace ImportData;

class ImportDataForm {

    function __construct() {}

    function render() {
        echo '
            <script>
                function chargeImage(event) {
                    let deleteButton = document.getElementById("delete-button");                
                    deleteButton.style.display = "block";
                }    

                function deleteImage() {
                    let deleteButton = document.getElementById("delete-button");
                    let image = document.getElementById("image");
                    image.value = "";
                    deleteButton.style.display = "none";
                }

                function toggleEntry(button){
                    button.textContent = button.textContent === "manuel" ? "liste" : "manuel";
                    let parent = button.parentElement;
                    let select = parent.nextElementSibling;
                    let input = select.nextElementSibling;
                    select.classList.toggle("hidden");
                    if (select.id === "by") {
                        input.classList.toggle("visible");
                        input.name = input.name === "by-input" ? "by" : "by-input";
                    }
                    else {
                        input.classList.toggle("visible");
                        input.name = input.name === "parent-input" ? "parent" : "parent-input";
                    }
                }

            </script>
            
            <form id="importDataForm" class="importDataForm" action="index.php?action=ajouterAlbum" method="post" enctype="multipart/form-data">

                <div class="props">
                    <div class="saisie">
                        <label for="by">groupe</label>
                        <p onclick="toggleEntry(this)">manuel</p>
                    </div>
                    <select name="by" id="by">';
                        $allGroupes = getAllBy();
                        $randomIndexBy = array_rand($allGroupes);
                        foreach($allGroupes as $index => $groupe) {
                            $selected = ($index == $randomIndexBy) ? 'selected' : '';
                            echo "<option value='".$groupe[0]."' $selected>".$groupe[0]."</option>";
                        }
                        echo '
                    </select>
                    <input id="by-input" type="text" name="by-input" placeholder="groupe">
                </div>

                <div class="props">
                    <div class="saisie">
                        <label for="parent">compositeur</label>
                        <p onclick="toggleEntry(this)">manuel</p>
                    </div>
                    <select name="parent" id="parent">';
                        $allArtists = getAllArtist();
                        $randomIndexParent = array_rand($allArtists);
                        foreach($allArtists as $index => $compositeur) {
                            $selected = ($index == $randomIndexParent) ? 'selected' : '';
                            echo "<option value='".$compositeur[0]."' $selected>".$compositeur[0]."</option>";
                        }
                        echo '
                    </select>
                    <input id="parent-input" type="text" name="parent-input" placeholder="compositeur">
                </div>
                
                <div class="props">
                    <div class="saisie">
                        <label for="titre">titre</label>
                    </div>
                    <input required id="titre" type="text" name="title" placeholder="titre">
                </div>

                <div class="props">
                    <div class="saisie">
                        <label for="releaseYear">date de sortie</label>
                    </div>
                    <input required type="text" id="releaseYear" name="releaseYear" placeholder="date de sortie">
                </div>

                <div>
                    <label id="label-file" for="image">choisissez une image</label>
                    <input type="file" name="img" id="image" accept="image/*" onchange="chargeImage(event)">
                    <button id="delete-button" style="display: none;" type="button" onclick="deleteImage()">supprimer</button>
                </div>
            </form>
            <div class="importDataFormSubmit"><input type="submit" form="importDataForm" value="ajouter"></div>
        ';
    }
}