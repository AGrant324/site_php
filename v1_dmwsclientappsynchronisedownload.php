<?php 
require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');

Get_Common_Parameters();
GlobalRoutine();

$synchdownfilename = $_REQUEST["SynchDownFilename"];

$fullfilename = $GLOBALS{'site_filepath'}."/".$GLOBALS{'LOGIN_domain_id'}."/".$synchdownfilename;

Download_File ($fullfilename,"delete");

?>