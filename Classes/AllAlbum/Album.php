<?php
declare(strict_types=1);

namespace AllAlbum;
use AllAlbum\GenericAlbum;

class Album extends GenericAlbum
{
    function render(): string {
        return sprintf(
            "<a href='index.php?action=album&id=" . trim(strval($this->getEntryId())) . "' class='album'>
                <img src='%s' alt='%s'>
                <div class='album-info'>
                    <h3>%s</h3>
                    <p>%s</p>
                </div>
            </a>",
            $this->getImg(),
            $this->getTitle(),
            $this->getTitle(),
            $this->getNomGroupe()  
        );
    }
}