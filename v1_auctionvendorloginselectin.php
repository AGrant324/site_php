<?php # personloginin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_auctionroutines.php');

Get_Common_Parameters();
GlobalRoutine();
Auction_ITEMINPUT_CSSJS ();
PageHeader("Default","Final");

$selectid = $_REQUEST['SelectId'];
	
Get_Data('person',$GLOBALS{'LOGIN_person_id'});
if ($selectid == "CONTACTDETAILSUPDATE") { Auction_CONTACTDETAILSUPDATE_Output($GLOBALS{'LOGIN_person_id'},"Vendor"); }
if ($selectid == "ITEMINPUT") { Auction_ITEMINPUT_Output($GLOBALS{'LOGIN_person_id'},"Vendor"); } 

AuctionVendor_Navigator();
PageFooter("Default","Final");

?>
