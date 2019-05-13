<?php #webpagepreviewpublish.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');

Get_Common_Parameters();
GlobalRoutine();

$informattedsectiontype = $_REQUEST['formattedsectiontype'];
$formattedsectionheader = $_REQUEST['formattedsectionheader'];
$informattedsectioncols = $_REQUEST['formattedsectioncols'];
if ($informattedsectioncols == "") { $informattedsectioncols = "1"; }
$informattedsectionrows = $_REQUEST['formattedsectionrows'];
if ($informattedsectionrows == "") { $informattedsectionrows = "1"; }

// XH5($informattedsectiontype."|".$informattedsectionheader."|".$informattedsectioncols."|".$informattedsectionrows);

// ../site_template/Header_1.html
if ( $formattedsectionheader == "Yes" ) { 	
	Check_File("../site_template/Header_1.html");
	if ($GLOBALS{'IOWARNING'} == "0" ) {
		$htmla = Get_File_Array("../site_template/Header_1.html");
		foreach ($htmla as $message ) {
			print($message."\n");
		}
	} else {
		print("ERROR: Formatted Section ../site_template/Header_1.html does not exist.\n");
	}
}  

// ../site_template/formattedsectiontype_cols.html
Check_File("../site_template/".$informattedsectiontype."_".$informattedsectioncols.".html");
if ($GLOBALS{'IOWARNING'} == "0" ) {
	$htmla = Get_File_Array("../site_template/".$informattedsectiontype."_".$informattedsectioncols.".html");
	for ($i = 1; $i < $informattedsectionrows+1; $i++) {
		foreach ($htmla as $message ) {
			print($message."\n");
		}
	}
} else {
	print("ERROR: Formatted Section ".$informattedsectiontype."_".$informattedsectioncols.".html"." does not exist.\n");
}
?>
