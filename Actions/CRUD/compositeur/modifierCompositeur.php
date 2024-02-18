<?php

require_once('BD/updateBd.php');


$parent = $_REQUEST['parent'];
$name = $_POST['name'];
modifierCompositeur($parent, $name);

header('Location: index.php?action=compositeur&parent=' . $name);
