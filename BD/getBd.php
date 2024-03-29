<?php
require_once("BD/connexionBd.php");
require_once('BD/insertBd.php');

function getIdGenre($nomG){
    try{
        $getIdGenre = "SELECT idG FROM GENRES WHERE nomG = :nomG";
        $bd = getConnexion();
        $stm = $bd->prepare($getIdGenre);
        $stm->bindParam(':nomG', $nomG, PDO::PARAM_STR);
        $stm->execute();
        $idG = $stm->fetchColumn();
        $bd = null;
        return $idG;
    }catch(PDOException $ex){
        echo "Erreur lors de la récupération de l'idG";
        echo $ex->getMessage();
    } 
}

function getAlbums(){
    try{
        $data = array();
        $album = array();
        $requete = "SELECT by, entryId, img, parent, releaseYear, title FROM ALBUMS";
        $getGenre = "SELECT nomG FROM GENRES NATURAL JOIN GENRESALBUM WHERE entryId=:entryId";
        $bd = getConnexion();
        foreach ($bd->query($requete) as $row){
            $album["by"] = $row['by'];
            $album["entryId"] = $row['entryId'];
            $genres = array();
            $stm = $bd->prepare($getGenre);
            $stm->bindParam(':entryId', $row['entryId'], PDO::PARAM_INT);
            $stm->execute();
            while($g = $stm->fetch()){
                array_push($genres,$g[0]);
            }
            $album["genre"] = $genres;
            $album["img"] = $row['img'];
            $album["parent"] = $row['parent'];
            $album["releaseYear"] = $row['releaseYear'];
            $album["title"] = $row['title'];
            $data[] = $album;
            $album = array();
        }
        $bd = null;
        return $data;
    } catch(PDOException $ex){
        echo $ex->getMessage();
    } 
}

function getAlbumsOffset($currentPage, $parPage) {
    try {
        $data = array();
        $album = array();
        $offset = ($currentPage - 1) * $parPage;
        $requete = "SELECT by, entryId, img, parent, releaseYear, title FROM ALBUMS LIMIT :parPage OFFSET :offset";
        $getGenre = "SELECT nomG FROM GENRES NATURAL JOIN GENRESALBUM WHERE entryId=:entryId";
        $bd = getConnexion();
        $stm = $bd->prepare($requete);
        $stm->bindParam(':parPage', $parPage, PDO::PARAM_INT);
        $stm->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stm->execute();
        foreach ($stm as $row){
            $album["by"] = $row['by'];
            $album["entryId"] = $row['entryId'];
            $genres = array();
            $stm2 = $bd->prepare($getGenre);
            $stm2->bindParam(':entryId', $row['entryId'], PDO::PARAM_INT);
            $stm2->execute();
            while($g = $stm2->fetch()){
                array_push($genres,$g[0]);
            }
            $album["genre"] = $genres;
            $album["img"] = $row['img'];
            $album["parent"] = $row['parent'];
            $album["releaseYear"] = $row['releaseYear'];
            $album["title"] = $row['title'];
            $data[] = $album;
            $album = array();
        }
        $bd = null;
        return $data;
    } catch(PDOException $ex){
        echo $ex->getMessage();
    } 
}

function getEntryId($title){
    $requete = "SELECT entryId FROM ALBUMS WHERE title = :title";
    $bd = getConnexion();
    $stm = $bd->prepare($requete);
    $stm -> bindParam(":title",$title, PDO::PARAM_STR);
    $stm -> execute();
    $entryId = $stm->fetchColumn();
    $bd = null;
    return $entryId;
}

function getLastEntryId() {
    try {
        $requete = "SELECT MAX(entryId) FROM ALBUMS";
        $bd = getConnexion();
        $stm = $bd->prepare($requete);
        $stm->execute();
        $entryId = $stm->fetchColumn();
        $bd = null;
        return $entryId;
    } catch(PDOException $ex) {
        echo "Erreur lors de la récupération du dernier entryId";
        echo $ex->getMessage();
    }
}

function getLastIdUser() {
    try {
        $requete = "SELECT MAX(idU) FROM UTILISATEURS";
        $bd = getConnexion();
        $stm = $bd->prepare($requete);
        $stm->execute();
        $idU = $stm->fetchColumn();
        $bd = null;
        return $idU;
    } catch(PDOException $ex) {
        echo "Erreur lors de la récupération du dernier idU";
        echo $ex->getMessage();
    }
}

function getIdUser($email){
    $requete = "SELECT idU FROM UTILISATEURS WHERE emailU = :emailU";
    $bd = getConnexion();
    $stm = $bd->prepare($requete);
    $stm -> bindParam(':emailU', $email, PDO::PARAM_STR);
    $stm-> execute();
    $idU = $stm->fetchColumn();
    $bd = null;
    return $idU;
}

function getNomUser($email){
    $requete = "SELECT nomU FROM UTILISATEURS WHERE emailU = :emailU";
    $bd = getConnexion();
    $stm = $bd->prepare($requete);
    $stm -> bindParam(':emailU', $email, PDO::PARAM_STR);
    $stm-> execute();
    $nomU = $stm->fetchColumn();
    $bd = null;
    return $nomU;
}

function getPrenomUser($email){
    $requete = "SELECT prenomU FROM UTILISATEURS WHERE emailU = :emailU";
    $bd = getConnexion();
    $stm = $bd->prepare($requete);
    $stm -> bindParam(':emailU', $email, PDO::PARAM_STR);
    $stm-> execute();
    $prenomU = $stm->fetchColumn();
    $bd = null;
    return $prenomU;
}

function verifLogin($emailU, $mdp){
    try {
        $requete = "SELECT * FROM UTILISATEURS WHERE emailU = :emailU"; 
        $bd = getConnexion();
        $stm = $bd->prepare($requete);
        $stm->bindParam(":emailU", $emailU, PDO::PARAM_STR); 
        $stm->execute();
        $user = $stm->fetch(PDO::FETCH_ASSOC);
        if($user && password_verify($mdp, $user['mdpU'])) {
            return true;
        } else {
            return false;
        }
    } catch(PDOException $ex) {
        return false;
    }
}

function getFavoriU($idU){
    $favori = array();
    $requete = "SELECT entryId FROM FAVORIS WHERE idU = :idU";
    $bd = getConnexion();
    $stm = $bd->prepare($requete);
    $stm -> bindParam(":idU", $idU, PDO::PARAM_INT);
    $stm-> execute();
    while($g = $stm->fetch()){
        array_push($favori,$g[0]);
    }
    $bd = null;
    return $favori;
}

function getPlaylistsU($idU){
    $requete = "SELECT * FROM PLAYLISTS WHERE idU = :idU";
    $bd = getConnexion();
    $stm = $bd->prepare($requete);
    $stm -> bindParam(":idU", $idU, PDO::PARAM_INT);
    $stm-> execute();
    $data = $stm->fetchAll();
    $bd = null;
    return $data;
}

function getPlaylistProps($idP) {
    $requete = "SELECT * FROM PLAYLISTS WHERE idP = :idP";
    $bd = getConnexion();
    $stm = $bd->prepare($requete);
    $stm -> bindParam(":idP", $idP, PDO::PARAM_INT);
    $stm-> execute();
    $data = $stm->fetch();
    $bd = null;
    return $data;
}

function getEntriesPlaylist($idP) {
    try {
        $requete = "SELECT entryId FROM ALBUMSPLAYLIST WHERE idP = :idP";
        $bd = getConnexion();
        $stm = $bd->prepare($requete);
        $stm -> bindParam(":idP", $idP, PDO::PARAM_INT);
        $stm-> execute();
        $data = $stm->fetchAll();
        $bd = null;
        return $data;
    } catch(PDOException $ex) {
        echo "Erreur lors de la récupération des albums de la playlist";
        echo $ex->getMessage();
    }
}

function isFavorite($idU, $entryId){
    $requete = "SELECT * FROM FAVORIS WHERE idU = :idU AND entryId = :entryId";
    $bd = getConnexion();
    $stm = $bd->prepare($requete);
    $stm -> bindParam(":idU", $idU, PDO::PARAM_INT);
    $stm -> bindParam(":entryId", $entryId, PDO::PARAM_INT);
    $stm-> execute();
    $favori = $stm->fetch();
    $bd = null;
    if ($favori){
        return true;
    } else {
        return false;
    }
}

function accessPlaylist($idU, $idP) {
    $requete = "SELECT * FROM PLAYLISTS WHERE idU = :idU AND idP = :idP";
    $bd = getConnexion();
    $stm = $bd->prepare($requete);
    $stm -> bindParam(":idU", $idU, PDO::PARAM_INT);
    $stm -> bindParam(":idP", $idP, PDO::PARAM_INT);
    $stm-> execute();
    $playlist = $stm->fetch();
    $bd = null; 
    if ($playlist){
        return true;
    } else {
        return false;
    }
}

function inPlaylist($entryId, $idP) {
    $requete = "SELECT * FROM ALBUMSPLAYLIST WHERE idP = :idP AND entryId = :entryId";
    $bd = getConnexion();
    $stm = $bd->prepare($requete);
    $stm -> bindParam(":idP", $idP, PDO::PARAM_INT);
    $stm -> bindParam(":entryId", $entryId, PDO::PARAM_INT);
    $stm-> execute();
    $album = $stm->fetch();
    $bd = null;
    if ($album){
        return true;
    } else {
        return false;
    }
}

function getAlbumWithId($entryId)   {
    $requete = "SELECT * FROM ALBUMS WHERE entryId = :entryId";
    $bd = getConnexion();
    $stm = $bd->prepare($requete);
    $stm -> bindParam(":entryId", $entryId, PDO::PARAM_INT);
    $stm-> execute();
    $album = $stm->fetch();
    $bd = null;
    return $album;
}

function countAlbumsPlaylist($idP)  {
    $requete = "SELECT COUNT(entryId) FROM ALBUMSPLAYLIST WHERE idP = :idP";
    $bd = getConnexion();
    $stm = $bd->prepare($requete);
    $stm -> bindParam(":idP", $idP, PDO::PARAM_INT);
    $stm-> execute();
    $count = $stm->fetchColumn();
    $bd = null;
    return $count;
}

function getAllBy() {
    $requete = "SELECT by from ALBUMS GROUP BY by";
    $bd = getConnexion();
    $stm = $bd->prepare($requete);
    $stm->execute();
    $data = $stm->fetchAll();
    $bd = null;
    return $data;
}

function getAllArtist() {
    $requete = "SELECT parent from ALBUMS GROUP BY parent";
    $bd = getConnexion();
    $stm = $bd->prepare($requete);
    $stm->execute();
    $data = $stm->fetchAll();
    $bd = null;
    return $data;
}

function getAllGenres() {
    $requete = "SELECT * from GENRES";
    $bd = getConnexion();
    $stm = $bd->prepare($requete);
    $stm->execute();
    $data = $stm->fetchAll();
    $bd = null;
    return $data;
}

function getAlbumWithParent($parent){
    $requete = "SELECT * FROM ALBUMS WHERE parent LIKE :parent";
    $bd = getConnexion();
    $stm = $bd->prepare($requete);
    $parent = '%' . $parent . '%';
    $stm -> bindParam(":parent", $parent, PDO::PARAM_STR);
    $stm-> execute();
    $data = $stm->fetchAll();
    $bd = null;
    return $data;
}

function getAlbumWithBy($artiste){
    try {
        $requete = "SELECT * FROM ALBUMS WHERE by LIKE :artiste";
        
        $bd = getConnexion();
        $stm = $bd->prepare($requete);

        $artiste = '%' . $artiste . '%';
        $stm->bindParam(":artiste", $artiste, PDO::PARAM_STR);
        
        $stm->execute();
        $data = $stm->fetchAll();
        $bd = null;
        return $data;
    }
    catch(PDOException $ex) {
        echo "Erreur lors de la récupération des albums de l'artiste";
        echo $ex->getMessage();
    }    
}

function getCompositeur($idC)   {
    $requete = "SELECT * FROM COMPOSITEURS WHERE idC = :idC";
    $bd = getConnexion();
    $stm = $bd->prepare($requete);
    $stm -> bindParam(":idC", $idC, PDO::PARAM_INT);
    $stm-> execute();
    $compositeur = $stm->fetch();
    $bd = null;
    return $compositeur;
}

function getCompositeurGroupe($idG) {
    $requete = "SELECT * FROM COMPOSITEURGROUPE WHERE idG = :idG";
    $bd = getConnexion();
    $stm = $bd->prepare($requete);
    $stm -> bindParam(":idG", $idG, PDO::PARAM_INT);
    $stm-> execute();
    $compositeur = $stm->fetch();
    $bd = null;
    return $compositeur;
}

function getCompositeurAlbum($entryId)  {
    $requete = "SELECT * FROM COMPOSITEURALBUM WHERE entryId = :entryId";
    $bd = getConnexion();
    $stm = $bd->prepare($requete);
    $stm -> bindParam(":entryId", $entryId, PDO::PARAM_INT);
    $stm-> execute();
    $compositeur = $stm->fetch();
    $bd = null;
    return $compositeur;
}

function getAlbumCompositeur($idC) {
    $listeAlbums = array();
    $requete = "SELECT entryId FROM COMPOSITEURALBUM WHERE idC = :idC";
    $res = getElementsFromRequete($requete, $idC);
    while ($donnees = $res->fetch()) {
        $album = getDetailsAlbum($donnees['entryId']);
        array_push($listeAlbums, $album);
    }
    return $listeAlbums;
}

function getNoteAlbum($idU, $entryId) {
    $requete = "SELECT * FROM NOTEALBUM WHERE idU = :idU AND entryId = :entryId";
    $bd = getConnexion();
    $stm = $bd->prepare($requete);
    $stm -> bindParam(":idU", $idU, PDO::PARAM_INT);
    $stm -> bindParam(":entryId", $entryId, PDO::PARAM_INT);
    $stm-> execute();
    $note = $stm->fetch();
    $bd = null;
    return $note;
}

function getThemeUser($idU) {
    $requete = "SELECT theme FROM THEMES WHERE idU = :idU";
    $bd = getConnexion();
    $stm = $bd->prepare($requete);
    $stm -> bindParam(":idU", $idU, PDO::PARAM_INT);
    $stm-> execute();
    $theme = $stm->fetch();
    $bd = null;
    return $theme;
}

function getAllGenre() {
    $requete = "SELECT idG,nomG from GENRES";
    $bd = getConnexion();
    $stm = $bd->prepare($requete);
    $stm->execute();
    $data = $stm->fetchAll();
    $bd = null;
    return $data;
}

function getNombreFavorisPourAlbum($entryId){
    $requete = "SELECT COUNT(idU) FROM FAVORIS WHERE entryId = :entryId";
    $bd = getConnexion();
    $stm = $bd->prepare($requete);
    $stm -> bindParam(":entryId", $entryId, PDO::PARAM_INT);
    $stm-> execute();
    $nombreFavoris = $stm->fetchColumn();
    $bd = null;
    return $nombreFavoris;
}

function getMoyenneNoteAlbum($entryId){
    $requete = "SELECT ROUND(IFNULL(AVG(note), 0), 1) FROM NOTEALBUM WHERE entryId = :entryId";
    $bd = getConnexion();
    $stm = $bd->prepare($requete);
    $stm -> bindParam(":entryId", $entryId, PDO::PARAM_INT);
    $stm-> execute();
    $moyenneNote = $stm->fetchColumn();
    $bd = null;
    return $moyenneNote;
}

function getNombrePlaylistsPourAlbum($entryId){
    $requete = "SELECT COUNT(idP) FROM ALBUMSPLAYLIST WHERE entryId = :entryId";
    $bd = getConnexion();
    $stm = $bd->prepare($requete);
    $stm -> bindParam(":entryId", $entryId, PDO::PARAM_INT);
    $stm-> execute();
    $nombrePlaylists = $stm->fetchColumn();
    $bd = null;
    return $nombrePlaylists;
}
