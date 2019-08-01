<<<<<<< HEAD
<?php # personloginin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_auctionroutines.php');

Get_Common_Parameters();
GlobalRoutine();
PageHeader("Default","Final");

$inident = $_REQUEST['PersonIdent'];
str_replace(" ","",$inident);
$inpsw = $_REQUEST['PersonPsw'];

$persona = Get_Array('person');
$personidfound = "0";
foreach ($persona as $person_id) {
 Get_Data("person",$person_id);
 if ($GLOBALS{'person_email1'} == $inident) {$personidfound = $person_id;}
 if ($GLOBALS{'person_hometel'} == $inident) {$personidfound = $person_id;} 
 if ($GLOBALS{'person_worktel'} == $inident) {$personidfound = $person_id;}  
 if ($GLOBALS{'person_mobiletel'} == $inident) {$personidfound = $person_id;}  
}

if ($personidfound != "0") {
 Get_Data("person",$personidfound);
 $encmembpsw = XCrypt($inpsw,$personidfound,"encrypt");
 # print "<P>TEST |$encmembpsw| |".$GLOBALS{'person_password'}."|\n"; 
 if ($encmembpsw == $GLOBALS{'person_password'}) {
  $GLOBALS{'LOGIN_person_id'} = $personidfound;
  Set_Person_Session(); // CHECK vs Dashboard view	
  Auction_VENDORLOGINSELECT_Output($personidfound,"Vendor"); 	   
 } else {
  print "<P>Incorrect password - Please try again\n";
 } 
} else {
 XH5("Sorry - we were not able to identify you");	
}

AuctionVendor_Navigator();
PageFooter("Default","Final");

?>
=======
<?php # personloginin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_auctionroutines.php');

Get_Common_Parameters();
GlobalRoutine();
PageHeader("Default","Final");

$inident = $_REQUEST['PersonIdent'];
str_replace(" ","",$inident);
$inpsw = $_REQUEST['PersonPsw'];

$persona = Get_Array('person');
$personidfound = "0";
foreach ($persona as $person_id) {
 Get_Data("person",$person_id);
 if ($GLOBALS{'person_email1'} == $inident) {$personidfound = $person_id;}
 if ($GLOBALS{'person_hometel'} == $inident) {$personidfound = $person_id;} 
 if ($GLOBALS{'person_worktel'} == $inident) {$personidfound = $person_id;}  
 if ($GLOBALS{'person_mobiletel'} == $inident) {$personidfound = $person_id;}  
}

if ($personidfound != "0") {
 Get_Data("person",$personidfound);
 $encmembpsw = XCrypt($inpsw,$personidfound,"encrypt");
 # print "<P>TEST |$encmembpsw| |".$GLOBALS{'person_password'}."|\n"; 
 if ($encmembpsw == $GLOBALS{'person_password'}) {
  $GLOBALS{'LOGIN_person_id'} = $personidfound;
  Set_Person_Session(); 	
  Auction_VENDORLOGINSELECT_Output($personidfound,"Vendor"); 	   
 } else {
  print "<P>Incorrect password - Please try again\n";
 } 
} else {
 XH5("Sorry - we were not able to identify you");	
}

AuctionVendor_Navigator();
PageFooter("Default","Final");

?>
>>>>>>> cbec31bba2128f8cfeb22fb0fa44e631f2c483fa
