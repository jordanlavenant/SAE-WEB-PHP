<?php

require_once('BD/deleteBd.php');

$parent = $_REQUEST['parent'];
supprimerCompositeur($parent);

header("Location: index.php?action=compositeurs");
