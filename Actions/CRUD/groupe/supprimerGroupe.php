<?php

require_once('BD/deleteBd.php');

$by = $_REQUEST['by'];
supprimerGroupe($by);

header("Location: index.php?action=groupes");
