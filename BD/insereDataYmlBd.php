<?php
require_once("BD/connexionBd.php");
require_once("vendor/autoload.php"); // Chemin vers autoload.php de Symfony/Yaml

// Fonction pour insérer les données du fichier YAML dans la base de données
function insererDonneesDepuisYAML($fichier){
    $contenu = file_get_contents($fichier);
    $donnees = \Symfony\Component\Yaml\Yaml::parse($contenu);

    // Connexion à la base de données
    $bd = getConnexion();

    foreach($donnees as $album){
        // Récupération des données de l'album
        $by = $album['by'];
        $entryId = $album['entryId'];
        $img = $album['img'];
        $parent = $album['parent'];
        $releaseYear = $album['releaseYear'];
        $title = $album['title'];

        // Insertion des données dans la table ALBUMS
        $requete = "INSERT INTO ALBUMS (by, entryId, img, parent, releaseYear, title) 
                    VALUES (:by, :entryId, :img, :parent, :releaseYear, :title)";
        $statement = $bd->prepare($requete);
        $statement->bindParam(':by', $by);
        $statement->bindParam(':entryId', $entryId);
        $statement->bindParam(':img', $img);
        $statement->bindParam(':parent', $parent);
        $statement->bindParam(':releaseYear', $releaseYear);
        $statement->bindParam(':title', $title);
        $statement->execute();

        // Insertion des genres dans la table GENRES et de la relation dans la table GENRESALBUM
        if(isset($album['genre']) && is_array($album['genre'])){
            foreach($album['genre'] as $genre){
                // Vérification si le genre existe déjà dans la table GENRES
                $requete = "SELECT idG FROM GENRES WHERE nomG = :nomG";
                $statement = $bd->prepare($requete);
                $statement->bindParam(':nomG', $genre);
                $statement->execute();
                $resultat = $statement->fetch(PDO::FETCH_ASSOC);

                if(!$resultat){ // Si le genre n'existe pas, on l'insère dans la table GENRES
                    $requete = "INSERT INTO GENRES (nomG) VALUES (:nomG)";
                    $statement = $bd->prepare($requete);
                    $statement->bindParam(':nomG', $genre);
                    $statement->execute();
                    $idG = $bd->lastInsertId();
                } else { // Sinon, on récupère son ID
                    $idG = $resultat['idG'];
                }

                // Insertion de la relation dans la table GENRESALBUM
                $requete = "INSERT INTO GENRESALBUM (entryId, idG) VALUES (:entryId, :idG)";
                $statement = $bd->prepare($requete);
                $statement->bindParam(':entryId', $entryId);
                $statement->bindParam(':idG', $idG);
                $statement->execute();
            }
        }
    }

    // Fermeture de la connexion à la base de données
    $bd = null;
}

// Appel de la fonction pour insérer les données du fichier YAML dans la base de données
insererDonneesDepuisYAML('./BD/data.yml');
?>
