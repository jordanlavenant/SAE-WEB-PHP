<!DOCTYPE html>

<html lang="fr">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="styles/style.css">
        <title>Spotiut'o</title>
    </head>
    <body>
        <?php
            require_once('Classes/Provider/Dataloader.php');
            require 'Classes/Autoloader.php';

            Autoloader::register();

            $dataloader = new Dataloader("data/data.yml");
            $data = $dataloader->getData();

            // Tableau d'objet Album
            $data_objects = array();
            foreach($data as $content) {
                array_push($data_objects,new Album(
                    $content['by'],
                    $content['entryId'],
                    $content['genre'],
                    $content['img'] == null ? "default.jpg" : $content['img'],
                    $content['parent'],
                    $content['releaseYear'],
                    $content['title']
                ));
            }

            echo "<div class='Container'>";
                echo "<div class='albums'>";
                foreach($data_objects as $album) {
                    echo $album->render();
                }
                echo "</div>";
            echo "</div>";

        ?>
    </body>
</html>