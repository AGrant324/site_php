<<<<<<< HEAD
<?php # personmembershippaypalcancel.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');

Get_Common_Parameters();
GlobalRoutine();
Person_MEMBERSHIPRENEWAL1_CSSJS();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

XTXTCOLOR("Debit Card / Credit Card via Paypal cancelled - would you like to try an alternative payment method.","Orange");
XBR();
XHR();

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
=======
<?php # personmembershippaypalcancel.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');

Get_Common_Parameters();
GlobalRoutine();
Person_MEMBERSHIPRENEWAL1_CSSJS();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

XTXTCOLOR("Debit Card / Credit Card via Paypal cancelled - would you like to try an alternative payment method.","Orange");
XBR();
XHR();

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
>>>>>>> cbec31bba2128f8cfeb22fb0fa44e631f2c483fa
