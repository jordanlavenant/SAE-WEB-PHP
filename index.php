<!DOCTYPE html>

<html lang="fr">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
        <title>Spotiut'o</title>
    </head>
    <body>

        <h1>test</h1>

        <?php
            require_once('Classes/Provider/Dataloader.php');
            require 'Classes/Autoloader.php';

            Autoloader::register();

            $dataloader = new Dataloader("data/data.yml");
            $data = $dataloader->getData();

            print_r($data[6]);
            echo $data[6][3];

            // Tableau d'objet
            $data_objects = array();
            foreach($data as $content) {
                array_push($data_objects,new Album(
                    $content[0],
                    $content[1],
                    $content[2],
                    $content[3],
                    $content[4],
                    $content[5],
                    $content[6]
                ));
            }
        ?>
    </body>
</html>