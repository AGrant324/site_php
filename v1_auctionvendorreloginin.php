<?php # personloginin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_auctionroutines.php');

Get_Common_Parameters();
GlobalRoutine();
PageHeader("Default","Final");
Back_Navigator();

Get_Data("person",$GLOBALS{'LOGIN_person_id'});
if ($GLOBALS{'LOGIN_session_id'} != $GLOBALS{'person_session'}) {
 print "Unauthorised access - someone else may be using your login\n";
 $GLOBALS{'person_session'} = "";
 $GLOBALS{'readonlyoverride'} = "Yes";
 Write_Data("person",$GLOBALS{'LOGIN_person_id'});
 $GLOBALS{'readonlyoverride'} = "No";
} else {
 Get_Person_Authority(); 
 Auction_VENDORLOGINSELECT_Output($GLOBALS{'LOGIN_person_id'},"Vendor");
}

Back_Navigator();
PageFooter("Default","Final");

?>
