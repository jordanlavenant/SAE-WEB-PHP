<?php
declare(strict_types=1);

class Album extends GenericAlbum
{
    function render(): string {
        return sprintf(
            "<div class='album'>
                <img src='%s' alt='%s'>
                <div class='album-info'>
                    <h3>%s</h3>
                    <p>%s</p>
                </div>
            </div>",
            $this->getImg(),
            $this->getTitle(),
            $this->getTitle(),
            $this->getNomGroupe()  
        );
    }
}