<?php
require_once("BD/connexionBd.php");

function modifierAlbum($by, $entryId, $genre, $img, $parent, $releaseYear, $title){
    try{
        $requete = "UPDATE ALBUMS SET by = :by, img = :img, parent = :parent, releaseYear = :releaseYear, title = :title WHERE entryId = :entryId";

        $bd = getConnexion();
        $stm = $bd->prepare($requete);
        $stm->bindParam(':by', $by, PDO::PARAM_STR);
        $stm->bindParam(':entryId', $entryId, PDO::PARAM_INT);
        $stm->bindParam(':img', $img, PDO::PARAM_STR);
        $stm->bindParam(':parent', $parent, PDO::PARAM_STR);
        $stm->bindParam(':releaseYear', $releaseYear, PDO::PARAM_INT);
        $stm->bindParam(':title', $title, PDO::PARAM_STR);
        $stm->execute();
        $bd = null;

    }catch(PDOException $ex){
        echo "Erreur lors de l'insertion de l'album";
        echo $ex->getMessage();
    } 
}