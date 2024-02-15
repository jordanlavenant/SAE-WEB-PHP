<?php
declare(strict_types=1);

namespace Discographie;

class SelectedGroupe {

    private array $data_objects;

    function __construct(array $data_objects) {
        $this->data_objects = $data_objects;
    }

    function getGroupeData(int $entryId): array {
        $groupe = "";
        foreach($this->data_objects as $content) {
            if ($content->getEntryId() == $entryId) {
                $groupe = $content->getNomGroupe();
                break;
            }
        }
        $groupeAlbums = array();
        foreach($this->data_objects as $content) {
            if ($content->getNomGroupe() == $groupe) {
                array_push($groupeAlbums, $content);
            }
        }
        return $groupeAlbums;
    }
}