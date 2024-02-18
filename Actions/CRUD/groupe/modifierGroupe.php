<?php

require_once('BD/updateBd.php');

$by = $_REQUEST['by'];
$name = $_POST['name'];
modifierArtiste($by, $name);

header('Location: index.php?action=groupe&by=' . $name);
