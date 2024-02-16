<?php
require_once("BD/connexionBd.php");

function modifierAlbum($entryId, $title, $by, $parent, $releaseYear, $genre, $imgPath){
    try{
        $requete = "UPDATE ALBUMS SET title = :title, by = :by, parent = :parent, releaseYear = :releaseYear, img =:img WHERE entryId = :entryId";

        $bd = getConnexion();
        $stm = $bd->prepare($requete);
        $stm->bindParam(':title', $title, PDO::PARAM_STR);
        $stm->bindParam(':by', $by, PDO::PARAM_STR);
        $stm->bindParam(':parent', $parent, PDO::PARAM_STR);
        $stm->bindParam(':releaseYear', $releaseYear, PDO::PARAM_INT);
        $stm->bindParam(':entryId', $entryId, PDO::PARAM_STR);
        $stm->bindParam(':img', $imgPath, PDO::PARAM_STR);
        $stm->execute();
        $bd = null;

    }catch(PDOException $ex){
        echo "Erreur lors de l'insertion de l'album";
        echo $ex->getMessage();
    } 
}
