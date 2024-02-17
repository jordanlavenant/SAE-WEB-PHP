<?php
require_once("BD/connexionBd.php");

function retirerFavori($idU, $entryId) {
    $requete = "DELETE FROM FAVORIS WHERE idU = :idU AND entryId = :entryId";
    $bd = getConnexion();
    $stm = $bd->prepare($requete);
    $stm->bindParam(":idU", $idU, PDO::PARAM_INT);
    $stm->bindParam(":entryId", $entryId, PDO::PARAM_INT);
    $stm->execute();
    $bd = null;
}

function retirerAllFavori($entryId) {
    $requete = "DELETE FROM FAVORIS WHERE entryId = :entryId";
    $bd = getConnexion();
    $stm = $bd->prepare($requete);
    $stm->bindParam(":entryId", $entryId, PDO::PARAM_INT);
    $stm->execute();
    $bd = null;

}

function supprimerPlaylist($idP) {
    $requete = "DELETE FROM PLAYLISTS WHERE idP = :idP";
    $bd = getConnexion();
    $stm = $bd->prepare($requete);
    $stm->bindParam(":idP", $idP, PDO::PARAM_INT);
    $stm->execute();
    $bd = null;
}

function supprimerAllAlbumsPlaylist($idP) {
    $requete = "DELETE FROM ALBUMSPLAYLIST WHERE idP = :idP";
    $bd = getConnexion();
    $stm = $bd->prepare($requete);
    $stm->bindParam(":idP", $idP, PDO::PARAM_INT);
    $stm->execute();
    $bd = null;
}

function retirerAllPlaylist($entryId) {
    $requete = "DELETE FROM ALBUMSPLAYLIST WHERE entryId = :entryId";
    $bd = getConnexion();
    $stm = $bd->prepare($requete);
    $stm->bindParam(":entryId", $entryId, PDO::PARAM_INT);
    $stm->execute();
    $bd = null;
}

function supprimerAlbum($entryId) {
    retirerAllFavori($entryId);
    retirerAllPlaylist($entryId);
    supprimerAlbumDeGenresAlbum($entryId);
    supprimerAlbumDeNoteAlbum($entryId);
    $requete = "DELETE FROM ALBUMS WHERE entryId = :id";
    $bd = getConnexion();
    $stm = $bd->prepare($requete);
    $stm->bindParam(":id", $entryId, PDO::PARAM_INT);
    $stm->execute();
    $bd = null;
}

function supprimerAlbumDeGenresAlbum($entryId) {
    $requete = "DELETE FROM GENRESALBUM WHERE entryId = :entryId";
    $bd = getConnexion();
    $stm = $bd->prepare($requete);
    $stm->bindParam(":entryId", $entryId, PDO::PARAM_INT);
    $stm->execute();
    $bd = null;
}

function supprimerAlbumDeNoteAlbum($entryId) {
    $requete = "DELETE FROM NOTEALBUM WHERE entryId = :entryId";
    $bd = getConnexion();
    $stm = $bd->prepare($requete);
    $stm->bindParam(":entryId", $entryId, PDO::PARAM_INT);
    $stm->execute();
    $bd = null;
}

function removePlaylist($entryId, $idP) {
    try {
        $requete = "DELETE FROM ALBUMSPLAYLIST WHERE idP = :idP AND entryId = :entryId";
        $bd = getConnexion();
        $stm = $bd->prepare($requete);
        $stm -> bindParam(":idP", $idP, PDO::PARAM_INT);
        $stm -> bindParam(":entryId", $entryId, PDO::PARAM_INT);
        $stm->execute();
        $bd = null;
        return true;
    } catch (PDOException $ex) {
        return false;
    }
}
