<?php
declare(strict_type=1);

namespace EditAlbum;

class Form {

    private Object $editData; 

    function __construct(Object $data) {
        $this->editData = $data;
    }

    function render(): string{
        return sprintf(
            "<form action='index.php?action=edit' method='post'>
                <label for='title'>Titre de l'album</label>
                <input type='text' name='title' value='%s'>
                <label for='artist'>Nom de l'artiste</label>
                <input type='text' name='artist' value='%s'>
                <label for='genre'>Genre</label>
                <input type='text' name='genre' value='%s'>
                <label for='releaseYear'>Année de sortie</label>
                <input type='text' name='releaseYear' value='%s'>
                <label for='img'>Image de l'album</label>
                <input type='text' name='img' value='%s'>
                <input type='submit' value='Modifier'>
            </form>",
        );
    }
}