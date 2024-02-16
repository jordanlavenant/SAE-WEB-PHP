<?php

    require_once('Classes/Provider/Dataloader.php');
    require_once('BD/getBd.php');    
    
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

    use Discographie\DiscographieArtist;
    use Discographie\DiscographieGroupe;
    use Discographie\SelectedArtist;
    use Discographie\SelectedGroupe;

    use Playlists\DisplayPlaylists;
    use Playlists\DisplayPlaylistsCompact;

    use EditAlbum\FormEdit;

    use Compositeurs\DisplayCompositeurs;
    use Compositeurs\DisplayCompositeur;

    use Groupes\DisplayGroupes;
    use Groupes\DisplayGroupe;

    $dataloader = new Dataloader("data/data.yml");
    // Importation des données brute (yml)
    // $data = $dataloader->getData();

    // Importation des données de la base de données
    $dataloader->insererData(); // temp
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
            
            // Détail de la selection
            $displayAlbum = new Details($album);
            echo $displayAlbum->render();

            // Discographie artiste
            $selectedGroupe = new SelectedGroupe($data_objects);
            $groupeData = $selectedGroupe->getGroupeData($entryId);
            $displayGroupeData = new DiscographieGroupe($groupeData);
            echo $displayGroupeData->render();

            // Discographie artiste
            $selectedArtist = new SelectedArtist($data_objects);
            $artistData = $selectedArtist->getArtistData($entryId);
            $displayArtistData = new DiscographieArtist($artistData);
            echo $displayArtistData->render();
        } else if ($_REQUEST['action'] == 'groupes') {
            $displayGroupes = new DisplayGroupes($data_objects);
            echo $displayGroupes->render();
            
        } else if ($_REQUEST['action'] == 'compositeurs') {
            $displayCompositeurs = new DisplayCompositeurs($data_objects);
            echo $displayCompositeurs->render();

        } else {
            echo "<h1 id='welcome'>bonjour ". $_SESSION['prenomU'] ."</h1>";

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
                // Pagination
                $data_objects_displayed = $data_objects;
                $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
                $itemsPerPage = 10;
                $startIndex = ($page - 1) * $itemsPerPage;
                $data_objects_displayed_page = array_slice($data_objects_displayed, $startIndex, $itemsPerPage);

                // Display des albums avec pagination
                $albums = new DisplayAlbums($data_objects_displayed_page);
                $albums->buildAlbums();
                  
                // Affichage des liens de pagination
                $totalItems = count($data_objects_displayed);
                $totalPages = ceil($totalItems / $itemsPerPage);

                echo "<div id='pagination'>";
                    if ($page > 1) {
                        echo '<a href="index.php?action=home&page=' . ($page - 1) . '">< précédent</a> ';
                    }
                    // Page precedente 
                    if ($page > 1) {
                        echo '<a href="index.php?action=home&page=' .  ($page - 1) . '">' . $page - 1 . '</a> ';
                    }
                    // Page actuelle 
                    echo '<a class="current" href="index.php?action=home&page=' . $page . '">' . $page . '</a> ';
                    // Page suivante
                    if ($page < $totalPages) {
                        echo '<a href="index.php?action=home&page=' .  ($page + 1) . '">' . $page + 1 . '</a> ';
                    }
                    // Total de pages
                    if ($page < $totalPages - 1) {
                        echo "<p>...</p> ";
                        echo '<a href="index.php?action=home&page=' . $totalPages . '">' . $totalPages . '</a> ';
                    }

                    if ($page < $totalPages) {
                        echo '<a href="index.php?action=home&page=' . ($page + 1) . '">suivant ></a> ';
                    }
                echo "</div>";
            }
        }

    echo "</main>";
    
?>