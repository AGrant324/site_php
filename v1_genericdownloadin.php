<<<<<<< HEAD
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


=======
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


>>>>>>> cbec31bba2128f8cfeb22fb0fa44e631f2c483fa
