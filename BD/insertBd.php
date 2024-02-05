<?php
require_once("BD/connexionBd.php");

function insererGenre($genre){
    try{
        $bd = getConnexion();
        $requete = "INSERT INTO GENRES (idG, nomG) VALUES (NULL, :nomG)";
        $stm = $bd->prepare($requete);
        $stm ->bindParam(':nomG',$genre , PDO::PARAM_STR);
        $stm->execute();
        $bd = null;
    }catch(PDOException $ex){
        echo $ex->getMessage();
    }
}

function insererAlbum($by, $entryId, $genre, $img, $parent, $releaseYear, $title){
    try{
        $requete = "INSERT INTO ALBUMS (by, entryId, img, parent, releaseYear, title) VALUES (:by, :entryId, :img, :parent, :releaseYear, :title)";
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

        foreach ($genre as $nomG){
            $insererGenre = "INSERT INTO GENRESALBUM (entryId, idG) VALUES (:entryId, :idG)";
            $bd = getConnexion();
            $idG = getIdGenre($nomG);
            if ($idG == null){
                insererGenre($nomG);
                $idG = getIdGenre($nomG);
            }
            $stm = $bd->prepare($insererGenre);
            $stm->bindParam(':entryId', $entryId, PDO::PARAM_INT);
            $stm->bindParam(':idG', $idG, PDO::PARAM_INT);
            $stm->execute();
            $bd = null;
        }
    }catch(PDOException $ex){
        echo "Erreur lors de l'insertion de l'album";
        echo $ex->getMessage();
    } 
}

function insererUtilisateur($emailU, $nomU, $prenomU, $mdp){
    try {
        $mdpHash = password_hash($mdp, PASSWORD_DEFAULT);
        $requete = "INSERT INTO UTILISATEURS (idU, emailU, nomU, prenomU, mdpU) VALUES (:idU, :emailU, :nomU, :prenomU, :mdpU)";
        $bd = getConnexion();
        $stm = $bd->prepare($requete);

        // Last idU
        $idU = getLastIdUser() + 1;

        $stm->bindParam(":idU", $idU, PDO::PARAM_INT);
        $stm->bindParam(":emailU", $emailU, PDO::PARAM_STR);
        $stm->bindParam(":nomU", $nomU, PDO::PARAM_STR);
        $stm->bindParam(":prenomU", $prenomU, PDO::PARAM_STR);
        $stm->bindParam(":mdpU", $mdpHash, PDO::PARAM_STR);
        $stm->execute();
        $bd = null;
    } catch(PDOException $ex){}
}

function ajouterFavori($id, $entryId){
    try{
        $requete = "INSERT INTO FAVORIS (idU, entryId) VALUES (:idU, :entryId)";
        $bd = getConnexion();
        $stm = $bd->prepare($requete);
        $stm->bindParam(":idU", $id, PDO::PARAM_INT);
        $stm->bindParam(":entryId", $entryId, PDO::PARAM_INT);
        $stm->execute();
        $bd=null;
    } catch(PDOException $ex){}
}

function nouvellePlaylist($nomP){
    try{
        $requete = "INSERT INTO PLAYLISTS (idP, nomP) VALUES (NULL, :nomP)";
        $bd = getConnexion();
        $stm = $bd->prepare($requete);
        $stm->bindParam(':nomP', $nomP, PDO::PARAM_STR);
        $stm->execute();
        $bd = null;
    } catch(PDOException $ex){}
}

function ajouerALaPlaylist($nomP, $entryId){
    try{
        $requete = "INSERT INTO ALBUMPLAYLIST (idP, entryId) VALUES (:idP, :entryId)";
        $bd = getConnexion();
        $stm = $bd->prepare($requete);
        $stm->bindParam(":idP", $nomP, PDO::PARAM_INT);
        $stm->bindParam(":entryId", $entryId, PDO::PARAM_INT);
        $stm->execute();
        $bd=null;
    } catch(PDOException $ex){}
}
