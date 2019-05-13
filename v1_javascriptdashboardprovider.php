<?php # javascriptdashboardprovider.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');

Get_Common_Parameters();
GlobalRoutine();
if ($GLOBALS{'LOGIN_loginmode_id'} == "0") { Get_Data("person_".$GLOBALS{'LOGIN_service_id'},$GLOBALS{'LOGIN_person_id'}); }
else {Get_Data("person",$GLOBALS{'LOGIN_person_id'}); }

Get_Person_Authority();

# INPUT
# None
# OUTPUT
# Valid Icon list.Comma separated

if (strlen(strstr($GLOBALS{'LOGIN_service_id'},"ocz"))>0) {	
	$displaystring = $GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'}."^";
	
	$displaystring=$displaystring."MYMEMBERSHIP[Yes]".",";
	$displaystring=$displaystring."MYPROFILE[Yes]".",";	
	$displaystring=$displaystring."MYQUALIFICATION[Yes]".",";	
	$displaystring=$displaystring."MYAVAILABILITY[No]".",";

	$thisvisibility = "No";
	if (strlen(strstr($GLOBALS{'person_authority'},"MM#SectionLeader="))>0) { $thisvisibility = "Yes"; }
	if (strlen(strstr($GLOBALS{'person_authority'},"MM#TeamCaptain="))>0) { $thisvisibility = "Yes"; }
	if (strlen(strstr($GLOBALS{'person_authority'},"MM#TeamMgr="))>0) { $thisvisibility = "Yes"; }
	if (strlen(strstr($GLOBALS{'person_authority'},"MM#TeamCoach="))>0) { $thisvisibility = "Yes"; }
	if (strlen(strstr($GLOBALS{'person_authority'},"RM#TeamRM="))>0) { $thisvisibility = "Yes"; }
	if (strlen(strstr($GLOBALS{'person_authority'},"DM#Domain"))>0) { $thisvisibility = "Yes"; }
	if (strlen(strstr($GLOBALS{'person_authority'},"MM#Domain"))>0) { $thisvisibility = "Yes"; }
	if (strlen(strstr($GLOBALS{'person_authority'},"RM#Domain"))>0) { $thisvisibility = "Yes"; }
	if (strlen(strstr($GLOBALS{'person_authority'},"MM#SectionMM="))>0) { $thisvisibility = "Yes"; }
	if (strlen(strstr($GLOBALS{'person_authority'},"MM#SectionRM="))>0) { $thisvisibility = "Yes"; }	
	$displaystring=$displaystring."MYTEAM[".$thisvisibility."]".",";
	
	$thisvisibility = "No";
	if (strlen(strstr($GLOBALS{'person_authority'},"MM#SectionLeader="))>0) { $thisvisibility = "Yes"; }
	if (strlen(strstr($GLOBALS{'person_authority'},"MM#GroupMgr="))>0) { $thisvisibility = "Yes"; }
	if (strlen(strstr($GLOBALS{'person_authority'},"MM#GroupCoach="))>0) { $thisvisibility = "Yes"; }
	if (strlen(strstr($GLOBALS{'person_authority'},"MM#GroupMM="))>0) { $thisvisibility = "Yes"; }
	if (strlen(strstr($GLOBALS{'person_authority'},"DM#Domain"))>0) { $thisvisibility = "Yes"; }
	if (strlen(strstr($GLOBALS{'person_authority'},"MM#Domain"))>0) { $thisvisibility = "Yes"; }
	if (strlen(strstr($GLOBALS{'person_authority'},"MM#SectionMM="))>0) { $thisvisibility = "Yes"; }
	$displaystring=$displaystring."MYGROUP[".$thisvisibility."]".",";
	
	$displaystring=$displaystring."PERSONSEARCH[Yes]".",";
	$displaystring=$displaystring."LIBRARYVIEW[Yes]".",";
	$displaystring=$displaystring."PHOTOGALLERY[No]".",";
	$displaystring=$displaystring."VIDEOGALLERY[No]".",";
	$displaystring=$displaystring."PERSONEMAIL[Yes]".",";
	
	$displaystring=$displaystring."CLASSICMENU[Yes]";

	print $displaystring;
	
}	
	
?>