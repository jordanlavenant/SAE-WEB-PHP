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
                <div class='album-content'>
                    <h2>détail</h2>
                    <div class='content'>
                        <img src='%s' alt='%s'>
                        <div class='album-info'>
                            <h3>%s</h3>
                            <div>
                                <p>%s</p>
                                <p><span>%s</span></p>
                            </div>
                            <p id='genres'><span>%s</span></p>
                        </div>
                        <div class='props'>
                            <svg xmlns='http://www.w3.org/2000/svg' width='48' height='48' viewBox='0 0 24 24' style='fill: rgba(210, 51, 92, 1);transform: ;msFilter:;'><path d='M12 4.595a5.904 5.904 0 0 0-3.996-1.558 5.942 5.942 0 0 0-4.213 1.758c-2.353 2.363-2.352 6.059.002 8.412l7.332 7.332c.17.299.498.492.875.492a.99.99 0 0 0 .792-.409l7.415-7.415c2.354-2.354 2.354-6.049-.002-8.416a5.938 5.938 0 0 0-4.209-1.754A5.906 5.906 0 0 0 12 4.595zm6.791 1.61c1.563 1.571 1.564 4.025.002 5.588L12 18.586l-6.793-6.793c-1.562-1.563-1.561-4.017-.002-5.584.76-.756 1.754-1.172 2.799-1.172s2.035.416 2.789 1.17l.5.5a.999.999 0 0 0 1.414 0l.5-.5c1.512-1.509 4.074-1.505 5.584-.002z'></path></svg>
                        </div>
                    </div>
                </div>

                <div class='related-album-content'>
                    <h2>discographie</h2>
                    <div class='content'>

                    </div>
                </div>

            </section>

            <section class='recommended-album'>
                <h2>mais aussi..</h2>
                <div class='content'>
                </div>
            </section>",
            $this->singleData->getImg(),
            $this->singleData->getTitle(),
            $this->singleData->getTitle(),
            $this->singleData->getNomGroupe(),
            $this->singleData->getReleaseYear(),
            $this->singleData->getGenreString(),
        );
    }
}

