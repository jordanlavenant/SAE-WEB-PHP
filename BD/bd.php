<?php
require_once("BD/connexionBd.php");
function creerBd(){
    $bd = getConnexion();
    creerTableAlbums($bd);
    creerTableGenres($bd);
    creerTableGenresAlbum($bd);
    creerUser($bd);
    creerCompositeurs($bd);
    creerFavoris($bd);
    creerPlaylists($bd);
    creerAlbumsPlaylist($bd);
    creerGroupes($bd);
    creerCompisteurGroupe($bd);
    creerCompositeurAlbum($bd);
    creerNoteAlbum($bd);
    creerTheme($bd);
    $bd = null;
}

function creerTableAlbums($bd){
    $requete = "CREATE TABLE IF NOT EXISTS ALBUMS(
        by TEXT,
        entryId INTEGER PRIMARY KEY,
        img MEDIUMBLOB,
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

function creerTheme($bd){
    $requete = "CREATE TABLE IF NOT EXISTS THEMES(
        idU INTEGER PRIMARY KEY,
        theme TEXT,
        FOREIGN KEY (idU) REFERENCES UTILISATEURS (idU)
        )";
    $bd->exec($requete);
}

function creerCompositeurs($bd){
    $requete = "CREATE TABLE IF NOT EXISTS COMPOSITEURS(
        idC INTEGER PRIMARY KEY AUTOINCREMENT,
        nomC TEXT
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

function creerGroupes($bd){
    $requete = "CREATE TABLE IF NOT EXISTS GROUPES(
        idG INTEGER PRIMARY KEY AUTOINCREMENT,
        nomG TEXT
        )";
    $bd->exec($requete);
}

function creerCompisteurGroupe($bd){
    $requete = "CREATE TABLE IF NOT EXISTS COMPOSITEURGROUPE(
        idG INTEGER,
        idC INTEGER,
        FOREIGN KEY (idG) REFERENCES GROUPES (idG),
        FOREIGN KEY (idC) REFERENCES COMPOSITEURS (idC)
        )";
    $bd->exec($requete);
}

function creerCompositeurAlbum($bd){
    $requete = "CREATE TABLE IF NOT EXISTS COMPOSITEURALBUM(
        entryId INTEGER,
        idC INTEGER,
        FOREIGN KEY (entryId) REFERENCES ALBUMS (entryId),
        FOREIGN KEY (idC) REFERENCES COMPOSITEURS (idC)
        )";
    $bd->exec($requete);
}

function creerNoteAlbum($bd){
    $requete = "CREATE TABLE IF NOT EXISTS NOTEALBUM(
        entryId INTEGER,
        idU INTEGER,
        note INTEGER,
        FOREIGN KEY (entryId) REFERENCES ALBUMS (entryId),
        FOREIGN KEY (idU) REFERENCES UTILISATEURS (idU)
        )";
    $bd->exec($requete);
}


creerBd();