<!DOCTYPE html>

<html lang="fr">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="static/css/style.css">
        <title>Spotiut'o</title>
    </head>
    <body>
        <?php
            require_once('Classes/Provider/Dataloader.php');

            require 'Classes/autoloader.php';
            Autoloader::register();

            use SingleAlbum\SelectedAlbum;
            use SingleAlbum\Details;

            use FilterHome\FilterAlbum;
            use FilterHome\SearchBar;

            use DisplayAlbum\GenericAlbum;
            use DisplayAlbum\Album;
            use DisplayAlbum\DisplayAlbums;
            use DisplayAlbum\RenderAlbumInterface;

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

            // echo phpinfo(INFO_VARIABLES);

            echo "<div class='Container'>";
                
                if ($_REQUEST['id'] != null) {
                    // Obtenir l'objet de l'album sélectionné
                    $selectedAlbum = new SelectedAlbum($data_objects);
                    $album = $selectedAlbum->getAlbum(intval($_REQUEST['id']));
                    // Render l'objet
                    $displayAlbum = new Details($album);
                    echo $displayAlbum->render();
                } else {
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
                }

            echo "</div>";
        ?>
    </body>
</html>