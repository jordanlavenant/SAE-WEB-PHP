<?php
declare(strict_types=1);

namespace SingleAlbum;

class SelectedAlbum {

    private array $data_objects;

    function __construct(array $data_objects) {
        $this->data_objects = $data_objects;
    }

    function getAlbum(int $entryId): Object {
        foreach($this->data_objects as $album) {
            if($album->getEntryId() == $entryId) {
                return $album;
            }
        }
        return null;
    }

    function getGenre(int $entryId): array {
        foreach($this->data_objects as $album) {
            if ($album->getEntryId() == $entryId) {
                return $album->getGenre();
            }
        }
        return null;
    }
}