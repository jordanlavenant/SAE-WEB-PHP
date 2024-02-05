<?php
declare(strict_types=1);

namespace Discographie;

class SelectedArtist {

    private array $data_objects;

    function __construct(array $data_objects) {
        $this->data_objects = $data_objects;
    }

    function getArtistData(int $entryId): array {
        $artist = "";
        foreach($this->data_objects as $content) {
            if ($content->getEntryId() == $entryId) {
                $artist = $content->getParent();
            }
        }
        $artistAlbums = array();
        foreach($this->data_objects as $content) {
            if ($content->getParent() == $artist) {
                array_push($artistAlbums, $content);
            }
        }
        return $artistAlbums;
    }
}