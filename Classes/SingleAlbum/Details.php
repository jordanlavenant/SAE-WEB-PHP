<?php
declare(strict_types=1);

namespace SingleAlbum;

class Details {

    private Object $singleData;

    function __construct(Object $data) {    
        $this->singleData = $data;
    }

    function render(): string {
        return sprintf(
            "<section class='album-container'>
                <div class='album'>
                    <img src='%s' alt='%s'>
                    <div class='album-info'>
                        <h3>%s</h3>
                        <p>%s</p>
                        <p>%s</p>
                        <p>%s</p>
                    </div>
                </div>
                <div class='related-album'>
                </div>
            </section>",
            $this->singleData->getImg(),
            $this->singleData->getTitle(),
            $this->singleData->getTitle(),
            $this->singleData->getNomGroupe(),
            $this->singleData->getGenre(),
            $this->singleData->getReleaseYear()
        );
    }
}

