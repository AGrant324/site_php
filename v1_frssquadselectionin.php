<?php # frssquadselectionin.php
require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_frsroutines.php');
Get_Common_Parameters();
GlobalRoutine();
PopUpHeader();
Check_Session_Validity();
Get_Person_Authority();
$inteamcode = $_REQUEST['team_code'];
$inteamsquadlist = $_REQUEST['team_squadlist'];
$squada = explode(',',$inteamsquadlist);
$sortarray = Array();
foreach ($squada as $personid)  {	
	Check_Data("person",$personid);
	if ($GLOBALS{'IOWARNING'} == "0") {	
		if ($GLOBALS{'person_paiddate'} == "0000-00-00") { $GLOBALS{'person_paiddate'} = "" ;}
		$age = Age($GLOBALS{'person_dob'},19);		
		$record = $GLOBALS{'person_sname'}."|".$GLOBALS{'person_fname'}."|".$personid."|".$age."|".Chosen_Person_Email()."|".Chosen_Person_SMS()."|".$GLOBALS{'person_paiddate'};
	} else {
		$record = "Unknown"."|"."Name"."|".$personid;		
	}
	array_push($sortarray, $record);
}
sort($sortarray);
Get_Data("team",$GLOBALS{'currperiodid'},$inteamcode);
XH3("Squad Updates have been successfully completed for ".$GLOBALS{'team_name'}.' team');
XTABLE();
XTR();XTDHTXT("Id");XTDHTXT("First Name");XTDHTXT("Surname");XTDHTXT("u18");XTDHTXT("Email");XTDHTXT("Mobile");XTDHTXT("Paid");X_TR();
$outsquadlist = ""; $sep = "";
foreach ($sortarray as $record)  {
	$bitsa = explode('|',$record);
	$outsquadlist = $outsquadlist.$sep.$bitsa[2];
	XTR();XTDTXT($bitsa[2]);XTDTXT($bitsa[1]);XTDTXT($bitsa[0]);XTDTXT($bitsa[3]);XTDTXT($bitsa[4]);XTDTXT($bitsa[5]);XTDTXT($bitsa[6]);X_TR();
	$sep = ",";
}
X_TABLE();

$GLOBALS{'team_squadlist'} = $outsquadlist;
Write_Data("team",$GLOBALS{'currperiodid'},$inteamcode);
XBR();XINBUTTONCLOSEWINDOW("Close");
PopUpFooter();
