<?php
$fic = "./data/data.yml";
$data = fopen($fic, "r");
$albums = array();
$line = fgets($data);

while ($line != NULL){
    $truc = explode(": ", $line);
    if ($truc[0] == "- by"){
        $cle = $truc[1];
    }
    if ($truc[0] == "  title"){
        $albums[$cle] = $donne;
    }
    $donne = $truc[1];
    $line = fgets($data);
}

fclose($data);
echo $albums["X"];
var_dump($albums);
foreach($albums as $key => $value){
    echo $value;
}