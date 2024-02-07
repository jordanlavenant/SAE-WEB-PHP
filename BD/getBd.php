<?php
require_once("BD/connexionBd.php");

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

function getAlbum(){
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
    $playlists = array();
    $requete = "SELECT nomP FROM PLAYLISTS WHERE idU = :idU";
    $bd = getConnexion();
    $stm = $bd->prepare($requete);
    $stm -> bindParam(":idU", $idU, PDO::PARAM_INT);
    $stm-> execute();
    $data = $stm->fetchAll();
    print_r($data);
    $bd = null;
    return $data;
}
