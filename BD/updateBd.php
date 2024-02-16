<?php
require_once("BD/connexionBd.php");

function modifierAlbum($entryId, $title, $by, $parent, $releaseYear, $genre){
    try{
        $requete = "UPDATE ALBUMS SET title = :title, by = :by, parent = :parent, releaseYear = :releaseYear WHERE entryId = :entryId";

        $bd = getConnexion();
        $stm = $bd->prepare($requete);
        $stm->bindParam(':title', $title, PDO::PARAM_STR);
        $stm->bindParam(':by', $by, PDO::PARAM_STR);
        $stm->bindParam(':parent', $parent, PDO::PARAM_STR);
        $stm->bindParam(':releaseYear', $releaseYear, PDO::PARAM_INT);
        $stm->bindParam(':entryId', $entryId, PDO::PARAM_STR);
        $stm->execute();
        $bd = null;

    }catch(PDOException $ex){
        echo "Erreur lors de l'insertion de l'album";
        echo $ex->getMessage();
    } 
}

function modifierNoteAlbum($idU, $entryId, $note){
    try{
        $requete = "UPDATE NOTEALBUM SET note = :note WHERE idU = :idU AND entryId = :entryId";
        $bd = getConnexion();
        $stm = $bd->prepare($requete);
        $stm->bindParam(':note', $note, PDO::PARAM_INT);
        $stm->bindParam(':idU', $_SESSION['id'], PDO::PARAM_INT);
        $stm->bindParam(':entryId', $entryId, PDO::PARAM_INT);
        $stm->execute();
        $bd = null;
    } catch (PDOException $e) {
        echo "Erreur lors de la modification de la note de l'album";
        echo $ex->getMessage();
    }
}

function modifierTheme($idU, $theme){
    try{
        $requete = "UPDATE THEMES SET theme = :theme WHERE idU = :idU";
        $bd = getConnexion();
        $stm = $bd->prepare($requete);
        $stm->bindParam(':theme', $theme, PDO::PARAM_STR);
        $stm->bindParam(':idU', $idU, PDO::PARAM_INT);
        $stm->execute();
        $bd = null;
    } catch (PDOException $e) {
        echo "Erreur lors de la modification du theme de l'utilisateur";
        echo $ex->getMessage();
    }
}