<?php
require_once("BD/connexionBd.php");

function modifierAlbumImg($entryId, $title, $by, $parent, $releaseYear, $genre, $imgPath){
    try{
        $requete = "UPDATE ALBUMS SET title = :title, by = :by, parent = :parent, releaseYear = :releaseYear, img = :img WHERE entryId = :entryId";

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

function modifierAlbumWithoutImg($entryId, $title, $by, $parent, $releaseYear, $genre){
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
        $stm->bindParam(':idU', $idU, PDO::PARAM_INT);
        $stm->bindParam(':entryId', $entryId, PDO::PARAM_INT);
        $stm->execute();
        $bd = null;
    } catch (PDOException $e) {
        echo "Erreur lors de la modification de la note de l'album";
        echo $e->getMessage();
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
        echo $e->getMessage();
    }
}

function modifierArtiste($by, $nouveauNom) {
    try {
        modifierCompositeur($by, $nouveauNom);
        modifierGroupe($by, $nouveauNom);        
    } catch (PDOException $e) {
        echo "Erreur lors de la modification du nom de l'artiste";
        echo $e->getMessage();
    }
}

function modifierCompositeur($by, $nouveauNom) {
    try {
        echo("BDby: ".$by." nouveauNom: ".$nouveauNom);
        $requete = "UPDATE ALBUMS SET parent = :nouveauNom WHERE parent LIKE :by";
        $bd = getConnexion();
        $stm = $bd->prepare($requete);
        $nouveauNom =  $nouveauNom;
        $stm->bindParam(':nouveauNom', $nouveauNom, PDO::PARAM_STR);
        $by = '%' . $by . '%';
        $stm->bindParam(':by', $by , PDO::PARAM_STR);
        $stm->execute();
        $bd = null;
    } catch (PDOException $e) {
        echo "Erreur lors de la modification du nom du compositeur";
        echo $e->getMessage();
    }
}

function modifierGroupe($by, $nouveauNom) {
    try {
        $requete = "UPDATE ALBUMS SET by = :nouveauNom WHERE by LIKE :by";
        $bd = getConnexion();
        $stm = $bd->prepare($requete);
        $nouveauNom =  $nouveauNom;
        $stm->bindParam(':nouveauNom', $nouveauNom, PDO::PARAM_STR);
        $by = '%' . $by . '%';
        $stm->bindParam(':by', $by , PDO::PARAM_STR);
        $stm->execute();
        $bd = null;
    } catch (PDOException $e) {
        echo "Erreur lors de la modification du nom du groupe";
        echo $e->getMessage();
    }
}
