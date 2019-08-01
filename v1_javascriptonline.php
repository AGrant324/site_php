<?php

// This is a simple routine used to see if there is a connection to the server.

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');

Get_Common_Parameters();
GlobalRoutine();

Get_Data("site_dmws");
$arr = array($GLOBALS{'site_synchroniseappversion'});
echo $_GET['callback']."(".json_encode($arr).");";


?>