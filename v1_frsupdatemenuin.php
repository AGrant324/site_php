<<<<<<< HEAD
<?php # frsteamresultin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_frsroutines.php');

Get_Common_Parameters();
GlobalRoutine();
Frs_FRSUPDATEMENU_CSSJS();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();	

$inselectid = $_REQUEST['SelectId'];
$inteamcode = $_REQUEST['TeamCode'];
$insection = $_REQUEST['Section'];
$teamsection = "";

// XH2("Fixtures and Results Update ".$inselectid);

if (($inselectid ==  "TR")||($inselectid ==  "TA")) {
	foreach (Get_Array_Hash_SortSelect("section",$GLOBALS{'currperiodid'},"section_seq","section_frs","Yes") as $tsection_name)  {
		Get_Data_Hash('section',$GLOBALS{'currperiodid'},$tsection_name);
		if (FoundInCommaList($inteamcode,$GLOBALS{'section_teams'})) {
			$teamsection = $tsection_name;
		}
	}
}

if ($inselectid ==  "TR") {	
	Frs_TEAMFIXTURESLIST_Output($GLOBALS{'currperiodid'},$teamsection,$inteamcode);	
}

if ($inselectid ==  "TA") {
	Frs_TEAMFIXTURESUPDATE_Output($GLOBALS{'currperiodid'}, $inteamcode);
}

if ($inselectid ==  "TF") {
	Frs_TEAMFIXTURECARDPAGE_Output($GLOBALS{'currperiodid'}, $inteamcode);
}


if ($inselectid ==  "CR") {
	Frs_LASTWEEKSRESULTSUPDATELIST($GLOBALS{'currperiodid'}, $insection);
}


Back_Navigator();
PageFooter("Default","Final");
=======
<?php # frsteamresultin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_frsroutines.php');

Get_Common_Parameters();
GlobalRoutine();
Frs_FRSUPDATEMENU_CSSJS();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();	

$inselectid = $_REQUEST['SelectId'];
$inteamcode = $_REQUEST['TeamCode'];
$insection = $_REQUEST['Section'];
$teamsection = "";

// XH2("Fixtures and Results Update ".$inselectid);

if (($inselectid ==  "TR")||($inselectid ==  "TA")) {
	foreach (Get_Array_Hash_SortSelect("section",$GLOBALS{'currperiodid'},"section_seq","section_frs","Yes") as $tsection_name)  {
		Get_Data_Hash('section',$GLOBALS{'currperiodid'},$tsection_name);
		if (FoundInCommaList($inteamcode,$GLOBALS{'section_teams'})) {
			$teamsection = $tsection_name;
		}
	}
}

if ($inselectid ==  "TR") {	
	Frs_TEAMFIXTURESLIST_Output($GLOBALS{'currperiodid'},$teamsection,$inteamcode);	
}

if ($inselectid ==  "TA") {
	Frs_TEAMFIXTURESUPDATE_Output($GLOBALS{'currperiodid'}, $inteamcode);
}

if ($inselectid ==  "TF") {
	Frs_TEAMFIXTURECARDPAGE_Output($GLOBALS{'currperiodid'}, $inteamcode);
}


if ($inselectid ==  "CR") {
	Frs_LASTWEEKSRESULTSUPDATELIST($GLOBALS{'currperiodid'}, $insection);
}


Back_Navigator();
PageFooter("Default","Final");
>>>>>>> cbec31bba2128f8cfeb22fb0fa44e631f2c483fa
