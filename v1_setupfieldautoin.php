<?php 

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_reportroutines.php');

Get_Common_Parameters();
GlobalRoutine();
PageHeader("Default","Final");
Back_Navigator();

Get_Data("person",$GLOBALS{'LOGIN_person_id'});
Check_Session_Validity();

XH2("Setup Fields");
$reqtablea = $_REQUEST["TableSelect"];
if( count( $reqtablea ) == 0 ) {
	XPTXTCOLOR("No selection made","red");
} else {
	foreach ( $reqtablea as $reqtable ) {
		$tbits = explode('-',$reqtable);
		Report_SETUPTABLEFIELDAUTO_Output($tbits[1]);
	}
}

Back_Navigator();
PageFooter("Default","Final");

?>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        