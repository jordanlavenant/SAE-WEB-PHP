<?php
require_once("BD/connexionBd.php");
function creerBd(){
    $bd = getConnexion();
    creerTableAlbums($bd);
    creerTableGenres($bd);
    creerTableGenresAlbum($bd);
    creerUser($bd);
    creerArtistes($bd);
    creerFavoris($bd);
    creerPlaylists($bd);
    creerAlbumsPlaylist($bd);
    $bd = null;

}

function creerTableAlbums($bd){
    $requete = "CREATE TABLE IF NOT EXISTS ALBUMS(
        by TEXT,
        entryId INTEGER PRIMARY KEY,
        img TEXT,
        parent TEXT,
        releaseYear INTEGER,
        title TEXT
        )";
    $bd->exec($requete);
}

function creerTableGenres($bd){
    $requete = "CREATE TABLE IF NOT EXISTS GENRES(
        idG INTEGER PRIMARY KEY AUTOINCREMENT,
        nomG TEXT
        )";
    $bd->exec($requete);
}

function creerTableGenresAlbum($bd){
    $requete = "CREATE TABLE IF NOT EXISTS GENRESALBUM(
        entryId INTEGER,
        idG INTEGER,
        FOREIGN KEY (entryId) REFERENCES ALBUMS (entryId),
        FOREIGN KEY (idG) REFERENCES GENRES (idG)
        )";
    $bd->exec($requete);
}
    
function creerUser($bd){
    $requete = "CREATE TABLE IF NOT EXISTS UTILISATEURS(
        idU INTEGER PRIMARY KEY,
        emailU TEXT UNIQUE,
        nomU TEXT,
        prenomU TEXT,
        mdpU TEXT
        )";
    $bd->exec($requete);
}

function creerArtistes($bd){
    $requete = "CREATE TABLE IF NOT EXISTS ARTISTES(
        idA INTEGER PRIMARY KEY,
        nomA TEXT,
        prenomA TEXT,
        pseudo TEXT
        )";
    $bd->exec($requete);
}

function creerFavoris($bd){
    $requete = "CREATE TABLE IF NOT EXISTS FAVORIS(
        idU INTEGER,
        entryId INTEGER,
        FOREIGN KEY (idU) REFERENCES UTILISATEURS (idU),
        FOREIGN KEY (entryId) REFERENCES ALBUMS (entryId),
        PRIMARY KEY (idU, entryId)
        )";
    $bd->exec($requete);
}

function creerPlaylists($bd){
    $requete = "CREATE TABLE IF NOT EXISTS PLAYLISTS(
        idP INTEGER PRIMARY KEY AUTOINCREMENT,
        nomP TEXT,
        idU INTEGER,
        FOREIGN KEY (idU) REFERENCES UTILISATEURS (idU)
        )";
    $bd->exec($requete);
}

function creerAlbumsPlaylist($bd){
    $requete = "CREATE TABLE IF NOT EXISTS ALBUMSPLAYLIST(
        idP INTEGER,
        entryId INTEGER,
        FOREIGN KEY (idP) REFERENCES PLAYLIST (idP),
        FOREIGN KEY (entryId) REFERENCES ALBUMS (entryId)
        )";
    $bd->exec($requete);
}
