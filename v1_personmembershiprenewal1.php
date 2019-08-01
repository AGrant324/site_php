<?php # personmembershiprenewal1.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');

Get_Common_Parameters();
GlobalRoutine();
Person_MEMBERSHIPRENEWAL1_CSSJS();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

Get_Data("person",$GLOBALS{'LOGIN_person_id'});

Get_Person_Authority();
$intypefreq = $_REQUEST['TypeFreq'];
if( is_array($_REQUEST['IncludedPersonIdList']) ) { # one of checkboxes selected
	$includedpersonidlist = Array2List($_REQUEST['IncludedPersonIdList']);	
} else {
	$includedpersonidlist = $GLOBALS{'LOGIN_person_id'};
}

if((isset($_REQUEST['TypeFreq'])&&($includedpersonidlist != ""))) {
	$intypefreq = $_REQUEST['TypeFreq'];	
	$tfbits = explode('|',$intypefreq);
	Person_MEMBERSHIPRENEWAL1_Output($tfbits[0],$tfbits[1],$includedpersonidlist);
} else {
	XH4("No selection made - please go back and retry");	
}

Back_Navigator();
PageFooter("Default","Final");

?>
