<?php 
declare(strict_types=1);

namespace ImportData;

class ImportDataForm {

    function __construct() {}

    function render() {
        return sprintf(
            '<form class="importDataForm" action="index.php?action=ajouterAlbum" method="post">
                <input required type="text" name="by" placeholder="groupe">
                <input required type="text" name="title" placeholder="titre">
                <input required type="text" name="parent" placeholder="artiste, compositeur">
                <input required type="text" name="releaseYear" placeholder="date de sortie">
                <input type="text" name="img" placeholder="image">
                <input type="submit" value="ajouter">
            </form>'
        );
    }
}