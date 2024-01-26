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
    $requette = "CREATE TABLE IF NOT EXISTS ALBUMS(
        by TEXT,
        entryId INTEGER PRIMARY KEY,
        img TEXT,
        parent TEXT,
        releaseYear INTEGER,
        title TEXT
        )";
    $bd->exec($requette);
}

function creerTableGenres($bd){
    $requette = "CREATE TABLE IF NOT EXISTS GENRES(
        idG INTEGER PRIMARY KEY AUTOINCREMENT,
        nomG TEXT
        )";
    $bd->exec($requette);
}

function creerTableGenresAlbum($bd){
    $requette = "CREATE TABLE IF NOT EXISTS GENRESALBUM(
        entryId INTEGER,
        idG INTEGER,
        FOREIGN KEY (entryId) REFERENCES ALBUMS (entryId),
        FOREIGN KEY (idG) REFERENCES GENRES (idG)
        )";
    $bd->exec($requette);
}

function creerUser($bd){
    $requette = "CREATE TABLE IF NOT EXISTS UTILISATEURS(
        idU INTEGER PRIMARY KEY AUTOINCREMENT,
        nomU TEXT,
        prenomU TEXT
        )";
    $bd->exec($requette);
}

function creerFavoris($bd){
    $requette = "CREATE TABLE IF NOT EXISTS FAVORIS(
        idU INTEGER,
        entryId INTEGER,
        FOREIGN KEY (idU) REFERENCES UTILISATEURS (idU),
        FOREIGN KEY (entryId) REFERENCES ALBUMS (entryId)
        )";
    $bd->exec($requette);
}

function insererGenre($genre){
    try{
        $bd = getConnexion();
        $requette = "INSERT INTO GENRES (idG, nomG) VALUES (NULL, :nomG)";
        $stm = $bd->prepare($requette);
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
        $requette = "INSERT INTO ALBUMS (by, entryId, img, parent, releaseYear, title) VALUES (:by, :entryId, :img, :parent, :releaseYear, :title)";
        $bd = getConnexion();
        $stm = $bd->prepare($requette);
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

function getEntryId($title){
    $requette = "SELECT entryId FROM ALBUM WHERE title = :title";
    $bd = getConnexion();
    $stm = $bd->prepare($requette);
    $stm -> bindParam(":title",$title, PDO::PARAM_STR);
    $stm -> execute();
    $entryId = $stm->fetchColumn();
    $bd = null;
    return $entryId;
}

function insererUtilisateur($nom, $prenom){
    $requette = "INSERT INTO UTILISATEUR (idU, nomU, prenomU) VALUES (NULL, :nomU, :prenomU)";
    $bd = getConnexion();
    $stm = $bd->prepare($requette);
    $stm->bindParam(":nomU", $nom, PDO::PARAM_STR);
    $stm->bindParam(":prenomU", $prenom, PDO::PARAM_STR);
    $stm->execute();
    $bd = null;
}

function getIdUser($nom, $prenom){
    $requette = "SELECT idU FROM UTILISATEUR WHERE nomU = :nomU and prenomU = :prenomU";
    $bd = getConnexion();
    $stm = $bd->prepare($requette);
    $stm -> bindParam(':nomU', $nom, PDO::PARAM_STR);
    $stm -> bindParam(':prenomU', $prenom, PDO::PARAM_STR);
    $stm-> execute();
    $idU = $stm->fetchColumn();
    $bd = null;
    return $idU;
}

function ajouterFavori($nom, $prenom, $title){
    $idU = getIdUser($nom, $prenom);
    $entryId = getEntryId($title);
    
    $requette = "INSERT INTO FAVORIS (idU, entryId) VALUES (:idU, :entryId)";
    $bd = getConnexion();
    $stm = $bd->prepare($requette);
    $stm->bindParam(":idU", $idU, PDO::PARAM_INT);
    $stm->bindParam(":entryId", $entryId, PDO::PARAM_INT);
    $stm->execute();
    $bd=null;
}
// creerBd();
insererAlbum("Superdrag", 67913, ["Rock", "Punk"], "Superdrag-Stereo_360_Sound.jpg", "Superdrag", 1998, "Stereo 360 Sound");