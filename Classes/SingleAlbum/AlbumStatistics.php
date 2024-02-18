<?php
declare(strict_types=1);

namespace SingleAlbum;
use Playlists\DisplayPlaylists;

session_start();

class AlbumStatistics {

    private Object $playlists;
    private Object $singleData;
    private bool $liked;
    private int $notation;
    private int $nombreFavoris;
    private float $moyenneNote;
    private int $nombrePlaylists;

    function __construct(Object $data) {    
        $this->playlists = new DisplayPlaylists($_SESSION['idU'],intval($_REQUEST['id']));
        $this->singleData = $data;
        $this->liked = isFavorite($_SESSION['idU'], $_REQUEST['id']);
        $noteAlbum = getNoteAlbum($_SESSION['idU'], $_REQUEST['id']);

        $this->notation = $noteAlbum ? $noteAlbum['note'] : 0;
        $this->nombreFavoris = getNombreFavorisPourAlbum($_REQUEST['id']);
        $this->moyenneNote = getMoyenneNoteAlbum($_REQUEST['id']);
        $this->nombrePlaylists = getNombrePlaylistsPourAlbum($_REQUEST['id']);

    }

    function render(): string {
        $textePlaylist = ($this->nombrePlaylists == 1) ? "playlist" : "playlists";
        $texteFavoris = ($this->nombreFavoris == 1) ? "utilisateur" : "utilisateurs";
        
        return sprintf("
            <div class='header'>
                <h1>Statistiques</h1>
            </div>

            <section class='album-container'>
                <div class='content'>
                    <div class='left-part'>
                        <div class='album-info'>
                            <h3>L'album...</h3>
                            <p>- a été enregistré dans " . $this->nombrePlaylists . " " . $textePlaylist . "</p>
                            <p>- est aimé par " . $this->nombreFavoris . " " . $texteFavoris . "</p>
                            <p>- note moyenne : " . $this->moyenneNote . "/5</p>
                        </div>
                    </div>
                </div>
            </section>"
        );
    }
}