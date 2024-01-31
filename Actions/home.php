<?php

    require_once('Classes/Provider/Dataloader.php');
    require('BD/gestionBd.php');

    if (isset($_POST['email']) 
            && isset($_POST['password']) 
            && !verifLogin($_POST['email'], $_POST['password'])) {
        header('Location: index.php?action=login');
        exit();
    }

    $_SESSION['idU'] = getIdUser($_POST['email']);

    require 'Classes/Autoloader.php';
    Autoloader::register();

    use SingleAlbum\SelectedAlbum;  
    use SingleAlbum\Details;

    use Filter\FilterAlbum;
    use Filter\SearchBar;

    use AllAlbum\GenericAlbum;
    use AllAlbum\Album;
    use AllAlbum\DisplayAlbums;
    use AllAlbum\RenderAlbumInterface;

    use AsideHome\Aside;

    $dataloader = new Dataloader("data/data.yml");
    $data = $dataloader->getData(); 

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

    echo "<div class='Container'>";
        
        if ($_REQUEST['id'] != null) {
            // Obtenir l'objet de l'album sélectionné
            $selectedAlbum = new SelectedAlbum($data_objects);
            $album = $selectedAlbum->getAlbum(intval($_REQUEST['id']));
            // Render l'objet
            $displayAlbum = new Details($album);
            echo $displayAlbum->render();
        } else {
            echo "<main>";
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
                    echo "<h3>votre recherche : $search</h3>";
                    echo "<h3>nombre de résultats : ".count($data_objects)."</h3>";
                echo "</div>";
            }

            // Display des albums
            $albums = new DisplayAlbums($data_objects);
            $albums->buildAlbums();
            echo "</main>";
        }

    echo "</div>";