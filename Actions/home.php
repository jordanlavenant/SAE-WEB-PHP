<?php


    require_once('Classes/Provider/Dataloader.php');
    require_once('BD/getBd.php');

    // Vérification de la connexion
    if (isset($_POST['email']) 
            && isset($_POST['password']) 
            && !verifLogin($_POST['email'], $_POST['password'])) {
        header('Location: index.php?action=login');
        exit();
    }

    // On set l'id de l'utilisateur dans la variable de session
    if (!$_SESSION['idU'] && !$_SESSION['nomU']) {
        $_SESSION['idU'] = getIdUser($_POST['email']);
        $_SESSION['nomU'] = getNomUser($_POST['email']);
    }
    
    require 'Classes/Autoloader.php';
    Autoloader::register();

    use SingleAlbum\SelectedAlbum;  
    use SingleAlbum\Details;

    use Filter\FilterAlbum;
    use Filter\SearchBar;

    use AllAlbum\GenericAlbum;
    use AllAlbum\Album;
    use AllAlbum\DisplayAlbums;
    use AllAlbum\DisplayFilteteredAlbums;
    use AllAlbum\RenderAlbumInterface;

    use AsideHome\Aside;

    use Discographie\Discographie;
    use Discographie\SelectedArtist;

    use EditAlbum\FormEdit;

    $dataloader = new Dataloader("data/data.yml");
    // Importation des données brute (yml)
    // $data = $dataloader->getData();

    // Importation des données de la base de données
    $data = $dataloader->getDataBd();

    // Tableau d'objet Album
    $data_objects = array();
    foreach($data as $content) {
        array_push($data_objects,new Album(
            $content['by'],
            $content['entryId'],
            $content['genre'],
            $content['img'] == "null" ? "default.jpg" : $content['img'],
            $content['parent'],
            $content['releaseYear'],
            $content['title']
        ));
    }

    // Aside
    $aside = new Aside();
    echo $aside->buildAside();

    // Main
    echo "<main>";
        if ($_REQUEST['action'] == "edit" && $_REQUEST['id'] != null) {
            $entryId = intval($_REQUEST['id']);
            $selectedAlbum = new SelectedAlbum($data_objects);
            $album = $selectedAlbum->getAlbum($entryId);
            // Render l'objet
            $edit = new FormEdit($album);
            echo $edit->render();

        } else if ($_REQUEST['id'] != null) {
            $entryId = intval($_REQUEST['id']);
            // Obtenir l'objet de l'album sélectionné
            $selectedAlbum = new SelectedAlbum($data_objects);
            $album = $selectedAlbum->getAlbum($entryId);
            // Render l'objet
            $displayAlbum = new Details($album);
            echo $displayAlbum->render();

            // Discographie (à modifié)
            $selectedArtist = new SelectedArtist($data_objects);
            $artistData = $selectedArtist->getArtistData($entryId);
            
            $displayArtistData = new Discographie($artistData);
            echo $displayArtistData->render();
        } else {
            echo "<h1>bonjour ". $_SESSION['nomU'] ."</h1>";

            // Barre de recherche
            $searchBar = new SearchBar();
            echo $searchBar->render();
            if (isset($_POST['search'])) {
                $search = $_POST['search'];
            } else {
                $search = "";
            }

            // Filtrage des albums
            if ($search != "") {
                $filter = new FilterAlbum($data_objects,$search);
                $data_objects = $filter->filterAlbums();
                echo "<div id='search-props'>";
                    if (count($data_objects) == 0) {
                        echo "<h3>aucun résultat pour la recherche <span>".$search."</span></h3>";
                    } else if (count($data_objects) == 1) {
                        echo "<h3><span>".count($data_objects)."</span> résultat pour la recherche <span>".$search."</span></h3>";
                    } else {
                        echo "<h3><span>".count($data_objects)."</span> résultats pour la recherche <span>".$search."</span></h3>";
                    }
                echo "</div>";
                // Display des albums filtrés
                $albums = new DisplayFilteteredAlbums($data_objects);
                $albums->buildAlbums();
            } else {
                // Display des albums
                $albums = new DisplayAlbums($data_objects);
                $albums->buildAlbums();
            }
        }

    echo "</main>";