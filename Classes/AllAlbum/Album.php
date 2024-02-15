<?php
declare(strict_types=1);

namespace AllAlbum;
use AllAlbum\GenericAlbum;

class Album extends GenericAlbum
{
    function renderCard(): string {
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

    public function render() {
        return sprintf(
            "<div class='album'>
                <img src='%s' alt='%s'>
                <div class='album-info'>
                    <h3>%s</h3>
                    <p>%s</p>
                    <p>%s</p>
                    <p>%s</p>
                </div>
            </div>",
            $this->getImg(),
            $this->getTitle(),
            $this->getTitle(),
            $this->getNomGroupe(),
            $this->getParent(),
            $this->getReleaseYear()  
        );
    }

    function renderCompact(): string {
        return sprintf(
            "<tr onclick='document.location = `index.php?action=album&id=" . trim(strval($this->getEntryId())) . "`';>
                <td><img src='%s' alt='%s'>%s</td>
                <td>%s</td>
                <td>%s</td>
                <td>%s</td>
            </tr>",
            $this->getImg(),
            $this->getTitle(),
            $this->getTitle(),
            $this->getNomGroupe(),
            $this->getParent(),
            $this->getReleaseYear()  
        );
    }
}