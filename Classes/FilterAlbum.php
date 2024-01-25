<?php


declare(strict_types=1);

class FilterAlbum {

    private array $data_objects;
    private string $search;

    function __construct(array $data_objects, string $search) {
        $this->data_objects = $data_objects;
        $this->search = $search;
    }

    function filterAlbums() {
        $filtered_albums = array();
        foreach($this->data_objects as $album) {
            if(str_contains(strtolower($album->getNomGroupe()),strtolower($this->search)) || 
                str_contains(strtolower($album->getTitle()),strtolower($this->search)) ||
                str_contains(strtolower($album->getParent()),strtolower($this->search)) ||
                in_array(strtolower($this->search),array_map('strtolower',$album->getGenre()))    
            )
                {
                array_push($filtered_albums,$album);
            }
        }
        return $filtered_albums;
    }
}