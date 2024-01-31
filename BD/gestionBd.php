<?php

function getConnexion(){
    $dbPath = 'BD/bd.sqlite';
    $file_db = new PDO('sqlite:' . $dbPath);
    $file_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $file_db;
}

function creerBd(){
    $bd = getConnexion();
    creerTableAlbum($bd);
    creerTableGenres($bd);
    creerTableGenresAlbum($bd);
    creerUser($bd);
    creerFavoris($bd);
    $bd = null;

}

function creerTableAlbum($bd){
    $requete = "CREATE TABLE IF NOT EXISTS ALBUMS(
        by TEXT,
        entryId INTEGER PRIMARY KEY,
        img TEXT,
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

function creerFavoris($bd){
    $requete = "CREATE TABLE IF NOT EXISTS FAVORIS(
        idU INTEGER,
        entryId INTEGER,
        FOREIGN KEY (idU) REFERENCES UTILISATEURS (idU),
        FOREIGN KEY (entryId) REFERENCES ALBUMS (entryId)
        )";
    $bd->exec($requete);
}

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

function ajouterFavori($nom, $prenom, $title){
    $idU = getIdUser($nom, $prenom);
    $entryId = getEntryId($title);
    
    $requete = "INSERT INTO FAVORIS (idU, entryId) VALUES (:idU, :entryId)";
    $bd = getConnexion();
    $stm = $bd->prepare($requete);
    $stm->bindParam(":idU", $idU, PDO::PARAM_INT);
    $stm->bindParam(":entryId", $entryId, PDO::PARAM_INT);
    $stm->execute();
    $bd=null;
}