<?php #bulletinboardeditin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_webpageroutines.php');

Get_Common_Parameters();
GlobalRoutine();

$inbulletin_id = $_REQUEST['bulletin_id'];
$inbulletin_ref = $_REQUEST['bulletin_ref'];
$inbulletin_target = $_REQUEST['bulletin_target'];
$inbulletin_anchor = $_REQUEST['bulletin_anchor'];
$inbulletin_periodid = $_REQUEST['bulletin_periodid'];
$pass = $_REQUEST['pass'];

XH2("Bulletin Linker - $inbulletin_target");

if ($inbulletin_ref == "P") {	
  XFORM("bulletinboardlinker.php","");
  XINSTDHID();
  XINHID("bulletin_id",$inbulletin_id);
  XTABLE();
  XTR();XTDTXT("Webpage");XTDINSELECTHASH (Page_Select_Hash(),"bulletin_target","");X_TR();
  XTR();XTDTXT("Anchor");XTDINTXT("bulletin_anchor","","30","60");X_TR(); 
  XTR();XTDTXT("");XTDINSUBMIT("Continue");X_TR();  	
  X_TABLE();	
}
if ($inbulletin_ref == "L") {
	XTABLE();
	XTR();XTDTXT("External URL");XTDINTXT("bulletin_target","","30","60");X_TR();
	XTR();XTDTXT("");XTDINSUBMIT("Continue");X_TR();
	X_TABLE();	
}
if ($inbulletin_ref == "R") {
 if ($pass == "1") {	
	XTABLE();
	$perioda = Get_Array("period");
	XTR();XTDTXT("Season");XTDINSELECTHASH (Array2Hash($perioda),"bulletin_periodid",$GLOBALS{'currperiodid'});X_TR();	
	$teama = Get_Array("team",$GLOBALS{'currperiodid'});
    $ka = array(); $kv = array();
    foreach ($teama as $team_code) {	 
     Get_Data('team',$GLOBALS{'currperiodid'},$team_code);
     array_push($ka, $team_code);	
     array_push($kv, $GLOBALS{'team_name'});	
    }
	XTR();XTDTXT("Team");XTDINSELECTHASH (Arrays2Hash($ka,$kv),"team_code","");X_TR();
	XTR();XTDTXT("");XTDINSUBMIT("Continue");X_TR();	
	X_TABLE();
 }
 if ($pass == "2") {
	
 }
	
}

?>


	



