<?php
declare(strict_types=1);

namespace SingleAlbum;
use Playlists\DisplayPlaylists;

class Details {

    private Object $playlists;
    private Object $singleData;
    private bool $liked;

    function __construct(Object $data) {    
        $this->playlists = new DisplayPlaylists($_SESSION['idU'],intval($_REQUEST['id']));
        $this->singleData = $data;
        $this->liked = isFavorite($_SESSION['idU'], $_REQUEST['id']);
    }

    function render(): string {

        $playlistContent = $this->playlists->buildPlaylists();

        return sprintf("
        
            <script>
                function togglePopup(){
                    let popup = document.querySelector('#popup-overlay');
                    popup.classList.toggle('open');
                }

                
            </script>

            <div id='popup-overlay' class=''>
                <div class='popup-content'>
                    <h2>selectionnez une playlist</h2>
                    <svg href='javascript:void(0)' onclick='togglePopup()' class='popup-exit' xmlns='http://www.w3.org/2000/svg' width='48' height='48' viewBox='0 0 24 24' style='fill: rgba(0, 102, 255, 1);transform: ;msFilter:;'><path d='m16.192 6.344-4.243 4.242-4.242-4.242-1.414 1.414L10.535 12l-4.242 4.242 1.414 1.414 4.242-4.242 4.243 4.242 1.414-1.414L13.364 12l4.242-4.242z'></path></svg>
                    %s
                </div>
            </div>

            <div class='header'>
                <a href='index.php?action=home'>
                    <svg xmlns='http://www.w3.org/2000/svg' width='48' height='48' viewBox='0 0 24 24' style='fill: rgba(222, 238, 237, 1);transform: ;msFilter:;'><path d='M13.939 4.939 6.879 12l7.06 7.061 2.122-2.122L11.121 12l4.94-4.939z'></path></svg>
                </a>
                <h1>détail</h1>
            </div>
            <section class='album-container'>
                <div class='content'>
                    <div class='left-part'>
                        <img src='%s' alt='%s'>
                        <div class='album-info'>
                            <h3>%s</h3>
                            <p>%s</p>
                            <div>
                                <p><span>%s</span></p>
                                <p><span>%s</span></p>
                            </div>
                        </div>
                    </div>
                    <div class='buttons'>
                        <div>
                            <p>écouter</p>
                            <svg xmlns='http://www.w3.org/2000/svg' width='48' height='48' viewBox='0 0 24 24' style='fill: rgba(0,102,255,1);transform: ;msFilter:;'><path d='M12 2C6.486 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.514 2 12 2zm0 18c-4.411 0-8-3.589-8-8s3.589-8 8-8 8 3.589 8 8-3.589 8-8 8z'></path><path d='m9 17 8-5-8-5z'></path></svg>
                        </div>
                        <div>
                            <p>ajouter à la bibliothèque</p>
                            <svg onclick='togglePopup()' xmlns='http://www.w3.org/2000/svg' width='48' height='48' viewBox='0 0 24 24' style='fill: rgba(0,102,255,1);transform: ;msFilter:;'><path d='M3 8v11c0 2.201 1.794 3 3 3h15v-2H6.012C5.55 19.988 5 19.806 5 19c0-.101.009-.191.024-.273.112-.576.584-.717.988-.727H21V4c0-1.103-.897-2-2-2H6c-1.206 0-3 .799-3 3v3zm3-4h13v12H5V5c0-.806.55-.988 1-1z'></path><path d='M11 14h2v-3h3V9h-3V6h-2v3H8v2h3z'></path></svg>
                        </div>
                        <div>
                            <p>%s</p>
                            <a href='index.php?action=ajoutFavoris&id=%s'>
                                %s
                            </a>
                        </div>
                    </div>
                </div>
            </section>",
            $playlistContent,
            $this->singleData->getImg(),
            $this->singleData->getTitle(),
            $this->singleData->getTitle(),
            $this->singleData->getNomGroupe(),
            $this->singleData->getGenreString(),
            $this->singleData->getReleaseYear(),
            $this->liked ? "retirer des favoris" : "ajouter aux favoris",
            $this->singleData->getEntryId(),
            $this->liked 
                ? "<svg xmlns='http://www.w3.org/2000/svg' width='48' height='48' viewBox='0 0 24 24' style='fill: rgba(0, 102, 255, 1);transform: ;msFilter:;'><path d='M20.205 4.791a5.938 5.938 0 0 0-4.209-1.754A5.906 5.906 0 0 0 12 4.595a5.904 5.904 0 0 0-3.996-1.558 5.942 5.942 0 0 0-4.213 1.758c-2.353 2.363-2.352 6.059.002 8.412L12 21.414l8.207-8.207c2.354-2.353 2.355-6.049-.002-8.416z'></path></svg>"
                : "<svg xmlns='http://www.w3.org/2000/svg' width='48' height='48' viewBox='0 0 24 24' style='fill: rgba(0,102,255,1);transform: ;msFilter:;'><path d='M12 4.595a5.904 5.904 0 0 0-3.996-1.558 5.942 5.942 0 0 0-4.213 1.758c-2.353 2.363-2.352 6.059.002 8.412l7.332 7.332c.17.299.498.492.875.492a.99.99 0 0 0 .792-.409l7.415-7.415c2.354-2.354 2.354-6.049-.002-8.416a5.938 5.938 0 0 0-4.209-1.754A5.906 5.906 0 0 0 12 4.595zm6.791 1.61c1.563 1.571 1.564 4.025.002 5.588L12 18.586l-6.793-6.793c-1.562-1.563-1.561-4.017-.002-5.584.76-.756 1.754-1.172 2.799-1.172s2.035.416 2.789 1.17l.5.5a.999.999 0 0 0 1.414 0l.5-.5c1.512-1.509 4.074-1.505 5.584-.002z'></path></svg>" ,
        );
    }
}

