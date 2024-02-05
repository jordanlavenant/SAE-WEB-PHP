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

function supprimerPlaylist($idP) {
    $requete = "DELETE FROM PLAYLISTS WHERE idP = :idP";
    $bd = getConnexion();
    $stm = $bd->prepare($requete);
    $stm->bindParam(":idP", $idP, PDO::PARAM_INT);
    $stm->execute();
    $bd = null;
}