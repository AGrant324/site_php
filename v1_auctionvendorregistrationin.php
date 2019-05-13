<?php # personloginin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_auctionroutines.php');

Get_Common_Parameters();
GlobalRoutine();
Auction_ITEMINPUT_CSSJS ();
PageHeader("Default","Final");

$infname = $_REQUEST['PersonFName'];
$insname = $_REQUEST['PersonSName'];
$inemail = $_REQUEST['Email'];
$inhomephone = $_REQUEST['HomePhone'];
$inmobilephone = $_REQUEST['MobilePhone'];
$inaddr1 = $_REQUEST['Addr1'];
$inaddr2 = $_REQUEST['Addr2'];
$inaddr3 = $_REQUEST['Addr3'];
$inaddr4 = $_REQUEST['Addr4'];
$inpostcode = $_REQUEST['PostCode'];
$inpsw1 = $_REQUEST['PersonPsw1'];
$inpsw2 = $_REQUEST['PersonPsw2'];

$error = "0";


if ($inemail == "") { XPTXT("No Email Entered - please retry"); $error = "1"; }
if ($inpsw1 == "") { XPTXT("No Password Entered - please retry"); $error = "1"; }
if ($inpsw1 != $inpsw2) { XPTXT("Passwords do not match");	 $error = "1"; }
else {
 $persona = Get_Array('person');
 $personidfound = "0";
 foreach ($persona as $person_id) {
  Get_Data("person",$person_id);
  if (($GLOBALS{'person_email1'} == $inemail)&&($inemail != "")) {$personidfound = $person_id;}
 }
 if ($personidfound != "0") {
  XPTXT($GLOBALS{'person_email1'}." is already registered. Please login");
  $error = "1";	  
 }	
}		
	
if ( $error == "1" ) {
  Auction_VENDORREGISTRATION_Output();  		
} else {	
 $suffixa = array("","1","2","3","4","5","6","7","8","9");	
 $sindex = 0;
 $personcreated = "0";
 while ($personcreated == "0") {		
  $infnamex = str_replace("'","",$infname);
  $insnamex = str_replace("'","",$insname);
  $person_id = strtolower(substr($infnamex,0,1).substr($insnamex,0,3).$suffixa[$sindex]);  
  Check_Data("person",$person_id);
  if ($GLOBALS{'IOWARNING'} == "1") {
   Initialise_Data('person');
   $infnamex = str_replace("'","",$infname);
   $insnamex = str_replace("'","",$insname);
   $person_id = strtolower(substr($infnamex,0,1).substr($insnamex,0,3).$suffixa[$sindex]);  
   $GLOBALS{'person_fname'} = $infname;
   $GLOBALS{'person_sname'} = $insname;
   $GLOBALS{'person_email1'} = $inemail;
   $GLOBALS{'person_hometel'} = $inhomephone;
   $GLOBALS{'person_mobiletel'} = $inmobilephone; 
   $GLOBALS{'person_addr1'} = $inaddr1;
   $GLOBALS{'person_addr2'} = $inaddr2;
   $GLOBALS{'person_addr3'} = $inaddr3;
   $GLOBALS{'person_addr4'} = $inaddr4;   
   $GLOBALS{'person_postcode'} = $inpostcode;  
   $GLOBALS{'person_password'} = XCrypt($inpsw1,$person_id,"encrypt");
   Write_Data('person',$person_id);
   $personcreated = "1";   
   XPTXT("Thank you $infname - registration successful - ".XCrypt($GLOBALS{'person_password'},$person_id,"decrypt"));
   Auction_ITEMINPUT_Output($person_id,"Vendor"); 	   
  }
  $sindex++;
 } 	
}


AuctionVendor_Navigator();
PageFooter("Default","Final");

?>
