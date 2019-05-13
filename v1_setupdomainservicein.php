<?php 

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_setuproutines.php');

Get_Common_Parameters();
GlobalRoutine();
Setup_DOMAINSERVICE_CSSJS();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

Get_Data("serviceenabled");
$tstring = $GLOBALS{"serviceenabled^FIELDS"};
$tfields = explode('|', $tstring);
foreach ($tfields as $tfieldelement) {
	UpdateService ($tfieldelement);	
}

Write_Data("serviceenabled");

Setup_DOMAINSERVICE_Output();

Back_Navigator();
PageFooter("Default","Final");


function UpdateService ($serviceelement) {
	if (((isset($_REQUEST[$serviceelement]))&&($_REQUEST[$serviceelement]!=""))) {
	    if ( $_REQUEST[$serviceelement] == "Yes" ) { $GLOBALS{$serviceelement} = "Enabled";  }
	    if ( $_REQUEST[$serviceelement] == "No" ) { $GLOBALS{$serviceelement} = "Disabled";  }
		// XPTXTCOLOR($serviceelement." set to ".$GLOBALS{$serviceelement},"green");
	} 
}



?>