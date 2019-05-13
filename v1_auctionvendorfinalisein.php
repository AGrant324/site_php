<?php # auctioniteminputin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_auctionroutines.php');

Get_Common_Parameters();
GlobalRoutine();
PageHeader("Default","Final");

$inadmin_vendor = $_REQUEST['AdminVendor'];
$inauctionitem_vendorpersonid = $_REQUEST['auctionitem_vendorpersonid'];

Auction_ITEMINPUTFINALISATION_Output ($inauctionitem_vendorpersonid,$inadmin_vendor);

AuctionVendor_Navigator();
PageFooter("Default","Final");

?>


