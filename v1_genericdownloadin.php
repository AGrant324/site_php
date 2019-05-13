<?php # genericdownloadin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');

Get_Common_Parameters();
GlobalRoutine();

$downloadfilename = $_REQUEST["DownloadFileName"];
$action = $_REQUEST["Action"]; 

Download_File ($downloadfilename,$action);

?>


